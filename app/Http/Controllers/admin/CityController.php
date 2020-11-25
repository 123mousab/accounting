<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use App\Services\CityService;
use App\Traits\JsonRespondController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CityController extends Controller
{
    use JsonRespondController;

    /**
     * Get the list of cities.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $citys =  CityResource::collection($this->service()->query()->paginate(20));
        }catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return  $citys;
    }

    /**
     * Store the city.
     *
     * @param Request $request
     *
     * @return CityResource|\Illuminate\Http\JsonResponse
     */
    public function store(CityRequest $request)
    {
        try {
            $city = $this->service()->create($request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new CityResource($city);
    }

    /**
     * Get the detail of a given city.
     *
     * @param Request $request
     * @param $cityId
     *
     * @return CityResource|\Illuminate\Http\JsonResponse
     */
    public function show($cityId)
    {
        try {
            $city = $this->service()->find($cityId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        }

        return new CityResource($city);
    }

    /**
     * Update the city.
     *
     * @param Request $request
     * @param int $cityId
     *
     * @return CityResource|\Illuminate\Http\JsonResponse
     */
    public function update($cityId, CityRequest  $request)
    {
        try {
            $this->service()->update($cityId, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new CityResource(City::query()->findOrFail($cityId));
    }

    /**
     * Get the list of citys for the given contact.
     *
     * @param int $cityId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function destroy($cityId)
    {
        try {
            $this->service()->delete($cityId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        }

        return $this->respondObjectDeleted($cityId);
    }

    public function service()
    {
        return new CityService();
    }
}
