<!-- Variables Setup -->
@php
    $user = Auth::user();
    $isAdmin = $user?->isAdmin() ?? false;
    $isProfesseur = $user?->isProfesseur() ?? false;
    $isEtudiant = $user?->isEtudiant() ?? false;
    $canViewDashboard = $isAdmin || $isProfesseur;
    $homeLink = $canViewDashboard ? route('dashboard') : route('emplois-du-temps.index');
@endphp

<aside class="sidebar">
    <a href="{{ url('/') }}" class="sidebar-brand">
        <img src="{{ asset('images/logo.png') }}" alt="EPG Logo" class="sidebar-brand-img" style="height: 50px; width: auto; object-fit: contain;">
        <div class="sidebar-brand-text">
            <div class="sidebar-brand-name">EPG</div>
            <div class="sidebar-brand-sub">Ecole Polytechnique Des Génies</div>
        </div>
    </a>

    {{-- NAVIGATION --}}
    <div class="sidebar-section">
        <div class="sidebar-section-label">Général</div>
        @if ($canViewDashboard)
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard', 'admin.dashboard') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                Dashboard
                @if(request()->routeIs('dashboard', 'admin.dashboard'))<span class="sidebar-link-dot"></span>@endif
            </a>
        @endif
        
        <a href="{{ route('emplois-du-temps.index') }}" class="sidebar-link {{ request()->routeIs('emplois-du-temps.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Emplois du temps
            @if(request()->routeIs('emplois-du-temps.*'))<span class="sidebar-link-dot"></span>@endif
        </a>
    </div>

    @if($isAdmin)
    <div class="sidebar-section">
        <div class="sidebar-section-label">Administration</div>
        <a href="{{ route('filieres.index') }}" class="sidebar-link {{ request()->routeIs('filieres.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
            Filières
            @if(request()->routeIs('filieres.*'))<span class="sidebar-link-dot"></span>@endif
        </a>
        <a href="{{ route('matieres.index') }}" class="sidebar-link {{ request()->routeIs('matieres.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>
            Matières
            @if(request()->routeIs('matieres.*'))<span class="sidebar-link-dot"></span>@endif
        </a>
        <a href="{{ route('enseignants.index') }}" class="sidebar-link {{ request()->routeIs('enseignants.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Enseignants
            @if(request()->routeIs('enseignants.*'))<span class="sidebar-link-dot"></span>@endif
        </a>
        <a href="{{ route('etudiants.index') }}" class="sidebar-link {{ request()->routeIs('etudiants.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
            Étudiants
            @if(request()->routeIs('etudiants.*'))<span class="sidebar-link-dot"></span>@endif
        </a>
        <a href="{{ route('classes.index') }}" class="sidebar-link {{ request()->routeIs('classes.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
            Classes
            @if(request()->routeIs('classes.*'))<span class="sidebar-link-dot"></span>@endif
        </a>
        <a href="{{ route('salles.index') }}" class="sidebar-link {{ request()->routeIs('salles.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            Salles
            @if(request()->routeIs('salles.*'))<span class="sidebar-link-dot"></span>@endif
        </a>
    </div>
    @endif

    @if($isAdmin || $isProfesseur)
    <div class="sidebar-section">
        <div class="sidebar-section-label">Académique</div>
        <a href="{{ route('notes.index') }}" class="sidebar-link {{ request()->routeIs('notes.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            Notes
            @if(request()->routeIs('notes.*'))<span class="sidebar-link-dot"></span>@endif
        </a>
        <a href="{{ route('absences.index') }}" class="sidebar-link {{ request()->routeIs('absences.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
            Absences
            @if(request()->routeIs('absences.*'))<span class="sidebar-link-dot"></span>@endif
        </a>
    </div>
    @endif

    <div class="sidebar-section">
        <div class="sidebar-section-label">Mon compte</div>
        <a href="{{ route('profile.edit') }}" class="sidebar-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Mon profil
            @if(request()->routeIs('profile.*'))<span class="sidebar-link-dot"></span>@endif
        </a>
    </div>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            @php $photoUrl = $user?->profilePhotoUrl(); @endphp
            @if($photoUrl)
                <img src="{{ $photoUrl }}" class="sidebar-avatar" style="object-fit: cover;" onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                <div class="sidebar-avatar hidden">{{ $user?->avatarInitials() ?? 'U' }}</div>
            @else
                <div class="sidebar-avatar">{{ $user?->avatarInitials() ?? 'U' }}</div>
            @endif
            <div class="sidebar-user-details" style="min-width: 0;">
                <div class="sidebar-user-name" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $user?->name }}</div>
                <div class="sidebar-user-email" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $user?->email }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sidebar-logout">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Déconnexion
            </button>
        </form>
    </div>
</aside>
