<?php

namespace App\Http\Repository\RepositoryImpl;

use App\Http\Repository\DeliveryRepository;
use App\Models\Delivery;

class DeliveryRepositoryImpl implements DeliveryRepository
{

    public function create(Delivery $delivery, $data=[])
    {
        // TODO: Implement create() method.
        return $delivery->create($delivery);
    }

    public function update(Delivery $delivery, $data=[])
    {
        // TODO: Implement update() method.
    }

    public function read(Delivery $delivery)
    {
        // TODO: Implement read() method.
    }

    public function readById(Delivery $delivery, $id)
    {
        // TODO: Implement readById() method.
    }
}
