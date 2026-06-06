<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RescueCase extends Model
{
    protected $table      = 'rescue_cases';
    protected $primaryKey = 'Ma_ca_cuu_ho';
    public $incrementing  = false;
    protected $keyType    = 'string';
    public $timestamps    = false;

    protected $fillable = [
        'Ma_ca_cuu_ho', 'Ma_thu_cung', 'Ngay_cuu_ho', 'Dia_diem_cuu_ho',
        'Loai_cuu_ho', 'Nguoi_bao_cao', 'Nguoi_thuc_hien', 'Chi_phi_cuu_ho',
        'Trang_thai_ca', 'Ghi_chu',
    ];

    protected $casts = [
        'Ngay_cuu_ho'    => 'date',
        'Chi_phi_cuu_ho' => 'decimal:2',
        'Ngay_tao'       => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(fn($m) => $m->Ma_ca_cuu_ho ??= Str::uuid()->toString());
    }

    public function thuCung()
    {
        return $this->belongsTo(Pet::class, 'Ma_thu_cung', 'Ma_thu_cung');
    }

    public function nguoiThucHien()
    {
        return $this->belongsTo(User::class, 'Nguoi_thuc_hien', 'Ma_nguoi_dung');
    }

    public function getLoaiCuuHoLabelAttribute(): string
    {
        return match ($this->Loai_cuu_ho) {
            'lang_thang'  => 'Lang thang',
            'lac_duong'   => 'Lạc đường',
            'bi_bo_roi'   => 'Bị bỏ rơi',
            'bi_nguoc_dai' => 'Bị ngược đãi',
            default       => 'Khác',
        };
    }
}
