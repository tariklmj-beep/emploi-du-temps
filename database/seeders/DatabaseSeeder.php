<?php

namespace Database\Seeders;

use App\Models\Absence;
use App\Models\Classe;
use App\Models\DisponibiliteEnseignant;
use App\Models\EmploiDuTemps;
use App\Models\Enseignant;
use App\Models\Etudiant;
use App\Models\User;
use App\Models\Filiere;
use App\Models\Matiere;
use App\Models\Note;
use App\Models\Salle;
use App\Models\SupportCours;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        EmploiDuTemps::truncate();
        Absence::truncate();
        Note::truncate();
        SupportCours::truncate();
        DisponibiliteEnseignant::truncate();
        Etudiant::truncate();
        Classe::truncate();
        Matiere::truncate();
        Enseignant::truncate();
        Salle::truncate();
        Filiere::truncate();
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        User::create([
            'name' => 'Admin Principal',
            'email' => 'admin@gmail.com',
            'role' => User::ROLE_ADMIN,
            'password' => Hash::make('Tarik.123'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Professeur Demo',
            'email' => 'prof@gmail.com',
            'role' => User::ROLE_PROFESSEUR,
            'password' => Hash::make('Tarik.123'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Etudiant Demo',
            'email' => 'etudiant@gmail.com',
            'role' => User::ROLE_ETUDIANT,
            'password' => Hash::make('Tarik.123'),
            'email_verified_at' => now(),
        ]);

        $filieres = Filiere::factory(5)->create();

        $matieres = collect();
        foreach ($filieres as $filiere) {
            $filiereMatieres = Matiere::factory(3)->create([
                'filiere_id' => $filiere->id,
            ]);
            $matieres = $matieres->merge($filiereMatieres);
        }

        $enseignants = Enseignant::factory(8)->create();

        $classes = collect();
        foreach ($filieres as $filiere) {
            $classes = $classes->merge([
                Classe::create([
                    'nom' => 'A-' . $filiere->id,
                    'annee_scolaire' => '2025-2026',
                    'filiere_id' => $filiere->id,
                ]),
                Classe::create([
                    'nom' => 'B-' . $filiere->id,
                    'annee_scolaire' => '2025-2026',
                    'filiere_id' => $filiere->id,
                ]),
            ]);
        }

        $salles = collect(range(101, 110))->map(function ($n) {
            return Salle::create([
                'nom' => 'Salle ' . $n,
                'capacite' => fake()->numberBetween(25, 60),
                'batiment' => fake()->randomElement(['Bloc A', 'Bloc B']),
            ]);
        });

        $etudiants = collect();
        foreach ($classes as $classe) {
            $etudiants = $etudiants->merge(
                Etudiant::factory(fake()->numberBetween(8, 12))->create([
                    'filiere_id' => $classe->filiere_id,
                    'classe_id' => $classe->id,
                ])
            );
        }

        foreach ($enseignants as $enseignant) {
            foreach (['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi'] as $jour) {
                DisponibiliteEnseignant::create([
                    'enseignant_id' => $enseignant->id,
                    'jour' => $jour,
                    'heure_debut' => '08:30:00',
                    'heure_fin' => '18:30:00',
                ]);
            }
        }

        $typesCours = ['Cours', 'TD', 'TP'];
        $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
        $slotStarts = ['08:30:00', '09:30:00', '10:30:00', '11:30:00', '12:30:00', '13:30:00', '14:30:00', '15:30:00', '16:30:00', '17:30:00'];

        $usedTeacher = [];
        $usedFiliere = [];
        $usedSalle = [];

        foreach ($filieres as $filiere) {
            $matieresFiliere = $matieres->where('filiere_id', $filiere->id)->values();

            for ($i = 0; $i < fake()->numberBetween(6, 10); $i++) {
                $placed = false;

                for ($attempt = 0; $attempt < 120; $attempt++) {
                    $heureDebut = fake()->randomElement($slotStarts);
                    $dureeHeures = fake()->randomElement([1, 1, 2]);

                    $heureFinObject = \DateTime::createFromFormat('H:i:s', $heureDebut);
                    $heureFinObject->modify('+' . $dureeHeures . ' hour');
                    $heureFin = $heureFinObject->format('H:i:s');

                    if ($heureFin > '18:30:00') {
                        continue;
                    }

                    $jour = fake()->randomElement($jours);
                    $enseignant = $enseignants->random();
                    $matiere = $matieresFiliere->random();
                    $salle = $salles->random();

                    $hasOverlap = static function (array $intervals, string $start, string $end): bool {
                        foreach ($intervals as [$existingStart, $existingEnd]) {
                            if ($existingStart < $end && $start < $existingEnd) {
                                return true;
                            }
                        }

                        return false;
                    };

                    $teacherKey = $enseignant->id . '|' . $jour;
                    $filiereKey = $filiere->id . '|' . $jour;
                    $salleKey = $salle->id . '|' . $jour;

                    if (
                        $hasOverlap($usedTeacher[$teacherKey] ?? [], $heureDebut, $heureFin)
                        || $hasOverlap($usedFiliere[$filiereKey] ?? [], $heureDebut, $heureFin)
                        || $hasOverlap($usedSalle[$salleKey] ?? [], $heureDebut, $heureFin)
                    ) {
                        continue;
                    }

                    EmploiDuTemps::create([
                        'jour' => $jour,
                        'heure_debut' => $heureDebut,
                        'heure_fin' => $heureFin,
                        'salle' => $salle->nom,
                        'semestre' => fake()->randomElement(['S1', 'S2', 'S3', 'S4', 'S5', 'S6']),
                        'type_cours' => fake()->randomElement($typesCours),
                        'filiere_id' => $filiere->id,
                        'matiere_id' => $matiere->id,
                        'enseignant_id' => $enseignant->id,
                        'salle_id' => $salle->id,
                    ]);

                    $usedTeacher[$teacherKey][] = [$heureDebut, $heureFin];
                    $usedFiliere[$filiereKey][] = [$heureDebut, $heureFin];
                    $usedSalle[$salleKey][] = [$heureDebut, $heureFin];
                    $placed = true;
                    break;
                }

                if (! $placed) {
                    break;
                }
            }
        }

        foreach ($matieres as $matiere) {
            $enseignant = $enseignants->random();
            SupportCours::create([
                'titre' => 'Support - ' . $matiere->nom_matiere,
                'fichier' => 'supports/' . fake()->uuid() . '.pdf',
                'matiere_id' => $matiere->id,
                'enseignant_id' => $enseignant->id,
            ]);
        }

        foreach ($etudiants as $etudiant) {
            $matieresEtudiant = $matieres->where('filiere_id', $etudiant->filiere_id)->values();

            foreach ($matieresEtudiant->take(3) as $matiere) {
                Note::create([
                    'etudiant_id' => $etudiant->id,
                    'matiere_id' => $matiere->id,
                    'valeur' => fake()->randomFloat(2, 8, 20),
                    'date_eval' => fake()->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
                    'type' => fake()->randomElement(['controle', 'devoir', 'tp', 'examen']),
                ]);
            }

            if (fake()->boolean(30) && $matieresEtudiant->isNotEmpty()) {
                Absence::create([
                    'etudiant_id' => $etudiant->id,
                    'matiere_id' => $matieresEtudiant->random()->id,
                    'date_absence' => fake()->dateTimeBetween('-2 months', 'now')->format('Y-m-d'),
                    'justifie' => fake()->boolean(50),
                    'motif' => fake()->optional()->sentence(),
                ]);
            }
        }
    }
}