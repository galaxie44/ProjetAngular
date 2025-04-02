<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\Soiree;
use Carbon\Carbon;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $soirees = Soiree::all();
        $statuts = ['Confirmee', 'En attente', 'Annulee'];

        $reservations = [
            [
                'soiree_id' => $soirees[0]->id,
                'nom_etudiant' => 'Jean Dupont',
                'email' => 'jean.dupont@example.com',
                'telephone' => '0612345678',
                'date_reservation' => Carbon::now()->subDays(5),
                'statut' => 'Confirmee'
            ],
            [
                'soiree_id' => $soirees[1]->id,
                'nom_etudiant' => 'Marie Martin',
                'email' => 'marie.martin@example.com',
                'telephone' => '0623456789',
                'date_reservation' => Carbon::now()->subDays(3),
                'statut' => 'En attente'
            ],
            [
                'soiree_id' => $soirees[2]->id,
                'nom_etudiant' => 'Pierre Durand',
                'email' => 'pierre.durand@example.com',
                'telephone' => '0634567890',
                'date_reservation' => Carbon::now()->subDays(1),
                'statut' => 'Confirmee'
            ],
            [
                'soiree_id' => $soirees[3]->id,
                'nom_etudiant' => 'Sophie Bernard',
                'email' => 'sophie.bernard@example.com',
                'telephone' => '0645678901',
                'date_reservation' => Carbon::now()->subDays(2),
                'statut' => 'Annulee'
            ],
            [
                'soiree_id' => $soirees[4]->id,
                'nom_etudiant' => 'Lucas Petit',
                'email' => 'lucas.petit@example.com',
                'telephone' => '0656789012',
                'date_reservation' => Carbon::now()->subDays(4),
                'statut' => 'Confirmee'
            ]
        ];

        foreach ($reservations as $reservation) {
            Reservation::create($reservation);
        }

        // Créer des réservations aléatoires supplémentaires
        for ($i = 0; $i < 10; $i++) {
            $soiree = $soirees->random();
            Reservation::create([
                'soiree_id' => $soiree->id,
                'nom_etudiant' => fake()->name(),
                'email' => fake()->email(),
                'telephone' => fake()->numerify('06########'),
                'date_reservation' => Carbon::now()->subDays(rand(1, 10)),
                'statut' => $statuts[array_rand($statuts)]
            ]);
        }
    }
} 