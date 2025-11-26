<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Field;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $fields = Field::all();

        if ($users->isEmpty() || $fields->isEmpty()) {
            return;
        }

        for ($i = 0; $i < 20; $i++) {
            Reservation::create([
                'user_id' => $users->random()->id,
                'field_id' => $fields->random()->id,
                'date' => now()->addDays(rand(-15, 30))->format('Y-m-d'),
                'start_time' => sprintf('%02d:00', rand(6, 20)),
                'end_time' => sprintf('%02d:00', rand(7, 22)),
                'status' => ['pending', 'confirmed', 'cancelled'][array_rand(['pending', 'confirmed', 'cancelled'])],
            ]);
        }
    }
}
