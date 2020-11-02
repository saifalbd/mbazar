<?php

namespace App\Providers;

use App\Models\Product;
use App\Repositories\ImageInterface;
use App\Repositories\ImageRepository;
use App\Repositories\ProductInterface;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    protected function getRepositories(){
        return [
            [
                ImageInterface::class,ImageRepository::class
            ],
            [
                ProductInterface::class,ProductRepository::class
            ]
        ];
    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach($this->getRepositories() as $rep){
            $this->app->bind(
                $rep[0],
                $rep[1]
            );
        }


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
