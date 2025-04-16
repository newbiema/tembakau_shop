@extends('layouts.auth')

@section('title')
    Daftar
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4>Daftar</h4>
    </div>
    <div class="card-body">
        @if (session()->has('err'))
            <div class="alert alert-danger">
                {{ session()->get('err') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('register.post') }}" class="needs-validation">
            @csrf
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input id="name" type="text" class="form-control" name="name" tabindex="1" required autofocus>
                <div class="text-danger">
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
            </div>

            <div class="form-group">
                <label for="email">Password</label>
                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
            </div>

            <div class="form-group">
                <label for="email">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" tabindex="2" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Daftar
                </button>
            </div>
        </form>
    </div>
</div>
<div class="mt-5 text-muted text-center">
    Sudah Mempunyai Akun? <a href="{{ route('login') }}">Login</a>
</div>
@endsection