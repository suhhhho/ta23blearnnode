@extends('partials.layout')

@section('content')
    @php($user = request()->user())

    <div class="max-w-5xl mx-auto py-10 space-y-6">
        <div class="flex items-center gap-4">
            <div class="avatar placeholder">
                <div class="bg-primary text-primary-content w-16 rounded-full">
                    {{ strtoupper(Str::substr($user->name, 0, 2)) }}
                </div>
            </div>
            <div>
                <p class="text-sm text-base-content/70">{{ __('Account center') }}</p>
                <h1 class="text-3xl font-bold">{{ __('Profile') }}</h1>
            </div>
        </div>

        @include('profile.partials.update-profile-information-form', ['user' => $user])
        @include('profile.partials.update-password-form', ['user' => $user])
        @include('profile.partials.delete-user-form', ['user' => $user])
    </div>
@endsection
