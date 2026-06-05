<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AdoptionAnswer extends Model
{
    protected $table      = 'adoption_answers';
    protected $primaryKey = 'Ma_tra_loi';
    public $incrementing  = false;
    protected $keyType    = 'string';

    const CREATED_AT = 'Ngay_tao';
    const UPDATED_AT = 'Ngay_cap_nhat';

    protected $fillable = [
        'Ma_tra_loi', 'Ma_don', 'Ma_cau_hoi', 'Noi_dung_tra_loi', 'Lua_chon_da_chon'
    ];

    protected $casts = [
        'Lua_chon_da_chon' => 'array',
        'Ngay_tao'         => 'datetime',
        'Ngay_cap_nhat'    => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(fn($m) => $m->Ma_tra_loi ??= Str::uuid()->toString());
    }

    public function question()
    {
        return $this->belongsTo(AdoptionQuestion::class, 'Ma_cau_hoi', 'Ma_cau_hoi');
    }

    public function application()
    {
        return $this->belongsTo(AdoptionApplication::class, 'Ma_don', 'Ma_don');
    }
}
