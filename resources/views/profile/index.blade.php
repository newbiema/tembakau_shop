@extends('layouts.app')

@section('title')
    Profile
@endsection

@push('js')
   
@endpush    

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-primary">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <b>Edit Profile</b>
        </div>
        <div class="card-body">
            <form action="{{ route('updateProfile', ['id' => Auth::user()->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label for="" class="mb-2">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label for="" class="mb-2">Email</label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}" id="email" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    @role('User')
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="" class="mb-2">No Telephone</label>
                                <input type="text" name="telp" value="{{ Auth::user()->telp }}" id="telp" class="form-control @error('telp') is-invalid @enderror">
                                @error('telp')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="" class="mb-2">Alamat</label>
                                <input type="text" name="alamat" value="{{ Auth::user()->alamat }}" id="alamat" class="form-control @error('alamat') is-invalid @enderror">
                                @error('alamat')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    @endrole
                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label for="" class="mb-2">Foto</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary float-right">Ubah Profile</button>
            </form>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <b>Reset Password</b>
        </div>
        <div class="card-body">
            <form action="{{ route('resetPassword', ['id' => Auth::user()->id]) }}" method="POST">
                @csrf
                @method("PUT")
                <div class="form-group mb-3">
                    <label for="" class="mb-2">Password Baru</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="" class="mb-2">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary float-right">Ubah Password</button>
            </form>
        </div>
    </div>
@endsection

@push('js')
    
@endpush