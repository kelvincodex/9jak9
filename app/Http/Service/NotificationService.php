<?php

namespace App\Http\Service;

use App\Http\Requests\Notification\CreateNotificationRequest;
use App\Models\Notification;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use Illuminate\Http\JsonResponse;

class NotificationService
{
    use ResponseUtil;

    public function create(CreateNotificationRequest $request): JsonResponse
    {
        try {
            //todo  validate
            $request->validated();

            //todo  action
            $notification = Notification::create($request->all());

            //todo  check if successful
            if (!$notification) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);

            return $this->SUCCESS_RESPONSE("CREATED SUCCESSFUL");
        } catch (Exception $ex) {
            return $this->ERROR_RESPONSE($ex->getMessage());
        }

    }


    public function read(): JsonResponse
    {
        try {
            $notification = Notification::all();
            if (!$notification) throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->BASE_RESPONSE($notification);
        } catch (Exception $ex) {
            return $this->ERROR_RESPONSE($ex->getMessage());
        }


    }
}
