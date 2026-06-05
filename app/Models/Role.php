<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'Ma_vai_tro';
    public $incrementing = false;
    protected $keyType = 'string';
    
    const CREATED_AT = 'Ngay_tao';
    const UPDATED_AT = 'Ngay_cap_nhat';

    protected $fillable = ['Ma_vai_tro', 'Ten_vai_tro', 'slug', 'Mo_ta'];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->Ma_vai_tro)) {
                $model->Ma_vai_tro = Str::uuid()->toString();
            }
        });
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles', 'Ma_vai_tro', 'Ma_nguoi_dung');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'Ma_vai_tro', 'Ma_quyen');
    }
}
