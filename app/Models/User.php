<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


/**
 * Class User
 *
 * @OA\Schema(
 *     schema="User",
 *     title="User",
 *     description="Classe Usuário",
 *     @OA\Property(property="id", type="integer", example="1"),
 *     @OA\Property(property="username", type="string", example="teste"),
 *     @OA\Property(property="email", type="string", example="teste@example.com"),
 *     @OA\Property(property="email_verified_at", type="datetime", example="2021-09-16T14:34:11.000000Z"),
 *     @OA\Property(property="created_at", type="datetime", example="2021-09-16T14:34:11.000000Z"),
 * )
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'username', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function employee() {
        return $this->hasOne(Employee::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

}
