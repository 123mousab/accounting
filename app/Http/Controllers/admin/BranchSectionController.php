<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BranchSectionRequest;
use App\Http\Resources\BranchSectionResource;
use App\Models\BranchSection;
use App\Services\BranchSectionService;
use App\Traits\JsonRespondController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BranchSectionController extends Controller
{
    use JsonRespondController;
    /**
     * Get the list of branch sections.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $branches =  BranchSectionResource::collection($this->service()->query()->paginate(20));
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
     * @return BranchSectionResource|\Illuminate\Http\JsonResponse
     */
    public function store(BranchSectionRequest $request)
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

        return new BranchSectionResource($branch);
    }

    /**
     * Get the detail of a given branch section.
     *
     * @param Request $request
     * @param $branch_section_Id
     *
     * @return BranchSectionResource|\Illuminate\Http\JsonResponse
     */
    public function show($branch_section_Id)
    {
        try {
            $area = $this->service()->find($branch_section_Id);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        }

        return new BranchSectionResource($area);
    }

    /**
     * Update the branch section.
     *
     * @param Request $request
     * @param int $branch_section_Id
     *
     * @return BranchSectionResource|\Illuminate\Http\JsonResponse
     */
    public function update($branch_section_Id, BranchSectionRequest  $request)
    {
        try {
            $this->service()->update($branch_section_Id, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new BranchSectionResource(BranchSection::query()->findOrFail($branch_section_Id));
    }

    /**
     * Get the list of areas for the given contact.
     *
     * @param int $branch_section_Id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function destroy($branch_section_Id)
    {
        try {
            $this->service()->delete($branch_section_Id);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        }

        return $this->respondObjectDeleted($branch_section_Id);
    }

    public function service()
    {
        return new BranchSectionService();
    }
}
