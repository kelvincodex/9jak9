<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Cart extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'carts';
    protected $primaryKey ='cartId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cartCustomerId',
        'cartProductId',
        'cartAddedQuantity',
        'cartStatus',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'cartCustomerId', 'customerId');
    }



    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'cartProductId', 'productId');
    }


}
