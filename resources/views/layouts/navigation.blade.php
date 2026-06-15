<nav class="app-navbar">
    <div class="navbar-content">
        <!-- Mobile Menu Toggle (optional) -->
        <div class="navbar-mobile-toggle">
            <button class="navbar-toggle-btn" onclick="document.querySelector('.app-sidebar').classList.toggle('sidebar-open')">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Navbar Spacer -->
        <div class="navbar-spacer"></div>

        <!-- User Dropdown -->
        <div class="navbar-user">
            <div class="navbar-user-info">
                @if (Auth::user()->profilePhotoUrl())
                    <img src="{{ Auth::user()->profilePhotoUrl() }}" alt="Avatar utilisateur" class="navbar-user-avatar" />
                @else
                    <div class="navbar-user-avatar navbar-user-avatar-fallback">{{ Auth::user()->avatarInitials() }}</div>
                @endif
                <span class="navbar-user-name">{{ Auth::user()->name }}</span>
            </div>
        </div>
    </div>
</nav>
