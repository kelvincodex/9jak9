<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\ReadByCategoryIdRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Service\CategoryService;
use App\Util\baseUtil\ResponseUtil;
use Illuminate\Http\JsonResponse;


class CategoriesController extends Controller
{
    use ResponseUtil;
    public function __construct(protected CategoryService $categoryService){
        //todo no code here
    }
    public function create(CreateCategoryRequest $request): JsonResponse
    {
        return $this->categoryService->create($request);
    }
    public function update(UpdateCategoryRequest $request): JsonResponse
    {
        return $this->categoryService->update($request);
    }
    public function read(): JsonResponse
    {
        return $this->categoryService->read();
    }
    public function readById(ReadByCategoryIdRequest $request): JsonResponse
    {

            return $this->categoryService->readById($request);
    }
    public function delete(ReadByCategoryIdRequest $request): JsonResponse
    {
        return $this->categoryService->delete($request);
    }
}
