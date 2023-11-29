<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'role_id',
        'pegawai_id',
        'nip',
        'password',
        'password_teks',
        'status_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function pegawai() {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function role() {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function status() {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
