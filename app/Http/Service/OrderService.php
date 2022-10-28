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

            //  validate
            $request->validated($request);
            //  action
            $delivery = Delivery::find($request['orderDeliveryId']);
            if (!$delivery) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);

            $order = Order::create(array_merge($request->all(),['orderStatus'=>'PENDING']));

            //  check if successful
            if (!$order) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);
            //  send email
            // mark all items in the cart as pending
            $customer = Customer::find($request['orderCustomerId']);
            $email =  Mail::to($customer['customerEmail'])->send(new OrderSuccessfulMail());
            //check if email sent
            if (!$email) throw new ExceptionUtil(ExceptionCase::SOMETHING_WENT_WRONG);

            return $this->SUCCESS_RESPONSE("CREATED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function update(UpdateOrderRequest $request): JsonResponse
    {
        try {
            //  validate
            $request->validated($request);
            //  action
             $delivery = Order::where('orderId', $request['orderId'])->first();
             if (!$delivery) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            $response =    $delivery->update(['orderStatus'=>$request['orderStatus']]
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
            $delivery = Order::all();
            if (!$delivery)  throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->BASE_RESPONSE($delivery);
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
            $delivery = Order::where('orderId', $request['orderId'])->first();
            if (!$delivery) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            return  $this->BASE_RESPONSE($delivery);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }
}
