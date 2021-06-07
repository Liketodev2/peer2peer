<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Feed;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function profile($id)
    {
        $user = User::findOrFail($id);
        $results =  $user->feed();
        $results_count = $user->feed->count();
        $results = $results->paginate(25);


        return view('profile', compact('user','results','results_count'));
    }

    public function myProfile()
    {
        $user = Auth::user();

        return view('myprofile', compact('user'));
    }


    public function search(Request $request)
    {

        if(Str::length($request->search) > 2){
            $results = Feed::where(function($query) use ($request) {
                $query->where('article', 'like', '%' . $request->search . '%');
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
        $feeds[Carbon::now()->format('D, M d')] = Feed::whereDate('created_at', Carbon::now())->orderBy('id','desc')->take(10)->get();
        $feeds[Carbon::now()->subDays(1)->format('D, M d')] = Feed::whereDate('created_at', Carbon::now()->subDays(1))->orderBy('id','desc')->take(10)->get();
        $feeds[Carbon::now()->subDays(2)->format('D, M d')] = Feed::whereDate('created_at', Carbon::now()->subDays(2))->orderBy('id','desc')->take(10)->get();


        return view('welcome', compact('feeds'));
    }

    public function category($id)
    {
        $feeds = Feed::where('category_id', $id)->orderBy('created_at','desc')->paginate(20);

        return view('category', compact('id', 'feeds'));
    }
    public function feed($id)
    {
        $feed = Feed::with('comments')->find($id);

        return view('feed', compact('feed'));
    }
    public function peers()
    {
        $peers = User::where('type', 10)->get();
        return view('peers', compact('peers'));
    }

    public function messages()
    {
        return view('messages');
    }
}
