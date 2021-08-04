<?php

namespace App\Http\Controllers;

use App\Models\RssFeed;
use Illuminate\Http\Request;

class RssController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $id){
        $this->validate($request, [
            'url' => ['required', 'url'],
            'category_id' => ['required'],
        ]);

        RssFeed::create([
            'url' => $request['url'],
            'user_id' => $id,
            'category_id' => $request['category_id']
        ]);

        return redirect()->back()->with('success', 'Rss is created');

    }

    public function delete(Request $request, $id){
        $item = RssFeed::find($id);
        $item->delete();

        return redirect()->back();
    }
}
