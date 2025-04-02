<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Soiree extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
        'lieu',
        'date',
        'prix',
        'capacite_maximale',
        'theme',
        'description',
        'image_url'
    ];

    protected $casts = [
        'date' => 'datetime',
        'prix' => 'decimal:2'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function goodies()
    {
        return $this->hasMany(Goodie::class);
    }
}
