<?php

namespace App\Console\Commands;

use App\Models\Feed;
use App\Models\RssFeed;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Vedmant\FeedReader\Facades\FeedReader;

class RssReader extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rss:read';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rss Reader';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $rss_links = RssFeed::all();

        Log::info('here');

        foreach ($rss_links as $rss_link){

            $f = FeedReader::read($rss_link->url);

            $items = $f->get_items();

            foreach (array_reverse($items) as $item){

                $title = $item->get_title();
                $content = $item->get_content();
                $content = strip_tags($content);
                $link = $item->get_link();

                $check_unique = Feed::where('category_id', $rss_link->category_id)->where('user_id', $rss_link->user_id)->orderBy('id','desc')->take(500)->get();

                $to_search = $title;
                $res_search = $check_unique->filter(function ($item) use ($to_search) {
                    return false !== stristr($item->title, $to_search);
                });

                if($res_search && $res_search->count() == 0){
                    Feed::create([
                        'category_id' => $rss_link->category_id,
                        'user_id' => $rss_link->user_id,
                        'title' => $title,
                        'description' => $content,
                        'status' => 1,
                        'comment_access' => 1,
                        'author_name' => '',
                        'url' => $link
                    ]);
                }
            }
        }
    }
}
