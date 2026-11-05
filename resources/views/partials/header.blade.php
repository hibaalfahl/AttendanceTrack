<header class="app-header">

    <div>
        <div class="header-eyebrow">
            Academic Workspace
        </div>

        <div class="header-title">
            @yield('title', 'Dashboard')
        </div>
    </div>

    <div class="header-actions">

        <div class="header-user">

            <strong>
                {{ auth()->user()->full_name }}
            </strong>

            <small>
                {{ auth()->user()->getRoleNames()->implode(', ') }}
            </small>

        </div>

        @if (Route::has('logout'))

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit"
                        class="btn btn-outline-secondary btn-sm">
                    Logout
                </button>
            </form>

        @endif

    </div>

</header>
