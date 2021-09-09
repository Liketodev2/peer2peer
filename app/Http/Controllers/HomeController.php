<?php

namespace App\Http\Controllers;

use App\Models\BlackList;
use App\Models\Category;
use App\Models\Feed;
use App\Models\RssFeed;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function redirectToHome(){
        return redirect()->route('home');
    }

    public function profile($id)
    {
        $user = User::findOrFail($id);
        $results =  $user->feed();
        $results_count = $user->feed->count();
        $results = $results->paginate(25);
        $my_channels  = User::where('parent_id', $user->id)->get();

        $blocked = FunctionController::checkBlockRevert($id);

        if($blocked){
            return view('blocked');
        }

        $reposts = $user->reposts()->paginate(20);
        $reposts_count = $user->reposts()->count();
        $rss_count = RssFeed::where('user_id', $user->id)->count();



        return view('profile', compact('user','results','results_count','reposts','reposts_count','rss_count','my_channels'));
    }

    public function myProfile()
    {
        $user = Auth::user();
        $rss_count = RssFeed::where('user_id', Auth::id())->count();


        return view('myprofile', compact('user','rss_count'));
    }

    public function search(Request $request)
    {

        if(Str::length($request->search) > 2){

            $feed_query = Feed::query();

            if(Auth::user()){
                $blocked_to_show_in_category = Auth::user()->showCategory_action->pluck('blocked_id');
                $blocked_users = Auth::user()->block_action->pluck('block_id');
                $feed_query = $feed_query->whereNotIn('user_id', $blocked_to_show_in_category);
                $feed_query = $feed_query->whereNotIn('user_id', $blocked_users);
            }

            $results = $feed_query->published()->where(function($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%');
                $query->orWhere('description', 'like', '%' . $request->search . '%');
            });
            $results_count = $results->count();
            $results = $results->paginate(25);
        }else{
            return redirect()->back();
        }


        return view('search', compact('results','results_count'));
    }


    public function home()
    {
        $feeds = [];
        $channels = [];

        if(Auth::user()){
            $blocked_to_show_in_category = Auth::user()->showCategory_action->pluck('blocked_id');
            $blocked_users = Auth::user()->block_action->pluck('block_id');
            $channels = User::where('parent_id', Auth::id())->get();

            $feeds[Carbon::now()->format('D, M d')] = Feed::whereNotIn('user_id', $blocked_to_show_in_category)->whereNotIn('user_id', $blocked_users)->published()->whereDate('created_at', Carbon::now()->format('Y-m-d'))->orderBy('id','desc')->take(10)->get();
            $feeds[Carbon::now()->subDays(1)->format('D, M d')] = Feed::whereNotIn('user_id', $blocked_to_show_in_category)->whereNotIn('user_id', $blocked_users)->published()->whereDate('created_at', Carbon::now()->subDays(1)->format('Y-m-d'))->orderBy('id','desc')->take(10)->get();
            $feeds[Carbon::now()->subDays(2)->format('D, M d')] = Feed::whereNotIn('user_id', $blocked_to_show_in_category)->whereNotIn('user_id', $blocked_users)->published()->whereDate('created_at', Carbon::now()->subDays(2)->format('Y-m-d'))->orderBy('id','desc')->take(10)->get();
        }else{
            $feeds[Carbon::now()->format('D, M d')] = Feed::published()->whereDate('created_at', Carbon::now()->format('Y-m-d'))->orderBy('id','desc')->take(10)->get();
            $feeds[Carbon::now()->subDays(1)->format('D, M d')] = Feed::published()->whereDate('created_at', Carbon::now()->subDays(1)->format('Y-m-d'))->orderBy('id','desc')->take(10)->get();
            $feeds[Carbon::now()->subDays(2)->format('D, M d')] = Feed::published()->whereDate('created_at', Carbon::now()->subDays(2)->format('Y-m-d'))->orderBy('id','desc')->take(10)->get();
        }



        return view('welcome', compact('feeds','channels'));
    }

    public function category($id)
    {
        $auth = Auth::user();
        $feeds = Feed::where('category_id', $id);
        if($auth){

            $blocked_to_show_in_category = Auth::user()->showCategory_action->pluck('blocked_id');
            $blocked_users = $auth->block_action->pluck('block_id');

            $feeds->whereNotIn('user_id', $blocked_to_show_in_category);
            $feeds->whereNotIn('user_id', $blocked_users);

        }
        $feeds = $feeds->orderBy('created_at','desc')->published()->paginate(20);

        return view('category', compact('id', 'feeds'));
    }
    public function feed($id)
    {

        $comments = null;
        $blocked_users = [];
        $me_in_block = [];

        $feed = Feed::published()->findOrFail($id);


        if(Auth::id()){
            $blocked = FunctionController::checkBlock($feed->user_id);
            if($blocked){
                return view('blocked');
            }
        }

        if(Auth::user()){
            $blocked_u = Auth::user()->block_action()->count() > 0 ? Auth::user()->block_action()->pluck('block_id')->toArray() : [];
            $me_in_block = BlackList::where('block_id', Auth::id())->get()->count() > 0 ? BlackList::where('block_id', Auth::id())->get()->pluck('user_id')->toArray() : [] ;

            $blocked_users = array_merge($blocked_u, $me_in_block);
            $blocked_users = array_diff($blocked_users, [Auth::id()]);

        }


        $percent = FunctionController::LikePercent($id);

        if($feed){
            $comments = $feed->comments()->paginate(25);
        }

        return view('feed', compact('feed','comments','percent','blocked_users'));
    }

    public function selectPlan(){

        return view('select-plan');
    }



}
