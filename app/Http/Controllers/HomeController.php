<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Feed;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function profile()
    {
        return view('profile');
    }


    public function search()
    {
        return view('search');
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
