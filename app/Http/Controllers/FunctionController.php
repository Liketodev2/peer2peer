<?php

namespace App\Http\Controllers;

use App\Models\BlackList;
use App\Models\Conversation;
use App\Models\Feed;
use App\Models\Notify;
use App\Models\User;
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
           $feed_query = $feed_query->whereNotIn('user_id', $blocked_to_show_in_category);
           $feed_query = $feed_query->whereNotIn('user_id', $blocked_users);
       }

       $feeds['world'] = $feed_query->where('category_id', 2)->orderBy('id','desc')->published()->limit(10)->get();
       $feeds['business_money'] = $feed_query->where('category_id', 3)->orderBy('id','desc')->published()->limit(10)->get();
       $feeds['entertainment'] = $feed_query->where('category_id', 4)->orderBy('id','desc')->published()->limit(10)->get();
       $feeds['tech'] = $feed_query->where('category_id', 6)->orderBy('id','desc')->published()->limit(10)->get();
       $feeds['health'] = $feed_query->where('category_id', 7)->orderBy('id','desc')->published()->limit(10)->get();

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
}
