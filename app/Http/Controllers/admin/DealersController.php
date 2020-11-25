<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DealersRequest;
use App\Http\Resources\DealersResource;
use App\Models\Dealers;
use App\Services\DealersService;
use App\Traits\JsonRespondController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DealersController extends Controller
{
    use JsonRespondController;

    /**
     * Get the list of dealers.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $dealers =  DealersResource::collection($this->service()->query()->paginate(20));
        }catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return  $dealers;
    }

    /**
     * Store the dealer.
     *
     * @param Request $request
     *
     * @return DealersResource|\Illuminate\Http\JsonResponse
     */
    public function store(DealersRequest $request)
    {
        try {
            $dealer = $this->service()->create($request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new DealersResource($dealer);
    }

    /**
     * Get the detail of a given dealer.
     *
     * @param Request $request
     * @param $dealersId
     *
     * @return DealersResource|\Illuminate\Http\JsonResponse
     */
    public function show($dealersId)
    {
        try {
            $dealer = $this->service()->find($dealersId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        }

        return new DealersResource($dealer);
    }

    /**
     * Update the dealer.
     *
     * @param Request $request
     * @param int $dealersId
     *
     * @return DealersResource|\Illuminate\Http\JsonResponse
     */
    public function update($dealersId, DealersRequest  $request)
    {
        try {
            $this->service()->update($dealersId, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new DealersResource(Dealers::query()->findOrFail($dealersId));
    }

    /**
     * Get the list of dealers for the given contact.
     *
     * @param int $dealersId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function destroy($dealersId)
    {
        try {
            $this->service()->delete($dealersId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        }

        return $this->respondObjectDeleted($dealersId);
    }

    public function service()
    {
        return new DealersService();
    }
}
