<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div class="container">
        <h1 class="mb-4">Buat Produksi Baru</h1>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <form action="{{route('store.produksi')}}" method="POST">
            @csrf


            <div class="mb-3">
                <label for="production_date" class="form-label">Tanggal Produksi</label>
                <input type="date" name="production_date" id="production_date" class="form-control @error('production_date') is-invalid @enderror" value="{{ old('production_date') }}">
                @error('production_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="product_type_id" class="form-label">Jenis Produk</label>
                <select name="product_type_id" id="product_type_id" class="form-select @error('product_type_id') is-invalid @enderror">
                    <option value="">-- Pilih Jenis Produk --</option>
                    @foreach($producType as $type)
                    <option value="{{ $type->id }}" {{ old('product_type_id') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                    @endforeach
                </select>
                @error('product_type_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="quantity_produced" class="form-label">Jumlah Produksi</label>
                <input type="number" name="quantity_produced" id="quantity_produced" class="form-control @error('quantity_produced') is-invalid @enderror" value="{{ old('quantity_produced') }}">
                @error('quantity_produced') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="batch_number" class="form-label">Nomor Batch</label>
                <input type="text" name="batch_number" id="batch_number" class="form-control @error('batch_number') is-invalid @enderror" value="{{ old('batch_number') }}">
                @error('batch_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="production_cost" class="form-label">Biaya Produksi</label>
                <input type="number" step="0.01" name="production_cost" id="production_cost" class="form-control @error('production_cost') is-invalid @enderror" value="{{ old('production_cost', 0) }}">
                @error('production_cost') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Catatan</label>
                <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>
                @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status Produksi</label>
                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                    <option value="planning" {{ old('status') == 'planning' ? 'selected' : '' }}>Perencanaan</option>
                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>Sedang Diproses</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>

</html>