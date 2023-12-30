<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class tni_al extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tni_al';
    protected $primaryKey = 'nrp';
    protected $fillable = [
        'nrp',
        'nama_lengkap',
        'pangkat',
        'jabatan',
        'no_hp',
        
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
