<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function imageUpload(Request $request){

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

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

        $follow = $user->followers()->where('follow_id', $follow_id)->first();


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
            $peers =  Auth::user()->followers()->wherePivot('trust', $request->trust)->where('type', 10)->get();
        }else{
            $peers =  Auth::user()->followers->where('type', 10);
        }

        return view('peers', compact('peers'));
    }

    public function changePassword(Request $request){


        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_new_password' => 'required|same:new_password|min:6',
        ]);


        if (Hash::check($request->get('current_password'), Auth::user()->password)) {
            $user = User::find(Auth::user()->id);
            $user->password = (new BcryptHasher())->make($request->get('new_password'));
            if ($user->save()) {
                return redirect()->back()->with('success', 'Password is changed');
            }
        } else {
            throw ValidationException::withMessages(['current_password' => 'Current password is wrong']);
            return redirect()->back();
        }
    }

    public function peerTrust(Request $request){
        $task =   Auth::user()->followers()->wherePivot('follow_id', $request->id)->first();
        $task->pivot->trust = $request->value;
        $task->pivot->save();

    }

    public function notifications(){
        return view('notifications');
    }
}
