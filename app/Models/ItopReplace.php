<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static search(mixed $search)
 * @method static create(array $attributes)
 * @method static firstWhere( string $string, mixed $dd_house_id )
 * @property mixed $dd_house_id
 * @property mixed $manager
 * @property mixed $rso_id
 * @property mixed $user_id
 * @property mixed $supervisor
 * @property mixed $zm
 * @property mixed $user
 * @property mixed $status
 * @property mixed $number
 */
class ItopReplace extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];
    protected $with = ['ddHouse','user','rso','retailer'];

    protected array $searchable = [
        'retailer.number',
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
