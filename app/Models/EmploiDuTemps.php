<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploiDuTemps extends Model
{
    use HasFactory;

    protected $table = 'emplois_du_temps';

    protected $fillable = [
        'jour',
        'heure_debut',
        'heure_fin',
        'salle',
        'semestre',
        'type_cours',
        'filiere_id',
        'matiere_id',
        'enseignant_id',
        'salle_id',
    ];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }

    public function salleEntity()
    {
        return $this->belongsTo(Salle::class, 'salle_id');
    }
}
