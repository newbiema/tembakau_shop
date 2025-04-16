@extends('layouts.app')

@section('title', 'Data Customer')

@section('content')
    <div class="card">
        <div class="card-header">
            <b>Data Customer</b>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-primary">
                        <tr>
                            <th class="text-white text-center">#</th>
                            <th class="text-white">Nama Customer</th>
                            <th class="text-white">Email</th>
                            <th class="text-white">No Telephone</th>
                            <th class="text-white">Alamat</th>
                            <th class="text-white text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($user as $item)
                            <tr>
                                <td class="text-center">
                                    @php
                                        $image = '';
                                        if ($item->image != 'default.png') {
                                            $image = asset($item->image);
                                        } else {
                                            $image = asset('img/avatar/avatar-1.png');
                                        }
                                    @endphp
                                    <img src="{{ $image }}" class="rounded p-2" width="80" alt="">
                                </td>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    {{ $item->email }}
                                </td>
                                <td>
                                    {{ $item->telp }}
                                </td>
                                <td>
                                    {{ $item->alamat }}
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" onclick="return deleteuser('{{ $item->id }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data customer</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $user->links() }}
                </div>
            </div>
        </div>
    </div>    
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const BASE = "{{ route('admin.customer') }}";

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

        function deleteuser(id) {
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