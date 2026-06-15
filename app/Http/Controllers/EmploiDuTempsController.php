<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\EmploiDuTemps;
use App\Models\Filiere;
use App\Models\Matiere;
use App\Models\Enseignant;
use App\Models\Salle;
use Illuminate\Http\Request;

class EmploiDuTempsController extends Controller
{
    public function index()
    {
        $typeOptions = ['Cours', 'TD', 'TP', 'Examen'];
        $selectedType = request('type_cours');
        $selectedFiliere = request('filiere_id');

        $filieresList = Filiere::orderBy('nom_filiere')->get(['id', 'nom_filiere']);

        $selectedFiliereId = null;
        if (is_numeric($selectedFiliere) && $filieresList->contains('id', (int) $selectedFiliere)) {
            $selectedFiliereId = (int) $selectedFiliere;
        }

        $weekDays = [
            ['key' => 'lundi', 'label' => 'Lundi'],
            ['key' => 'mardi', 'label' => 'Mardi'],
            ['key' => 'mercredi', 'label' => 'Mercredi'],
            ['key' => 'jeudi', 'label' => 'Jeudi'],
            ['key' => 'vendredi', 'label' => 'Vendredi'],
            ['key' => 'samedi', 'label' => 'Samedi'],
        ];

        $allEmploisDuTemps = EmploiDuTemps::with(['filiere', 'matiere', 'enseignant'])
            ->orderByRaw("FIELD(jour, 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi')")
            ->orderBy('heure_debut')
            ->get();

        $baseEmploisDuTemps = $allEmploisDuTemps;
        if ($selectedFiliereId !== null) {
            $baseEmploisDuTemps = $allEmploisDuTemps->where('filiere_id', $selectedFiliereId)->values();
        }

        $emploisDuTemps = $baseEmploisDuTemps;

        if (in_array($selectedType, $typeOptions, true)) {
            $emploisDuTemps = $baseEmploisDuTemps->where('type_cours', $selectedType)->values();
        }

        $typeCounts = collect($typeOptions)->mapWithKeys(function (string $type) use ($baseEmploisDuTemps): array {
            return [$type => $baseEmploisDuTemps->where('type_cours', $type)->count()];
        });

        $timetableByDay = collect($weekDays)->mapWithKeys(function (array $day) use ($emploisDuTemps): array {
            return [
                $day['key'] => $emploisDuTemps
                    ->where('jour', $day['key'])
                    ->sortBy('heure_debut')
                    ->values(),
            ];
        });

        // Always show a full school day from 08:30 to 18:30 in one-hour slots.
        $defaultSlots = collect(range(8, 18))
            ->map(fn (int $hour): string => sprintf('%02d:30:00', $hour));

        $timeSlots = $defaultSlots->values();

        $timetableGrid = collect($timeSlots)->mapWithKeys(function (string $slot) use ($weekDays, $timetableByDay): array {
            $row = [];

            foreach ($weekDays as $day) {
                $emploi = collect($timetableByDay[$day['key']] ?? [])->first(function ($item) use ($slot) {
                    return $item->heure_debut <= $slot && $item->heure_fin > $slot;
                });

                $row[$day['key']] = [
                    'emploi' => $emploi,
                    'isContinuation' => $emploi ? $emploi->heure_debut !== $slot : false,
                ];
            }

            return [$slot => $row];
        });

        $stats = [
            'total' => $emploisDuTemps->count(),
            'filieres' => Filiere::count(),
            'matieres' => Matiere::count(),
            'enseignants' => Enseignant::count(),
            'jours_actifs' => collect($weekDays)->filter(fn (array $day) => count($timetableByDay[$day['key']] ?? []) > 0)->count(),
        ];

        $nextSessions = $emploisDuTemps->take(5);

        return view('emplois-du-temps.index', compact(
            'weekDays',
            'timetableByDay',
            'timetableGrid',
            'timeSlots',
            'stats',
            'nextSessions',
            'typeOptions',
            'selectedType',
            'typeCounts',
            'filieresList',
            'selectedFiliereId'
        ));
    }

    public function create()
    {
        $filieres = Filiere::all();
        $matieres = Matiere::all();
        $enseignants = Enseignant::all();
        return view('emplois-du-temps.create', compact('filieres', 'matieres', 'enseignants'));
    }

    public function exportPdf(Request $request)
    {
        $typeOptions = ['Cours', 'TD', 'TP', 'Examen'];
        $selectedType = $request->query('type_cours');
        $selectedFiliere = $request->query('filiere_id');

        $filieresList = Filiere::orderBy('nom_filiere')->get(['id', 'nom_filiere']);

        $selectedFiliereId = null;
        if (is_numeric($selectedFiliere) && $filieresList->contains('id', (int) $selectedFiliere)) {
            $selectedFiliereId = (int) $selectedFiliere;
        }

        $emploisDuTemps = EmploiDuTemps::with(['filiere', 'matiere', 'enseignant'])
            ->orderByRaw("FIELD(jour, 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi')")
            ->orderBy('heure_debut')
            ->get();

        if ($selectedFiliereId !== null) {
            $emploisDuTemps = $emploisDuTemps->where('filiere_id', $selectedFiliereId)->values();
        }

        if (in_array($selectedType, $typeOptions, true)) {
            $emploisDuTemps = $emploisDuTemps->where('type_cours', $selectedType)->values();
        }

        $selectedFiliereName = optional($filieresList->firstWhere('id', $selectedFiliereId))->nom_filiere;

        $pdf = Pdf::loadView('emplois-du-temps.pdf', [
            'emploisDuTemps' => $emploisDuTemps,
            'selectedType' => $selectedType,
            'selectedFiliereName' => $selectedFiliereName,
            'generatedAt' => now(),
        ])->setPaper('a4', 'landscape');

        $suffix = collect([
            $selectedType ? strtolower($selectedType) : null,
            $selectedFiliereName ? str_replace(' ', '-', strtolower($selectedFiliereName)) : null,
        ])->filter()->implode('-');

        $fileName = 'emploi-du-temps' . ($suffix ? '-' . $suffix : '') . '.pdf';

        return $pdf->download($fileName);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jour' => 'required|string|in:lundi,mardi,mercredi,jeudi,vendredi,samedi',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
            'salle' => 'nullable|string|max:50',
            'semestre' => 'nullable|string|in:S1,S2,S3,S4,S5,S6',
            'type_cours' => 'required|string|in:Cours,TD,TP,Examen',
            'filiere_id' => 'required|exists:filieres,id',
            'matiere_id' => 'required|exists:matieres,id',
            'enseignant_id' => 'required|exists:enseignants,id',
        ]);

        $validated['jour'] = mb_strtolower($validated['jour']);

        EmploiDuTemps::create($validated);

        return redirect()->route('emplois-du-temps.index')->with('status', 'Emploi du temps cree avec succes.');
    }

    public function autoGenerate(Request $request)
    {
        $targetPerFiliere = (int) $request->integer('target_per_filiere', 10);
        $targetPerFiliere = max(4, min(20, $targetPerFiliere));

        $filieres = Filiere::orderBy('id')->get(['id']);
        $enseignants = Enseignant::all(['id']);
        $salles = Salle::all(['id', 'nom']);

        if ($filieres->isEmpty() || $enseignants->isEmpty() || $salles->isEmpty()) {
            return redirect()->route('emplois-du-temps.index')
                ->with('status', 'Generation auto impossible: donnees de base manquantes (filieres/enseignants/salles).');
        }

        $typesCours = ['Cours', 'TD', 'TP', 'Examen'];
        $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
        $slotStarts = ['08:30:00', '09:30:00', '10:30:00', '11:30:00', '12:30:00', '13:30:00', '14:30:00', '15:30:00', '16:30:00', '17:30:00'];

        $existing = EmploiDuTemps::query()
            ->get(['jour', 'heure_debut', 'heure_fin', 'filiere_id', 'enseignant_id', 'salle_id']);

        $usedTeacher = [];
        $usedFiliere = [];
        $usedSalle = [];

        foreach ($existing as $row) {
            $teacherKey = $row->enseignant_id . '|' . $row->jour;
            $filiereKey = $row->filiere_id . '|' . $row->jour;
            $salleKey = $row->salle_id . '|' . $row->jour;

            $usedTeacher[$teacherKey][] = [$row->heure_debut, $row->heure_fin];
            $usedFiliere[$filiereKey][] = [$row->heure_debut, $row->heure_fin];
            $usedSalle[$salleKey][] = [$row->heure_debut, $row->heure_fin];
        }

        $created = 0;

        foreach ($filieres as $filiere) {
            $matieresFiliere = Matiere::where('filiere_id', $filiere->id)->get(['id']);
            if ($matieresFiliere->isEmpty()) {
                continue;
            }

            $currentCount = EmploiDuTemps::where('filiere_id', $filiere->id)->count();
            $toCreate = max(0, $targetPerFiliere - $currentCount);

            for ($i = 0; $i < $toCreate; $i++) {
                $placed = false;

                for ($attempt = 0; $attempt < 160; $attempt++) {
                    $heureDebut = $slotStarts[array_rand($slotStarts)];
                    $dureeHeures = [1, 1, 2][array_rand([1, 1, 2])];

                    $heureFinObject = \DateTime::createFromFormat('H:i:s', $heureDebut);
                    $heureFinObject->modify('+' . $dureeHeures . ' hour');
                    $heureFin = $heureFinObject->format('H:i:s');

                    if ($heureFin > '18:30:00') {
                        continue;
                    }

                    $jour = $jours[array_rand($jours)];
                    $enseignant = $enseignants->random();
                    $matiere = $matieresFiliere->random();
                    $salle = $salles->random();

                    $teacherKey = $enseignant->id . '|' . $jour;
                    $filiereKey = $filiere->id . '|' . $jour;
                    $salleKey = $salle->id . '|' . $jour;

                    if (
                        $this->hasOverlap($usedTeacher[$teacherKey] ?? [], $heureDebut, $heureFin)
                        || $this->hasOverlap($usedFiliere[$filiereKey] ?? [], $heureDebut, $heureFin)
                        || $this->hasOverlap($usedSalle[$salleKey] ?? [], $heureDebut, $heureFin)
                    ) {
                        continue;
                    }

                    EmploiDuTemps::create([
                        'jour' => $jour,
                        'heure_debut' => $heureDebut,
                        'heure_fin' => $heureFin,
                        'salle' => $salle->nom,
                        'semestre' => ['S1', 'S2', 'S3', 'S4', 'S5', 'S6'][array_rand(['S1', 'S2', 'S3', 'S4', 'S5', 'S6'])],
                        'type_cours' => $typesCours[array_rand($typesCours)],
                        'filiere_id' => $filiere->id,
                        'matiere_id' => $matiere->id,
                        'enseignant_id' => $enseignant->id,
                        'salle_id' => $salle->id,
                    ]);

                    $usedTeacher[$teacherKey][] = [$heureDebut, $heureFin];
                    $usedFiliere[$filiereKey][] = [$heureDebut, $heureFin];
                    $usedSalle[$salleKey][] = [$heureDebut, $heureFin];

                    $created++;
                    $placed = true;
                    break;
                }

                if (! $placed) {
                    break;
                }
            }
        }

        return redirect()->route('emplois-du-temps.index')
            ->with('status', "Generation automatique terminee: {$created} creneau(x) ajoute(s).");
    }

    public function show(string $id)
    {
        $emploiDuTemps = EmploiDuTemps::with(['filiere', 'matiere', 'enseignant'])->findOrFail($id);
        return view('emplois-du-temps.show', compact('emploiDuTemps'));
    }

    public function edit(string $id)
    {
        $emploiDuTemps = EmploiDuTemps::findOrFail($id);
        $filieres = Filiere::all();
        $matieres = Matiere::all();
        $enseignants = Enseignant::all();
        return view('emplois-du-temps.edit', compact('emploiDuTemps', 'filieres', 'matieres', 'enseignants'));
    }

    public function update(Request $request, string $id)
    {
        $emploiDuTemps = EmploiDuTemps::findOrFail($id);

        $validated = $request->validate([
            'jour' => 'required|string|in:lundi,mardi,mercredi,jeudi,vendredi,samedi',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
            'salle' => 'nullable|string|max:50',
            'semestre' => 'nullable|string|in:S1,S2,S3,S4,S5,S6',
            'type_cours' => 'required|string|in:Cours,TD,TP,Examen',
            'filiere_id' => 'required|exists:filieres,id',
            'matiere_id' => 'required|exists:matieres,id',
            'enseignant_id' => 'required|exists:enseignants,id',
        ]);

        $validated['jour'] = mb_strtolower($validated['jour']);

        $emploiDuTemps->update($validated);

        return redirect()->route('emplois-du-temps.index')->with('status', 'Emploi du temps mis a jour.');
    }

    public function destroy(string $id)
    {
        EmploiDuTemps::findOrFail($id)->delete();

        return redirect()->route('emplois-du-temps.index')->with('status', 'Emploi du temps supprime.');
    }

    private function hasOverlap(array $intervals, string $start, string $end): bool
    {
        foreach ($intervals as [$existingStart, $existingEnd]) {
            if ($existingStart < $end && $start < $existingEnd) {
                return true;
            }
        }

        return false;
    }
}
