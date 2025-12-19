<section>
    <header>
        <h2 class="profile-section-title">
            {{ __('Mettre à jour le Mot de Passe') }}
        </h2>

        <p class="text-sm text-gray-600">
            {{ __('Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="profile-form">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="current_password">Mot de passe actuel</label>
            <input id="current_password" name="current_password" type="password" autocomplete="current-password" />
            @error('current_password')
                <p class="text-sm text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Nouveau mot de passe</label>
            <input id="password" name="password" type="password" autocomplete="new-password" />
            @error('password')
                <p class="text-sm text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" />
            @error('password_confirmation')
                <p class="text-sm text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">{{ __('Sauvegarder') }}</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Sauvegardé.') }}</p>
            @endif
        </div>
    </form>
</section>