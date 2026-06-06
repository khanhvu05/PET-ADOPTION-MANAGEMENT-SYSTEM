<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $primaryKey = 'Ma_quyen';
    public $incrementing = false;
    protected $keyType = 'string';
    
    const CREATED_AT = 'Ngay_tao';
    const UPDATED_AT = 'Ngay_cap_nhat';

    protected $fillable = ['Ma_quyen', 'Ten_quyen', 'slug', 'Mo_ta', 'Nhom_quyen'];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->Ma_quyen)) {
                $model->Ma_quyen = Str::uuid()->toString();
            }
        });
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions', 'Ma_quyen', 'Ma_vai_tro');
    }
}
