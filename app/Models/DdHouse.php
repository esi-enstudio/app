<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static latest()
 * @method static create(array $attributes)
 * @method static when(mixed $search, \Closure $param)
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property mixed $lifting_date
 * @property mixed $disabled_at
 */
class DdHouse extends Model
{
    use HasFactory;

    protected $guarded = [];
}
