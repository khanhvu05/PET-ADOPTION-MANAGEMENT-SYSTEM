<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PetNote extends Model
{
    protected $table      = 'pet_notes';
    protected $primaryKey = 'Ma_ghi_chu';
    public $incrementing  = false;
    protected $keyType    = 'string';
    public $timestamps    = false;

    protected $fillable = [
        'Ma_ghi_chu', 'Ma_thu_cung', 'Ma_nguoi_dung', 'Noi_dung',
    ];

    protected $casts = [
        'Ngay_tao' => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(fn($m) => $m->Ma_ghi_chu ??= Str::uuid()->toString());
    }

    public function thuCung()
    {
        return $this->belongsTo(Pet::class, 'Ma_thu_cung', 'Ma_thu_cung');
    }

    public function nguoiDung()
    {
        return $this->belongsTo(User::class, 'Ma_nguoi_dung', 'Ma_nguoi_dung');
    }
}
