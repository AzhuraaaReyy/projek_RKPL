<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Input Produksi Bahan Baku - Galaxy Bakery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

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

            <div class="sidebar d-flex flex-column" style="height: calc(100vh - 70px);">
                <!-- User Panel -->
                <div class="user-panel d-flex align-items-center">
                    <div class="image">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6366f1&color=fff&size=128" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info ml-3">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="mt-2" style="flex: 1; overflow-y: auto;">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ route('production.stats') }}" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <a href="{{ route('inputbahan') }}" class="nav-link">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>Bahan Baku<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('inputbahan') }}" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Input Produksi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/riwayatBahanBaku" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Riwayat Produksi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-bread-slice"></i>
                                <p>Produksi Roti<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('productions') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Input Produksi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/riwayatProduksiRoti" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Riwayat Produksi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('laporan.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>Laporan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('pengeluaran') }}" class="nav-link">
                                <i class="nav-icon fas fa-wallet"></i>
                                <p>Pengeluaran</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/penjualan" class="nav-link">
                                <i class="nav-icon fas fa-receipt"></i>
                                <p>Penjualan</p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="{{ route('customers') }}" class="nav-link">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>Manajemen User<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('customers') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Hak Akses</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>

                <!-- Logout Button - Always at bottom -->
                <div class="sidebar-logout mt-auto">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

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
                                <span class="info-box-number">{{ $totalInputHariIni ?? 15 }} <small>Transaksi</small></span>
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
                                <span class="info-box-number">{{ $totalBarangMasuk ?? 125 }} <small>Kg</small></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="info-box bg-warning">
                            <span class="info-box-icon">
                                <i class="fas fa-dollar-sign"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Nilai Pembelian</span>
                                <span class="info-box-number">Rp {{ number_format($totalNilaiPembelian ?? 2500000, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="info-box bg-info">
                            <span class="info-box-icon">
                                <i class="fas fa-archive"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Jenis Bahan Aktif</span>
                                <span class="info-box-number">{{ $totalJenisBahan ?? 8 }} <small>Item</small></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="row animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-tools mr-2"></i>
                                    Aksi Cepat
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-primary btn-lg btn-block" onclick="showInputModal()">
                                            <i class="fas fa-plus-circle mr-2"></i>
                                            Input Bahan Baku Baru
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-success btn-lg btn-block" onclick="refreshData()">
                                            <i class="fas fa-sync-alt mr-2"></i>
                                            Refresh Data
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-info btn-lg btn-block" onclick="exportData()">
                                            <i class="fas fa-download mr-2"></i>
                                            Export Data
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ route('bahan') }}" class="btn btn-warning btn-lg btn-block">
                                            <i class="fas fa-warehouse mr-2"></i>
                                            Kelola Stok
                                        </a>
                                    </div>
                                </div>
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
                                <form method="GET" action="{{ route('inputbahan') }}">
                                    <div class="row">
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
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tanggal Dari</label>
                                                <input type="date" name="tanggal_dari" class="form-control" value="{{ request('tanggal_dari') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tanggal Sampai</label>
                                                <input type="date" name="tanggal_sampai" class="form-control" value="{{ request('tanggal_sampai') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
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
                                            <button type="button" class="btn btn-success btn-sm" onclick="refreshData()">
                                                <i class="fas fa-sync-alt mr-1"></i> Refresh
                                            </button>
                                            <button type="button" class="btn btn-info btn-sm" onclick="exportData()">
                                                <i class="fas fa-download mr-1"></i> Export
                                            </button>
                                            <button type="button" class="btn btn-primary btn-sm" onclick="showInputModal()">
                                                <i class="fas fa-plus mr-1"></i> Input Baru
                                            </button>
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
                                                <th width="10%">Jumlah</th>
                                                <th width="8%">Satuan</th>
                                                <th width="12%">Harga/Unit</th>
                                                <th width="10%">Total Nilai</th>
                                                <th width="10%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($riwayatInput ?? [] as $index => $input)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($input->tanggal_masuk ?? date('Y-m-d'))) }}</td>
                                                    <td><strong>{{ $input->nama_bahan ?? 'Tepung Terigu Premium' }}</strong></td>
                                                    <td><span class="badge badge-info">{{ ucfirst($input->kategori ?? 'tepung') }}</span></td>
                                                    <td class="text-center">{{ number_format($input->jumlah ?? 25, 2) }}</td>
                                                    <td class="text-center">{{ $input->satuan ?? 'kg' }}</td>
                                                    <td class="text-right">Rp {{ number_format($input->harga_per_unit ?? 15000, 0, ',', '.') }}</td>
                                                    <td class="text-right">Rp {{ number_format(($input->jumlah ?? 25) * ($input->harga_per_unit ?? 15000), 0, ',', '.') }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-sm">
                                                            <button type="button" class="btn btn-info btn-sm" onclick="showDetail({{ $input->id ?? 1 }})" title="Detail" data-toggle="tooltip">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-warning btn-sm" onclick="editData({{ $input->id ?? 1 }})" title="Edit" data-toggle="tooltip">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{ $input->id ?? 1 }})" title="Hapus" data-toggle="tooltip">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <!-- Sample Data untuk Demo -->
                                                <tr data-id="1">
                                                    <td>1</td>
                                                    <td>{{ date('d/m/Y') }}</td>
                                                    <td><strong>Tepung Terigu Premium</strong></td>
                                                    <td><span class="badge badge-info">Tepung</span></td>
                                                    <td class="text-center">25.00</td>
                                                    <td class="text-center">kg</td>
                                                    <td class="text-right">Rp 15,000</td>
                                                    <td class="text-right">Rp 375,000</td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-sm">
                                                            <button type="button" class="btn btn-info btn-sm" onclick="showDetail(1)" title="Detail" data-toggle="tooltip">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-warning btn-sm" onclick="editData(1)" title="Edit" data-toggle="tooltip">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteData(1)" title="Hapus" data-toggle="tooltip">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-id="2">
                                                    <td>2</td>
                                                    <td>{{ date('d/m/Y', strtotime('-1 day')) }}</td>
                                                    <td><strong>Gula Pasir</strong></td>
                                                    <td><span class="badge badge-warning">Gula</span></td>
                                                    <td class="text-center">10.00</td>
                                                    <td class="text-center">kg</td>
                                                    <td class="text-right">Rp 12,000</td>
                                                    <td class="text-right">Rp 120,000</td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-sm">
                                                            <button type="button" class="btn btn-info btn-sm" onclick="showDetail(2)" title="Detail" data-toggle="tooltip">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-warning btn-sm" onclick="editData(2)" title="Edit" data-toggle="tooltip">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteData(2)" title="Hapus" data-toggle="tooltip">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-id="3">
                                                    <td>3</td>
                                                    <td>{{ date('d/m/Y', strtotime('-2 days')) }}</td>
                                                    <td><strong>Telur Ayam Segar</strong></td>
                                                    <td><span class="badge badge-success">Telur</span></td>
                                                    <td class="text-center">5.00</td>
                                                    <td class="text-center">kg</td>
                                                    <td class="text-right">Rp 25,000</td>
                                                    <td class="text-right">Rp 125,000</td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-sm">
                                                            <button type="button" class="btn btn-info btn-sm" onclick="showDetail(3)" title="Detail" data-toggle="tooltip">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-warning btn-sm" onclick="editData(3)" title="Edit" data-toggle="tooltip">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteData(3)" title="Hapus" data-toggle="tooltip">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-id="4">
                                                    <td>4</td>
                                                    <td>{{ date('d/m/Y', strtotime('-3 days')) }}</td>
                                                    <td><strong>Mentega Tawar</strong></td>
                                                    <td><span class="badge badge-primary">Mentega</span></td>
                                                    <td class="text-center">2.50</td>
                                                    <td class="text-center">kg</td>
                                                    <td class="text-right">Rp 45,000</td>
                                                    <td class="text-right">Rp 112,500</td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-sm">
                                                            <button type="button" class="btn btn-info btn-sm" onclick="showDetail(4)" title="Detail" data-toggle="tooltip">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-warning btn-sm" onclick="editData(4)" title="Edit" data-toggle="tooltip">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteData(4)" title="Hapus" data-toggle="tooltip">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-id="5">
                                                    <td>5</td>
                                                    <td>{{ date('d/m/Y', strtotime('-4 days')) }}</td>
                                                    <td><strong>Ragi Instant</strong></td>
                                                    <td><span class="badge badge-secondary">Ragi</span></td>
                                                    <td class="text-center">0.50</td>
                                                    <td class="text-center">kg</td>
                                                    <td class="text-right">Rp 80,000</td>
                                                    <td class="text-right">Rp 40,000</td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-sm">
                                                            <button type="button" class="btn btn-info btn-sm" onclick="showDetail(5)" title="Detail" data-toggle="tooltip">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-warning btn-sm" onclick="editData(5)" title="Edit" data-toggle="tooltip">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteData(5)" title="Hapus" data-toggle="tooltip">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                {{-- Pagination --}}
                                @if(isset($riwayatInput) && method_exists($riwayatInput, 'links'))
                                    <div class="d-flex justify-content-center mt-3">
                                        {{ $riwayatInput->links() }}
                                    </div>
                                @endif
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
    <script>
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
            document.querySelector('.brand-link').addEventListener('click', function(e) {
                if (document.body.classList.contains('sidebar-collapse') && window.innerWidth > 768) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleSidebar();
                }
            });

            // Close mobile sidebar when clicking outside
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && document.body.classList.contains('sidebar-open')) {
                    if (!sidebar.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
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

            // Handle treeview menu
            document.querySelectorAll('.nav-item.has-treeview > .nav-link').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Don't open treeview when sidebar is collapsed
                    if (document.body.classList.contains('sidebar-collapse') && window.innerWidth > 768) {
                        return;
                    }

                    const navItem = this.parentElement;
                    const treeview = navItem.querySelector('.nav-treeview');
                    const icon = this.querySelector('.right');

                    if (treeview) {
                        // Toggle open state
                        navItem.classList.toggle('menu-open');

                        // Animate treeview
                        if (navItem.classList.contains('menu-open')) {
                            treeview.style.display = 'block';
                            treeview.style.maxHeight = '0';
                            treeview.style.overflow = 'hidden';
                            treeview.style.transition = 'max-height 0.3s ease';

                            // Calculate height
                            const height = treeview.scrollHeight;
                            setTimeout(() => {
                                treeview.style.maxHeight = height + 'px';
                            }, 10);

                            // Rotate icon
                            if (icon) {
                                icon.style.transform = 'rotate(-90deg)';
                            }
                        } else {
                            treeview.style.maxHeight = '0';

                            setTimeout(() => {
                                treeview.style.display = 'none';
                            }, 300);

                            // Rotate icon back
                            if (icon) {
                                icon.style.transform = 'rotate(0deg)';
                            }
                        }
                    }
                });
            });
        });

        // Set waktu dan tanggal real time
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

        // Enhanced info box animations
        document.querySelectorAll('.info-box').forEach(box => {
            box.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
                this.style.transition = 'all 0.3s ease';
            });

            box.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
                this.style.transition = 'all 0.3s ease';
            });
        });

        // Sample data untuk CRUD operations
        const sampleData = {
            1: {
                id: 1,
                nama_bahan: 'Tepung Terigu Premium',
                kategori: 'tepung',
                jumlah: 25.00,
                satuan: 'kg',
                harga_per_unit: 15000,
                stok_minimum: 10,
                supplier: 'PT. Tepung Jaya',
                tanggal_masuk: '{{ date("Y-m-d") }}',
                keterangan: 'Tepung berkualitas tinggi untuk produksi roti premium'
            },
            2: {
                id: 2,
                nama_bahan: 'Gula Pasir',
                kategori: 'gula',
                jumlah: 10.00,
                satuan: 'kg',
                harga_per_unit: 12000,
                stok_minimum: 5,
                supplier: 'CV. Manis Jaya',
                tanggal_masuk: '{{ date("Y-m-d", strtotime("-1 day")) }}',
                keterangan: 'Gula pasir halus untuk berbagai jenis roti'
            },
            3: {
                id: 3,
                nama_bahan: 'Telur Ayam Segar',
                kategori: 'telur',
                jumlah: 5.00,
                satuan: 'kg',
                harga_per_unit: 25000,
                stok_minimum: 2,
                supplier: 'Peternakan Sejahtera',
                tanggal_masuk: '{{ date("Y-m-d", strtotime("-2 days")) }}',
                keterangan: 'Telur ayam kampung segar untuk kualitas terbaik'
            },
            4: {
                id: 4,
                nama_bahan: 'Mentega Tawar',
                kategori: 'mentega',
                jumlah: 2.50,
                satuan: 'kg',
                harga_per_unit: 45000,
                stok_minimum: 1,
                supplier: 'Dairy Farm Indonesia',
                tanggal_masuk: '{{ date("Y-m-d", strtotime("-3 days")) }}',
                keterangan: 'Mentega berkualitas premium tanpa garam'
            },
            5: {
                id: 5,
                nama_bahan: 'Ragi Instant',
                kategori: 'ragi',
                jumlah: 0.50,
                satuan: 'kg',
                harga_per_unit: 80000,
                stok_minimum: 0.25,
                supplier: 'Fermentasi Nusantara',
                tanggal_masuk: '{{ date("Y-m-d", strtotime("-4 days")) }}',
                keterangan: 'Ragi instant berkualitas tinggi untuk pengembangan roti'
            }
        };

        // Function to show input modal
        function showInputModal() {
            // Reset form
            document.getElementById('inputBahanForm').reset();
            document.getElementById('tanggal_masuk').value = '{{ date("Y-m-d") }}';
            document.getElementById('stok_minimum').value = '10';
            document.getElementById('totalNilai').textContent = 'Rp 0';
            
            // Show modal
            $('#inputBahanModal').modal('show');
        }

        // Form submission handler
        $('#inputBahanForm').on('submit', function(e) {
            e.preventDefault();
            
            // Show loading state
            const submitBtn = $(this).find('button[type="submit"]');
            const originalHtml = submitBtn.html();
            submitBtn.html('<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...').prop('disabled', true);
            
            // Get form data
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            // Simulate API call
            setTimeout(() => {
                // Reset button
                submitBtn.html(originalHtml).prop('disabled', false);
                
                // Hide modal
                $('#inputBahanModal').modal('hide');
                
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data bahan baku berhasil disimpan.',
                    showConfirmButton: false,
                    timer: 2000
                });
                
                // Add new row to table (in real implementation, refresh from server)
                addNewRowToTable(data);
                
            }, 1500);
        });

        // Function to add new row to table
        function addNewRowToTable(data) {
            const tbody = document.querySelector('#inputBahanTable tbody');
            const newId = Object.keys(sampleData).length + 1;
            const total = (parseFloat(data.jumlah) || 0) * (parseFloat(data.harga_per_unit) || 0);
            
            const newRow = `
                <tr data-id="${newId}" class="animate__animated animate__fadeIn">
                    <td>${newId}</td>
                    <td>${new Date().toLocaleDateString('id-ID')}</td>
                    <td><strong>${data.nama_bahan}</strong></td>
                    <td><span class="badge badge-info">${data.kategori.charAt(0).toUpperCase() + data.kategori.slice(1)}</span></td>
                    <td class="text-center">${parseFloat(data.jumlah).toFixed(2)}</td>
                    <td class="text-center">${data.satuan}</td>
                    <td class="text-right">Rp ${parseInt(data.harga_per_unit).toLocaleString('id-ID')}</td>
                    <td class="text-right">Rp ${total.toLocaleString('id-ID')}</td>
                    <td class="text-center">
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-info btn-sm" onclick="showDetail(${newId})" title="Detail" data-toggle="tooltip">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" onclick="editData(${newId})" title="Edit" data-toggle="tooltip">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteData(${newId})" title="Hapus" data-toggle="tooltip">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
            
            tbody.insertAdjacentHTML('afterbegin', newRow);
            
            // Add to sample data
            sampleData[newId] = {
                id: newId,
                nama_bahan: data.nama_bahan,
                kategori: data.kategori,
                jumlah: parseFloat(data.jumlah),
                satuan: data.satuan,
                harga_per_unit: parseInt(data.harga_per_unit),
                stok_minimum: parseFloat(data.stok_minimum) || 10,
                supplier: data.supplier || '',
                tanggal_masuk: data.tanggal_masuk,
                keterangan: data.keterangan || ''
            };
            
            // Initialize tooltips for new row
            $('[data-toggle="tooltip"]').tooltip();
        }

        // Functions
        function refreshData() {
            // Show loading
            $('#inputBahanTable tbody').html('<tr><td colspan="9" class="text-center"><i class="fas fa-spinner fa-spin"></i> Memuat data...</td></tr>');
            
            // Simulate data refresh
            setTimeout(() => {
                location.reload();
            }, 1000);
        }

        function exportData() {
            Swal.fire({
                title: 'Export Data',
                html: `
                    <div class="text-left">
                        <p>Pilih format export:</p>
                        <div class="btn-group-vertical w-100">
                            <button class="btn btn-outline-success mb-2" onclick="exportToExcel()">
                                <i class="fas fa-file-excel mr-2"></i> Export ke Excel
                            </button>
                            <button class="btn btn-outline-danger mb-2" onclick="exportToPDF()">
                                <i class="fas fa-file-pdf mr-2"></i> Export ke PDF
                            </button>
                            <button class="btn btn-outline-info" onclick="exportToCSV()">
                                <i class="fas fa-file-csv mr-2"></i> Export ke CSV
                            </button>
                        </div>
                    </div>
                `,
                showConfirmButton: false,
                showCancelButton: true,
                cancelButtonText: 'Tutup'
            });
        }

        function exportToExcel() {
            Swal.fire('Info', 'Fitur export Excel sedang dalam pengembangan.', 'info');
        }

        function exportToPDF() {
            Swal.fire('Info', 'Fitur export PDF sedang dalam pengembangan.', 'info');
        }

        function exportToCSV() {
            Swal.fire('Info', 'Fitur export CSV sedang dalam pengembangan.', 'info');
        }

        function showDetail(id) {
            const data = sampleData[id];
            if (!data) {
                Swal.fire('Error', 'Data tidak ditemukan!', 'error');
                return;
            }

            const total = data.jumlah * data.harga_per_unit;
            const detailHtml = `
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>ID:</strong></td>
                                <td>${data.id}</td>
                            </tr>
                            <tr>
                                <td><strong>Nama Bahan:</strong></td>
                                <td>${data.nama_bahan}</td>
                            </tr>
                            <tr>
                                <td><strong>Kategori:</strong></td>
                                <td><span class="badge badge-info">${data.kategori.charAt(0).toUpperCase() + data.kategori.slice(1)}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Jumlah:</strong></td>
                                <td>${data.jumlah} ${data.satuan}</td>
                            </tr>
                            <tr>
                                <td><strong>Harga per Unit:</strong></td>
                                <td>Rp ${data.harga_per_unit.toLocaleString('id-ID')}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Total Nilai:</strong></td>
                                <td class="text-success font-weight-bold">Rp ${total.toLocaleString('id-ID')}</td>
                            </tr>
                            <tr>
                                <td><strong>Stok Minimum:</strong></td>
                                <td>${data.stok_minimum} ${data.satuan}</td>
                            </tr>
                            <tr>
                                <td><strong>Supplier:</strong></td>
                                <td>${data.supplier || '-'}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Masuk:</strong></td>
                                <td>${new Date(data.tanggal_masuk).toLocaleDateString('id-ID')}</td>
                            </tr>
                            <tr>
                                <td><strong>Keterangan:</strong></td>
                                <td>${data.keterangan || '-'}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            `;

            document.getElementById('detailContent').innerHTML = detailHtml;
            $('#detailModal').modal('show');
        }

        function editData(id) {
            const data = sampleData[id];
            if (!data) {
                Swal.fire('Error', 'Data tidak ditemukan!', 'error');
                return;
            }

            const editHtml = `
                <input type="hidden" name="id" value="${data.id}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="edit_nama_bahan">Nama Bahan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_nama_bahan" name="nama_bahan" value="${data.nama_bahan}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="edit_kategori">Kategori <span class="text-danger">*</span></label>
                            <select class="form-control" id="edit_kategori" name="kategori" required>
                                <option value="tepung" ${data.kategori === 'tepung' ? 'selected' : ''}>Tepung</option>
                                <option value="gula" ${data.kategori === 'gula' ? 'selected' : ''}>Gula</option>
                                <option value="telur" ${data.kategori === 'telur' ? 'selected' : ''}>Telur</option>
                                <option value="mentega" ${data.kategori === 'mentega' ? 'selected' : ''}>Mentega</option>
                                <option value="ragi" ${data.kategori === 'ragi' ? 'selected' : ''}>Ragi</option>
                                <option value="bumbu" ${data.kategori === 'bumbu' ? 'selected' : ''}>Bumbu & Rempah</option>
                                <option value="lainnya" ${data.kategori === 'lainnya' ? 'selected' : ''}>Lainnya</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="edit_jumlah">Jumlah <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="edit_jumlah" name="jumlah" step="0.01" min="0" value="${data.jumlah}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="edit_satuan">Satuan <span class="text-danger">*</span></label>
                            <select class="form-control" id="edit_satuan" name="satuan" required>
                                <option value="kg" ${data.satuan === 'kg' ? 'selected' : ''}>Kilogram (Kg)</option>
                                <option value="gram" ${data.satuan === 'gram' ? 'selected' : ''}>Gram (g)</option>
                                <option value="liter" ${data.satuan === 'liter' ? 'selected' : ''}>Liter (L)</option>
                                <option value="ml" ${data.satuan === 'ml' ? 'selected' : ''}>Mililiter (mL)</option>
                                <option value="pcs" ${data.satuan === 'pcs' ? 'selected' : ''}>Pieces (Pcs)</option>
                                <option value="pack" ${data.satuan === 'pack' ? 'selected' : ''}>Pack</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="edit_harga_per_unit">Harga per Unit <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" class="form-control" id="edit_harga_per_unit" name="harga_per_unit" step="1" min="0" value="${data.harga_per_unit}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="edit_stok_minimum">Stok Minimum</label>
                            <input type="number" class="form-control" id="edit_stok_minimum" name="stok_minimum" step="0.01" min="0" value="${data.stok_minimum}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="edit_supplier">Supplier</label>
                            <input type="text" class="form-control" id="edit_supplier" name="supplier" value="${data.supplier}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="edit_tanggal_masuk">Tanggal Masuk</label>
                            <input type="date" class="form-control" id="edit_tanggal_masuk" name="tanggal_masuk" value="${data.tanggal_masuk}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit_keterangan">Keterangan</label>
                            <textarea class="form-control" id="edit_keterangan" name="keterangan" rows="3">${data.keterangan}</textarea>
                        </div>
                    </div>
                </div>
            `;

            document.getElementById('editContent').innerHTML = editHtml;
            document.getElementById('editBahanForm').action = `/bahanbaku/${data.id}`;
            $('#editModal').modal('show');
        }

        // Handle edit form submission
        $('#editBahanForm').on('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = $(this).find('button[type="submit"]');
            const originalHtml = submitBtn.html();
            submitBtn.html('<i class="fas fa-spinner fa-spin mr-1"></i> Updating...').prop('disabled', true);
            
            // Get form data
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            const id = data.id;
            
            // Simulate API call
            setTimeout(() => {
                // Update sample data
                sampleData[id] = {
                    ...sampleData[id],
                    ...data,
                    jumlah: parseFloat(data.jumlah),
                    harga_per_unit: parseInt(data.harga_per_unit),
                    stok_minimum: parseFloat(data.stok_minimum)
                };
                
                // Update table row
                updateTableRow(id, sampleData[id]);
                
                // Reset button
                submitBtn.html(originalHtml).prop('disabled', false);
                
                // Hide modal
                $('#editModal').modal('hide');
                
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data bahan baku berhasil diupdate.',
                    showConfirmButton: false,
                    timer: 2000
                });
                
            }, 1500);
        });

        function updateTableRow(id, data) {
            const row = document.querySelector(`tr[data-id="${id}"]`);
            if (row) {
                const total = data.jumlah * data.harga_per_unit;
                row.innerHTML = `
                    <td>${data.id}</td>
                    <td>${new Date(data.tanggal_masuk).toLocaleDateString('id-ID')}</td>
                    <td><strong>${data.nama_bahan}</strong></td>
                    <td><span class="badge badge-info">${data.kategori.charAt(0).toUpperCase() + data.kategori.slice(1)}</span></td>
                    <td class="text-center">${parseFloat(data.jumlah).toFixed(2)}</td>
                    <td class="text-center">${data.satuan}</td>
                    <td class="text-right">Rp ${data.harga_per_unit.toLocaleString('id-ID')}</td>
                    <td class="text-right">Rp ${total.toLocaleString('id-ID')}</td>
                    <td class="text-center">
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-info btn-sm" onclick="showDetail(${data.id})" title="Detail" data-toggle="tooltip">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" onclick="editData(${data.id})" title="Edit" data-toggle="tooltip">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteData(${data.id})" title="Hapus" data-toggle="tooltip">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                `;
                
                // Re-initialize tooltips
                $('[data-toggle="tooltip"]').tooltip();
            }
        }

        function deleteData(id) {
            const data = sampleData[id];
            if (!data) {
                Swal.fire('Error', 'Data tidak ditemukan!', 'error');
                return;
            }

            Swal.fire({
                title: 'Hapus Data?',
                html: `Anda yakin ingin menghapus data <strong>"${data.nama_bahan}"</strong>?<br><small class="text-muted">Data yang dihapus tidak dapat dikembalikan!</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-trash mr-1"></i> Ya, Hapus!',
                cancelButtonText: '<i class="fas fa-times mr-1"></i> Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Menghapus...',
                        html: 'Sedang menghapus data, mohon tunggu.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Simulate API call
                    setTimeout(() => {
                        // Remove from sample data
                        delete sampleData[id];
                        
                        // Remove table row with animation
                        const row = document.querySelector(`tr[data-id="${id}"]`);
                        if (row) {
                            row.classList.add('animate__animated', 'animate__fadeOut');
                            setTimeout(() => {
                                row.remove();
                            }, 500);
                        }
                        
                        // Show success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus!',
                            text: 'Data berhasil dihapus.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }, 1500);
                }
            });
        }

        // Auto-calculate total when price or quantity changes
        $('#jumlah, #harga_per_unit, #edit_jumlah, #edit_harga_per_unit').on('input', function() {
            const isEdit = this.id.startsWith('edit_');
            const prefix = isEdit ? 'edit_' : '';
            
            const jumlah = parseFloat($(`#${prefix}jumlah`).val()) || 0;
            const harga = parseFloat($(`#${prefix}harga_per_unit`).val()) || 0;
            const total = jumlah * harga;
            
            if (!isEdit) {
                $('#totalNilai').text('Rp ' + total.toLocaleString('id-ID'));
            }
        });

        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Add smooth scrolling
        document.documentElement.style.scrollBehavior = 'smooth';
    </script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>