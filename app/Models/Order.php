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
        'orderReference',
        'orderPaymentMethod',
    ];

    public function orderDetails(): HasOne
    {
        return $this->hasOne(OrderDetails::class, 'orderDetailsOrderId', 'orderId');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItems::class, 'orderItemsOrderId', 'orderId');
    }



}
