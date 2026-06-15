<x-app-layout>
    <style>
        /* ═══════════════ WELCOME BANNER ═══════════════ */
        .welcome-banner {
            border-radius: 20px; padding: 1.8rem 2rem;
            border: 1px solid rgba(74,163,255,.18);
            background: linear-gradient(135deg, rgba(74,163,255,.1), rgba(6,214,160,.06)),
                        rgba(255,255,255,.03);
            backdrop-filter: blur(16px);
            display: flex; align-items: center; justify-content: space-between;
            gap: 1.5rem; flex-wrap: wrap;
            margin-bottom: 1.4rem;
            position: relative; overflow: hidden;
        }
        .welcome-banner::after {
            content: ''; position: absolute;
            width: 280px; height: 280px; border-radius: 50%;
            background: radial-gradient(circle, rgba(74,163,255,.12) 0%, transparent 70%);
            top: -100px; right: -60px; pointer-events: none;
        }
        .wb-kicker {
            display: inline-flex; align-items: center; gap: .4rem;
            background: rgba(74,163,255,.1); border: 1px solid rgba(74,163,255,.18);
            border-radius: 999px; color: #a0c8f0;
            font-size: .73rem; font-weight: 700; letter-spacing: .07em; text-transform: uppercase;
            padding: .28rem .75rem; margin-bottom: .6rem;
        }
        .wb-title { font-size: clamp(1.4rem,2.5vw,2rem); font-weight: 900; color: #f8fbff; margin-bottom: .4rem; }
        .wb-sub { color: var(--muted); font-size: .95rem; line-height: 1.5; }
        .wb-actions { display: flex; gap: .75rem; flex-wrap: wrap; margin-top: 1rem; }
        .btn-primary {
            display: inline-flex; align-items: center; gap: .45rem;
            padding: .7rem 1.5rem; border-radius: 999px;
            background: var(--blue2); color: #fff;
            font-weight: 700; font-size: .9rem; text-decoration: none;
            transition: transform .18s, box-shadow .18s; border: none; cursor: pointer;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(33,118,255,.35); color:#fff; }
        .btn-ghost {
            display: inline-flex; align-items: center; gap: .45rem;
            padding: .7rem 1.4rem; border-radius: 999px;
            border: 1px solid rgba(255,255,255,.18); color: #d0e4f8;
            background: rgba(255,255,255,.05); font-weight: 600; font-size: .9rem;
            text-decoration: none; transition: all .18s; cursor: pointer;
        }
        .btn-ghost:hover { border-color: rgba(74,163,255,.4); background: rgba(74,163,255,.08); color:#fff; }

        /* metrics mini */
        .wb-metrics { display: flex; gap: 1rem; flex-wrap: wrap; }
        .wb-metric {
            padding: 1rem 1.4rem; border-radius: 14px;
            border: 1px solid var(--border); background: rgba(255,255,255,.05);
            text-align: center; min-width: 100px;
        }
        .wb-metric strong { display:block; font-size:1.6rem; font-weight:900; color:#fff; }
        .wb-metric span   { font-size:.75rem; color:var(--muted); font-weight:600; }

        /* ═══════════════ STAT CARDS ═══════════════ */
        .stat-grid { display: grid; grid-template-columns: repeat(auto-fill,minmax(200px,1fr)); gap: 1rem; margin-bottom: 1.4rem; }
        .stat-card {
            border-radius: 18px; padding: 1.3rem 1.4rem;
            border: 1px solid var(--border);
            background: rgba(255,255,255,.05);
            backdrop-filter: blur(14px);
            position: relative; overflow: hidden;
            transition: transform .2s, box-shadow .2s, border-color .2s;
        }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(0,0,0,.25); border-color: rgba(74,163,255,.2); }
        .stat-card::after {
            content:''; position:absolute; bottom:-30px; right:-20px;
            width:100px; height:100px; border-radius:50%;
            background: radial-gradient(circle, rgba(255,255,255,.1) 0%, transparent 65%);
            pointer-events:none;
        }
        .stat-card-icon {
            width: 42px; height: 42px; border-radius: 12px;
            display: grid; place-items: center; color:#fff;
            margin-bottom: 1rem;
        }
        .sci-blue   { background: rgba(74,163,255,.15); color: #7ec8f8; }
        .sci-teal   { background: rgba(6,214,160,.15); color: #6ee7a0; }
        .sci-orange { background: rgba(251,146,60,.15); color: #fb923c; }
        .sci-purple { background: rgba(139,92,246,.15); color: #a78bfa; }
        .sci-red    { background: rgba(239,68,68,.15); color: #f87171; }
        .stat-card-label { font-size:.8rem; color:var(--muted); font-weight:600; text-transform:uppercase; letter-spacing:.06em; margin-bottom:.3rem; }
        .stat-card-val   { font-size: clamp(1.8rem,2.5vw,2.6rem); font-weight:900; color:#fff; line-height:1; }
        .stat-card-trend {
            display:inline-flex; align-items:center; gap:.3rem;
            margin-top:.5rem; font-size:.78rem; font-weight:700;
            padding:.18rem .55rem; border-radius:999px;
        }
        .trend-up   { background:rgba(6,214,160,.12);  color:var(--teal); }
        .trend-down { background:rgba(239,68,68,.12);  color:#f87171; }
        .trend-flat { background:rgba(148,163,184,.1); color:var(--muted); }

        /* ═══════════════ PANELS ═══════════════ */
        .panels-row { display: grid; grid-template-columns: 1fr; gap: 1.2rem; margin-bottom: 1.2rem; }
        @media (min-width:1100px) { .panels-row-2 { grid-template-columns: 2fr 1fr; } }
        @media (min-width:1100px) { .panels-row-3 { grid-template-columns: 7fr 5fr; } }

        .panel {
            border-radius: 18px; padding: 1.3rem 1.4rem;
            border: 1px solid var(--border);
            background: rgba(255,255,255,.05);
            backdrop-filter: blur(14px);
        }
        .panel-header { display:flex; align-items:flex-start; justify-content:space-between; gap:1rem; margin-bottom:1.2rem; }
        .panel-kicker { font-size:.72rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase; color:rgba(74,163,255,.8); margin-bottom:.2rem; }
        .panel-title  { font-size:1.05rem; font-weight:800; color:#f8fbff; }
        .panel-badge  {
            padding:.35rem .8rem; border-radius:999px;
            font-size:.75rem; font-weight:700;
            background:rgba(74,163,255,.1); border:1px solid rgba(74,163,255,.16);
            color:#a0c8f0; white-space:nowrap;
        }

        /* ═══════════════ TABLE ═══════════════ */
        .data-table { width:100%; border-collapse:collapse; }
        .data-table thead th {
            background:rgba(255,255,255,.04);
            color:rgba(229,238,251,.55); font-size:.76rem;
            font-weight:700; letter-spacing:.07em; text-transform:uppercase;
            padding:.7rem 1rem; text-align:left;
            border-bottom:1px solid var(--border);
        }
        .data-table tbody td { padding:.8rem 1rem; border-bottom:1px solid rgba(148,163,184,.08); font-size:.9rem; }
        .data-table tbody tr:last-child td { border-bottom:none; }
        .data-table tbody tr:hover td { background:rgba(74,163,255,.04); }
        .dt-name { font-weight:700; color:#f8fbff; }
        .dt-count { color:var(--muted); }
        .prog-wrap { display:flex; align-items:center; gap:.75rem; }
        .prog-bar  { flex:1; height:8px; border-radius:999px; background:rgba(255,255,255,.08); overflow:hidden; }
        .prog-fill { height:100%; border-radius:999px; background:linear-gradient(90deg,var(--blue),var(--teal)); transition:width .5s ease; }
        .prog-label { font-size:.78rem; font-weight:700; color:#a0c8f0; width:32px; text-align:right; }

        /* ═══════════════ SESSIONS ═══════════════ */
        .session-list { display:flex; flex-direction:column; gap:.75rem; }
        .session-item {
            display:flex; align-items:flex-start; justify-content:space-between; gap:1rem;
            padding:1rem 1.1rem; border-radius:14px;
            border:1px solid var(--border); background:rgba(255,255,255,.04);
            transition:background .18s, border-color .18s;
        }
        .session-item:hover { background:rgba(74,163,255,.05); border-color:rgba(74,163,255,.18); }
        .session-name { font-weight:700; color:#f8fbff; font-size:.92rem; margin-bottom:.25rem; }
        .session-meta { font-size:.8rem; color:var(--muted); }
        .session-type {
            display:inline-flex; align-items:center;
            padding:.3rem .75rem; border-radius:999px;
            font-size:.75rem; font-weight:800; white-space:nowrap;
        }
        .type-cours   { background:rgba(74,163,255,.15);  color:#7ec8f8; }
        .type-td      { background:rgba(245,158,11,.15);  color:#fcd34d; }
        .type-tp      { background:rgba(43,147,72,.15);   color:#6ee7a0; }
        .type-examen  { background:rgba(239,68,68,.15);   color:#fca5a5; }
        .type-default { background:rgba(148,163,184,.12); color:#94a3b8; }

        .empty-state { text-align:center; padding:2rem 1rem; color:var(--muted); font-size:.9rem; }
    </style>
    <x-slot name="header">
        @php
            $now = now();
        @endphp
        <div class="topbar-title">Tableau de bord</div>
        <div class="topbar-date">{{ $now->isoFormat('dddd D MMMM YYYY') }}</div>
    </x-slot>

    @php
        $user       = Auth::user();
        $isAdmin    = $user?->isAdmin() ?? false;
        $isProfesseur = $user?->isProfesseur() ?? false;
        $nowHour    = now()->hour;
        $greeting   = $nowHour < 12 ? 'Bonjour' : ($nowHour < 18 ? 'Bon après-midi' : 'Bonsoir');
    @endphp

    {{-- ▌WELCOME BANNER --}}
    <div class="welcome-banner">
        <div>
            <div class="wb-kicker">
                <span style="width:7px;height:7px;border-radius:50%;background:var(--teal);display:inline-block;"></span>
                Vue exécutive
            </div>
            <h1 class="wb-title">{{ $greeting }}, {{ explode(' ', $user?->name ?? 'Utilisateur')[0] }} 👋</h1>
            <p class="wb-sub">Voici un aperçu de votre environnement académique en temps réel.</p>
            <div class="wb-actions">
                <a href="{{ route('emplois-du-temps.index') }}" class="btn-ghost" style="padding:.6rem 1.2rem;font-size:.85rem;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Voir le planning
                </a>
            </div>
        </div>
        <div class="wb-metrics">
            <div class="wb-metric"><strong>{{ $stats['filieres'] ?? 0 }}</strong><span>Filières</span></div>
            <div class="wb-metric"><strong>{{ $stats['matieres'] ?? 0 }}</strong><span>Matières</span></div>
            <div class="wb-metric"><strong>{{ $stats['etudiants'] ?? 0 }}</strong><span>Étudiants</span></div>
            <div class="wb-metric"><strong>{{ $stats['emplois'] ?? 0 }}</strong><span>Créneaux</span></div>
        </div>
    </div>

    {{-- ▌STAT CARDS --}}
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-card-icon sci-blue">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
            </div>
            <div class="stat-card-label">Filières</div>
            <div class="stat-card-val">{{ $stats['filieres'] ?? 0 }}</div>
            <div class="stat-card-trend trend-flat">— Stable</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-icon sci-orange">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
            </div>
            <div class="stat-card-label">Matières</div>
            <div class="stat-card-val">{{ $stats['matieres'] ?? 0 }}</div>
            <div class="stat-card-trend trend-up">↑ Actif</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-icon sci-teal">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </div>
            <div class="stat-card-label">Enseignants</div>
            <div class="stat-card-val">{{ $stats['enseignants'] ?? 0 }}</div>
            <div class="stat-card-trend trend-up">↑ Actif</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-icon sci-purple">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div class="stat-card-label">Étudiants</div>
            <div class="stat-card-val">{{ $stats['etudiants'] ?? 0 }}</div>
            <div class="stat-card-trend trend-up">↑ Actif</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-icon sci-red">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div class="stat-card-label">Créneaux actifs</div>
            <div class="stat-card-val">{{ $stats['emplois'] ?? 0 }}</div>
            <div class="stat-card-trend trend-up">↑ En cours</div>
        </div>
    </div>

    {{-- ▌CHARTS ROW --}}
    <div class="panels-row panels-row-2">
        <div class="panel">
            <div class="panel-header">
                <div>
                    <div class="panel-kicker">Weekly performance</div>
                    <div class="panel-title">Occupation hebdomadaire</div>
                </div>
                <span class="panel-badge">Par jour</span>
            </div>
            <div class="chart-frame" style="position:relative; height:280px; width:100%;">
                <canvas id="scheduleByDayChart"></canvas>
            </div>
        </div>
        <div class="panel">
            <div class="panel-header">
                <div>
                    <div class="panel-kicker">Course mix</div>
                    <div class="panel-title">Types de cours</div>
                </div>
                <span class="panel-badge">Répartition</span>
            </div>
            <div class="chart-frame chart-frame-donut" style="position:relative; height:280px; width:100%;">
                <canvas id="typeDistributionChart"></canvas>
            </div>
        </div>
    </div>

    {{-- ▌TABLE + SESSIONS --}}
    <div class="panels-row panels-row-3">
        <div class="panel">
            <div class="panel-header">
                <div>
                    <div class="panel-kicker">Load map</div>
                    <div class="panel-title">Charge par filière</div>
                </div>
                <span class="panel-badge">Top actives</span>
            </div>
            <div style="overflow-x:auto;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Filière</th>
                            <th>Étudiants</th>
                            <th>Créneaux</th>
                            <th>Charge</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($filiereLoad ?? [] as $filiere)
                            @php
                                $maxSlots = max(collect($filiereLoad)->max('emplois_du_temps_count') ?? 1, 1);
                                $pct = (int) round(($filiere->emplois_du_temps_count / $maxSlots) * 100);
                            @endphp
                            <tr>
                                <td class="dt-name">{{ $filiere->nom_filiere }}</td>
                                <td class="dt-count">{{ $filiere->etudiants_count }}</td>
                                <td class="dt-count">{{ $filiere->emplois_du_temps_count }}</td>
                                <td>
                                    <div class="prog-wrap">
                                        <div class="prog-bar">
                                            <div class="prog-fill" style="width:{{ $pct }}%"></div>
                                        </div>
                                        <span class="prog-label">{{ $pct }}%</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="empty-state"><p>Aucune donnée disponible.</p></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel">
            <div class="panel-header">
                <div>
                    <div class="panel-kicker">Next sessions</div>
                    <div class="panel-title">Prochaines séances</div>
                </div>
                <span class="panel-badge">Aperçu</span>
            </div>
            <div class="session-list">
                @forelse($nextSessions ?? [] as $session)
                    @php
                        $tc = match($session->type_cours) {
                            'Cours'  => 'type-cours',
                            'TD'     => 'type-td',
                            'TP'     => 'type-tp',
                            'Examen' => 'type-examen',
                            default  => 'type-default',
                        };
                    @endphp
                    <div class="session-item">
                        <div>
                            <div class="session-name">{{ optional($session->matiere)->nom_matiere ?? 'Matière' }}</div>
                            <div class="session-meta">{{ ucfirst($session->jour) }} · {{ $session->heure_debut }} – {{ $session->heure_fin }}</div>
                            <div class="session-meta">{{ optional($session->filiere)->nom_filiere ?? '–' }} · {{ optional($session->enseignant)->name ?? '–' }}</div>
                        </div>
                        <span class="session-type {{ $tc }}">{{ $session->type_cours ?? 'Cours' }}</span>
                    </div>
                @empty
                    <div class="empty-state"><p>Aucune séance prochaine.</p></div>
                @endforelse
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // Charts
    document.addEventListener('DOMContentLoaded', () => {
        const dayLabels = @json($days ?? []);
        const scheduleData = @json($scheduleByDay ?? []);
        const typeLabels = @json($types ?? []);
        const typeData = @json($typeDistribution ?? []);

        const shared = {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { labels: { color: '#a0c8f0', usePointStyle: true, boxWidth: 10 } } }
        };

        const barCtx = document.getElementById('scheduleByDayChart');
        if (barCtx && window.Chart) {
            new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: dayLabels,
                    datasets: [{
                        label: 'Créneaux',
                        data: scheduleData,
                        backgroundColor: ctx => {
                            const { chartArea, ctx: c } = ctx.chart;
                            if (!chartArea) return '#4aa3ff';
                            const g = c.createLinearGradient(0, chartArea.top, 0, chartArea.bottom);
                            g.addColorStop(0, '#4aa3ff');
                            g.addColorStop(1, '#0f4c81');
                            return g;
                        },
                        borderRadius: 10,
                        borderSkipped: false,
                        maxBarThickness: 36,
                    }]
                },
                options: {
                    ...shared,
                    scales: {
                        x: { grid: { color: 'rgba(148,163,184,.08)' }, ticks: { color: '#7da0c8' } },
                        y: { beginAtZero: true, grid: { color: 'rgba(148,163,184,.08)' }, ticks: { precision: 0, color: '#7da0c8' } }
                    }
                }
            });
        }

        const donutCtx = document.getElementById('typeDistributionChart');
        if (donutCtx && window.Chart) {
            new Chart(donutCtx, {
                type: 'doughnut',
                data: {
                    labels: typeLabels,
                    datasets: [{
                        data: typeData,
                        backgroundColor: ['#4aa3ff','#f59f00','#06d6a0','#ff6b35'],
                        borderWidth: 0,
                        hoverOffset: 10,
                    }]
                },
                options: {
                    ...shared,
                    cutout: '70%',
                    plugins: { legend: { position: 'bottom', labels: { color: '#a0c8f0', padding: 16, usePointStyle: true, font: { size: 11 } } } }
                }
            });
        }
    });
    </script>
</x-app-layout>
