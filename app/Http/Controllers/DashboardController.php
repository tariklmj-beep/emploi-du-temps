<?php

namespace App\Http\Controllers;

use App\Models\EmploiDuTemps;
use App\Models\Enseignant;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Matiere;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'filieres' => Filiere::count(),
            'matieres' => Matiere::count(),
            'enseignants' => Enseignant::count(),
            'etudiants' => Etudiant::count(),
            'emplois' => EmploiDuTemps::count(),
        ];

        $orderedDays = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];

        $scheduleByDayRaw = EmploiDuTemps::query()
            ->select('jour', DB::raw('COUNT(*) as total'))
            ->groupBy('jour')
            ->pluck('total', 'jour')
            ->toArray();

        $scheduleByDay = [];
        foreach ($orderedDays as $day) {
            $scheduleByDay[] = (int) ($scheduleByDayRaw[$day] ?? 0);
        }

        $typeDistributionRaw = EmploiDuTemps::query()
            ->select('type_cours', DB::raw('COUNT(*) as total'))
            ->groupBy('type_cours')
            ->pluck('total', 'type_cours')
            ->toArray();

        $orderedTypes = ['Cours', 'TD', 'TP', 'Examen'];
        $typeDistribution = [];
        foreach ($orderedTypes as $type) {
            $typeDistribution[] = (int) ($typeDistributionRaw[$type] ?? 0);
        }

        $filiereLoad = Filiere::query()
            ->withCount(['etudiants', 'emploisDuTemps'])
            ->orderByDesc('emplois_du_temps_count')
            ->take(8)
            ->get(['id', 'nom_filiere']);

        $nextSessions = EmploiDuTemps::with(['filiere', 'matiere', 'enseignant'])
            ->orderBy('jour')
            ->orderBy('heure_debut')
            ->take(5)
            ->get();

        return view('dashboard', [
            'stats' => $stats,
            'days' => $orderedDays,
            'scheduleByDay' => $scheduleByDay,
            'types' => $orderedTypes,
            'typeDistribution' => $typeDistribution,
            'filiereLoad' => $filiereLoad,
            'nextSessions' => $nextSessions,
        ]);
    }
}
