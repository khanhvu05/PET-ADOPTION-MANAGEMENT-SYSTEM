<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class VaccinationHistory extends Model
{
    protected $table      = 'vaccination_history';
    protected $primaryKey = 'Ma_lan_tiem';
    public $incrementing  = false;
    protected $keyType    = 'string';
    public $timestamps    = false;

    protected $fillable = [
        'Ma_lan_tiem', 'Ma_thu_cung', 'Ten_vac_xin', 'Ngay_tiem',
        'Ngay_tiem_nhac_tiep', 'Nguoi_thuc_hien', 'Ten_noi_tiem', 'Chi_phi',
    ];

    protected $casts = [
        'Ngay_tiem'           => 'date',
        'Ngay_tiem_nhac_tiep' => 'date',
        'Chi_phi'             => 'decimal:2',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(fn($m) => $m->Ma_lan_tiem ??= Str::uuid()->toString());
    }

    public function thuCung()
    {
        return $this->belongsTo(Pet::class, 'Ma_thu_cung', 'Ma_thu_cung');
    }

    public function nguoiThucHien()
    {
        return $this->belongsTo(User::class, 'Nguoi_thuc_hien', 'Ma_nguoi_dung');
    }

    /** Số ngày còn lại đến lịch tiêm nhắc */
    public function getSoNgayConLaiAttribute(): ?int
    {
        if (!$this->Ngay_tiem_nhac_tiep) return null;
        return now()->diffInDays($this->Ngay_tiem_nhac_tiep, false);
    }
}
