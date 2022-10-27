<?php

namespace App\Util\baseUtil;

use Illuminate\Http\JsonResponse;

trait ResponseUtil
{
    protected  function BASE_RESPONSE($data, $responseMessage="Successful", $responseCode=200): JsonResponse
    {

        return response()->json([
            "responseCode"=>$responseCode,
            "responseMessage"=>$responseMessage,
            "data"=>$data
        ]);
    }

     protected  function ERROR_RESPONSE($responseMessage, $responseCode=101): JsonResponse
        {

            return response()->json([
                "responseCode"=>$responseCode,
                "responseMessage"=>$responseMessage
            ]);
        }

        protected  function SUCCESS_RESPONSE($responseMessage): JsonResponse
        {

            return response()->json([
                "responseCode"=>"200",
                "responseMessage"=>$responseMessage
            ]);
        }

}
