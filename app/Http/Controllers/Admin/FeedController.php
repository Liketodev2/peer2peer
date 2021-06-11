<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Feed;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Feed::orderBy('created_at','desc')->paginate(20);

        return view('dashboard.feeds.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $users = User::where('id','!=', Auth::id())->where('type', 10)->get();
        return view('dashboard.feeds.create', compact('categories','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
            'article' => 'required|max:60',
            'description' => 'required|max:300',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);

        Feed::create([
            'url' => $request->url,
            'article' => $request->article,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'status' => 1,
            'comment_access' => 1
        ]);

        return redirect()->back()->with('success', 'Feed is created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Feed::findOrFail($id);
        $categories = Category::all();
        $users = User::where('id','!=', Auth::id())->where('type', 10)->get();
        return view('dashboard.feeds.edit', compact('categories','item','users'));
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
        $request->validate([
            'url' => 'required|url',
            'article' => 'required|max:60',
            'description' => 'required|max:300',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);

        Feed::find($id)->update([
            'url' => $request->url,
            'article' => $request->article,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'status' => 1,
            'comment_access' => 1
        ]);

        return redirect()->back()->with('success', 'Feed is updated');
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
