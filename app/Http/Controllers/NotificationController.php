<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notification\CreateNotificationRequest;
use App\Http\Service\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    use ResponseUtil;
    public function __construct(protected NotificationService $notificationService){
        //todo no code here
    }

    public function create(CreateNotificationRequest $request): JsonResponse
    {
        return $this->notificationService->create($request);
    }

    public function read(): JsonResponse
    {
        return $this->notificationService->read();
    }
}
