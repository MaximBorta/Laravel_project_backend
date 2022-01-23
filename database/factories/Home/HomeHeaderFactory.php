<?php

namespace Database\Factories\Home;

use App\Models\Home\HomeHeader;
use Illuminate\Database\Eloquent\Factories\Factory;

class HomeHeaderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HomeHeader::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomPic = rand(1, 10);
        return [
            'title' => $this->faker->text('20'),
            'description' => $this->faker->text('40'),
            'img' => "https://source.unsplash.com/collection/".$randomPic."/1900x700",
        ];
    }
}
