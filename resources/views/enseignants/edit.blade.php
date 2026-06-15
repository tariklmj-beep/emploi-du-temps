<x-app-layout>
    <x-slot name="header">
        <h2 class="crud-title">
            {{ __('Éditer l\'Enseignant') }}
        </h2>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container crud-container-narrow">
            <div class="crud-card">
                <div class="crud-card-body">
                    <form method="POST" action="{{ route('enseignants.update', $enseignant->id) }}" class="crud-form-grid">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="nom" class="crud-label">Nom</label>
                            <input type="text" name="nom" id="nom" class="crud-input" value="{{ old('nom', $enseignant->nom) }}" required>
                            @error('nom')
                                <span class="crud-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="prenom" class="crud-label">Prénom</label>
                            <input type="text" name="prenom" id="prenom" class="crud-input" value="{{ old('prenom', $enseignant->prenom) }}" required>
                            @error('prenom')
                                <span class="crud-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="crud-label">Email</label>
                            <input type="email" name="email" id="email" class="crud-input" value="{{ old('email', $enseignant->email) }}" required>
                            @error('email')
                                <span class="crud-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="telephone" class="crud-label">Téléphone</label>
                            <input type="text" name="telephone" id="telephone" class="crud-input" value="{{ old('telephone', $enseignant->telephone) }}">
                        </div>

                        <div>
                            <label for="specialite" class="crud-label">Spécialité</label>
                            <input type="text" name="specialite" id="specialite" class="crud-input" value="{{ old('specialite', $enseignant->specialite) }}">
                        </div>

                        <div class="crud-form-actions">
                            <a href="{{ route('enseignants.index') }}" class="btn btn-edt-outline">Annuler</a>
                            <button type="submit" class="btn btn-edt-primary">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
