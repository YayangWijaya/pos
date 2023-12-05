@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card card-table">
            <div class="card-body">
                <div class="title-header option-title d-sm-flex d-block">
                    <h5>Transaksi</h5>
                    <div class="right-options">
                        <ul>
                            <li>
                                <a type="button" class="btn btn-success" href="{{ route('export.transaction', ['from' => request()->from, 'to' => request()->to]) }}">Unduh Laporan</a>
                            </li>
                            <li>
                                <form class="d-flex align-items-center" action="{{ route('transaction.index') }}" method="get">
                                    <input type="date" class="me-2 form-control" name="from" id="from" value="{{ request()->from ? date('Y-m-d', strtotime(request()->from)) : "" }}"/>
                                    <small class="me-2">To</small>
                                    <input type="date" class="me-2 form-control" name="to" id="to" value="{{ request()->to ? date('Y-m-d', strtotime(request()->to)) : "" }}"/>
                                    <button class="btn btn-primary" type="submit">Filter</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                    <div class="table-responsive">
                        <table class="table all-package theme-table table-product" id="table_id">
                            <thead>
                                <tr>
                                    <th>Jumlah Beli</th>
                                    <th>Tagihan</th>
                                    <th>Dibayar</th>
                                    <th>Kembalian</th>
                                    <th>Tanggal</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($transactions as $index => $transaction)
                                <tr>
                                    <td>{{ count($transaction->items) }}</td>

                                    <td>{{ number_format($transaction->amount, 0, ',', '.') }}</td>

                                    <td>{{ number_format($transaction->paid, 0, ',', '.') }}</td>

                                    <td>{{ number_format($transaction->exchange, 0, ',', '.') }}</td>

                                    <td>{{ date('d-M-Y H:i', strtotime($transaction->created_at)) }}</td>

                                    <td><a href="{{ route('transaction.show', ['transaction' => $transaction->id]) }}">View Detail</a></td>
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
