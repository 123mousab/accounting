<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use App\Traits\JsonRespondController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    use JsonRespondController;

    /**
     * Get the list of categories.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $categories = CategoryResource::collection(
                QueryBuilder::for($this->service()->model())
                    ->allowedFilters([
                        'status',
                        'name',
                        AllowedFilter::exact('id'),
                    ])
                    ->allowedSorts([
                        'name',
                        'status'
                    ])
                    ->paginate(5)
            );

        }catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return  $categories;
    }

    /**
     * Store the category.
     *
     * @param Request $request
     *
     * @return CategoryResource|\Illuminate\Http\JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        try {
            $category = $this->service()->create($request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new CategoryResource($category);
    }

    /**
     * Get the detail of a given category.
     *
     * @param Request $request
     * @param $categoryId
     *
     * @return CategoryResource|\Illuminate\Http\JsonResponse
     */
    public function show($categoryId)
    {
        try {
            $category = $this->service()->find($categoryId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        }

        return new CategoryResource($category);
    }

    /**
     * Update the category.
     *
     * @param Request $request
     * @param int $categoryId
     *
     * @return CategoryResource|\Illuminate\Http\JsonResponse
     */
    public function update($categoryId, CategoryRequest  $request)
    {
        try {
            $this->service()->update($categoryId, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new CategoryResource(Category::query()->findOrFail($categoryId));
    }

    /**
     * Get the list of categories for the given contact.
     *
     * @param int $categoryId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function destroy($categoryId)
    {
        try {
            $this->service()->delete($categoryId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        }

        return $this->respondObjectDeleted($categoryId);
    }

    public function service()
    {
        return new CategoryService();
    }
}
