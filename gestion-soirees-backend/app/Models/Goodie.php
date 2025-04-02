<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goodie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
        'description',
        'quantite_disponible',
        'image_url',
        'soiree_id'
    ];

    protected $casts = [
        'quantite_disponible' => 'integer'
    ];

    public function soiree()
    {
        return $this->belongsTo(Soiree::class);
    }
}
