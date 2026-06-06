<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DonationCampaign extends Model
{
    protected $table      = 'donation_campaigns';
    protected $primaryKey = 'Ma_chien_dich';
    public $incrementing  = false;
    protected $keyType    = 'string';

    const CREATED_AT = 'Ngay_tao';
    const UPDATED_AT = 'Ngay_cap_nhat';

    protected $fillable = [
        'Ma_chien_dich', 'Tieu_de', 'Mo_ta', 'Anh_dai_dien', 
        'So_tien_muc_tieu', 'So_tien_hien_tai', 'Ngay_bat_dau', 
        'Ngay_ket_thuc', 'Trang_thai'
    ];

    protected $casts = [
        'Ngay_bat_dau' => 'date',
        'Ngay_ket_thuc' => 'date',
        'So_tien_muc_tieu' => 'integer',
        'So_tien_hien_tai' => 'integer',
        'Ngay_tao' => 'datetime',
        'Ngay_cap_nhat' => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(fn($m) => $m->Ma_chien_dich ??= Str::uuid()->toString());
    }

    // Nếu bảng donations có cột Ma_chien_dich, quan hệ sẽ như sau:
    // public function donations()
    // {
    //     return $this->hasMany(Donation::class, 'Ma_chien_dich', 'Ma_chien_dich');
    // }
}
