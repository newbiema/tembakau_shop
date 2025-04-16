@extends('layouts.app')

@section('title')
    Pembayaran
@endsection

@push('css')
    
@endpush    

@section('content')
    <h2 class="section-title">Pembayaran</h2>
    <div class="invoice">
        <div class="invoice-print">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-title">
                        <h2>Struk Pembelian</h2>
                        <div class="invoice-number">Order #{{ $order->id }}</div>
                    </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <address>
                            <strong>Penerima:</strong><br>
                            {{ $order->user->name }}<br>
                            {{ $order->user->email }}<br>
                            {{ $order->user->telp }}<br>
                            {{ $order->user->alamat }}
                        </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-md-left">
                        <address>
                            <strong>Tanggal Pemesanan:</strong><br>
                            {{ \Carbon\Carbon::parse($order->created_at)->format('d F Y') }}<br><br>
                        </address>
                    </div>
                </div>
                </div>
            </div>
        
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="section-title">Product Yang Di Beli</div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-md">
                            <tr>
                                <th data-width="40">#</th>
                                <th>Product</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-right">SubTotal</th>
                            </tr>
                            <tr>
                                <td>
                                    <img width="100" src="{{ asset($order->product->image) }}" class="rounded">
                                </td>
                                <td>{{ $order->product->name }}</td>
                                <td class="text-center">{{ number_format($order->product->harga) }}</td>
                                <td class="text-center">{{ $order->qty }}</td>
                                <td class="text-right">Rp. {{ number_format($order->total) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-8">
                        <div class="section-title">Metode Pembayaran</div>
                            <h6>Cash On Delivery (COD)</h6>
                        </div>
                        <div class="col-lg-4 text-right">
                            <hr class="mt-3 mb-2">
                            <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Total</div>
                                <div class="invoice-detail-value invoice-detail-value-lg">Rp.{{ number_format($order->total) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="text-md-right">
            <form action="{{ route('user.product.update', ['id' => $order->id]) }}" method="POST">
                @csrf
                @method("PUT")
                <button class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Selesaikan Pembayaran</button>
            </form>
        </div>
    </div>
@endsection