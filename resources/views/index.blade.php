
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fastkart">
    <meta name="keywords" content="Fastkart">
    <meta name="author" content="Fastkart">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('frontend/images/favicon/6.png') }}" type="image/x-icon">
    <title>Point of Sales PT Wingsfood</title>

    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('frontend/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/vendors/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/vendors/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/vendors/slick/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bulk-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/vendors/animate.css') }}">
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('frontend/css/custom.css') }}">
</head>

<body class="theme-color-4 bg-gradient-color">
    <div class="fullpage-loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>

    <header class="pb-0 fixed-header">
        <div class="top-nav top-header py-2">
            <div class="container-fluid-xs">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar-top justify-content-between">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('frontend/images/logo/1.png') }}" width="100"/>
                                <a href="{{ route('dashboard') }}" type="button" class="btn theme-bg-color btn-sm text-white fw-bold mend-auto w-100 ms-5">
                                  Dashboard
                                </a>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="me-3 text-end">
                                    <h5>{{ auth()->user()->name }}</h5>
                                    <p class="mb-0">Kasir</p>
                                </div>
                                <img src="https://img.freepik.com/free-icon/user_318-159711.jpg" height="45"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="product-section pt-3">
        <div class="container-fluid p-0">
            <div class="custom-row">
                <div class="content-col">
                    <div class="title d-flex justify-content-between align-items-center">
                        <h2 class="text-theme font-sm">Menu</h2>

                        <div>
                            <input type="text" class="form-control form-control-sm" id="search" placeholder="Search ice cream">
                        </div>
                    </div>

                    <div class="row row-cols-xxl-3 row-cols-lg-3 row-cols-md-3 row-cols-sm-3 row-cols-3 g-sm-4 g-3 section-b-space">
                        @forelse ($products as $product)
                        <div class="product-item" product-name="{{ $product->name }}">
                            <div class="product-box product-white-bg wow fadeIn {{ $product->quantity < 1 ? 'sold' : '' }}">
                                <div class="product-image">
                                    <img src="{{ $product->image_link }}" class="img-fluid blur-up lazyload" alt="{{ $product->name }}">
                                </div>
                                <div class="product-detail position-relative">
                                    <h5 class="product-name fw-bold cursor-default">
                                        {{ $product->name }}
                                    </h5>

                                    <small class="cursor-default">{{ $product->quantity }} Tersedia <span class="mx-1">●</span> {{ $product->sold }} Terjual</small>

                                    <div class="d-flex justify-content-between">
                                        <h5 class="price fw-bold cursor-default" style="color: {{ $product->quantity > 0 ? '#2261FF' : '#A7A7A7' }};"><span style="color: #000;">Rp</span> {{ $product->price_formatted }}</h5>

                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-circle btn-removecart" onClick="removeCart({{ $product->id }})" {{ $product->quantity < 1 ? 'disabled' : '' }}><i class="fa-solid fa-minus"></i></button>
                                            <h5 class="qty fw-bold cursor-default" style="color: {{ $product->quantity > 0 ? '#000' : '#A7A7A7' }};" qty-id="{{ $product->id }}">{{ $product->cart }}</h5>
                                            <button class="btn btn-circle btn-addcart" onClick="addCart({{ $product->id }})" {{ $product->quantity < 1 ? 'disabled' : '' }}><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty

                        @endforelse
                    </div>
                </div>

                <div class="sidebar-col pt-3">
                    <div class="cart">
                        <div class="title d-block">
                            <h2 class="text-theme font-sm">Keranjang</h2>
                        </div>

                        <div class="text-center {{ count($carts) > 0 ? 'd-none' : '' }}" id="empty">
                            <h3>Keranjang Kosong</h3>
                        </div>

                        <div class="row row-cols-xxl-1 row-cols-lg-1 row-cols-md-1 row-cols-sm-1 row-cols-1 g-sm-2 g-2 section-b-space" id="carts">
                            @forelse ($carts as $cart)
                            <div class="cart-items border-bottom" cart-id="{{ $cart->id }}">
                                <div class="cart-image">
                                    <img src="{{ $cart->product->image_link }}" class="img-fluid blur-up lazyload" alt="{{ $cart->product->name }}">
                                </div>
                                <div class="cart-detail">
                                    <h5 class="cart-product-name name fw-bold cursor-default">
                                        {{ $cart->product->name }}
                                    </h5>

                                    <div class="d-flex justify-content-between">
                                        <h5 class="price fw-bold cursor-default" style="color: #2261FF;"><span style="color: #000;">Rp</span> {{ $cart->product->price_formatted }}</h5>

                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-circle-sm btn-removecart" onClick="removeCart({{ $cart->product->id }})"><i class="fa-solid fa-minus"></i></button>
                                            <h5 class="qty fw-bold cursor-default" style="color: {{ $cart->product->quantity > 0 ? '#000' : '#A7A7A7' }};" qty-id="{{ $cart->product->id }}">{{ $cart->product->cart }}</h5>
                                            <button class="btn btn-circle-sm btn-addcart" onClick="addCart({{ $cart->product->id }})"><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty

                            @endforelse
                        </div>

                        <div class="title d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold">Total</h5>
                            <h3 class="price fw-bold cursor-default" style="color: #2261FF;"><span style="color: #000;">Rp</span> <span id="total-price">{{ auth()->user()->cart_total['formatted'] }}</span></h3>
                        </div>

                        <input class="cart-form-input mb-2 numeric" type="text" name="paid" id="paid" placeholder="Nominal Diterima" required>
                        <input class="cart-form-input mb-2" type="text" name="customer_name" id="customer_name" placeholder="Nama Pelanggan (opsional)">
                        <input class="cart-form-input" type="text" name="note" id="note" placeholder="Catatan (opsional)">

                        <button type="button" class="btn theme-bg-color btn-md text-white fw-bold mt-md-4 mt-2 mend-auto w-100" id="showBayarModal">
                            Bayar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade theme-modal view-modal" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('frontend/images/illustration/cashier.jpg') }}" height="500">

                        <div class="px-5 mx-5 py-5 w-100">

                            <div class="text-center">
                                <h2 class="fw-bold">Konfirmasi Pembayaran</h2>
                            </div>

                            <div class="summary my-4">
                                <table class="w-100">
                                    <tr>
                                        <td>Total Harga</td>
                                        <td class="text-end fw-bold">{{ auth()->user()->cart_total['formatted'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Dibayar</td>
                                        <td class="text-end fw-bold" id="paid-plain"></td>
                                    </tr>
                                </table>

                                <hr>

                                <table class="w-100">
                                    <tr>
                                        <td>Kembalian</td>
                                        <td class="text-end fw-bold" id="exchange-plain">0</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn theme-bg-danger btn-md text-white fw-bold" data-bs-dismiss="modal" aria-label="Close" id="cancel">
                                    Batal
                                </button>

                                <button type="button" class="btn theme-bg-color btn-md text-white fw-bold" id="bayar">
                                    Bayar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade theme-modal view-modal" id="paymentSuccessModal" tabindex="-1" aria-labelledby="paymentSuccessModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('frontend/images/illustration/success.png') }}" height="500">

                        <div class="px-4 mx-4 py-5 w-100">

                            <div class="text-center">
                                <h2 class="fw-bold">Pembayaran Sukses</h2>
                            </div>

                            <div class="summary my-4">
                                <table class="w-100">
                                    <tr>
                                        <td>Total Harga</td>
                                        <td class="text-end fw-bold" id="success-total"></td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Dibayar</td>
                                        <td class="text-end fw-bold" id="success-paid"></td>
                                    </tr>
                                </table>

                                <hr>

                                <table class="w-100">
                                    <tr>
                                        <td>Kembalian</td>
                                        <td class="text-end fw-bold" id="success-exchange">0</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn theme-bg-danger btn-md text-white fw-bold" data-bs-dismiss="modal" aria-label="Close">
                                    Tutup
                                </button>

                                <button type="button" class="btn theme-bg-color btn-md text-white fw-bold" id="download">
                                    Download Invoice
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-overlay"></div>

    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/feather/feather.min.js') }}"></script>
    <script src="{{ asset('frontend/js/feather/feather-icon.js') }}"></script>
    <script src="{{ asset('frontend/js/lazysizes.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick/slick.js') }}"></script>
    <script src="{{ asset('frontend/js/slick/slick-animation.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick/custom_slick.js') }}"></script>
    <script src="{{ asset('frontend/js/auto-height.js') }}"></script>
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.8.1"></script>
    <script src="{{ asset('frontend/js/custom-wow.js') }}"></script>
    <script src="{{ asset('frontend/js/script.js') }}"></script>
    <script>
        let total = {{ auth()->user()->cart_total['raw'] }};
    </script>
    <script src="{{ asset('frontend/js/app.js') }}"></script>
</body>
</html>
