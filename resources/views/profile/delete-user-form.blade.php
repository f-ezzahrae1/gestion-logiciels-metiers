<section>
    <header>
        <h2 class="profile-section-title">
            {{ __('Supprimer le Compte') }}
        </h2>

        <p class="text-sm text-gray-600">
            {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Veuillez entrer votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="danger-button"
    >{{ __('Supprimer le Compte') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="profile-form p-6">
            @csrf
            @method('delete')

            <h2 class="profile-section-title">
                {{ __('Êtes-vous sûr de vouloir supprimer votre compte ?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Veuillez entrer votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.') }}
            </p>

            <div class="form-group">
                <label for="password" class="sr-only">Mot de passe</label>
                <input id="password" name="password" type="password" placeholder="{{ __('Mot de passe') }}" />
                @error('password', 'userDeletion')
                    <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <button type="button" x-on:click="$dispatch('close')" class="secondary-button me-2">
                    {{ __('Annuler') }}
                </button>

                <button type="submit" class="danger-button">
                    {{ __('Supprimer le Compte') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>