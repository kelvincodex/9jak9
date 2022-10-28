<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\ReadByCustomerIdRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Service\CustomerService;
use App\Models\Customer;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use Illuminate\Http\JsonResponse;

class CustomersController extends Controller
{
    use ResponseUtil;

    public function __construct(protected CustomerService $customerService){
        $this->customerService = $customerService;
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
