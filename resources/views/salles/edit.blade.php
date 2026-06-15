<x-app-layout>
    <x-slot name="header">
        <h2 class="crud-title">Éditer la Salle</h2>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container crud-container-narrow">
            <div class="crud-card">
                <div class="crud-card-body">
                    <form method="POST" action="{{ route('salles.update', $salle->id) }}" class="crud-form-grid">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="nom" class="crud-label">Nom</label>
                            <input type="text" id="nom" name="nom" class="crud-input" value="{{ old('nom', $salle->nom) }}" required>
                            @error('nom') <span class="crud-error">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="capacite" class="crud-label">Capacité</label>
                            <input type="number" id="capacite" name="capacite" class="crud-input" value="{{ old('capacite', $salle->capacite) }}" min="1">
                            @error('capacite') <span class="crud-error">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="batiment" class="crud-label">Bâtiment</label>
                            <input type="text" id="batiment" name="batiment" class="crud-input" value="{{ old('batiment', $salle->batiment) }}">
                            @error('batiment') <span class="crud-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="crud-form-actions">
                            <a href="{{ route('salles.index') }}" class="btn btn-edt-outline">Annuler</a>
                            <button type="submit" class="btn btn-edt-primary">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
