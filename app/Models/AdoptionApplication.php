<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AdoptionApplication extends Model
{
    protected $table      = 'adoption_applications';
    protected $primaryKey = 'Ma_don';
    public $incrementing  = false;
    protected $keyType    = 'string';

    const CREATED_AT = 'Ngay_tao';
    const UPDATED_AT = 'Ngay_cap_nhat';

    protected $fillable = [
        'Ma_don', 'Ma_nguoi_dung', 'Ma_thu_cung', 'Ho_ten', 'So_dien_thoai',
        'Dia_chi', 'Nghe_nghiep', 'Loai_nha_o', 'Kinh_nghiem',
        'Ly_do_nhan_nuoi', 'Cam_ket', 'Trang_thai', 'Ghi_chu_admin',
        'interview_slot_id', 'han_xac_nhan_phong_van', 'da_nhac_nho_phong_van',
    ];

    protected $casts = [
        'Cam_ket'      => 'boolean',
        'Ngay_tao'     => 'datetime',
        'Ngay_cap_nhat' => 'datetime',
        'han_xac_nhan_phong_van' => 'datetime',
        'da_nhac_nho_phong_van' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(fn($m) => $m->Ma_don ??= Str::uuid()->toString());
    }

    public function thuCung()
    {
        return $this->belongsTo(Pet::class, 'Ma_thu_cung', 'Ma_thu_cung');
    }

    public function nguoiDung()
    {
        return $this->belongsTo(User::class, 'Ma_nguoi_dung', 'Ma_nguoi_dung');
    }

    public function answers()
    {
        return $this->hasMany(AdoptionAnswer::class, 'Ma_don', 'Ma_don');
    }

    public function interviewSlot()
    {
        return $this->belongsTo(InterviewSlot::class, 'interview_slot_id', 'Ma_slot');
    }

    public function getTrangThaiLabelAttribute(): string
    {
        return match ($this->Trang_thai) {
            'cho_duyet'       => 'Chờ xử lý',
            'cho_xac_nhan_don'=> 'Chờ chọn lịch PV',
            'cho_phong_van'   => 'Chờ phỏng vấn',
            'da_duyet'        => 'PV thành công',
            'hoan_thanh'      => 'Đã nhận nuôi',
            'tu_choi'         => 'Từ chối / Hủy',
            default           => 'Không rõ',
        };
    }
}
