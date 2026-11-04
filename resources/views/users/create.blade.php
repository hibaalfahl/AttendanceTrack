@extends('layouts.app')

@section('title', 'Add User')

@section('content')

    <div class="page-heading">

        <div>
            <span class="eyebrow">USERS MANAGEMENT</span>

            <h1>Add New User</h1>

            <p>
                Create a new user account.
            </p>
        </div>

    </div>

    <div class="page-card">

        <form method="POST"
              action="{{ route('users.store') }}"
              enctype="multipart/form-data">

            @csrf

            @include('users.partials.form')

        </form>

    </div>

@endsection
