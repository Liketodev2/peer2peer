<?php

namespace App\Http\Controllers;

use App\Models\Feed;
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
}
