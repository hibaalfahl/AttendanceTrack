@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="page-heading">
        <div>

            <span class="eyebrow">
                YOUR WORKSPACE
            </span>

            <h1>
                Welcome back, {{ auth()->user()->full_name }}!
            </h1>

            <p>
                Manage your academic tasks from one place.
            </p>

        </div>
    </div>

    <div class="row g-4">

        <div class="col-lg-7">

            <section class="page-card h-100">

                <div class="section-icon">AT</div>

                <h2 class="h5 mt-3">
                    Users Management
                </h2>

                <p class="text-muted">
                    Manage users, roles, and permissions
                    in AttendanceTrack.
                </p>

                @if (
                    Route::has('users.index') &&
                    auth()->user()->can('users.view')
                )

                    <a href="{{ route('users.index') }}"
                       class="btn btn-primary">
                        Open Users
                    </a>

                @else

                    <span class="small text-muted">
                        This module will be available after
                        the CRUD routes are added.
                    </span>

                @endif

            </section>

        </div>

        <div class="col-lg-5">

            <section class="page-card h-100">

                <h2 class="h5 mb-3">
                    My Account
                </h2>

                <dl class="detail-grid">

                    <div>
                        <dt>Full name</dt>
                        <dd>{{ auth()->user()->full_name }}</dd>
                    </div>

                    <div>
                        <dt>Username</dt>
                        <dd>{{ auth()->user()->username }}</dd>
                    </div>

                    <div>
                        <dt>Role</dt>
                        <dd>
                            {{ auth()->user()->getRoleNames()->implode(', ') }}
                        </dd>
                    </div>

                    <div>
                        <dt>Status</dt>
                        <dd>
                            <span class="status-pill status-active">
                                {{ ucfirst(auth()->user()->status) }}
                            </span>
                        </dd>
                    </div>

                </dl>

            </section>

        </div>

    </div>

@endsection
