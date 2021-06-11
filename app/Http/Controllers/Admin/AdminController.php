<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feed;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $info = [];
        $info['users'] = User::where('type', 20)->count();
        $info['companies'] = User::where('id','!=', Auth::id())->where('type', 10)->count();
        $info['feeds'] = Feed::count();

        return view('dashboard.index',compact('info'));
    }
}
