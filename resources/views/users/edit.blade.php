@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

    <div class="page-heading">

        <div>
            <span class="eyebrow">USERS MANAGEMENT</span>

            <h1>Edit User</h1>

            <p>
                Update user account information.
            </p>
        </div>

    </div>

    <div class="page-card">

        <form method="POST"
              action="{{ route('users.update', data_get($user, 'id')) }}"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            @include('users.partials.form')

        </form>

    </div>

@endsection
