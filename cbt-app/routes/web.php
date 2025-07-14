<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

// PAGES ROUTES
Route::get('/', function () {
    return view('home');
});



// DASHBOARD ROUTES


// Student/User (role = 2)
// Shared dashboard route
// Route::get('/dashboard', [DashboardController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');
// Route::middleware(['auth', 'verified', 'rolemanager:2'])->group(function () {
//         Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//     });
// Route::middleware(['auth', 'verified', 'rolemanager:1'])->group(function () {
//     Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
// });

Route::get('/dashboard', function () {
    return view('admin/dashboard');
})->middleware(['auth', 'verified','rolemanager:dashboard'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin/admin-dashboard');
})->middleware(['auth', 'verified','rolemanager:admin'])->name('admin');

Route::get('/super-admin/dashboard', function () {
    return view('admin/super-dashboard');
})->middleware(['auth', 'verified','rolemanager:super-admin'])->name('super-admin');


// DASHBOARD ROUTES
// Route::get('/dashboard', function () {
//     return view('admin/dashboard');
// })->middleware(['auth', 'verified','rolemanager:dashboard'])->name('dashboard');

// Route::get('/admin/dashboard', function () {
//     return view('admin/admin-dashboard');
// })->middleware(['auth', 'verified','rolemanager:admin'])->name('admin');

// Route::get('/super-admin/dashboard', function () {
//     return view('admin/super-dashboard');
// })->middleware(['auth', 'verified','rolemanager:super-admin'])->name('super-admin');




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
Route::get('/instructions', function () {
    return view('pages.instructions');
});
Route::get('/faq', function () {
    return view('pages.frequently-asked-questions');
});









require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';