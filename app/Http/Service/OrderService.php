<?php

namespace App\Http\Service;

use App\Http\Requests\Authentication\InitiateEnrollmentRequest;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\ReadByOrderIdRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Mail\OrderSuccessfulMail;
use App\Mail\OtpMail;
use App\Models\Customer;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\Product;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use function MongoDB\BSON\toJSON;


class OrderService
{
    use ResponseUtil;

    public function create(CreateOrderRequest $request): JsonResponse
    {
        try {
            $order= [];
            //todo  validate
            $request->validated();

            //todo  action
            foreach ($request['orderItem'] as $items){
                //todo check if product exist
                $product = Product::find($items['orderProductId']);
                if (!$product)
                    throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
                $data[] =[
                    'orderSubTotalPrice' => $request['orderSubTotalPrice'],
                    'orderTotalPrice'=>$request['orderTotalPrice'],
                    'orderProductQuantity'=>$items['orderProductQuantity'],
                    'orderProductVariation'=>$items['orderProductVariation'],
                    'orderProductPrice'=>$items['orderProductPrice'],
                    'orderAddress'=>$request['orderAddress'],
                    'orderFullName'=>$request['orderFullName'],
                    'orderEmail'=>$request['orderEmail'],
                    'orderProductName'=>$product['productName']
                ];
//                dd($data);
                 $order = $product->orders()->create(...$data);
            }

            //todo  check if successful
            if (!$order) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);

            return $this->SUCCESS_RESPONSE("CREATED SUCCESSFUL");
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

    public function readById(ReadByOrderIdRequest $request): JsonResponse
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
