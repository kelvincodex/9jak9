<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Requests\Order\ReadByIdOrderRequest;
use App\Http\Service\orderService;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    use ResponseUtil;

    public function __construct(protected OrderService $orderService){
        $this->orderService = $orderService;
    }


    public function create(CreateOrderRequest $request): JsonResponse
    {
      return  $this->orderService->create($request);
    }



    public function update(UpdateOrderRequest $request): JsonResponse
    {
      return  $this->orderService->update($request);
    }

    public function read(): JsonResponse
    {

        return $this->orderService->read();
    }

    public function readById(ReadByIdOrderRequest $request): JsonResponse
    {
       return $this->orderService->readById($request);
    }
}
