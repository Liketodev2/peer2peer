<?php

namespace App\Http\Controllers;

use App\Models\BlackList;
use App\Models\Category;
use App\Models\Conversation;
use App\Models\Feed;
use App\Models\Follow;
use App\Models\Message;
use App\Models\Notify;
use App\Models\RssFeed;
use App\Models\ShowFeed;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function imageUpload(Request $request){

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

 /*       $image = $request->file('image');
        $input['image'] = time().'.'.$image->getClientOriginalExtension();

        $destinationPath = public_path('/images');

        $imgFile = Image::make($image->getRealPath());

        $imgFile->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['image']);

        $image->move($destinationPath, $input['file']);*/

       if(Auth::user()->avatar){
            if(file_exists(public_path('images/'). Auth::user()->avatar)){
                $unset_link  = public_path('images/'). Auth::user()->avatar;
                unlink($unset_link);
            }
        }

        $imageName = time().'.'.$request->image->extension();

        Auth::user()->update([
            'avatar' => $imageName
        ]);

        $request->image->move(public_path('images'), $imageName);

        return redirect()->back();
    }

    public function follow(Request $request){

        $follow_id = $request->follow_id;


        $update = false;

        $user = User::find($follow_id);

        if(!$user){
            return null;
        }

        $user = Auth::user();

        $follow = $user->follow_action()->where('follow_id', $follow_id)->first();


        if($follow){
            $update = true;
        }else{
            $follow = new Follow();
        }

        $follow->user_id = Auth::id();
        $follow->follow_id = $follow_id;
        $follow->trust = 0;

        if($update){
            $follow->delete();
        }else{
            $follow->save();
        }

        return null;

    }

    public function blackListShow(){

        $items = BlackList::where('user_id', Auth::id())->paginate(20);

        return view('blacklist',compact('items'));
    }

    public function removeFromBlock($id){

        $item = BlackList::find($id);
        $item->delete();

        return redirect()->back();
    }


    public function blackList(Request $request){

        $block_id = $request->block_id;

        $update = false;

        $user = User::find($block_id);

        if(!$user){
            return null;
        }

        $user = Auth::user();

        $block = $user->block_action()->where('block_id', $block_id)->first();


        if($block){
            $update = true;
        }else{
            $block = new BlackList();
        }

        $block->user_id = Auth::id();
        $block->block_id = $block_id;

        if($update){
            $block->delete();
        }else{
            $block->save();
        }

        return null;

    }

    public function showCategory(Request $request){

        $show_category_id = $request->show_category_id;


        $update = false;

        $user = User::find($show_category_id);

        if(!$user){
            return null;
        }

        $user = Auth::user();

        $show_feed = $user->showCategory_action()->where('blocked_id', $show_category_id)->first();


        if($show_feed){
            $update = true;
        }else{
            $show_feed = new ShowFeed();
        }

        $show_feed->user_id = Auth::id();
        $show_feed->blocked_id = $show_category_id;

        if($update){
            $show_feed->delete();
        }else{
            $show_feed->save();
        }

        return null;

    }

    public function peers(Request $request)
    {

        if(isset($request->trust)){
            $peers =  Auth::user()->following()->wherePivot('trust', $request->trust)->where('type', 10)->get();
        }else{
            $peers =  Auth::user()->following->where('type', 10);
        }


        return view('peers', compact('peers'));
    }

    public function followedFeeds($id){
        $user = User::findOrFail($id);
        $channels = User::where('parent_id', Auth::id())->get();
        $peers =  Auth::user()->following->where('type', 10);

        $feeds = [];
        $feeds[Carbon::now()->format('D, M d')] = Feed::published()->where('user_id',$user->id)->whereDate('created_at', Carbon::now())->orderBy('id','desc')->take(10)->get();
        $feeds[Carbon::now()->subDays(1)->format('D, M d')] = Feed::published()->where('user_id',$user->id)->whereDate('created_at', Carbon::now()->subDays(1))->orderBy('id','desc')->take(10)->get();
        $feeds[Carbon::now()->subDays(2)->format('D, M d')] = Feed::published()->where('user_id',$user->id)->whereDate('created_at', Carbon::now()->subDays(2))->orderBy('id','desc')->take(10)->get();

        return view('followed-feeds',compact('user','channels','peers','feeds'));
    }

    public function changePassword(Request $request){


        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_new_password' => 'required|same:new_password|min:8',
        ]);


        if (Hash::check($request->get('current_password'), Auth::user()->password)) {
            $user = User::find(Auth::user()->id);
            $user->password = (new BcryptHasher())->make($request->get('new_password'));
            if ($user->save()) {
                return redirect()->back()->with('success', 'Password is changed');
            }
        } else {
            throw ValidationException::withMessages(['current_password' => 'Current password is wrong']);
        }
    }

    public function changeChannelPassword(Request $request, $id){

        $user = User::findOrFail($id);
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_new_password' => 'required|same:new_password|min:8',
        ]);


        if (Hash::check($request->get('current_password'), $user->password)) {
            $user = User::find($user->id);
            $user->password = (new BcryptHasher())->make($request->get('new_password'));
            if ($user->save()) {
                return redirect()->back()->with('success', 'Password is changed');
            }
        } else {
            throw ValidationException::withMessages(['current_password' => 'Current password is wrong']);
        }
    }



    public function updateInfo(Request $request){

        if($request->type == 'company'){
            $this->validate($request, [
                'first_name' => 'required|max:60',
                'last_name' => 'required|max:60',
                'company_name' => 'required|max:60',
            ]);
            Auth::user()->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company_name' => $request->company_name,
            ]);
        }elseif($request->type == 'user'){
            $this->validate($request, [
                'first_name' => 'required|max:60',
                'last_name' => 'required|max:60',
            ]);
            Auth::user()->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]);
        }

        return redirect()->back();


    }
    public function updateChannelInfo(Request $request, $id){

        $user = User::where('id', $id)->where('parent_id', Auth::id())->firstOrFail();

        if($request->type == 'company'){
            $this->validate($request, [
                'first_name' => 'required|max:60',
                'last_name' => 'required|max:60',
                'company_name' => 'required|max:60',
                'rss_link' => 'nullable|url'
            ]);
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company_name' => $request->company_name,
            ]);
        }elseif($request->type == 'user'){
            $this->validate($request, [
                'first_name' => 'required|max:60',
                'last_name' => 'required|max:60',
            ]);
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]);
        }

        return redirect()->back();
    }


    public function peerTrust(Request $request){
        $task =   Auth::user()->following()->wherePivot('follow_id', $request->id)->first();
        $task->pivot->trust = $request->value;
        $task->pivot->save();

    }

    public function notifications(){
        $notifications = Notify::where('user_id', Auth::id())->orderBy('created_at', 'desc');
        $notifications->update(['seen' => 1]);
        $notifications = $notifications->paginate(20);
        return view('notifications', compact('notifications'));
    }

    public function messages(Request $request)
    {

        $chat = false;
        $person = false;
        $conversation_id = false;

        $conversations = Conversation::where(function($query){
            $query->where('from_id', Auth::id());
            $query->orWhere('to_id', Auth::id());
        })->get();

        if($request->id){

            $chat = Conversation::where(function($query){
                $query->where('from_id', Auth::id());
                $query->orWhere('to_id', Auth::id());
            })->where('id', $request->id)->first();


            if($chat && $chat->messages){
                if($chat->messages()->count() > 0 ){
                    if($chat->messages->last()->seen == 0 && $chat->messages->last()->to_id == Auth::id()){
                        $chat->messages()->update([
                            'seen' => 1
                        ]);
                    }
                }
            }


            $conversation_id = $request->id;
            if($chat){
                $person = $chat->from_id == Auth::id() ? $chat->to_id : $chat->from_id ;
                $person = User::find($person);
            }else{
                $person = [];
            }
        }

        return view('messages',compact('conversations','chat','person','conversation_id'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|min:1',
            'conversation_id' => 'required'
        ]);

        $blocked = false;
        $message = "";
        $conversation = Conversation::find($request->conversation_id);
        $to_id = $conversation->from_id == Auth::id() ? $conversation->to_id : $conversation->from_id;

        $blocked = FunctionController::checkBlock($to_id);

        if(!$blocked){
            $message =  Message::create([
                'conversation_id' => $conversation->id,
                'message' => $request->message,
                'from_id' => Auth::id(),
                'to_id' =>$to_id
            ]);
        }



        return response()->json([
            'html' => view('areas.message', compact('message','blocked'))->render(),
        ]);
    }
    public function deleteMessage(Request $request)
    {

       $message = Message::where('id', $request->id)->where('from_id', Auth::id())->first();
       if($message){
           $message->delete();
       }

        return response()->json([
            'result' => true,
        ]);
    }

    public function addConversation(Request $request, $id)
    {

        $conversation_1 = Conversation::where(['from_id' => Auth::id(), 'to_id' => (int) $id])->first();
        $conversation_2 = Conversation::where(['from_id' => (int) $id, 'to_id' => Auth::id()])->first();

        $check_conversation = $conversation_1 ? $conversation_1 : $conversation_2;

        if($check_conversation){
            $conversation = $check_conversation;
        }else{
            $conversation = Conversation::create([
                'from_id' => Auth::id(),
                'to_id' => $request->id,
            ]);
        }


        return redirect()->route('messages', ['id' => $conversation->id]);
    }

    public function checkMessages()
    {
        $result = FunctionController::checkMessages();

        return response()->json(['result' => $result]);
    }

    public function createProfile(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:60'],
            'last_name' => ['required', 'string', 'max:60'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'same:password', 'min:8'],
        ]);

        if(!Auth::user()->isPro()){
            if(User::where('parent_id', Auth::id())->count() + 1 > 3){
                return redirect()->back()->with('error', 'Channels limit is 3');
            }
        }


        User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'company_name' => $request['company_name'],
            'parent_id' => Auth::id(),
            'main' => 0,
            'type' => 10,
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->back()->with('success', 'User is created');
    }

    public function removeProfile($id){
        $item = User::find($id);
        $item->delete();

        return redirect()->back();
    }

    public function myChannels(){

        if(Auth::user()->type == 20){
            return redirect()->route('home');
        }
        $my_channels  = User::where('parent_id', Auth::id())->get();

        return view('my-channels', compact('my_channels'));
    }

    public function editChannel($id){

        $user = User::where('id', $id)->where('parent_id', Auth::id())->firstOrFail();
        $rss_feeds = RssFeed::where('user_id',$id)->get();
        $categories = Category::get();

        return view('edit-channel', compact('user','rss_feeds','categories'));
    }

    public function commented(){
        $articles = Auth::user()->commented_feed()->distinct()->paginate(20);
        return view('commented', compact('articles'));
    }

}
