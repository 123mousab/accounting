<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;
use App\Http\Resources\BranchResource;
use App\Models\Branch;
use App\Services\BranchService;
use App\Traits\JsonRespondController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BranchController extends Controller
{
    use JsonRespondController;

    /**
     * Get the list of branches.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $branches =  BranchResource::collection($this->service()->query()->paginate(20));
        }catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return  $branches;
    }

    /**
     * Store the branch.
     *
     * @param Request $request
     *
     * @return BranchResource|\Illuminate\Http\JsonResponse
     */
    public function store(BranchRequest $request)
    {
        try {
            $branch = $this->service()->create($request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new BranchResource($branch);
    }

    /**
     * Get the detail of a given branch.
     *
     * @param Request $request
     * @param $branchId
     *
     * @return BranchResource|\Illuminate\Http\JsonResponse
     */
    public function show($branchId)
    {
        try {
            $branch = $this->service()->find($branchId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        }

        return new BranchResource($branch);
    }

    /**
     * Update the branch.
     *
     * @param Request $request
     * @param int $branchId
     *
     * @return BranchResource|\Illuminate\Http\JsonResponse
     */
    public function update($branchId, BranchRequest  $request)
    {
        try {
            $this->service()->update($branchId, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new BranchResource(Branch::query()->findOrFail($branchId));
    }

    /**
     * Get the list of categories for the given contact.
     *
     * @param int $branchId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function destroy($branchId)
    {
        try {
            $this->service()->delete($branchId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        }

        return $this->respondObjectDeleted($branchId);
    }

    public function service()
    {
        return new BranchService();
    }
}
