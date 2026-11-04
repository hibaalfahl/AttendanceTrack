<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>

<body class="auth-page">

    <div class="auth-shell">

        <aside class="auth-brand"
               aria-label="AttendanceTrack introduction">

            <div class="brand-name">
                <span class="brand-icon">AT</span>
                <span>AttendanceTrack</span>
            </div>

            <div class="brand-copy">

                <div class="brand-eyebrow">
                    ACADEMIC MANAGEMENT
                </div>

                <h1>
                    A smarter way to manage your campus.
                </h1>

                <p>
                    One place for lectures, attendance,
                    students, and academic records.
                </p>

                <div class="brand-feature">
                    <span class="feature-dot">✓</span>
                    Lecture Management
                </div>

                <div class="brand-feature">
                    <span class="feature-dot">✓</span>
                    Attendance Tracking
                </div>

                <div class="brand-feature">
                    <span class="feature-dot">✓</span>
                    Exams &amp; Grades
                </div>

            </div>

            <small class="brand-footer">
                AttendanceTrack · Academic Management System
            </small>

        </aside>

        <main class="auth-panel">
            @include('partials.alerts')

            @yield('content')
        </main>

    </div>

    @stack('scripts')
</body>
</html>
