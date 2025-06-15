<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <h2 style="text-align: center;">Laporan Bahan Baku</h2>
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
</body>

</html>