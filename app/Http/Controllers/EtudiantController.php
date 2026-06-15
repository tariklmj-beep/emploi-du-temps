<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Filiere;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index()
    {
        $etudiants = Etudiant::with('filiere')->get();
        return view('etudiants.index', compact('etudiants'));
    }

    public function create()
    {
        $filieres = Filiere::all();
        return view('etudiants.create', compact('filieres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants',
            'matricule' => 'required|unique:etudiants|string|max:50',
            'telephone' => 'nullable|string|max:20',
            'filiere_id' => 'required|exists:filieres,id',
        ]);

        Etudiant::create($validated);

        return redirect()->route('etudiants.index')->with('status', 'Étudiant créé avec succès.');
    }

    public function show(string $id)
    {
        $etudiant = Etudiant::with('filiere')->findOrFail($id);
        return view('etudiants.show', compact('etudiant'));
    }

    public function edit(string $id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $filieres = Filiere::all();
        return view('etudiants.edit', compact('etudiant', 'filieres'));
    }

    public function update(Request $request, string $id)
    {
        $etudiant = Etudiant::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email,' . $id,
            'matricule' => 'required|unique:etudiants,matricule,' . $id . '|string|max:50',
            'telephone' => 'nullable|string|max:20',
            'filiere_id' => 'required|exists:filieres,id',
        ]);

        $etudiant->update($validated);

        return redirect()->route('etudiants.index')->with('status', 'Étudiant mis à jour.');
    }

    public function destroy(string $id)
    {
        Etudiant::findOrFail($id)->delete();

        return redirect()->route('etudiants.index')->with('status', 'Étudiant supprimé.');
    }
}
