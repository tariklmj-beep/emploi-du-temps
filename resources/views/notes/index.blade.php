<x-app-layout>
    <x-slot name="header">
        <div class="crud-header">
            <h2 class="crud-title">Notes</h2>
            <a href="{{ route('notes.create') }}" class="btn btn-edt-primary">+ Nouvelle Note</a>
        </div>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container">
            <div class="crud-card">
                <div class="crud-card-body">
                    @if ($notes->count())
                        <div class="table-responsive">
                            <table class="table crud-table">
                                <thead>
                                    <tr>
                                        <th>Étudiant</th>
                                        <th>Matière</th>
                                        <th>Note</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notes as $note)
                                        <tr>
                                            <td class="fw-semibold">{{ $note->etudiant?->prenom }} {{ $note->etudiant?->nom }}</td>
                                            <td>{{ $note->matiere?->nom_matiere }}</td>
                                            <td>{{ number_format((float) $note->valeur, 2) }}</td>
                                            <td>{{ ucfirst($note->type) }}</td>
                                            <td>{{ optional($note->date_eval)->format('d/m/Y') }}</td>
                                            <td class="text-center">
                                                <div class="crud-actions">
                                                    <a href="{{ route('notes.show', $note->id) }}" class="crud-link">Voir</a>
                                                    <a href="{{ route('notes.edit', $note->id) }}" class="crud-link">Éditer</a>
                                                    <form method="POST" action="{{ route('notes.destroy', $note->id) }}" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')">
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
                        <p class="crud-empty">Aucune note trouvée.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


