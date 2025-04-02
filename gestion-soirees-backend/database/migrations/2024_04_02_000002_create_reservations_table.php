<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('nom_etudiant');
            $table->string('email');
            $table->string('telephone');
            $table->foreignId('soiree_id')->constrained('soirees')->onDelete('cascade');
            $table->dateTime('date_reservation');
            $table->enum('statut', ['Confirmee', 'En attente', 'Annulee'])->default('En attente');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
}; 