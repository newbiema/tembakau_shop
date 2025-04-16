@extends('layouts.app')

@section('title')
    Produk
@endsection

@push('js')
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
<h2 class="section-title">List Produk</h2>

<div class="d-flex justify-content-between mb-4">
    <div>
        <form>
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Search..." aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-primary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
</div>

<div class="mb-3">
    @if (session()->has('success'))
        <div class="alert alert-primary">
            {{ session()->get('success') }}
        </div>
    @endif
</div>

<div class="row">
    @forelse ($products as $item)
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
    @empty
        <div class="col-12">
            <div class="alert alert-info w-100 text-center">
                <b>
                    Tidak Ada Data Produk
                </b>
            </div>
        </div>
    @endforelse
</div>

<div class="d-flex justify-content-center mt-3">
    {{ $products->links() }}
</div>
@endsection