<section>
    <header>
        <h2 class="text-lg font-medium text-slate-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-slate-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="profile_photo" :value="__('Photo de profil')" />

            <div class="mt-2 rounded-2xl border border-white/10 bg-white/5 p-4 shadow-sm backdrop-blur-sm">
                <label for="profile_photo" class="group flex items-center gap-4 cursor-pointer rounded-xl border border-dashed border-white/20 bg-white/5 p-3 transition hover:border-blue-400/50 hover:bg-white/10">
                    <div class="relative">
                        @php
                            $photoUrl = $user->profilePhotoUrl();
                        @endphp

                        @if ($photoUrl)
                            <img id="profile-photo-preview"
                                 src="{{ $photoUrl }}"
                                 alt="Avatar utilisateur"
                                 class="h-10 w-10 rounded-full object-cover ring-2 ring-white/20 shadow-md"
                                 onerror="this.style.display='none'; document.getElementById('profile-photo-fallback').classList.remove('hidden'); document.getElementById('profile-photo-fallback').classList.add('flex');"
                            />
                            <div id="profile-photo-fallback" class="hidden h-10 w-10 rounded-full bg-white/10 items-center justify-center text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.1a7.5 7.5 0 0 1 15 0" />
                                </svg>
                            </div>
                        @else
                            <img id="profile-photo-preview" src="" alt="Avatar utilisateur" class="hidden h-10 w-10 rounded-full object-cover ring-2 ring-white/20 shadow-md" />
                            <div id="profile-photo-fallback" class="flex h-10 w-10 rounded-full bg-white/10 items-center justify-center text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.1a7.5 7.5 0 0 1 15 0" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-slate-100">Cliquez pour uploader l'image</p>
                        <p class="text-xs text-slate-400">Format: JPG, PNG, WEBP (max 2 Mo)</p>
                    </div>
                </label>

                <input
                    id="profile_photo"
                    name="profile_photo"
                    type="file"
                    accept="image/*"
                    onchange="previewProfileSticker(this)"
                    class="sr-only"
                />
            </div>

            <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
    function previewProfileSticker(input) {
        const file = input.files && input.files[0];
        if (!file) {
            return;
        }

        const preview = document.getElementById('profile-photo-preview');
        const fallback = document.getElementById('profile-photo-fallback');
        if (!preview) {
            return;
        }

        const reader = new FileReader();
        reader.onload = function (event) {
            preview.src = event.target?.result || '';
            preview.classList.remove('hidden');
            if (fallback) {
                fallback.classList.add('hidden');
                fallback.classList.remove('flex');
            }
        };
        reader.readAsDataURL(file);
    }
</script>
