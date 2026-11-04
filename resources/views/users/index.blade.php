@extends('layouts.app')

@section('title', 'Users Management')

@section('content')

    <div class="page-heading heading-with-action">

        <div>
            <span class="eyebrow">BLOCK 01</span>

            <h1>Users Management</h1>

            <p>
                Find, manage, and review user accounts.
            </p>
        </div>

        @can('users.create')

            @if (Route::has('users.create'))

                <a href="{{ route('users.create') }}"
                   class="btn btn-primary">
                    + Add User
                </a>

            @endif

        @endcan

    </div>

    <section class="page-card mb-4">

        <form action="{{ route('users.index') }}"
              method="GET"
              class="row g-3 align-items-end">

            <div class="col-lg-5">

                <label class="form-label" for="search">
                    Search users
                </label>

                <input
                    class="form-control"
                    type="search"
                    name="search"
                    id="search"
                    value="{{ request('search') }}"
                    placeholder="Name, username, or email"
                >

            </div>

            <div class="col-lg-3">

                <label class="form-label" for="role">
                    Role
                </label>

                <select class="form-select" name="role" id="role">

                    <option value="">All roles</option>

                    <option value="manager"
                        @selected(request('role') === 'manager')>
                        Manager
                    </option>

                    <option value="employee"
                        @selected(request('role') === 'employee')>
                        Employee
                    </option>

                </select>

            </div>

            <div class="col-lg-2">

                <label class="form-label" for="status">
                    Status
                </label>

                <select class="form-select" name="status" id="status">

                    <option value="">All statuses</option>

                    <option value="active"
                        @selected(request('status') === 'active')>
                        Active
                    </option>

                    <option value="inactive"
                        @selected(request('status') === 'inactive')>
                        Inactive
                    </option>

                </select>

            </div>

            <div class="col-lg-2 d-grid">

                <button class="btn btn-primary" type="submit">
                    Search
                </button>

            </div>

        </form>

    </section>

    <div class="row g-3">

        @forelse (($users ?? []) as $user)

            @php
                $userId = data_get($user, 'id');

                $roleName = is_object($user) &&
                    method_exists($user, 'getRoleNames')
                        ? $user->getRoleNames()->implode(', ')
                        : data_get($user, 'role', '—');

                $status = data_get($user, 'status', 'active');
            @endphp

            <div class="col-md-6 col-xl-4">

                <article class="user-card h-100">

                    <div class="user-card-top">

                        <div class="user-avatar">
                            {{ strtoupper(substr(data_get($user, 'full_name', 'U'), 0, 1)) }}
                        </div>

                        <span class="status-pill {{ $status === 'active' ? 'status-active' : 'status-inactive' }}">
                            {{ ucfirst($status) }}
                        </span>

                    </div>

                    <h2 class="h5 mb-1">
                        {{ data_get($user, 'full_name') }}
                    </h2>

                    <div class="user-subtitle">
                        &#64;{{ data_get($user, 'username') }}
                    </div>

                    <div class="user-meta">
                        <span>Role</span>
                        <strong>{{ $roleName }}</strong>
                    </div>

                    <div class="user-meta">
                        <span>Email</span>
                        <strong class="text-break">
                            {{ data_get($user, 'email') }}
                        </strong>
                    </div>

                    <div class="user-actions">

                        @if (Route::has('users.show'))

                            <a class="btn btn-light btn-sm"
                               href="{{ route('users.show', $userId) }}">
                                Details
                            </a>

                        @endif

                        @can('users.update')

                            @if (Route::has('users.edit'))

                                <a class="btn btn-outline-primary btn-sm"
                                   href="{{ route('users.edit', $userId) }}">
                                    Edit
                                </a>

                            @endif

                        @endcan

                    </div>

                </article>

            </div>

        @empty

            <div class="col-12">

                <div class="page-card text-center text-muted py-5">
                    No users to display yet.
                </div>

            </div>

        @endforelse

    </div>

@endsection
