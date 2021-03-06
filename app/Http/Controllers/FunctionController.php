<?php

namespace App\Http\Controllers;

use App\Models\BlackList;
use App\Models\Category;
use App\Models\Conversation;
use App\Models\Feed;
use App\Models\Notify;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FunctionController extends Controller
{
   public static function getLimetedFeeds(){

       $feeds = [];
       $feed_query = Feed::query();

       if(Auth::user()){
           $blocked_to_show_in_category = Auth::user()->showCategory_action->pluck('blocked_id');
           $blocked_users = Auth::user()->block_action->pluck('block_id');
           $feeds['world'] = Feed::whereNotIn('user_id', $blocked_to_show_in_category)->whereNotIn('user_id', $blocked_users)->where('category_id', 2)->orderBy('created_at','desc')->published()->limit(10)->get();
           $feeds['business_money'] = Feed::whereNotIn('user_id', $blocked_to_show_in_category)->whereNotIn('user_id', $blocked_users)->where('category_id', 3)->orderBy('created_at','desc')->published()->limit(10)->get();
           $feeds['entertainment'] = Feed::whereNotIn('user_id', $blocked_to_show_in_category)->whereNotIn('user_id', $blocked_users)->where('category_id', 4)->orderBy('created_at','desc')->published()->limit(10)->get();
           $feeds['tech'] = Feed::whereNotIn('user_id', $blocked_to_show_in_category)->whereNotIn('user_id', $blocked_users)->where('category_id', 6)->orderBy('created_at','desc')->published()->limit(10)->get();
           $feeds['health'] = Feed::whereNotIn('user_id', $blocked_to_show_in_category)->whereNotIn('user_id', $blocked_users)->where('category_id', 7)->orderBy('created_at','desc')->published()->limit(10)->get();
       }else{
           $feeds['world'] = Feed::where('category_id', 2)->orderBy('created_at','desc')->published()->limit(10)->get();
           $feeds['business_money'] = Feed::where('category_id', 3)->orderBy('created_at','desc')->published()->limit(10)->get();
           $feeds['entertainment'] = Feed::where('category_id', 4)->orderBy('created_at','desc')->published()->limit(10)->get();
           $feeds['tech'] = Feed::where('category_id', 6)->orderBy('created_at','desc')->published()->limit(10)->get();
           $feeds['health'] = Feed::where('category_id', 7)->orderBy('created_at','desc')->published()->limit(10)->get();
       }



       return $feeds;
   }

   public static function likePercent($id){
       $feed = Feed::published()->find($id);
       $likes = $feed->likes_pivot()->where('like', 1)->count();
       $dislikes = $feed->likes_pivot()->where('like', 0)->count();

       $total = $likes + $dislikes;

       $percent['like'] =  $total != 0 ? round(($likes / $total) * 100) : 0;
       $percent['disslike'] = $total != 0 ? round(($dislikes / $total) * 100) : 0;

       return $percent;
   }

    public static function agreePercent($id){
        $feed = Feed::published()->find($id);
        $agrees = $feed->agrees_pivot()->where('agree', 1)->count();
        $disagrees = $feed->agrees_pivot()->where('agree', 0)->count();

        $total = $agrees + $disagrees;

        $percent['agree'] =  $total != 0 ? round(($agrees / $total) * 100) : 0;
        $percent['disagree'] = $total != 0 ? round(($disagrees / $total) * 100) : 0;

        return $percent;
    }

    public static function trendingNameSelect($category, $route_name){
       $name = 'Trending Home';

        if(isset($category)){
            if($category->name != 'Locale' && $route_name == 'category'){
                $name = 'Trending of '. $category->name;
            }
        }
        return $name;
    }

    public static function userTypeName($id){

       $user = User::find($id);

       if($user->type == 10){
           $name = $user->company_name;
       }else{
           $name = $user->first_name .' '. $user->last_name;
       }

        return $name;
    }

    public static function getNotifications(){

        return Notify::where('user_id', Auth::id())->orderBy('created_at', 'desc')->where('seen', 0)->take(5)->get();
    }
    public static function checkMessages(){

        $check_converstaions =  Conversation::where(['from_id' => Auth::id()])->orWhere(['to_id' => Auth::id()])->get();
        $result = false;

        foreach ($check_converstaions as $check_converstaion) {
          if(  $check_converstaion->messages()->count() > 0 && $check_converstaion->messages->last()->seen == 0 && $check_converstaion->messages->last()->to_id == Auth::id()){
              $result = true;
          }
        }
        return $result;
    }





    public static function trustStatus($i){
        switch ($i) {
            case 5:
                $result = 'Very Trustworthy';
                break;
            case 4:
                $result = 'Trustworthy';
                break;
            case 3:
                $result = 'OK Trust';
                break;
            case 2:
                $result = 'Untrustworthy';
                break;
            case 1:
                $result = 'Not my peer';
                break;
            default:
                $result = 'Choose status';
        }
        return $result;
    }

    public static function checkBlock($to_id){
        $blocked = false;

        $user_to = User::find(Auth::id());
        if($user_to->block_action() && $user_to->block_action()->where('block_id', $to_id)->first()){
            $blocked = true;
        }

        return $blocked;
    }

    public static function checkBlockRevert($id){

        $blocked = false;

        $check_1 = BlackList::where(['block_id' => Auth::id(), 'user_id' => (int)$id])->first();
        $check_2 = BlackList::where(['block_id' => (int)$id , 'user_id' => Auth::id()])->first();

        if($check_1 || $check_2){
            $blocked = true;
        }

        return $blocked;


    }

    public static function getTrending($id){

        $trending_feeds = [];

        $trending_feeds = Feed::where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString());
        $trending_feeds = $trending_feeds->where('category_id', $id);

        $trending_feeds = $trending_feeds
            ->withCount('comments')
            ->having('comments_count', '>', 0)
            ->orderBy('comments_count','desc')
            ->published()
            ->limit(6)
            ->get();

        if($trending_feeds->count() < 5 && $trending_feeds->count() > 0){

            $average = 5 - $trending_feeds->count();
            $trending_feeds_part = Feed::where('category_id', $id)
                ->published()
                ->inRandomOrder()
                ->limit($average)
                ->get();

            if($trending_feeds_part){
                $trending_feeds = $trending_feeds->merge($trending_feeds_part);
            }
        }else{
            $trending_feeds_part = Feed::where('category_id', $id)
                ->withCount('comments')
                ->orderBy('comments_count','desc')
                ->published()
                ->inRandomOrder()
                ->limit(5)
                ->get();
            $trending_feeds = $trending_feeds_part;
        }

        return $trending_feeds;
    }
}
