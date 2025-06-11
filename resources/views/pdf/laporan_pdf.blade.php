<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Lengkap</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
        }

        th {
            background-color: #eee;
            text-align: center;
        }

        h2 {
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center;">Laporan Data Keseluruhan</h1>
    <h2>Laporan Bahan Baku</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>Min Stok</th>
                <th>Masuk</th>
                <th>Kedaluwarsa</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bahanBakus as $index => $bahan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $bahan->nama }}</td>
                <td>{{ $bahan->kategori }}</td>
                <td>{{ number_format($bahan->stok) }}</td>
                <td>{{ $bahan->satuan }}</td>
                <td>{{ number_format($bahan->minimum_stok) }}</td>
                <td>{{ \Carbon\Carbon::parse($bahan->tanggal_masuk)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($bahan->tanggal_kedaluwarsa)->format('d-m-Y') }}</td>
                <td>Rp{{ number_format($bahan->harga, 2, ',', '.') }}</td>
                <td>{{ $bahan->deskripsi }}</td>
                <td>{{ $bahan->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Riwayat Stok</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Sisa</th>
                <th>Tanggal</th>
                <th>Referensi</th>
                <th>Catatan</th>
                <th>Pencatat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stokMovements as $index => $movement)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $movement->bahanBaku->nama ?? '-' }}</td>
                <td>{{ $movement->movement_type }}</td>
                <td>{{ number_format($movement->quantity, 2) }}</td>
                <td>{{ number_format($movement->remaining_stock, 2) }}</td>
                <td>{{ $movement->movement_date->format('d-m-Y') }}</td>
                <td>{{ $movement->reference_type ?? '-' }} #{{ $movement->reference_id ?? '-' }}</td>
                <td>{{ $movement->notes ?? '-' }}</td>
                <td>{{ $movement->creator->name ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Laporan Produksi</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Batch</th>
                <th>Tgl Produksi</th>
                <th>Biaya</th>
                <th>Bahan Baku</th>
                <th>Catatan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productions as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->productType->name ?? '-' }}</td>
                <td>{{ $product->quantity_produced }}</td>
                <td>{{ $product->batch_number }}</td>
                <td>{{ $product->production_date->format('d-m-Y') }}</td>
                <td>Rp{{ number_format($product->production_cost, 2, ',', '.') }}</td>
                <td>
                    @foreach ($product->productType->bahanBaku as $bahan)
                    {{ $bahan->nama }} ({{ $bahan->pivot->quantity_per_unit * $product->quantity_produced }} {{ $bahan->satuan }}),
                    @endforeach
                </td>
                <td>{{ $product->notes }}</td>
                <td>{{ $product->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Laporan Penjualan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Barang</th>
                <th>Total</th>
                <th>Tanggal</th>
                <th>Catatan</th>
                <th>Kasir</th>
                <th>Pembayaran</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $index => $sale)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $sale->customer->nama ?? '-' }}</td>
                <td>
                    @foreach ($sale->saleItems as $item)
                    {{ $item->productType->name ?? '-' }} (x{{ $item->quantity }}),
                    @endforeach
                </td>
                <td>Rp{{ number_format($sale->total_amount, 2, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('d-m-Y') }}</td>
                <td>{{ $sale->notes ?? '-' }}</td>
                <td>{{ $sale->creator->name ?? '-' }}</td>
                <td>{{ $sale->payment_method }}</td>
                <td>{{ $sale->payment_status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Laporan Pengeluaran</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th>Catatan</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $index => $expense)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $expense->creator->name ?? '-' }}</td>
                <td>{{ $expense->category->name ?? '-' }}</td>
                <td>{{ $expense->expense_date }}</td>
                <td>{{ $expense->description }}</td>
                <td>{{ $expense->notes }}</td>
                <td>Rp{{ number_format($expense->amount, 2, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="6" style="text-align: right;"><strong>Total</strong></td>
                <td><strong>Rp{{ number_format($totalAmount, 2, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>

</html>