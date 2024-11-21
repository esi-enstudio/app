<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static search($search)
 */
class Retailer extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];
    protected $with = ['user','rso','ddHouse'];

    protected array $searchable = [
        'code',
        'number',
        'name',
        'user.name',
        'user.phone',
        'ddHouse.code',
        'ddHouse.name',
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

    /**
     * Relationship with User model
     *
     * @return BelongsTo
     */
    public function rso(): BelongsTo
    {
        return $this->belongsTo(Rso::class);
    }

    /**
     * Relationship with User model
     *
     * @return BelongsTo
     */
    public function ddHouse(): BelongsTo
    {
        return $this->belongsTo(DdHouse::class);
    }
}
