<?php

namespace Database\Factories;

use App\Models\Enseignant;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnseignantFactory extends Factory
{
    protected $model = Enseignant::class;

    public function definition(): array
    {
        $specialites = [
            'Informatique',
            'Mathématiques',
            'Physique',
            'Chimie',
            'Biologie',
            'Ingénierie Électrique',
            'Mécanique',
            'Génie Civil',
            'Technologie Web',
        ];

        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'telephone' => $this->faker->phoneNumber(),
            'departement' => $this->faker->word(),
            'grade' => $this->faker->randomElement(['Professeur', 'Maître de Conférence', 'Doctorant']),
            'specialite' => $this->faker->randomElement($specialites),
        ];
    }
}
