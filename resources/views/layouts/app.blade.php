<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PolyTech') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy:    #07101a;
            --navy2:   #0b1624;
            --navy3:   #111f33;
            --blue:    #4aa3ff;
            --blue2:   #2176ff;
            --teal:    #06d6a0;
            --border:  rgba(148,163,184,.14);
            --text:    #e5eefb;
            --muted:   rgba(229,238,251,.75);
            --sidebar: 260px;
            --bg-gradient: radial-gradient(circle at top left, rgba(74,163,255,.12) 0%, transparent 35%),
                           radial-gradient(circle at bottom right, rgba(6,214,160,.08) 0%, transparent 30%),
                           linear-gradient(160deg, var(--navy) 0%, var(--navy2) 45%, var(--navy3) 100%);
            --topbar-bg: rgba(7,16,26,.7);
            --card-bg: rgba(255,255,255,.05);
            --sidebar-bg: linear-gradient(180deg, rgba(7,16,26,.96) 0%, rgba(11,22,36,.98) 100%);
            --blue-rgb: 74, 163, 255;
        }

        .light-mode {
            --navy:    #f8fbff;
            --navy2:   #f0f4f9;
            --navy3:   #e2e8f0;
            --blue:    #0f4c81;
            --blue2:   #2176ff;
            --teal:    #059669;
            --border:  rgba(15,76,129,.12);
            --text:    #1e293b;
            --muted:   #64748b;
            --bg-gradient: radial-gradient(circle at top left, rgba(33,118,255,.05) 0%, transparent 35%),
                           linear-gradient(160deg, #f8fbff 0%, #f1f5f9 100%);
            --topbar-bg: rgba(255,255,255,.8);
            --card-bg: #ffffff;
            --sidebar-bg: #ffffff;
            --blue-rgb: 15, 76, 129;
        }

        .light-mode .sidebar-link, 
        .light-mode .sidebar-section-label,
        .light-mode .sidebar-brand-sub { color: var(--muted) !important; }
        
        .light-mode .sidebar-brand-name,
        .light-mode .sidebar-user-name,
        .light-mode .topbar-title,
        .light-mode .h5, .light-mode .h6,
        .light-mode .crud-title,
        .light-mode .crud-table td,
        .light-mode .crud-table th { color: var(--text) !important; }

        /* Dark mode safety */
        html:not(.light-mode) .crud-table td,
        html:not(.light-mode) .crud-table th,
        html:not(.light-mode) .crud-title,
        html:not(.light-mode) .topbar-title,
        html:not(.light-mode) h2,
        html:not(.light-mode) .h3,
        html:not(.light-mode) .sidebar-brand-name { color: #ffffff !important; }
        
        html:not(.light-mode) .text-secondary { color: rgba(255,255,255,0.7) !important; }

        .light-mode .sidebar-link:hover { background: rgba(15,76,129,.05); color: var(--blue) !important; }
        .light-mode .sidebar-link.active { color: #fff !important; }

        html, body { height: 100%; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-gradient);
            min-height: 100vh;
            color: var(--text);
            -webkit-font-smoothing: antialiased;
            transition: background 0.3s ease, color 0.3s ease;
        }

        /* ═══════════════ LAYOUT ═══════════════ */
        .app-layout { display: flex; min-height: 100vh; }

        /* ═══════════════ SIDEBAR ═══════════════ */
        .sidebar {
            width: var(--sidebar);
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border);
            backdrop-filter: blur(20px);
            position: sticky; top: 0;
            height: 100vh;
            overflow-y: auto;
            scrollbar-width: none;
            transition: background 0.3s ease;
        }
        .sidebar::-webkit-scrollbar { display: none; }

        .sidebar-brand {
            display: flex; align-items: center; gap: .8rem;
            padding: 1.4rem 1.2rem 1rem;
            text-decoration: none;
            border-bottom: 1px solid var(--border);
            margin-bottom: .5rem;
        }
        .sidebar-brand-icon {
            width: 40px; height: 40px; border-radius: 12px;
            background: linear-gradient(135deg, var(--blue), #0f4c81);
            display: grid; place-items: center;
            font-weight: 900; font-size: .8rem; color: #fff;
            box-shadow: 0 8px 20px rgba(74,163,255,.3);
            flex-shrink: 0;
        }
        .sidebar-brand-name { font-size: 1.05rem; font-weight: 800; color: var(--text); line-height: 1.2;}
        .sidebar-brand-sub  { font-size: .72rem; color: var(--muted); letter-spacing: .04em; }

        .sidebar-section { padding: .6rem 1rem .3rem; }
        .sidebar-section-label {
            font-size: .68rem; font-weight: 700; letter-spacing: .1em;
            text-transform: uppercase; color: var(--muted);
            padding: 0 .4rem; margin-bottom: .3rem;
        }
        .sidebar-link {
            display: flex; align-items: center; gap: .7rem;
            padding: .58rem .75rem; border-radius: .7rem;
            color: var(--muted); text-decoration: none;
            font-weight: 600; font-size: .9rem;
            transition: all .18s; border: 1px solid transparent;
            margin-bottom: .15rem;
        }
        .sidebar-link svg { width: 17px; height: 17px; flex-shrink: 0; opacity: .7; transition: opacity .18s; }
        .sidebar-link:hover { background: rgba(74,163,255,.1); border-color: rgba(74,163,255,.16); color: var(--text); }
        .sidebar-link:hover svg { opacity: 1; }
        .sidebar-link.active {
            background: linear-gradient(135deg, rgba(74,163,255,.22), rgba(15,76,129,.2));
            border-color: rgba(74,163,255,.22);
            color: #fff; box-shadow: 0 4px 16px rgba(74,163,255,.15);
        }
        .sidebar-link.active svg { opacity: 1; }
        .sidebar-link-dot {
            width: 7px; height: 7px; border-radius: 50%;
            background: var(--teal); margin-left: auto; flex-shrink: 0;
        }

        .sidebar-footer {
            margin-top: auto; padding: 1rem;
            border-top: 1px solid var(--border);
        }
        .sidebar-user {
            display: flex; align-items: center; gap: .75rem;
            padding: .75rem; border-radius: .85rem;
            background: rgba(255,255,255,.04); border: 1px solid var(--border);
            margin-bottom: .75rem;
        }
        .sidebar-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg,var(--blue),#0f4c81);
            display: grid; place-items: center;
            font-size: .78rem; font-weight: 800; color: #fff; flex-shrink: 0;
        }
        .sidebar-user-name  { font-size: .88rem; font-weight: 700; color: var(--text); }
        .sidebar-user-email { font-size: .74rem; color: var(--muted); }
        .sidebar-logout {
            display: flex; align-items: center; justify-content: center; gap: .5rem;
            width: 100%; padding: .62rem;
            background: rgba(239,68,68,.08); border: 1px solid rgba(239,68,68,.16);
            border-radius: .7rem; color: #fca5a5;
            font-size: .88rem; font-weight: 700; cursor: pointer;
            transition: all .18s;
        }
        .sidebar-logout:hover { background: rgba(239,68,68,.16); color: #fecaca; }

        /* ═══════════════ MAIN ═══════════════ */
        .main-wrap { flex: 1; min-width: 0; display: flex; flex-direction: column; }

        /* topbar */
        .topbar {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1rem 1.6rem;
            background: var(--topbar-bg);
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(16px);
            position: sticky; top: 0; z-index: 50;
            gap: 1rem;
            transition: background 0.3s ease;
        }
        .topbar-header-slot { flex: 1; }
        .topbar-right { display: flex; align-items: center; gap: .75rem; justify-content: flex-end; }
        .topbar-badge {
            display: flex; align-items: center; gap: .45rem;
            background: rgba(6,214,160,.1); border: 1px solid rgba(6,214,160,.22);
            border-radius: 999px; padding: .35rem .9rem;
            color: var(--teal); font-size: .8rem; font-weight: 700;
        }
        .topbar-badge-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--teal); animation: pulse 1.4s ease-in-out infinite; }
        @keyframes pulse { 0%,100% { opacity:1; } 50% { opacity:.3; } }

        .main-content { padding: 1.4rem 1.6rem; flex: 1; }

        /* ═══════════════ ALERTS ═══════════════ */
        .alert-stack { display: flex; flex-direction: column; gap: .65rem; margin-bottom: 1.4rem; }
        .alert {
            display: flex; align-items: flex-start; gap: .9rem;
            padding: 1rem 1.2rem; border-radius: 14px;
            border: 1px solid transparent;
            animation: slideDown .28s ease;
            position: relative; overflow: hidden;
        }
        @keyframes slideDown { from { opacity:0; transform:translateY(-8px); } to { opacity:1; transform:translateY(0); } }
        .alert::before {
            content: ''; position: absolute; left: 0; top: 0; bottom: 0;
            width: 4px; border-radius: 14px 0 0 14px;
        }
        .alert-success { background: rgba(6,214,160,.08); border-color: rgba(6,214,160,.22); }
        .alert-success::before { background: var(--teal); }
        .alert-error   { background: rgba(239,68,68,.08);  border-color: rgba(239,68,68,.22); }
        .alert-error::before { background: #ef4444; }
        .alert-warning { background: rgba(245,158,11,.08); border-color: rgba(245,158,11,.22); }
        .alert-warning::before { background: #f59e0b; }
        .alert-info    { background: rgba(74,163,255,.08); border-color: rgba(74,163,255,.22); }
        .alert-info::before { background: var(--blue); }

        .alert-icon { font-size: 1.2rem; flex-shrink: 0; margin-top: .05rem; }
        .alert-body { flex: 1; min-width: 0; }
        .alert-title { font-size: .92rem; font-weight: 700; color: var(--text); margin-bottom: .1rem; }
        .alert-msg   { font-size: .87rem; color: var(--muted); line-height: 1.5; }
        .alert-close {
            background: none; border: none; cursor: pointer;
            color: var(--muted); font-size: 1.1rem; padding: 0;
            line-height: 1; flex-shrink: 0; transition: color .15s;
        }
        .alert-close:hover { color: #f8fbff; }
        
        /* ═══════════════ COMMON DASHBOARD COMPONENTS ═══════════════ */
        .feature-card {
            border-radius: 18px; padding: 1.3rem 1.4rem;
            border: 1px solid var(--border);
            background: rgba(255,255,255,.05);
            backdrop-filter: blur(14px);
        }
        /* Keep any legacy classes still used inside components */
        .h5 { font-size: 1.25rem; font-weight: 800; color: var(--text); margin-bottom:0.8rem;}
        .h6 { font-size: 1rem; font-weight: 700; color: var(--text); margin-bottom:0.5rem;}
        .btn-edt-primary {
            display: inline-flex; align-items: center; gap: .45rem;
            padding: .65rem 1.4rem; border-radius: 999px;
            background: linear-gradient(135deg, var(--blue2), #1a56c0); 
            color: #fff !important; font-weight: 700; border: none;
            box-shadow: 0 4px 12px rgba(33,118,255,.25);
            transition: all .25s ease;
        }
        .btn-edt-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(33,118,255,.4); color:#fff !important; filter: brightness(1.1); }

        .btn-edt-outline {
            display: inline-flex; align-items: center; gap: .45rem;
            padding: .6rem 1.3rem; border-radius: 999px;
            border: 1.5px solid rgba(255,255,255,.3); color: #fff !important;
            font-weight: 600; background: rgba(255,255,255,.05);
            transition: all .25s ease;
        }
        .btn-edt-outline:hover { background: rgba(255,255,255,.12); border-color: #fff; transform: translateY(-2px); color: #fff !important; }
        
        /* overrides for old styling inside app views */
        /* .text-secondary { color: var(--muted) !important; } */
        /* .text-dark, .text-black, .text-body { color: #f8fbff !important; } */
        /* .bg-white, .bg-light { background: transparent !important; } */
        .border, .border-bottom { border-color: var(--border) !important; }
        .shadow-sm { box-shadow: none !important; }
        .shadow { box-shadow: 0 10px 30px rgba(0,0,0,.2) !important; }

        .btn-theme-toggle {
            background: rgba(255,255,255,.05);
            border: 1px solid var(--border);
            border-radius: 10px;
            width: 38px; height: 38px;
            display: grid; place-items: center;
            cursor: pointer; color: var(--text);
            transition: all .2s;
        }
        .btn-theme-toggle:hover { background: rgba(74,163,255,.1); transform: scale(1.05); }
        .hidden { display: none !important; }
        
    </style>
</head>
<body>

<div class="app-layout">
    <!-- ▌SIDEBAR -->
    @include('layouts.sidebar')

    <!-- ▌MAIN -->
    <div class="main-wrap">

        <!-- TOPBAR -->
        <div class="topbar">
            <div class="topbar-header-slot">
                @isset($header)
                    {{ $header }}
                @else
                    <div class="topbar-title">Application</div>
                @endisset
            </div>
            
            <div class="topbar-right no-print">
                <button id="theme-toggle" class="btn-theme-toggle" title="Changer de mode">
                    <svg id="sun-icon" class="hidden" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                    <svg id="moon-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                </button>
                <div class="topbar-badge">
                    <span class="topbar-badge-dot"></span>
                    En ligne
                </div>
            </div>
        </div>

        <div class="main-content">
            {{-- ▌ALERTS FLASH --}}
            @include('components.flash-alerts')

            {{-- ▌PAGE CONTENT --}}
            {{ $slot }}
        </div>
    </div>
</div>

<script>
// --- Theme Management ---
const themeToggle = document.getElementById('theme-toggle');
const sunIcon = document.getElementById('sun-icon');
const moonIcon = document.getElementById('moon-icon');
const htmlEl = document.documentElement;

function applyTheme(theme) {
    if (theme === 'light') {
        htmlEl.classList.add('light-mode');
        sunIcon.classList.remove('hidden');
        moonIcon.classList.add('hidden');
    } else {
        htmlEl.classList.remove('light-mode');
        sunIcon.classList.add('hidden');
        moonIcon.classList.remove('hidden');
    }
}

// Initial theme
const savedTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark');
applyTheme(savedTheme);

themeToggle.addEventListener('click', () => {
    const isLight = htmlEl.classList.contains('light-mode');
    const newTheme = isLight ? 'dark' : 'light';
    localStorage.setItem('theme', newTheme);
    applyTheme(newTheme);
});

// --- Alert Management ---
function dismissAlert(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.style.transition = 'opacity .25s, transform .25s';
    el.style.opacity = '0';
    el.style.transform = 'translateY(-6px)';
    setTimeout(() => { el.remove(); }, 250);
}

document.addEventListener('DOMContentLoaded', () => {
    ['alert-success','alert-info'].forEach(id => {
        const el = document.getElementById(id);
        if (el) setTimeout(() => dismissAlert(id), 5000);
    });

    const pageTitle = document.querySelector('.topbar-title')?.textContent.trim()
        || document.querySelector('.crud-title')?.textContent.trim()
        || document.querySelector('h1')?.textContent.trim()
        || document.querySelector('h2')?.textContent.trim();

    if (pageTitle) {
        const appName = "{{ config('app.name', 'PolyTech') }}";
        document.title = `${pageTitle} | ${appName}`;
    }
});
</script>
</body>
</html>
