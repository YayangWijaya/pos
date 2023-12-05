<table>
    <thead>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <th></th>
        <th>Nama Pelanggan</th>
        <th>Jumlah Barang</th>
        <th>Jumlah Pembelian</th>
        <th>Dibayar</th>
        <th>Kembali</th>
        <th>Nama Barang</th>
        <th>Note</th>
        <th>Tanggal</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        <tr>
            <td></td>
            <td>{{ $transaction['customer_name'] }}</td>
            <td>{{ count($transaction['items']) }}</td>
            <td>{{ number_format($transaction['amount'], 0, ',', '.') }}</td>
            <td>{{ number_format($transaction['paid'], 0, ',', '.') }}</td>
            <td>{{ number_format($transaction['exchange'], 0, ',', '.') }}</td>
            <td>
                @php
                    $items = [];

                    foreach ($transaction['items'] as $item) {
                        if (!array_key_exists($item['product']['name'], $items)) {
                            $items[$item['product']['name']] = 1;
                        } else {
                            $items[$item['product']['name']]++;
                        }
                    }
                @endphp
                @forelse ($items as $value => $total)
                    - {{ $value }} x{{ $total }}<br>
                @empty
                    -
                @endforelse
            </td>
            <td>{{ $transaction['note'] }}</td>
            <td>{{ date('d-M-Y H:i', strtotime($transaction['created_at'])) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
