<?php

namespace App\Http\Repository;

use App\Models\Order;

interface OrderRepository
{
    public function create(Order $order, $data=[]);
    public function update(Order $order, $data=[]);
    public function read(Order $order);
    public function readById(Order $order, $id);
}
