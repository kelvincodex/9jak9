<?php

namespace App\Http\Controllers;


use App\Http\Requests\SubCategory\CreateSubCategoryRequest;
use App\Http\Requests\SubCategory\ReadBySubCategoryIdRequest;
use App\Http\Requests\SubCategory\ReadSubCategoryByCategoryId;
use App\Http\Requests\SubCategory\UpdateSubCategoryRequest;
use App\Http\Service\SubCategoryService;
use App\Util\baseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;

class SubCategoryController extends Controller
{
    use ResponseUtil;
    public function __construct(protected SubCategoryService $subCategoryService){
        //todo no code here
    }
    public function create(CreateSubCategoryRequest $request): JsonResponse
    {
        return $this->subCategoryService->create($request);
    }
    public function update(UpdateSubCategoryRequest $request): JsonResponse
    {
        return $this->subCategoryService->update($request);
    }
    public function read(): JsonResponse
    {
        return $this->subCategoryService->read();
    }
    public function readById(ReadBySubCategoryIdRequest $request): JsonResponse
    {
        return $this->subCategoryService->readById($request);
    }
    public function readByCategoryId(ReadSubCategoryByCategoryId $request): JsonResponse
    {
        return $this->subCategoryService->readByCategoryId($request);
    }
    public function delete(ReadBySubCategoryIdRequest $request): JsonResponse
    {
        return $this->subCategoryService->delete($request);
    }
}
