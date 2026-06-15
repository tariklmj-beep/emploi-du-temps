<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.homeRouteName', 'PolyTech') }} — Gestion Académique Intelligente</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <meta name="description" content="Pilotez vos emplois du temps, enseignants, étudiants et salles depuis une seule plateforme moderne et intuitive.">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy:   #0f2240;
            --blue:   #1a3f6f;
            --sky:    #2176ff;
            --teal:   #06d6a0;
            --lime:   #b8f400;
            --light:  #f0f4ff;
            --white:  #ffffff;
            --gray:   #64748b;
            --border: rgba(30,60,120,.12);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--light);
            color: #1e293b;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        /* ─── NAV ─── */
        .nav {
            position: sticky; top: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 5vw;
            height: 72px;
            background: rgba(255,255,255,.82);
            backdrop-filter: blur(18px) saturate(1.4);
            border-bottom: 1px solid var(--border);
        }
        .nav-brand {
            font-size: 1.55rem; font-weight: 900; letter-spacing: -.03em;
            color: var(--navy); text-decoration: none;
            display: flex; align-items: center; gap: .45rem;
        }
        .nav-brand .dot { color: var(--sky); }
        .nav-links { display: flex; gap: 2rem; list-style: none; }
        .nav-links a {
            color: #334155; font-weight: 600; font-size: .93rem;
            text-decoration: none; position: relative; padding-bottom: 2px;
            transition: color .2s;
        }
        .nav-links a::after {
            content: ''; position: absolute; bottom: -2px; left: 0;
            width: 0; height: 2px; background: var(--sky);
            border-radius: 2px; transition: width .2s;
        }
        .nav-links a:hover { color: var(--sky); }
        .nav-links a:hover::after { width: 100%; }
        .nav-cta {
            background: var(--sky); color: #fff;
            padding: .58rem 1.4rem; border-radius: 999px;
            font-weight: 700; font-size: .93rem; text-decoration: none;
            transition: transform .18s, box-shadow .18s;
        }
        .nav-cta:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(33,118,255,.35); }

        /* ─── HERO ─── */
        .hero {
            position: relative; overflow: hidden;
            background: linear-gradient(135deg, #0a1f3e 0%, #0f2f60 45%, #133060 100%);
            min-height: 88vh;
            display: flex; align-items: center; justify-content: center;
            text-align: center;
            padding: 6rem 5vw 5rem;
        }
        /* animated blobs */
        .hero::before {
            content: ''; position: absolute;
            width: 650px; height: 650px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(6,214,160,.18) 0%, transparent 70%);
            top: -200px; right: -180px;
            animation: blobMove 10s ease-in-out infinite alternate;
        }
        .hero::after {
            content: ''; position: absolute;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(33,118,255,.22) 0%, transparent 70%);
            bottom: -180px; left: -140px;
            animation: blobMove 13s ease-in-out infinite alternate-reverse;
        }
        @keyframes blobMove {
            from { transform: translate(0, 0) scale(1); }
            to   { transform: translate(40px, 30px) scale(1.12); }
        }

        .hero-inner { position: relative; z-index: 1; max-width: 900px; }

        .hero-badge {
            display: inline-flex; align-items: center; gap: .45rem;
            background: rgba(6,214,160,.12);
            border: 1px solid rgba(6,214,160,.35);
            border-radius: 999px;
            color: #06d6a0; font-size: .82rem; font-weight: 700;
            padding: .35rem .9rem; margin-bottom: 1.8rem;
            letter-spacing: .04em; text-transform: uppercase;
        }
        .hero-badge span { width: 7px; height: 7px; border-radius: 50%; background: #06d6a0; animation: pulse 1.4s ease-in-out infinite; }
        @keyframes pulse { 0%,100% { opacity: 1; } 50% { opacity: .35; } }

        .hero-title {
            font-size: clamp(2.2rem, 5.5vw, 4.8rem);
            font-weight: 900; letter-spacing: -.04em;
            line-height: 1.1; color: #f4f8ff;
            margin-bottom: 1.4rem;
        }
        .hero-title .hl { color: var(--teal); }
        .hero-title .hl2 { color: var(--lime); }

        .hero-sub {
            font-size: clamp(1rem, 1.6vw, 1.3rem);
            color: #a8c0e0; font-weight: 500; line-height: 1.6;
            max-width: 680px; margin: 0 auto 2.4rem;
        }

        .hero-actions { display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap; }
        .btn-primary {
            display: inline-flex; align-items: center; gap: .5rem;
            background: var(--teal); color: #071d12; font-weight: 800;
            padding: .95rem 2.2rem; border-radius: 999px; font-size: 1rem;
            text-decoration: none; transition: transform .18s, box-shadow .18s;
        }
        .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 14px 32px rgba(6,214,160,.4); }
        .btn-ghost {
            display: inline-flex; align-items: center; gap: .5rem;
            border: 1.5px solid rgba(255,255,255,.3); color: #cfe0fa;
            padding: .95rem 2rem; border-radius: 999px; font-size: 1rem;
            font-weight: 700; text-decoration: none; background: rgba(255,255,255,.05);
            transition: border-color .18s, background .18s;
        }
        .btn-ghost:hover { border-color: rgba(255,255,255,.7); background: rgba(255,255,255,.1); color: #fff; }

        /* hero stats bar */
        .hero-stats {
            margin-top: 3.5rem;
            display: flex; justify-content: center; gap: 2.5rem; flex-wrap: wrap;
        }
        .hero-stat { text-align: center; }
        .hero-stat strong { display: block; font-size: 2rem; font-weight: 900; color: #fff; }
        .hero-stat small { color: #7da0c8; font-size: .82rem; font-weight: 600; letter-spacing: .02em; }

        /* scrolling marquee */
        .marquee-wrap { background: var(--navy); overflow: hidden; padding: .8rem 0; border-top: 1px solid rgba(255,255,255,.06); }
        .marquee-track {
            display: flex; gap: 3rem; width: max-content;
            animation: marquee 24s linear infinite;
        }
        @keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }
        .marquee-item {
            white-space: nowrap; color: #6b8db5; font-size: .8rem;
            font-weight: 700; letter-spacing: .08em; text-transform: uppercase;
            display: flex; align-items: center; gap: .6rem;
        }
        .marquee-item::before { content: '✦'; color: var(--teal); font-size: .7rem; }

        /* ─── SECTIONS ─── */
        .section { padding: 6rem 5vw; }
        .section-alt { background: #fff; }
        .container { max-width: 1180px; margin: 0 auto; }

        .section-tag {
            display: inline-block; background: rgba(33,118,255,.1); color: var(--sky);
            font-size: .76rem; font-weight: 800; letter-spacing: .08em; text-transform: uppercase;
            padding: .3rem .75rem; border-radius: 999px; margin-bottom: .9rem;
        }
        .section-title {
            font-size: clamp(1.8rem, 3vw, 2.9rem);
            font-weight: 900; color: var(--navy);
            letter-spacing: -.03em; margin-bottom: .8rem;
        }
        .section-sub {
            color: var(--gray); max-width: 640px;
            line-height: 1.6; font-size: 1.05rem;
        }

        /* ─── FEATURE CARDS ─── */
        .feat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.4rem; margin-top: 3rem;
        }
        .feat-card {
            background: #fff;
            border: 1px solid #e2eaf6;
            border-radius: 20px;
            padding: 2rem 1.8rem;
            box-shadow: 0 4px 20px rgba(15,40,80,.05);
            transition: transform .22s, box-shadow .22s, border-color .22s;
            position: relative; overflow: hidden;
        }
        .feat-card::before {
            content: ''; position: absolute;
            inset: 0; border-radius: 20px;
            background: linear-gradient(135deg, rgba(33,118,255,.04), transparent);
            opacity: 0; transition: opacity .22s;
        }
        .feat-card:hover { transform: translateY(-6px); box-shadow: 0 20px 45px rgba(15,40,80,.11); border-color: #b3cef5; }
        .feat-card:hover::before { opacity: 1; }
        .feat-icon {
            width: 52px; height: 52px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 1.2rem; font-size: 1.5rem;
        }
        .feat-icon.blue   { background: rgba(33,118,255,.12);  color: var(--sky);  }
        .feat-icon.teal   { background: rgba(6,214,160,.12);   color: var(--teal); }
        .feat-icon.purple { background: rgba(139,92,246,.12);  color: #8b5cf6;     }
        .feat-icon.orange { background: rgba(251,146,60,.12);  color: #fb923c;     }
        .feat-icon.pink   { background: rgba(236,72,153,.12);  color: #ec4899;     }
        .feat-icon.lime   { background: rgba(132,204,22,.12);  color: #84cc16;     }
        .feat-card h3 { font-size: 1.1rem; font-weight: 800; color: var(--navy); margin-bottom: .5rem; }
        .feat-card p  { color: var(--gray); line-height: 1.55; font-size: .95rem; }

        /* ─── SOLUTIONS ─── */
        .sol-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.4rem; margin-top: 3rem;
        }
        .sol-card {
            border-radius: 22px;
            padding: 2.2rem 2rem;
            position: relative; overflow: hidden;
            transition: transform .22s, box-shadow .22s;
        }
        .sol-card:hover { transform: translateY(-5px); box-shadow: 0 22px 50px rgba(0,0,20,.15); }
        .sol-card.c1 { background: linear-gradient(135deg, #0f2240, #1a3f6f); color: #fff; }
        .sol-card.c2 { background: linear-gradient(135deg, #064e3b, #065f46); color: #fff; }
        .sol-card.c3 { background: linear-gradient(135deg, #312e81, #4c1d95); color: #fff; }
        .sol-card .sol-num {
            font-size: 4rem; font-weight: 900; opacity: .08;
            position: absolute; top: .5rem; right: 1.2rem; line-height: 1;
        }
        .sol-card h3 { font-size: 1.35rem; font-weight: 800; margin-bottom: .6rem; }
        .sol-card p  { opacity: .78; line-height: 1.6; font-size: .97rem; }
        .sol-chip {
            display: inline-block; margin-top: 1.2rem;
            padding: .28rem .8rem; border-radius: 999px;
            font-size: .75rem; font-weight: 800; letter-spacing: .04em;
            background: rgba(255,255,255,.15); color: #fff;
        }

        /* ─── PRICING ─── */
        .price-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.4rem; margin-top: 3rem; align-items: start;
        }
        .price-card {
            border: 1px solid #d9e8f5; border-radius: 22px;
            padding: 2.2rem 2rem; background: #fff;
            box-shadow: 0 6px 28px rgba(15,40,80,.07);
            transition: transform .22s, box-shadow .22s;
            position: relative; overflow: hidden;
        }
        .price-card:hover { transform: translateY(-5px); box-shadow: 0 20px 50px rgba(15,40,80,.12); }
        .price-card.featured {
            background: linear-gradient(160deg, #0f2240 0%, #1a3f6f 100%);
            border-color: transparent;
            box-shadow: 0 20px 55px rgba(15,40,100,.28);
            transform: scale(1.03);
        }
        .price-card.featured:hover { transform: scale(1.03) translateY(-5px); }
        .price-badge {
            display: inline-block; margin-bottom: 1rem;
            padding: .25rem .75rem; border-radius: 999px;
            font-size: .73rem; font-weight: 800; letter-spacing: .06em; text-transform: uppercase;
        }
        .price-badge.b1 { background: #e0f2fe; color: #0369a1; }
        .price-badge.b2 { background: var(--teal); color: #071d12; }
        .price-badge.b3 { background: #f3e8ff; color: #7c3aed; }
        .price-card h3 { font-size: 1.4rem; font-weight: 800; margin-bottom: .4rem; color: var(--navy); }
        .price-card.featured h3 { color: #e8f0ff; }
        .price-amount {
            font-size: 2.5rem; font-weight: 900;
            color: var(--sky); margin: .6rem 0 .4rem;
        }
        .price-card.featured .price-amount { color: var(--teal); }
        .price-card p { color: var(--gray); font-size: .93rem; line-height: 1.55; }
        .price-card.featured p { color: #a8c0e0; }
        .price-features { list-style: none; margin-top: 1.4rem; display: flex; flex-direction: column; gap: .55rem; }
        .price-features li {
            display: flex; align-items: center; gap: .55rem;
            font-size: .9rem; color: #475569;
        }
        .price-card.featured .price-features li { color: #c8d9f0; }
        .price-features li::before { content: '✓'; font-weight: 900; color: var(--teal); flex-shrink: 0; }
        .price-btn {
            display: block; text-align: center; margin-top: 1.8rem;
            padding: .8rem; border-radius: 999px; font-weight: 700;
            font-size: .95rem; text-decoration: none; transition: all .18s;
        }
        .price-btn-outline { border: 2px solid #cbd5e1; color: var(--navy); }
        .price-btn-outline:hover { border-color: var(--sky); color: var(--sky); }
        .price-btn-solid { background: var(--teal); color: #071d12; }
        .price-btn-solid:hover { box-shadow: 0 8px 24px rgba(6,214,160,.45); transform: translateY(-1px); }

        /* ─── ABOUT ─── */
        .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; margin-top: 3rem; }
        @media (max-width: 768px) { .about-grid { grid-template-columns: 1fr; gap: 2rem; } }
        .about-text p { color: var(--gray); line-height: 1.7; margin-bottom: 1rem; font-size: 1.02rem; }
        .stats-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .stat-box {
            background: #fff; border: 1px solid #e2eaf6;
            border-radius: 18px; padding: 1.5rem;
            box-shadow: 0 4px 18px rgba(15,40,80,.05);
            text-align: center; transition: transform .2s;
        }
        .stat-box:hover { transform: translateY(-4px); }
        .stat-box strong { display: block; font-size: 2.2rem; font-weight: 900; color: var(--sky); }
        .stat-box span { color: var(--gray); font-size: .85rem; font-weight: 600; }

        /* ─── CONTACT ─── */
        .contact-card {
            background: var(--navy);
            border-radius: 28px; padding: 4rem 3rem;
            text-align: center;
            position: relative; overflow: hidden;
        }
        .contact-card::before {
            content: ''; position: absolute;
            width: 400px; height: 400px; border-radius: 50%;
            background: radial-gradient(circle, rgba(6,214,160,.15) 0%, transparent 70%);
            top: -100px; right: -80px; pointer-events: none;
        }
        .contact-card h2 { font-size: 2.4rem; font-weight: 900; color: #fff; margin-bottom: .8rem; }
        .contact-card p  { color: #7da0c8; font-size: 1.05rem; margin-bottom: 2.5rem; }
        .contact-items {
            display: flex; justify-content: center; flex-wrap: wrap; gap: 1.2rem;
            margin-bottom: 2.5rem;
        }
        .contact-chip {
            display: flex; align-items: center; gap: .5rem;
            background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.14);
            border-radius: 999px; padding: .65rem 1.3rem;
            color: #c8d9f0; font-size: .9rem; font-weight: 600;
        }
        .contact-chip svg { flex-shrink: 0; }

        /* ─── FOOTER ─── */
        .footer {
            background: #071528; color: #4b6880;
            text-align: center; padding: 2rem 5vw;
            font-size: .88rem;
        }
        .footer a { color: #6589a0; text-decoration: none; }
        .footer a:hover { color: var(--teal); }

        /* ─── RESPONSIVE NAV ─── */
        @media (max-width: 820px) {
            .nav-links { display: none; }
            .hero-stats { gap: 1.5rem; }
            .hero-stat strong { font-size: 1.5rem; }
        }
    </style>
</head>
<body>

<!-- ▌NAV -->
<header class="nav">
    <a class="nav-brand" href="{{ url('/') }}">
        <img src="{{ asset('images/logo.png') }}" alt="EPG Logo" style="height: 48px; width: auto; margin-right: 0.5rem;">
        <div style="display: flex; flex-direction: column; line-height: 1;">
            <span style="font-size: 1.1rem; font-weight: 800;">EPG</span>
            <span style="font-size: 0.65rem; font-weight: 600; color: var(--gray); text-transform: uppercase; letter-spacing: 0.05em;">PolyTech</span>
        </div>
    </a>
    <ul class="nav-links">
        <li><a href="#fonctionnalites">Fonctionnalités</a></li>
        <li><a href="#solutions">Solutions</a></li>
        <li><a href="#tarifs">Tarifs</a></li>
        <li><a href="#apropos">À propos</a></li>
        <li><a href="#contact">Contact</a></li>
    </ul>
    @if (Route::has('login'))
        @auth
            <a href="{{ route(auth()->user()->homeRouteName()) }}" class="nav-cta">Tableau de bord →</a>
        @else
            <a href="{{ route('login') }}" class="nav-cta">Connexion →</a>
        @endauth
    @endif
</header>

<!-- ▌HERO -->
<section class="hero">
    <div class="hero-inner">
        <div class="hero-badge">
            <span></span> Plateforme académique nouvelle génération
        </div>
        <h1 class="hero-title">
            Gérez votre <span class="hl">Emploi du Temps</span><br>
            avec une <span class="hl2">Précision Absolue</span>
        </h1>
        <p class="hero-sub">
            Automatisez la planification, centralisez enseignants, étudiants et salles,
            et pilotez votre établissement depuis une seule plateforme intelligente.
        </p>
        <div class="hero-actions">
            @if (Route::has('login'))
                @auth
                    <a href="{{ route(auth()->user()->homeRouteName()) }}" class="btn-primary">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M3 12h18m-7-7 7 7-7 7"/></svg>
                        Accéder au tableau de bord
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M3 12h18m-7-7 7 7-7 7"/></svg>
                        Commencer gratuitement
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-ghost">Créer un compte</a>
                    @endif
                @endauth
            @endif
        </div>
        <div class="hero-stats">
            <div class="hero-stat"><strong>100%</strong><small>Centralisé</small></div>
            <div class="hero-stat"><strong>24/7</strong><small>Accès sécurisé</small></div>
            <div class="hero-stat"><strong>3 rôles</strong><small>Admin · Enseignant · Étudiant</small></div>
            <div class="hero-stat"><strong>Cloud</strong><small>Déployable en minutes</small></div>
        </div>
    </div>
</section>

<!-- ▌MARQUEE -->
<div class="marquee-wrap">
    <div class="marquee-track">
        @foreach (array_fill(0, 2, ['Planification automatisée','Gestion des enseignants','Suivi des absences','Notes & évaluations','Gestion des salles','Emplois du temps en ligne','Filieres & Matières']) as $items)
            @foreach ($items as $item)
                <span class="marquee-item">{{ $item }}</span>
            @endforeach
        @endforeach
    </div>
</div>

<!-- ▌FONCTIONNALITÉS -->
<section id="fonctionnalites" class="section section-alt">
    <div class="container">
        <span class="section-tag">Fonctionnalités</span>
        <h2 class="section-title">Tout ce dont vous avez besoin</h2>
        <p class="section-sub">Des outils puissants et intuitifs pour une gestion académique sans friction au quotidien.</p>
        <div class="feat-grid">
            <div class="feat-card">
                <div class="feat-icon blue">📅</div>
                <h3>Planification intelligente</h3>
                <p>Créez et visualisez rapidement créneaux de cours, TD, TP et examens avec une interface claire.</p>
            </div>
            <div class="feat-card">
                <div class="feat-icon teal">👥</div>
                <h3>Gestion des ressources</h3>
                <p>Centralisez filieres, matières, enseignants, étudiants, classes et salles en un seul endroit.</p>
            </div>
            <div class="feat-card">
                <div class="feat-icon purple">📊</div>
                <h3>Suivi pédagogique</h3>
                <p>Notes, absences et performances académiques toujours à jour et accessibles en temps réel.</p>
            </div>
            <div class="feat-card">
                <div class="feat-icon orange">🔔</div>
                <h3>Alertes & Notifications</h3>
                <p>Restez informé des modifications de planning, absences enregistrées et mises à jour importantes.</p>
            </div>
            <div class="feat-card">
                <div class="feat-icon pink">🔒</div>
                <h3>Accès sécurisé par rôle</h3>
                <p>Chaque utilisateur accède uniquement aux données qui le concernent, en toute sécurité.</p>
            </div>
            <div class="feat-card">
                <div class="feat-icon lime">⚡</div>
                <h3>Performance & Rapidité</h3>
                <p>Interface réactive, temps de chargement optimisés et navigation fluide sur tous les appareils.</p>
            </div>
        </div>
    </div>
</section>

<!-- ▌SOLUTIONS -->
<section id="solutions" class="section">
    <div class="container">
        <span class="section-tag">Solutions</span>
        <h2 class="section-title">Une expérience sur mesure</h2>
        <p class="section-sub">PolyTech s'adapte à chaque acteur de votre établissement avec des interfaces dédiées.</p>
        <div class="sol-grid">
            <div class="sol-card c1">
                <span class="sol-num">01</span>
                <h3>Administration</h3>
                <p>Pilotez la structure complète : filieres, matières, salles, comptes et planning global de l'établissement.</p>
                <span class="sol-chip">Vision globale</span>
            </div>
            <div class="sol-card c2">
                <span class="sol-num">02</span>
                <h3>Enseignants</h3>
                <p>Consultez vos créneaux assignés, saisissez les notes et gérez les absences simplement et rapidement.</p>
                <span class="sol-chip">Gestion simplifiée</span>
            </div>
            <div class="sol-card c3">
                <span class="sol-num">03</span>
                <h3>Étudiants</h3>
                <p>Accédez à l'emploi du temps, aux évaluations et aux informations de classe en un simple clic.</p>
                <span class="sol-chip">Accès instantané</span>
            </div>
        </div>
    </div>
</section>

<!-- ▌TARIFS -->
<section id="tarifs" class="section section-alt">
    <div class="container">
        <span class="section-tag">Tarifs</span>
        <h2 class="section-title">Transparent & Flexible</h2>
        <p class="section-sub">Démarrez gratuitement puis évoluez selon la taille de votre établissement. Sans engagement.</p>
        <div class="price-grid">
            <div class="price-card">
                <span class="price-badge b1">Essentiel</span>
                <h3>Starter</h3>
                <div class="price-amount">0 DH</div>
                <p>Pour découvrir la plateforme et ses fonctionnalités de base.</p>
                <ul class="price-features">
                    <li>Jusqu'à 50 étudiants</li>
                    <li>Planning hebdomadaire</li>
                    <li>2 rôles utilisateurs</li>
                </ul>
                <a href="{{ route('register') }}" class="price-btn price-btn-outline">Commencer →</a>
            </div>
            <div class="price-card featured">
                <span class="price-badge b2">⭐ Populaire</span>
                <h3>Standard</h3>
                <div class="price-amount">Sur devis</div>
                <p>Pour les établissements en croissance qui ont besoin de plus de puissance.</p>
                <ul class="price-features">
                    <li>Étudiants illimités</li>
                    <li>Multi-filieres & classes</li>
                    <li>Tous les rôles inclus</li>
                    <li>Support prioritaire</li>
                </ul>
                <a href="#contact" class="price-btn price-btn-solid">Demander un devis →</a>
            </div>
            <div class="price-card">
                <span class="price-badge b3">Premium</span>
                <h3>Entreprise</h3>
                <div class="price-amount">Sur mesure</div>
                <p>Pour les structures multi-sites avec des besoins avancés et personnalisés.</p>
                <ul class="price-features">
                    <li>Multi-campus</li>
                    <li>Intégrations sur mesure</li>
                    <li>Déploiement privé</li>
                    <li>SLA garantie</li>
                </ul>
                <a href="#contact" class="price-btn price-btn-outline">Nous contacter →</a>
            </div>
        </div>
    </div>
</section>

<!-- ▌À PROPOS -->
<section id="apropos" class="section">
    <div class="container">
        <span class="section-tag">À propos</span>
        <h2 class="section-title">Notre mission</h2>
        <div class="about-grid">
            <div class="about-text">
                <p>PolyTech est né d'un constat simple : la gestion académique est trop souvent fragmentée, chronophage et source d'erreurs.</p>
                <p>Notre mission est de centraliser, automatiser et moderniser l'organisation des établissements d'enseignement supérieur grâce à une plateforme intuitive et fiable.</p>
                <p>De la planification des cours jusqu'au suivi des activités académiques, PolyTech accompagne chaque membre de votre établissement au quotidien.</p>
            </div>
            <div class="stats-grid">
                <div class="stat-box"><strong>100%</strong><span>Centralisé</span></div>
                <div class="stat-box"><strong>24/7</strong><span>Accès sécurisé</span></div>
                <div class="stat-box"><strong>Cloud</strong><span>Déployable</span></div>
                <div class="stat-box"><strong>3 rôles</strong><span>Bien définis</span></div>
            </div>
        </div>
    </div>
</section>

<!-- ▌CONTACT -->
<section id="contact" class="section section-alt">
    <div class="container">
        <div class="contact-card">
            <h2>Prêt à transformer votre établissement ?</h2>
            <p>Demandez une démo gratuite ou contactez notre équipe pour un accompagnement personnalisé.</p>
            <div class="contact-items">
                <div class="contact-chip">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    contact@polytech.ma
                </div>
                <div class="contact-chip">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13 19.79 19.79 0 0 1 1.62 4.38 2 2 0 0 1 3.6 2.18h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.29 6.29l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    +212 6 00 00 00 00
                </div>
                <div class="contact-chip">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Casablanca, Maroc
                </div>
            </div>
            <a href="{{ route('register') }}" class="btn-primary" style="display:inline-flex;">
                Demander une démo gratuite →
            </a>
        </div>
    </div>
</section>

<!-- ▌FOOTER -->
<footer class="footer">
    <p>© {{ date('Y') }} <strong style="color:#6589a0">PolyTech</strong> by Plenitude Groupe — Tous droits réservés &nbsp;·&nbsp; <a href="#">Mentions légales</a> &nbsp;·&nbsp; <a href="#">Confidentialité</a></p>
</footer>

</body>
</html>
