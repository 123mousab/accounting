<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;
use App\Http\Requests\ContractorRequest;
use App\Http\Resources\BranchResource;
use App\Http\Resources\ContractorResource;
use App\Models\Branch;
use App\Models\Contactor;
use App\Services\BranchService;
use App\Services\ContractorService;
use App\Traits\JsonRespondController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ContractorController extends Controller
{
    use JsonRespondController;

    /**
     * Get the list of contactors.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $contactors =  ContractorResource::collection($this->service()->query()->paginate(20));
        }catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return  $contactors;
    }

    /**
     * Store the contactor.
     *
     * @param Request $request
     *
     * @return ContractorResource|\Illuminate\Http\JsonResponse
     */
    public function store(ContractorRequest $request)
    {
        try {
            $contactor = $this->service()->create($request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new ContractorResource($contactor);
    }

    /**
     * Get the detail of a given contractor.
     *
     * @param Request $request
     * @param $contactorId
     *
     * @return ContractorResource|\Illuminate\Http\JsonResponse
     */
    public function show($contactorId)
    {
        try {
            $contractor = $this->service()->find($contactorId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        }

        return new ContractorResource($contractor);
    }

    /**
     * Update the contractor.
     *
     * @param Request $request
     * @param int $contactorId
     *
     * @return ContractorResource|\Illuminate\Http\JsonResponse
     */
    public function update($contactorId, ContractorRequest  $request)
    {
        try {
            $this->service()->update($contactorId, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new ContractorResource(Contactor::query()->findOrFail($contactorId));
    }

    /**
     * delete contactor record.
     *
     * @param int $contactorId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function destroy($contactorId)
    {
        try {
            $this->service()->delete($contactorId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        }

        return $this->respondObjectDeleted($contactorId);
    }

    public function service()
    {
        return new ContractorService();
    }
}
