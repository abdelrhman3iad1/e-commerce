<?php

namespace App\Providers;

use App\Repositories\product\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Services\Products\ProductService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class , ProductRepository::class);
        $this->app->bind(ProductService::class , function($app){
            return 
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
