<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PermissionCategory extends Model
{
    use HasFactory;

    protected $table = 'permission_categories';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function permission(): HasMany
    {
        return $this->hasMany(Permission::class, 'category_id', 'id');
    }
}
