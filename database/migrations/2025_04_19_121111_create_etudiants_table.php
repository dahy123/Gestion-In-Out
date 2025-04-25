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
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // Colonne pour le nom de l'étudiant
            $table->string('email')->unique(); // Colonne pour l'email, avec contrainte d'unicité
            $table->string('image')->nullable(); // Colonne pour l'image, peut être null
            $table->timestamps(); // Colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};