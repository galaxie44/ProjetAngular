<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom_etudiant',
        'email',
        'telephone',
        'soiree_id',
        'date_reservation',
        'statut'
    ];

    protected $casts = [
        'date_reservation' => 'datetime'
    ];

    public function soiree()
    {
        return $this->belongsTo(Soiree::class);
    }
}
