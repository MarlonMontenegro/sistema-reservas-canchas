<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Field;

class FieldPhotoFactory extends Factory
{
    public function definition(): array
    {
        // Obtener un field existente o crear uno
        $field = Field::inRandomOrder()->first() ?? Field::factory()->create();

        // Normalizar el nombre para el archivo
        $fieldNameSlug = str_replace(' ', '_', strtolower($field->name));
        $timestamp = time();

        return [
            'field_id' => $field->id,
            'photo_path' => "fields/{$fieldNameSlug}_{$timestamp}.jpg",
        ];
    }
}
