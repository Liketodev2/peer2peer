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
