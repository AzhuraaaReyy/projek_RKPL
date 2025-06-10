<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <p>ini input produksi roti</p>
    <hr>
    <a href="/form-produk" class="btn btn-sm btn-primary">
        <i class="fas fa-plus"></i> Tambah Produk Roti
    </a>
    <hr>
    <a href="/form-produksi" class="btn btn-sm btn-primary">
        <i class="fas fa-plus"></i> Tambah Produksi
    </a>
    <br>
    <h1>Detail Produksi</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Jumlah Produk yang di Produksi</th>
                    <th>Nomer Batch</th>
                    <th>Tanggal Produksi</th>
                    <th>Biaya Produksi</th>
                    <th>Bahan Baku yang dibutuhkan</th>
                    <th>Catatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($productions as $index => $product)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>

                    <td>{{ $product->productType->name ?? '-' }}</td>

                    </ul>
                    <td class="text-center">{{ $product->quantity_produced }}</td>
                    <td class="text-end">{{ $product->batch_number }}</td>
                    <td class="text-center">{{ $product->production_date->format('d-m-Y') }}</td>
                    <td class="text-end">Rp{{ number_format($product->production_cost, 2, ',', '.') }}</td>
                    <td class="text-center">
                        <ul class="list-unstyled">
                            @foreach ($product->productType->bahanBaku as $bahan)
                            <li>
                                {{ $bahan->nama }} -
                                {{ $bahan->pivot->quantity_per_unit * $product->quantity_produced }} {{ $bahan->satuan }}
                            </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="text-center">{{ $product->notes }}</td>
                    <td class="text-center">
                        <span class="badge bg-{{ $product->status_class }}">
                            {{ $product->status }}
                        </span>
                    </td>
                    <td class="text-center">
                        @if($product->status === 'progres')
                        <form action="{{ route('produksi.updateStatus', $product->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Tandai sebagai Completed?')">
                                ✅ Selesai
                            </button>
                        </form>
                        @else
                        <span class="badge bg-success"> </span>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">Data bahan baku belum tersedia.</td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</body>

</html>