<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    
    public const HOME = '/redirect-after-login';
    public function register(): void
    {

        
        Route::get('/redirect-after-login', function () {
            $role = auth()->user()->role;
        
            if ($role == 1) {
                return redirect()->route('admin.dashboard');
            } elseif ($role == 2) {
                return redirect()->route('dashboard');
            }
        
            abort(403);
        });
        $this->app->bind('files', function () {
            return new Filesystem;
        });


        
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}