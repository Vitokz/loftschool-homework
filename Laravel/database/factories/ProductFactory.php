<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = Category::all()->toArray();
        return [
            'namePrd' => $this->faker->name(),
            'category' => $categories[mt_rand(1,6)]['id'],
            'price' => mt_rand(200, 1000),
            'img' => 'deus-ex-mankind-divided_1613397074',
            'text'=>$this->faker->text(rand(100, 150))
        ];
    }
}
