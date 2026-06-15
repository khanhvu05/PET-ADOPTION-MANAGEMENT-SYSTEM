<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pet extends Model
{
    protected $table      = 'pets';
    protected $primaryKey = 'Ma_thu_cung';
    public $incrementing  = false;
    protected $keyType    = 'string';

    const CREATED_AT = 'Ngay_tao';
    const UPDATED_AT = 'Ngay_cap_nhat';

    protected $fillable = [
        'Ma_thu_cung', 'Ma_hien_thi', 'Ten', 'Loai', 'Giong',
        'Nhom_tuoi', 'Can_nang', 'Gioi_tinh', 'Da_tiem_phong',
        'Da_triet_san', 'Trang_thai', 'Vi_tri',
        'Than_thien_nguoi', 'Than_thien_cho', 'Than_thien_meo',
        'Che_do_an_dac_biet', 'Ngay_tiep_nhan', 'Phi_nhan_nuoi',
        'Noi_bat', 'Mo_ta', 'Nguoi_phu_trach', 'Anh_dai_dien',
        'Mau_long', 'Tinh_cach', 'Thoi_quen', 'Yeu_thich', 'Thu_vien_anh',
    ];

    protected $casts = [
        'Da_tiem_phong'    => 'boolean',
        'Da_triet_san'     => 'boolean',
        'Noi_bat'          => 'boolean',
        'Than_thien_nguoi' => 'boolean',
        'Than_thien_cho'   => 'boolean',
        'Than_thien_meo'   => 'boolean',
        'Can_nang'         => 'decimal:2',
        'Phi_nhan_nuoi'    => 'decimal:2',
        'Ngay_tiep_nhan'   => 'date',
        'Ngay_tao'         => 'datetime',
        'Ngay_cap_nhat'    => 'datetime',
        'Thu_vien_anh'     => 'array',
    ];

    // Tự sinh UUID khi tạo mới và tự động lưu log khi cập nhật
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->Ma_thu_cung)) {
                $model->Ma_thu_cung = Str::uuid()->toString();
            }
        });

        static::updated(function ($model) {
            $changes = $model->getChanges();
            $original = $model->getOriginal();
            
            $ignored = ['Ngay_cap_nhat'];
            $logEntries = [];
            
            foreach ($changes as $key => $newValue) {
                if (in_array($key, $ignored)) continue;
                
                $oldValue = $original[$key] ?? '';
                $label = self::getAttributeLabel($key);
                
                // Format boolean fields
                if (in_array($key, ['Da_tiem_phong', 'Da_triet_san', 'Noi_bat', 'Than_thien_nguoi', 'Than_thien_cho', 'Than_thien_meo'])) {
                    $oldValue = $oldValue ? 'Có' : 'Không';
                    $newValue = $newValue ? 'Có' : 'Không';
                }
                
                if ($oldValue === '' || $oldValue === null) $oldValue = 'trống';
                if ($newValue === '' || $newValue === null) $newValue = 'trống';

                // Skip if old and new value are practically the same (e.g. 0.00 vs 0)
                if ($oldValue == $newValue) continue;

                // For some specific fields, mapping values might be better, but we will leave as is to be simple
                if ($key === 'Trang_thai') {
                    $oldValue = self::mapTrangThai($oldValue);
                    $newValue = self::mapTrangThai($newValue);
                }

                // Xử lý mảng (như Thu_vien_anh) hoặc các trường chứa link ảnh dài
                if ($key === 'Thu_vien_anh' || $key === 'Anh_dai_dien') {
                    if (is_array($oldValue)) $oldValue = count($oldValue) . ' ảnh';
                    else $oldValue = $oldValue ? 'Dữ liệu ảnh cũ' : 'trống';
                    
                    if (is_array($newValue)) $newValue = count($newValue) . ' ảnh';
                    else $newValue = $newValue ? 'Dữ liệu ảnh mới' : 'trống';
                } else {
                    if (is_array($oldValue)) $oldValue = count($oldValue) . ' mục';
                    if (is_array($newValue)) $newValue = count($newValue) . ' mục';
                }

                $logEntries[] = "- Cập nhật {$label} từ '{$oldValue}' thành '{$newValue}'.";
            }
            
            if (!empty($logEntries)) {
                $content = implode("\n", $logEntries);
                $userId = auth()->check() ? auth()->id() : (User::whereHas('roles', fn($q) => $q->where('name', 'admin'))->first()->Ma_nguoi_dung ?? null);
                
                if ($userId) {
                    $model->ghiChu()->create([
                        'Ma_nguoi_dung' => $userId,
                        'Noi_dung' => $content,
                    ]);
                }
            }
        });
    }

    private static function mapTrangThai($value) {
        return match ($value) {
            'chua_san_sang' => 'Chưa sẵn sàng',
            'san_sang'      => 'Sẵn sàng',
            'da_nhan_nuoi'  => 'Đã nhận nuôi',
            'da_mat'        => 'Đã mất',
            'trống'         => 'trống',
            default         => $value,
        };
    }

    public static function getAttributeLabel($key): string
    {
        $labels = [
            'Ten' => 'Tên',
            'Loai' => 'Loài',
            'Giong' => 'Giống',
            'Nhom_tuoi' => 'Nhóm tuổi',
            'Can_nang' => 'Cân nặng (kg)',
            'Gioi_tinh' => 'Giới tính',
            'Da_tiem_phong' => 'Đã tiêm phòng',
            'Da_triet_san' => 'Đã triệt sản',
            'Trang_thai' => 'Trạng thái',
            'Vi_tri' => 'Vị trí',
            'Than_thien_nguoi' => 'Thân thiện với người',
            'Than_thien_cho' => 'Thân thiện với chó',
            'Than_thien_meo' => 'Thân thiện với mèo',
            'Che_do_an_dac_biet' => 'Chế độ ăn đặc biệt',
            'Ngay_tiep_nhan' => 'Ngày tiếp nhận',
            'Phi_nhan_nuoi' => 'Phí nhận nuôi',
            'Noi_bat' => 'Nổi bật',
            'Mo_ta' => 'Mô tả',
            'Nguoi_phu_trach' => 'Người phụ trách',
            'Anh_dai_dien' => 'Ảnh đại diện',
            'Mau_long' => 'Màu lông',
            'Tinh_cach' => 'Tính cách',
            'Thoi_quen' => 'Thói quen',
            'Yeu_thich' => 'Sở thích',
            'Thu_vien_anh' => 'Thư viện ảnh',
        ];
        return $labels[$key] ?? $key;
    }

    // ── Relationships ───────────────────────────────────────────

    /** Nhân viên phụ trách bé thú cưng này */
    public function nguoiPhuTrach()
    {
        return $this->belongsTo(User::class, 'Nguoi_phu_trach', 'Ma_nguoi_dung');
    }

    /** Lịch sử tiêm chủng của bé */
    public function lichSuTiemChung()
    {
        return $this->hasMany(VaccinationHistory::class, 'Ma_thu_cung', 'Ma_thu_cung')
                    ->orderByDesc('Ngay_tiem');
    }

    /** Các ca cứu hộ liên quan đến bé */
    public function caCuuHo()
    {
        return $this->hasMany(RescueCase::class, 'Ma_thu_cung', 'Ma_thu_cung')
                    ->orderByDesc('Ngay_cuu_ho');
    }

    /** Đơn nhận nuôi của bé */
    public function donNhanNuoi()
    {
        return $this->hasMany(AdoptionApplication::class, 'Ma_thu_cung', 'Ma_thu_cung')
                    ->orderByDesc('Ngay_tao');
    }

    /** Ghi chú của bé */
    public function ghiChu()
    {
        return $this->hasMany(PetNote::class, 'Ma_thu_cung', 'Ma_thu_cung')
                    ->orderByDesc('Ngay_tao');
    }

    // ── Helpers ─────────────────────────────────────────────────

    /** Nhãn hiển thị cho Loại */
    public function getLoaiLabelAttribute(): string
    {
        return match ($this->Loai) {
            'cho'  => 'Chó',
            'meo'  => 'Mèo',
            'khac' => 'Khác',
            default => 'Chưa xác định',
        };
    }

    /** Nhãn hiển thị cho Giới tính */
    public function getGioiTinhLabelAttribute(): string
    {
        return match ($this->Gioi_tinh) {
            'duc'           => 'Đực',
            'cai'           => 'Cái',
            'chua_xac_dinh' => 'Chưa xác định',
            default         => 'Chưa xác định',
        };
    }

    /** Nhãn hiển thị cho Nhóm tuổi */
    public function getNhomTuoiLabelAttribute(): string
    {
        return match ($this->Nhom_tuoi) {
            'so_sinh'     => 'Sơ sinh',
            'nho'         => 'Nhỏ',
            'truong_thanh' => 'Trưởng thành',
            'gia'         => 'Già',
            default       => 'Chưa xác định',
        };
    }

    /** Nhãn + màu badge cho Trạng thái */
    public function getTrangThaiLabelAttribute(): string
    {
        return match ($this->Trang_thai) {
            'chua_san_sang' => 'Chưa sẵn sàng',
            'san_sang'      => 'Sẵn sàng',
            'da_nhan_nuoi'  => 'Đã nhận nuôi',
            'da_mat'        => 'Đã mất',
            default         => 'Không rõ',
        };
    }

    /** Màu badge TailwindCSS theo Trạng thái */
    public function getTrangThaiColorAttribute(): string
    {
        return match ($this->Trang_thai) {
            'san_sang'      => 'green',
            'chua_san_sang' => 'orange',
            'da_nhan_nuoi'  => 'purple',
            'da_mat'        => 'red',
            default         => 'slate',
        };
    }

    /** Nhãn Vị trí */
    public function getViTriLabelAttribute(): string
    {
        return match ($this->Vi_tri) {
            'noi_tru'   => 'Nội trú',
            'phong_kham' => 'Phòng khám',
            default     => 'Không rõ',
        };
    }

    /** URL ảnh đại diện – fallback theo loài nếu chưa có ảnh */
    public function getAnhUrlAttribute(): string
    {
        if ($this->Anh_dai_dien) {
            return $this->Anh_dai_dien;
        }
        $hash = abs(crc32($this->Ma_thu_cung ?? $this->Ten ?? 'pet')) % 100 + 1;

        if ($this->Loai === 'cho') {
            return "https://placedog.net/500/500?id={$hash}";
        } elseif ($this->Loai === 'meo') {
            $catNames = ['millie', 'neo', 'poppy', 'bella', 'louie', 'boki', 'peaches', 'cinnamon', 'zika', 'guster'];
            $catName = $catNames[$hash % count($catNames)];
            return "https://placecats.com/{$catName}/500/500";
        } else {
            $otherIndex = ($hash % 5) + 1;
            return asset("images/other_pets/{$otherIndex}.jpg");
        }
    }
}
