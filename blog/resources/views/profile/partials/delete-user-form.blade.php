<section class="card bg-base-100 shadow-md">
    <div class="card-body space-y-6">
        <header>
            <h2 class="card-title text-error">{{ __('Delete account') }}</h2>
            <p class="text-sm text-base-content/70">
                {{ __('Once your account is deleted, all of its resources and data will be permanently removed.') }}
            </p>
        </header>

        <button type="button" class="btn btn-error btn-outline w-fit" onclick="document.getElementById('delete-user-modal').showModal()">
            {{ __('Delete account') }}
        </button>

        <dialog id="delete-user-modal" class="modal">
            <div class="modal-box space-y-4">
                <h3 class="font-bold text-lg">{{ __('Are you sure?') }}</h3>
                <p class="text-sm text-base-content/70">
                    {{ __('Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-4">
                    @csrf
                    @method('delete')

                    <div class="form-control">
                        <label for="password" class="label">
                            <span class="label-text font-semibold">{{ __('Password') }}</span>
                        </label>
                        <input id="password" name="password" type="password"
                               class="input input-bordered w-full" placeholder="••••••••" required>
                        @error('password')
                            <span class="text-error text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="modal-action">
                        <button type="button" class="btn btn-ghost" onclick="document.getElementById('delete-user-modal').close()">
                            {{ __('Cancel') }}
                        </button>
                        <button class="btn btn-error">{{ __('Delete account') }}</button>
                    </div>
                </form>
            </div>

            <form method="dialog" class="modal-backdrop">
                <button>{{ __('Close') }}</button>
            </form>
        </dialog>
    </div>
</section>
