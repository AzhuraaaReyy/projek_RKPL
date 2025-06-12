<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1>Tambah Bahan Baku</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{route('bahanBakus')}}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Bahan Baku</label>
                <input type="text" name="nama" id="nama" class="form-control" required maxlength="255">
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori" id="kategori" class="form-select" required>
                    <option value="" disabled selected>Pilih kategori</option>
                    <option value="kering" {{ old('kategori') == 'kering' ? 'selected' : '' }}>Kering</option>
                    <option value="cair" {{ old('kategori') == 'cair' ? 'selected' : '' }}>Cair</option>
                    <option value="beku" {{ old('kategori') == 'beku' ? 'selected' : '' }}>Beku</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" name="stok" id="stok" class="form-control" required min="0">
            </div>

            <div class="mb-3">
                <label for="satuan" class="form-label">Satuan</label>
                <select name="satuan" id="satuan" class="form-select" required>
                    <option value="" disabled selected>Pilih satuan</option>
                    <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                    <option value="gram" {{ old('satuan') == 'gram' ? 'selected' : '' }}>Gram</option>
                    <option value="liter" {{ old('satuan') == 'liter' ? 'selected' : '' }}>Liter</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="minimum_stok" class="form-label">Minimum Stok</label>
                <input type="number" name="minimum_stok" id="minimum_stok" class="form-control" required min="0">
            </div>

            <div class="mb-3">
                <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_kedaluwarsa" class="form-label">Tanggal Kedaluwarsa</label>
                <input type="date" name="tanggal_kedaluwarsa" id="tanggal_kedaluwarsa" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga Satuan</label>
                <input type="number" name="harga" id="harga" class="form-control" step="0.01" min="0">
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" required></textarea>
            </div>
        
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
        </form>
</body>

</html>