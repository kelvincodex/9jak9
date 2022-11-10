<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;


    protected $table = "order_details";
    protected $primaryKey = "orderDetailsId";

    protected $fillable=[
        'orderDetailsFirstName',
        'orderDetailsLastName',
        'orderDetailsEmail',
        'orderDetailsPhone',
        'orderDetailsAddress',
        'orderDetailsCompany',
        'orderDetailsNote',
        'orderDetailsOrderId',
        'orderDetailsStatus',
    ];

    protected $casts =[
        'created_at'=>'datetime:Y-m-d/H:i:s',
        'updated_at'=>'datetime:Y-m-d/H:i:s',
    ];

}
