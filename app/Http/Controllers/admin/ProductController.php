<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\product;
use App\Services\ProductService;
use App\Traits\JsonRespondController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    use JsonRespondController;

    /**
     * Get the list of products.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            return ProductResource::collection($this->service()->query()->paginate(20));
        }catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }
    }

    /**
     * Store the product.
     *
     * @param Request $request
     *
     * @return ProductResource|\Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request)
    {
        try {
            $category = $this->service()->create($request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new ProductResource($category);
    }

    /**
     * Get the detail of a given product.
     *
     * @param Request $request
     * @param $productId
     *
     * @return ProductResource|\Illuminate\Http\JsonResponse
     */
    public function show($productId)
    {
        try {
            $category = $this->service()->find($productId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        }

        return new ProductResource($category);
    }

    /**
     * Update the product.
     *
     * @param Request $request
     * @param int $productId
     *
     * @return ProductResource|\Illuminate\Http\JsonResponse
     */
    public function update($productId, ProductRequest  $request)
    {
        try {
            $this->service()->update($productId, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new ProductResource(Product::query()->findOrFail($productId));
    }

    /**
     * Delete on record of product table.
     *
     * @param int $productId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function destroy($productId)
    {
        try {
            $this->service()->delete($productId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        }

        return $this->respondObjectDeleted($productId);
    }

    public function service()
    {
        return new ProductService();
    }
}
