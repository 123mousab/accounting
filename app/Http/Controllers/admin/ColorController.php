<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Http\Resources\ColorResource;
use App\Models\Color;
use App\Services\ColorService;
use App\Traits\JsonRespondController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ColorController extends Controller
{
    use JsonRespondController;

    /**
     * Get the list of colors.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $colors =  ColorResource::collection($this->service()->query()->paginate(20));
        }catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return  $colors;
    }

    /**
     * Store the color.
     *
     * @param Request $request
     *
     * @return ColorResource|\Illuminate\Http\JsonResponse
     */
    public function store(ColorRequest $request)
    {
        try {
            $color = $this->service()->create($request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new ColorResource($color);
    }

    /**
     * Get the detail of a given color.
     *
     * @param Request $request
     * @param $colorId
     *
     * @return ColorResource|\Illuminate\Http\JsonResponse
     */
    public function show($colorId)
    {
        try {
            $color = $this->service()->find($colorId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        }

        return new ColorResource($color);
    }

    /**
     * Update the color.
     *
     * @param Request $request
     * @param int $colorId
     *
     * @return ColorResource|\Illuminate\Http\JsonResponse
     */
    public function update($colorId, ColorRequest  $request)
    {
        try {
            $this->service()->update($colorId, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new ColorResource(Color::query()->findOrFail($colorId));
    }

    /**
     * Get the list of color for the given colors.
     *
     * @param int $colorId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function destroy($colorId)
    {
        try {
            $this->service()->delete($colorId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        }

        return $this->respondObjectDeleted($colorId);
    }

    public function service()
    {
        return new ColorService();
    }
}
