<?php

namespace App\Http\Repository\RepositoryImpl;

use App\Http\Repository\OrderRepository;
use App\Models\Order;

class OrderRepositoryImpl implements OrderRepository
{

    public function create(Order $order, $data=[])
    {
        // TODO: Implement create() method.
        return $order->create($order);
    }

    public function update(Order $order, $data=[])
    {
        // TODO: Implement update() method.
    }

    public function read(Order $order)
    {
        // TODO: Implement read() method.
    }

    public function readById(Order $order, $id)
    {
        // TODO: Implement readById() method.
    }
}
