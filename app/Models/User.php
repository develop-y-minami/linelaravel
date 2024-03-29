<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * User
 * 
 * 担当者情報
 * 
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use \App\Traits\Relations\BelongsToServiceProvider;
    use \App\Traits\Relations\BelongsToUserType;
    use \App\Traits\Relations\BelongsToUserAccountType;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'service_provider_id',
        'account_id',
        'name',
        'email',
        'password',
        'user_type_id',
        'user_account_type_id',
        'profile_image_file_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
