<?php

namespace App\Http\Controllers;

use App\Models\ChannelWhiteList;
use App\Models\RssFeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RssController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function toWhitelist(Request $request){
        $request->validate([
            'url_whitelist' => 'required|url'
        ]);


        if(!ChannelWhiteList::where('url', $request->url_whitelist)->first()){
            ChannelWhiteList::create([
                'url' => $request->url_whitelist,
                'user_id' => Auth::id(),
                'status' => 0
            ]);
            return redirect()->back()->with('success-whitelist', 'Source is sended');
        }else{
            return redirect()->back()->with('success-whitelist', 'Source is already sended');
        }
    }

    public function store(Request $request, $id){
        $this->validate($request, [
            'url' => ['required', 'url', 'unique:rss_feeds'],
            'category_id' => ['required'],
        ]);
        $path_info = pathinfo($request['url']);

        if(!isset($path_info['extension']) || isset($path_info['extension'])  && $path_info['extension'] != 'xml' && $path_info['extension'] != 'rss'){
            return redirect()->back()->with('error', 'Rss format is wrong  (only rss, xml extensions)');
        }


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
