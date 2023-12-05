@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card card-table">
            <div class="card-body">
                <div class="title-header option-title d-sm-flex d-block">
                    <h5>Data Produk</h5>
                    <div class="right-options">
                        <ul class="d-flex align-items-center">
                            <li>
                                <form method="GET" action="{{ route('product.index') }}" class="top-nav-search table-search-blk">
                                    <input type="text" class="form-control" placeholder="Cari produk" name="keyword" value="{{ request()->get('keyword') }}">
                                    <span class="btn search"><img src="assets/img/icons/search-normal.svg" alt></span>
                                </form>
                            </li>
                            <li>
                                <a class="btn btn-solid" href="{{ route('product.create') }}">Tambah Produk</a>
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
                                    <th>Stok Barang</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($products as $index => $product)
                                <tr>
                                    <td>
                                        <div class="table-image">
                                            <img src="{{ asset($product->image_link) }}" class="img-fluid" alt="{{ $product->name }}">
                                        </div>
                                    </td>

                                    <td>{{ $product->name }}</td>

                                    <td>{{ $product->quantity }}</td>

                                    <td class="td-price">{{ $product->price_formatted }}</td>

                                    <td>
                                        <ul>
                                            <li>
                                                <a href="{{ route('product.edit', ['product' => $product->id]) }}">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#" onClick="deleteProduct({{ $product->id }})">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>

                                                <form action="{{ route('product.destroy', ['product' => $product->id]) }}" method="POST" id="delete-{{ $product->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">No Data</td>
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

@push('scripts')
<script>
function deleteProduct(id) {
    Swal.fire({
        title: 'Hapus produk?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
    }).then((result) => {
        if (result.isConfirmed) {
            $(`#delete-${id}`).submit();
        }
    })
}
</script>
@endpush
