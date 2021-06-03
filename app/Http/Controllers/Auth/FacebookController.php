<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class FacebookController extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }


    public function facebookCallback()
    {
        try {

            $user = Socialite::driver('facebook')->user();

            $searchUser = User::where('facebook_id', $user->id)->first();

            if($searchUser){

                Auth::login($searchUser);

                return redirect('/');

            }else{
                $gitUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id'=> $user->id,
                    'auth_type'=> 'facebook',
                    'password' => encrypt('gitpwd059')
                ]);

                Auth::login($gitUser);

                return redirect('/');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
