<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h1 style="text-align:center">Laporan Data Keseluruhan</h1>
    <form action="{{ route('laporan.download') }}" method="GET" style="display: inline;">
        <input type="hidden" name="download" value="pdf">
        <button type="submit" class="btn btn-danger">Download PDF</button>
    </form>
    <form method="GET" action="{{ route('laporan.index') }}" class="mb-4">
        <input type="text" name="keyword" class="form-control" placeholder="Cari data..." value="{{ request('keyword') }}">
        <button type="submit" class="btn btn-primary mt-2">Cari</button>
    </form>
    @if(count($bahanBakus) > 0)
    <h1>Laporan Bahan Baku</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Bahan Baku</th>
                    <th>Kategori</th>
                    <th>Stok Tersedia</th>
                    <th>Satuan</th>
                    <th>Minimum Stok</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Kedaluwarsa</th>
                    <th>Harga Beli</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bahanBakus as $index => $bahan)
                <tr>
                    <td class="text-center">{{ $bahanBakus->firstItem() + $index }}</td>
                    <td>{{ $bahan->nama }}</td>
                    <td class="text-capitalize text-center">{{ $bahan->kategori }}</td>
                    <td class="text-end">{{ number_format($bahan->stok) }}</td>
                    <td class="text-center">{{ $bahan->satuan }}</td>
                    <td class="text-end">{{ number_format($bahan->minimum_stok) }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($bahan->tanggal_masuk)->format('d-m-Y') }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($bahan->tanggal_kedaluwarsa)->format('d-m-Y') }}</td>
                    <td class="text-center">Rp{{ number_format($bahan->harga, 2, ',', '.') }}</td>
                    <td class="text-center">{{ $bahan->deskripsi }}</td>
                    <td class="text-center">
                        <span class="badge bg-{{ $bahan->status_class }}">
                            {{ $bahan->status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="text-center">
                        <div class="alert alert-warning m-0" role="alert">
                            Data tidak dapat ditemukan.
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
        @endif
        <div class="d-flex justify-content-center">
            {{ $bahanBakus->links() }}
        </div>

    </div>
    @if(count($stokMovements) > 0)
    <h1>Riwayat Bahan Baku</h1>
    <div class="table-responsive px-4">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Bahan Baku</th>
                    <th>Jenis Pergerakan</th>
                    <th>Jumlah</th>
                    <th>Stok Sisa</th>
                    <th>Tanggal</th>
                    <th>Referensi</th>
                    <th>Catatan</th>
                    <th>Dicatat Oleh</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($stokMovements as $index => $movement)
                <tr>
                    <td class="text-center">{{ $stokMovements->firstItem() + $index  }}</td>
                    <td>{{ $movement->bahanBaku->nama ?? '-' }}</td>
                    <td class="text-center text-capitalize">
                        <span class="badge bg-{{ $movement->movement_type === 'in' ? 'success' : 'danger' }}">
                            {{ $movement->movement_type }}
                        </span>
                    </td>
                    <td class="text-end">{{ number_format($movement->quantity, 2) }}</td>
                    <td class="text-end">{{ number_format($movement->remaining_stock, 2) }}</td>
                    <td class="text-center">{{ $movement->movement_date->format('d-m-Y') }}</td>
                    <td class="text-center">{{ $movement->reference_type ?? '-' }} #{{ $movement->reference_id ?? '-' }}</td>
                    <td>{{ $movement->notes ?? '-' }}</td>
                    <td class="text-center">{{ $movement->creator->name ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="text-center">
                        <div class="alert alert-warning m-0" role="alert">
                            Data tidak dapat ditemukan.
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @endif
        <div class="d-flex justify-content-center">
            {{ $stokMovements->links() }}
        </div>

    </div>
    @if(count($productions) > 0)
    <h1>Laporan Produksi</h1>
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

                </tr>
            </thead>
            <tbody>
                @forelse ($productions as $index => $product)
                <tr>
                    <td class="text-center">{{ $productions->firstItem() + $index }}</td>
                    <td>{{ $product->productType->name ?? '-' }}</td>
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

                </tr>
                @empty
                <tr>
                    <td colspan="11" class="text-center">
                        <div class="alert alert-warning m-0" role="alert">
                            Data tidak dapat ditemukan.
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @endif
        <div class="d-flex justify-content-center">
            {{ $productions->links() }}
        </div>

    </div>
    @if(count($productionHistories) > 0)
    <h1>Riwayat Produksi</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Jumlah Produksi</th>
                    <th>Batch Number</th>
                    <th>Tanggal Produksi</th>
                    <th>Biaya Produksi</th>
                    <th>Bahan Baku</th>
                    <th>Catatan</th>
                    <th>Status</th>
                    <th>Dibuat Oleh</th>

                </tr>
            </thead>
            <tbody>
                @foreach($productionHistories as $index => $production)
                <tr>
                    <td>{{ $productionHistories->firstItem() + $index }}</td>
                    <td>
                        <span class="product-name">{{ $production->productType->name ?? 'N/A' }}</span>
                    </td>
                    <td class="text-center">
                        <span class="quantity-badge">{{ $production->quantity_produced }} pcs</span>
                    </td>
                    <td class="text-center">
                        <span class="batch-number">{{ $production->batch_number }}</span>
                    </td>
                    <td class="text-center">{{ $production->production_date->format('d M Y') }}</td>
                    <td class="text-right">
                        <span class="production-cost">Rp {{ number_format($production->production_cost, 0, ',', '.') }}</span>
                    </td>
                    <td>
                        <div class="bahan-list">
                            @if(isset($production->productType->bahanBaku))
                            @foreach($production->productType->bahanBaku as $bahan)
                            <div class="bahan-item">
                                <strong>{{ $bahan->nama }}</strong><br>
                                <small>{{ $bahan->pivot->quantity_per_unit * $production->quantity_produced }} {{ $bahan->satuan }}</small>
                            </div>
                            @endforeach
                            @else
                            <small class="text-muted">-</small>
                            @endif
                        </div>
                    </td>
                    <td class="text-center">
                        <small>{{ $production->notes ?: '-' }}</small>
                    </td>
                    <td class="text-center">
                        @if($production->status === 'completed')
                        <span class="status-badge status-completed">
                            <i class="fas fa-check mr-1"></i>Completed
                        </span>
                        @elseif($production->status === 'planning')
                        <span class="status-badge status-planning">
                            <i class="fas fa-clock mr-1"></i>Planning
                        </span>
                        @else
                        <span class="status-badge status-cancelled">
                            <i class="fas fa-times mr-1"></i>Cancelled
                        </span>
                        @endif
                    </td>
                    <td class="text-center">{{ $production->creator->name ?? 'System' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        <div class="d-flex justify-content-center">
            {{ $productionHistories->links() }}
        </div>
    </div>
    @if(count($sales) > 0)
    <h1>Laporan Penjualan</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Barang Yang di Beli</th>
                    <th>Total Harga</th>
                    <th>Tanggal Penjualan</th>
                    <th>Catatan</th>
                    <th>Nama Kasir</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Pembayaran</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($sales as $index => $sale)
                <tr>
                    <td class="text-center">{{ $sales->firstItem() + $index }}</td>

                    <td class="text-center">{{ $sale->customer->nama ?? '-' }}</td>
                    <td>
                        <ul class="list-unstyled mb-0">
                            @foreach ($sale->saleItems as $item)
                            <li>{{ $item->productType->name ?? 'Produk tidak ditemukan' }} (x{{ $item->quantity }})</li>
                            @endforeach
                        </ul>
                    </td>

                    <td class="text-end">Rp{{ number_format($sale->total_amount, 2, ',', '.') }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($sale->sale_date)->format('d-m-Y') }}</td>
                    <td class="text-center">{{ $sale->notes ?? '-' }}</td>
                    <td class="text-center">{{ $sale->creator->name ?? '-' }}</td>
                    <td class="text-center text-capitalize">{{ $sale->payment_method }}</td>
                    <td class="text-center">
                        <span class="badge bg-{{ $sale->payment_status == 'paid' ? 'success' : ($sale->payment_status == 'pending' ? 'warning' : 'danger') }}">
                            {{ $sale->payment_status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="text-center">
                        <div class="alert alert-warning m-0" role="alert">
                            Data tidak dapat ditemukan.
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @endif
        <div class="d-flex justify-content-center">
            {{ $sales->links() }}
        </div>

    </div>
    @if(count($expenses) > 0)
    <h1>Laporan Pengeluaran</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
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
                    <td>{{ $expenses->firstItem() + $index  }}</td>
                    <td>{{ $expense->creator->name ?? '-' }}</td>
                    <td>{{ $expense->category->name ?? '-' }}</td>
                    <td>{{ $expense->expense_date }}</td>
                    <td>{{ $expense->description }}</td>
                    <td>{{ $expense->notes }}</td>
                    <td>Rp{{ number_format($expense->amount, 2, ',', '.') }}</td>
                </tr>

                @empty
                <tr>
                    <td colspan="11" class="text-center">
                        <div class="alert alert-warning m-0" role="alert">
                            Data tidak dapat ditemukan.
                        </div>
                    </td>
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
        @endif
        <div class="d-flex justify-content-center">
            {{ $expenses->links() }}
        </div>

    </div>
</body>

</html>