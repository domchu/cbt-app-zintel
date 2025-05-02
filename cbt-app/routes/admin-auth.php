<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\Admin\SliderController;


// SLIDER ROUTES
Route::get('home-slider', [SliderController::class, 'index']);
Route::get('add-slider', [SliderController::class, 'create']);
Route::post('store-slider', [SliderController::class, 'store']);
Route::get('edit-slider/{id}', [SliderController::class, 'edit']);
Route::put('update-slider/{id}', [SliderController::class, 'update']);
Route::delete('home-slider/{id}', [SliderController::class, 'destroy']);
Route::get('show-slider/{id}', [SliderController::class, 'show']);
// SUBJECT ROUTES
Route::get('subject', [SubjectsController::class, 'index']);
Route::get('add-subject', [SubjectsController::class, 'create']);
// Route::post('store-subject', [SubjectsController::class, 'store']);
// Route::get('edit-subject/{id}', [SubjectsController::class, 'edit']);
// Route::put('update-subject/{id}', [SubjectsController::class, 'update']);
// Route::delete('subject/{id}', [SubjectsController::class, 'destroy']);
// Route::get('show-subject/{id}', [SubjectsController::class, 'show']);

// Route::prefix('admin/subject')->controller(SubjectsController::class)->group(function () {
//     Route::get('/', 'index')->name('subject.index');
//     Route::get('/create', 'create')->name('subject.create');
//     Route::post('/store', 'store')->name('subject.store');
//     Route::get('/{id}/edit', 'edit')->name('subject.edit');
//     Route::put('/{id}/update', 'update')->name('subject.update');
//     Route::delete('/{id}', 'destroy')->name('subject.destroy');
//     Route::get('/{id}', 'show')->name('subject.show');
// });