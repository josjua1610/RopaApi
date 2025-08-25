<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ClothController, CatalogController};


Route::apiResource('clothes', ClothController::class);

Route::get('clothes/by-id/{id}', [ClothController::class, 'findById']);


Route::prefix('catalog')->group(function(){
Route::get('types', [CatalogController::class, 'types']);
Route::post('types', [CatalogController::class, 'storeType']);


Route::get('brands', [CatalogController::class, 'brands']);
Route::post('brands', [CatalogController::class, 'storeBrand']);


Route::get('sizes', [CatalogController::class, 'sizes']);
Route::post('sizes', [CatalogController::class, 'storeSize']);


Route::get('colors', [CatalogController::class, 'colors']);
Route::post('colors', [CatalogController::class, 'storeColor']);
});