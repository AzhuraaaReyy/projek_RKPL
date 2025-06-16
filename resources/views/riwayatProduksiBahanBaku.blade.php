{{-- riwayatProduksiBahanBaku.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Riwayat Produksi Bahan Baku - Galaxy Bakery</title>
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

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">

    @include('lib.ext_css')

    <style>
        /* Content area adjustments */
        .content-wrapper {
            margin-left: 250px !important;
            transition: margin-left 0.3s ease !important;
            min-height: 100vh;
        }

        /* Mobile menu button improvements */
        .mobile-menu-btn {
            position: fixed !important;
            top: 15px !important;
            left: 15px !important;
            z-index: 1050 !important;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: white !important;
            border: none !important;
            padding: 12px 14px !important;
            border-radius: 8px !important;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4) !important;
            transition: all 0.3s ease !important;
            display: none !important;
        }

        .mobile-menu-btn:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6) !important;
        }

        /* Sidebar collapsed state */
        .sidebar-collapse .main-sidebar {
            width: 70px !important;
        }

        .sidebar-collapse .content-wrapper {
            margin-left: 70px !important;
        }

        .sidebar-collapse .brand-text {
            display: none !important;
        }

        .sidebar-collapse .sidebar-toggle-btn {
            margin: 0 auto !important;
        }

        .sidebar-collapse .user-panel .info,
        .sidebar-collapse .nav-sidebar .nav-link p,
        .sidebar-collapse .sidebar-logout span {
            display: none !important;
        }

        .sidebar-collapse .nav-treeview {
            display: none !important;
        }

        .sidebar-collapse .nav-sidebar .nav-link {
            text-align: center !important;
            padding: 12px 10px !important;
        }

        .sidebar-collapse .nav-sidebar .nav-icon {
            margin-right: 0 !important;
        }

        .sidebar-collapse .right {
            display: none !important;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .main-sidebar {
                transform: translateX(-100%) !important;
                width: 250px !important;
            }

            .content-wrapper {
                margin-left: 0 !important;
            }

            .mobile-menu-btn {
                display: block !important;
            }

            .sidebar-open .main-sidebar {
                transform: translateX(0) !important;
            }

            .sidebar-open::before {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1038;
            }
        }

        /* Smooth animations */
        * {
            transition: none !important;
        }

        .main-sidebar,
        .content-wrapper,
        .nav-link,
        .btn {
            transition: all 0.3s ease !important;
        }

        /* Custom styles untuk halaman riwayat bahan baku */
        .riwayat-content-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            margin: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
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
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
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
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn-filter {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-filter:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
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
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            color: #1565c0;
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

        .movement-badge {
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .movement-in {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
        }

        .movement-out {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
        }

        .movement-adjustment {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            color: #856404;
        }

        .quantity-cell {
            font-weight: 600;
            font-size: 16px;
        }

        .quantity-positive {
            color: #28a745;
        }

        .quantity-negative {
            color: #dc3545;
        }

        .notes-cell {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
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

        .empty-state h4 {
            color: #475569;
            margin-bottom: 12px;
        }

        .detail-item {
            margin-bottom: 20px;
            padding: 15px;
            background: #f8fafc;
            border-radius: 8px;
            border-left: 4px solid #667eea;
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
            color: #667eea;
            padding: 12px 16px;
            font-weight: 600;
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
     @include('sidebar')

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="riwayat-content-header animate__animated animate__fadeInDown">
                <div class="row align-items-center">
                    <div class="col-lg-8 col-md-12">
                        <h1><i class="fas fa-history mr-3"></i>Riwayat Produksi Bahan Baku</h1>
                        <small>Pantau semua pergerakan stok bahan baku dengan detail</small>
                    </div>
                    <div class="col-lg-4 col-md-12 mt-3 mt-lg-0">
                        <div class="header-stats">
                            <div class="row">
                                <div class="col-6">
                                    <div class="stat-item">
                                        <span class="stat-number">{{ count($stokMovements ?? []) }}</span>
                                        <span class="stat-label">Pergerakan Stok</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="stat-item">
                                        <span class="pulse-dot"></span>
                                        <span class="stat-label">Live Updates</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="content">
                <div class="main-card animate__animated animate__fadeInUp">
                    <div class="card-header-custom">
                        <h3><i class="fas fa-table mr-2"></i>Data Riwayat Pergerakan Stok</h3>
                    </div>

                    <!-- Filter Section -->
                    <div class="filter-section">
                        <div class="filter-card">
                            <form method="GET" id="filterForm">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 mb-3">
                                        <label class="form-label font-weight-bold">
                                            <i class="fas fa-calendar-alt mr-1"></i>Tanggal Mulai
                                        </label>
                                        <input type="date" class="form-control" name="start_date" id="startDate" value="{{ request('start_date') }}">
                                    </div>
                                    <div class="col-lg-3 col-md-6 mb-3">
                                        <label class="form-label font-weight-bold">
                                            <i class="fas fa-calendar-alt mr-1"></i>Tanggal Akhir
                                        </label>
                                        <input type="date" class="form-control" name="end_date" id="endDate" value="{{ request('end_date') }}">
                                    </div>
                                    <div class="col-lg-3 col-md-6 mb-3">
                                        <label class="form-label font-weight-bold">
                                            <i class="fas fa-exchange-alt mr-1"></i>Jenis Pergerakan
                                        </label>
                                        <select class="form-control" name="movement_type" id="movementType">
                                            <option value="">Semua Jenis</option>
                                            <option value="in" {{ request('movement_type') == 'in' ? 'selected' : '' }}>Masuk</option>
                                            <option value="out" {{ request('movement_type') == 'out' ? 'selected' : '' }}>Keluar</option>
                                            <option value="adjustment" {{ request('movement_type') == 'adjustment' ? 'selected' : '' }}>Penyesuaian</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-6 mb-3">
                                        <label class="form-label font-weight-bold">
                                            <i class="fas fa-cube mr-1"></i>Bahan Baku
                                        </label>
                                        <select class="form-control" name="bahan_baku_id" id="bahanBakuId">
                                            <option value="">Semua Bahan</option>
                                            <!-- Data ini akan diisi dari controller -->
                                            <option value="1">Tepung Terigu</option>
                                            <option value="2">Gula Pasir</option>
                                            <option value="3">Telur</option>
                                            <option value="4">Mentega</option>
                                            <option value="5">Ragi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-filter mr-2">
                                            <i class="fas fa-search mr-2"></i>Filter Data
                                        </button>
                                        <a href="/riwayatBahanBaku" class="btn btn-reset">
                                            <i class="fas fa-refresh mr-2"></i>Reset Filter
                                        </a>
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

                        @if(isset($stokMovements) && count($stokMovements) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover" id="stokMovementsTable">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Bahan Baku</th>
                                        <th>Jenis</th>
                                        <th>Jumlah</th>
                                        <th>Sisa Stok</th>
                                        <th>Referensi</th>
                                        <th>Catatan</th>
                                        <th width="10%">Status</th>
                                        <th>Dibuat Oleh</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stokMovements as $movement)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($movement->movement_date)->format('d M Y') }}</td>
                                        <td><strong>{{ $movement->bahanBaku->nama ?? 'N/A' }}</strong></td>
                                        <td>
                                            @if($movement->movement_type == 'in')
                                            <span class="movement-badge movement-in">Masuk</span>
                                            @elseif($movement->movement_type == 'out')
                                            <span class="movement-badge movement-out">Keluar</span>
                                            @else
                                            <span class="movement-badge movement-adjustment">Penyesuaian</span>
                                            @endif
                                        </td>
                                        <td class="quantity-cell {{ $movement->movement_type == 'in' ? 'quantity-positive' : 'quantity-negative' }}">
                                            {{ $movement->movement_type == 'in' ? '+' : '-' }}{{ number_format($movement->quantity) }} {{ $movement->bahanBaku->satuan ?? 'kg' }}
                                        </td>
                                        <td><strong>{{ number_format($movement->remaining_stock ) }} {{ $movement->bahanBaku->satuan ?? 'kg' }}</strong></td>
                                        <td>{{ $movement->reference_type }}</td>
                                        <td class="notes-cell" title="{{ $movement->notes }}">{{ $movement->notes }}</td>
                                          <td class="text-center">
                                                    <span class="badge bg-{{ $movement->bahanBaku->status_class }}">
                                                        {{ $movement->bahanBaku->status }}
                                                    </span>
                                                </td>
                                        <td>{{ $movement->creator->name ?? 'System' }}</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn btn-action btn-view" data-id="{{ $movement->id }}" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-warning btn-sm" onclick="editData({{ $movement->id ?? 1 }})" title="Edit" data-toggle="tooltip">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <button type="button"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="deletedata({{ $movement->id ?? 1 }})"
                                                    title="Hapus"
                                                    data-toggle="tooltip">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <!-- Empty State -->
                        <div class="empty-state">
                            <i class="fas fa-box-open"></i>
                            <h4>Belum Ada Data Riwayat</h4>
                            <p>Belum ada transaksi pergerakan stok yang tercatat untuk filter yang dipilih.</p>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <h5 class="modal-title">
                        <i class="fas fa-info-circle mr-2"></i>Detail Pergerakan Stok
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" style="color: white;">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-item">
                                <label>Tanggal Transaksi:</label>
                                <div class="detail-value" id="detailDate"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-item">
                                <label>Waktu Transaksi:</label>
                                <div class="detail-value" id="detailTime"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-item">
                                <label>Bahan Baku:</label>
                                <div class="detail-value" id="detailBahan"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-item">
                                <label>Jenis Pergerakan:</label>
                                <div class="detail-value" id="detailJenis"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-item">
                                <label>Jumlah:</label>
                                <div class="detail-value" id="detailJumlah"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-item">
                                <label>Sisa Stok:</label>
                                <div class="detail-value" id="detailSisa"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-item">
                                <label>Referensi:</label>
                                <div class="detail-value" id="detailReferensi"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-item">
                                <label>Dibuat Oleh:</label>
                                <div class="detail-value" id="detailCreator"></div>
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
                    <p>Data riwayat pergerakan stok yang dihapus tidak dapat dikembalikan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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

    <!-- update Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <form id="editBahanForm" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Bahan Baku</h5>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="editContent">
                        <!-- Form diisi oleh JS -->
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </form>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap Bundle (sudah termasuk popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Chart.js (jika digunakan untuk grafik) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        // View detail modal
        $(document).on('click', '.btn-view', function() {
            const row = $(this).closest('tr');

            // Get data from row
            $('#detailDate').text(row.find('td:eq(0)').text());
            $('#detailBahan').text(row.find('td:eq(1)').text());
            $('#detailJenis').html(row.find('td:eq(2)').html());
            $('#detailJumlah').html(row.find('td:eq(3)').html());
            $('#detailSisa').text(row.find('td:eq(4)').text());
            $('#detailReferensi').text(row.find('td:eq(5)').text());
            $('#detailNotes').text(row.find('td:eq(6)').attr('title') || row.find('td:eq(6)').text());
            $('#detailCreator').text(row.find('td:eq(7)').text());
            $('#detailTime').text('{{ date("H:i:s") }}'); // You can get this from created_at

            $('#detailModal').modal('show');
        });
        const daftarBahanBaku = @json($bahanBakus); // Laravel blade
        function editData(id) {
            axios.get(`/api/stokMovements/${id}`)
                .then(response => {
                    const data = response.data;

                    // Ambil innerHTML dari select template dan tandai yang sesuai
                    const optionsHtml = daftarBahanBaku.map(item => {
                        const selected = item.id === data.bahan_baku_id ? 'selected' : '';
                        return `<option value="${item.id}" ${selected}>${item.nama}</option>`;
                    }).join('');

                    const editHtml = `
                <input type="hidden" name="id" value="${data.id}">

                <div class="form-group">
                    <label for="movement_date">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="movement_date" name="movement_date" value="${data.movement_date}" required>
                </div>

               <!-- Select bahan baku -->
                <div class="form-group">
                    <label for="bahan_baku_id">Bahan Baku <span class="text-danger">*</span></label>
                    <select name="bahan_baku_id" id="bahan_baku_id" class="form-control" required>
                        ${optionsHtml}
                    </select>
                </div>

                <div class="form-group">
                    <label for="movement_type">Jenis Pergerakan</label>
                    <select name="movement_type" class="form-control" id="movement_type">
                        <option value="in" ${data.movement_type === 'in' ? 'selected' : ''}>Masuk</option>
                        <option value="out" ${data.movement_type === 'out' ? 'selected' : ''}>Keluar</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantity">Jumlah</label>
                    <input type="number" class="form-control" name="quantity" id="quantity" value="${data.quantity}" step="0.01" min="0" required>
                </div>

                <div class="form-group">
                    <label for="remaining_stock">Sisa Stok</label>
                    <input type="number" class="form-control" name="remaining_stock" id="remaining_stock" value="${data.remaining_stock}" step="0.01" readonly>
                </div>

                <div class="form-group">
                    <label for="reference_type">Tipe Referensi</label>
                    <select name="reference_type" class="form-control" id="reference_type">
                        <option value="production" ${data.reference_type === 'production' ? 'selected' : ''}>Produksi</option>
                        <option value="purchase" ${data.reference_type === 'purchase' ? 'selected' : ''}>Pembelian</option>
                        <option value="adjustment" ${data.reference_type === 'adjustment' ? 'selected' : ''}>Penyesuaian</option>
                        <option value="waste" ${data.reference_type === 'waste' ? 'selected' : ''}>Limbah</option>
                    </select>
                </div>

               

                <div class="form-group">
                    <label for="notes">Catatan</label>
                    <textarea class="form-control" id="notes" name="notes">${data.notes ?? ''}</textarea>
                </div>
            `;

                    document.getElementById('editContent').innerHTML = editHtml;
                    document.getElementById('editBahanForm').action = `/api/stokMovements/${id}`;
                    $('#editModal').modal('show');
                })
                .catch(error => {
                    let message = 'Terjadi kesalahan saat mengambil data.';

                    if (error.response) {
                        message = `Gagal ambil data: ${error.response.status} - ${error.response.statusText}`;
                        console.error(error.response.data);
                    } else if (error.request) {
                        message = 'Server tidak merespons. Cek koneksi atau endpoint.';
                        console.error(error.request);
                    } else {
                        message = `Kesalahan: ${error.message}`;
                    }

                    Swal.fire('Gagal', message, 'error');
                });
        }


        function updateTableRow(id, data) {
            const row = document.querySelector(`tr[data-id="${id}"]`);
            if (row) {
                row.innerHTML = `
            <td>${data.id}</td>
            <td>${new Date(data.movement_date).toLocaleDateString('id-ID')}</td>
            <td><strong>${data.bahan_baku?.nama || '-'}</strong></td>
            <td class="text-center">
                <span class="badge badge-${data.movement_type === 'in' ? 'success' : 'danger'}">
                    ${data.movement_type.toUpperCase()}
                </span>
            </td>
            <td class="text-center">${parseFloat(data.quantity).toFixed(2)}</td>
            <td class="text-center">${parseFloat(data.remaining_stock).toFixed(2)}</td>
            <td class="text-center">${data.reference_type}</td>
            <td class="text-center">${data.notes ?? '-'}</td>
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

                // Re-inisialisasi tooltip
                $('[data-toggle="tooltip"]').tooltip();
            }
        }


        $(document).on('click', '.btn-edit', function() {
            const id = $(this).data('id');
            editData(id);


        });
        // Handle edit form submission
        $('#editBahanForm').on('submit', function(e) {
            e.preventDefault();

            const submitBtn = $(this).find('button[type="submit"]');
            const originalHtml = submitBtn.html();
            submitBtn.html('<i class="fas fa-spinner fa-spin mr-1"></i> Updating...').prop('disabled', true);

            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries()); // Convert FormData to plain object
            const id = data.id;

            axios.put(`/api/stokMovements/${id}`, data)
                .then(response => {
                    submitBtn.html(originalHtml).prop('disabled', false);
                    $('#editModal').modal('hide');

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data bahan baku berhasil diupdate.',
                        showConfirmButton: false,
                        timer: 2000
                    });

                    // Update row jika kamu punya fungsinya
                    updateTableRow(id, response.data);
                })
                .catch(error => {
                    submitBtn.html(originalHtml).prop('disabled', false);
                    let message = 'Gagal mengupdate data.';

                    if (error.response) {
                        message += ` (${error.response.status} - ${error.response.statusText})`;
                        console.error(error.response.data);
                    }

                    if (error.response) {
                        // Server merespons dengan status di luar 2xx
                        message = `Gagal mengambil data. Status: ${error.response.status} - ${error.response.statusText}`;
                        console.error('Detail error:', error.response.data);
                    } else if (error.request) {
                        // Permintaan dikirim tapi tidak ada respons
                        message = 'Tidak ada respons dari server. Cek koneksi atau endpoint.';
                        console.error('Permintaan:', error.request);
                    } else {
                        // Terjadi kesalahan saat men-setup request
                        message = `Error saat menyiapkan permintaan: ${error.message}`;
                    }
                    Swal.fire('Error', message, 'error');
                });
        });


        function deletedata(id) {
            fetch(`/api/stokMovements/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal menghapus data');
                    }
                    return response.json();
                })
                .then(() => {
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
                    location.reload();
                })
                .catch(error => {
                    let message = 'Gagal mengupdate data.';

                    if (error.response) {
                        message += ` (${error.response.status} - ${error.response.statusText})`;
                        console.error(error.response.data);
                    }

                    if (error.response) {
                        // Server merespons dengan status di luar 2xx
                        message = `Gagal mengambil data. Status: ${error.response.status} - ${error.response.statusText}`;
                        console.error('Detail error:', error.response.data);
                    } else if (error.request) {
                        // Permintaan dikirim tapi tidak ada respons
                        message = 'Tidak ada respons dari server. Cek koneksi atau endpoint.';
                        console.error('Permintaan:', error.request);
                    } else {
                        // Terjadi kesalahan saat men-setup request
                        message = `Error saat menyiapkan permintaan: ${error.message}`;
                    }
                    Swal.fire('Error', message, 'error');
                    console.error('Error detail:', error);
                });
        }


        $(document).ready(function() {
            // Initialize DataTable
            const table = $('#stokMovementsTable').DataTable({
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
                    [0, 'desc']
                ], // Order by date descending
                columnDefs: [{
                        targets: [8],
                        orderable: false
                    }, // Disable sorting for action column
                    {
                        targets: [6],
                        className: 'text-center'
                    }, // Center align notes
                    {
                        targets: [3, 4],
                        className: 'text-right'
                    } // Right align quantity columns
                ],
                drawCallback: function() {
                    // Re-initialize tooltips after table redraw
                    $('[title]').tooltip();
                }
            });

            // Enhanced sidebar toggle - sama seperti di dashboard
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

                    // Force table resize after sidebar toggle
                    setTimeout(() => {
                        if (typeof table !== 'undefined') {
                            table.columns.adjust().draw();
                        }
                    }, 300);
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

            // Filter functionality
            $('#filterForm').on('submit', function(e) {
                // Show loading animation
                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.html();
                submitBtn.html('<i class="fas fa-spinner fa-spin mr-2"></i>Memfilter...');

                setTimeout(() => {
                    submitBtn.html(originalText);
                }, 1000);
            });

            // View detail modal
            $(document).on('click', '.btn-view', function() {
                const row = $(this).closest('tr');

                // Get data from row
                $('#detailDate').text(row.find('td:eq(0)').text());
                $('#detailBahan').text(row.find('td:eq(1)').text());
                $('#detailJenis').html(row.find('td:eq(2)').html());
                $('#detailJumlah').html(row.find('td:eq(3)').html());
                $('#detailSisa').text(row.find('td:eq(4)').text());
                $('#detailReferensi').text(row.find('td:eq(5)').text());
                $('#detailNotes').text(row.find('td:eq(6)').attr('title') || row.find('td:eq(6)').text());
                $('#detailCreator').text(row.find('td:eq(7)').text());
                $('#detailTime').text('{{ date("H:i:s") }}'); // You can get this from created_at

                $('#detailModal').modal('show');
            });









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

            // Delete functionality
            let deleteId = null;
            $(document).on('click', '.btn-delete', function() {
                deleteId = $(this).data('id');
                const row = $(this).closest('tr');
                const bahanBaku = row.find('td:eq(1)').text();

                // Update modal text
                $('#deleteModal .modal-body p').text(
                    `Data riwayat pergerakan stok "${bahanBaku}" akan dihapus permanen.`
                );

                // Set form action
                $('#deleteForm').attr('action', '/riwayatBahanBaku/' + deleteId);

                $('#deleteModal').modal('show');
            });

            // Confirm delete
            $('#deleteForm').on('submit', function(e) {
                e.preventDefault();
                const submitBtn = $('#confirmDelete');
                submitBtn.html('<i class="fas fa-spinner fa-spin mr-2"></i>Menghapus...');

                // Simulate delete request (replace with actual AJAX call)
                setTimeout(() => {
                    $('#deleteModal').modal('hide');

                    // Show success notification
                    $('body').append(`
                        <div class="alert alert-success alert-dismissible fade show position-fixed" 
                             style="top: 20px; right: 20px; z-index: 9999;">
                            <i class="fas fa-check-circle mr-2"></i>
                            Data berhasil dihapus!
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    `);

                    // Auto remove notification
                    setTimeout(() => {
                        $('.alert').alert('close');
                    }, 3000);

                    // Reset button
                    submitBtn.html('<i class="fas fa-trash mr-2"></i>Hapus Data');

                    // Reload page or remove row
                    location.reload();
                }, 1500);
            });

            // Initialize tooltips
            $('[title]').tooltip({
                placement: 'top',
                trigger: 'hover'
            });

            // Enhance table row hover effects
            $('#stokMovementsTable tbody').on('mouseenter', 'tr', function() {
                $(this).find('.btn-action').addClass('animate__animated animate__pulse');
            }).on('mouseleave', 'tr', function() {
                $(this).find('.btn-action').removeClass('animate__animated animate__pulse');
            });

            // Auto-dismiss alerts
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);

            // Keyboard shortcuts
            $(document).on('keydown', function(e) {
                // Ctrl + F to focus on search
                if (e.ctrlKey && e.key === 'f') {
                    e.preventDefault();
                    $('.dataTables_filter input').focus();
                }

                // Escape to close modals
                if (e.key === 'Escape') {
                    $('.modal').modal('hide');
                }
            });

            // Responsive table adjustments
            $(window).on('resize', function() {
                if ($.fn.DataTable.isDataTable('#stokMovementsTable')) {
                    table.columns.adjust().draw();
                }
            });

            // Initialize tooltips globally
            $('[data-toggle="tooltip"], [title]').tooltip();

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