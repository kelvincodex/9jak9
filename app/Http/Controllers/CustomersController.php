<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\ReadByCustomerIdRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Service\CustomerService;
use App\Util\baseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;

class CustomersController extends Controller
{
    use ResponseUtil;

    public function __construct(protected CustomerService $customerService){
        //todo no code here
    }


    public function update(UpdateCustomerRequest $request): JsonResponse
    {
      return  $this->customerService->update($request);
    }

    public function read(): JsonResponse
    {

        return $this->customerService->read();
    }

    public function readDelivery(): String
    {

        return "This si response";
    }

    public function readById(ReadByCustomerIdRequest $request): JsonResponse
    {
       return $this->customerService->readById($request);
    }
}
