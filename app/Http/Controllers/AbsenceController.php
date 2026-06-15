<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Etudiant;
use App\Models\Matiere;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    public function index()
    {
        $absences = Absence::with(['etudiant', 'matiere'])
            ->orderByDesc('date_absence')
            ->orderByDesc('id')
            ->get();

        return view('absences.index', compact('absences'));
    }

    public function create()
    {
        $etudiants = Etudiant::orderBy('nom')->orderBy('prenom')->get();
        $matieres = Matiere::orderBy('nom_matiere')->get();

        return view('absences.create', compact('etudiants', 'matieres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'matiere_id' => 'required|exists:matieres,id',
            'date_absence' => 'required|date',
            'justifie' => 'nullable|boolean',
            'motif' => 'nullable|string',
        ]);

        $validated['justifie'] = (bool) ($request->justifie ?? false);

        Absence::create($validated);

        return redirect()->route('absences.index')->with('status', 'Absence créée avec succès.');
    }

    public function show(string $id)
    {
        $absence = Absence::with(['etudiant', 'matiere'])->findOrFail($id);

        return view('absences.show', compact('absence'));
    }

    public function edit(string $id)
    {
        $absence = Absence::findOrFail($id);
        $etudiants = Etudiant::orderBy('nom')->orderBy('prenom')->get();
        $matieres = Matiere::orderBy('nom_matiere')->get();

        return view('absences.edit', compact('absence', 'etudiants', 'matieres'));
    }

    public function update(Request $request, string $id)
    {
        $absence = Absence::findOrFail($id);

        $validated = $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'matiere_id' => 'required|exists:matieres,id',
            'date_absence' => 'required|date',
            'justifie' => 'nullable|boolean',
            'motif' => 'nullable|string',
        ]);

        $validated['justifie'] = (bool) ($request->justifie ?? false);

        $absence->update($validated);

        return redirect()->route('absences.index')->with('status', 'Absence mise à jour.');
    }

    public function destroy(string $id)
    {
        Absence::findOrFail($id)->delete();

        return redirect()->route('absences.index')->with('status', 'Absence supprimée.');
    }
}
