<?php

namespace Database\Factories;

use App\Models\Etudiant;
use App\Models\Filiere;
use Illuminate\Database\Eloquent\Factories\Factory;

class EtudiantFactory extends Factory
{
    protected $model = Etudiant::class;

    public function definition(): array
    {
        static $matriculeCounter = 1000;

        return [
            'matricule' => 'MAT' . ($matriculeCounter++),
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'telephone' => $this->faker->phoneNumber(),
            'date_naissance' => $this->faker->dateTimeBetween('-30 years', '-18 years')->format('Y-m-d'),
            'filiere_id' => Filiere::inRandomOrder()->first()?->id ?? Filiere::factory(),
        ];
    }
}
