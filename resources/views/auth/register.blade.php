<x-guest-layout>
    <div class="auth-form-header">
        <h2>Creation de compte</h2>
        <p>Renseignez vos informations pour acceder a la plateforme.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="auth-form-grid">
        @csrf

        <div>
            <label for="name" class="auth-label">Nom complet</label>
            <input id="name" class="auth-input" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
            @error('name')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="auth-label">Email</label>
            <input id="email" class="auth-input" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="auth-label">Mot de passe</label>
            <input id="password" class="auth-input" type="password" name="password" required autocomplete="new-password" />
            @error('password')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="auth-label">Confirmation mot de passe</label>
            <input id="password_confirmation" class="auth-input" type="password" name="password_confirmation" required autocomplete="new-password" />
            @error('password_confirmation')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth-actions">
            <button type="submit" class="btn btn-edt-primary auth-submit">Creer le compte</button>
            <a class="auth-link" href="{{ route('login') }}">Deja inscrit ? Se connecter</a>
        </div>
    </form>
</x-guest-layout>
