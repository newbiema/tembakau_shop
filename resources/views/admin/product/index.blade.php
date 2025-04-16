@extends('layouts.app')

@section('title')
    Data Produk
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
        <a href="{{ route('admin.product.create') }}" class="btn btn-primary"><i class="fas fa-plus mr-2"></i> Tambah</a>
    </div>
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
                                <h6 class="mt-2">Stock : {{ $item->stock }}</h6>
                            </div>
                            <div>
                                <a href="{{ route('admin.product.edit', ['id' => $item->id]) }}" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                                <a href="javascript:void(0)" onclick="return deleteProduct('{{ $item->id }}')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const BASE = "{{ route('admin.product') }}";

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        function deleteProduct(id) {
            Swal.fire({
                title: "Peringatan !",
                text: "Anda yakin ingin menghapus data ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus",
                cancelConfirmText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: BASE + '/' + id + '/destroy',
                        method: "DELETE",
                        dataType: "json",
                        success: function(response) {
                            Toast.fire({
                                icon: response.status,
                                title: response.message
                            });

                            setTimeout(() => {
                                window.location.reload()
                            }, 3000);
                        },
                        error: function(err) {
                            console.log(err);
                            Toast.fire({
                                icon: "error",
                                title: "Server Error"
                            });
                        }
                    })
                }
            });
        }
    </script>
@endpush