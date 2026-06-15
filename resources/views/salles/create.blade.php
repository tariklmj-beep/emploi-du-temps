<x-app-layout>
    <x-slot name="header">
        <h2 class="crud-title">Créer une Salle</h2>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container crud-container-narrow">
            <div class="crud-card">
                <div class="crud-card-body">
                    <form method="POST" action="{{ route('salles.store') }}" class="crud-form-grid">
                        @csrf

                        <div>
                            <label for="nom" class="crud-label">Nom</label>
                            <input type="text" id="nom" name="nom" class="crud-input" value="{{ old('nom') }}" required>
                            @error('nom') <span class="crud-error">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="capacite" class="crud-label">Capacité</label>
                            <input type="number" id="capacite" name="capacite" class="crud-input" value="{{ old('capacite') }}" min="1">
                            @error('capacite') <span class="crud-error">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="batiment" class="crud-label">Bâtiment</label>
                            <input type="text" id="batiment" name="batiment" class="crud-input" value="{{ old('batiment') }}">
                            @error('batiment') <span class="crud-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="crud-form-actions">
                            <a href="{{ route('salles.index') }}" class="btn btn-edt-outline">Annuler</a>
                            <button type="submit" class="btn btn-edt-primary">Créer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
