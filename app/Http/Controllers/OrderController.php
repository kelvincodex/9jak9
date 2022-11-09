<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\CreateBankDetailsRequest;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\UpdateBankDetailsRequest;
use App\Http\Requests\Order\ReadByBankDetailsIdRequest;
use App\Http\Requests\OrderDetails\CreateOrderDetailsRequest;
use App\Http\Requests\OrderItems\CreateOrderItemsRequest;
use App\Http\Service\OrderService;
use App\Util\baseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    use ResponseUtil;

    public function __construct(protected OrderService $orderService){
        //todo no code here
    }


    public function create(CreateOrderRequest $createOrderRequest,
                           CreateOrderDetailsRequest $createOrderDetailsRequest,
                           CreateOrderItemsRequest $createOrderItemsRequest): JsonResponse
    {
      return  $this->orderService->create($createOrderRequest, $createOrderDetailsRequest, $createOrderItemsRequest);
    }



    public function update(UpdateBankDetailsRequest $request): JsonResponse
    {
      return  $this->orderService->update($request);
    }

    public function read(): JsonResponse
    {

        return $this->orderService->read();
    }

    public function readById(ReadByBankDetailsIdRequest $request): JsonResponse
    {
       return $this->orderService->readById($request);
    }
}
