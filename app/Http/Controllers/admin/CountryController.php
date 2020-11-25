<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use App\Services\CountryService;
use App\Traits\JsonRespondController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CountryController extends Controller
{
    use JsonRespondController;

    /**
     * Get the list of countries.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $countries =  CountryResource::collection($this->service()->query()->paginate(20));
        }catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return  $countries;
    }

    /**
     * Store the country.
     *
     * @param Request $request
     *
     * @return CountryResource|\Illuminate\Http\JsonResponse
     */
    public function store(CountryRequest $request)
    {
        try {
            $country = $this->service()->create($request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new CountryResource($country);
    }

    /**
     * Get the detail of a given country.
     *
     * @param Request $request
     * @param $countryId
     *
     * @return CountryResource|\Illuminate\Http\JsonResponse
     */
    public function show($countryId)
    {
        try {
            $country = $this->service()->find($countryId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        }

        return new CountryResource($country);
    }

    /**
     * Update the country.
     *
     * @param Request $request
     * @param int $countryId
     *
     * @return CountryResource|\Illuminate\Http\JsonResponse
     */
    public function update($countryId, CountryRequest  $request)
    {
        try {
            $this->service()->update($countryId, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new CountryResource(Country::query()->findOrFail($countryId));
    }

    /**
     * Get the list of countries for the given contact.
     *
     * @param int $countryId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function destroy($countryId)
    {
        try {
            $this->service()->delete($countryId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        }

        return $this->respondObjectDeleted($countryId);
    }

    public function service()
    {
        return new CountryService();
    }
}
