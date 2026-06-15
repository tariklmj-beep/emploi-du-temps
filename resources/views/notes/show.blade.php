<x-app-layout>
    <x-slot name="header">
        <h2 class="crud-title">Détails Note</h2>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container crud-container-wide">
            <div class="crud-card">
                <div class="crud-card-body">
                    <div class="crud-detail-head">
                        <h3>{{ number_format((float) $note->valeur, 2) }} / 20</h3>
                        <p>{{ $note->etudiant?->prenom }} {{ $note->etudiant?->nom }} - {{ $note->matiere?->nom_matiere }}</p>
                    </div>

                    <div class="crud-detail-grid">
                        <div class="crud-detail-block">
                            <h4>Type</h4>
                            <p>{{ ucfirst($note->type) }}</p>
                        </div>
                        <div class="crud-detail-block">
                            <h4>Date évaluation</h4>
                            <p>{{ optional($note->date_eval)->format('d/m/Y') ?: 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="crud-form-actions">
                        <a href="{{ route('notes.index') }}" class="btn btn-edt-outline">Retour</a>
                        <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-edt-primary">Éditer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
