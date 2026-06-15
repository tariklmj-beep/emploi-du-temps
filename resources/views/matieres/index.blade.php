<x-app-layout>
    <x-slot name="header">
        <div class="crud-header">
            <h2 class="crud-title">
                {{ __('Matières') }}
            </h2>
            <a href="{{ route('matieres.create') }}" class="btn btn-edt-primary">
                + Nouvelle Matière
            </a>
        </div>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container">
            <div class="crud-card">
                <div class="crud-card-body">
                    @if ($matieres->count())
                        <div class="table-responsive">
                        <table class="table crud-table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Filière</th>
                                    <th>Volume (h)</th>
                                    <th>Niveau</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($matieres as $matiere)
                                    <tr>
                                        <td class="fw-semibold">{{ $matiere->nom_matiere }}</td>
                                        <td>{{ $matiere->filiere->nom_filiere }}</td>
                                        <td>{{ $matiere->volume_heure }}</td>
                                        <td>{{ $matiere->niveau }}</td>
                                        <td class="text-center">
                                            <div class="crud-actions">
                                            <a href="{{ route('matieres.show', $matiere->id) }}" class="crud-link">Voir</a>
                                            <a href="{{ route('matieres.edit', $matiere->id) }}" class="crud-link">Éditer</a>
                                            <form method="POST" action="{{ route('matieres.destroy', $matiere->id) }}" class="d-inline" onsubmit="return confirm('Confirmer ?')">
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
                        <p class="crud-empty">Aucune matière trouvée.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
