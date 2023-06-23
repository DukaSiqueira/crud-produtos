<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Campos que podem ser preenchidos.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name','email','password'];

    /**
     * Campos que devem ser escondidos.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password','remember_token',];

    /**
     * Muda como os campos são exibidos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //  Necessário para o JWT serve como identificação do token de autenticação
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
