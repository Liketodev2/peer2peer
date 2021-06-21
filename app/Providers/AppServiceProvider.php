<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Feed;
use App\Models\Notify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        Schema::defaultStringLength(191);

        if(Schema::hasTable('categories')){
            View::share('categories', Category::all());
        }

        if(Schema::hasTable('feeds')) {
            $trending_feeds = [];
            $category = Category::where('name', 'like', '%' . 'World' . '%')->first();
            if($category){
                $trending_feeds = Feed::where('category_id',$category->id)->withCount('likes_pivot')->orderBy('likes_pivot_count','desc')->take(5)->get();
            }
            View::share('trending_feeds', $trending_feeds);
        }

    }
}
