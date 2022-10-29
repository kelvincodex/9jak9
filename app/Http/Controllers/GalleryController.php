<?php

namespace App\Http\Controllers;

use App\Http\Requests\Delivery\CreateDeliveryRequest;
use App\Http\Requests\Delivery\ReadByDeliveryIdRequest;
use App\Http\Requests\Delivery\UpdateDeliveryRequest;
use App\Http\Requests\Gallery\CreateGalleryRequest;
use App\Http\Requests\Gallery\ReadByGalleryIdRequest;
use App\Http\Requests\Gallery\UpdateGalleryRequest;
use App\Http\Service\DeliveryService;
use App\Http\Service\GalleryService;
use App\Util\baseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    use ResponseUtil;

    public function __construct(protected GalleryService $galleryService){
        //todo no code here
    }


    public function create(CreateGalleryRequest $request): JsonResponse
    {
        return  $this->galleryService->create($request);
    }



    public function update(UpdateGalleryRequest $request): JsonResponse
    {
        return  $this->galleryService->update($request);
    }

    public function read(): JsonResponse
    {

        return $this->galleryService->read();
    }

    public function readById(ReadByGalleryIdRequest $request): JsonResponse
    {
        return $this->galleryService->readById($request);
    }
}
