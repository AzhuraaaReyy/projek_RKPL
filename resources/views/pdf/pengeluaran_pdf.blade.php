<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pengeluaran</title>
    <style>
        body {
            font-family: sans-serif;
        }

        h2 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 12px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tfoot td {
            font-weight: bold;
        }
    </style>
</head>

<body>
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
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($expenses as $index => $expense)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $expense->creator->name ?? '-' }}</td>
                <td>{{ $expense->category->name ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($expense->expense_date)->format('d-m-Y') }}</td>
                <td>{{ $expense->description }}</td>
                <td>{{ $expense->notes }}</td>
                <td>Rp{{ number_format($expense->amount, 2, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center;">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" style="text-align: center;">Total Pengeluaran</td>
                <td>Rp{{ number_format($totalAmount, 2, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>