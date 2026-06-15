<x-app-layout>
    <x-slot name="header">
        <h2 class="crud-title">Créer une Absence</h2>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container crud-container-narrow">
            <div class="crud-card">
                <div class="crud-card-body">
                    <form method="POST" action="{{ route('absences.store') }}" class="crud-form-grid">
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
                            <label for="date_absence" class="crud-label">Date absence</label>
                            <input type="date" id="date_absence" name="date_absence" class="crud-input" value="{{ old('date_absence') }}" required>
                            @error('date_absence') <span class="crud-error">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="crud-label d-block">Justifiée</label>
                            <label class="auth-checkbox">
                                <input type="checkbox" name="justifie" value="1" {{ old('justifie') ? 'checked' : '' }}>
                                <span>Oui</span>
                            </label>
                        </div>

                        <div>
                            <label for="motif" class="crud-label">Motif</label>
                            <textarea id="motif" name="motif" class="crud-input" rows="3">{{ old('motif') }}</textarea>
                            @error('motif') <span class="crud-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="crud-form-actions">
                            <a href="{{ route('absences.index') }}" class="btn btn-edt-outline">Annuler</a>
                            <button type="submit" class="btn btn-edt-primary">Créer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
