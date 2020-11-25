<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyManufactureRequest;
use App\Http\Resources\CompanyManufactureResource;
use App\Models\CompanyManufacture;
use App\Services\CompanyManufactureService;
use App\Traits\JsonRespondController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CompanyManufactureController extends Controller
{
    use JsonRespondController;

    /**
     * Get the list of company_manufactures.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $company_manufactures =  CompanyManufactureResource::collection($this->service()->query()->paginate(20));
        }catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return  $company_manufactures;
    }

    /**
     * Store the company_manufacture.
     *
     * @param Request $request
     *
     * @return CompanyManufactureResource|\Illuminate\Http\JsonResponse
     */
    public function store(CompanyManufactureRequest $request)
    {
        try {
            $company_manufacture = $this->service()->create($request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new CompanyManufactureResource($company_manufacture);
    }

    /**
     * Get the detail of a given company_manufacture.
     *
     * @param Request $request
     * @param $company_manufacture_Id
     *
     * @return CompanyManufactureResource|\Illuminate\Http\JsonResponse
     */
    public function show($company_manufacture_Id)
    {
        try {
            $company_manufacture = $this->service()->find($company_manufacture_Id);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        }

        return new CompanyManufactureResource($company_manufacture);
    }

    /**
     * Update the company_manufacture.
     *
     * @param Request $request
     * @param int $company_manufacture_Id
     *
     * @return CompanyManufactureResource|\Illuminate\Http\JsonResponse
     */
    public function update($company_manufacture_Id, CompanyManufactureRequest  $request)
    {
        try {
            $this->service()->update($company_manufacture_Id, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new CompanyManufactureResource(CompanyManufacture::query()->findOrFail($company_manufacture_Id));
    }

    /**
     * Get the list of company_manufactures for the given contact.
     *
     * @param int $company_manufacture_Id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function destroy($company_manufacture_Id)
    {
        try {
            $this->service()->delete($company_manufacture_Id);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        }

        return $this->respondObjectDeleted($company_manufacture_Id);
    }

    public function service()
    {
        return new CompanyManufactureService();
    }
}
