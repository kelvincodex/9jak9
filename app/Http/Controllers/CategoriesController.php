<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\ReadByIdCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Service\CategoryService;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class CategoriesController extends Controller
{
    use ResponseUtil;
    public function __construct(protected CategoryService $categoryService){

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
    public function readById(ReadByIdCategoryRequest $request): JsonResponse
    {

            return $this->categoryService->readById($request);
    }
    public function delete(ReadByIdCategoryRequest $request): JsonResponse
    {
        return $this->categoryService->delete($request);
    }
}
