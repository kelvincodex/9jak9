<?php

namespace App\Http\Service;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\ReadByIdProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\URL;
use function GuzzleHttp\Promise\all;

class ProductService
{
    use ResponseUtil;

    public function create(CreateProductRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request);
            //TODO ACTION
            $category = Category::find($request['productCategoryId']);
            $brand = Brand::find($request['productBrandId']);
            if (!$category || !$brand) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD, "INVALID BRAND ID");

          /*todo check if file exist */
            if (!$request->hasFile('productImage'))
                throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD, "COULDN'T NOT FIND IMAGE");
            $fileName = time().'_'.$request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->move(public_path('storage/uploads'), $fileName);

            $response = $category->products()->create(array_merge($request->all(), [
//                'productImage'=> "public/storage/uploads/$fileName",
                'productImage'=> URL::asset("storage/uploads/$fileName"),
                "productStatus"=>'ACTIVE'
            ]));
            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);

            return $this->SUCCESS_RESPONSE("PRODUCT CREATED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function update(UpdateProductRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request);
            //TODO ACTION
            $product = Product::find($request['productId']);
            if (!$product) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD, "UNABLE TO LOCATE PRODUCT");
            $response = $product->update(array_merge($request->except('productId'),
                ['productStatus'=>'ACTIVE']));
            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_UPDATE);
            return  $this->SUCCESS_RESPONSE("PRODUCT UPDATED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }
    public function read(): JsonResponse
    {
        try {
            $products = Product::all();
            if (!$products)  throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->BASE_RESPONSE($products);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function readById(ReadByIdProductRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request->all());
            //todo action
            $product = Product::where('productId', $request['productId'])->first();
            if (!$product) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            return  $this->BASE_RESPONSE($product);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function delete(ReadByIdProductRequest $request){
        try {
            //TODO VALIDATION
            $request->validated($request->all());
            $product = Product::where('productId', $request['productId'])->first();
            if (!$product) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);

            if (!$product->delete()) throw new ExceptionUtil(ExceptionCase::SOMETHING_WENT_WRONG);
            return  $this->SUCCESS_RESPONSE("PRODUCT DELETED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

}
