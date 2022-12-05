@extends('layouts.auth')

@section('title', 'Login')

@push('inline_scripts')
    <script>
        $(function () {
            $('.toggle-password').click(function () {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $("#password-field");
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        });
    </script>
@endpush

@section('content')
<div class="login-box">
    <div class="login-logo">
        <h3>{{ config('app.name') }}</h3>
    </div>
    <p class="login-box-msg"></p>
    <form method="post" action="{{ url('login') }}">
        @csrf
        <div class="form-group mb-3">
            <input type="text"
                name="username"
                value="{{ old('username') }}"
                placeholder="Username"
                class="form-control @error('username') is-invalid @enderror">
            @error('username')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <input type="password"
                id="password-field"
                name="password"
                placeholder="Password"
                class="form-control @error('password') is-invalid @enderror">
            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            @error('password')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
        </div>
    </form>
</div>
@endsection