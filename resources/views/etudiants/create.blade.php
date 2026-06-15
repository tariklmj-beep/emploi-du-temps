<x-app-layout>
    <x-slot name="header">
        <h2 class="crud-title">
            {{ __('Créer un Étudiant') }}
        </h2>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container crud-container-narrow">
            <div class="crud-card">
                <div class="crud-card-body">
                    <form method="POST" action="{{ route('etudiants.store') }}" class="crud-form-grid">
                        @csrf

                        <div>
                            <label for="matricule" class="crud-label">Matricule</label>
                            <input type="text" name="matricule" id="matricule" class="crud-input" value="{{ old('matricule') }}" required>
                            @error('matricule')
                                <span class="crud-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="nom" class="crud-label">Nom</label>
                            <input type="text" name="nom" id="nom" class="crud-input" value="{{ old('nom') }}" required>
                            @error('nom')
                                <span class="crud-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="prenom" class="crud-label">Prénom</label>
                            <input type="text" name="prenom" id="prenom" class="crud-input" value="{{ old('prenom') }}" required>
                            @error('prenom')
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
                            <label for="email" class="crud-label">Email</label>
                            <input type="email" name="email" id="email" class="crud-input" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="crud-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="telephone" class="crud-label">Téléphone</label>
                            <input type="text" name="telephone" id="telephone" class="crud-input" value="{{ old('telephone') }}">
                        </div>

                        <div class="crud-form-actions">
                            <a href="{{ route('etudiants.index') }}" class="btn btn-edt-outline">Annuler</a>
                            <button type="submit" class="btn btn-edt-primary">Créer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
