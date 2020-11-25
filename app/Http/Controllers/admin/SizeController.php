<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SizeRequest;
use App\Http\Resources\SizeResource;
use App\Models\Size;
use App\Services\SizeService;
use App\Traits\JsonRespondController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SizeController extends Controller
{
    use JsonRespondController;

    /**
     * Get the list of sizes.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $sizes =  SizeResource::collection($this->service()->query()->paginate(20));
        }catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return  $sizes;
    }

    /**
     * Store the size.
     *
     * @param Request $request
     *
     * @return SizeResource|\Illuminate\Http\JsonResponse
     */
    public function store(SizeRequest $request)
    {
        try {
            $size = $this->service()->create($request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new SizeResource($size);
    }

    /**
     * Get the detail of a given size.
     *
     * @param Request $request
     * @param $sizeId
     *
     * @return SizeResource|\Illuminate\Http\JsonResponse
     */
    public function show($sizeId)
    {
        try {
            $size = $this->service()->find($sizeId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        }

        return new SizeResource($size);
    }

    /**
     * Update the size.
     *
     * @param Request $request
     * @param int $sizeId
     *
     * @return SizeResource|\Illuminate\Http\JsonResponse
     */
    public function update($sizeId, SizeRequest  $request)
    {
        try {
            $this->service()->update($sizeId, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new SizeResource(Size::query()->findOrFail($sizeId));
    }

    /**
     * Get the list of sizes for the given contact.
     *
     * @param int $sizeId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function destroy($sizeId)
    {
        try {
            $this->service()->delete($sizeId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        }

        return $this->respondObjectDeleted($sizeId);
    }

    public function service()
    {
        return new SizeService();
    }
}
