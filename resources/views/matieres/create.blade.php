<x-app-layout>
    <x-slot name="header">
        <h2 class="crud-title">
            {{ __('Créer une Matière') }}
        </h2>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container crud-container-narrow">
            <div class="crud-card">
                <div class="crud-card-body">
                    <form method="POST" action="{{ route('matieres.store') }}" class="crud-form-grid">
                        @csrf

                        <div>
                            <label for="nom_matiere" class="crud-label">Nom</label>
                            <input type="text" name="nom_matiere" id="nom_matiere" class="crud-input" value="{{ old('nom_matiere') }}" required>
                            @error('nom_matiere')
                                <span class="crud-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="filiere_id" class="crud-label">Filière</label>
                            <select name="filiere_id" id="filiere_id" class="crud-input" required>
                                <option value="">Sélectionner...</option>
                                @foreach ($filieres as $filiere)
                                    <option value="{{ $filiere->id }}" {{ old('filiere_id') == $filiere->id ? 'selected' : '' }}>
                                        {{ $filiere->nom_filiere }}
                                    </option>
                                @endforeach
                            </select>
                            @error('filiere_id')
                                <span class="crud-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="volume_heure" class="crud-label">Volume (heures)</label>
                            <input type="number" name="volume_heure" id="volume_heure" class="crud-input" value="{{ old('volume_heure') }}" min="1" required>
                            @error('volume_heure')
                                <span class="crud-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="niveau" class="crud-label">Niveau</label>
                            <select name="niveau" id="niveau" class="crud-input" required>
                                <option value="">Sélectionner...</option>
                                <option value="Licence" {{ old('niveau') == 'Licence' ? 'selected' : '' }}>Licence</option>
                                <option value="Master" {{ old('niveau') == 'Master' ? 'selected' : '' }}>Master</option>
                            </select>
                            @error('niveau')
                                <span class="crud-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="crud-label">Description</label>
                            <textarea name="description" id="description" rows="4" class="crud-input">{{ old('description') }}</textarea>
                        </div>

                        <div class="crud-form-actions">
                            <a href="{{ route('matieres.index') }}" class="btn btn-edt-outline">Annuler</a>
                            <button type="submit" class="btn btn-edt-primary">Créer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
