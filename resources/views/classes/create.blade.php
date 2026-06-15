<x-app-layout>
    <x-slot name="header">
        <h2 class="crud-title">Créer une Classe</h2>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container crud-container-narrow">
            <div class="crud-card">
                <div class="crud-card-body">
                    <form method="POST" action="{{ route('classes.store') }}" class="crud-form-grid">
                        @csrf

                        <div>
                            <label for="nom" class="crud-label">Nom</label>
                            <input type="text" id="nom" name="nom" class="crud-input" value="{{ old('nom') }}" required>
                            @error('nom') <span class="crud-error">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="annee_scolaire" class="crud-label">Année scolaire</label>
                            <input type="text" id="annee_scolaire" name="annee_scolaire" class="crud-input" value="{{ old('annee_scolaire', '2025-2026') }}" required>
                            @error('annee_scolaire') <span class="crud-error">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="filiere_id" class="crud-label">Filière</label>
                            <select id="filiere_id" name="filiere_id" class="crud-input" required>
                                <option value="">Sélectionner...</option>
                                @foreach ($filieres as $filiere)
                                    <option value="{{ $filiere->id }}" {{ old('filiere_id') == $filiere->id ? 'selected' : '' }}>{{ $filiere->nom_filiere }}</option>
                                @endforeach
                            </select>
                            @error('filiere_id') <span class="crud-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="crud-form-actions">
                            <a href="{{ route('classes.index') }}" class="btn btn-edt-outline">Annuler</a>
                            <button type="submit" class="btn btn-edt-primary">Créer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
