<x-app-layout>
    <x-slot name="header">
        <h2 class="crud-title">Détails Salle</h2>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container crud-container-wide">
            <div class="crud-card">
                <div class="crud-card-body">
                    <div class="crud-detail-head">
                        <h3>{{ $salle->nom }}</h3>
                        <p>Bâtiment: <strong>{{ $salle->batiment ?? 'N/A' }}</strong></p>
                    </div>

                    <div class="crud-detail-grid">
                        <div class="crud-detail-block">
                            <h4>Capacité</h4>
                            <p>{{ $salle->capacite ?? 'N/A' }}</p>
                        </div>
                        <div class="crud-detail-block">
                            <h4>Utilisations EDT</h4>
                            <p>{{ $salle->emploisDuTemps->count() }}</p>
                        </div>
                    </div>

                    <div class="crud-form-actions">
                        <a href="{{ route('salles.index') }}" class="btn btn-edt-outline">Retour</a>
                        <a href="{{ route('salles.edit', $salle->id) }}" class="btn btn-edt-primary">Éditer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
