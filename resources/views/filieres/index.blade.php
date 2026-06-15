<x-app-layout>
    <x-slot name="header">
        <div class="crud-header">
            <h2 class="crud-title">
                {{ __('Filières') }}
            </h2>
            <a href="{{ route('filieres.create') }}" class="btn btn-edt-primary">
                + Nouvelle Filière
            </a>
        </div>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container">
            <div class="crud-card">
                <div class="crud-card-body">
                    @if ($filieres->count())
                        <div class="table-responsive">
                        <table class="table crud-table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Niveau</th>
                                    <th>Description</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($filieres as $filiere)
                                    <tr>
                                        <td class="fw-semibold">{{ $filiere->nom_filiere }}</td>
                                        <td>{{ $filiere->niveau }}</td>
                                        <td>{{ Str::limit($filiere->description, 60) }}</td>
                                        <td class="text-center">
                                            <div class="crud-actions">
                                            <a href="{{ route('filieres.show', $filiere->id) }}" class="crud-link">Voir</a>
                                            <a href="{{ route('filieres.edit', $filiere->id) }}" class="crud-link">Éditer</a>
                                            <form method="POST" action="{{ route('filieres.destroy', $filiere->id) }}" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')">
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
                        <p class="crud-empty">Aucune filière trouvée.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
