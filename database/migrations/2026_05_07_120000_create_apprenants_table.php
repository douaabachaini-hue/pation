<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécute la migration: création de la table apprenants.
     */
    public function up(): void
    {
        Schema::create('apprenants', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée.
            $table->string('nom'); // Nom complet de l'apprenant.
            $table->integer('age'); // Âge de l'apprenant.
            $table->timestamps(); // Colonnes created_at et updated_at.
        });
    }

    /**
     * Annule la migration: suppression de la table apprenants.
     */
    public function down(): void
    {
        Schema::dropIfExists('apprenants');
    }
};
