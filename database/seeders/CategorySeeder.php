<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([

            [
                'name' => 'US',
            ],
            [
                'name' => 'World',
            ],
            [
                'name' => 'Business/Money',
            ],
            [
                'name' => 'Entertainment/Life',
            ],
            [
                'name' => 'Science',
            ],
            [
                'name' => 'Tech',
            ],
            [
                'name' => 'Health',
            ],
            [
                'name' => 'Sports',
            ],
            [
                'name' => 'Travel',
            ],
            [
                'name' => 'Locale',
            ]
        ]);
    }
}
