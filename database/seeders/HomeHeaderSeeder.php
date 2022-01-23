<?php

namespace Database\Seeders;

use App\Models\Home\HomeHeader;
use Illuminate\Database\Seeder;

class HomeHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HomeHeader::factory()->count(10)->create();
    }
}
