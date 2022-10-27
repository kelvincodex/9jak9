<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishList\CreateWishlistRequest;
use App\Http\Requests\WishList\ReadByIdWishlistRequest;
use App\Http\Requests\WishList\UpdateWishlistRequest;
use App\Http\Service\WishlistService;
use App\Util\baseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WishlistsController extends Controller
{
    use ResponseUtil;

    public function __construct(protected WishlistService $wishListService){
        $this->wishListService = $wishListService;
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

    public function readById(ReadByIdWishlistRequest $request): JsonResponse
    {
        return $this->wishListService->readById($request);
    }

    public function delete(ReadByIdWishlistRequest $request): JsonResponse
    {
        return $this->wishListService->delete($request);
    }
}
