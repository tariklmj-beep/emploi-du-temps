<x-app-layout>
    <x-slot name="header">
        <div class="crud-header">
            <h2 class="crud-title">Salles</h2>
            <a href="{{ route('salles.create') }}" class="btn btn-edt-primary">+ Nouvelle Salle</a>
        </div>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container">
            <div class="crud-card">
                <div class="crud-card-body">
                    @if ($salles->count())
                        <div class="table-responsive">
                            <table class="table crud-table">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Capacité</th>
                                        <th>Bâtiment</th>
                                        <th>Utilisations EDT</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($salles as $salle)
                                        <tr>
                                            <td class="fw-semibold">{{ $salle->nom }}</td>
                                            <td>{{ $salle->capacite ?? '-' }}</td>
                                            <td>{{ $salle->batiment ?? '-' }}</td>
                                            <td>{{ $salle->emplois_du_temps_count }}</td>
                                            <td class="text-center">
                                                <div class="crud-actions">
                                                    <a href="{{ route('salles.show', $salle->id) }}" class="crud-link">Voir</a>
                                                    <a href="{{ route('salles.edit', $salle->id) }}" class="crud-link">Éditer</a>
                                                    <form method="POST" action="{{ route('salles.destroy', $salle->id) }}" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="crud-link crud-link-danger">Supprimer</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="crud-empty">Aucune salle trouvée.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

