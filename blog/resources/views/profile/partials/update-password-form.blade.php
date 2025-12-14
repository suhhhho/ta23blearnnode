<section class="card bg-base-100 shadow-md">
    <div class="card-body space-y-6">
        <header class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <h2 class="card-title">{{ __('Update password') }}</h2>
                <p class="text-sm text-base-content/70">
                    {{ __('Use a long, random password to stay secure.') }}
                </p>
            </div>

            @if ($errors->updatePassword?->has('current_password'))
                <div class="alert alert-error text-sm">
                    {{ $errors->updatePassword->first('current_password') }}
                </div>
            @endif

            @if (session('status') === 'password-updated')
                <div class="alert alert-success text-sm">
                    {{ __('Your password has been updated.') }}
                </div>
            @endif
        </header>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
            @csrf
            @method('put')

            <div class="form-control">
                <label for="current_password" class="label">
                    <span class="label-text font-semibold">{{ __('Current password') }}</span>
                </label>
                <input id="current_password" name="current_password" type="password"
                       class="input input-bordered w-full" autocomplete="current-password">
                @error('current_password', 'updatePassword')
                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <div class="form-control">
                    <label for="password" class="label">
                        <span class="label-text font-semibold">{{ __('New password') }}</span>
                    </label>
                    <input id="password" name="password" type="password"
                           class="input input-bordered w-full" autocomplete="new-password">
                    @error('password', 'updatePassword')
                        <span class="text-error text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control">
                    <label for="password_confirmation" class="label">
                        <span class="label-text font-semibold">{{ __('Confirm password') }}</span>
                    </label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                           class="input input-bordered w-full" autocomplete="new-password">
                @error('password_confirmation', 'updatePassword')
                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                @enderror
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button class="btn btn-primary">{{ __('Save password') }}</button>

                @if (session('status') === 'password-updated')
                    <span class="text-success text-sm">{{ __('Saved.') }}</span>
                @endif
            </div>
        </form>
    </div>
</section>
