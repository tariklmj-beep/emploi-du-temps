<x-app-layout>
    <x-slot name="header">
        <h2 class="crud-title">
            {{ __('Créer une Filière') }}
        </h2>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container crud-container-narrow">
            <div class="crud-card">
                <div class="crud-card-body">
                    <form method="POST" action="{{ route('filieres.store') }}" class="crud-form-grid">
                        @csrf

                        <div>
                            <label for="nom_filiere" class="crud-label">Nom de la filière</label>
                            <input type="text" name="nom_filiere" id="nom_filiere" class="crud-input @error('nom_filiere') is-invalid @enderror" value="{{ old('nom_filiere') }}" required>
                            @error('nom_filiere')
                                <span class="crud-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="niveau" class="crud-label">Niveau</label>
                            <input type="text" name="niveau" id="niveau" class="crud-input @error('niveau') is-invalid @enderror" value="{{ old('niveau') }}" required>
                            @error('niveau')
                                <span class="crud-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="crud-label">Description</label>
                            <textarea name="description" id="description" rows="4" class="crud-input">{{ old('description') }}</textarea>
                        </div>

                        <div>
                            <label for="description_niveau" class="crud-label">Description du niveau</label>
                            <textarea name="description_niveau" id="description_niveau" rows="4" class="crud-input">{{ old('description_niveau') }}</textarea>
                        </div>

                        <div class="crud-form-actions">
                            <a href="{{ route('filieres.index') }}" class="btn btn-edt-outline">Annuler</a>
                            <button type="submit" class="btn btn-edt-primary">Créer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

