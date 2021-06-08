<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
