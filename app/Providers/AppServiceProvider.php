<?php

namespace App\Providers;


use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\Products\ProductService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class , ProductRepository::class );
        $this->app->bind(ProductService::class , 
        function($app)
        {
            return new ProductService ($app->make(ProductRepositoryInterface::class)) ;
        }
    );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
