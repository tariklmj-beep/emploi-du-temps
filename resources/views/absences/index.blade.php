<x-app-layout>
    <x-slot name="header">
        <div class="crud-header">
            <h2 class="crud-title">Absences</h2>
            <a href="{{ route('absences.create') }}" class="btn btn-edt-primary">+ Nouvelle Absence</a>
        </div>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container">
            <div class="crud-card">
                <div class="crud-card-body">
                    @if ($absences->count())
                        <div class="table-responsive">
                            <table class="table crud-table">
                                <thead>
                                    <tr>
                                        <th>Étudiant</th>
                                        <th>Matière</th>
                                        <th>Date absence</th>
                                        <th>Justifiée</th>
                                        <th>Motif</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($absences as $absence)
                                        <tr>
                                            <td class="fw-semibold">{{ $absence->etudiant?->prenom }} {{ $absence->etudiant?->nom }}</td>
                                            <td>{{ $absence->matiere?->nom_matiere }}</td>
                                            <td>{{ optional($absence->date_absence)->format('d/m/Y') }}</td>
                                            <td>{{ $absence->justifie ? 'Oui' : 'Non' }}</td>
                                            <td>{{ $absence->motif ?: '-' }}</td>
                                            <td class="text-center">
                                                <div class="crud-actions">
                                                    <a href="{{ route('absences.show', $absence->id) }}" class="crud-link">Voir</a>
                                                    <a href="{{ route('absences.edit', $absence->id) }}" class="crud-link">Éditer</a>
                                                    <form method="POST" action="{{ route('absences.destroy', $absence->id) }}" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')">
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
                        <p class="crud-empty">Aucune absence trouvée.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

