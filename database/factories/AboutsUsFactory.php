<?php

namespace Database\Factories;

use App\Models\AboutsUs;
use Illuminate\Database\Eloquent\Factories\Factory;

class AboutsUsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AboutsUs::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'body' => 'about us',
        ];
    }
}
