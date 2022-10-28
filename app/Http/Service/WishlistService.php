<?php

namespace App\Http\Service;

use App\Http\Requests\WishList\CreateWishlistRequest;
use App\Http\Requests\WishList\ReadByWishlistIdRequest;
use App\Http\Requests\WishList\UpdateWishlistRequest;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Wishlist;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use Illuminate\Http\JsonResponse;

class WishlistService
{
    use ResponseUtil;

    public function create(CreateWishlistRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request);
            //TODO ACTION

            //find customer
            $customer = Customer::find($request['wishlistCustomerId']);
            $product = Product::find($request['wishlistProductId']);

            if (!$customer || !$product) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD, "UNABLE TO LOCATE CUSTOMER");
            //todo create wishlist through product relation
            $response = $customer->wishlists()->create(array_merge($request->all(),['wishlistStatus'=>'ACTIVE']));
            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);

            return $this->SUCCESS_RESPONSE("WISHLIST CREATED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

//    public function update(UpdateWishlistRequest $request): JsonResponse
//    {
//        try {
//            //TODO VALIDATION
//            $request->validated($request);
//            //TODO ACTION
//            $wishList = Wishlist::where('wishlistId', $request['wishlistId'])->first();
//                 if (!$wishList) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD, "UNABLE TO LOCATE WISHLIST");
//            $response = $wishList->update(array_merge($request->except('wishlistId'),
//                ['wishlistStatus'=>'ACTIVE']));
//            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_UPDATE);
//            return  $this->SUCCESS_RESPONSE("WISHLIST UPDATED SUCCESSFUL");
//        }catch (Exception $ex){
//            return $this->ERROR_RESPONSE($ex->getMessage());
//        }
//    }

    public function read(): JsonResponse
    {
        try {
            $wishlists = Wishlist::all();
            if (!$wishlists)  throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->BASE_RESPONSE($wishlists);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function readById(ReadByWishlistIdRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request->all());
            //todo action
            $wishlist = Wishlist::where('wishlistId', $request['wishlistId'])->first();
            if (!$wishlist) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);

            return  $this->BASE_RESPONSE($wishlist);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function delete(ReadByWishlistIdRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request->all());
            $wishList = Wishlist::where('wishlistId', $request['wishlistId'])->first();
            if (!$wishList) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            if (!$wishList->delete()) throw new ExceptionUtil(ExceptionCase::SOMETHING_WENT_WRONG);

            return  $this->SUCCESS_RESPONSE("WISHLIST DELETED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }
}
