<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $table = "order_items";
    protected $primaryKey = "orderItemsId";

    protected $fillable =[
        'orderItemsTotalPrice',
        'orderItemsQuantity',
        'orderItemsStatus',
        'orderItemsProductId',
        'orderItemsOrderId',
    ];

}
