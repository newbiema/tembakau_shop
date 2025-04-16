@extends('layouts.app')

@section('title')
    Tambah Produk
@endsection

@section('content')
<h2 class="section-title">Tambah Produk</h2>

<div class="d-flex justify-content-between mb-4">
    <div>
        <a href="{{ route('admin.product') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-2"></i> Kembali</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label for="" class="mb-2">Nama Tembakau</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label for="" class="mb-2">Umur Tembakau</label>
                        <input type="text" name="umur" id="umur" class="form-control @error('umur') is-invalid @enderror">
                        @error('umur')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label for="" class="mb-2">Jumlah Tembakau Per Hari</label>
                        <input type="text" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror">
                        @error('jumlah')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label for="" class="mb-2">Stock Tembakau</label>
                        <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror">
                        @error('stock')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group mb-3">
                        <label for="" class="mb-2">Harga Tembakau</label>
                        <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror">
                        @error('harga')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group mb-3">
                        <label for="" class="mb-2">Deskripsi Tembakau</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror"></textarea>
                        @error('description')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group mb-3">
                        <label for="" class="mb-2">Foto Tembakau</label>
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary float-right">Tambah</button>
            </div>
        </form>
    </div>
</div>
@endsection