<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Emploi du Temps</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #16324f;
            font-size: 12px;
            margin: 18px;
        }

        h1 {
            margin: 0 0 6px;
            font-size: 20px;
            color: #0f4c81;
        }

        .meta {
            margin: 0 0 12px;
            color: #5f6f84;
            font-size: 11px;
        }

        .filters {
            margin: 10px 0 14px;
            padding: 8px 10px;
            border: 1px solid #dbe8f5;
            border-radius: 6px;
            background: #f8fbff;
        }

        .filters span {
            display: inline-block;
            margin-right: 12px;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dbe8f5;
            padding: 6px;
            vertical-align: top;
            font-size: 10px;
        }

        th {
            background: #f1f7fe;
            color: #214a72;
            font-weight: 700;
            text-align: left;
        }

        .empty {
            margin-top: 18px;
            padding: 10px;
            border: 1px dashed #cfdff0;
            color: #6c7e95;
            text-align: center;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <h1>Emploi du Temps</h1>
    <p class="meta">Document généré le {{ $generatedAt->format('d/m/Y H:i') }}</p>

    <div class="filters">
        <span><strong>Type:</strong> {{ $selectedType ?: 'Tous' }}</span>
        <span><strong>Filière:</strong> {{ $selectedFiliereName ?: 'Toutes' }}</span>
        <span><strong>Total créneaux:</strong> {{ $emploisDuTemps->count() }}</span>
    </div>

    @if ($emploisDuTemps->isEmpty())
        <div class="empty">Aucun créneau correspondant aux filtres sélectionnés.</div>
    @else
        <table>
            <thead>
                <tr>
                    <th>Jour</th>
                    <th>Heure</th>
                    <th>Matière</th>
                    <th>Type</th>
                    <th>Filière</th>
                    <th>Enseignant</th>
                    <th>Salle</th>
                    <th>Semestre</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($emploisDuTemps as $emploi)
                    <tr>
                        <td>{{ ucfirst($emploi->jour) }}</td>
                        <td>{{ $emploi->heure_debut }} - {{ $emploi->heure_fin }}</td>
                        <td>{{ $emploi->matiere?->nom_matiere }}</td>
                        <td>{{ $emploi->type_cours }}</td>
                        <td>{{ $emploi->filiere?->nom_filiere }}</td>
                        <td>{{ $emploi->enseignant?->name }}</td>
                        <td>{{ $emploi->salle ?: 'N/A' }}</td>
                        <td>{{ $emploi->semestre ?: 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
