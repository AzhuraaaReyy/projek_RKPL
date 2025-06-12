<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="table-responsive">
        <table class="table table-hover" id="productionHistoryTable">
            <thead>
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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productionHistories as $index => $production)
                <tr>
                    <td class="text-center"><strong>{{ $index + 1 }}</strong></td>
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
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-action btn-view" data-id="{{ $production->id }}" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-action btn-edit" data-id="{{ $production->id }}" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-action btn-delete" data-id="{{ $production->id }}" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>