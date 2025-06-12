<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1 class="mb-4">Tambah Jenis Produk</h1>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{route('karyawan.storetambah')}}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Produk</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" id="description" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="estimated_production_time" class="form-label">Estimasi Waktu Produksi (menit)</label>
                <input type="number" name="estimated_production_time" id="estimated_production_time" class="form-control" min="0" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" id="is_active" class="form-check-input" checked>
                <label class="form-check-label" for="is_active">Aktif</label>
            </div>
            <h5>Bahan Baku</h5>
            @foreach ($bahanBakus as $index => $bahanBaku)
            <div class="mb-3 border p-3 rounded">
                <input type="checkbox" name="bahan_baku_id[]" value="{{ $bahanBaku->id }}" id="bahan_{{ $index }}">
                <label for="bahan_{{ $index }}"><strong>{{ $bahanBaku->nama }}</strong> ({{ $bahanBaku->satuan }})</label>

                <div class="mt-2">
                    <label>Jumlah per produk ({{ $bahanBaku->satuan }})</label>
                    <input type="number" step="0.01" name="quantity_per_unit[{{ $bahanBaku->id }}]" class="form-control" placeholder="Contoh: 0.5">
                </div>
            </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>

</html>