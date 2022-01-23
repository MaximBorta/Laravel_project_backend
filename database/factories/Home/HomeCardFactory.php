<?php

namespace Database\Factories\Home;

use App\Models\Home\HomeCard;
use Illuminate\Database\Eloquent\Factories\Factory;

class HomeCardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HomeCard::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomPic = rand(1, 100);
        return [
            'title' => $this->faker->text('20'),
            'description' => $this->faker->text('40'),
            'card_img' => "https://source.unsplash.com/collection/".$randomPic."/1900x700",
        ];
    }
}
