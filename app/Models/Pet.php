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

    // Tự sinh UUID khi tạo mới
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->Ma_thu_cung)) {
                $model->Ma_thu_cung = Str::uuid()->toString();
            }
        });
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
        return match ($this->Loai) {
            'cho'  => 'https://images.unsplash.com/photo-1543466835-00a7907e9de1?w=300&h=300&fit=crop',
            'meo'  => 'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=300&h=300&fit=crop',
            default => 'https://images.unsplash.com/photo-1425082661705-1834bfd09dca?w=300&h=300&fit=crop',
        };
    }
}
