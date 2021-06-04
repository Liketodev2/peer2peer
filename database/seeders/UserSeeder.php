<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            [
                'first_name' => 'CNN',
                'last_name' => 'CNN',
                'company_name' => 'CNN',
                'type' => 10,
                'email' => 'cnn@gmail.com',
                'password' => bcrypt('123123123'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'first_name' => 'BBC',
                'last_name' => 'BBC',
                'company_name' => 'BBC',
                'type' => 10,
                'email' => 'bbc@gmail.com',
                'password' => bcrypt('123123123'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'first_name' => 'NYTimes',
                'last_name' => 'NYTimes',
                'company_name' => 'NYTimes',
                'type' => 10,
                'email' => 'nytimes@gmail.com',
                'password' => bcrypt('123123123'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'first_name' => 'First',
                'last_name' => 'Last',
                'company_name' => '',
                'type' => 20,
                'email' => 'test@gmail.com',
                'password' => bcrypt('123123123'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
