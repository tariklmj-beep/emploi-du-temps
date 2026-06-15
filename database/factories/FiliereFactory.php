<?php

namespace Database\Factories;

use App\Models\Filiere;
use Illuminate\Database\Eloquent\Factories\Factory;

class FiliereFactory extends Factory
{
    protected $model = Filiere::class;

    public function definition(): array
    {
        $niveaux = ['Licence 1', 'Licence 2', 'Licence 3', 'Master 1', 'Master 2'];
        $noms = [
            'Informatique',
            'Mathématiques',
            'Physique',
            'Génie Électrique',
            'Génie Mécanique',
            'Technologie de l\'Information',
            'Réseaux et Télécommunications',
            'Développement Web',
        ];

        return [
            'nom_filiere' => $this->faker->unique()->randomElement($noms),
            'niveau' => $this->faker->randomElement($niveaux),
            'description' => $this->faker->sentence(10),
            'description_niveau' => $this->faker->sentence(8),
        ];
    }
}
