<?php

namespace App\Http\Repository\RepositoryImpl;

use App\Http\Repository\CartRepository;
use App\Models\Cart;

class CartRepositoryImpl implements CartRepository
{

    public function create(Cart $cart, $data=[])
    {
        // TODO: Implement create() method.
        return $cart->create($cart);
    }

    public function update(Cart $cart, $data=[])
    {
        // TODO: Implement update() method.
    }

    public function read(Cart $cart)
    {
        // TODO: Implement read() method.
    }

    public function readById(Cart $cart, $id)
    {
        // TODO: Implement readById() method.
    }
}
