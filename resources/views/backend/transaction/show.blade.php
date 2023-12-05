@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="title-header title-header-block package-card">
                    <div>
                        <h5>Order #{{ $transaction->id }}</h5>
                    </div>
                    <div class="card-order-section">
                        <ul>
                            <li>{{ date('d F Y H:iA', strtotime($transaction->created_at)) }}</li>
                            <li>{{ count($transaction->items) }} barang</li>
                            <li>Total Rp {{ number_format($transaction->amount, 0, ',', '.') }}</li>
                        </ul>
                    </div>
                </div>
                <div class="bg-inner cart-section order-details-table">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="table-responsive table-details">
                                <table class="table cart-table table-borderless">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Barang Dibeli</th>
                                            <th class="text-end" colspan="2">
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($transaction->items->unique('product_id') as $item)
                                        @php
                                            $qty = count($transaction->items->where('product_id', $item->product_id));
                                        @endphp
                                        <tr class="table-order">
                                            <td>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset($item->product->image_link) }}"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p>Nama Produk</p>
                                                <h5>{{ $item->product->name }}</h5>
                                            </td>
                                            <td>
                                                <p>Kuantitas</p>
                                                <h5>{{ $qty }}</h5>
                                            </td>
                                            <td>
                                                <p>Harga</p>
                                                <h5>{{ number_format($item->price * $qty, 0, ',', '.') }}</h5>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                    <tfoot>
                                        <tr class="table-order">
                                            <td colspan="3">
                                                <h4 class="theme-color fw-bold">Total Price :</h4>
                                            </td>
                                            <td>
                                                <h4 class="theme-color fw-bold">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</h4>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- section end -->
            </div>
        </div>
    </div>
</div>
@endsection
