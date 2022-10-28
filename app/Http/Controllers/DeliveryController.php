<?php

namespace App\Http\Controllers;

use App\Http\Requests\Delivery\CreateDeliveryRequest;
use App\Http\Requests\Delivery\UpdateDeliveryRequest;
use App\Http\Requests\Delivery\ReadByDeliveryIdRequest;
use App\Http\Service\deliveryService;
use App\Models\Delivery;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use Illuminate\Http\JsonResponse;

class DeliveryController extends Controller
{
    use ResponseUtil;

    public function __construct(protected DeliveryService $deliveryService){
        $this->deliveryService = $deliveryService;
    }


    public function create(CreateDeliveryRequest $request): JsonResponse
    {
      return  $this->deliveryService->create($request);
    }



    public function update(UpdateDeliveryRequest $request): JsonResponse
    {
      return  $this->deliveryService->update($request);
    }

    public function read(): JsonResponse
    {

        return $this->deliveryService->read();
    }

    public function readById(ReadByDeliveryIdRequest $request): JsonResponse
    {
       return $this->deliveryService->readById($request);
    }
}
