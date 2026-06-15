<x-app-layout>
    <x-slot name="header">
        <h2 class="crud-title">
            {{ __('Détails de la Filière') }}
        </h2>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container crud-container-wide">
            <div class="crud-card">
                <div class="crud-card-body">
                    <div class="crud-detail-head">
                        <h3>{{ $filiere->nom_filiere }}</h3>
                        <p>Niveau: <strong>{{ $filiere->niveau }}</strong></p>
                    </div>

                    <div class="crud-detail-block">
                        <h4>Description</h4>
                        <p>{{ $filiere->description ?? 'N/A' }}</p>
                    </div>

                    <div class="crud-detail-block">
                        <h4>Description du niveau</h4>
                        <p>{{ $filiere->description_niveau ?? 'N/A' }}</p>
                    </div>

                    <div class="crud-form-actions">
                        <a href="{{ route('filieres.index') }}" class="btn btn-edt-outline">Retour</a>
                        <a href="{{ route('filieres.edit', $filiere->id) }}" class="btn btn-edt-primary">Éditer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
