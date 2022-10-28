<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $table ='products';
    protected $primaryKey ='productId';

    protected  $fillable=[
        'productName',
        'productSellingPrice',
        'productOfferPrice',
        'productImage',
        'productDescription',
        'productDiscount',
        'productQuantity',
        'productSlug',
        'productStatus'
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'orderProductId', 'productId');
    }

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'productCategoryId', 'categoryId');
    }

    public function wishLists(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'wishListProductId', 'productId');
    }
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'cartProductId', 'productId');
    }


}
