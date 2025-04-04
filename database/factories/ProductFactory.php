<?php
namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {

        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'short_description' => $this->faker->sentence(),
            'thumbnail' => $this->faker->imageUrl(640, 480, 'products'),
            'status' => 1, 
            'category_id' => fake(),
        ];
    }
}

