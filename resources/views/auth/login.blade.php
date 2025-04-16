@extends('layouts.auth')    

@section('title')
    Login
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Login</h4>
        </div>
        <div class="card-body">
            @if (session()->has('err'))
                <div class="alert alert-danger">
                    {{ session()->get('err') }}
                </div>
            @endif

            @if (session()->has('success'))
                <div class="alert alert-primary">
                    {{ session()->get('success') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('login.post') }}" class="needs-validation">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                        Email tidak boleh kosong
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Password</label>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                        Password tidak boleh kosong
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-5 text-muted text-center">
        Belum Mempunyai Akun? <a href="{{ route('register') }}">Daftar</a>
    </div>
@endsection