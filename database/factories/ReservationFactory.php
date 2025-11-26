<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Field;

class ReservationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'field_id' => Field::inRandomOrder()->first()?->id ?? Field::factory(),
            'date' => $this->faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),

            // Slots fijos (puedes agregar más)
            'time_slot' => $this->faker->randomElement([
                '06:00-07:00',
                '07:00-08:00',
                '08:00-09:00',
                '16:00-17:00',
                '17:00-18:00',
                '18:00-19:00',
                '19:00-20:00',
            ]),

            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
        ];
    }
}
