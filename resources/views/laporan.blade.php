<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Data Keseluruhan - Galaxy Bakery</title>
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

    <style>
        /* Custom styles for laporan page */
        .laporan-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 20px 0;
        }

        .laporan-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .laporan-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .laporan-header h1 {
            font-size: 3rem;
            font-weight: 800;
            margin: 0;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 2;
        }

        .laporan-header .subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-top: 10px;
            position: relative;
            z-index: 2;
        }

        .action-section {
            background: #f8fafc;
            padding: 30px;
            border-bottom: 1px solid #e2e8f0;
        }

        .search-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .section-header {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 25px 30px;
            margin: 0;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .section-header::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1));
        }

        .section-header h1 {
            margin: 0;
            font-weight: 700;
            font-size: 1.8rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .table-section {
            margin-bottom: 50px;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .table thead th {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            color: #1565c0;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            padding: 20px 15px;
            text-align: center;
            white-space: nowrap;
        }

        .table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #f1f5f9;
        }

        .table tbody tr:hover {
            background: linear-gradient(135deg, #f8faff 0%, #f0f7ff 100%);
            transform: scale(1.01);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .table tbody td {
            padding: 18px 15px;
            vertical-align: middle;
            border: none;
            font-size: 14px;
        }

        .badge {
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .bg-success {
            background: linear-gradient(135deg, #28a745, #20c997) !important;
        }

        .bg-warning {
            background: linear-gradient(135deg, #ffc107, #ff8f00) !important;
            color: #000 !important;
        }

        .bg-danger {
            background: linear-gradient(135deg, #dc3545, #c82333) !important;
        }

        .list-unstyled {
            margin: 0;
            padding: 0;
        }

        .list-unstyled li {
            background: #f8f9fa;
            padding: 6px 10px;
            margin: 3px 0;
            border-radius: 6px;
            border-left: 3px solid #667eea;
            font-size: 12px;
        }

        .demo-alert {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            color: #1565c0;
            border: none;
            border-radius: 15px;
            padding: 20px;
            margin: 20px 30px;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-completed {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
        }

        .status-planning {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            color: #856404;
        }

        .status-cancelled {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
        }

        .product-name {
            font-weight: 600;
            color: #2d3748;
        }

        .quantity-badge {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            color: #1565c0;
            padding: 4px 8px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 12px;
        }

        .batch-number {
            font-family: 'Courier New', monospace;
            background: #e9ecef;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        .production-cost {
            font-weight: 600;
            color: #28a745;
        }

        .bahan-list {
            max-width: 200px;
        }

        .bahan-item {
            background: #f8f9fa;
            padding: 4px 8px;
            margin: 2px 0;
            border-radius: 4px;
            border-left: 3px solid #f093fb;
            font-size: 11px;
        }

        .pagination {
            justify-content: center;
            margin: 30px 0;
        }

        .pagination .page-link {
            border-radius: 8px;
            margin: 0 4px;
            border: 2px solid #e2e8f0;
            color: #667eea;
            padding: 12px 16px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background: #667eea;
            border-color: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .laporan-container {
                margin: 10px;
                border-radius: 15px;
            }

            .laporan-header {
                padding: 30px 20px;
            }

            .laporan-header h1 {
                font-size: 2.2rem;
            }

            .action-section {
                padding: 20px;
            }

            .search-card {
                padding: 20px;
            }

            .table {
                font-size: 12px;
            }

            .table thead th,
            .table tbody td {
                padding: 12px 8px;
            }
        }

        /* Print styles */
        @media print {

            .main-sidebar,
            .mobile-menu-btn {
                display: none !important;
            }

            .content-wrapper {
                margin-left: 0 !important;
            }

            .action-section {
                display: none;
            }

            .pagination {
                display: none;
            }

            .table-section {
                break-inside: avoid;
                page-break-inside: avoid;
            }
        }
    </style>
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
                            <a href="/dashboard" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="/monitoring" class="nav-link">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>Bahan Baku<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/bahanbaku" class="nav-link">
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
                                    <a href="/produksiRoti" class="nav-link">
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
                            <a href="/laporan" class="nav-link active">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>Laporan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/pengeluaran" class="nav-link">
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
                            <a href="/customer" class="nav-link">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>Manajemen User<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/customer" class="nav-link">
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
                            <h1>Laporan Data Keseluruhan</h1>
                            <small>Comprehensive Data Report - Galaxy Bakery</small>
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
                <div class="laporan-container animate__animated animate__fadeIn">

                    <!-- Header Section -->
                    <div class="laporan-header">
                        <h1>Laporan Data Keseluruhan</h1>
                        <p class="subtitle">Galaxy Bakery - Comprehensive Data Report</p>
                    </div>
                    <!-- Action Section -->
                    <div class="action-section">
                        <div class="search-card">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <form class="mb-3 mb-lg-0">
                                        <label class="form-label font-weight-bold">
                                            <i class="fas fa-search mr-2"></i>Pencarian Data
                                        </label>
                                        <div class="input-group">
                                            <input type="text" name="keyword" class="form-control" placeholder="Cari data..." id="searchInput">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-primary" onclick="searchData()">
                                                    <i class="fas fa-search mr-2"></i>Cari
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-4 text-lg-right">
                                    <form action="{{ route('download') }}" method="GET" style="display: inline;">
                                        <input type="hidden" name="download" value="pdf">
                                        <button type="submit" class="btn btn-danger">Download PDF</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bahan Baku Section -->
                    <div class="table-section animate__animated animate__fadeInUp">
                        <div class="section-header">

                            <h1><i class="fas fa-boxes mr-3"></i>Laporan Bahan Baku</h1>
                        </div>
                        <div class="table-container">
                            <div class="table-responsive">
                                @if(count($bahanBakus) > 0)
                                <table class="table table-hover">
                                    <thead>
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
                        </div>
                    </div>

                    <!-- Riwayat Bahan Baku Section -->
                    <div class="table-section animate__animated animate__fadeInUp">
                        <div class="section-header">
                            <h1><i class="fas fa-history mr-3"></i>Riwayat Bahan Baku</h1>
                        </div>
                        <div class="table-container">
                            <div class="table-responsive">
                                @if(count($stokMovements) > 0)
                                <table class="table table-hover">
                                    <thead>
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
                        </div>
                    </div>

                    <!-- Laporan Produksi Section -->
                    <div class="table-section animate__animated animate__fadeInUp">
                        <div class="section-header">
                            <h1><i class="fas fa-industry mr-3"></i>Laporan Produksi</h1>
                        </div>
                        <div class="table-container">
                            <div class="table-responsive">
                                @if(count($productions) > 0)
                                <table class="table table-hover">
                                    <thead>
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
                        </div>
                    </div>

                    <!-- Riwayat Produksi Section -->
                    <div class="table-section animate__animated animate__fadeInUp">
                        <div class="section-header">
                            <h1><i class="fas fa-clipboard-list mr-3"></i>Riwayat Produksi</h1>
                        </div>
                        <div class="table-container">
                            @if(count($productionHistories) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
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
                        </div>
                    </div>

                    <!-- Laporan Penjualan -->
                    <div class="table-section animate__animated animate__fadeInUp">
                        <div class="section-header">
                            <h1><i class="fas fa-clipboard-list mr-3"></i>Laporan Penjualan</h1>
                        </div>
                        <div class="table-container">
                            @if(count($sales) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
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

                                            <td class="text-center">{{ $sale->customer->name ?? '-' }}</td>
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
                        </div>
                    </div>
                    <div class="table-section animate__animated animate__fadeInUp">
                        <div class="section-header">
                            <h1><i class="fas fa-clipboard-list mr-3"></i>Laporan Pengeluaran</h1>
                        </div>
                        <div class="table-container">
                            @if(count($expenses) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
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

    <!-- Custom JavaScript -->
    <script>
        // Search functionality
        function searchData() {
            const keyword = document.getElementById('searchInput').value.toLowerCase();
            const tables = document.querySelectorAll('.table tbody');

            tables.forEach(table => {
                const rows = table.querySelectorAll('tr');
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(keyword) || keyword === '') {
                        row.style.display = '';
                        row.classList.add('animate__animated', 'animate__fadeIn');
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }

        // Download PDF functionality
        function downloadPDF(event) {
            // Buat elemen link
            const link = document.createElement('a');
            link.href = '/laporan/download';
            link.download = 'Galaxy_Bakery_Report_' + new Date().toISOString().slice(0, 10) + '.pdf';

            // Tambahkan ke DOM agar bisa diklik
            document.body.appendChild(link);

            // Show loading state
            const btn = event.target.closest('button');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Generating PDF...';
            btn.disabled = true;

            // Jalankan aksi unduh
            link.click();

            // Bersihkan dan reset tombol
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.disabled = false;
                link.remove(); // Hapus elemen link setelah klik
            }, 2000);
        }


        // Auto search on input
        document.getElementById('searchInput').addEventListener('input', function() {
            clearTimeout(window.searchTimeout);
            window.searchTimeout = setTimeout(searchData, 300);
        });

        // Enhanced sidebar toggle - Same as dashboard
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

        // Real-time date and time updates
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

        // Initialize
        $(document).ready(function() {
            // Add hover effects to table rows
            $('.table tbody tr').hover(
                function() {
                    $(this).addClass('animate__animated animate__pulse animate__faster');
                },
                function() {
                    $(this).removeClass('animate__animated animate__pulse animate__faster');
                }
            );

            // Add click effect to buttons
            $('.btn').on('click', function() {
                $(this).addClass('animate__animated animate__pulse animate__faster');
                setTimeout(() => {
                    $(this).removeClass('animate__animated animate__pulse animate__faster');
                }, 500);
            });

            // Smooth scroll for internal links
            $('a[href^="#"]').on('click', function(event) {
                var target = $(this.getAttribute('href'));
                if (target.length) {
                    event.preventDefault();
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 100
                    }, 1000);
                }
            });
        });

        // Add loading animation on page elements
        window.addEventListener('load', function() {
            const sections = document.querySelectorAll('.table-section');
            sections.forEach((section, index) => {
                setTimeout(() => {
                    section.classList.add('animate__animated', 'animate__slideInUp');
                }, index * 200);
            });
        });

        // Start date/time updates
        updateDateTime();
        setInterval(updateDateTime, 1000);

        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Add smooth scrolling
        document.documentElement.style.scrollBehavior = 'smooth';
    </script>

</body>

</html>