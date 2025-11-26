<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FieldPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_id',
        'photo_path',
    ];

    // Relaciones
    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
