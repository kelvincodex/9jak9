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

    protected $casts =[
        'created_at'=>'datetime:Y-m-d/H:i:s',
        'updated_at'=>'datetime:Y-m-d/H:i:s',
    ];

}
