<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportCours extends Model
{
    use HasFactory;

    protected $table = 'supports_cours';

    protected $fillable = [
        'titre',
        'fichier',
        'matiere_id',
        'enseignant_id',
    ];

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }
}

