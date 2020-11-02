<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'products' => Product::class,
            'prices' => Price::class,
            'categories' => Category::class,
            'users' => User::class,
            'variants' => Variant::class,

        ]);
    }
}
