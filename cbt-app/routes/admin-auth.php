<?php

use Admin\SliderController;
use Illuminate\Support\Facades\Route;



Route::middleware('$authUserRole')->group(function () {
    Route::get('home-slider', [SliderController::class, 'index'])->name('admin.slider.index');

});