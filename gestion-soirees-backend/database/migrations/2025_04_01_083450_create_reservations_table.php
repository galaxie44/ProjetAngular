<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id(); // Identifiant unique de la réservation
            $table->string('nom_etudiant'); // Nom de l'étudiant
            $table->string('email_etudiant'); // Email de l'étudiant
            $table->string('telephone_etudiant'); // Numéro de téléphone de l'étudiant
            $table->string('nom_soiree'); // Nom de la soirée réservée
            $table->date('date_reservation'); // Date de la réservation
            $table->enum('statut', ['Confirmée', 'En attente', 'Annulée']); // Statut de la réservation
            $table->timestamps(); // Champs created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};