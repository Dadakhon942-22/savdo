<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
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
        // Barcha view'larga kategoriyalarni uzatish
        View::composer('layouts.app', function ($view) {
            // Barcha kategoriyalarni olish (mahsulotlari bo'lgan va bo'lmagan)
            $categories = Category::withCount(['products' => function($query) {
                $query->where('is_active', true);
            }])
                ->orderBy('products_count', 'desc') // Eng ko'p mahsulotli birinchi
                ->orderBy('name')
                ->take(10) // Top 10 kategoriya
                ->get();
            
            $view->with('navbarCategories', $categories);
        });
    }
}
