@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-12">
        <form class="row" method="post" action="{{ route('inventory.store') }}">
            @csrf
            <div class="col-sm-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Tambah Stok Barang</h5>
                        </div>

                        <div class="theme-form theme-form-2 mega-form">
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Select Product</label>
                                <div class="col-sm-9">
                                    <select class="select2-with-image w-100" name="product_id"></select>
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <label class="col-sm-3 form-label-title">Amount</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="quantity" type="number" required>
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <label class="col-sm-3 form-label-title">Purchase Price</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="purchase_price" type="number" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center mb-4">
                    <button type="submit" class="btn btn-primary">Add Stock</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/select2.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('backend/js/select2.min.js') }}"></script>
<script>
const products = {!! $products !!};

var data = products.map(product => {
    return {
        id: product.id,
        text: product.name,
        imgSrc: product.image_link
    }
});

  $('.select2-with-image').select2({
    data: data,
    templateResult: formatOption,
    templateSelection: formatOption
  });

  function formatOption(option) {
    if (!option.id) {
      return option.text;
    }

    var $option = $('<span></span>');
    if (option.imgSrc) {
      var $image = $('<img>');
      $image.attr('src', option.imgSrc);
      $image.attr('style', 'height: 35px; width: 35px;object-fit: cover;margin-right: 8px;');
      $option.append($image);
    }
    $option.append(option.text);

    return $option;
  }
</script>
@endpush
