<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Http\Resources\AreaResource;
use App\Models\Area;
use App\Services\AreaService;
use App\Traits\JsonRespondController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AreaController extends Controller
{
    use JsonRespondController;

    /**
     * Get the list of areas.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $areas =  AreaResource::collection(
                QueryBuilder::for($this->service()->model())
                    ->allowedFilters([
                        'name',
                        AllowedFilter::exact('country_id'),
                        AllowedFilter::exact('status'),
                    ])
                    ->allowedSorts([
                        'name',
                        'status',
                        'country_id'
                    ])
                    ->paginate(5)
            );
        }catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return  $areas;
    }

    /**
     * Store the area.
     *
     * @param Request $request
     *
     * @return AreaResource|\Illuminate\Http\JsonResponse
     */
    public function store(AreaRequest $request)
    {
        try {
            $area = $this->service()->create($request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new AreaResource($area);
    }

    /**
     * Get the detail of a given area.
     *
     * @param Request $request
     * @param $areaId
     *
     * @return AreaResource|\Illuminate\Http\JsonResponse
     */
    public function show($areaId)
    {
        try {
            $area = $this->service()->find($areaId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        }

        return new AreaResource($area);
    }

    /**
     * Update the area.
     *
     * @param Request $request
     * @param int $areaId
     *
     * @return AreaResource|\Illuminate\Http\JsonResponse
     */
    public function update($areaId, AreaRequest  $request)
    {
        try {
            $this->service()->update($areaId, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new AreaResource(Area::query()->findOrFail($areaId));
    }

    /**
     * Get the list of areas for the given contact.
     *
     * @param int $areaId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function destroy($areaId)
    {
        try {
            $this->service()->delete($areaId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        }

        return $this->respondObjectDeleted($areaId);
    }

    public function service()
    {
        return new AreaService();
    }
}
