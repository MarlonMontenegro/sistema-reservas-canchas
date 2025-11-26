<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Field;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fields = [
            [
                'name' => 'Cancha Central',
                'type' => 'synthetic',
                'price_per_hour' => 25,
            ],
            [
                'name' => 'Cancha Norte',
                'type' => 'cement',
                'price_per_hour' => 18,
            ],
            [
                'name' => 'Cancha Sur',
                'type' => 'natural',
                'price_per_hour' => 30,
            ],
        ];

        foreach ($fields as $data) {
            Field::create($data);
        }
    }
}
