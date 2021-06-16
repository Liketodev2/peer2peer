<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\User;
use Illuminate\Http\Request;

class FunctionController extends Controller
{
   public static function getLimetedFeeds(){

       $feeds = [];
       $feeds['world'] = Feed::where('category_id', 2)->orderBy('id','desc')->limit(10)->get();
       $feeds['business_money'] = Feed::where('category_id', 3)->orderBy('id','desc')->limit(10)->get();
       $feeds['entertainment'] = Feed::where('category_id', 4)->orderBy('id','desc')->limit(10)->get();
       $feeds['tech'] = Feed::where('category_id', 6)->orderBy('id','desc')->limit(10)->get();
       $feeds['health'] = Feed::where('category_id', 7)->orderBy('id','desc')->limit(10)->get();

       return $feeds;
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
}
