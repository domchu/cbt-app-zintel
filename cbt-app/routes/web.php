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

// Route::prefix('admin')->middleware('auth.admin')->group(function () {
//     Route::get('/dashboard', function () {
//         return view('admin.dashboard');
//     })->name('admin.dashboard');
// });



require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';