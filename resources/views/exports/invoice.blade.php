<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice PT JATIASIH DISTRIBUSIDO RAYA</title>
</head>
<body>
    <div class="w-full" style="display: flex;align-items: center;padding: 20px 50px 5px 50px;">
        <table>
            <tbody>
                <tr>
                    <td class="text-center" style="padding: 0 75px;">
                        <img src="{{ asset('backend/images/logo/full-white.png') }}" height="50px"/>
                        <p>PT JATIASIH DISTRIBUSIDO RAYA</p>
                    </td>
                    <td>
                        <p>Kepada Yth. {{ $transaction['customer_name'] }}</p>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        Nomor
                                    </td>
                                    <td>
                                        : {{ $transaction['id'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tanggal
                                    </td>
                                    <td>
                                        : {{ date('d F Y', strtotime($transaction['created_at'])) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="padding: 20px 50px 5px 50px;">
        <table class="w-full" style="border-collapse: collapse;" border="1">
            <thead>
                <tr>
                    <th style="padding: 10px;width: 25px;text-align: center;background: #ddd;">NO</th>
                    <th style="padding: 10px;text-align: center;background: #ddd;">Nama Es Krim</th>
                    <th style="padding: 10px;text-align: center;background: #ddd;">Harga</th>
                    <th style="padding: 10px;width: 100px;text-align: center;background: #ddd;">Jml Beli</th>
                    <th style="padding: 10px;text-align: center;background: #ddd;">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $items = [];

                    foreach ($transaction['items'] as $item) {
                        if (!array_key_exists($item['product']['name'], $items)) {
                            $items[$item['product']['name']]['qty'] = 1;
                            $items[$item['product']['name']]['price'] = $item['product']['price'];
                        } else {
                            $items[$item['product']['name']]['qty']++;
                        }
                    }
                @endphp
                @php
                    $no = 0;
                    $total = 0;
                @endphp
                @forelse ($items as $value => $item)
                @php
                    $no++;
                    $total += $item['price'] * $item['qty'];
                @endphp
                <tr>
                    <td class="text-center" style="padding: 5px 20px">{{ $no }}</td>
                    <td style="padding: 5px 20px">{{ $value }}</td>
                    <td class="text-right" style="padding: 5px 20px">{{ number_format($item['price'], 0, ',', '.') }}</td>
                    <td class="text-center" style="padding: 5px 20px">{{ number_format($item['qty'], 0, ',', '.') }}</td>
                    <td class="text-right" style="padding: 5px 20px">{{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</td>
                </tr>
                @empty
                    -
                @endforelse
                <tr>
                    <td colspan="4" style="background: #ddd;padding: 5px 20px;font-weight: 600;" class="text-center">TOTAL BAYAR</td>
                    <td style="background: #ddd;padding: 5px 20px;font-weight: 600;" class="text-right">{{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="padding: 0px 50px 5px 50px;">
        <table>
            <tbody>
                <tr>
                    <td style="padding: 0 250px 0 0;">
                        <div style="width: 180px;">
                            <p>Catatan:</p>
                            <p>Barang yang sudah dibeli tidak dapat ditukar kembali</p>
                        </div>
                    </td>
                    <td>
                        <p>Hormat kami,</p>
                        <br>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>

<style>
.w-full {
    width: 100%;
}

.w-50 {
    width: 50%;
}

.text-center {
    text-align: center;
}

.text-right {
    text-align: right;
}
</style>
