<?php

namespace Database\Factories;

use App\Models\EmploiDuTemps;
use App\Models\Filiere;
use App\Models\Matiere;
use App\Models\Enseignant;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmploiDuTempsFactory extends Factory
{
    protected $model = EmploiDuTemps::class;

    public function definition(): array
    {
        $types = ['Cours', 'TP', 'TD'];
        $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
        $heures_debut = ['08:30', '09:30', '10:30', '11:30', '12:30', '13:30', '14:30', '15:30', '16:30', '17:30'];
        $salles = array_map(fn($i) => 'Salle ' . $i, range(101, 110));

        $heure_debut = $this->faker->randomElement($heures_debut);
        $heure_fin_time = \DateTime::createFromFormat('H:i', $heure_debut);
        $dureeHeures = $this->faker->randomElement([1, 1, 2]);
        $heure_fin_time->modify('+' . $dureeHeures . ' hour');

        if ($heure_fin_time->format('H:i') > '18:30') {
            $heure_fin_time = \DateTime::createFromFormat('H:i', '18:30');
        }

        $heure_fin = $heure_fin_time->format('H:i');

        return [
            'jour' => $this->faker->randomElement($jours),
            'heure_debut' => $heure_debut,
            'heure_fin' => $heure_fin,
            'salle' => $this->faker->randomElement($salles),
            'semestre' => $this->faker->randomElement(['S1', 'S2', 'S3', 'S4', 'S5', 'S6']),
            'type_cours' => $this->faker->randomElement($types),
            'filiere_id' => Filiere::inRandomOrder()->first()?->id ?? Filiere::factory(),
            'matiere_id' => Matiere::inRandomOrder()->first()?->id ?? Matiere::factory(),
            'enseignant_id' => Enseignant::inRandomOrder()->first()?->id ?? Enseignant::factory(),
        ];
    }
}
