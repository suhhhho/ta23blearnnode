@extends('partials.layout')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-base-200 px-4 py-10">
        <div class="card w-full max-w-md bg-base-100 shadow-xl">
            <div class="card-body space-y-6">
                <div>
                    <h1 class="card-title">{{ __('Confirm password') }}</h1>
                    <p class="text-sm text-base-content/70">
                        {{ __('Please confirm your password before continuing.') }}
                    </p>
                </div>

                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
                    @csrf

                    <div class="form-control">
                        <label for="password" class="label">
                            <span class="label-text font-semibold">{{ __('Password') }}</span>
                        </label>
                        <input id="password" name="password" type="password"
                               class="input input-bordered w-full" required autocomplete="current-password">
                        @error('password')
                            <span class="text-error text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-primary w-full">{{ __('Confirm') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
