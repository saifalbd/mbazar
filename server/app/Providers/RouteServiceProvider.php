<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Price;
use App\Models\Variant;
use App\Models\VariantOption;
use App\Models\Warehouse;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    protected static function customer($self){
        Route::prefix('api')
        ->middleware('api')
        ->namespace($self->namespace)
        ->group(base_path('app/Http/Controllers/Customer/apiRoute.php'));

    Route::middleware('web')
        ->namespace($self->namespace)
        ->group(base_path('app/Http/Controllers/Customer/webRoute.php'));
    }

    protected static function admin($self){
        Route::prefix('admin/api')
        ->middleware('api')
        ->namespace($self->namespace)
        ->group(base_path('app/Http/Controllers/Admin/apiRoute.php'));

    Route::middleware('web')->prefix('admin')
        ->namespace($self->namespace)
        ->group(base_path('app/Http/Controllers/Admin/webRoute.php'));
    }


    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        // parent::boot();




        Route::model('category', Category::class);
        Route::model('product', Product::class);
        Route::model('price', Price::class);
        Route::model('cart', Cart::class);
        Route::model('variant',Variant::class);
        Route::model('variant_option',VariantOption::class);
        Route::model('warehouse',Warehouse::class);



        $this->routes(function () {
            static::customer($this);
            static::admin($this);
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60);
        });
    }
}
