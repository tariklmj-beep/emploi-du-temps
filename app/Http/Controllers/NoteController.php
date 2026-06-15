<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Matiere;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::with(['etudiant', 'matiere'])
            ->orderByDesc('date_eval')
            ->orderByDesc('id')
            ->get();

        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        $etudiants = Etudiant::orderBy('nom')->orderBy('prenom')->get();
        $matieres = Matiere::orderBy('nom_matiere')->get();

        return view('notes.create', compact('etudiants', 'matieres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'matiere_id' => 'required|exists:matieres,id',
            'valeur' => 'required|numeric|min:0|max:20',
            'date_eval' => 'nullable|date',
            'type' => 'required|in:controle,devoir,tp,examen',
        ]);

        Note::create($validated);

        return redirect()->route('notes.index')->with('status', 'Note créée avec succès.');
    }

    public function show(string $id)
    {
        $note = Note::with(['etudiant', 'matiere'])->findOrFail($id);

        return view('notes.show', compact('note'));
    }

    public function edit(string $id)
    {
        $note = Note::findOrFail($id);
        $etudiants = Etudiant::orderBy('nom')->orderBy('prenom')->get();
        $matieres = Matiere::orderBy('nom_matiere')->get();

        return view('notes.edit', compact('note', 'etudiants', 'matieres'));
    }

    public function update(Request $request, string $id)
    {
        $note = Note::findOrFail($id);

        $validated = $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'matiere_id' => 'required|exists:matieres,id',
            'valeur' => 'required|numeric|min:0|max:20',
            'date_eval' => 'nullable|date',
            'type' => 'required|in:controle,devoir,tp,examen',
        ]);

        $note->update($validated);

        return redirect()->route('notes.index')->with('status', 'Note mise à jour.');
    }

    public function destroy(string $id)
    {
        Note::findOrFail($id)->delete();

        return redirect()->route('notes.index')->with('status', 'Note supprimée.');
    }
}
