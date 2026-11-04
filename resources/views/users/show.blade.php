@extends('layouts.app')

@section('title', 'User Details')

@section('content')

    @php
        $userId = data_get($user, 'id');
        $userStatus = data_get($user, 'status', 'active');

        $userRole = is_object($user) &&
            method_exists($user, 'getRoleNames')
                ? $user->getRoleNames()->implode(', ')
                : data_get($user, 'role', '—');

        $birthday = data_get($user, 'birth_date');

        $birthday = is_object($birthday) &&
            method_exists($birthday, 'format')
                ? $birthday->format('Y-m-d')
                : $birthday;
    @endphp

    <div class="page-heading heading-with-action">

        <div>
            <span class="eyebrow">USERS MANAGEMENT</span>

            <h1>User Details</h1>

            <p>
                Review the account and its assigned role.
            </p>
        </div>

        <a href="{{ route('users.index') }}"
           class="btn btn-outline-secondary">
            Back to Users
        </a>

    </div>

    <section class="page-card">

        <div class="profile-heading">

            <div class="user-avatar user-avatar-large">
                {{ strtoupper(substr(data_get($user, 'full_name', 'U'), 0, 1)) }}
            </div>

            <div class="flex-grow-1">

                <h2 class="h4 mb-1">
                    {{ data_get($user, 'full_name') }}
                </h2>

                <div class="text-muted">
                    &#64;{{ data_get($user, 'username') }}
                </div>

            </div>

            <span class="status-pill {{ $userStatus === 'active' ? 'status-active' : 'status-inactive' }}">
                {{ ucfirst($userStatus) }}
            </span>

        </div>

        <dl class="detail-grid detail-grid-wide">

            <div>
                <dt>Email</dt>
                <dd>{{ data_get($user, 'email') }}</dd>
            </div>

            <div>
                <dt>Phone</dt>
                <dd>{{ data_get($user, 'phone') }}</dd>
            </div>

            <div>
                <dt>Role</dt>
                <dd>{{ $userRole }}</dd>
            </div>

            <div>
                <dt>Department ID</dt>
                <dd>
                    {{ data_get($user, 'department_id') ?? 'Not assigned' }}
                </dd>
            </div>

            <div>
                <dt>Birth date</dt>
                <dd>{{ $birthday ?: '—' }}</dd>
            </div>

            <div>
                <dt>Created at</dt>
                <dd>{{ data_get($user, 'created_at') ?: '—' }}</dd>
            </div>

        </dl>

        <div class="form-actions flex-wrap">

            @can('users.update')

                @if (Route::has('users.edit'))

                    <a href="{{ route('users.edit', $userId) }}"
                       class="btn btn-primary">
                        Edit User
                    </a>

                @endif

            @endcan

            @can('users.change-status')

                @if (Route::has('users.change-status'))

                    <form action="{{ route('users.change-status', $userId) }}"
                          method="POST">

                        @csrf
                        @method('PATCH')

                        <button class="btn btn-outline-secondary"
                                type="submit">

                            {{ $userStatus === 'active' ? 'Deactivate' : 'Activate' }}

                        </button>

                    </form>

                @endif

            @endcan

            @can('users.delete')

                @if (Route::has('users.destroy'))

                    <form action="{{ route('users.destroy', $userId) }}"
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this user?')">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-outline-danger"
                                type="submit">
                            Delete User
                        </button>

                    </form>

                @endif

            @endcan

        </div>

    </section>

@endsection
