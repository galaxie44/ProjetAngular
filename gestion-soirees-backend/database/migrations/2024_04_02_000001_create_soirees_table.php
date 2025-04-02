<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('soirees', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('lieu');
            $table->dateTime('date');
            $table->decimal('prix', 8, 2);
            $table->integer('capacite_maximale');
            $table->string('theme');
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('soirees');
    }
}; 