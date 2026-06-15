<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_matiere',
        'volume_heure',
        'niveau',
        'description',
        'filiere_id',
    ];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function emploisDuTemps()
    {
        return $this->hasMany(EmploiDuTemps::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function supportsCours()
    {
        return $this->hasMany(SupportCours::class);
    }
}
