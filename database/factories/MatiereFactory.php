<?php

namespace Database\Factories;

use App\Models\Matiere;
use App\Models\Filiere;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatiereFactory extends Factory
{
    protected $model = Matiere::class;

    public function definition(): array
    {
        $matieres = [
            'Programmation Orientée Objet',
            'Base de Données',
            'Analyse Mathématique',
            'Algèbre Linéaire',
            'Physique Générale',
            'Chimie Organique',
            'Électromagnétisme',
            'Mécanique Classique',
            'Web Development',
            'API REST',
            'Sécurité Informatique',
            'Machine Learning',
            'Calcul Scientifique',
            'Théorie des Graphes',
            'Systèmes d\'Exploitation',
        ];

        return [
            'nom_matiere' => $this->faker->unique()->randomElement($matieres),
            'volume_heure' => $this->faker->numberBetween(30, 120),
            'niveau' => $this->faker->randomElement(['Licence', 'Master']),
            'description' => $this->faker->sentence(10),
            'filiere_id' => Filiere::inRandomOrder()->first()?->id ?? Filiere::factory(),
        ];
    }
}
