@extends('layouts.app')

@section('title')
    {{ $product->name }}
@endsection

@push('css')
    <style>
        .cuttoff-text {
            display: -webkit-box; 
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.4;
        }
    </style>
@endpush    

@section('content')
    <h2 class="section-title">{{ $product->name }}</h2>
    <div class="row mb-5">
        <div class="col-md-6 mb-4">
            <div class="card mt-2">
                <img src="{{ asset($product->image) }}" class="card-img-top" alt="Product Image">
            </div>
        </div>

        <div class="col-md-6">
            <h1 class="h2 mb-3">{{ $product->name }}</h1>
            <div class="mb-3">
                <span class="h4 me-2">Rp. {{ number_format($product->harga) }}</span>
            </div>

            <hr class="divide">

            <div class="mb-3">
                <p><strong>Stock  : {{ $product->jumlah }}</strong></p>
                <p><strong>Jumlah : {{ $product->jumlah }}</strong></p>
            </div>

            <hr class="divide">

            <p class="mb-2">
                {{ $product->description }}
            </p>

            <hr class="divide">

            <form action="{{ route('user.product.store') }}" method="POST">
                @csrf
                <input type="hidden" name="products_id" id="products_id" value="{{ $product->id }}">
                <div class="mb-4">
                    <div class="form-group mb-3">
                        <label class="me-2">Quantity:</label>
                        <input type="number" name="qty" id="qty" value="1" min="1" class="form-control">
                    </div>
                </div>
    
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-primary w-100" type="submit">
                            Beli Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <h2 class="section-title">Produk Lainnya</h2>
    <div class="row">
        @foreach ($products as $item)
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <article class="article">
                    <div class="article-header">
                        <div class="article-image" data-background="{{ asset($item->image) }}">
                    </div>
                        
                    </div>
                    <div class="article-details">
                        <div class="article-title mb-2">
                            <h5><a href="#">{{ $item->name }}</a></h5>
                        </div>
                        <p class="cuttoff-text">
                            {{ $item->description }}
                        </p>
                        <hr class="divide">
                        <div class="article-cta">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <span class="float-left">Stock : {{ $item->stock }}</span>
                                    <br>
                                    <span class="float-left">Jumlah : {{ $item->jumlah }}</span>
                                </div>
                                <div class="mt-2">
                                    <a href="{{ route('user.product.detail', ['id' => $item->id]) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        @endforeach
    </div>
@endsection