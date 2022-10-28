<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Order extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'orders';
    protected $primaryKey ='orderId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'orderSubTotalPrice',
        'orderStatus',
        'orderTotalPrice',
        'orderProductName',
        'orderProductId',
        'orderProductQuantity',
        'orderProductVariation',
        'orderProductPrice',
        'orderAddress',
        'orderFullName',
        'orderEmail'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'orderProductId', 'productId');
    }


}
