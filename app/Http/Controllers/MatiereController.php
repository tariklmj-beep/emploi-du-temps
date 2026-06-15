<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use App\Models\Filiere;
use Illuminate\Http\Request;

class MatiereController extends Controller
{
    public function index()
    {
        $matieres = Matiere::with('filiere')->get();
        return view('matieres.index', compact('matieres'));
    }

    public function create()
    {
        $filieres = Filiere::all();
        return view('matieres.create', compact('filieres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_matiere' => 'required|string|max:255',
            'volume_heure' => 'required|integer|min:1',
            'niveau' => 'required|string|in:Licence,Master',
            'description' => 'nullable|string',
            'filiere_id' => 'required|exists:filieres,id',
        ]);

        Matiere::create($validated);

        return redirect()->route('matieres.index')->with('status', 'Matière créée avec succès.');
    }

    public function show(string $id)
    {
        $matiere = Matiere::with('filiere')->findOrFail($id);
        return view('matieres.show', compact('matiere'));
    }

    public function edit(string $id)
    {
        $matiere = Matiere::findOrFail($id);
        $filieres = Filiere::all();
        return view('matieres.edit', compact('matiere', 'filieres'));
    }

    public function update(Request $request, string $id)
    {
        $matiere = Matiere::findOrFail($id);

        $validated = $request->validate([
            'nom_matiere' => 'required|string|max:255',
            'volume_heure' => 'required|integer|min:1',
            'niveau' => 'required|string|in:Licence,Master',
            'description' => 'nullable|string',
            'filiere_id' => 'required|exists:filieres,id',
        ]);

        $matiere->update($validated);

        return redirect()->route('matieres.index')->with('status', 'Matière mise à jour.');
    }

    public function destroy(string $id)
    {
        Matiere::findOrFail($id)->delete();

        return redirect()->route('matieres.index')->with('status', 'Matière supprimée.');
    }
}
