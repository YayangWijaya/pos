@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-12">
        <form method="get" action="{{ route('dashboard') }}" id="filterForm" class="row">
            <div class="col-3 mb-4">
                <select name="month" id="month" class="form-control" onChange="document.getElementById('filterForm').submit()">
                    <option value="all">Semua</option>
                    @foreach (['01','02','03','04','05','06','07','08','09','10','11','12'] as $month)
                    <option value="{{ $month }}" {{ request()->month ? (request()->month === $month ? 'selected' : '') : (date('m') === $month ? 'selected' : '') }}>{{ date('F', strtotime("2023-{$month}-01")) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-3 mb-4">
                <select name="year" id="year" class="form-control" onChange="document.getElementById('filterForm').submit()">
                    <option value="all">Semua</option>
                    @foreach (['2023', '2024', '2025'] as $year)
                    <option value="{{ $year }}" {{ request()->year ? (request()->year === $year ? 'selected' : '') : (date('Y') === $year ? 'selected' : '') }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
    <div class="col-sm-6 col-xxl-3 col-lg-6">
        <div class="main-tiles border-5 border-0  card-hover card o-hidden">
            <div class="custome-1-bg b-r-4 card-body">
                <div class="media align-items-center static-top-widget">
                    <div class="media-body p-0">
                        <span class="m-0">Jumlah Pendapatan</span>
                        <h4 class="mb-0 counter">Rp {{ number_format($revenue, 0, ',', '.') }}
                        </h4>
                    </div>
                    <div class="align-self-center text-center">
                        <i class="ri-database-2-line"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xxl-3 col-lg-6">
        <div class="main-tiles border-5 card-hover border-0 card o-hidden">
            <div class="custome-4-bg b-r-4 card-body">
                <div class="media static-top-widget">
                    <div class="media-body p-0">
                        <span class="m-0">Pendapatan Bersih</span>
                        <h4 class="mb-0 counter">Rp {{ number_format($net, 0, ',', '.') }}
                        </h4>
                    </div>

                    <div class="align-self-center text-center">
                        <i class="ri-user-add-line"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xxl-3 col-lg-6">
        <div class="main-tiles border-5 card-hover border-0 card o-hidden">
            <div class="custome-2-bg b-r-4 card-body">
                <div class="media static-top-widget">
                    <div class="media-body p-0">
                        <span class="m-0">Jumlah Pesanan</span>
                        <h4 class="mb-0 counter">{{ number_format($orders, 0, ',', '.') }}
                        </h4>
                    </div>
                    <div class="align-self-center text-center">
                        <i class="ri-shopping-bag-3-line"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xxl-3 col-lg-6">
        <div class="main-tiles border-5 card-hover border-0  card o-hidden">
            <div class="custome-3-bg b-r-4 card-body">
                <div class="media static-top-widget">
                    <div class="media-body p-0">
                        <span class="m-0">Jumlah Produk</span>
                        <h4 class="mb-0 counter">{{ number_format($products, 0, ',', '.') }}
                            <a href="{{ route('product.create') }}" class="badge badge-light-secondary grow">
                                TAMBAH PRODUK</a>
                        </h4>
                    </div>

                    <div class="align-self-center text-center">
                        <i class="ri-chat-3-line"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
