<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = User::where('id','!=', Auth::id())->paginate(20);
        return view('dashboard.users.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'company_name' => 'required',
            'type' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_name' => $request->company_name,
            'type' => $request->type,
            'category_id' => $request->category_id,
            'email' => $request->email,
            'password' => (new BcryptHasher())->make($request->get('password')),
        ]);

        return redirect()->back()->with('success', 'User is created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $feeds = $user->feed()->paginate(20);
        return view('dashboard.users.show', compact('user','feeds'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
