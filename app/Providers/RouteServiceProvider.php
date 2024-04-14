<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;   


class RouteServiceProvider extends ServiceProvider
{
    // protected $apiv1Namespace = 'App\Http\Controllers\project_a';
    protected $apiv1Namespace = 'App\Http\Controllers\api\v1';

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // echo "test route service provider"; die;
        
        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api/v1')
                ->namespace($this->apiv1Namespace)
                ->group(base_path('routes/api_v1.php'));
                
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));//TODO:remove this

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
