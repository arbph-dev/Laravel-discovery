<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;// 2025-05-05
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\UserRole;
use App\UserProviderType;


class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
	 
	protected $casts = [
		'email_verified_at' => 'datetime',
		'role' => UserRole::class,
		'provider_type' => UserProviderType::class,
		'password' => 'hashed',
	];	 
	/* laravel 12 
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
			'role' => UserRole::class,
			'provider_type' => UserProviderType::class,
            'password' => 'hashed',
        ];
    }*/
}
