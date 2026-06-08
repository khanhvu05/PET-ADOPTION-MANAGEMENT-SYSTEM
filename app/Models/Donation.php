<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Donation extends Model
{
    protected $table      = 'donations';
    protected $primaryKey = 'Ma_ung_ho';
    public $incrementing  = false;
    protected $keyType    = 'string';

    const CREATED_AT = 'Ngay_tao';
    const UPDATED_AT = 'Ngay_cap_nhat';

    protected $fillable = [
        'Ma_ung_ho', 'Ma_nguoi_dung', 'Ma_chien_dich',
        'Ten_nguoi_ung_ho', 'Email_nguoi_ung_ho', 'An_danh', 'So_tien', 'Loi_nhan',
        'Ma_giao_dich_he_thong', 'Ma_giao_dich_vnpay', 'Ma_phan_hoi_vnpay',
        'Ma_ngan_hang', 'Trang_thai', 'Thoi_diem_thanh_toan',
    ];

    protected $casts = [
        'An_danh'              => 'boolean',
        'So_tien'              => 'integer',
        'Thoi_diem_thanh_toan' => 'datetime',
        'Ngay_tao'             => 'datetime',
        'Ngay_cap_nhat'        => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(fn($m) => $m->Ma_ung_ho ??= Str::uuid()->toString());
    }

    public function nguoiDung()
    {
        return $this->belongsTo(User::class, 'Ma_nguoi_dung', 'Ma_nguoi_dung');
    }

    public function chienDich()
    {
        return $this->belongsTo(DonationCampaign::class, 'Ma_chien_dich', 'Ma_chien_dich');
    }

    public function getTrangThaiLabelAttribute(): string
    {
        return match ($this->Trang_thai) {
            'pending' => 'Chờ thanh toán',
            'success' => 'Thành công',
            'failed'  => 'Thất bại',
            'expired' => 'Hết hạn',
            default   => 'Không rõ',
        };
    }
}
