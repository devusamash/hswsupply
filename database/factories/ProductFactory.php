<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'productId'=> $this->faker->unique()->productId,
            'productName'=> $this->faker->unique()->productName,
            'productDescription'=> $this->faker->productDescription,
            'productPrice'=> $this->faker->productPrice,
            'productQuantity'=> $this->faker->productQuantity,
            'categoryId'=> $this->faker->categoryId,
            'BrandId'=> $this->faker->brandId,
        ];
    }
}
