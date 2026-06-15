<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <p class="text-uppercase text-secondary small mb-1">Planning hebdomadaire</p>
                <h2 class="h3 fw-bold mb-0">Emploi du temps</h2>
            </div>
            <div class="d-flex flex-wrap gap-2 no-print">
                @php
                    $canManageTimetable = auth()->user()?->hasAnyRole(['admin', 'professeur']);
                @endphp
                <button type="button" class="btn btn-edt-outline" onclick="window.print()">
                    Imprimer
                </button>
                <a href="{{ route('emplois-du-temps.export.pdf', array_filter(['type_cours' => $selectedType, 'filiere_id' => $selectedFiliereId])) }}" class="btn btn-edt-outline">
                    Export PDF
                </a>
                @if ($canManageTimetable)
                    <form method="POST" action="{{ route('emplois-du-temps.generate-auto') }}" class="d-inline">
                        @csrf
                        <button
                            type="submit"
                            class="btn btn-edt-primary"
                            onclick="return confirm('Generer automatiquement des seances sans conflits (prof/filiere/salle) ?')"
                        >
                            Generation auto
                        </button>
                    </form>
                    <a href="{{ route('emplois-du-temps.create') }}" class="btn btn-edt-primary">+ Nouveau créneau</a>
                    <a href="{{ route('dashboard') }}" class="btn btn-edt-outline">Retour dashboard</a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="container py-4 py-lg-5 edt-print-scope">
        <section class="row g-3 mb-4">
            <div class="col-6 col-xl-2-4">
                <article class="feature-card p-4 h-100">
                    <p class="text-secondary small mb-1">Créneaux</p>
                    <p class="h3 mb-0">{{ $stats['total'] }}</p>
                </article>
            </div>
            <div class="col-6 col-xl-2-4">
                <article class="feature-card p-4 h-100">
                    <p class="text-secondary small mb-1">Jours actifs</p>
                    <p class="h3 mb-0">{{ $stats['jours_actifs'] }}</p>
                </article>
            </div>
            <div class="col-6 col-xl-2-4">
                <article class="feature-card p-4 h-100">
                    <p class="text-secondary small mb-1">Filieres</p>
                    <p class="h3 mb-0">{{ $stats['filieres'] }}</p>
                </article>
            </div>
            <div class="col-6 col-xl-2-4">
                <article class="feature-card p-4 h-100">
                    <p class="text-secondary small mb-1">Matieres</p>
                    <p class="h3 mb-0">{{ $stats['matieres'] }}</p>
                </article>
            </div>
            <div class="col-12 col-xl-2-4">
                <article class="feature-card p-4 h-100">
                    <p class="text-secondary small mb-1">Enseignants</p>
                    <p class="h3 mb-0">{{ $stats['enseignants'] }}</p>
                </article>
            </div>
        </section>

        <section class="mb-4">
            <article class="feature-card p-3">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <p class="text-secondary small mb-1">Séparer les types</p>
                        <h3 class="h6 mb-0">Filtrer par type de séance et filière</h3>
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <form method="GET" action="{{ route('emplois-du-temps.index') }}" class="d-flex align-items-center gap-2">
                            @if ($selectedType)
                                <input type="hidden" name="type_cours" value="{{ $selectedType }}">
                            @endif
                            <select name="filiere_id" class="crud-input" style="min-width: 220px;" onchange="this.form.submit()">
                                <option value="">Toutes les filières</option>
                                @foreach ($filieresList as $filiere)
                                    <option value="{{ $filiere->id }}" {{ (string) $selectedFiliereId === (string) $filiere->id ? 'selected' : '' }}>
                                        {{ $filiere->nom_filiere }}
                                    </option>
                                @endforeach
                            </select>
                        </form>

                        <a href="{{ route('emplois-du-temps.index', array_filter(['filiere_id' => $selectedFiliereId])) }}" class="btn {{ $selectedType ? 'btn-edt-outline' : 'btn-edt-primary' }}">Tous ({{ $typeCounts->sum() }})</a>
                        @foreach ($typeOptions as $type)
                            <a href="{{ route('emplois-du-temps.index', array_filter(['type_cours' => $type, 'filiere_id' => $selectedFiliereId])) }}" class="btn {{ $selectedType === $type ? 'btn-edt-primary' : 'btn-edt-outline' }}">
                                {{ $type }} ({{ $typeCounts[$type] ?? 0 }})
                            </a>
                        @endforeach
                        @if ($selectedType || $selectedFiliereId)
                            <a href="{{ route('emplois-du-temps.index') }}" class="btn btn-edt-outline">Réinitialiser</a>
                        @endif
                    </div>
                </div>
            </article>
        </section>

        <section class="mb-4">
            <article class="feature-card p-4">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
                    <div>
                        <h3 class="h5 mb-1">Tableau hebdomadaire</h3>
                        <p class="text-secondary small mb-0">Vue type école: heures en lignes, jours en colonnes.</p>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        @if ($selectedType)
                            <span class="badge text-bg-light border">Type: {{ $selectedType }}</span>
                        @endif
                        @if ($selectedFiliereId)
                            @php
                                $selectedFiliereName = optional($filieresList->firstWhere('id', $selectedFiliereId))->nom_filiere;
                            @endphp
                            <span class="badge text-bg-light border">Filière: {{ $selectedFiliereName }}</span>
                        @endif
                    </div>
                </div>

                @if ($timeSlots->count())
                    <div class="edt-board-wrap">
                        <table class="edt-board-table">
                            <thead>
                                <tr>
                                    <th scope="col" class="edt-time-col">Heure</th>
                                    @foreach ($weekDays as $day)
                                        <th scope="col">
                                            <div class="d-flex flex-column">
                                                <span>{{ $day['label'] }}</span>
                                                <small>{{ $timetableByDay[$day['key']]->count() }} séance(s)</small>
                                            </div>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($timeSlots as $slot)
                                    <tr>
                                        <th scope="row" class="edt-time-col">{{ substr($slot, 0, 5) }}</th>
                                        @foreach ($weekDays as $day)
                                            @php
                                                $cell = $timetableGrid[$slot][$day['key']] ?? null;
                                                $emploi = $cell['emploi'] ?? null;
                                                $isContinuation = $cell['isContinuation'] ?? false;
                                            @endphp
                                            <td>
                                                @if ($emploi && $isContinuation)
                                                    <div class="edt-empty">Suite de séance (jusqu'à {{ substr($emploi->heure_fin, 0, 5) }})</div>
                                                @elseif ($emploi)
                                                    @php
                                                        $typeClass = match ($emploi->type_cours) {
                                                            'Cours' => 'type-cours',
                                                            'TD' => 'type-td',
                                                            'TP' => 'type-tp',
                                                            'Examen' => 'type-examen',
                                                            default => 'type-default',
                                                        };
                                                    @endphp
                                                    <article class="edt-session {{ $typeClass }}">
                                                        <div class="d-flex justify-content-between align-items-start gap-2">
                                                            <strong class="d-block">{{ $emploi->matiere->nom_matiere }}</strong>
                                                            <span class="badge text-bg-light border">{{ $emploi->type_cours }}</span>
                                                        </div>
                                                        <p>{{ $emploi->heure_debut }} - {{ $emploi->heure_fin }}</p>
                                                        <p>{{ $emploi->filiere->nom_filiere }}</p>
                                                        <p>{{ $emploi->enseignant->name }}</p>
                                                        <p>Salle: {{ $emploi->salle ?? 'Non définie' }}</p>
                                                    </article>
                                                @else
                                                    <div class="edt-empty">Libre</div>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="timetable-empty">
                        <p class="mb-1 fw-semibold">Aucun créneau disponible</p>
                        <p class="mb-0 small text-secondary">Ajoute des séances pour afficher le tableau.</p>
                    </div>
                @endif
            </article>
        </section>

        <section class="row g-4">
            <div class="col-xl-6">
                <article class="feature-card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="h5 mb-0">Prochains créneaux</h3>
                        <span class="text-secondary small">Vue rapide</span>
                    </div>

                    <div class="d-grid gap-3">
                        @forelse ($nextSessions as $emploi)
                            <div class="next-session-item">
                                <div>
                                    <p class="mb-1 small text-uppercase text-secondary">{{ ucfirst($emploi->jour) }}</p>
                                    <h4 class="h6 mb-1">{{ $emploi->matiere->nom_matiere }}</h4>
                                    <p class="mb-0 small text-secondary">{{ $emploi->enseignant->name }} · {{ $emploi->salle ?? 'Salle non définie' }}</p>
                                </div>
                                <div class="text-end">
                                    <p class="mb-1 fw-semibold text-primary">{{ $emploi->heure_debut }}</p>
                                    <span class="badge text-bg-light border">{{ $emploi->type_cours }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="timetable-empty">
                                <p class="mb-1 fw-semibold">Aucun créneau</p>
                                <p class="mb-0 small text-secondary">Ajoute des séances pour remplir le planning.</p>
                            </div>
                        @endforelse
                    </div>
                </article>
            </div>

            <div class="col-xl-6">
                <article class="feature-card p-4">
                    <h3 class="h5 mb-3">Légende des types</h3>
                    <div class="d-grid gap-2">
                        <div class="legend-item"><span class="legend-dot type-cours"></span> Cours magistral</div>
                        <div class="legend-item"><span class="legend-dot type-td"></span> Travaux dirigés</div>
                        <div class="legend-item"><span class="legend-dot type-tp"></span> Travaux pratiques</div>
                        <div class="legend-item"><span class="legend-dot type-examen"></span> Examen</div>
                    </div>
                </article>
            </div>
        </section>
    </div>
</x-app-layout>
