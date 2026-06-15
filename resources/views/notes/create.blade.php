<x-app-layout>
    <x-slot name="header">
        <h2 class="crud-title">Créer une Note</h2>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container crud-container-narrow">
            <div class="crud-card">
                <div class="crud-card-body">
                    <form method="POST" action="{{ route('notes.store') }}" class="crud-form-grid">
                        @csrf

                        <div>
                            <label for="etudiant_id" class="crud-label">Étudiant</label>
                            <select id="etudiant_id" name="etudiant_id" class="crud-input" required>
                                <option value="">Sélectionner...</option>
                                @foreach ($etudiants as $etudiant)
                                    <option value="{{ $etudiant->id }}" {{ old('etudiant_id') == $etudiant->id ? 'selected' : '' }}>{{ $etudiant->prenom }} {{ $etudiant->nom }}</option>
                                @endforeach
                            </select>
                            @error('etudiant_id') <span class="crud-error">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="matiere_id" class="crud-label">Matière</label>
                            <select id="matiere_id" name="matiere_id" class="crud-input" required>
                                <option value="">Sélectionner...</option>
                                @foreach ($matieres as $matiere)
                                    <option value="{{ $matiere->id }}" {{ old('matiere_id') == $matiere->id ? 'selected' : '' }}>{{ $matiere->nom_matiere }}</option>
                                @endforeach
                            </select>
                            @error('matiere_id') <span class="crud-error">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="valeur" class="crud-label">Note (/20)</label>
                            <input type="number" step="0.01" min="0" max="20" id="valeur" name="valeur" class="crud-input" value="{{ old('valeur') }}" required>
                            @error('valeur') <span class="crud-error">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="type" class="crud-label">Type</label>
                            <select id="type" name="type" class="crud-input" required>
                                @foreach (['controle', 'devoir', 'tp', 'examen'] as $type)
                                    <option value="{{ $type }}" {{ old('type') === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                                @endforeach
                            </select>
                            @error('type') <span class="crud-error">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="date_eval" class="crud-label">Date évaluation</label>
                            <input type="date" id="date_eval" name="date_eval" class="crud-input" value="{{ old('date_eval') }}">
                            @error('date_eval') <span class="crud-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="crud-form-actions">
                            <a href="{{ route('notes.index') }}" class="btn btn-edt-outline">Annuler</a>
                            <button type="submit" class="btn btn-edt-primary">Créer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
