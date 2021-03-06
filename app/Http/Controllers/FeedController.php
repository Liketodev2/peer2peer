<?php

namespace App\Http\Controllers;

use App\Models\Agree;
use App\Models\ChannelWhiteList;
use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\Feed;
use App\Models\Like;
use App\Models\Notify;
use App\Models\Repost;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use GuzzleHttp\Cookie\CookieJar;

class FeedController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function commentLikeFeed(Request $request){

        $comment_id = $request->comment_id;
        $is_like = $request->is_like;
        $update = false;

        $comment = Comment::find($comment_id);

        if(!$comment){
            return null;
        }

        $user = Auth::user();
        $like = $user->comment_like()->where('comment_id', $comment_id)->first();

        if($like){
            $already_like = $like->like;
            $update = true;
            if($already_like == $is_like){
                $like->delete();
                return null;
            }
        }else{
            $like = new CommentLike();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->comment_id = $comment->id;

        if($update){
            $like->update();
        }else{
            $like->save();
        }

        return response()->json([
            'like' => $comment->comment_like() ? $comment->comment_like()->where('like', 1)->count() : 0,
            'diss' => $comment->comment_like() ? $comment->comment_like()->where('like', 0)->count() : 0
        ]);


    }

    public function return_response($feed_id){
        $percent = FunctionController::LikePercent($feed_id);
        return response()->json($percent);
    }

    public function return_response_agree($feed_id){
        $percent = FunctionController::agreePercent($feed_id);
        return response()->json($percent);
    }

    public function likeFeed(Request $request){

        $feed_id = $request->feed_id;
        $is_like = $request->is_like;
        $update = false;

        $feed = Feed::find($feed_id);

        $user = Auth::user();
        $like = $user->likes()->where('feed_id', $feed_id)->first();

        if($like){
            $already_like = $like->like;
            $update = true;

            if($already_like == $is_like){
                $like->delete();
                return $this->return_response($feed_id);
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

        return $this->return_response($feed_id);


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
                return $this->return_response_agree($feed_id);
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

        return $this->return_response_agree($feed_id);

    }

    public function repostFeed(Request $request){

        $repost = Auth::user()->repost()->where('feed_id', $request->feed_id)->first();

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
            'description' => 'required|max:600',
            'article_name' => 'required|max:120',
            'user_name' => 'nullable|max:60',
            'category_id' => 'required'
        ]);

        $response_message = 'Article is created';
        $req_url_parse =  str_ireplace('www.', '', parse_url($request['url'], PHP_URL_HOST));
        $white_list = ChannelWhiteList::where('status', 1)->get();
        $check_parsing = false;

        if($white_list->count() > 0) {
            foreach ($white_list as $list) {
                $list_url_parse = str_ireplace('www.', '', parse_url($list->url, PHP_URL_HOST));

                if ($req_url_parse == $list_url_parse) {
                    $check_parsing = true;
                }
            }
        }else{
            $check_parsing = false;
        }

        if(!$check_parsing){
            $response_message = 'Current URL is not whitelisted by the admin. Sent for consideration to the admin';
        }


        Feed::create([
            'url' => $request['url'],
            'author_name' => $request['user_name'],
            'title' => $request['article_name'],
            'description' => $request['description'],
            'category_id' => $request['category_id'],
            'comment_access' => 1,
            'user_id' => isset($request->channel_id) && Auth::user()->type == 10 ? $request->channel_id  : Auth::id(),
            'status' => $check_parsing == true ? 1 : 0
        ]);


        return redirect()->back()->with('success', $response_message);

    }

    public function getUrlTitle(Request $request){

        try {


            $url= $request->url;

            $parse = parse_url($url);
            $parsed = $parse['scheme'].'://'.$parse['host'];


            $client = new Client([
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                    'Accept-Encoding' => 'gzip, deflate, br',
                    'Origin' => $parsed,
                ],
                'base_url' => $url,
                'cookies' => CookieJar::fromArray(['mos_id' => 'CllGx1yOW5nBYizxkxtbAgA='], '.mos.ru'),
                'allow_redirects' => true,
                'decode_content' => true,
                'http_errors' => false,
                'track_redirects' => false,
                'exceptions' => false

            ]);

            $response = $client->request('get', $url);
            $htmlString = (string)$response->getBody();

            $doc = new \DOMDocument();
            @$doc->loadHTML($htmlString);
            $nodes = $doc->getElementsByTagName('title');
            $title = $nodes->item(0)->nodeValue;
            $title = htmlspecialchars_decode($title, ENT_QUOTES);

            if($title == "Access to this page has been denied."){
                return response()->json("Access to this page has been denied.",404);
            }

            return response()->json($title);

        }catch(\Exception $exception){

             return response()->json($exception->getMessage(),404);

        }

    }

    public function comment(Request $request)
    {
        $request->validate([
            'message' => 'required',
        ]);


        $input = $request->all();

        $input['user_id'] = auth()->user()->id;
        $reply = isset($input['reply']) ? 1 : 0;
        if($reply){
            unset($input['reply']);
        }
        $feed = Feed::findOrFail($request->feed_id);
       if($reply){

            $parent = Comment::where('parent_id', $request->parent_id)->get()->groupBy('user_id');
            $auth_id = Auth::id();
            $plucked_ids = array_keys($parent->toArray());
            $parent = $parent->count();

            $parent_item = Comment::find($input['parent_id']);

            if(!in_array($auth_id, $plucked_ids)){
                $parent +=1;
            }


            if($parent > (int)$parent_item->discussion_size ){
                throw ValidationException::withMessages(['limit' => 'Discussion people limit is '.$parent_item->discussion_size  ]);
            }
        }

        $new_comment = Comment::create($input);

        if($reply){
            $feed_parent = Comment::find($input['parent_id']);
            $text = FunctionController::userTypeName(Auth::id()) .' '. ( 'commented on your comment' ) .' "'. ( Str::limit($feed->title, 60) ) .' "';
            $notify_user = $feed_parent->user_id;
        }else{
            $notify_user = $feed->user_id;
            $text = FunctionController::userTypeName(Auth::id()) .' '. ('commented on ') .' "'. ( Str::limit($feed->title, 60) ) .' "';
        }

        if($notify_user != Auth::id()){
            Notify::create([
                'user_id' =>$notify_user,
                'text' => $text,
                'feed_id' => $feed->id,
                'comment_id' => $new_comment->id
            ]);
        }

        return redirect()->route('feed', $request->feed_id);
    }
    public function myFeeds(Request $request)
    {
        $feeds = Feed::where('user_id', Auth::id())->orderBy('created_at','desc')->paginate(20, ['*'], 'feeds');
        $reposts = Auth::user()->reposts()->paginate(20, ['*'], 'reposts');

        if(Auth::user()->type == 10 && Auth::user()->main == 1){
            if($request->id){
                $feeds = Feed::where('user_id', $request->id)->orderBy('created_at','desc')->paginate(20, ['*'], 'feeds');
            }
            $channels = User::where('parent_id', Auth::id())->get();
            $peers =  Auth::user()->following->where('type', 10);
            return view('myfeeds-channel', compact('feeds','reposts','channels','peers'));
        }



        return view('myfeeds', compact('feeds','reposts'));
    }

    public function commentDelete(Request $request)
    {
        $comment = Comment::where('id', $request->id)->where('user_id', Auth::id());
        if($comment){
            $comment->delete();
        }

        return redirect()->back();
    }


    public function feedDelete($id)
    {
        $feed = Feed::where('user_id', Auth::id())->where('id', $id)->first();
        if($feed){
            $feed->delete();
        }

        return redirect()->back();
    }

    public function feedUpdate(Request $request, $id)
    {
        $request->validate([
            'url' => 'required|url',
            'description' => 'required|max:600',
            'article_name' => 'required|max:120',
            'user_name' => 'nullable|max:60',
            'category_id' => 'required',
        ]);

        $feed =   Feed::where('id',$id)->where('user_id', Auth::id());

        $response_message = 'Article is updated';
        $req_url_parse =  str_ireplace('www.', '', parse_url($request['url'], PHP_URL_HOST));

        if($req_url_parse != str_ireplace('www.', '', parse_url($feed->first()['url'], PHP_URL_HOST))){
            $white_list = ChannelWhiteList::where('status', 1)->get();
            $check_parsing = false;

            if($white_list->count() > 0) {
                foreach ($white_list as $list) {
                    $list_url_parse = str_ireplace('www.', '', parse_url($list->url, PHP_URL_HOST));

                    if ($req_url_parse == $list_url_parse) {
                        $check_parsing = true;
                    }
                }
            }else{
                $check_parsing = false;
            }

            if(!$check_parsing){
                $response_message = 'Current URL is not whitelisted by the admin. Sent for consideration to the admin';
            }
        }

        if($feed){
            $feed->update([
                'url' => $request['url'],
                'author_name' => $request['user_name'],
                'title' => $request['article_name'],
                'description' => $request['description'],
                'category_id' => $request['category_id'],
                'comment_access' => 1,
                'user_id' => Auth::id(),
                'status' => 0
            ]);
        }

        return redirect()->back()->with('success', $response_message);

    }

    public function feedEdit($id)
    {
        $feed = Feed::where('user_id', Auth::id())->where('id',$id)->first();
        if(!$feed){
            $feed_parent = Feed::find($id);
            if($feed_parent->user->parent_id == Auth::id()){
                $feed = $feed_parent;
                return view('feed-edit', compact('feed'));
            }

            return redirect()->back();
        }

        return view('feed-edit', compact('feed'));
    }

    public function commentUpdate(Request $request)
    {
        $comment = Comment::where('user_id', Auth::id())->where('id',$request->id)->first();
        if(Str::length($request->value) > 0){
            $comment->message = $request->value;
            $comment->save();
        }

        return response()->json(['value' => $comment->message]);
    }

    public function myChannelsFeed($id){

        if(Auth::user()->parent_id == null && Auth::user()->main == 1){
            $user = User::find($id);
            if($user->parent_id == Auth::user()->id){
                $feeds = Feed::where('user_id', $id)->paginate(20);
            }else{
                return redirect()->back();
            }

        }


        return view('my-channels-feeds', compact('feeds'));

    }

/*    public function discussionSize(Request $request){

        Comment::find($request->id)->update([
            'discussion_size' => $request->value
        ]);

    }*/


}
