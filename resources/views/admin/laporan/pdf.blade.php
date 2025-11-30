<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan - Ginada Florist</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 18px; color: #333; }
        .header p { margin: 2px 0; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; text-align: right; }
    </style>
</head>
<body>

    <div class="header">
        <h1>GINADA FLORIST</h1>
        <p>Laporan Riwayat Penjualan</p>
        <p>Tanggal Cetak: {{ date('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Pesanan</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Status</th>
                <th>Total (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @php $totalSemua = 0; @endphp
            @foreach($pesanan as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->kode_pesanan }}</td>
                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                </tr>
                @php $totalSemua += $item->total_harga; @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="total">TOTAL PENDAPATAN</td>
                <td style="font-weight: bold;">Rp {{ number_format($totalSemua, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

</body>
</html>