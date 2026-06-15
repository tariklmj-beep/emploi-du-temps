<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'departement',
        'grade',
        'specialite',
    ];

    public function emploisDuTemps()
    {
        return $this->hasMany(EmploiDuTemps::class);
    }

    public function supportsCours()
    {
        return $this->hasMany(SupportCours::class);
    }

    public function disponibilites()
    {
        return $this->hasMany(DisponibiliteEnseignant::class);
    }

    public function getNameAttribute(): string
    {
        return trim(($this->prenom ?? '') . ' ' . ($this->nom ?? ''));
    }
}
