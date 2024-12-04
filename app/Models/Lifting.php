<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create( array $validated )
 * @method static latest()
 */
class Lifting extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['ddHouse'];

    protected $casts = [
        'products' => 'array',
    ];


    public function getProductAttribute(): string
    {
        dd($this->products);
//        return number_format($this->amount, 0, '.', ',') . ' Tk';

    }

    public function ddHouse(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DdHouse::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
