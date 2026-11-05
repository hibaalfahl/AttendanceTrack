<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>

<body class="app-page">
    <div class="app-shell">

        @include('partials.sidebar')

        <div class="app-main">

            @include('partials.header')

            <main class="app-content">
                @include('partials.alerts')

                @yield('content')
            </main>

        </div>
    </div>

    @stack('scripts')
</body>
</html>
