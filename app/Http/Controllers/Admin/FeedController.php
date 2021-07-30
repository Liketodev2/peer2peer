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
    public function index(Request $request)
    {
        $items = Feed::query();

        if($request->search){
            $items = $items->where(function($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%');
                $query->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $items = $items->orderBy('id','desc')->paginate(20);


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
        $users = User::where('id','!=', Auth::id())->get();
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
            'title' => 'required|max:120',
            'description' => 'required|max:600',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);

        Feed::create([
            'url' => $request->url,
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'status' => $request->status,
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
        $item->seen = 1;
        $item->save();
        $categories = Category::all();
        $users = User::where('id','!=', Auth::id())->get();
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
            'title' => 'required|max:120',
            'description' => 'required|max:600',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);

        Feed::find($id)->update([
            'url' => $request->url,
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'status' => $request->status,
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
        $item = Feed::find($id);
        $item->delete();

        return redirect()->back();
    }

    public function inactiveFeeds(Request $request){

        $items = Feed::where('status', 0);

        if($request->search){
            $items = $items->where(function($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%');
                $query->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $items = $items->orderBy('id','desc')->paginate(20);


        return view('dashboard.feeds.inactive', compact('items'));

    }
}
