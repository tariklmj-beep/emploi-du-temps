<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use Illuminate\Http\Request;

class EnseignantController extends Controller
{
    public function index()
    {
        $enseignants = Enseignant::all();
        return view('enseignants.index', compact('enseignants'));
    }

    public function create()
    {
        return view('enseignants.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:enseignants',
            'telephone' => 'nullable|string|max:20',
            'specialite' => 'nullable|string|max:255',
        ]);

        Enseignant::create($validated);

        return redirect()->route('enseignants.index')->with('status', 'Enseignant créé avec succès.');
    }

    public function show(string $id)
    {
        $enseignant = Enseignant::findOrFail($id);
        return view('enseignants.show', compact('enseignant'));
    }

    public function edit(string $id)
    {
        $enseignant = Enseignant::findOrFail($id);
        return view('enseignants.edit', compact('enseignant'));
    }

    public function update(Request $request, string $id)
    {
        $enseignant = Enseignant::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:enseignants,email,' . $id,
            'telephone' => 'nullable|string|max:20',
            'specialite' => 'nullable|string|max:255',
        ]);

        $enseignant->update($validated);

        return redirect()->route('enseignants.index')->with('status', 'Enseignant mis à jour.');
    }

    public function destroy(string $id)
    {
        Enseignant::findOrFail($id)->delete();

        return redirect()->route('enseignants.index')->with('status', 'Enseignant supprimé.');
    }
}
