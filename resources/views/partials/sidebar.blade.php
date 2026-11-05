<aside class="app-sidebar" aria-label="Main navigation">

    <a class="sidebar-brand"
       href="{{ Route::has('dashboard') ? route('dashboard') : url('/') }}">

        <span class="brand-icon">AT</span>
        <span>AttendanceTrack</span>

    </a>

    <div class="sidebar-section-title">
        WORKSPACE
    </div>

    <nav class="sidebar-nav">

        @if (Route::has('dashboard'))

            <a href="{{ route('dashboard') }}"
               class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                Dashboard

            </a>

        @endif

        @php
            $modules = [
                [
                    'route' => 'users.index',
                    'prefix' => 'users.*',
                    'permission' => 'users.view',
                    'label' => 'Users Management',
                ],
                [
                    'route' => 'courses.index',
                    'prefix' => 'courses.*',
                    'permission' => 'courses.view',
                    'label' => 'Courses',
                ],
                [
                    'route' => 'students.index',
                    'prefix' => 'students.*',
                    'permission' => 'students.view',
                    'label' => 'Students & Sections',
                ],
                [
                    'route' => 'attendance.index',
                    'prefix' => 'attendance.*',
                    'permission' => 'attendance.view',
                    'label' => 'Attendance',
                ],
                [
                    'route' => 'exams.index',
                    'prefix' => 'exams.*',
                    'permission' => 'exams.view',
                    'label' => 'Exams & Grades',
                ],
            ];
        @endphp

        @foreach ($modules as $module)

            @if (
                Route::has($module['route']) &&
                auth()->user()->can($module['permission'])
            )

                <a href="{{ route($module['route']) }}"
                   class="sidebar-link {{ request()->routeIs($module['prefix']) ? 'active' : '' }}">

                    {{ $module['label'] }}

                </a>

            @endif

        @endforeach

    </nav>

    <div class="sidebar-bottom">
        Academic Management System
    </div>

</aside>
