<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Soiree;
use Carbon\Carbon;

class SoireeSeeder extends Seeder
{
    public function run(): void
    {
        $soirees = [
            [
                'nom' => 'Soirée Halloween',
                'date' => Carbon::now()->addDays(30)->setTime(20, 0),
                'lieu' => 'Salle des fêtes',
                'prix' => 15.00,
                'capacite_maximale' => 100,
                'theme' => 'Halloween',
                'description' => 'Une soirée effrayante pour Halloween avec déguisements et animations',
                'image_url' => 'https://example.com/halloween.jpg',
                'places_disponibles' => 100
            ],
            [
                'nom' => 'Soirée Nouvel An',
                'date' => Carbon::now()->addDays(60)->setTime(22, 0),
                'lieu' => 'Grande salle',
                'prix' => 25.00,
                'capacite_maximale' => 200,
                'theme' => 'Nouvel An',
                'description' => 'Célébration du Nouvel An avec feu d\'artifice et buffet',
                'image_url' => 'https://example.com/newyear.jpg',
                'places_disponibles' => 200
            ],
            [
                'nom' => 'Soirée Casino',
                'date' => Carbon::now()->addDays(45)->setTime(19, 0),
                'lieu' => 'Centre de conférences',
                'prix' => 20.00,
                'capacite_maximale' => 150,
                'theme' => 'Casino',
                'description' => 'Une soirée casino avec jeux et animations',
                'image_url' => 'https://example.com/casino.jpg',
                'places_disponibles' => 150
            ],
            [
                'nom' => 'Soirée Karaoké',
                'date' => Carbon::now()->addDays(15)->setTime(21, 0),
                'lieu' => 'Bar étudiant',
                'prix' => 10.00,
                'capacite_maximale' => 80,
                'theme' => 'Karaoké',
                'description' => 'Une soirée karaoké avec lots à gagner',
                'image_url' => 'https://example.com/karaoke.jpg',
                'places_disponibles' => 80
            ],
            [
                'nom' => 'Soirée Jeux de Société',
                'date' => Carbon::now()->addDays(20)->setTime(18, 0),
                'lieu' => 'Salle de jeux',
                'prix' => 8.00,
                'capacite_maximale' => 50,
                'theme' => 'Jeux de Société',
                'description' => 'Une soirée jeux de société avec tournois',
                'image_url' => 'https://example.com/boardgames.jpg',
                'places_disponibles' => 50
            ]
        ];

        foreach ($soirees as $soiree) {
            Soiree::create($soiree);
        }
    }
} 