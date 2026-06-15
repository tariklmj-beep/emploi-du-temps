<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    public function index()
    {
        $filieres = Filiere::all();
        return view('filieres.index', compact('filieres'));
    }

    public function create()
    {
        return view('filieres.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_filiere' => 'required|string|max:255',
            'description' => 'nullable|string',
            'niveau' => 'required|string|max:255',
            'description_niveau' => 'nullable|string',
        ]);

        Filiere::create($validated);

        return redirect()->route('filieres.index')->with('status', 'Filière créée avec succès.');
    }

    public function show(string $id)
    {
        $filiere = Filiere::findOrFail($id);
        return view('filieres.show', compact('filiere'));
    }

    public function edit(string $id)
    {
        $filiere = Filiere::findOrFail($id);
        return view('filieres.edit', compact('filiere'));
    }

    public function update(Request $request, string $id)
    {
        $filiere = Filiere::findOrFail($id);

        $validated = $request->validate([
            'nom_filiere' => 'required|string|max:255',
            'description' => 'nullable|string',
            'niveau' => 'required|string|max:255',
            'description_niveau' => 'nullable|string',
        ]);

        $filiere->update($validated);

        return redirect()->route('filieres.index')->with('status', 'Filière mise à jour.');
    }

    public function destroy(string $id)
    {
        Filiere::findOrFail($id)->delete();

        return redirect()->route('filieres.index')->with('status', 'Filière supprimée.');
    }
}
