<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductTypeRequest;
use App\Http\Resources\ProductTypeResource;
use App\Models\ProductType;
use App\Services\ProductTypeService;
use App\Traits\JsonRespondController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductTypeController extends Controller
{
    use JsonRespondController;

    /**
     * Get the list of product_types.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $product_types =  ProductTypeResource::collection($this->service()->query()->paginate(20));
        }catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return  $product_types;
    }

    /**
     * Store the product_type.
     *
     * @param Request $request
     *
     * @return ProductTypeResource|\Illuminate\Http\JsonResponse
     */
    public function store(ProductTypeRequest $request)
    {
        try {
            $product_type = $this->service()->create($request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new ProductTypeResource($product_type);
    }

    /**
     * Get the detail of a given product_type.
     *
     * @param Request $request
     * @param $product_type_Id
     *
     * @return ProductTypeResource|\Illuminate\Http\JsonResponse
     */
    public function show($product_type_Id)
    {
        try {
            $product_type = $this->service()->find($product_type_Id);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        }

        return new ProductTypeResource($product_type);
    }

    /**
     * Update the product_type.
     *
     * @param Request $request
     * @param int $product_type_Id
     *
     * @return ProductTypeResource|\Illuminate\Http\JsonResponse
     */
    public function update($product_type_Id, ProductTypeRequest  $request)
    {
        try {
            $this->service()->update($product_type_Id, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new ProductTypeResource(ProductType::query()->findOrFail($product_type_Id));
    }

    /**
     * Get the list of product_types for the given contact.
     *
     * @param int $product_type_Id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function destroy($product_type_Id)
    {
        try {
            $this->service()->delete($product_type_Id);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        }

        return $this->respondObjectDeleted($product_type_Id);
    }

    public function service()
    {
        return new ProductTypeService();
    }
}
