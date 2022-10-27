<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'customers';
    protected $primaryKey ='customerId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customerFirstName',
        'customerLastName',
        'customerPhoneNo',
        'customerEmail',
        'customerAddress',
        'customerState',
        'customerPassword',
        'customerStatus',
        'customerOtp',
        'customerOtpExpired',
        'isSuperAdmin',
        'isAdmin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'customerPassword',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'wishlistCustomerId', 'customerId');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'orderCustomerId', 'customerId');
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class,'cartCustomerId', 'customerId');
    }
}
