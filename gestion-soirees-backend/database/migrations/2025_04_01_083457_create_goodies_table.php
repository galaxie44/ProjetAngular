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
        Schema::create('goodies', function (Blueprint $table) {
            $table->id(); // ID du goodie
            $table->string('nom'); // Nom du goodie (Bracelet, T-shirt, etc.)
            $table->integer('quantite'); // Quantité disponible
            $table->text('description'); // Description du goodie
            $table->decimal('cout_unitaire', 8, 2)->nullable(); // Coût unitaire estimé (optionnel)
            $table->timestamps(); // Champs created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goodies');
    }
};