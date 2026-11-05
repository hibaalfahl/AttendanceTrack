
@extends('layouts.app')

@section('title', 'Users Management')

@section('content')

    <div class="page-heading heading-with-action">

        <div>
            <span class="eyebrow">BLOCK 01</span>

            <h1>Users Management</h1>

            <p>
                View and manage user accounts.
            </p>
        </div>

        @can('users.create')
            <a href="{{ route('users.create') }}"
               class="btn btn-primary">
                + Add User
            </a>
        @endcan

    </div>

    <div class="row g-3">

        @forelse ($users as $user)

            <div class="col-md-6 col-xl-4">

                <div class="user-card h-100">

                    <!-- Avatar and Status -->
                    <div class="user-card-top">

                        <div class="user-avatar">
                            {{ strtoupper(substr($user->full_name, 0, 1)) }}
                        </div>

                        <span class="status-pill {{ $user->status === 'active' ? 'status-active' : 'status-inactive' }}">

                            {{ ucfirst($user->status) }}

                        </span>

                    </div>


                    <!-- User Information -->
                    <h2 class="h5 mb-1">
                        {{ $user->full_name }}
                    </h2>

                    <div class="user-subtitle">
                        &#64;{{ $user->username }}
                    </div>

                    <div class="user-meta">

                        <span>Role</span>

                        <strong>
                            {{ $user->getRoleNames()->implode(', ') }}
                        </strong>

                    </div>

                    <div class="user-meta">

                        <span>Email</span>

                        <strong class="text-break">
                            {{ $user->email }}
                        </strong>

                    </div>


                    <!-- Actions -->
                    <div class="user-actions">

                        <a href="{{ route('users.show', $user) }}"
                           class="btn btn-light btn-sm">
                            Details
                        </a>

                        @can('users.update')

                            <a href="{{ route('users.edit', $user) }}"
                               class="btn btn-outline-primary btn-sm">
                                Edit
                            </a>

                        @endcan

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="page-card text-center py-5">

                    <h5>No Users Found</h5>

                    <p class="text-muted mb-0">
                        There are no users in the database.
                    </p>

                </div>

            </div>

        @endforelse

    </div>

@endsection
