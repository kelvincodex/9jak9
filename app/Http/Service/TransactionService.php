<?php

namespace App\Http\Service;

use App\Http\Requests\Transaction\CreateTransactionRequest;
use App\Models\Order;
use App\Models\Transaction;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use Illuminate\Http\JsonResponse;

class TransactionService
{
    use ResponseUtil;

    public function create(CreateTransactionRequest $request): JsonResponse
    {
        try {
            //todo  validate
            $request->validated();

            //todo  action
            $order = Order::find($request['transactionOrderId']);
            $transaction = $order->transactions()->create($request->all());

            //todo  check if successful
            if (!$transaction) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);

            return $this->SUCCESS_RESPONSE("CREATED SUCCESSFUL");
        } catch (Exception $ex) {
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }


    public function read(): JsonResponse
    {
        try {
            $transaction = Transaction::all();
            if (!$transaction) throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->BASE_RESPONSE($transaction);
        } catch (Exception $ex) {
            return $this->ERROR_RESPONSE($ex->getMessage());
        }


    }
}
