<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Goodie;
use App\Models\Soiree;

class GoodieSeeder extends Seeder
{
    public function run(): void
    {
        $soirees = Soiree::all();
        $goodies = [
            [
                'soiree_id' => $soirees[0]->id,
                'nom' => 'T-shirt Halloween',
                'quantite_disponible' => 50,
                'prix' => 10.00
            ],
            [
                'soiree_id' => $soirees[0]->id,
                'nom' => 'Masque Halloween',
                'quantite_disponible' => 30,
                'prix' => 5.00
            ],
            [
                'soiree_id' => $soirees[1]->id,
                'nom' => 'Chapeau de fête',
                'quantite_disponible' => 100,
                'prix' => 3.00
            ],
            [
                'soiree_id' => $soirees[1]->id,
                'nom' => 'Serpentin',
                'quantite_disponible' => 200,
                'prix' => 1.00
            ],
            [
                'soiree_id' => $soirees[2]->id,
                'nom' => 'Jetons Casino',
                'quantite_disponible' => 1000,
                'prix' => 0.00
            ],
            [
                'soiree_id' => $soirees[2]->id,
                'nom' => 'Carte à jouer',
                'quantite_disponible' => 100,
                'prix' => 2.00
            ],
            [
                'soiree_id' => $soirees[3]->id,
                'nom' => 'Microphone',
                'quantite_disponible' => 5,
                'prix' => 15.00
            ],
            [
                'soiree_id' => $soirees[3]->id,
                'nom' => 'Playlist Karaoké',
                'quantite_disponible' => 20,
                'prix' => 8.00
            ],
            [
                'soiree_id' => $soirees[4]->id,
                'nom' => 'Jeu de société',
                'quantite_disponible' => 10,
                'prix' => 20.00
            ],
            [
                'soiree_id' => $soirees[4]->id,
                'nom' => 'Dés',
                'quantite_disponible' => 50,
                'prix' => 1.00
            ]
        ];

        foreach ($goodies as $goodie) {
            Goodie::create($goodie);
        }
    }
} 