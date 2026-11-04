@extends('layouts.guest')

@section('title', 'Sign In')

@section('content')

    <div class="auth-eyebrow mb-3">
        WELCOME TO ATTENDANCETRACK
    </div>

    <h2 class="auth-title">
        Welcome back
    </h2>

    <p class="auth-description mb-4">
        Enter your credentials to access your academic workspace.
    </p>

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf

        <div class="mb-4">

            <label for="username" class="form-label">
                Username
            </label>

            <input
                id="username"
                name="username"
                type="text"
                class="form-control @error('username') is-invalid @enderror"
                value="{{ old('username') }}"
                placeholder="Enter your username"
                autocomplete="username"
                maxlength="50"
                required
                autofocus
            >

        </div>

        <div class="mb-4">

            <label for="password" class="form-label">
                Password
            </label>

            <div class="password-wrapper">

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Enter your password"
                    autocomplete="current-password"
                    required
                >

                <button
                    id="togglePassword"
                    type="button"
                    class="password-toggle"
                    aria-label="Show password"
                    aria-pressed="false"
                >
                    Show
                </button>

            </div>

        </div>

        <button type="submit" class="btn btn-primary w-100 py-3">
            Sign in
        </button>

    </form>

    <p class="auth-description text-center mt-4 mb-0">
        Secure access to your academic workspace
    </p>

@endsection

@push('scripts')

<script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    toggle.addEventListener('click', () => {
        const showing = password.type === 'password';

        password.type = showing ? 'text' : 'password';
        toggle.textContent = showing ? 'Hide' : 'Show';

        toggle.setAttribute(
            'aria-label',
            showing ? 'Hide password' : 'Show password'
        );

        toggle.setAttribute('aria-pressed', String(showing));
    });
</script>

@endpush
