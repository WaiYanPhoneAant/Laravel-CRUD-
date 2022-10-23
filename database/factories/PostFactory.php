<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $address=['Yangon','Mandalay','Myittha','pyay','bago','Bagan'];
        $title=['Title','select','texting','what about'];
        return [
            'title'=>$title[array_rand($title)],
            'description'=>$this->faker->text($maxNbChars = 500),
            'price'=>rand(2000,50000),
            'address'=> $address[array_rand($address)],
            // 'address'=>array_rand('00')
            'rating'=>rand(0,5),
        ];
    }
}
