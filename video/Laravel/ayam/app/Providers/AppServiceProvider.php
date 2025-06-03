<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Share categories with all views for the navbar dropdown
        View::composer('layouts.app', function ($view) {
            $view->with('categories', Category::all());
        });
    }
}
