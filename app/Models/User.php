<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
