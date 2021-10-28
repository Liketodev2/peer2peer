<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChannelWhiteList;
use App\Models\RssFeed;
use App\Models\User;
use Illuminate\Http\Request;

class RssController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = RssFeed::orderBy('id','desc')->paginate(20);
        $users = User::where('type', 10)->get();
        $categories = Category::all();

        return view('dashboard.rss.index', compact('items','users','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'url' => 'required|url',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);

        $path_info = pathinfo($request['url']);

        if(!isset($path_info['extension']) || isset($path_info['extension'])  && $path_info['extension'] != 'xml' && $path_info['extension'] != 'rss'){
            return redirect()->back()->with('error', 'Rss format is wrong  (only rss, xml extensions)');
        }

        RssFeed::create([
            'url' => $request->url,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->back();
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
        $item = RssFeed::find($id);
        $item->delete();

        return redirect()->back();
    }

    public function approve(Request $request){
        $channel = ChannelWhiteList::find($request->id);
        $channel->update([
            'status' => 1
        ]);

        return redirect()->back();
    }
}
