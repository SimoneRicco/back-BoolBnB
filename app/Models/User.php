<?php

namespace App\Models;

use App\Models\Apartment;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

   
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'birth_date',
        'image',
        'password',
    ];

    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function apartments()
    {
        return $this->hasMany(Apartment::class);
    }

    public function getFormattedBirthDateAttribute()
    {
        return $this->birth_date->format('d/m/Y'); // Formato: giorno/mese/anno
    }
}
