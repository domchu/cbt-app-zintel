<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamsController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\QuestionImportController;


// SLIDER ROUTES
Route::get('home-slider', [SliderController::class, 'index']);
Route::get('add-slider', [SliderController::class, 'create']);
Route::post('store-slider', [SliderController::class, 'store']);
Route::get('edit-slider/{id}', [SliderController::class, 'edit']);
Route::put('update-slider/{id}', [SliderController::class, 'update']);
Route::delete('home-slider/{id}', [SliderController::class, 'destroy']);
Route::get('show-slider/{id}', [SliderController::class, 'show']);




// SUBJECT ROUTE
Route::prefix('admin/subject')->controller(SubjectsController::class)->group(function () {
    Route::get('/', 'index')->name('subject.index');
    Route::get('/create', 'create')->name('subject.create');
    Route::post('/store', 'store')->name('subject.store');
    Route::get('/{id}/edit', 'edit')->name('subject.edit');
    Route::put('/{id}/update', 'update')->name('subject.update');
    Route::delete('/{id}', 'destroy')->name('subject.destroy');
    Route::get('/{id}', 'show')->name('subject.show');
});

// STUDENT REGISTRATION

Route::prefix('admin/student')->controller(StudentsController::class)->group(function () {
    Route::get('/', 'index')->name('student.index');
    Route::get('/create', 'create')->name('student.create');
    Route::post('/store', 'store')->name('student.store');
    Route::get('/{id}/edit', 'edit')->name('student.edit');
    Route::put('/{id}/update', 'update')->name('student.update');
    Route::delete('/{id}', 'destroy')->name('student.destroy');
    Route::get('/{id}', 'show')->name('student.show');
});

// SESSION ROUTE
Route::prefix('admin/section')->controller(SessionController::class)->group(function () {
    Route::get('/', 'index')->name('section.index');
    Route::get('/create', 'create')->name('section.create');
    Route::post('/store', 'store')->name('section.store');
    Route::get('/{id}/edit', 'edit')->name('section.edit');
    Route::put('/{id}/update', 'update')->name('section.update');
    Route::delete('/{id}', 'destroy')->name('section.destroy');
    Route::get('/{id}', 'show')->name('section.show');
});
// QUESTIONS ROUTE


Route::prefix('admin/questions')->controller(QuestionImportController::class)->group(function () {
    Route::get('/', 'index')->name('questions.index'); 
    Route::get('/upload', 'showUploadForm')->name('questions.upload');
    Route::get('/import', 'showImportForm')->name('questions.import.form');
    Route::post('/import', 'import')->name('questions.import'); 
    Route::post('/preview', 'preview')->name('questions.preview');
    Route::post('/importConfirmed', 'importConfirmed')->name('questions.importConfirmed');


});



// USER ROUTES
Route::get('/exam', [ExamsController::class, 'showExamForm'])->name('exam.index');
Route::POST('/exam/start', [ExamsController::class, 'startExam'])->name('exam.start');
Route::post('/exam/submit', [ExamsController::class, 'submitExam'])->name('exam.submit');
Route::get('/exam/result', [ExamsController::class, 'showResult'])->name('exam.result');
Route::get('/exam/history', [ExamsController::class, 'examHistory'])->name('exam.history');




// Admin (role = 1)
// Route::middleware(['auth', 'rolemanager:1'])->prefix('admin')->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
// });

// Student/User (role = 2)
// Route::middleware(['auth', 'rolemanager:2'])->prefix('dashboard')->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
// });
// Route::middleware(['auth', 'rolemanager:1'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
//     Route::get('/admin/results', [AdminController::class, 'allStudentResults'])->name('admin.results');
// });