@php($user ??= request()->user())

<section class="card bg-base-100 shadow-md">
    <div class="card-body space-y-6">
        <header class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <h2 class="card-title">{{ __('Profile details') }}</h2>
                <p class="text-sm text-base-content/70">
                    {{ __('Keep your personal information up to date.') }}
                </p>
            </div>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning text-sm max-w-xs">
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification" class="btn btn-xs btn-outline">
                        {{ __('Resend') }}
                    </button>
                </div>

                <form id="send-verification" method="POST" action="{{ route('verification.send') }}" class="hidden">
                    @csrf
                </form>
            @endif

            @if (session('status') === 'verification-link-sent')
                <div class="alert alert-success text-sm">
                    {{ __('A verification link has been sent to your email address.') }}
                </div>
            @endif

            @if (session('status') === 'profile-updated')
                <div class="alert alert-success text-sm">
                    {{ __('Your profile has been updated.') }}
                </div>
            @endif
        </header>

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
            @csrf
            @method('patch')

            <div class="form-control">
                <label for="name" class="label">
                    <span class="label-text font-semibold">{{ __('Name') }}</span>
                </label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
                       class="input input-bordered w-full" required autocomplete="name">
                @error('name')
                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-control">
                <label for="email" class="label">
                    <span class="label-text font-semibold">{{ __('Email') }}</span>
                </label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}"
                       class="input input-bordered w-full" required autocomplete="username">
                @error('email')
                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <button class="btn btn-primary">{{ __('Save changes') }}</button>

                @if (session('status') === 'profile-updated')
                    <span class="text-success text-sm">{{ __('Saved.') }}</span>
                @endif
            </div>
        </form>
    </div>
</section>
