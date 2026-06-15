<x-app-layout>
    <x-slot name="header">
        <div class="crud-header">
            <h2 class="crud-title">Classes</h2>
            <a href="{{ route('classes.create') }}" class="btn btn-edt-primary">+ Nouvelle Classe</a>
        </div>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container">
            <div class="crud-card">
                <div class="crud-card-body">
                    @if ($classesList->count())
                        <div class="table-responsive">
                            <table class="table crud-table">
                                <thead>
                                    <tr>
                                        <th>Classe</th>
                                        <th>Année scolaire</th>
                                        <th>Filière</th>
                                        <th>Étudiants</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($classesList as $classe)
                                        <tr>
                                            <td class="fw-semibold">{{ $classe->nom }}</td>
                                            <td>{{ $classe->annee_scolaire }}</td>
                                            <td>{{ $classe->filiere?->nom_filiere }}</td>
                                            <td>{{ $classe->etudiants_count }}</td>
                                            <td class="text-center">
                                                <div class="crud-actions">
                                                    <a href="{{ route('classes.show', $classe->id) }}" class="crud-link">Voir</a>
                                                    <a href="{{ route('classes.edit', $classe->id) }}" class="crud-link">Éditer</a>
                                                    <form method="POST" action="{{ route('classes.destroy', $classe->id) }}" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')">
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
                        <p class="crud-empty">Aucune classe trouvée.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


