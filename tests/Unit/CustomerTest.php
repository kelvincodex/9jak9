<?php


class CustomerTest extends \Tests\TestCase
{


    public function test_read_by_id(){
        $service = new \App\Http\Controllers\CustomersController(new \App\Service\CustomerService());
        $service->read();
    }
}
