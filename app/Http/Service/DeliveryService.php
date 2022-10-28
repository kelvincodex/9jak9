<?php

namespace App\Http\Service;

use App\Http\Requests\Authentication\InitiateEnrollmentRequest;
use App\Http\Requests\Delivery\CreateDeliveryRequest;
use App\Http\Requests\Delivery\ReadByDeliveryIdRequest;
use App\Http\Requests\Delivery\UpdateDeliveryRequest;
use App\Mail\OtpMail;
use App\Models\Customer;
use App\Models\Delivery;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use function MongoDB\BSON\toJSON;


class DeliveryService
{
    use ResponseUtil;

    public function create(CreateDeliveryRequest $request): JsonResponse
    {
        try {

            //todo validate
            $request->validated($request);
            $testDelivery = Delivery::where('deliveryState', $request['deliveryState'])->first();
            //todo action
            $delivery = Delivery::create([
                'deliveryState'=>$request['deliveryState'],
                'deliveryStatus'=>$request['deliveryStatus'],
                'deliveryFee'=>$request['deliveryFee'],
                'deliveryDescription'=>$request['deliveryDescription']
            ]);

            //todo check its successful
            if (!$delivery) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);

            return $this->SUCCESS_RESPONSE("CREATED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function update(UpdateDeliveryRequest $request): JsonResponse
    {
        try {
            //todo validate
            $request->validated($request);
            //todo action
             $delivery = Delivery::where('deliveryId', $request['deliveryId'])->first();
             if (!$delivery) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            $response =    $delivery->update([
                'deliveryState'=>$request['deliveryState'],
                'deliveryStatus'=>$request['deliveryStatus'],
                'deliveryFee'=>$request['deliveryFee'],
                'deliveryDescription'=>$request['deliveryDescription']
            ]);
            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_UPDATE);

            return $this->SUCCESS_RESPONSE("UPDATE SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }



    public function read(): JsonResponse
    {
        try {
            $delivery = Delivery::all();
            if (!$delivery)  throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->BASE_RESPONSE($delivery);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }

    public function readById(ReadByDeliveryIdRequest $request): JsonResponse
    {
        try {
            //todo validation
            $request->validated($request->all());

            //todo action
            $delivery = Delivery::where('deliveryId', $request['deliveryId'])->first();
            if (!$delivery) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            return  $this->BASE_RESPONSE($delivery);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }
}
