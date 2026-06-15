<x-app-layout>
    <x-slot name="header">
        <div class="crud-header">
            <h2 class="crud-title">
                {{ __('Étudiants') }}
            </h2>
            <a href="{{ route('etudiants.create') }}" class="btn btn-edt-primary">
                + Nouvel Étudiant
            </a>
        </div>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container">
            <div class="crud-card">
                <div class="crud-card-body">
                    @if ($etudiants->count())
                        <div class="table-responsive">
                        <table class="table crud-table">
                            <thead>
                                <tr>
                                    <th>Matricule</th>
                                    <th>Nom</th>
                                    <th>Filière</th>
                                    <th>Email</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($etudiants as $etudiant)
                                    <tr>
                                        <td class="fw-semibold">{{ $etudiant->matricule }}</td>
                                        <td>{{ $etudiant->prenom }} {{ $etudiant->nom }}</td>
                                        <td>{{ $etudiant->filiere->nom_filiere }}</td>
                                        <td>{{ $etudiant->email }}</td>
                                        <td class="text-center">
                                            <div class="crud-actions">
                                            <a href="{{ route('etudiants.show', $etudiant->id) }}" class="crud-link">Voir</a>
                                            <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="crud-link">Éditer</a>
                                            <form method="POST" action="{{ route('etudiants.destroy', $etudiant->id) }}" class="d-inline" onsubmit="return confirm('Confirmer ?')">
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
                        <p class="crud-empty">Aucun étudiant trouvé.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
