@if(session()->has('success') || session()->has('error') || session()->has('warning') || session()->has('info') || $errors->any() || session('status'))
<div class="alert-stack" id="alertStack">
    @if(session('success') || session('status'))
    <div class="alert alert-success" role="alert" id="alert-success">
        <span class="alert-icon">✅</span>
        <div class="alert-body">
            <div class="alert-title">Succès</div>
            <div class="alert-msg">{{ session('success') ?? session('status') }}</div>
        </div>
        <button class="alert-close" onclick="dismissAlert('alert-success')" aria-label="Fermer">✕</button>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-error" role="alert" id="alert-error">
        <span class="alert-icon">❌</span>
        <div class="alert-body">
            <div class="alert-title">Erreur</div>
            <div class="alert-msg">{{ session('error') }}</div>
        </div>
        <button class="alert-close" onclick="dismissAlert('alert-error')" aria-label="Fermer">✕</button>
    </div>
    @endif
    @if(session('warning'))
    <div class="alert alert-warning" role="alert" id="alert-warning">
        <span class="alert-icon">⚠️</span>
        <div class="alert-body">
            <div class="alert-title">Attention</div>
            <div class="alert-msg">{{ session('warning') }}</div>
        </div>
        <button class="alert-close" onclick="dismissAlert('alert-warning')" aria-label="Fermer">✕</button>
    </div>
    @endif
    @if(session('info'))
    <div class="alert alert-info" role="alert" id="alert-info">
        <span class="alert-icon">ℹ️</span>
        <div class="alert-body">
            <div class="alert-title">Information</div>
            <div class="alert-msg">{{ session('info') }}</div>
        </div>
        <button class="alert-close" onclick="dismissAlert('alert-info')" aria-label="Fermer">✕</button>
    </div>
    @endif
    @if($errors->any())
    <div class="alert alert-error" role="alert" id="alert-validation">
        <span class="alert-icon">❌</span>
        <div class="alert-body">
            <div class="alert-title">Erreurs de validation</div>
            <div class="alert-msg">
                @foreach($errors->all() as $e)<div>• {{ $e }}</div>@endforeach
            </div>
        </div>
        <button class="alert-close" onclick="dismissAlert('alert-validation')" aria-label="Fermer">✕</button>
    </div>
    @endif
</div>
@endif
