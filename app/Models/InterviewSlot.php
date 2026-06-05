<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InterviewSlot extends Model
{
    protected $table      = 'interview_slots';
    protected $primaryKey = 'Ma_slot';
    public $incrementing  = false;
    protected $keyType    = 'string';

    const CREATED_AT = 'Ngay_tao';
    const UPDATED_AT = null;

    protected $fillable = [
        'Ma_slot', 'Ngay', 'Gio_bat_dau', 'Gio_ket_thuc',
        'So_luong_toi_da', 'So_luong_hien_tai', 'Nhan_vien_xu_ly', 'Trang_thai'
    ];

    protected $casts = [
        'Ngay' => 'date',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(fn($m) => $m->Ma_slot ??= Str::uuid()->toString());
    }

    public function applications()
    {
        return $this->hasMany(AdoptionApplication::class, 'interview_slot_id', 'Ma_slot');
    }

    public function nhanVien()
    {
        return $this->belongsTo(User::class, 'Nhan_vien_xu_ly', 'Ma_nguoi_dung');
    }

    public function getFormattedTimeAttribute(): string
    {
        return date('H:i', strtotime($this->Gio_bat_dau)) . ' - ' . date('H:i', strtotime($this->Gio_ket_thuc));
    }
}
