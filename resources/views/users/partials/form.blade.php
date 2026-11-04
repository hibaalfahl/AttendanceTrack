@php
    $editing = isset($user);

    $selectedRole = old(
        'role',
        $editing
            ? (
                is_object($user) && method_exists($user, 'getRoleNames')
                    ? $user->getRoleNames()->first()
                    : data_get($user, 'role')
            )
            : 'employee'
    );
@endphp

<div class="row g-4">

    <!-- Full Name -->
    <div class="col-md-6">

        <label class="form-label" for="full_name">
            Full name <span class="required">*</span>
        </label>

        <input
            class="form-control @error('full_name') is-invalid @enderror"
            id="full_name"
            name="full_name"
            value="{{ old('full_name', data_get($user ?? null, 'full_name')) }}"
            maxlength="100"
            required
        >

        @error('full_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

    <!-- Username -->
    <div class="col-md-6">

        <label class="form-label" for="username">
            Username <span class="required">*</span>
        </label>

        <input
            class="form-control @error('username') is-invalid @enderror"
            id="username"
            name="username"
            value="{{ old('username', data_get($user ?? null, 'username')) }}"
            maxlength="50"
            required
        >

        @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

    <!-- Email -->
    <div class="col-md-6">

        <label class="form-label" for="email">
            Email <span class="required">*</span>
        </label>

        <input
            type="email"
            class="form-control @error('email') is-invalid @enderror"
            id="email"
            name="email"
            value="{{ old('email', data_get($user ?? null, 'email')) }}"
            required
        >

        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

    <!-- Phone -->
    <div class="col-md-6">

        <label class="form-label" for="phone">
            Phone <span class="required">*</span>
        </label>

        <input
            class="form-control @error('phone') is-invalid @enderror"
            id="phone"
            name="phone"
            value="{{ old('phone', data_get($user ?? null, 'phone')) }}"
            required
        >

        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

    <!-- Birth Date -->
    <div class="col-md-6">

        <label class="form-label" for="birth_date">
            Birth date <span class="required">*</span>
        </label>

        <input
            type="date"
            class="form-control @error('birth_date') is-invalid @enderror"
            id="birth_date"
            name="birth_date"
            value="{{ old('birth_date', $editing ? (is_object(data_get($user, 'birth_date')) ? data_get($user, 'birth_date')->format('Y-m-d') : data_get($user, 'birth_date')) : '') }}"
            required
        >

        @error('birth_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

    <!-- Department -->
    <div class="col-md-6">

        <label class="form-label" for="department_id">
            Department ID
            <span class="small text-muted">
                (optional for now)
            </span>
        </label>

        <input
            type="number"
            min="1"
            class="form-control @error('department_id') is-invalid @enderror"
            id="department_id"
            name="department_id"
            value="{{ old('department_id', data_get($user ?? null, 'department_id')) }}"
            placeholder="Will be connected to departments later"
        >

        @error('department_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

    <!-- Password -->
    <div class="col-md-6">

        <label class="form-label" for="password">
            Password

            @unless($editing)
                <span class="required">*</span>
            @endunless
        </label>

        <input
            type="password"
            class="form-control @error('password') is-invalid @enderror"
            id="password"
            name="password"
            autocomplete="new-password"
            @unless($editing) required @endunless
        >

        <div class="form-text">
            {{ $editing
                ? 'Leave blank to keep the current password.'
                : 'At least 8 characters, including a letter and a number.'
            }}
        </div>

        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

    <!-- Confirm Password -->
    <div class="col-md-6">

        <label class="form-label" for="password_confirmation">
            Confirm password

            @unless($editing)
                <span class="required">*</span>
            @endunless
        </label>

        <input
            type="password"
            class="form-control"
            id="password_confirmation"
            name="password_confirmation"
            autocomplete="new-password"
            @unless($editing) required @endunless
        >

    </div>

    <!-- Profile Photo -->
    <div class="col-md-6">

        <label class="form-label" for="photo">
            Profile photo
        </label>

        <input
            type="file"
            accept="image/png,image/jpeg"
            class="form-control @error('photo') is-invalid @enderror"
            id="photo"
            name="photo"
        >

        <div class="form-text">
            Optional JPG or PNG.
        </div>

        @error('photo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

    <!-- Role -->
    @can('roles.manage')

        <div class="col-md-6">

            <label class="form-label" for="role">
                Role
            </label>

            <select
                class="form-select @error('role') is-invalid @enderror"
                name="role"
                id="role"
            >

                <option value="employee"
                    @selected($selectedRole === 'employee')>
                    Employee
                </option>

                <option value="manager"
                    @selected($selectedRole === 'manager')>
                    Manager
                </option>

            </select>

            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

    @endcan

</div>

<div class="form-actions">

    <a href="{{ route('users.index') }}"
       class="btn btn-outline-secondary">
        Cancel
    </a>

    <button type="submit" class="btn btn-primary">
        {{ $editing ? 'Save Changes' : 'Create User' }}
    </button>

</div>
