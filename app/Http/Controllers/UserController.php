<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Follow;
use App\Models\Message;
use App\Models\Notify;
use App\Models\User;
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

    public function peers(Request $request)
    {

        if(isset($request->trust)){
            $peers =  Auth::user()->following()->wherePivot('trust', $request->trust)->where('type', 10)->get();
        }else{
            $peers =  Auth::user()->following->where('type', 10);
        }


        return view('peers', compact('peers'));
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

        $conversation = Conversation::find($request->conversation_id);
        $to_id = $conversation->from_id == Auth::id() ? $conversation->to_id : $conversation->from_id;
        $message =  Message::create([
            'conversation_id' => $conversation->id,
            'message' => $request->message,
            'from_id' => Auth::id(),
            'to_id' =>$to_id
        ]);


        return response()->json([
            'html' => view('areas.message', compact('message'))->render(),
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

        $check_converstaion =  Conversation::where(function($query) use ($id){
            $query->where(['from_id' => Auth::id(), 'to_id' => (int) $id])->orWhere(['from_id' => (int) $id, 'to_id' => Auth::id()]);
        })->first();

        if($check_converstaion){
            $conversation = $check_converstaion;
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

        if(User::where('parent_id', Auth::id())->count() + 1 > 3){
            return redirect()->back()->with('error', 'Channels limit is 3');
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

        $my_channels  = User::where('parent_id', Auth::id())->get();

        return view('my-channels', compact('my_channels'));
    }

}
