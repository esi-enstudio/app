<?php

namespace App\Models;

 use Database\Factories\UserFactory;
 use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Relations\HasOne;
 use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

 /**
 * @method static create(array $user)
 * @method static latest()
 * @method static when()
 * @property mixed $created_at
  * @property mixed $updated_at
  * @property mixed $email_verified_at
  * @property mixed $disabled_at
  * @property mixed|string $created
  * @property mixed|string $updated
  * @property mixed|string $email_verified
  * @property mixed|string $disabled
  * @property mixed|string $remember
  * @property mixed $remember_token
  * @property mixed $avatar
  * @property mixed $id
  */
class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'avatar',
        'phone',
        'name',
        'email',
        'password',
        'role',
        'status',
        'remarks',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'disabled_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relationship with Zm model
     *
     * @return HasOne
     */
    public function zm()
    {
        return $this->hasOne(Zm::class);
    }

    /**
     * Relationship with Md model
     *
     * @return HasOne
     */
    public function md(): HasOne
    {
        return $this->hasOne(Md::class);
    }

    /**
     * Relationship with Manager model
     *
     * @return HasOne
     */
    public function manager(): HasOne
    {
        return $this->hasOne(Manager::class);
    }

    /**
     * Relationship with Supervisor model
     *
     * @return HasOne
     */
    public function supervisor(): HasOne
    {
        return $this->hasOne(Supervisor::class);
    }

    /**
     * Relationship with Rso model
     *
     * @return HasOne
     */
    public function rso(): HasOne
    {
        return $this->hasOne(Rso::class);
    }

    /**
     * Relationship with Retailer model
     *
     * @return HasOne
     */
    public function retailer(): HasOne
    {
        return $this->hasOne(Retailer::class);
    }

    /**
     * Relationship with Bp model
     *
     * @return HasOne
     */
    public function bp(): HasOne
    {
        return $this->hasOne(Bp::class);
    }

    /**
     * Relationship with Account model
     *
     * @return HasOne
     */
    public function account(): HasOne
    {
        return $this->hasOne(Account::class);
    }

    /**
     * Relationship with DmsOperator model
     *
     * @return HasOne
     */
    public function dmsOperator(): HasOne
    {
        return $this->hasOne(DmsOperator::class);
    }
}
