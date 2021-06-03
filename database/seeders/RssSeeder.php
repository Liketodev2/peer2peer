<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RssSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rss_feeds')->insert([
            [
                'category_id' => '2',
                'user_id' => '1',
                'url' => 'http://rss.cnn.com/rss/cnn_world.rss',
            ],
            [
                 'category_id' => '2',
                 'user_id' => '2',
                 'url' => 'http://feeds.bbci.co.uk/news/world/rss.xml',
            ],
            [
                'category_id' => '2',
                'user_id' => '3',
                'url' => 'https://www.nytimes.com/section/world/rss.xml',
            ],
        ]);
    }
}
