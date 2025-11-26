<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = ['name', 'surface_type', 'price_per_hour'];

    public function photos()
    {
        return $this->hasMany(FieldPhoto::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
