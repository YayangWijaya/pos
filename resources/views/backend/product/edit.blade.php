@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-12">
        <form class="row" method="post" action="{{ route('product.update', ['product' => $product->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-sm-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Informasi Produk</h5>
                        </div>

                        <div class="theme-form theme-form-2 mega-form">
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Nama Produk</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="name" type="text" placeholder="Nama Produk" value="{{ $product->name }}" required>
                                </div>
                            </div>

                            {{-- <div class="mb-4 row">
                                <label class="form-label-title col-sm-3 mb-0">Product Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="description" rows="4" placeholder="Product Description">{{ $product->description }}</textarea>
                                </div>
                            </div> --}}

                            <div class="mb-4 row align-items-center">
                                <label class="col-sm-3 col-form-label form-label-title">Satuan</label>
                                <div class="col-sm-9">
                                    <select class="w-100" name="unit" required>
                                        <option disabled>Pilih Satuan</option>
                                        @foreach (['Pieces', 'Kilogram'] as $unit)
                                        <option value="{{ $unit }}" {{ $product->unit == $unit ? 'selected' : '' }}>{{ $unit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <label class="col-sm-3 form-label-title">Harga</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="price" type="number" placeholder="0" value="{{ $product->price }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Gambar Produk</h5>
                        </div>

                        <div class="theme-form theme-form-2 mega-form">
                            <div class="mb-4 row align-items-center">
                                <label class="col-sm-3 col-form-label form-label-title">Gambar</label>
                                <div class="col-sm-9">
                                    <input class="form-control form-choose" name="image" id="image" type="file">
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <div class="col-sm-9 offset-sm-3" id="preview-image"></div>
                                <div class="col-sm-9 offset-sm-3 d-flex justify-content-center mt-2">
                                    <button type="button" class="btn btn-sm btn-secondary d-none" id="remove-image">HAPUS GAMBAR</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center mb-4">
                    <button type="submit" class="btn btn-primary">Simpan Produk</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var previewElement = document.getElementById('preview-image');
    var removeBtn = document.getElementById('remove-image');
    var fileInput = document.getElementById('image');

    fileInput.addEventListener('change', function(event) {
        var file = event.target.files[0];

        if (file) {
            var reader = new FileReader();
            reader.addEventListener('load', function(e) {
                var imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.classList.add('w-100');
                imgElement.classList.add('rounded');

                previewElement.innerHTML = '';

                previewElement.appendChild(imgElement);
                removeBtn.classList.remove('d-none');
            });

            reader.readAsDataURL(file);
        }
    });

    removeBtn.addEventListener('click', function(event) {
        previewElement.innerHTML = '';
        removeBtn.classList.add('d-none');
        fileInput.value = '';
    });
</script>
@endpush
