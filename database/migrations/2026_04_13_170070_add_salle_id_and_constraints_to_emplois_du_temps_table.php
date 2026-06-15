<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Clean duplicates before unique indexes are created.
        DB::statement("DELETE t1 FROM emplois_du_temps t1 INNER JOIN emplois_du_temps t2 WHERE t1.id > t2.id AND t1.enseignant_id = t2.enseignant_id AND t1.jour = t2.jour AND t1.heure_debut = t2.heure_debut");
        DB::statement("DELETE t1 FROM emplois_du_temps t1 INNER JOIN emplois_du_temps t2 WHERE t1.id > t2.id AND t1.filiere_id = t2.filiere_id AND t1.jour = t2.jour AND t1.heure_debut = t2.heure_debut");

        Schema::table('emplois_du_temps', function (Blueprint $table) {
            if (! Schema::hasColumn('emplois_du_temps', 'salle_id')) {
                $table->foreignId('salle_id')
                    ->nullable()
                    ->after('enseignant_id')
                    ->constrained('salles')
                    ->nullOnDelete();
            }

            if (! $this->indexExists('emplois_du_temps', 'edt_unique_enseignant_slot')) {
                $table->unique(['enseignant_id', 'jour', 'heure_debut'], 'edt_unique_enseignant_slot');
            }

            if (! $this->indexExists('emplois_du_temps', 'edt_unique_filiere_slot')) {
                $table->unique(['filiere_id', 'jour', 'heure_debut'], 'edt_unique_filiere_slot');
            }

            if (! $this->indexExists('emplois_du_temps', 'emplois_du_temps_jour_heure_debut_index')) {
                $table->index(['jour', 'heure_debut']);
            }
        });
    }

    public function down(): void
    {
        Schema::table('emplois_du_temps', function (Blueprint $table) {
            if ($this->indexExists('emplois_du_temps', 'edt_unique_enseignant_slot')) {
                $table->dropUnique('edt_unique_enseignant_slot');
            }

            if ($this->indexExists('emplois_du_temps', 'edt_unique_filiere_slot')) {
                $table->dropUnique('edt_unique_filiere_slot');
            }

            if ($this->indexExists('emplois_du_temps', 'emplois_du_temps_jour_heure_debut_index')) {
                $table->dropIndex(['jour', 'heure_debut']);
            }

            if (Schema::hasColumn('emplois_du_temps', 'salle_id')) {
                $table->dropConstrainedForeignId('salle_id');
            }
        });
    }

    private function indexExists(string $table, string $index): bool
    {
        return DB::table('information_schema.statistics')
            ->where('table_schema', DB::raw('DATABASE()'))
            ->where('table_name', $table)
            ->where('index_name', $index)
            ->exists();
    }
};

