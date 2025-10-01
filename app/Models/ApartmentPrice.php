<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApartmentPrice extends Model
{
    protected $fillable = ['apartment_id', 'start_date', 'end_date', 'price'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
