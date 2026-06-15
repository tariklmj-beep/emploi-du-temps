<x-app-layout>
    <x-slot name="header">
        <div class="crud-header">
            <h2 class="crud-title">
                {{ __('Enseignants') }}
            </h2>
            <a href="{{ route('enseignants.create') }}" class="btn btn-edt-primary">
                + Nouvel Enseignant
            </a>
        </div>
    </x-slot>

    <div class="crud-page">
        <div class="crud-container">
            <div class="crud-card">
                <div class="crud-card-body">
                    @if ($enseignants->count())
                        <div class="table-responsive">
                        <table class="table crud-table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Spécialité</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enseignants as $enseignant)
                                    <tr>
                                        <td class="fw-semibold">{{ $enseignant->nom }}</td>
                                        <td>{{ $enseignant->prenom }}</td>
                                        <td>{{ $enseignant->email }}</td>
                                        <td>{{ $enseignant->specialite ?? 'N/A' }}</td>
                                        <td class="text-center">
                                            <div class="crud-actions">
                                            <a href="{{ route('enseignants.show', $enseignant->id) }}" class="crud-link">Voir</a>
                                            <a href="{{ route('enseignants.edit', $enseignant->id) }}" class="crud-link">Éditer</a>
                                            <form method="POST" action="{{ route('enseignants.destroy', $enseignant->id) }}" class="d-inline" onsubmit="return confirm('Confirmer ?')">
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
                        <p class="crud-empty">Aucun enseignant trouvé.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
