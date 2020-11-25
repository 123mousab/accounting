<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Http\Resources\StoreResource;
use App\Models\store;
use App\Services\StoreService;
use App\Traits\JsonRespondController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StoreController extends Controller
{
    use JsonRespondController;

    /**
     * Get the list of stores.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $stores =  StoreResource::collection($this->service()->query()->paginate(20));
        }catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return  $stores;
    }

    /**
     * Store the store.
     *
     * @param Request $request
     *
     * @return StoreResource|\Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            $store = $this->service()->create($request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new StoreResource($store);
    }

    /**
     * Get the detail of a given store.
     *
     * @param Request $request
     * @param $storeId
     *
     * @return StoreResource|\Illuminate\Http\JsonResponse
     */
    public function show($storeId)
    {
        try {
            $store = $this->service()->find($storeId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        }

        return new StoreResource($store);
    }

    /**
     * Update the store.
     *
     * @param Request $request
     * @param int $storeId
     *
     * @return StoreResource|\Illuminate\Http\JsonResponse
     */
    public function update($storeId, StoreRequest  $request)
    {
        try {
            $this->service()->update($storeId, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new StoreResource(Store::query()->findOrFail($storeId));
    }

    /**
     * Get the list of stores for the given contact.
     *
     * @param int $storeId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function destroy($storeId)
    {
        try {
            $this->service()->delete($storeId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        }

        return $this->respondObjectDeleted($storeId);
    }

    public function service()
    {
        return new StoreService();
    }
}
