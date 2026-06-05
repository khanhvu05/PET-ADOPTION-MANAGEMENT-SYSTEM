<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    protected $primaryKey = 'Ma_nguoi_dung';
    public $incrementing  = false;
    protected $keyType    = 'string';

    const CREATED_AT = 'Ngay_tao';
    const UPDATED_AT = 'Ngay_cap_nhat';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'Ma_nguoi_dung',
        'Ten_dang_nhap',
        'Ho_ten',
        'Email',
        'Mat_khau_hash',
        'So_dien_thoai',
        'Dia_chi',
        'Ngay_sinh',
        'Loai_tai_khoan',
        'Nguon_dang_ky',
        'Anh_dai_dien',
        'Trang_thai',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'Mat_khau_hash',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'Mat_khau_hash' => 'hashed',
        ];
    }

    // Tự sinh UUID khi tạo
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->Ma_nguoi_dung)) {
                $model->Ma_nguoi_dung = \Illuminate\Support\Str::uuid()->toString();
            }
        });
    }

    /**
     * Override method password field for authentication
     */
    public function getAuthPasswordName()
    {
        return 'Mat_khau_hash';
    }

    public function getAuthPassword()
    {
        return $this->Mat_khau_hash;
    }

    /**
     * Check if the user has admin role.
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Check if the user has staff or admin role.
     */
    public function isStaff(): bool
    {
        return $this->hasAnyRole(['admin', 'staff']);
    }

    /**
     * Accessor for email (lowercase) to map to Email column
     */
    public function getEmailAttribute()
    {
        return $this->attributes['Email'] ?? null;
    }
}
