<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogActivity extends Model
{
    use HasFactory;

    protected $table = 'log_activities';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'activity',
        'created_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
