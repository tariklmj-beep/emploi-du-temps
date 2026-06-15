<x-app-layout>
    <x-slot name="header">
        <h2 class="crud-title">Détails Absence</h2>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container crud-container-wide">
            <div class="crud-card">
                <div class="crud-card-body">
                    <div class="crud-detail-head">
                        <h3>{{ $absence->etudiant?->prenom }} {{ $absence->etudiant?->nom }}</h3>
                        <p>Matière: <strong>{{ $absence->matiere?->nom_matiere }}</strong></p>
                    </div>

                    <div class="crud-detail-grid">
                        <div class="crud-detail-block">
                            <h4>Date absence</h4>
                            <p>{{ optional($absence->date_absence)->format('d/m/Y') }}</p>
                        </div>
                        <div class="crud-detail-block">
                            <h4>Justifiée</h4>
                            <p>{{ $absence->justifie ? 'Oui' : 'Non' }}</p>
                        </div>
                    </div>

                    <div class="crud-detail-block">
                        <h4>Motif</h4>
                        <p>{{ $absence->motif ?: 'N/A' }}</p>
                    </div>

                    <div class="crud-form-actions">
                        <a href="{{ route('absences.index') }}" class="btn btn-edt-outline">Retour</a>
                        <a href="{{ route('absences.edit', $absence->id) }}" class="btn btn-edt-primary">Éditer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
