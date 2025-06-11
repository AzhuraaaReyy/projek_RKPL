@extends('main')

@section('content-header')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header animate__animated animate__fadeInDown">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <h1>Monitoring Stok Bahan Baku</h1>
                    <small>Pantau ketersediaan bahan baku secara real-time</small>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="row mt-3 mt-lg-0">
                        <div class="col-12 mb-2">
                            <div class="header-info-box text-center">
                                <i class="fas fa-user-circle mr-2"></i>
                                <span class="font-weight-bold">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="header-info-box text-center">
                                <i class="fas fa-clock mr-2"></i>
                                <div class="font-weight-bold" id="currentTime"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="header-info-box text-center">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <div class="small" id="currentDate"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Status Overview -->
        <div class="row animate__animated animate__fadeInUp">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="info-box bg-success">
                    <span class="info-box-icon">
                        <i class="fas fa-check-circle"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Stok Aman</span>
                        <span class="info-box-number">{{ $stokAman ?? 0 }} <small>Item</small></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="info-box bg-warning">
                    <span class="info-box-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Stok Menipis</span>
                        <span class="info-box-number">{{ $stokMenurun ?? 0 }} <small>Item</small></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="info-box bg-danger">
                    <span class="info-box-icon">
                        <i class="fas fa-times-circle"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Stok Habis</span>
                        <span class="info-box-number">{{ $stokHabis ?? 2 }} <small>Item</small></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="info-box bg-info">
                    <span class="info-box-icon">
                        <i class="fas fa-boxes"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Item</span>
                        <span class="info-box-number">{{ $totalItem ?? 20 }} <small>Jenis</small></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter and Search Section -->
        <div class="row animate__animated animate__fadeInUp animate__delay-1s">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-filter mr-2"></i>
                            Filter & Pencarian
                        </h3>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('bahanBakus') }}">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Status Stok</label>
                                        <select name="status" class="form-control">
                                            <option value="">Semua Status</option>
                                            <option value="aman" {{ request('status') == 'aman' ? 'selected' : '' }}>Stok Aman</option>
                                            <option value="menipis" {{ request('status') == 'menipis' ? 'selected' : '' }}>Stok Menipis</option>
                                            <option value="habis" {{ request('status') == 'habis' ? 'selected' : '' }}>Stok Habis</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select name="kategori" class="form-control">
                                            <option value="">Semua Kategori</option>
                                            <option value="tepung" {{ request('kategori') == 'tepung' ? 'selected' : '' }}>Tepung</option>
                                            <option value="gula" {{ request('kategori') == 'gula' ? 'selected' : '' }}>Gula</option>
                                            <option value="telur" {{ request('kategori') == 'telur' ? 'selected' : '' }}>Telur</option>
                                            <option value="mentega" {{ request('kategori') == 'mentega' ? 'selected' : '' }}>Mentega</option>
                                            <option value="ragi" {{ request('kategori') == 'ragi' ? 'selected' : '' }}>Ragi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Cari Bahan</label>
                                        <input type="text" name="search" class="form-control" placeholder="Nama bahan..." value="{{ request('search') }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn btn-primary btn-block">
                                            <i class="fas fa-search mr-1"></i> Cari
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stok Table -->
        <div class="row animate__animated animate__fadeInUp animate__delay-2s">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="card-title">
                                    <i class="fas fa-warehouse mr-2"></i>
                                    Daftar Stok Bahan Baku
                                </h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm" onclick="refreshData()">
                                        <i class="fas fa-sync-alt mr-1"></i> Refresh
                                    </button>
                                    <a href="" class="btn btn-info btn-sm">
                                        <i class="fas fa-download mr-1"></i> Export
                                    </a>
                                    <a href="{{ route('bahan') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus mr-1"></i> Tambah Stok
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="stokTable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Nama Bahan</th>
                                        <th width="15%">Kategori</th>
                                        <th width="10%">Stok Saat Ini</th>
                                        <th width="10%">Stok Minimum</th>
                                        <th width="10%">Satuan</th>
                                        <th width="10%">Status</th>
                                        <th width="10%">Harga/Unit</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($bahanBakus as $index => $bahan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><strong>{{ $bahan->nama }}</strong></td>
                                            <td><span class="badge badge-secondary">{{ $bahan->kategori }}</span></td>
                                            <td class="text-center">{{ number_format($bahan->stok_saat_ini) }}</td>
                                            <td class="text-center">{{ number_format($bahan->stok_minimum) }}</td>
                                            <td class="text-center">{{ $bahan->satuan }}</td>
                                            <td class="text-center">
                                                <span class=""> z</span>
                                            </td>
                                            <td class="text-right">Rp {{ number_format($bahan->harga_per_unit, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-info btn-sm" onclick="showDetail({{ $bahan->id }})" title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <a href="" class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-success btn-sm" onclick="tambahStok({{ $bahan->id }})" title="Tambah Stok">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">
                                                <div class="alert alert-info mb-0">
                                                    <i class="fas fa-info-circle mr-2"></i>
                                                    Tidak ada data stok bahan baku
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if(isset($bahanBaku) && method_exists($bahanBaku, 'links'))
                            <div class="d-flex justify-content-center mt-3">
                                {{ $bahanBaku->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
//set waktu dan tanggal real time
        function updateDateTime() {
            const now = new Date();

            // Format waktu (jam:menit:detik)
            const time = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

            // Format tanggal (Hari, tanggal bulan tahun)
            const date = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });

            document.getElementById('currentTime').textContent = time;
            document.getElementById('currentDate').textContent = date;
        }

        // Jalankan saat pertama kali dan setiap 1 detik
        updateDateTime();
        setInterval(updateDateTime, 1000);

// Initialize Charts
document.addEventListener('DOMContentLoaded', function() {
    // Status Chart (Pie Chart)
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Stok Aman', 'Stok Menipis', 'Stok Habis'],
            datasets: [{
                data: [{{ $stokAman ?? 15 }}, {{ $stokMenurun ?? 3 }}, {{ $stokHabis ?? 2 }}],
                backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Kategori Chart (Bar Chart)
    const kategoriCtx = document.getElementById('kategoriChart').getContext('2d');
    new Chart(kategoriCtx, {
        type: 'bar',
        data: {
            labels: ['Tepung', 'Gula', 'Telur', 'Mentega', 'Ragi'],
            datasets: [{
                label: 'Jumlah Stok',
                data: [25, 5, 0, 15, 8],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(255, 205, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 205, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});

// Functions
function refreshData() {
    location.reload();
}

function showDetail(id) {
    // Ajax call to get detail data
    $.ajax({
        url: `/stok/${id}/detail`,
        method: 'GET',
        success: function(response) {
            $('#detailContent').html(response);
            $('#detailModal').modal('show');
        },
        error: function() {
            alert('Gagal memuat detail stok!');
        }
    });
}

function tambahStok(id) {
    // Ajax call to get bahan data
    $.ajax({
        url: `/stok/${id}/info`,
        method: 'GET',
        success: function(response) {
            $('#bahanId').val(response.id);
            $('#namaBahan').val(response.nama);
            $('#tambahStokModal').modal('show');
        },
        error: function() {
            alert('Gagal memuat data bahan!');
        }
    });
}

// Handle tambah stok form submission
$('#tambahStokForm').on('submit', function(e) {
    e.preventDefault();
    
    const formData = {
        bahan_id: $('#bahanId').val(),
        jumlah: $('#jumlahTambah').val(),
        keterangan: $('#keterangan').val(),
        _token: '{{ csrf_token() }}'
    };
    
    $.ajax({
        url: '{{ route("bahan") }}',
        method: 'POST',
        data: formData,
        success: function(response) {
            if(response.success) {
                $('#tambahStokModal').modal('hide');
                location.reload();
            } else {
                alert('Gagal menambah stok!');
            }
        },
        error: function() {
            alert('Terjadi kesalahan sistem!');
        }
    });
});
</script>
@endsection
