<?php

namespace App\Service;

use App\Http\Requests\SubCategory\CreateSubCategoryRequest;
use App\Http\Requests\SubCategory\ReadBySubCategoryIdRequest;
use App\Http\Requests\SubCategory\ReadSubCategoryByCategoryId;
use App\Http\Requests\SubCategory\UpdateSubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use Illuminate\Http\JsonResponse;

class SubCategoryService
{
    use ResponseUtil;

    public function create(CreateSubCategoryRequest $request){
        try {
            //TODO VALIDATION
            $request->validated($request);
            //TODO ACTION
            $category = Category::find($request['subCategoryCategoryId']);
            if (!$category) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD, "UNABLE TO LOCATE CATEGORY");

            $response = $category->subCategories()->create($request->all());
            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);

            return $this->SUCCESS_RESPONSE("SUBCATEGORY CREATED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function update(UpdateSubCategoryRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request);
            //TODO ACTION
            $category = Category::find($request['subCategoryCategoryId']);
            //todo check if category exist
            if (!$category) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);

            $subCategory = SubCategory::find($request['subCategoryId']);
            if (!$subCategory) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);

            $response = $subCategory->update($request->except('categoryId'));
            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_UPDATE);
            return  $this->SUCCESS_RESPONSE("SUBCATEGORY UPDATED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }
    public function read(): JsonResponse
    {
        try {
            $SubCategories = SubCategory::all();
            if (!$SubCategories)  throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->BASE_RESPONSE($SubCategories);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function readById(ReadBySubCategoryIdRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated();
            //todo action
            $subCategory = SubCategory::where('subCategoryId', $request['subCategoryId'])->first();
            if (!$subCategory) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            return  $this->BASE_RESPONSE($subCategory);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function readByCategoryId(ReadSubCategoryByCategoryId $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request->all());
            //todo action
            $subCategory = SubCategory::where('subCategoryCategoryId', $request['subCategoryCategoryId'])->get();
            if (!$subCategory) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            return  $this->BASE_RESPONSE($subCategory);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function delete(ReadBySubCategoryIdRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request->all());
            $category = SubCategory::where('subCategoryId', $request['subCategoryId'])->first();
            if (!$category) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            if (!$category->delete()) throw new ExceptionUtil(ExceptionCase::SOMETHING_WENT_WRONG);

            return  $this->SUCCESS_RESPONSE("CATEGORY DELETED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }
}
