<?php

namespace App\Http\Repository;

use App\Models\Delivery;

interface DeliveryRepository
{
    public function create(Delivery $delivery, $data=[]);
    public function update(Delivery $delivery, $data=[]);
    public function read(Delivery $delivery);
    public function readById(Delivery $delivery, $id);
}
