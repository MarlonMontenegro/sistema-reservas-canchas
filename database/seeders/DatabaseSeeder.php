<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Field;
use App\Models\FieldPhoto;
use App\Models\Reservation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::transaction(function () {

            // Crear admin
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'role' => 'admin',
                'password' => bcrypt('admin123'),
            ]);

            // Crear usuario normal
            User::factory()->create([
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'role' => 'user',
                'password' => bcrypt('password123'),
            ]);

            // Crear canchas (una por tipo)
            $fields = [
                [
                    'name' => 'Cancha Central',
                    'surface_type' => 'synthetic',
                    'price_per_hour' => 25,
                ],
                [
                    'name' => 'Cancha Norte',
                    'surface_type' => 'cement',
                    'price_per_hour' => 18,
                ],
                [
                    'name' => 'Cancha Sur',
                    'surface_type' => 'natural',
                    'price_per_hour' => 30,
                ],
            ];

            foreach ($fields as $fieldData) {
                Field::create($fieldData);
            }

            // Agregar fotos de ejemplo a cada cancha
            Field::all()->each(function ($field) {
                FieldPhoto::factory()->create([
                    'field_id' => $field->id,
                    'photo_path' => 'photos/' . $field->name . '_' . time() . '.jpg',
                ]);
            });

            // Crear reservas de prueba
            // Tomamos todos los usuarios y todas las canchas
            $users = User::all();
            $fields = Field::all();

            // Generamos 40 reservas variadas
            foreach (range(1, 40) as $i) {
                Reservation::factory()->create([
                    'user_id' => $users->random()->id,
                    'field_id' => $fields->random()->id,
                    'date' => now()->addDays(rand(-20, 20)),
                    'hour_slot' => rand(6, 22),
                ]);
            }

        });
    }
}
