<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\ReadByIdProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Service\ProductService;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __construct(protected ProductService $productService){

    }

    public function create(CreateProductRequest $request): JsonResponse
    {
        return $this->productService->create($request);
    }
    public function update(UpdateProductRequest $request): JsonResponse
    {
        return $this->productService->update($request);
    }
    public function read(): JsonResponse
    {
        return $this->productService->read();
    }
    public function readById(ReadByIdProductRequest $request): JsonResponse
    {
        return $this->productService->readById($request);
    }
    public function delete(ReadByIdProductRequest $request): JsonResponse
    {
        return $this->productService->delete($request);
    }
}
