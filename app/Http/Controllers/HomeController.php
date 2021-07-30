<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Feed;
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

        $reposts = $user->reposts()->paginate(20);
        $reposts_count = $user->reposts()->count();


        return view('profile', compact('user','results','results_count','reposts','reposts_count'));
    }

    public function myProfile()
    {
        $user = Auth::user();


        return view('myprofile', compact('user'));
    }

    public function search(Request $request)
    {

        if(Str::length($request->search) > 2){
            $results = Feed::published()->where(function($query) use ($request) {
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
        $feeds[Carbon::now()->format('D, M d')] = Feed::published()->whereDate('created_at', Carbon::now())->orderBy('id','desc')->take(10)->get();
        $feeds[Carbon::now()->subDays(1)->format('D, M d')] = Feed::published()->whereDate('created_at', Carbon::now()->subDays(1))->orderBy('id','desc')->take(10)->get();
        $feeds[Carbon::now()->subDays(2)->format('D, M d')] = Feed::published()->whereDate('created_at', Carbon::now()->subDays(2))->orderBy('id','desc')->take(10)->get();


        return view('welcome', compact('feeds'));
    }

    public function category($id)
    {
        $feeds = Feed::where('category_id', $id)->orderBy('created_at','desc')->published()->paginate(20);

        return view('category', compact('id', 'feeds'));
    }
    public function feed($id)
    {

        $comments = null;
        $feed = Feed::published()->find($id);
        if($feed){
            $comments = $feed->comments()->paginate(25);
        }

        return view('feed', compact('feed','comments'));
    }


}
