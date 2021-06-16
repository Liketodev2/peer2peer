<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feeds')->insert([
            [
                'category_id' => '1',
                'user_id' => '1',
                'title' => '1. Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'description' => '1. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
                'status' => 0,
                'author_name' => 'author',
                'url' => 'http://test.com',
                'comment_access' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'category_id' => '1',
                'user_id' => '1',
                'title' => '2. Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'description' => '2. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
                'status' => 0,
                'author_name' => 'author',
                'url' => 'http://test.com',
                'comment_access' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'category_id' => '1',
                'user_id' => '1',
                'title' => '3. Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'description' => '3. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
                'status' => 0,
                'author_name' => 'author',
                'url' => 'http://test.com',
                'comment_access' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'category_id' => '2',
                'user_id' => '1',
                'title' => '4. Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'description' => '4. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
                'status' => 0,
                'author_name' => 'author',
                'url' => 'http://test.com',
                'comment_access' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'category_id' => '2',
                'user_id' => '1',
                'title' => '5. Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'description' => '5. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
                'status' => 0,
                'author_name' => 'author',
                'url' => 'http://test.com',
                'comment_access' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'category_id' => '3',
                'user_id' => '1',
                'title' => '6. Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'description' => '6. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
                'status' => 0,
                'author_name' => 'author',
                'url' => 'http://test.com',
                'comment_access' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'category_id' => '3',
                'user_id' => '1',
                'title' => '7. Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'description' => '7. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
                'status' => 0,
                'author_name' => 'author',
                'url' => 'http://test.com',
                'comment_access' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
