<?php

namespace App\Http\Service;

use App\Http\Requests\Brand\CreateBrandRequest;
use App\Http\Requests\Brand\ReadByBrandIdRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\ReadByCategoryIdRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use Illuminate\Http\JsonResponse;

class BrandService
{
    use ResponseUtil;

    public function create(CreateBrandRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request->all());
            //TODO ACTION
            $response = Brand::create(array_merge($request->all(),
                ['brandStatus'=>'ACTIVE']));
            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);

            return $this->SUCCESS_RESPONSE("BRAND CREATED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function update(UpdateBrandRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request->all());
            //TODO ACTION
            $brand = Brand::find($request['brandId']);
            if (!$brand) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            $response = $brand->update(array_merge($request->except('brandId'),
                ['brandStatus'=>'ACTIVE']));
            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);
            return  $this->SUCCESS_RESPONSE("BRAND UPDATED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }
    public function read(): JsonResponse
    {
        try {
            $brand = Brand::all();
            if (!$brand)  throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->BASE_RESPONSE($brand);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function readById(ReadByBrandIdRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request->all());
            //todo action
            $brand = Brand::where('brandId', $request['brandId'])->first();
            if (!$brand) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            return  $this->BASE_RESPONSE($brand);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function delete(ReadByBrandIdRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request->all());
            $brand = Brand::where('brandId', $request['brandId'])->first();
            if (!$brand) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            if (!$brand->delete()) throw new ExceptionUtil(ExceptionCase::SOMETHING_WENT_WRONG);

            return  $this->SUCCESS_RESPONSE("BRAND DELETED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }
}
