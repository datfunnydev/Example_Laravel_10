<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\hasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';

    /**
     * @var array
     */
    protected $fillable = [
        'avatar',
        'name',
        'email',
        'password',
        'type',
        'created_by',
        'last_login_at',
        'deleted_at',
        'token_reset',
        'remember_token',
        'gender',
        'phone',
        'brith_day',
        'address',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password',
        'token_reset',
        'remember_token',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'type' => 'integer',
        'created_by' => 'integer',
        'gender' => 'integer',
    ];

    public function roles(): belongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

    public function role(): hasOneThrough
    {
        return $this->hasOneThrough(Role::class, UserRole::class, 'user_id', 'id', 'id', 'role_id');
    }
}
