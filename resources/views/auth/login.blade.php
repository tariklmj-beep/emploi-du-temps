<x-guest-layout>
    <div class="auth-form-header">
        <h2>Connexion</h2>
        <p>Accedez a votre espace pour piloter votre planning.</p>
    </div>

    @if (session('status'))
        <div class="auth-alert auth-alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="auth-form-grid">
        @csrf

        <div>
            <label for="email" class="auth-label">Email</label>
            <input id="email" class="auth-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="auth-label">Mot de passe</label>
            <input id="password" class="auth-input" type="password" name="password" required autocomplete="current-password" />
            @error('password')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth-options-row">
            <label for="remember_me" class="auth-checkbox">
                <input id="remember_me" type="checkbox" name="remember">
                <span>Se souvenir de moi</span>
            </label>

            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">
                    Mot de passe oublie ?
                </a>
            @endif
        </div>

        <div class="auth-actions">
            <button type="submit" class="btn btn-edt-primary auth-submit">Se connecter</button>
            @if (Route::has('register'))
                <a class="auth-link" href="{{ route('register') }}">Creer un compte</a>
            @endif
        </div>
    </form>
</x-guest-layout>
