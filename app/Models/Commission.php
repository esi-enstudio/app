<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static search( mixed $search )
 * @method static create( array $attributes )
 */
class Commission extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];
    protected $with = ['ddHouse','user','rso','retailer'];
    protected array $searchable = [
        'for'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ddHouse(): BelongsTo
    {
        return $this->belongsTo(DdHouse::class);
    }

    public function zm(): BelongsTo
    {
        return $this->belongsTo(User::class, 'zm');
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager');
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'supervisor');
    }

    public function rso(): BelongsTo
    {
        return $this->belongsTo(Rso::class);
    }

    public function retailer(): BelongsTo
    {
        return $this->belongsTo(Retailer::class);
    }
}
