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
    public function index(Request $request)
    {

        $items = User::where('id','!=', Auth::id())->orderBy('created_at','desc');

        if($request->search){
            $items = $items->where(function($query) use ($request) {
                $query->where('first_name', 'like', '%' . $request->search . '%');
                $query->orWhere('last_name', 'like', '%' . $request->search . '%');
                $query->orWhere('company_name', 'like', '%' . $request->search . '%');
            });
        }

        $items = $items->paginate(20);

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

        if($request->type == 10){
            $this->validate($request, [
                'first_name' => 'required|max:60',
                'last_name' => 'required|max:60',
                'company_name' => 'required|max:60',
                'type' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required|min:8',
            ]);
        }else{
            $this->validate($request, [
                'first_name' => 'required|max:60',
                'last_name' => 'required|max:60',
                'type' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required|min:8',
            ]);
        }

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
        $feeds = $user->feed()->orderBy('id','desc')->paginate(20);
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
        $user = User::find($id);
        return view('dashboard.users.edit', compact('user'));
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
        if($request->type == 10){
            $this->validate($request, [
                'first_name' => 'required|max:60',
                'last_name' => 'required|max:60',
                'company_name' => 'required|max:60',
                'type' => 'required',
                'password' => 'nullable|min:8',
            ]);
        }else{
            $this->validate($request, [
                'first_name' => 'required|max:60',
                'last_name' => 'required|max:60',
                'type' => 'required',
                'password' => 'nullable|min:8',
            ]);
        }

        $user = User::find($id);

        if($request->email != $user->email){
            $this->validate($request, [
                'email' => 'required|unique:users'
            ]);
        }

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_name' => $request->company_name,
            'type' => $request->type,
            'category_id' => $request->category_id,
            'email' => $request->email
        ]);

        if($request->password){
            $user->update([
                'password' => (new BcryptHasher())->make($request->get('password'))
            ]);
        }

        return redirect()->back()->with('success', 'User is updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $item = User::find($id);
        $item->delete();

        return redirect()->back();
    }
}
