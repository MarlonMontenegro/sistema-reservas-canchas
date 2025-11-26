<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FieldFactory extends Factory
{
    public function definition(): array
    {
        $types = ['synthetic', 'cement', 'natural'];

        return [
            'name' => $this->faker->unique()->sentence(2, false),   // Ej: "Cancha Norte"
            'surface_type' => $this->faker->randomElement($types),
            'price_per_hour' => $this->faker->numberBetween(10, 40), // Precio realista por hora
        ];
    }
}
