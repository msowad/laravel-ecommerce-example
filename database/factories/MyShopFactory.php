<?php

namespace Database\Factories;

use App\Models\MyShop;
use Illuminate\Database\Eloquent\Factories\Factory;

class MyShopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MyShop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'laravel',
        ];
    }
}
