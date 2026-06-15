<?php

namespace App\Http\Controllers;

use App\Models\Salle;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SalleController extends Controller
{
    public function index()
    {
        $salles = Salle::withCount('emploisDuTemps')
            ->orderBy('nom')
            ->get();

        return view('salles.index', compact('salles'));
    }

    public function create()
    {
        return view('salles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:salles,nom',
            'capacite' => 'nullable|integer|min:1',
            'batiment' => 'nullable|string|max:255',
        ]);

        Salle::create($validated);

        return redirect()->route('salles.index')->with('status', 'Salle créée avec succès.');
    }

    public function show(string $id)
    {
        $salle = Salle::with('emploisDuTemps')->findOrFail($id);

        return view('salles.show', compact('salle'));
    }

    public function edit(string $id)
    {
        $salle = Salle::findOrFail($id);

        return view('salles.edit', compact('salle'));
    }

    public function update(Request $request, string $id)
    {
        $salle = Salle::findOrFail($id);

        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255', Rule::unique('salles', 'nom')->ignore($salle->id)],
            'capacite' => 'nullable|integer|min:1',
            'batiment' => 'nullable|string|max:255',
        ]);

        $salle->update($validated);

        return redirect()->route('salles.index')->with('status', 'Salle mise à jour.');
    }

    public function destroy(string $id)
    {
        Salle::findOrFail($id)->delete();

        return redirect()->route('salles.index')->with('status', 'Salle supprimée.');
    }
}
