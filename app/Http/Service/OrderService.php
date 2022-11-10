<?php

namespace App\Http\Service;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Requests\OrderDetails\CreateOrderDetailsRequest;
use App\Http\Requests\OrderItems\CreateOrderItemsRequest;
use App\Models\BankDetails;
use App\Models\Order;
use App\Models\OrderItems;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use \Illuminate\Http\JsonResponse;


class OrderService
{
    use ResponseUtil;



    public function create(CreateOrderRequest $createOrderRequest,
                           CreateOrderDetailsRequest $createOrderDetailsRequest,
                           CreateOrderItemsRequest $createOrderItemsRequest): JsonResponse
    {
        try {
            $createOrderRequest->validated();
            $createOrderItemsRequest->validated();
            $createOrderDetailsRequest->validated();

            //create order
            $order = Order::create($createOrderRequest->validated());

           //check if it was created
            if (!$order)
                throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE, "On able to create order");

            //create order items
            foreach ($createOrderItemsRequest["orderItems"] as $orderItem){

               $orderItem = $order->orderItems()->create([
                   'orderItemsTotalPrice'=>$orderItem['orderItemsTotalPrice'],
                   'orderItemsQuantity'=>$orderItem['orderItemsQuantity'],
                   'orderItemsProductId'=>$orderItem['orderItemsProductId'],
               ]);

                if (!$orderItem)
                    throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE, "On able to create order items");
            }

            //create order details
           $orderDetails = $order->orderDetails()->create($createOrderDetailsRequest->validated());
            if (!$orderDetails)
                throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE, "On able to create order details");

            $orderItems = OrderItems::where("orderItemsOrderId", $order['orderId'])->get();
            //dd($order->toArray(), $orderDetails->toArray(), $orderItems->toArray());

            $bankDetail = BankDetails::first();

            $data[] = array_merge($order->toArray(),[
                'orderDetails'=>$orderDetails->toArray(),
                'orderItems'=>$orderItems->toArray(),
                'bankDetail'=>$bankDetail ?? null
            ]);

            return $this->BASE_RESPONSE($data);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

   public function update(UpdateOrderRequest $request): JsonResponse
    {
        try {
            //todo  validate
            $request->validated();
            //todo  action
             $order = Order::where('orderId', $request['orderId'])->first();
             if (!$order) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            $response =    $order->update(['orderStatus'=>$request['orderStatus']]
            );
            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_UPDATE);

            return $this->SUCCESS_RESPONSE("UPDATE SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }



    public function read(): JsonResponse
    {
        try {
            $order = Order::all();
            if (!$order)  throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->BASE_RESPONSE($order);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function readById(ReadByBankDetailsIdRequest $request): JsonResponse
    {
        try {
            //todo validation
            $request->validated($request->all());

            //todo action
            $order = Order::where('orderId', $request['orderId'])->first();
            if (!$order) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            return  $this->BASE_RESPONSE($order);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }
}
