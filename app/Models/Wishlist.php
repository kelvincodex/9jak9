<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wishlist extends Model
{
    use HasFactory;
    protected $table = 'wishlists';
    protected $primaryKey = 'wishlistId';

    protected $fillable =[
        'wishlistProductId',
        'wishlistStatus',
    ];

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class,'wishlistProductId', 'productId');
    }
}
