<?php

namespace App\Http\Repository;

use App\Models\Cart;

interface CartRepository
{
    public function create(Cart $cart, $data=[]);
    public function update(Cart $cart, $data=[]);
    public function read(Cart $cart);
    public function readById(Cart $cart, $id);
}
