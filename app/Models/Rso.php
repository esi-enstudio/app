<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static when(mixed $search, \Closure $param)
 * @method static search(mixed $search)
 * @method static whereNotNull(string $string)
 */
class Rso extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    protected array $searchable = [
        'code',
        'number',
        'pool_number',
        'user.name',
        'user.phone'
    ];

    /**
     * Relationship with User model
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
