<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SliderController;







Route::get('home-slider', [SliderController::class, 'index']);
Route::get('add-slider', [SliderController::class, 'create']);
Route::post('store-slider', [SliderController::class, 'store']);