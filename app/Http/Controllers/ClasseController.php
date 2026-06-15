<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Filiere;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClasseController extends Controller
{
    public function index()
    {
        $classesList = Classe::with('filiere')
            ->withCount('etudiants')
            ->orderBy('annee_scolaire')
            ->orderBy('nom')
            ->get();

        return view('classes.index', compact('classesList'));
    }

    public function create()
    {
        $filieres = Filiere::orderBy('nom_filiere')->get();

        return view('classes.create', compact('filieres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'annee_scolaire' => 'required|string|max:255',
            'filiere_id' => 'required|exists:filieres,id',
        ]);

        Classe::create($validated);

        return redirect()->route('classes.index')->with('status', 'Classe créée avec succès.');
    }

    public function show(string $id)
    {
        $classe = Classe::with(['filiere', 'etudiants'])->findOrFail($id);

        return view('classes.show', compact('classe'));
    }

    public function edit(string $id)
    {
        $classe = Classe::findOrFail($id);
        $filieres = Filiere::orderBy('nom_filiere')->get();

        return view('classes.edit', compact('classe', 'filieres'));
    }

    public function update(Request $request, string $id)
    {
        $classe = Classe::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'annee_scolaire' => [
                'required',
                'string',
                'max:255',
                Rule::unique('classes')->where(function ($query) use ($request) {
                    return $query->where('nom', $request->nom);
                })->ignore($classe->id),
            ],
            'filiere_id' => 'required|exists:filieres,id',
        ]);

        $classe->update($validated);

        return redirect()->route('classes.index')->with('status', 'Classe mise à jour.');
    }

    public function destroy(string $id)
    {
        Classe::findOrFail($id)->delete();

        return redirect()->route('classes.index')->with('status', 'Classe supprimée.');
    }
}

