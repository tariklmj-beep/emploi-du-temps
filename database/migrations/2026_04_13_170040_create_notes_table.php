<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained('etudiants')->cascadeOnDelete();
            $table->foreignId('matiere_id')->constrained('matieres')->cascadeOnDelete();
            $table->decimal('valeur', 5, 2);
            $table->date('date_eval')->nullable();
            $table->enum('type', ['controle', 'devoir', 'tp', 'examen'])->default('controle');
            $table->timestamps();

            $table->index(['etudiant_id', 'matiere_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};

