<x-app-layout>
    <x-slot name="header">
        <h2 class="crud-title">
            {{ __('Détails de l\'Enseignant') }}
        </h2>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container crud-container-wide">
            <div class="crud-card">
                <div class="crud-card-body">
                    <div class="crud-detail-head">
                        <h3>{{ $enseignant->prenom }} {{ $enseignant->nom }}</h3>
                    </div>

                    <div class="crud-detail-grid">
                        <div class="crud-detail-block">
                            <h4>Email</h4>
                            <p>{{ $enseignant->email }}</p>
                        </div>
                        <div class="crud-detail-block">
                            <h4>Téléphone</h4>
                            <p>{{ $enseignant->telephone ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="crud-detail-block">
                        <h4>Spécialité</h4>
                        <p>{{ $enseignant->specialite ?? 'N/A' }}</p>
                    </div>

                    <div class="crud-form-actions">
                        <a href="{{ route('enseignants.index') }}" class="btn btn-edt-outline">Retour</a>
                        <a href="{{ route('enseignants.edit', $enseignant->id) }}" class="btn btn-edt-primary">Éditer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
