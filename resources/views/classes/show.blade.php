<x-app-layout>
    <x-slot name="header">
        <h2 class="crud-title">Détails Classe</h2>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container crud-container-wide">
            <div class="crud-card">
                <div class="crud-card-body">
                    <div class="crud-detail-head">
                        <h3>{{ $classe->nom }}</h3>
                        <p>Filière: <strong>{{ $classe->filiere?->nom_filiere }}</strong></p>
                    </div>

                    <div class="crud-detail-grid">
                        <div class="crud-detail-block">
                            <h4>Année scolaire</h4>
                            <p>{{ $classe->annee_scolaire }}</p>
                        </div>
                        <div class="crud-detail-block">
                            <h4>Nombre d'étudiants</h4>
                            <p>{{ $classe->etudiants->count() }}</p>
                        </div>
                    </div>

                    <div class="crud-form-actions">
                        <a href="{{ route('classes.index') }}" class="btn btn-edt-outline">Retour</a>
                        <a href="{{ route('classes.edit', $classe->id) }}" class="btn btn-edt-primary">Éditer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
