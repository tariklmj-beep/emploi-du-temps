<x-app-layout>
    <x-slot name="header">
        <h2 class="crud-title">
            {{ __('Détails de la Matière') }}
        </h2>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container crud-container-wide">
            <div class="crud-card">
                <div class="crud-card-body">
                    <div class="crud-detail-head">
                        <h3>{{ $matiere->nom_matiere }}</h3>
                        <p>Filière: <strong>{{ $matiere->filiere->nom_filiere }}</strong></p>
                    </div>

                    <div class="crud-detail-grid">
                        <div class="crud-detail-block">
                            <h4>Volume (heures)</h4>
                            <p>{{ $matiere->volume_heure }}</p>
                        </div>
                        <div class="crud-detail-block">
                            <h4>Niveau</h4>
                            <p>{{ $matiere->niveau }}</p>
                        </div>
                    </div>

                    <div class="crud-detail-block">
                        <h4>Description</h4>
                        <p>{{ $matiere->description ?? 'N/A' }}</p>
                    </div>

                    <div class="crud-form-actions">
                        <a href="{{ route('matieres.index') }}" class="btn btn-edt-outline">Retour</a>
                        <a href="{{ route('matieres.edit', $matiere->id) }}" class="btn btn-edt-primary">Éditer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
