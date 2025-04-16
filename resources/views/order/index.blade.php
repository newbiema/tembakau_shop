@extends('layouts.app')

@section('title')
    @role('Admin')
        Data Order
    @endrole
    @role('User')
        History Transaksi
    @endrole
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
    @role('Admin')
        <h2 class="section-title">List Order</h2>
    @endrole
    @role('User')
        <h2 class="section-title">History Transaksi</h2>
    @endrole

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-primary">
                        <tr>
                            <th class="text-white text-center">#</th>
                            <th class="text-white">Nama Produk</th>
                            <th class="text-white text-center">Quantity</th>
                            <th class="text-white text-center">Total</th>
                            <th class="text-white text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($order as $item)
                            <tr>
                                <td class="text-center">
                                    <img width="80" class="rounded" src="{{ asset($item->product->image) }}" alt="">
                                </td>
                                <td>{{ $item->product->name }}</td>
                                <td class="text-center">{{ $item->qty }}</td>
                                <td class="text-center">Rp. {{ number_format($item->total) }}</td>
                                <td class="text-center">
                                    @role('Admin')
                                        <a href="{{ route('order.show', ['id' => $item->id]) }}" class="btn btn-primary btn-sm mr-2"><i class="fas fa-eye"></i></a>
                                        <a href="javascript:void(0)" onclick="return deleteOrder('{{ $item->id }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                    @endrole
                                    @role('User')
                                        <a href="{{ route('order.show', ['id' => $item->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                    @endrole
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum Ada Transaksi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $order->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const BASE = "{{ route('order') }}";

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

        function deleteOrder(id) {
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