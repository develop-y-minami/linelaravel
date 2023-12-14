<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
            
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/webs/top.php'));
            
            Route::prefix('line')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/webs/line.php'));

            Route::prefix('liff')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/liffs/liff.php'));

            Route::prefix('api/line')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/apis/line.php'));

            Route::prefix('api/line/messaging/api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/apis/lineMessagingApi.php'));

            Route::prefix('api/line/webhook')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/apis/lineWebhook.php'));
        });
    }
}
