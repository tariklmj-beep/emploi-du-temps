<x-app-layout>
    <x-slot name="header">
        <h2 class="crud-title">
            {{ __('Détails de l\'Étudiant') }}
        </h2>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container crud-container-wide">
            <div class="crud-card">
                <div class="crud-card-body">
                    <div class="crud-detail-head">
                        <h3>{{ $etudiant->prenom }} {{ $etudiant->nom }}</h3>
                        <p>Matricule: <strong>{{ $etudiant->matricule }}</strong></p>
                    </div>

                    <div class="crud-detail-grid">
                        <div class="crud-detail-block">
                            <h4>Email</h4>
                            <p>{{ $etudiant->email }}</p>
                        </div>
                        <div class="crud-detail-block">
                            <h4>Téléphone</h4>
                            <p>{{ $etudiant->telephone ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="crud-detail-block">
                        <h4>Filière</h4>
                        <p>{{ $etudiant->filiere->nom_filiere }}</p>
                    </div>

                    <div class="crud-form-actions">
                        <a href="{{ route('etudiants.index') }}" class="btn btn-edt-outline">Retour</a>
                        <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-edt-primary">Éditer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
