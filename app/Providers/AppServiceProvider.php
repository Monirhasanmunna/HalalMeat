<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\SubCategory;
use App\Observers\ProductObserver;
use App\Observers\SubCategoryObserver;
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
        SubCategory::observe(SubCategoryObserver::class);
        Product::observe(ProductObserver::class);
    }
}
