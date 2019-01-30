<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class GeneralPartSiteProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       $this->site_parts();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function site_parts(){
        View::composer(['partials.top_menu','partials.header-search','partials.admin_sidebar'],function ($view){
            $categories = Category::all();
            $shops = Shop::all();
            $products = Product::all();
            $view->with(compact('categories','shops','products'));
        });
    }
}
