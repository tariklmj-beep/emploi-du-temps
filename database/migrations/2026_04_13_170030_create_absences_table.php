<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained('etudiants')->cascadeOnDelete();
            $table->foreignId('matiere_id')->constrained('matieres')->cascadeOnDelete();
            $table->date('date_absence');
            $table->boolean('justifie')->default(false);
            $table->text('motif')->nullable();
            $table->timestamps();

            $table->index(['etudiant_id', 'date_absence']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};

