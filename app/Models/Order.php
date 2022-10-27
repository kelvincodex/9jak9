<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'orderCustomerId',
        'orderDeliveryId',
        'orderSubTotalPrice',
        'orderStatus',
        'orderTotalPrice',
    ];

    public function delivery():HasOne
    {
        return $this->hasOne(Delivery::class,'orderDeliveryId', 'deliveryId');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'orderCustomerId', 'customerId');
    }


}
