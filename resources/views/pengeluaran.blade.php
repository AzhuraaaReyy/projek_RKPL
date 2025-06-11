<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>ini pengeluaran</p>
    <br>
    <hr>
    <a href="/categories-pengeluaran" class="btn btn-sm btn-primary">
        <i class="fas fa-plus"></i> Tambah Kategori Pengeluaran
    </a>
    <hr>
    <a href="/formpengeluaran" class="btn btn-sm btn-primary">
        <i class="fas fa-plus"></i> Tambah Pengeluaran
    </a>

    <h1>Daftar Pengeluaran</h1>

    <div class="container">
        <h2>Data Pengeluaran</h2>

        {{-- Flash Message --}}
        @if(session('success'))
        <div>{{ session('success') }}</div>
        @endif

        {{-- Filter Form --}}
        <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
            {{-- Form Filter --}}
            <form action="{{ route('filterBy') }}" method="GET" class="mb-3" onsubmit="return validateFilterForm()" style="display: flex; align-items: center; gap: 10px;">
                <label for="expense_date">Tanggal:</label>
                <input type="date" name="expense_date" id="expense_date" value="{{ request('expense_date') }}">

                <label for="expense_category_id">Kategori:</label>
                <select name="expense_category_id" id="expense_category_id">
                    <option value="">-- Semua Kategori --</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('expense_category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('pengeluaran') }}" class="btn btn-secondary">Reset</a>
            </form>

            {{-- Tombol Download PDF --}}
            <form action="{{ route('pengeluaran') }}" method="GET" style="display: inline;">
                <input type="hidden" name="download" value="pdf">
                <input type="hidden" name="expense_date" value="{{ request('expense_date') }}">
                <input type="hidden" name="expense_category_id" value="{{ request('expense_category_id') }}">
                <button type="submit" class="btn btn-danger">Download PDF</button>
            </form>

        </div>



        {{-- Tabel Data --}}
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Pengeluaran</th>
                    <th>Tanggal</th>
                    <th>Deskripsi</th>
                    <th>Catatan</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @forelse($expenses as $index => $expense)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $expense->creator->name ?? '-' }}</td>
                    <td>{{ $expense->category->name ?? '-' }}</td>
                    <td>{{ $expense->expense_date }}</td>
                    <td>{{ $expense->description }}</td>
                    <td>{{ $expense->notes }}</td>
                    <td>Rp{{ number_format($expense->amount, 2, ',', '.') }}</td>
                </tr>

                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data pengeluaran</td>
                </tr>
                @endforelse
            <tfoot>
                <tr>
                    <td colspan="6" style="text-align: center;"><strong>Total Pengeluaran</strong></td>
                    <td><strong>Rp{{ number_format($totalAmount, 2, ',', '.') }}</strong></td>
                </tr>
            </tfoot>

            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $expenses->links() }}
        </div>
    </div>



</body>
<script>
    function validateFilterForm() {
        const date = document.getElementById('expense_date').value;
        const category = document.getElementById('expense_category_id').value;

        if (!date && !category) {
            alert('Silakan isi setidaknya salah satu filter: Tanggal atau Kategori.');
            return false;
        }

        return true;
    }
</script>

</html>