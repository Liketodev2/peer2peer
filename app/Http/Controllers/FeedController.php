<?php

namespace App\Http\Controllers;

use App\Models\Agree;
use App\Models\Comment;
use App\Models\Feed;
use App\Models\Like;
use App\Models\Repost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function likeFeed(Request $request){

        $feed_id = $request->feed_id;
        $is_like = $request->is_like;
        $update = false;

        $feed = Feed::find($feed_id);

        if(!$feed){
            return null;
        }

        $user = Auth::user();
        $like = $user->likes()->where('feed_id', $feed_id)->first();

        if($like){
            $already_like = $like->like;
            $update = true;

            if($already_like == $is_like){
                $like->delete();
                return null;
            }
        }else{
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->feed_id = $feed->id;

        if($update){
            $like->update();
        }else{
            $like->save();
        }

        return null;


    }

    public function agreeFeed(Request $request){

        $feed_id = $request->feed_id;
        $is_agree = $request->is_agree;
        $update = false;

        $feed = Feed::find($feed_id);

        if(!$feed){
            return null;
        }

        $user = Auth::user();
        $agree = $user->agrees()->where('feed_id', $feed_id)->first();

        if($agree){
            $already_agree = $agree->agree;
            $update = true;

            if($already_agree == $is_agree){
                $agree->delete();
                return null;
            }
        }else{
            $agree = new Agree();
        }
        $agree->agree = $is_agree;
        $agree->user_id = $user->id;
        $agree->feed_id = $feed->id;

        if($update){
            $agree->update();
        }else{
            $agree->save();
        }

        return null;

    }

    public function repostFeed(Request $request){

        $repost = Auth::user()->reposts()->where('feed_id', $request->feed_id)->first();

        if(!$repost){
            $repost = new Repost();
            $repost->user_id = Auth::id();
            $repost->feed_id = $request->feed_id;
            $repost->save();
        }else{
            $repost->delete();
        }

        return null;

    }

    public function store(Request $request){


        $request->validate([
            'url' => 'required|url',
            'description' => 'required|max:300',
            'user_name' => 'required|max:60',
            'category_id' => 'required',
        ]);

        Feed::create([
            'url' => $request['url'],
            'author_name' => $request['user_name'],
            'article' => $request['article'],
            'description' => $request['description'],
            'category_id' => $request['category_id'],
            'comment_access' => isset($request['comment_access']) && $request['comment_access'] == 1 ? 1 : 0,
            'user_id' => Auth::id(),
            'status' => 0
        ]);


        return redirect()->back()->with('success', 'Article is created');

    }
    public function comment(Request $request)
    {
        $request->validate([
            'message' => 'required',
        ]);

        $input = $request->all();
        $input['user_id'] = auth()->user()->id;

        Comment::create($input);



        return back();
    }
    public function myFeeds()
    {
        $feeds = Feed::where('user_id', Auth::id())->orderBy('created_at','desc')->paginate(20, ['*'], 'feeds');
        $reposts = Feed::whereIn('id',Auth::user()->reposts()->pluck('feed_id'))->paginate(20, ['*'], 'reposts');

        return view('myfeeds', compact('feeds','reposts'));
    }
}
