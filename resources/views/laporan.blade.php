<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Keseluruhan - Galaxy Bakery</title>

    <!-- AdminLTE, Bootstrap, FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .main-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 0 auto;
            max-width: 1400px;
        }

        .header-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header-section::before {
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
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .header-section h1 {
            font-size: 3rem;
            font-weight: 800;
            margin: 0;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 2;
        }

        .header-section .subtitle {
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

        .form-control {
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            padding: 15px 20px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 15px 30px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
            border: none;
            color: white;
            padding: 15px 30px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
            color: white;
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

        .table-container {
            padding: 0;
            background: white;
        }

        .table {
            margin: 0;
            font-size: 14px;
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

        .alert {
            border-radius: 12px;
            border: none;
            font-weight: 500;
        }

        .alert-warning {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            color: #856404;
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

        .section-divider {
            height: 2px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 40px 0;
            border-radius: 1px;
        }

        .no-data-state {
            text-align: center;
            padding: 60px 30px;
            color: #64748b;
        }

        .no-data-state i {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 24px;
        }

        .no-data-state h4 {
            color: #475569;
            margin-bottom: 12px;
        }

        .table-section {
            margin-bottom: 50px;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
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

        .table-responsive {
            border-radius: 0 0 20px 20px;
            overflow: hidden;
        }

        /* Demo data styles */
        .demo-alert {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            color: #1565c0;
            border: none;
            border-radius: 15px;
            padding: 20px;
            margin: 20px 30px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .main-container {
                margin: 10px;
                border-radius: 15px;
            }

            .header-section {
                padding: 30px 20px;
            }

            .header-section h1 {
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
            body {
                background: white;
                padding: 0;
            }

            .main-container {
                box-shadow: none;
                border-radius: 0;
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

<body>
    <div class="main-container animate__animated animate__fadeIn">
        
        <!-- Header Section -->
        <div class="header-section">
            <h1>🌌 Laporan Data Keseluruhan</h1>
            <p class="subtitle">Galaxy Bakery - Comprehensive Data Report</p>
        </div>

        <!-- Demo Alert -->
        <div class="demo-alert">
            <i class="fas fa-info-circle mr-2"></i>
            <strong>Demo Mode:</strong> This is a demonstration of the Galaxy Bakery reporting system with sample data.
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
                        <button type="button" class="btn btn-danger" onclick="downloadPDF()">
                            <i class="fas fa-file-pdf mr-2"></i>Download PDF
                        </button>
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
                            <tr>
                                <td class="text-center"><strong>1</strong></td>
                                <td><strong>Tepung Terigu</strong></td>
                                <td class="text-capitalize text-center">Bahan Utama</td>
                                <td class="text-end">150</td>
                                <td class="text-center">Kg</td>
                                <td class="text-end">50</td>
                                <td class="text-center">01-06-2025</td>
                                <td class="text-center">01-12-2025</td>
                                <td class="text-center">Rp12.500,00</td>
                                <td class="text-center">Tepung protein tinggi untuk roti</td>
                                <td class="text-center">
                                    <span class="badge bg-success">Tersedia</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>2</strong></td>
                                <td><strong>Gula Pasir</strong></td>
                                <td class="text-capitalize text-center">Pemanis</td>
                                <td class="text-end">80</td>
                                <td class="text-center">Kg</td>
                                <td class="text-end">25</td>
                                <td class="text-center">05-06-2025</td>
                                <td class="text-center">05-06-2026</td>
                                <td class="text-center">Rp14.000,00</td>
                                <td class="text-center">Gula pasir kualitas premium</td>
                                <td class="text-center">
                                    <span class="badge bg-success">Tersedia</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>3</strong></td>
                                <td><strong>Mentega</strong></td>
                                <td class="text-capitalize text-center">Lemak</td>
                                <td class="text-end">30</td>
                                <td class="text-center">Kg</td>
                                <td class="text-end">40</td>
                                <td class="text-center">08-06-2025</td>
                                <td class="text-center">08-08-2025</td>
                                <td class="text-center">Rp35.000,00</td>
                                <td class="text-center">Mentega tawar untuk kue</td>
                                <td class="text-center">
                                    <span class="badge bg-warning">Stok Rendah</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>4</strong></td>
                                <td><strong>Telur Ayam</strong></td>
                                <td class="text-capitalize text-center">Protein</td>
                                <td class="text-end">200</td>
                                <td class="text-center">Butir</td>
                                <td class="text-end">100</td>
                                <td class="text-center">10-06-2025</td>
                                <td class="text-center">25-06-2025</td>
                                <td class="text-center">Rp2.500,00</td>
                                <td class="text-center">Telur segar grade A</td>
                                <td class="text-center">
                                    <span class="badge bg-success">Tersedia</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>5</strong></td>
                                <td><strong>Ragi Instant</strong></td>
                                <td class="text-capitalize text-center">Pengembang</td>
                                <td class="text-end">5</td>
                                <td class="text-center">Kg</td>
                                <td class="text-end">10</td>
                                <td class="text-center">03-06-2025</td>
                                <td class="text-center">03-12-2025</td>
                                <td class="text-center">Rp25.000,00</td>
                                <td class="text-center">Ragi instant untuk roti</td>
                                <td class="text-center">
                                    <span class="badge bg-danger">Stok Habis</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
                            <tr>
                                <td class="text-center"><strong>1</strong></td>
                                <td><strong>Tepung Terigu</strong></td>
                                <td class="text-center text-capitalize">
                                    <span class="badge bg-success">In</span>
                                </td>
                                <td class="text-end">100.00</td>
                                <td class="text-end">150.00</td>
                                <td class="text-center">01-06-2025</td>
                                <td class="text-center">Pembelian #001</td>
                                <td>Pembelian stok bulanan</td>
                                <td class="text-center">Admin</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>2</strong></td>
                                <td><strong>Tepung Terigu</strong></td>
                                <td class="text-center text-capitalize">
                                    <span class="badge bg-danger">Out</span>
                                </td>
                                <td class="text-end">20.00</td>
                                <td class="text-end">130.00</td>
                                <td class="text-center">09-06-2025</td>
                                <td class="text-center">Produksi #PRD001</td>
                                <td>Produksi roti tawar</td>
                                <td class="text-center">Baker</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>3</strong></td>
                                <td><strong>Gula Pasir</strong></td>
                                <td class="text-center text-capitalize">
                                    <span class="badge bg-success">In</span>
                                </td>
                                <td class="text-end">50.00</td>
                                <td class="text-end">80.00</td>
                                <td class="text-center">05-06-2025</td>
                                <td class="text-center">Pembelian #002</td>
                                <td>Restok gula pasir</td>
                                <td class="text-center">Admin</td>
                            </tr>
                        </tbody>
                    </table>
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
                            <tr>
                                <td class="text-center"><strong>1</strong></td>
                                <td class="product-name">Roti Tawar</td>
                                <td class="text-center">
                                    <span class="quantity-badge">50 pcs</span>
                                </td>
                                <td class="text-center">
                                    <span class="batch-number">BTH001</span>
                                </td>
                                <td class="text-center">09-06-2025</td>
                                <td class="text-right production-cost">Rp250.000,00</td>
                                <td class="text-center">
                                    <ul class="list-unstyled">
                                        <li><strong>Tepung Terigu</strong> - 20 Kg</li>
                                        <li><strong>Gula Pasir</strong> - 5 Kg</li>
                                        <li><strong>Mentega</strong> - 3 Kg</li>
                                        <li><strong>Telur Ayam</strong> - 25 Butir</li>
                                    </ul>
                                </td>
                                <td class="text-center">Produksi rutin harian</td>
                                <td class="text-center">
                                    <span class="badge bg-success">Completed</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>2</strong></td>
                                <td class="product-name">Croissant</td>
                                <td class="text-center">
                                    <span class="quantity-badge">30 pcs</span>
                                </td>
                                <td class="text-center">
                                    <span class="batch-number">BTH002</span>
                                </td>
                                <td class="text-center">10-06-2025</td>
                                <td class="text-right production-cost">Rp180.000,00</td>
                                <td class="text-center">
                                    <ul class="list-unstyled">
                                        <li><strong>Tepung Terigu</strong> - 12 Kg</li>
                                        <li><strong>Mentega</strong> - 8 Kg</li>
                                        <li><strong>Telur Ayam</strong> - 15 Butir</li>
                                    </ul>
                                </td>
                                <td class="text-center">Pesanan khusus</td>
                                <td class="text-center">
                                    <span class="badge bg-warning">Planning</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Riwayat Produksi Section -->
        <div class="table-section animate__animated animate__fadeInUp">
            <div class="section-header">
                <h1><i class="fas fa-clipboard-list mr-3"></i>Riwayat Produksi</h1>
            </div>
            <div class="table-container">
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
                            <tr>
                                <td class="text-center"><strong>1</strong></td>
                                <td>
                                    <span class="product-name">Roti Tawar</span>
                                </td>
                                <td class="text-center">
                                    <span class="quantity-badge">50 pcs</span>
                                </td>
                                <td class="text-center">
                                    <span class="batch-number">BTH001</span>
                                </td>
                                <td class="text-center">09 Jun 2025</td>
                                <td class="text-right">
                                    <span class="production-cost">Rp 250.000</span>
                                </td>
                                <td>
                                    <div class="bahan-list">
                                        <div class="bahan-item">Tepung Terigu - 20 Kg</div>
                                        <div class="bahan-item">Gula Pasir - 5 Kg</div>
                                        <div class="bahan-item">Mentega - 3 Kg</div>
                                        <div class="bahan-item">Telur Ayam - 25 Butir</div>
                                    </div>
                                </td>
                                <td class="text-center">Produksi rutin harian</td>
                                <td class="text-center">
                                    <span class="status-badge status-completed">Selesai</span>
                                </td>
                                <td class="text-center">Chef Baker</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>2</strong></td>
                                <td>
                                    <span class="product-name">Croissant</span>
                                </td>
                                <td class="text-center">
                                    <span class="quantity-badge">30 pcs</span>
                                </td>
                                <td class="text-center">
                                    <span class="batch-number">BTH002</span>
                                </td>
                                <td class="text-center">10 Jun 2025</td>
                                <td class="text-right">
                                    <span class="production-cost">Rp 180.000</span>
                                </td>
                                <td>
                                    <div class="bahan-list">
                                        <div class="bahan-item">Tepung Terigu - 12 Kg</div>
                                        <div class="bahan-item">Mentega - 8 Kg</div>
                                        <div class="bahan-item">Telur Ayam - 15 Butir</div>
                                    </div>
                                </td>
                                <td class="text-center">Pesanan khusus cafe</td>
                                <td class="text-center">
                                    <span class="status-badge status-planning">Rencana</span>
                                </td>
                                <td class="text-center">Chef Baker</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>3</strong></td>
                                <td>
                                    <span class="product-name">Donat Coklat</span>
                                </td>
                                <td class="text-center">
                                    <span class="quantity-badge">40 pcs</span>
                                </td>
                                <td class="text-center">
                                    <span class="batch-number">BTH003</span>
                                </td>
                                <td class="text-center">08 Jun 2025</td>
                                <td class="text-right">
                                    <span class="production-cost">Rp 200.000</span>
                                </td>
                                <td>
                                    <div class="bahan-list">
                                        <div class="bahan-item">Tepung Terigu - 15 Kg</div>
                                        <div class="bahan-item">Gula Pasir - 8 Kg</div>
                                        <div class="bahan-item">Telur Ayam - 20 Butir</div>
                                        <div class="bahan-item">Coklat Bubuk - 2 Kg</div>
                                    </div>
                                </td>
                                <td class="text-center">Pesanan event ulang tahun</td>
                                <td class="text-center">
                                    <span class="status-badge status-cancelled">Dibatalkan</span>
                                </td>
                                <td class="text-center">Asisten Baker</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Footer dengan Pagination -->
        <div class="pagination-section p-4 text-center">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                    <li class="page-item active">
                        <span class="page-link">1</span>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

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
        function downloadPDF() {
            // Simulate PDF download
            const link = document.createElement('a');
            link.href = '#';
            link.download = 'Galaxy_Bakery_Report_' + new Date().toISOString().slice(0, 10) + '.pdf';
            
            // Show loading state
            const btn = event.target.closest('button');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Generating PDF...';
            btn.disabled = true;
            
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.disabled = false;
                alert('PDF akan diunduh segera! (Demo mode - file tidak benar-benar diunduh)');
            }, 2000);
        }

        // Auto search on input
        document.getElementById('searchInput').addEventListener('input', function() {
            clearTimeout(window.searchTimeout);
            window.searchTimeout = setTimeout(searchData, 300);
        });

        // Print functionality
        function printReport() {
            window.print();
        }

        // Initialize tooltips and other interactive elements
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
                if( target.length ) {
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
    </script>

</body>
</html>