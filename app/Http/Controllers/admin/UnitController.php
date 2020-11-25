<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnitRequest;
use App\Http\Resources\UnitResource;
use App\Models\Unit;
use App\Models\unite;
use App\Services\UnitService;
use App\Traits\JsonRespondController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UnitController extends Controller
{
    use JsonRespondController;

    /**
     * Get the list of unites.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $unites =  UnitResource::collection($this->service()->query()->paginate(20));
        }catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return  $unites;
    }

    /**
     * Store the unit.
     *
     * @param Request $request
     *
     * @return UnitResource|\Illuminate\Http\JsonResponse
     */
    public function store(UnitRequest $request)
    {
        try {
            $unit = $this->service()->create($request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new UnitResource($unit);
    }

    /**
     * Get the detail of a given unit.
     *
     * @param Request $request
     * @param $unitId
     *
     * @return UnitResource|\Illuminate\Http\JsonResponse
     */
    public function show($unitId)
    {
        try {
            $unit = $this->service()->find($unitId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        }

        return new UnitResource($unit);
    }

    /**
     * Update the unit.
     *
     * @param Request $request
     * @param int $unitId
     *
     * @return UnitResource|\Illuminate\Http\JsonResponse
     */
    public function update($unitId, UnitRequest  $request)
    {
        try {
            $this->service()->update($unitId, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new UnitResource(Unit::query()->findOrFail($unitId));
    }

    /**
     * Get the list of unites for the given contact.
     *
     * @param int $unitId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function destroy($unitId)
    {
        try {
            $this->service()->delete($unitId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        }

        return $this->respondObjectDeleted($unitId);
    }

    public function service()
    {
        return new UnitService();
    }
}
