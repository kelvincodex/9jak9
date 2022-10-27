<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Delivery extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'deliveries';
    protected $primaryKey ='deliveryId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'deliveryState',
        'deliveryStatus',
        'deliveryMinFee',
        'deliveryMaxFee',
        'deliveryDescription',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'orderDeliveryId', 'deliveryId');
    }
}
