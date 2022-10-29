<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishList\CreateWishlistRequest;
use App\Http\Requests\WishList\ReadByWishlistIdRequest;
use App\Http\Requests\WishList\UpdateWishlistRequest;
use App\Http\Service\WishlistService;
use App\Util\baseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WishlistsController extends Controller
{
    use ResponseUtil;

    public function __construct(protected WishlistService $wishListService){
        //todo no code here
    }


    public function create(CreateWishlistRequest $request): JsonResponse
    {
        return  $this->wishListService->create($request);
    }


    public function update(UpdateWishlistRequest $request): JsonResponse
    {
        return  $this->wishListService->update($request);
    }

    public function read(): JsonResponse
    {

        return $this->wishListService->read();
    }

    public function readById(ReadByWishlistIdRequest $request): JsonResponse
    {
        return $this->wishListService->readById($request);
    }

    public function delete(ReadByWishlistIdRequest $request): JsonResponse
    {
        return $this->wishListService->delete($request);
    }
}
