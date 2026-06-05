<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AdoptionQuestion extends Model
{
    protected $table      = 'adoption_questions';
    protected $primaryKey = 'Ma_cau_hoi';
    public $incrementing  = false;
    protected $keyType    = 'string';

    const CREATED_AT = 'Ngay_tao';
    const UPDATED_AT = 'Ngay_cap_nhat';

    protected $fillable = [
        'Ma_cau_hoi', 'Ma_hien_thi', 'Noi_dung', 'Loai_cau_tra_loi',
        'Cac_lua_chon', 'Bat_buoc', 'Thu_tu', 'Hoat_dong',
    ];

    protected $casts = [
        'Cac_lua_chon' => 'array',
        'Bat_buoc'     => 'boolean',
        'Hoat_dong'    => 'boolean',
        'Ngay_tao'     => 'datetime',
        'Ngay_cap_nhat' => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(fn($m) => $m->Ma_cau_hoi ??= Str::uuid()->toString());
    }
    
    public function answers()
    {
        return $this->hasMany(AdoptionAnswer::class, 'Ma_cau_hoi', 'Ma_cau_hoi');
    }
}
