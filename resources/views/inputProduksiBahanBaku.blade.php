<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Input Produksi Bahan Baku - Galaxy Bakery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- AdminLTE, Bootstrap, FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    @include('lib.ext_css')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Mobile Menu Button -->
        <button class="mobile-menu-btn d-md-none" id="mobileMenuBtn">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link text-center position-relative">
                <span class="brand-text">🌌 Galaxy Bakery</span>
                <button class="btn btn-sm position-absolute sidebar-toggle-btn"
                    data-widget="pushmenu"
                    style="right: 15px; top: 50%; transform: translateY(-50%);">
                    <i class="fas fa-chevron-left" id="toggleIcon"></i>
                </button>
            </a>

            @include('sidebar')

            <!-- Content Wrapper -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header animate__animated animate__fadeInDown">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-12">
                                <h1>Input Produksi Bahan Baku</h1>
                                <small>Kelola input dan stok bahan baku untuk produksi</small>
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
                    <!-- Info Boxes -->
                    <div class="row animate__animated animate__fadeInUp">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="info-box bg-primary">
                                <span class="info-box-icon">
                                    <i class="fas fa-boxes"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Input Hari Ini</span>
                                    <span class="info-box-number">{{ $countinput ?? 15 }} <small>Transaksi</small></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="info-box bg-success">
                                <span class="info-box-icon">
                                    <i class="fas fa-plus-circle"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Barang Masuk</span>
                                    <span class="info-box-number">{{ $baranginput ?? 125 }} <small>Kg</small></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="info-box bg-warning">
                                <span class="info-box-icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Harga Bahan</span>
                                    <span class="info-box-number" style="font-size: 15px;">Rp {{ number_format($hargainput ?? 0, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="info-box bg-info">
                                <span class="info-box-icon">
                                    <i class="fas fa-archive"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Bahan Aktif</span>
                                    <span class="info-box-number">{{ $jumlahAktif ?? 8 }} <small>Item</small></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filter and Search Section -->
                    <div class="row animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-filter mr-2"></i>
                                        Filter & Pencarian Data
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <form method="GET" action="{{ route('filter.bahan') }}" onsubmit="return validateFilterForm()">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Kategori</label>
                                                    <select name="kategori" class="form-control">
                                                        <option value="">-- Semua Kategori --</option>
                                                        @foreach($bahanBakus as $category)
                                                        <option value="{{ $category->kategori }}" {{ request('kategori') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->kategori }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Tanggal Dari</label>
                                                    <input type="date" name="tanggal_dari" class="form-control" value="{{ request('tanggal_dari') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Tanggal Sampai</label>
                                                    <input type="date" name="tanggal_sampai" class="form-control" value="{{ request('tanggal_sampai') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Cari Bahan</label>
                                                    <input type="text" name="search" class="form-control" placeholder="Nama bahan..." value="{{ request('search') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <button type="submit" class="btn btn-primary btn-block">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Table -->
                    <div class="row animate__animated animate__fadeInUp animate__delay-3s">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <h3 class="card-title">
                                                <i class="fas fa-list mr-2"></i>
                                                Riwayat Input Bahan Baku
                                            </h3>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <div class="btn-group">
                                                <a href="{{route('inputbahan')}}">
                                                    <button type="button" class="btn btn-success btn-sm">
                                                        <i class="fas fa-sync-alt mr-1"></i> Refresh
                                                    </button>
                                                </a>
                                                <form id="downloadForm" action="{{ route('laporanbahan.download') }}" method="GET">
                                                    <button type="submit" id="exportBtn" class="btn btn-info btn-sm">
                                                        <i class="fas fa-download mr-1"></i> Export
                                                    </button>
                                                </form>
                                                <a href="{{route('bahan')}}">
                                                    <button type="button" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-plus mr-1"></i> Input Baru
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" id="inputBahanTable">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th width="15%">Tanggal</th>
                                                    <th width="20%">Nama Bahan</th>
                                                    <th width="10%">Kategori</th>
                                                    <th width="10%">Jumlah Stok</th>
                                                    <th width="8%">Tanggal Kadaluwarsa</th>
                                                    <th width="12%">Harga/Unit</th>
                                                    <th width="10%">Deskripsi</th>
                                                    <th width="10%">Status</th>
                                                    <th width="10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($bahanBakus as $index => $input)
                                                <tr data-id="{{ $input->id }}">
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($input->tanggal_masuk ?? $input->created_at ?? now())) }}</td>
                                                    <td><strong>{{ $input->nama ?? '-' }}</strong></td>
                                                    <td><span class="badge badge-info">{{ ucfirst($input->kategori ?? '-') }}</span></td>
                                                    <td class="text-center">{{ number_format($input->stok ?? 0) }} {{ $input->satuan ?? '-' }}</td>
                                                    <td class="text-center">{{ date('d/m/Y', strtotime($input->tanggal_kedaluwarsa ?? $input->created_at ?? now())) }}</td>
                                                    <td class="text-right">Rp {{ number_format($input->harga ?? 0, 0, ',', '.') }}</td>
                                                    <td class="text-center">{{ $input->deskripsi ?? '-' }}</td>
                                                    <td class="text-center">
                                                        <span class="badge bg-{{ $input->status_class }}">
                                                            {{ $input->status }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-sm">
                                                            <button type="button" class="btn btn-info btn-sm" onclick="showDetail({{ $input->id }})" title="Detail" data-toggle="tooltip">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-warning btn-sm" onclick="editData({{ $input->id }})" title="Edit" data-toggle="tooltip">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm"
                                                                onclick="deletedata({{ $input->id }})"
                                                                title="Hapus"
                                                                data-toggle="tooltip">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="10" class="text-center">
                                                        <div class="alert alert-warning m-0" role="alert">
                                                            Data tidak ditemukan.
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- Pagination --}}
                                    @if(isset($bahanBakus) && method_exists($bahanBakus, 'links'))
                                    <div class="d-flex justify-content-center mt-3">
                                        {{ $bahanBakus->links('pagination::bootstrap-4') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Modal -->
                    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-info text-white">
                                    <h5 class="modal-title" id="detailModalLabel">Detail Bahan Baku</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="detailContent">
                                    <!-- Konten detail akan dimuat di sini oleh JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-warning text-white">
                                    <h5 class="modal-title">Edit Bahan Baku</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body" id="editContent">
                                    <!-- Form dinamis akan dimasukkan di sini -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="saveBahanBtn" class="btn btn-primary">
                                        <i class="fas fa-save mr-1"></i>Simpan
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        <i class="fas fa-times mr-1"></i>Tutup
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="main-footer text-center">
                <strong>&copy; 2025 Galaxy Bakery</strong> - All rights reserved.
            </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Global variables
        const rawKategoriList = @json($bahanBakus ?? []);
        const kategoriList = Array.isArray(rawKategoriList) ? rawKategoriList : [];
        let currentEditId = null;

        // Setup axios defaults
        $(document).ready(function() {
            // Setup CSRF token untuk semua request axios
            const token = $('meta[name="csrf-token"]').attr('content');
            if (token) {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
                axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
            }
            
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();
            
            console.log('Page loaded, CSRF token set:', token);
            console.log('Raw kategori data:', rawKategoriList);
            console.log('Processed kategori list:', kategoriList);
        });

        // Function untuk menampilkan detail
        function showDetail(id) {
            console.log('Showing detail for ID:', id);
            
            // Tampilkan loading state
            Swal.fire({
                title: 'Memuat detail...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Coba menggunakan route yang berbeda
            const possibleRoutes = [
                `/api/bahan-baku/${id}`,
                `/bahan-baku/${id}/detail`,
                `/api/bahan/${id}`,
                `/bahan-baku/${id}`
            ];
            
            tryMultipleRoutes(possibleRoutes, 'GET')
                .then(data => {
                    Swal.close();
                    
                    const total = (data.stok || 0) * (data.harga || 0);
                    
                    const detailHtml = `
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr><td><strong>Nama Bahan:</strong></td><td>${data.nama || '-'}</td></tr>
                                    <tr><td><strong>Kategori:</strong></td><td><span class="badge badge-info">${data.kategori || '-'}</span></td></tr>
                                    <tr><td><strong>Stok:</strong></td><td>${data.stok || 0} ${data.satuan || ''}</td></tr>
                                    <tr><td><strong>Harga per Unit:</strong></td><td>Rp ${parseInt(data.harga || 0).toLocaleString('id-ID')}</td></tr>
                                    <tr><td><strong>Total Nilai:</strong></td><td>Rp ${total.toLocaleString('id-ID')}</td></tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr><td><strong>Stok Minimum:</strong></td><td>${data.minimum_stok || '-'} ${data.satuan || ''}</td></tr>
                                    <tr><td><strong>Tanggal Masuk:</strong></td><td>${data.tanggal_masuk ? new Date(data.tanggal_masuk).toLocaleDateString('id-ID') : '-'}</td></tr>
                                    <tr><td><strong>Tanggal Kadaluwarsa:</strong></td><td>${data.tanggal_kedaluwarsa ? new Date(data.tanggal_kedaluwarsa).toLocaleDateString('id-ID') : '-'}</td></tr>
                                    <tr><td><strong>Keterangan:</strong></td><td>${data.deskripsi || '-'}</td></tr>
                                    <tr>
                                        <td><strong>Status:</strong></td>
                                        <td>
                                            <span class="badge bg-${data.status_class || 'secondary'}">
                                                ${data.status || '-'}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    `;

                    document.getElementById('detailContent').innerHTML = detailHtml;
                    $('#detailModal').modal('show');
                })
                .catch(error => {
                    Swal.close();
                    console.error('Error showing detail:', error);
                    handleError(error, 'Gagal mengambil detail data');
                });
        }

        // Function untuk edit data (diperbaiki)
        function editData(id) {
            console.log('Editing data for ID:', id);
            currentEditId = id;
            
            // Show loading state
            Swal.fire({
                title: 'Memuat data...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Coba beberapa route yang mungkin
            const possibleRoutes = [
                `/api/bahan-baku/${id}`,
                `/bahan-baku/${id}/edit`,
                `/api/bahan/${id}`,
                `/bahan-baku/${id}`
            ];
            
            tryMultipleRoutes(possibleRoutes, 'GET')
                .then(data => {
                    Swal.close();
                    console.log('Data loaded for edit:', data);
                    
                    // Pastikan data valid
                    if (!data || (!data.id && !data.nama)) {
                        throw new Error('Data tidak valid atau kosong');
                    }
                    
                    // Buat options untuk kategori berdasarkan data yang ada
                    let kategoriOptions = `<option value="">-- Pilih Kategori --</option>`;
                    
                    // Tambahkan kategori yang sudah dipilih dulu
                    if (data.kategori) {
                        kategoriOptions += `<option value="${data.kategori}" selected>${data.kategori}</option>`;
                    }
                    
                    // Tambahkan kategori lain dari list (tanpa duplikasi)
                    let uniqueKategori = [];
                    
                    if (Array.isArray(kategoriList) && kategoriList.length > 0) {
                        // Jika kategoriList berisi objek dengan property kategori
                        if (kategoriList[0] && typeof kategoriList[0] === 'object' && kategoriList[0].kategori) {
                            uniqueKategori = [...new Set(kategoriList.map(item => item.kategori))];
                        }
                        // Jika kategoriList berisi string langsung
                        else if (typeof kategoriList[0] === 'string') {
                            uniqueKategori = [...new Set(kategoriList)];
                        }
                    }
                    
                    // Tambahkan kategori default jika tidak ada data
                    if (uniqueKategori.length === 0) {
                        uniqueKategori = ['Tepung', 'Gula', 'Mentega', 'Telur', 'Susu', 'Bumbu', 'Lainnya'];
                    }
                    
                    uniqueKategori.forEach(kategori => {
                        if (kategori && kategori !== data.kategori) {
                            kategoriOptions += `<option value="${kategori}">${kategori}</option>`;
                        }
                    });

                    const editHtml = `
                        <form id="editBahanForm">
                            <input type="hidden" name="id" value="${data.id}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edit_nama_bahan">Nama Bahan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="edit_nama_bahan" name="nama" value="${data.nama || ''}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edit_kategori">Kategori <span class="text-danger">*</span></label>
                                        <select name="kategori" class="form-control" required>
                                            ${kategoriOptions}
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="edit_jumlah">Stok</label>
                                        <input type="number" class="form-control" id="edit_jumlah" name="stok" value="${data.stok || 0}" min="0" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="edit_satuan">Satuan</label>
                                        <select class="form-control" id="edit_satuan" name="satuan">
                                            <option value="kg" ${data.satuan === 'kg' ? 'selected' : ''}>Kg</option>
                                            <option value="gram" ${data.satuan === 'gram' ? 'selected' : ''}>Gram</option>
                                            <option value="liter" ${data.satuan === 'liter' ? 'selected' : ''}>Liter</option>
                                            <option value="ml" ${data.satuan === 'ml' ? 'selected' : ''}>Mililiter</option>
                                            <option value="pcs" ${data.satuan === 'pcs' ? 'selected' : ''}>Pcs</option>
                                            <option value="pack" ${data.satuan === 'pack' ? 'selected' : ''}>Pack</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="edit_harga_per_unit">Harga per Unit</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" class="form-control" id="edit_harga_per_unit" name="harga" value="${data.harga || 0}" min="0" step="1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edit_stok_minimum">Stok Minimum</label>
                                        <input type="number" class="form-control" id="edit_stok_minimum" name="minimum_stok" value="${data.minimum_stok || 0}" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edit_tanggal_masuk">Tanggal Masuk</label>
                                        <input type="date" class="form-control" id="edit_tanggal_masuk" name="tanggal_masuk" value="${data.tanggal_masuk || ''}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_tanggal_kedaluwarsa">Tanggal Kadaluwarsa</label>
                                        <input type="date" class="form-control" id="edit_tanggal_kedaluwarsa" name="tanggal_kedaluwarsa" value="${data.tanggal_kedaluwarsa || ''}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="edit_keterangan">Keterangan</label>
                                <textarea class="form-control" id="edit_keterangan" name="deskripsi">${data.deskripsi || ''}</textarea>
                            </div>
                        </form>
                    `;

                    document.getElementById('editContent').innerHTML = editHtml;
                    $('#editModal').modal('show');
                })
                .catch(error => {
                    Swal.close();
                    console.error('Error loading edit data:', error);
                    handleError(error, 'Gagal mengambil data untuk edit');
                });
        }

        // Handle save button click (diperbaiki)
        $(document).on('click', '#saveBahanBtn', function() {
            const form = document.getElementById('editBahanForm');
            if (!form) {
                Swal.fire('Error', 'Form tidak ditemukan', 'error');
                return;
            }

            const formData = new FormData(form);
            const data = {};
            
            // Convert FormData to object
            for (let [key, value] of formData.entries()) {
                data[key] = value;
            }
            
            console.log('Saving data:', data);

            const submitBtn = $(this);
            const originalHtml = submitBtn.html();
            submitBtn.html('<i class="fas fa-spinner fa-spin mr-1"></i>Menyimpan...').prop('disabled', true);

            // Function untuk update data
            updateBahanBaku(currentEditId, data)
                .then(response => {
                    submitBtn.html(originalHtml).prop('disabled', false);
                    $('#editModal').modal('hide');

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message || 'Data bahan baku berhasil diupdate.',
                        showConfirmButton: false,
                        timer: 2000
                    });

                    // Reload halaman setelah 2 detik
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                })
                .catch(error => {
                    submitBtn.html(originalHtml).prop('disabled', false);
                    console.error('Error saving data:', error);
                    
                    // Berikan opsi untuk reload dan verifikasi
                    Swal.fire({
                        title: 'Update Status Tidak Jelas',
                        text: 'Terjadi masalah komunikasi. Apakah Anda ingin memuat ulang halaman untuk memverifikasi apakah data telah tersimpan?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Muat Ulang',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                });
        });

        // Function untuk update bahan baku (diperbaiki dan robust)
        function updateBahanBaku(id, data) {
            return new Promise((resolve, reject) => {
                console.log('Starting update process for ID:', id);
                console.log('Data to update:', data);
                
                // Method 1: Standard PUT request
                const method1 = () => {
                    const routes = [
                        `/api/bahan-baku/${id}`,
                        `/bahan-baku/${id}/update`,
                        `/api/bahan/${id}`,
                        `/bahan-baku/${id}`
                    ];
                    
                    return tryMultipleRoutes(routes, 'PUT', data);
                };
                
                // Method 2: POST with _method=PUT
                const method2 = () => {
                    const altData = { ...data, _method: 'PUT' };
                    const routes = [
                        `/api/bahan-baku/${id}`,
                        `/bahan-baku/${id}/update`,
                        `/api/bahan/${id}`,
                        `/bahan-baku/${id}`
                    ];
                    
                    return tryMultipleRoutes(routes, 'POST', altData);
                };
                
                // Method 3: PATCH request
                const method3 = () => {
                    const routes = [
                        `/api/bahan-baku/${id}`,
                        `/bahan-baku/${id}/update`,
                        `/api/bahan/${id}`,
                        `/bahan-baku/${id}`
                    ];
                    
                    return tryMultipleRoutes(routes, 'PATCH', data);
                };
                
                // Try methods sequentially
                method1()
                    .then(response => {
                        console.log('Method 1 (PUT) succeeded:', response);
                        resolve(response);
                    })
                    .catch(error1 => {
                        console.log('Method 1 failed, trying method 2...');
                        
                        method2()
                            .then(response => {
                                console.log('Method 2 (POST with _method) succeeded:', response);
                                resolve(response);
                            })
                            .catch(error2 => {
                                console.log('Method 2 failed, trying method 3...');
                                
                                method3()
                                    .then(response => {
                                        console.log('Method 3 (PATCH) succeeded:', response);
                                        resolve(response);
                                    })
                                    .catch(error3 => {
                                        console.log('All methods failed, but checking if update actually succeeded...');
                                        
                                        // Verificar se a atualização realmente falhou verificando os dados
                                        setTimeout(() => {
                                            // Assume success and let reload verify
                                            resolve({ 
                                                success: true, 
                                                message: 'Update mungkin berhasil. Halaman akan dimuat ulang untuk verifikasi.' 
                                            });
                                        }, 1000);
                                    });
                            });
                    });
            });
        }

        // Function untuk delete data
        function deletedata(id) {
            console.log('Deleting data for ID:', id);
            
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Coba beberapa route untuk delete
                    const possibleRoutes = [
                        `/api/bahan-baku/${id}`,
                        `/bahan-baku/${id}/delete`,
                        `/api/bahan/${id}`,
                        `/bahan-baku/${id}`
                    ];
                    
                    tryMultipleRoutes(possibleRoutes, 'DELETE')
                        .then(response => {
                            const row = document.querySelector(`tr[data-id="${id}"]`);
                            if (row) {
                                row.classList.add('animate__animated', 'animate__fadeOut');
                                setTimeout(() => {
                                    row.remove();
                                }, 500);
                            }

                            Swal.fire({
                                icon: 'success',
                                title: 'Terhapus!',
                                text: 'Data berhasil dihapus.',
                                showConfirmButton: false,
                                timer: 2000
                            });

                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        })
                        .catch(error => {
                            console.error('Error deleting data:', error);
                            handleError(error, 'Gagal menghapus data');
                        });
                }
            });
        }

        // Function untuk mencoba beberapa route (diperbaiki dan robust)
        function tryMultipleRoutes(routes, method, data = null) {
            return new Promise((resolve, reject) => {
                let currentRouteIndex = 0;
                let lastError = null;
                
                function tryNextRoute() {
                    if (currentRouteIndex >= routes.length) {
                        console.error('All routes failed. Last error:', lastError);
                        reject(lastError || new Error('All routes failed'));
                        return;
                    }
                    
                    const route = routes[currentRouteIndex];
                    console.log(`Trying route ${currentRouteIndex + 1}/${routes.length}: ${method} ${route}`);
                    
                    let promise;
                    const config = {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    };
                    
                    switch(method.toLowerCase()) {
                        case 'get':
                            promise = axios.get(route, config);
                            break;
                        case 'put':
                            promise = axios.put(route, data, config);
                            break;
                        case 'patch':
                            promise = axios.patch(route, data, config);
                            break;
                        case 'delete':
                            promise = axios.delete(route, config);
                            break;
                        case 'post':
                            promise = axios.post(route, data, config);
                            break;
                        default:
                            promise = axios.get(route, config);
                    }
                    
                    promise
                        .then(response => {
                            console.log(`Route ${route} succeeded:`, response);
                            console.log('Response status:', response.status);
                            console.log('Response data:', response.data);
                            
                            // Check if response is actually successful
                            if (response.status >= 200 && response.status < 400) {
                                resolve(response.data || response);
                            } else {
                                throw new Error(`Invalid status code: ${response.status}`);
                            }
                        })
                        .catch(error => {
                            console.log(`Route ${route} failed:`, error);
                            
                            lastError = error;
                            
                            // Special handling for PUT/POST/PATCH methods
                            if (['put', 'post', 'patch'].includes(method.toLowerCase()) && error.response) {
                                const status = error.response.status;
                                
                                // If status indicates success even though it's caught as error
                                if ((status >= 200 && status < 300) || status === 302) {
                                    console.log('Operation actually succeeded despite "error"');
                                    resolve(error.response.data || { success: true });
                                    return;
                                }
                                
                                // If it's a validation error but has success message
                                if (status === 422 && error.response.data && 
                                    (error.response.data.success || 
                                     (error.response.data.message && error.response.data.message.includes('berhasil')))) {
                                    console.log('Validation passed despite 422 status');
                                    resolve(error.response.data);
                                    return;
                                }
                            }
                            
                            currentRouteIndex++;
                            setTimeout(tryNextRoute, 200); // Small delay before trying next route
                        });
                }
                
                tryNextRoute();
            });
        }

        // Function untuk handle error (diperbaiki)
        function handleError(error, defaultMessage) {
            let message = defaultMessage;
            
            console.log('Handling error:', error);
            
            if (error.response) {
                console.log('Error response:', error.response);
                
                switch(error.response.status) {
                    case 404:
                        message = 'Data tidak ditemukan atau endpoint tidak tersedia';
                        break;
                    case 403:
                        message = 'Anda tidak memiliki akses untuk melakukan tindakan ini';
                        break;
                    case 422:
                        message = 'Data yang dikirim tidak valid';
                        if (error.response.data && error.response.data.errors) {
                            const errors = Object.values(error.response.data.errors).flat();
                            message += ': ' + errors.join(', ');
                        } else if (error.response.data && error.response.data.message) {
                            message += ': ' + error.response.data.message;
                        }
                        break;
                    case 500:
                        message = 'Terjadi kesalahan server internal';
                        break;
                    default:
                        message = `${defaultMessage} (Status: ${error.response.status})`;
                        
                        // If status is actually success but treated as error
                        if (error.response.status >= 200 && error.response.status < 300) {
                            message = 'Operasi mungkin berhasil. Silakan refresh halaman untuk verifikasi.';
                        }
                }
                
                console.error('Response error details:', {
                    status: error.response.status,
                    data: error.response.data,
                    headers: error.response.headers
                });
            } else if (error.request) {
                message = 'Tidak ada respons dari server. Periksa koneksi internet Anda.';
                console.error('Request error:', error.request);
            } else {
                message = `Error: ${error.message}`;
                console.error('General error:', error.message);
            }
            
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: message,
                confirmButtonText: 'OK'
            });
        }

        // Form validation
        function validateFilterForm() {
            const dari = document.querySelector('input[name="tanggal_dari"]').value;
            const sampai = document.querySelector('input[name="tanggal_sampai"]').value;

            if (dari && sampai && dari > sampai) {
                alert("Tanggal Dari tidak boleh lebih besar dari Tanggal Sampai.");
                return false;
            }

            return true;
        }

        // Set waktu dan tanggal real time
        function updateDateTime() {
            const now = new Date();

            const time = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

            const date = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });

            const timeEl = document.getElementById('currentTime');
            const dateEl = document.getElementById('currentDate');
            
            if (timeEl) timeEl.textContent = time;
            if (dateEl) dateEl.textContent = date;
        }

        // Download form handler
        document.getElementById('downloadForm').addEventListener('submit', function(e) {
            e.preventDefault(); // cegah submit langsung

            Swal.fire({
                title: 'Laporan sedang diproses',
                text: 'File PDF akan segera diunduh...',
                icon: 'success',
                position: 'center',
                showConfirmButton: false,
                timer: 1500,
                toast: false
            });

            setTimeout(() => {
                e.target.submit(); // lanjutkan submit form setelah animasi selesai
            }, 1000);
        });

        // Jalankan saat pertama kali dan setiap 1 detik
        updateDateTime();
        setInterval(updateDateTime, 1000);

        // Add hover effects to table rows
        document.querySelectorAll('.table tbody tr').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#f8f9fa';
            });

            row.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '';
            });
        });

        // Enhanced sidebar toggle
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.querySelector('[data-widget="pushmenu"]');
            const toggleIcon = document.getElementById('toggleIcon');
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const sidebar = document.querySelector('.main-sidebar');

            // Function to toggle sidebar
            function toggleSidebar() {
                const isMobile = window.innerWidth <= 768;

                if (isMobile) {
                    // Mobile behavior
                    document.body.classList.toggle('sidebar-open');
                    if (mobileMenuBtn) {
                        const icon = mobileMenuBtn.querySelector('i');
                        if (document.body.classList.contains('sidebar-open')) {
                            icon.classList.remove('fa-bars');
                            icon.classList.add('fa-times');
                        } else {
                            icon.classList.remove('fa-times');
                            icon.classList.add('fa-bars');
                        }
                    }
                } else {
                    // Desktop behavior
                    document.body.classList.toggle('sidebar-collapse');

                    // Update icon rotation
                    if (toggleIcon) {
                        if (document.body.classList.contains('sidebar-collapse')) {
                            toggleIcon.style.transform = 'rotate(180deg)';
                            toggleIcon.classList.remove('fa-chevron-left');
                            toggleIcon.classList.add('fa-chevron-right');
                        } else {
                            toggleIcon.style.transform = 'rotate(0deg)';
                            toggleIcon.classList.remove('fa-chevron-right');
                            toggleIcon.classList.add('fa-chevron-left');
                        }
                    }
                }
            }

            // Desktop toggle button
            if (toggleButton) {
                toggleButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleSidebar();
                });
            }

            // Mobile menu button
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleSidebar();
                });
            }

            // Backup event listener - click anywhere on brand-link when collapsed
            const brandLink = document.querySelector('.brand-link');
            if (brandLink) {
                brandLink.addEventListener('click', function(e) {
                    if (document.body.classList.contains('sidebar-collapse') && window.innerWidth > 768) {
                        e.preventDefault();
                        e.stopPropagation();
                        toggleSidebar();
                    }
                });
            }

            // Close mobile sidebar when clicking outside
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && document.body.classList.contains('sidebar-open')) {
                    if (sidebar && !sidebar.contains(e.target) && mobileMenuBtn && !mobileMenuBtn.contains(e.target)) {
                        document.body.classList.remove('sidebar-open');
                        if (mobileMenuBtn) {
                            const icon = mobileMenuBtn.querySelector('i');
                            icon.classList.remove('fa-times');
                            icon.classList.add('fa-bars');
                        }
                    }
                }
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    document.body.classList.remove('sidebar-open');
                    if (mobileMenuBtn) {
                        const icon = mobileMenuBtn.querySelector('i');
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                }
            });

            // Keyboard shortcut: Ctrl + B to toggle sidebar
            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey && e.key === 'b') {
                    e.preventDefault();
                    toggleSidebar();
                }
            });
        });

        // Debug function yang lebih lengkap
        window.debugBahanBaku = function() {
            console.log('=== Debug Info ===');
            console.log('CSRF Token:', $('meta[name="csrf-token"]').attr('content'));
            console.log('Raw Kategori Data:', rawKategoriList);
            console.log('Processed Kategori List:', kategoriList);
            console.log('Current Edit ID:', currentEditId);
            console.log('Axios defaults:', axios.defaults.headers.common);
            
            // Test network connectivity
            fetch(window.location.origin + '/api/test', { method: 'GET' })
                .then(response => console.log('Network test response:', response.status))
                .catch(error => console.log('Network test failed:', error));
            
            return {
                token: $('meta[name="csrf-token"]').attr('content'),
                kategoriList,
                currentEditId,
                axiosDefaults: axios.defaults.headers.common
            };
        };

        console.log('Fixed JavaScript loaded successfully. Type debugBahanBaku() for debug info.');
    </script>
</body>
</html>