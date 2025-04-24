<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// PAGES ROUTES
Route::get('/', function () {
    return view('home');
});

// DASHBOARD ROUTES
Route::get('/dashboard', function () {
    return view('admin/dashboard');
})->middleware(['auth', 'verified','rolemanager:dashboard'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin/admin-dashboard');
})->middleware(['auth', 'verified','rolemanager:admin'])->name('admin');

Route::get('/super-admin/dashboard', function () {
    return view('admin/super-dashboard');
})->middleware(['auth', 'verified','rolemanager:super-admin'])->name('super-admin');


// PROFILE ROUTES
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// PAGES ROUTES
Route::get('/contact-us', function () {
    return view('pages.contact-us');
});
Route::get('/about-us', function () {
    return view('pages.about-us');
});
Route::get('/pricing', function () {
    return view('pages.pricing');
});
Route::get('/gallery', function () {
    return view('pages.gallery');
});
Route::get('/frequently-asked-questions', function () {
    return view('pages.frequently-asked-questions');
});






require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';