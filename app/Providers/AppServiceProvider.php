<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Feed;
use App\Models\Notify;
use Carbon\Carbon;
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
                $category = Category::where('name', 'like', '%' . 'Local' . '%')->first();
                $trending_feeds = Feed::where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString());

                if($category){
                    $trending_feeds = $trending_feeds->where('category_id', '!=', $category->id);
                }

                $trending_feeds = $trending_feeds
                    ->withCount('comments')
                    ->having('comments_count', '>', 0)
                    ->orderBy('comments_count','desc')
                    ->published()
                    ->limit(6)
                    ->get();

                if($trending_feeds->count() < 5 && $trending_feeds->count() > 0){
                    $average = 5 - $trending_feeds->count();
                    $trending_feeds_part = Feed::where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString())
                        ->published()
                        ->inRandomOrder()
                        ->limit($average)
                        ->get();

                    if($trending_feeds_part){
                        $trending_feeds = $trending_feeds->merge($trending_feeds_part);
                    }
                }else{
                    $trending_feeds_part = Feed::where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString())
                        ->published()
                        ->inRandomOrder()
                        ->limit(5)
                        ->get();
                    $trending_feeds = $trending_feeds_part;
                }


            View::share('trending_feeds', $trending_feeds);
        }

    }
}
