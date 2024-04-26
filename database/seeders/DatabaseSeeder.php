<?php

// Practiceのテストデータを10個作る

namespace Database\Seeders;

use App\Practice;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Sheet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Practice::factory(10)->create();
        // Movie::factory(30)->create();
        // Genre::factory(30)->create();
        $this->call(ScreenTableSeeder::class);
        $this->call(SheetTableSeeder::class);
    }
}
