<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InterviewSchedule extends Model
{
    protected $table      = 'interview_schedules';
    protected $primaryKey = 'Ma_lich';
    public $incrementing  = false;
    protected $keyType    = 'string';

    const CREATED_AT = 'Ngay_tao';
    const UPDATED_AT = 'Ngay_cap_nhat';

    protected $fillable = [
        'Ma_lich', 'Ma_don', 'Ma_slot', 'Loai_lich', 'Thoi_gian_du_kien', 
        'Thoi_gian_xac_nhan', 'Nhan_vien_xu_ly', 'Trang_thai', 'Ket_qua_phong_van', 'Email_da_gui', 'Ghi_chu'
    ];

    protected $casts = [
        'Thoi_gian_du_kien' => 'datetime',
        'Thoi_gian_xac_nhan' => 'datetime',
        'Ngay_tao' => 'datetime',
        'Ngay_cap_nhat' => 'datetime',
        'Email_da_gui' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(fn($m) => $m->Ma_lich ??= Str::uuid()->toString());
    }

    public function donNhanNuoi()
    {
        return $this->belongsTo(AdoptionApplication::class, 'Ma_don', 'Ma_don');
    }

    public function slot()
    {
        return $this->belongsTo(InterviewSlot::class, 'Ma_slot', 'Ma_slot');
    }

    public function nhanVienXuLy()
    {
        return $this->belongsTo(User::class, 'Nhan_vien_xu_ly', 'Ma_nguoi_dung');
    }
}
