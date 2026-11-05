
@php
    $editing = isset($user);

    $selectedRole = old(
        'role',
        $editing ? $user->getRoleNames()->first() : 'employee'
    );
@endphp

<div class="row g-4">

    <!-- Full Name -->
    <div class="col-md-6">
        <label for="full_name" class="form-label">
            Full Name <span class="required">*</span>
        </label>

        <input
            type="text"
            name="full_name"
            id="full_name"
            class="form-control @error('full_name') is-invalid @enderror"
            value="{{ old('full_name', $editing ? $user->full_name : '') }}"
            required
        >

        @error('full_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Username -->
    <div class="col-md-6">
        <label for="username" class="form-label">
            Username <span class="required">*</span>
        </label>

        <input
            type="text"
            name="username"
            id="username"
            class="form-control @error('username') is-invalid @enderror"
            value="{{ old('username', $editing ? $user->username : '') }}"
            required
        >

        @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email -->
    <div class="col-md-6">
        <label for="email" class="form-label">
            Email <span class="required">*</span>
        </label>

        <input
            type="email"
            name="email"
            id="email"
            class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email', $editing ? $user->email : '') }}"
            required
        >

        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Phone -->
    <div class="col-md-6">
        <label for="phone" class="form-label">
            Phone <span class="required">*</span>
        </label>

        <input
            type="text"
            name="phone"
            id="phone"
            class="form-control @error('phone') is-invalid @enderror"
            value="{{ old('phone', $editing ? $user->phone : '') }}"
            required
        >

        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Birth Date -->
    <div class="col-md-6">
        <label for="birth_date" class="form-label">
            Birth Date <span class="required">*</span>
        </label>

        <input
            type="date"
            name="birth_date"
            id="birth_date"
            class="form-control @error('birth_date') is-invalid @enderror"
            value="{{ old('birth_date', $editing ? $user->birth_date?->format('Y-m-d') : '') }}"
            required
        >

        @error('birth_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Department ID -->
    <div class="col-md-6">
        <label for="department_id" class="form-label">
            Department ID
        </label>

        <input
            type="number"
            min="1"
            name="department_id"
            id="department_id"
            class="form-control @error('department_id') is-invalid @enderror"
            value="{{ old('department_id', $editing ? $user->department_id : '') }}"
        >

        @error('department_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Password -->
    <div class="col-md-6">
        <label for="password" class="form-label">
            Password

            @unless($editing)
                <span class="required">*</span>
            @endunless
        </label>

        <input
            type="password"
            name="password"
            id="password"
            class="form-control @error('password') is-invalid @enderror"
            autocomplete="new-password"
            @unless($editing) required @endunless
        >

        @if($editing)
            <div class="form-text">
                Leave blank to keep the current password.
            </div>
        @endif

        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div class="col-md-6">
        <label for="password_confirmation" class="form-label">
            Confirm Password

            @unless($editing)
                <span class="required">*</span>
            @endunless
        </label>

        <input
            type="password"
            name="password_confirmation"
            id="password_confirmation"
            class="form-control"
            autocomplete="new-password"
            @unless($editing) required @endunless
        >
    </div>

    <!-- Profile Photo -->
    <div class="col-md-6">
        <label for="photo" class="form-label">
            Profile Photo
        </label>

        <input
            type="file"
            name="photo"
            id="photo"
            accept=".jpg,.jpeg,.png"
            class="form-control @error('photo') is-invalid @enderror"
        >

        @error('photo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Role -->
    @can('roles.manage')

        <div class="col-md-6">
            <label for="role" class="form-label">
                Role
            </label>

            {{-- Task 1: Roles were hardcoded in the form. --}}

            <!-- Task 2: Roles from database -->
            <select
                name="role"
                id="role"
                class="form-select @error('role') is-invalid @enderror"
            >

                @foreach($roles as $role)

                    <option
                        value="{{ $role->name }}"
                        @selected($selectedRole === $role->name)
                    >
                        {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                    </option>

                @endforeach

            </select>

            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    @endcan

</div>

<!-- Form Actions -->
<div class="form-actions">

    <a href="{{ route('users.index') }}"
       class="btn btn-outline-secondary">
        Cancel
    </a>

    <button type="submit" class="btn btn-primary">
        {{ $editing ? 'Update User' : 'Create User' }}
    </button>

</div>
