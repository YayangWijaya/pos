@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card card-table">
            <div class="card-body">
                <div class="title-header option-title d-sm-flex d-block">
                    <h5>Stok Barang</h5>
                    <div class="right-options">
                        <ul>
                            <li>
                                <a class="btn btn-solid" href="{{ route('inventory.create') }}">Tambah Stok</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                    <div class="table-responsive">
                        <table class="table all-package theme-table table-product" id="table_id">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Nama Produk</th>
                                    <th>Kuantitas</th>
                                    <th>Purchase Price</th>
                                    <th>Perubahaan Kuantitas</th>
                                    <th>Kuantitas Tersedia</th>
                                    <th>Tgl. Dibuat</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($inventories as $index => $inventory)
                                <tr>
                                    <td>
                                        <div class="table-image">
                                            <img src="{{ asset($inventory->product->image_link) }}" class="img-fluid" alt="{{ $inventory->product->name }}">
                                        </div>
                                    </td>

                                    <td>{{ $inventory->product->name }}</td>

                                    <td>{{ $inventory->quantity }}</td>

                                    <td class="td-price">{{ $inventory->purchase_price_formatted }}</td>

                                    <td>{{ $inventory->quantity_changes }}</td>

                                    <td>{{ $inventory->current_quantity }}</td>

                                    <td>{{ date('d-M-Y H:i', strtotime($inventory->created_at)) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">No Data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
