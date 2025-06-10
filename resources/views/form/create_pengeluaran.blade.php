<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Tambah Pengeluaran</h2>
    <form action="{{ route('expenses.store') }}" method="POST">
        @csrf
        <label for="expense_category_id">Kategori:</label><br>
        <select name="expense_category_id" required>

            <option value="">-- Pilih Kategori --</option>
            @foreach ($expensesCategories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select><br><br>

        <label for="description">Deskripsi:</label><br>
        <input type="text" name="description" maxlength="255" required><br><br>

        <label for="amount">Jumlah (Rp):</label><br>
        <input type="number" name="amount" step="0.01" required><br><br>

        <label for="expense_date">Tanggal:</label><br>
        <input type="date" name="expense_date" required><br><br>

        <label for="receipt_number">No Nota:</label><br>
        <input type="text" name="receipt_number"><br><br>

        <label for="notes">Catatan:</label><br>
        <textarea name="notes"></textarea><br><br>

        <button type="submit">Simpan</button>
    </form>

</body>

</html>