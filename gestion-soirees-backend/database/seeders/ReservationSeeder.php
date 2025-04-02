<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\Soiree;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $soirees = Soiree::all();
        
        // Créer 15 réservations
        for ($i = 0; $i < 15; $i++) {
            $soiree = $soirees->random();
            $statut = rand(0, 2); // 0: en attente, 1: confirmée, 2: annulée
            
            Reservation::create([
                'nom_etudiant' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'telephone' => fake()->phoneNumber(),
                'soiree_id' => $soiree->id,
                'date_reservation' => fake()->dateTimeBetween('-1 month', 'now'),
                'statut' => $statut
            ]);
        }
    }
} 