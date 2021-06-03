<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class GoogleController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }


    public function googleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $searchUser = User::where('google_id', $user->id)->first();

            if($searchUser){

                Auth::login($searchUser);

                return redirect('/dashboard');

            }else{
                $gitUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'auth_type'=> 'google',
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
