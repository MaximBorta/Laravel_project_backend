<?php

namespace Database\Seeders;

use App\Models\Home\HomeCard;
use Illuminate\Database\Seeder;

class HomeCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HomeCard::factory()->count(100)->create();
    }
}
