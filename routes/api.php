<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CountryController;
use App\Http\Controllers\admin\AreaController;
use App\Http\Controllers\admin\CityController;
use App\Http\Controllers\admin\BranchController;
use App\Http\Controllers\admin\BranchSectionController;
use App\Http\Controllers\admin\ContractorController;
use App\Http\Controllers\admin\CurrencyController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\StoreController;
use App\Http\Controllers\admin\UnitController;
use App\Http\Controllers\admin\DealersController;
use App\Http\Controllers\admin\SizeController;
use App\Http\Controllers\admin\ProductTypeController;
use App\Http\Controllers\admin\CompanyManufactureController;
use App\Http\Controllers\admin\ProductController;

/************************** Admin Routes **************************/
Route::prefix('admin')->group(function (){

    /** *************** Category **************** */
    Route::post('category/{id}', [CategoryController::class, 'update']);
    Route::apiResource('category', CategoryController::class);

    /** *************** Country **************** */
    Route::post('country/{id}', [CountryController::class, 'update']);
    Route::apiResource('country', CountryController::class);

    /** *************** Area **************** */
    Route::post('area/{id}', [AreaController::class, 'update']);
    Route::apiResource('area', AreaController::class);

    /** *************** City **************** */
    Route::post('city/{id}', [CityController::class, 'update']);
    Route::apiResource('city', CityController::class);

    /** *************** Branch **************** */
    Route::post('branch/{id}', [BranchController::class, 'update']);
    Route::apiResource('branch', BranchController::class);

    /** *************** Branch Section **************** */
    Route::post('branch_section/{id}', [BranchSectionController::class, 'update']);
    Route::apiResource('branch_section', BranchSectionController::class);

    /** *************** Contractor **************** */
    Route::post('contactor/{id}', [ContractorController::class, 'update']);
    Route::apiResource('contactor', ContractorController::class);

    /** *************** Currency **************** */
    Route::post('currency/{id}', [CurrencyController::class, 'update']);
    Route::apiResource('currency', CurrencyController::class);

    /** *************** Currency Transaction **************** */
    Route::post('currency_transaction', [CurrencyController::class, 'storeTransactionCurrencies']);

    /** *************** Color **************** */
    Route::post('color/{id}', [ColorController::class, 'update']);
    Route::apiResource('color', ColorController::class);

    /** *************** Store **************** */
    Route::post('store/{id}', [StoreController::class, 'update']);
    Route::apiResource('store', StoreController::class);

    /** *************** Unit **************** */
    Route::post('unit/{id}', [UnitController::class, 'update']);
    Route::apiResource('unit', UnitController::class);

    /** *************** Dealers **************** */
    Route::post('dealer/{id}', [DealersController::class, 'update']);
    Route::apiResource('dealer', DealersController::class);

    /** *************** Size **************** */
    Route::post('size/{id}', [SizeController::class, 'update']);
    Route::apiResource('size', SizeController::class);

    /** *************** Product Type **************** */
    Route::post('product_type/{id}', [ProductTypeController::class, 'update']);
    Route::apiResource('product_type', ProductTypeController::class);

    /** *************** Company Manufactures **************** */
    Route::post('company_manufacture/{id}', [CompanyManufactureController::class, 'update']);
    Route::apiResource('company_manufacture', CompanyManufactureController::class);

    /** *************** Product **************** */
    Route::post('product/{id}', [ProductController::class, 'update']);
    Route::apiResource('product', ProductController::class);

});
