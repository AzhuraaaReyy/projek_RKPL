    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Riwayat Produksi Roti - Galaxy Bakery</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- AdminLTE, Bootstrap, FontAwesome -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Animate.css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">

        @include('lib.ext_css')

        <style>
            /* Custom styles untuk halaman riwayat produksi roti */
            .riwayat-content-header {
                background: linear-gradient(135deg, #ff9a56 0%, #ff6b6b 100%);
                color: white;
                border-radius: 15px;
                margin: 20px;
                padding: 30px;
                box-shadow: 0 10px 30px rgba(255, 154, 86, 0.3);
            }

            .riwayat-content-header h1 {
                font-weight: 700;
                margin: 0;
                font-size: 2.5rem;
            }

            .riwayat-content-header small {
                opacity: 0.9;
                font-size: 1.1rem;
            }

            .header-stats {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border-radius: 12px;
                padding: 20px;
                margin-top: 20px;
            }

            .stat-item {
                text-align: center;
                color: white;
            }

            .stat-number {
                font-size: 2rem;
                font-weight: 700;
                display: block;
            }

            .stat-label {
                font-size: 0.9rem;
                opacity: 0.8;
            }

            .main-card {
                background: white;
                border-radius: 20px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
                margin: 20px;
                overflow: hidden;
                border: none;
            }

            .card-header-custom {
                background: linear-gradient(135deg, #ff9a56 0%, #ff6b6b 100%);
                color: white;
                padding: 25px 30px;
                border: none;
            }

            .card-header-custom h3 {
                margin: 0;
                font-weight: 600;
                font-size: 1.5rem;
            }

            .filter-section {
                background: #f8fafc;
                padding: 25px 30px;
                border-bottom: 1px solid #e2e8f0;
            }

            .filter-card {
                background: white;
                border-radius: 12px;
                padding: 20px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
                border: 1px solid #e2e8f0;
            }

            .form-control {
                border-radius: 8px;
                border: 2px solid #e2e8f0;
                padding: 12px 16px;
                font-size: 14px;
                transition: all 0.3s ease;
            }

            .form-control:focus {
                border-color: #ff9a56;
                box-shadow: 0 0 0 3px rgba(255, 154, 86, 0.1);
            }

            .btn-filter {
                background: linear-gradient(135deg, #ff9a56 0%, #ff6b6b 100%);
                border: none;
                color: white;
                padding: 12px 25px;
                border-radius: 8px;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .btn-filter:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(255, 154, 86, 0.4);
                color: white;
            }

            .btn-reset {
                background: #6c757d;
                border: none;
                color: white;
                padding: 12px 25px;
                border-radius: 8px;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .btn-reset:hover {
                background: #5a6268;
                transform: translateY(-2px);
                color: white;
            }

            .table-container {
                padding: 0;
            }

            .table {
                margin: 0;
            }

            .table thead th {
                background: linear-gradient(135deg, #fff8e1 0%, #ffe0b2 100%);
                color: #e65100;
                font-weight: 600;
                font-size: 14px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                border: none;
                padding: 20px 15px;
            }

            .table tbody tr {
                transition: all 0.3s ease;
                border-bottom: 1px solid #f1f5f9;
            }

            .table tbody tr:hover {
                background: linear-gradient(135deg, #fff8f0 0%, #fff3e0 100%);
                transform: scale(1.01);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            }

            .table tbody td {
                padding: 18px 15px;
                vertical-align: middle;
                border: none;
                font-size: 14px;
            }

            .status-badge {
                padding: 8px 16px;
                border-radius: 25px;
                font-size: 12px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .status-planning {
                background: linear-gradient(135deg, #fff3cd, #ffeaa7);
                color: #856404;
            }

            .status-completed {
                background: linear-gradient(135deg, #d4edda, #c3e6cb);
                color: #155724;
            }

            .status-cancelled {
                background: linear-gradient(135deg, #f8d7da, #f5c6cb);
                color: #721c24;
            }

            .batch-number {
                font-family: 'Courier New', monospace;
                background: #e9ecef;
                padding: 6px 12px;
                border-radius: 6px;
                font-size: 13px;
                font-weight: 600;
            }

            .production-cost {
                font-weight: 600;
                color: #28a745;
                font-size: 15px;
            }

            .quantity-badge {
                background: linear-gradient(135deg, #e3f2fd, #bbdefb);
                color: #1565c0;
                padding: 6px 12px;
                border-radius: 15px;
                font-weight: 600;
                font-size: 13px;
            }

            .product-name {
                font-weight: 600;
                color: #2d3748;
                font-size: 15px;
            }

            .bahan-list {
                max-width: 250px;
            }

            .bahan-item {
                background: #f8f9fa;
                padding: 6px 10px;
                margin: 3px 0;
                border-radius: 6px;
                border-left: 3px solid #ff9a56;
                font-size: 12px;
            }

            .action-buttons {
                display: flex;
                gap: 8px;
                justify-content: center;
                flex-wrap: wrap;
            }

            .btn-action {
                padding: 8px 12px;
                border-radius: 6px;
                border: none;
                font-size: 12px;
                font-weight: 600;
                transition: all 0.3s ease;
                min-width: 40px;
            }

            .btn-view {
                background: linear-gradient(135deg, #17a2b8, #138496);
                color: white;
            }

            .btn-edit {
                background: linear-gradient(135deg, #ffc107, #e0a800);
                color: #212529;
            }

            .btn-delete {
                background: linear-gradient(135deg, #dc3545, #c82333);
                color: white;
            }

            .btn-action:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            }

            .empty-state {
                text-align: center;
                padding: 60px 30px;
                color: #64748b;
            }

            .empty-state i {
                font-size: 4rem;
                color: #cbd5e1;
                margin-bottom: 24px;
            }

            .detail-item {
                margin-bottom: 20px;
                padding: 15px;
                background: #f8fafc;
                border-radius: 8px;
                border-left: 4px solid #ff9a56;
            }

            .detail-item label {
                font-weight: 600;
                color: #475569;
                font-size: 14px;
                margin-bottom: 5px;
                display: block;
            }

            .detail-value {
                font-size: 16px;
                color: #1e293b;
                font-weight: 500;
            }

            .modal-content {
                border-radius: 15px;
                border: none;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            }

            .modal-header {
                border-radius: 15px 15px 0 0;
                border-bottom: none;
            }

            .modal-footer {
                border-top: 1px solid #e9ecef;
                border-radius: 0 0 15px 15px;
            }

            .pulse-dot {
                display: inline-block;
                width: 8px;
                height: 8px;
                border-radius: 50%;
                background: #10b981;
                animation: pulse 2s infinite;
                margin-right: 8px;
            }

            @keyframes pulse {
                0% {
                    transform: scale(0.95);
                    box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
                }

                70% {
                    transform: scale(1);
                    box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
                }

                100% {
                    transform: scale(0.95);
                    box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
                }
            }

            /* DataTables customization */
            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter,
            .dataTables_wrapper .dataTables_info,
            .dataTables_wrapper .dataTables_paginate {
                margin: 20px 0;
            }

            .dataTables_wrapper .dataTables_length select,
            .dataTables_wrapper .dataTables_filter input {
                border-radius: 8px;
                border: 2px solid #e2e8f0;
                padding: 8px 12px;
            }

            .pagination .page-link {
                border-radius: 8px;
                margin: 0 4px;
                border: 2px solid #e2e8f0;
                color: #ff9a56;
                padding: 12px 16px;
                font-weight: 600;
            }

            .pagination .page-link:hover {
                background: #ff9a56;
                border-color: #ff9a56;
                color: white;
                transform: translateY(-2px);
            }

            .pagination .page-item.active .page-link {
                background: linear-gradient(135deg, #ff9a56 0%, #ff6b6b 100%);
                border-color: #ff9a56;
            }

            @media (max-width: 768px) {
                .riwayat-content-header {
                    margin: 10px;
                    padding: 20px;
                }

                .riwayat-content-header h1 {
                    font-size: 2rem;
                }

                .main-card {
                    margin: 10px;
                    border-radius: 15px;
                }

                .filter-section {
                    padding: 20px 15px;
                }

                .action-buttons {
                    flex-direction: column;
                    gap: 4px;
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
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}&background=6366f1&color=fff&size=128" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info ml-3">
                            <a href="#" class="d-block">{{ Auth::user()->name ?? 'Admin User' }}</a>
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

                            <li class="nav-item has-treeview menu-open">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-bread-slice"></i>
                                    <p>Produksi Roti<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview" style="display: block;">
                                    <li class="nav-item">
                                        <a href="/produksiRoti" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Input Produksi</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/riwayatProduksiRoti" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Riwayat Produksi</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="/laporan" class="nav-link">
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

                    <!-- Logout Button -->
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
                            <div class="col-lg-8 col-md-12">
                                <h1><i class="fas fa-history mr-3"></i>Riwayat Produksi Roti</h1>
                                <small>Pantau dan analisis riwayat produksi roti Galaxy Bakery</small>
                            </div>
                            <div class="col-lg-4 col-md-12 mt-3 mt-lg-0">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <div class="header-info-box text-center">
                                            <i class="fas fa-user-circle mr-2"></i>
                                            <span class="font-weight-bold">{{ Auth::user()->name ?? 'Admin User' }}</span>
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
                    <!-- Stats Cards -->
                    <div class="row animate__animated animate__fadeInUp">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="info-box bg-primary">
                                <span class="info-box-icon">
                                    <i class="fas fa-list"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Riwayat</span>
                                    <span class="info-box-number">{{ count($productionHistories ?? []) }} <small>Records</small></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="info-box bg-success">
                                <span class="info-box-icon">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Selesai</span>
                                    <span class="info-box-number">{{$countCompleted}} <small>Items</small></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="info-box bg-warning">
                                <span class="info-box-icon">
                                    <i class="fas fa-clock"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Planning</span>
                                    <span class="info-box-number">{{ collect($productionHistories ?? [])->where('status', 'planning')->count() }} <small>Items</small></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="info-box bg-danger">
                                <span class="info-box-icon">
                                    <i class="fas fa-times-circle"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Dibatalkan</span>
                                    <span class="info-box-number">{{ collect($productionHistories ?? [])->where('status', 'cancelled')->count() }} <small>Items</small></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Card -->
                    <div class="main-card animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="card-header-custom">
                            <h3><i class="fas fa-table mr-2"></i>Data Riwayat Produksi Roti</h3>
                        </div>

                        <!-- Filter Section -->
                        <div class="filter-section">
                            <div class="filter-card">
                                <form method="GET" action="{{ route('filterByproduksi') }}" onsubmit="return validateFilterForm()">
                                    <div class="row">
                                        <!-- Tanggal Mulai -->
                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <label class="form-label font-weight-bold">
                                                <i class="fas fa-calendar-alt mr-1"></i>Tanggal Mulai
                                            </label>
                                            <input type="date" class="form-control" name="tanggal_dari" id="tanggal_dari" value="{{ request('tanggal_dari') }}">
                                        </div>

                                        <!-- Tanggal Akhir -->
                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <label class="form-label font-weight-bold">
                                                <i class="fas fa-calendar-alt mr-1"></i>Tanggal Akhir
                                            </label>
                                            <input type="date" class="form-control" name="tanggal_sampai" id="tanggal_sampai" value="{{ request('tanggal_sampai') }}">
                                        </div>

                                        <!-- Status Produksi -->
                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <label class="form-label font-weight-bold">
                                                <i class="fas fa-tasks mr-1"></i>Status Produksi
                                            </label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="">Semua Status</option>
                                                <option value="planning" {{ request('status') == 'planning' ? 'selected' : '' }}>Planning</option>
                                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </div>

                                        <!-- Jenis Produk (Roti) -->
                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <label class="form-label font-weight-bold">
                                                <i class="fas fa-bread-slice mr-1"></i>Produk Roti
                                            </label>
                                            <select class="form-control" name="product_type_id" id="productTypeId">
                                                <option value="">Semua Produk</option>
                                                @if(isset($productTypes))
                                                @foreach($productTypes as $type)
                                                <option value="{{ $type->id }}" {{ request('product_type_id') == $type->id ? 'selected' : '' }}>
                                                    {{ $type->name }}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 d-flex align-items-end">
                                            <button type="submit" class="btn btn-filter mr-2">
                                                <i class="fas fa-search mr-2"></i>Filter Data
                                            </button>
                                            <a href="/riwayatProduksiRoti" class="btn btn-reset">
                                                <i class="fas fa-refresh mr-2"></i>Reset Filter
                                            </a>
                                            <button type="button" class="btn btn-info ml-2" id="exportBtn">
                                                <i class="fas fa-download mr-2"></i>Export Excel
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <!-- Table Section -->
                        <div class="table-container">
                            <!-- Alert Messages -->
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mx-3 mt-3">
                                <i class="fas fa-check-circle mr-2"></i>
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                            </div>
                            @endif

                            @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mx-3 mt-3">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                            </div>
                            @endif

                            @if(isset($productionHistories) && count($productionHistories) > 0)
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

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($productionHistories as $index => $production)
                                        <tr>
                                            <td class="text-center"><strong>{{ $productionHistories->firstItem() + $index }}</strong></td>
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
                            </div>
                            @else
                            <!-- Empty State -->
                            <div class="empty-state">
                                <i class="fas fa-bread-slice"></i>
                                <h4>Belum Ada Riwayat Produksi</h4>
                                <p>Belum ada data riwayat produksi roti yang tercatat untuk filter yang dipilih.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="main-footer text-center">
                <strong>&copy; 2025 Galaxy Bakery</strong> - All rights reserved.
            </footer>
        </div>

        <!-- Detail Modal -->
        <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header" style="background: linear-gradient(135deg, #ff9a56 0%, #ff6b6b 100%); color: white;">
                        <h5 class="modal-title">
                            <i class="fas fa-info-circle mr-2"></i>Detail Produksi Roti
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" style="color: white;">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label>Nama Produk:</label>
                                    <div class="detail-value" id="detailProduct"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label>Batch Number:</label>
                                    <div class="detail-value" id="detailBatch"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label>Jumlah Produksi:</label>
                                    <div class="detail-value" id="detailQuantity"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label>Tanggal Produksi:</label>
                                    <div class="detail-value" id="detailDate"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label>Biaya Produksi:</label>
                                    <div class="detail-value" id="detailCost"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label>Status:</label>
                                    <div class="detail-value" id="detailStatus"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label>Dibuat Oleh:</label>
                                    <div class="detail-value" id="detailCreator"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label>Waktu Dibuat:</label>
                                    <div class="detail-value" id="detailCreatedAt"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="detail-item">
                                    <label>Bahan Baku yang Digunakan:</label>
                                    <div class="detail-value" id="detailIngredients"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="detail-item">
                                    <label>Catatan:</label>
                                    <div class="detail-value" id="detailNotes"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background: #dc3545; color: white;">
                        <h5 class="modal-title">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Konfirmasi Hapus
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" style="color: white;">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <i class="fas fa-trash-alt" style="font-size: 4rem; color: #dc3545; margin-bottom: 20px;"></i>
                        <h4>Apakah Anda yakin?</h4>
                        <p id="deleteConfirmText">Data riwayat produksi yang dihapus tidak dapat dikembalikan.</p>
                        <div class="alert alert-warning mt-3">
                            <i class="fas fa-info-circle mr-2"></i>
                            <strong>Data yang akan dihapus:</strong>
                            <div id="deleteItemInfo" class="mt-2"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-2"></i>Batal
                        </button>
                        <form method="POST" id="deleteForm" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" id="confirmDelete">
                                <i class="fas fa-trash mr-2"></i>Hapus Data
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

        <script>
            function validateFilterForm() {
                const dari = document.querySelector('input[name="tanggal_dari"]').value;
                const sampai = document.querySelector('input[name="tanggal_sampai"]').value;

                if (dari && sampai && dari > sampai) {
                    alert("Tanggal Dari tidak boleh lebih besar dari Tanggal Sampai.");
                    return false;
                }

                return true;
            }
            $(document).ready(function() {
                // Initialize DataTable
                const table = $('#productionHistoryTable').DataTable({
                    responsive: true,
                    pageLength: 10,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "Semua"]
                    ],
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
                    },
                    order: [
                        [4, 'desc']
                    ], // Order by production date descending
                    columnDefs: [ // Disable sorting for action column
                        {
                            targets: [6],
                            className: 'text-center'
                        }, // Center align ingredients
                        {
                            targets: [5],
                            className: 'text-right'
                        } // Right align cost
                    ],
                    drawCallback: function() {
                        $('[title]').tooltip();
                    }
                });

                // Enhanced sidebar toggle - same as dashboard
                const toggleButton = document.querySelector('[data-widget="pushmenu"]');
                const toggleIcon = document.getElementById('toggleIcon');
                const mobileMenuBtn = document.getElementById('mobileMenuBtn');
                const sidebar = document.querySelector('.main-sidebar');

                function toggleSidebar() {
                    const isMobile = window.innerWidth <= 768;

                    if (isMobile) {
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
                        document.body.classList.toggle('sidebar-collapse');
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

                    setTimeout(() => {
                        if (typeof table !== 'undefined') {
                            table.columns.adjust().draw();
                        }
                    }, 350);
                }

                // Sidebar event listeners
                if (toggleButton) {
                    toggleButton.addEventListener('click', function(e) {
                        e.preventDefault();
                        toggleSidebar();
                    });
                }

                if (mobileMenuBtn) {
                    mobileMenuBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        toggleSidebar();
                    });
                }

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

                // Handle treeview menu
                document.querySelectorAll('.nav-item.has-treeview > .nav-link').forEach(function(link) {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();

                        if (document.body.classList.contains('sidebar-collapse') && window.innerWidth > 768) {
                            return;
                        }

                        const navItem = this.parentElement;
                        const treeview = navItem.querySelector('.nav-treeview');
                        const icon = this.querySelector('.right');

                        if (treeview) {
                            navItem.classList.toggle('menu-open');

                            if (navItem.classList.contains('menu-open')) {
                                treeview.style.display = 'block';
                                treeview.style.maxHeight = '0';
                                treeview.style.overflow = 'hidden';
                                treeview.style.transition = 'max-height 0.3s ease';

                                const height = treeview.scrollHeight;
                                setTimeout(() => {
                                    treeview.style.maxHeight = height + 'px';
                                }, 10);

                                if (icon) {
                                    icon.style.transform = 'rotate(-90deg)';
                                }
                            } else {
                                treeview.style.maxHeight = '0';

                                setTimeout(() => {
                                    treeview.style.display = 'none';
                                }, 300);

                                if (icon) {
                                    icon.style.transform = 'rotate(0deg)';
                                }
                            }
                        }
                    });
                });

                // Real-time date and time updates - same as dashboard
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

                    document.getElementById('currentTime').textContent = time;
                    document.getElementById('currentDate').textContent = date;
                }

                updateDateTime();
                setInterval(updateDateTime, 1000);

                // Filter functionality
                $('#filterForm').on('submit', function(e) {
                    const submitBtn = $(this).find('button[type="submit"]');
                    const originalText = submitBtn.html();
                    submitBtn.html('<i class="fas fa-spinner fa-spin mr-2"></i>Memfilter...');

                    setTimeout(() => {
                        submitBtn.html(originalText);
                    }, 1000);
                });

                // View detail modal
                $(document).on('click', '.btn-view', function() {
                    const id = $(this).data('id');
                    const row = $(this).closest('tr');

                    $('#detailModal .modal-body').html(`
                    <div class="text-center py-4">
                        <i class="fas fa-spinner fa-spin fa-2x text-primary mb-3"></i>
                        <p>Memuat detail data...</p>
                    </div>
                `);
                    $('#detailModal').modal('show');

                    setTimeout(() => {
                        const detailData = {
                            product: row.find('td:eq(1)').text().trim(),
                            batch: row.find('td:eq(3)').text().trim(),
                            quantity: row.find('td:eq(2)').text().trim(),
                            date: row.find('td:eq(4)').text().trim(),
                            cost: row.find('td:eq(5)').text().trim(),
                            status: row.find('td:eq(8)').html(),
                            creator: row.find('td:eq(9)').text().trim(),
                            ingredients: row.find('td:eq(6)').html(),
                            notes: row.find('td:eq(7)').text().trim()
                        };

                        $('#detailModal .modal-body').html(`
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label>Nama Produk:</label>
                                    <div class="detail-value">${detailData.product}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label>Batch Number:</label>
                                    <div class="detail-value">${detailData.batch}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label>Jumlah Produksi:</label>
                                    <div class="detail-value">${detailData.quantity}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label>Tanggal Produksi:</label>
                                    <div class="detail-value">${detailData.date}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label>Biaya Produksi:</label>
                                    <div class="detail-value">${detailData.cost}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label>Status:</label>
                                    <div class="detail-value">${detailData.status}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label>Dibuat Oleh:</label>
                                    <div class="detail-value">${detailData.creator}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label>Waktu Dibuat:</label>
                                    <div class="detail-value">${new Date().toLocaleString('id-ID')}</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="detail-item">
                                    <label>Bahan Baku yang Digunakan:</label>
                                    <div class="detail-value">${detailData.ingredients}</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="detail-item">
                                    <label>Catatan:</label>
                                    <div class="detail-value">${detailData.notes}</div>
                                </div>
                            </div>
                        </div>
                    `);
                    }, 800);
                });

                // Edit functionality
                $(document).on('click', '.btn-edit', function() {
                    const id = $(this).data('id');
                    showNotification('info', `Fungsi edit akan mengarahkan ke halaman edit dengan ID: ${id}`);
                });

                // Delete functionality
                let deleteId = null;
                let deleteRowData = null;

                $(document).on('click', '.btn-delete', function(e) {
                    e.preventDefault();
                    deleteId = $(this).data('id');
                    deleteRowData = $(this).closest('tr');

                    const productName = deleteRowData.find('td:eq(1)').text().trim();
                    const batchNumber = deleteRowData.find('td:eq(3)').text().trim();
                    const quantity = deleteRowData.find('td:eq(2)').text().trim();
                    const date = deleteRowData.find('td:eq(4)').text().trim();

                    $('#deleteConfirmText').text(`Data riwayat produksi "${productName}" akan dihapus permanen.`);
                    $('#deleteItemInfo').html(`
                    <div class="row text-left">
                        <div class="col-6"><strong>Produk:</strong> ${productName}</div>
                        <div class="col-6"><strong>Batch:</strong> ${batchNumber}</div>
                        <div class="col-6"><strong>Jumlah:</strong> ${quantity}</div>
                        <div class="col-6"><strong>Tanggal:</strong> ${date}</div>
                    </div>
                `);

                    $('#deleteForm').attr('action', '/riwayatProduksiRoti/' + deleteId);
                    $('#deleteModal').modal('show');
                });

                // Handle delete form submission
                $('#deleteForm').on('submit', function(e) {
                    e.preventDefault();

                    const submitBtn = $('#confirmDelete');
                    const originalText = submitBtn.html();

                    submitBtn.html('<i class="fas fa-spinner fa-spin mr-2"></i>Menghapus...');
                    submitBtn.prop('disabled', true);

                    setTimeout(() => {
                        $('#deleteModal').modal('hide');
                        showNotification('success', 'Data berhasil dihapus!');

                        deleteRowData.fadeOut(500, function() {
                            $(this).remove();

                            if ($('#productionHistoryTable tbody tr:visible').length === 0) {
                                $('#productionHistoryTable').closest('.table-responsive').html(`
                                <div class="empty-state">
                                    <i class="fas fa-bread-slice"></i>
                                    <h4>Data Kosong</h4>
                                    <p>Tidak ada data yang tersisa.</p>
                                </div>
                            `);
                            }
                        });

                        submitBtn.html(originalText);
                        submitBtn.prop('disabled', false);
                    }, 1500);
                });

                // Export functionality
                $('#exportBtn').on('click', function() {
                    const btn = $(this);
                    const originalText = btn.html();

                    btn.html('<i class="fas fa-spinner fa-spin mr-2"></i>Mengexport...');
                    btn.prop('disabled', true);

                    setTimeout(() => {
                        showNotification('success', 'Data berhasil diexport ke Excel!');
                        btn.html(originalText);
                        btn.prop('disabled', false);
                    }, 2000);
                });

                // Notification function
                function showNotification(type, message) {
                    const alertClass = type === 'success' ? 'alert-success' :
                        type === 'error' ? 'alert-danger' : 'alert-info';
                    const iconClass = type === 'success' ? 'fa-check-circle' :
                        type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle';

                    const notification = $(`
                    <div class="alert ${alertClass} alert-dismissible fade show position-fixed animate__animated animate__bounceInRight" 
                         style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                        <i class="fas ${iconClass} mr-2"></i>
                        ${message}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                `);

                    $('body').append(notification);

                    setTimeout(() => {
                        notification.removeClass('animate__bounceInRight').addClass('animate__bounceOutRight');
                        setTimeout(() => notification.remove(), 500);
                    }, 3000);
                }

                // Initialize tooltips
                $('[title]').tooltip({
                    placement: 'top',
                    trigger: 'hover'
                });

                // Auto-dismiss alerts
                setTimeout(function() {
                    $('.alert').fadeOut('slow');
                }, 5000);

                // Keyboard shortcuts
                $(document).on('keydown', function(e) {
                    if (e.ctrlKey && e.key === 'f') {
                        e.preventDefault();
                        $('.dataTables_filter input').focus();
                    }

                    if (e.key === 'Escape') {
                        $('.modal').modal('hide');
                    }
                });

                // Responsive table adjustments
                $(window).on('resize', function() {
                    if ($.fn.DataTable.isDataTable('#productionHistoryTable')) {
                        table.columns.adjust().draw();
                    }
                });

                // CSRF Token setup for AJAX
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });
        </script>

    </body>

    </html>