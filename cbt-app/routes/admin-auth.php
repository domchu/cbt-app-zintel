<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SliderController;


// SLIDER ROUTES
Route::get('home-slider', [SliderController::class, 'index']);
Route::get('add-slider', [SliderController::class, 'create']);
Route::post('store-slider', [SliderController::class, 'store']);
Route::get('edit-slider/{id}', [SliderController::class, 'edit']);
Route::put('update-slider/{id}', [SliderController::class, 'update']);
Route::delete('home-slider/{id}', [SliderController::class, 'destroy']);
Route::get('view-slider/{id}', [SliderController::class, 'view']);