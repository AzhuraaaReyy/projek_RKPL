<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Tambah Kategori Pengeluaran</h2>

    @if(session('success'))
    <div>{{ session('success') }}</div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Nama Kategori:</label>
            <input type="text" name="name" id="name" required>
            @error('name') <div>{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="description">Deskripsi (opsional):</label>
            <textarea name="description" id="description"></textarea>
            @error('description') <div>{{ $message }}</div> @enderror
        </div>

        <div>
            <input type="hidden" name="is_active" value="1">

        </div>

        <button type="submit">Simpan</button>
    </form>
</body>

</html>