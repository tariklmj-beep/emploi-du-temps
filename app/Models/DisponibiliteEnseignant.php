<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisponibiliteEnseignant extends Model
{
    use HasFactory;

    protected $table = 'disponibilites_enseignants';

    protected $fillable = [
        'enseignant_id',
        'jour',
        'heure_debut',
        'heure_fin',
    ];

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }
}

