<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\FilterProductByPriceRequest;
use App\Http\Requests\Product\ReadByProductIdRequest;
use App\Http\Requests\Product\ReadProductByCategoryIdRequest;
use App\Http\Requests\Product\ReadProductBySubCategoryIdRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Service\ProductService;
use Illuminate\Http\JsonResponse;

class ProductsController extends Controller
{
    public function __construct(protected ProductService $productService){
        //todo no code here
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

    public function readById(ReadByProductIdRequest $request): JsonResponse
    {
        return $this->productService->readById($request);
    }

    public function readProductByCategoryId(ReadProductByCategoryIdRequest $request): JsonResponse
    {
        return $this->productService->readProductByCategoryId($request);
    }

    public function readProductBySubCategoryId(ReadProductBySubCategoryIdRequest $request): JsonResponse
    {
        return $this->productService->readProductBySubCategoryId($request);
    }

    public function filterProductBySellingPrice(FilterProductByPriceRequest $request): JsonResponse
    {
        return $this->productService->filterProductBySellingPrice($request);
    }

    public function delete(ReadByProductIdRequest $request): JsonResponse
    {
        return $this->productService->delete($request);
    }
}
