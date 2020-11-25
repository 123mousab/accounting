<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyRequest;
use App\Http\Requests\TransactionCurrencyRequest;
use App\Http\Resources\CurrencyResource;
use App\Models\Category;
use App\Models\Currency;
use App\Services\CategoryService;
use App\Services\CurrencyService;
use App\Traits\JsonRespondController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CurrencyController extends Controller
{
    use JsonRespondController;

    /**
     * Get the list of currencies.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $currencies =  CurrencyResource::collection($this->service()->query()->paginate(20));
        }catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return  $currencies;
    }

    /**
     * Store the currency.
     *
     * @param Request $request
     *
     * @return CurrencyResource|\Illuminate\Http\JsonResponse
     */
    public function store(CurrencyRequest $request)
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

        return new CurrencyResource($category);
    }

    /**
     * Get the detail of a given currency.
     *
     * @param Request $request
     * @param $currencyId
     *
     * @return CurrencyResource|\Illuminate\Http\JsonResponse
     */
    public function show($currencyId)
    {
        try {
            $category = $this->service()->find($currencyId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        }

        return new CurrencyResource($category);
    }

    /**
     * Update the currency.
     *
     * @param Request $request
     * @param int $currencyId
     *
     * @return CurrencyResource|\Illuminate\Http\JsonResponse
     */
    public function update($currencyId, CurrencyRequest  $request)
    {
        try {
            $this->service()->update($currencyId, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return new CurrencyResource(Currency::query()->findOrFail($currencyId));
    }

    /**
     * Delete on record of currency table.
     *
     * @param int $currencyId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function destroy($currencyId)
    {
        try {
            $this->service()->delete($currencyId);
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        }

        return $this->respondObjectDeleted($currencyId);
    }

    /**
     * Store the currency.
     *
     * @param Request $request
     *
     */
    public function storeTransactionCurrencies(TransactionCurrencyRequest $request)
    {
        try {
            $currencyTransaction = $this->service()->createUpdateCurrencies($request->all());
        } catch (ModelNotFoundException $e) {
            return $this->respondNotFound();
        } catch (ValidationException $e) {
            return $this->respondValidatorFailed($e->validator);
        } catch (QueryException $e) {
            return $this->respondInvalidQuery();
        }

        return $this->mainWithoutItemsResponse(200, 'update currency successfully', 200);
    }

    public function service()
    {
        return new CurrencyService();
    }
}
