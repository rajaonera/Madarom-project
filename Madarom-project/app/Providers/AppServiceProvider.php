<?php

namespace App\Providers;

//use Illuminate\Cache\RateLimiting\Limit;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
//        $this->configureRateLimiting();
//        parent::boot();

    }
//    protected function configureRateLimiting(): void
//    {
//        RateLimiter::for('login', function (Request $request) {
//            return Limit::perMinute(5)->by($request->ip());
//        });
//    }
}
