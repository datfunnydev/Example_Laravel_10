<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RolePermission extends Model
{
    use HasFactory;

    protected $table = 'role_permissions';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'permission_id',
        'role_id',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'permission_id' => 'integer',
        'role_id' => 'integer',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'permission_id', 'id');
    }
}
