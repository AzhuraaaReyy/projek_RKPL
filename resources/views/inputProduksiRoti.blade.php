<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Input Produksi Roti - Galaxy Bakery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
        }

        .content-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            margin: 20px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .action-buttons {
            margin: 20px;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .btn-custom {
            border-radius: 25px;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 5px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            text-decoration: none;
        }

        .btn-add-product {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
        }

        .btn-add-production {
            background: linear-gradient(45deg, #f093fb, #f5576c);
            color: white;
            border: none;
        }

        .production-table-container {
            margin: 20px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .table-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            margin: 0;
        }

        .table-header h2 {
            margin: 0;
            font-weight: 700;
            font-size: 1.8rem;
        }

        .table-responsive {
            margin: 0;
            border-radius: 0;
        }

        .table {
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table thead th {
            background: linear-gradient(135deg, #4c63d2 0%, #6b46c1 100%);
            color: white;
            border: none;
            padding: 18px 15px;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .table thead th:first-child {
            border-top-left-radius: 0;
        }

        .table thead th:last-child {
            border-top-right-radius: 0;
        }

        .table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #e5e7eb;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
            transform: scale(1.01);
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border: none;
            font-size: 0.95rem;
        }

        .badge {
            padding: 8px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .bg-success {
            background: linear-gradient(45deg, #10b981, #059669) !important;
        }

        .bg-warning {
            background: linear-gradient(45deg, #f59e0b, #d97706) !important;
        }

        .bg-danger {
            background: linear-gradient(45deg, #ef4444, #dc2626) !important;
        }

        .btn-action {
            border-radius: 20px;
            padding: 8px 15px;
            font-size: 0.8rem;
            font-weight: 600;
            margin: 2px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .btn-success {
            background: linear-gradient(45deg, #10b981, #059669);
        }

        .btn-danger {
            background: linear-gradient(45deg, #ef4444, #dc2626);
        }

        .ingredient-list {
            max-width: 200px;
        }

        .ingredient-list ul {
            margin: 0;
            padding-left: 15px;
        }

        .ingredient-list li {
            font-size: 0.85rem;
            color: #6b7280;
            margin-bottom: 5px;
        }

        .status-icon {
            font-size: 1.5rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #9ca3af;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .mobile-menu-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1050;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        .mobile-menu-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        }

        .sidebar-logout .btn {
            width: 100%;
            border-radius: 25px;
            padding: 12px;
            font-weight: 600;
            margin: 15px 0;
            background: linear-gradient(45deg, #ef4444, #dc2626);
            border: none;
            transition: all 0.3s ease;
        }

        .sidebar-logout .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
        }

        .brand-link {
            background: linear-gradient(135deg, #1e293b, #334155);
            padding: 20px;
            border-bottom: 3px solid #667eea;
        }

        .brand-text {
            font-size: 1.3rem;
            font-weight: 700;
            color: white;
        }

        .nav-link.active {
            background: linear-gradient(45deg, #667eea, #764ba2) !important;
            border-radius: 10px;
            margin: 2px 10px;
            color: white !important;
        }

        .nav-link:hover {
            background: rgba(102, 126, 234, 0.1);
            border-radius: 10px;
            margin: 2px 10px;
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .content-header {
                margin: 10px;
                padding: 20px;
            }
            
            .action-buttons {
                margin: 10px;
                padding: 15px;
            }
            
            .production-table-container {
                margin: 10px;
            }
            
            .table-header {
                padding: 20px;
            }
            
            .table thead th,
            .table tbody td {
                padding: 10px;
                font-size: 0.8rem;
            }
            
            .btn-custom {
                padding: 10px 20px;
                font-size: 0.9rem;
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
                        <img src="https://ui-avatars.com/api/?name=User&background=6366f1&color=fff&size=128" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info ml-3">
                        <a href="#" class="d-block">Admin User</a>
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
                                        <p>Input Bahan Baku</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/riwayatBahanBaku" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Riwayat Bahan Baku</p>
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
                                    <a href="/produksiRoti" class="nav-link active">
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

                        <li class="nav-item has-treeview">
                            <a href="/laporan" class="nav-link">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>Laporan<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/laporanstok" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laporan Stok</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="laporanproduksi" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laporan Produksi</p>
                                    </a>
                                </li>
                            </ul>
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
                    <form method="POST" action="/logout">
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
                        <div class="col-md-8">
                            <h1 class="mb-2">
                                <i class="fas fa-bread-slice mr-3"></i>
                                Input Produksi Roti
                            </h1>
                            <p class="mb-0 opacity-75">Kelola produksi roti harian Galaxy Bakery</p>
                        </div>
                        <div class="col-md-4 text-right">
                            <div class="d-flex flex-column align-items-end">
                                <div class="mb-2">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <span id="currentDate"></span>
                                </div>
                                <div>
                                    <i class="fas fa-clock mr-2"></i>
                                    <span id="currentTime"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons animate__animated animate__fadeInUp">
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-3">
                        <a href="/form-produk" class="btn btn-add-product btn-custom btn-lg w-100">
                            <i class="fas fa-plus-circle"></i>
                            <div>
                                <div class="font-weight-bold">Tambah Produk Roti</div>
                                <small>Daftarkan jenis roti baru</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-3">
                        <a href="/form-produksi" class="btn btn-add-production btn-custom btn-lg w-100">
                            <i class="fas fa-cogs"></i>
                            <div>
                                <div class="font-weight-bold">Tambah Produksi</div>
                                <small>Buat batch produksi baru</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Production Table -->
            <div class="production-table-container animate__animated animate__fadeInUp animate__delay-1s">
                <div class="table-header">
                    <h2>
                        <i class="fas fa-list-alt mr-3"></i>
                        Detail Produksi
                    </h2>
                    <small>Daftar semua produksi roti hari ini</small>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="12%">Nama Produk</th>
                                <th width="10%">Jumlah Produksi</th>
                                <th width="8%">Nomor Batch</th>
                                <th width="10%">Tanggal Produksi</th>
                                <th width="12%">Biaya Produksi</th>
                                <th width="15%">Bahan Baku</th>
                                <th width="10%">Catatan</th>
                                <th width="8%">Status</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample Data Row 1 -->
                            <tr>
                                <td class="text-center font-weight-bold">1</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-bread-slice text-warning mr-2"></i>
                                        <strong>Roti Tawar</strong>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-info">150 pcs</span>
                                </td>
                                <td class="text-center">
                                    <code>BTH-001</code>
                                </td>
                                <td class="text-center">11-06-2025</td>
                                <td class="text-right">
                                    <strong class="text-success">Rp 750.000,00</strong>
                                </td>
                                <td class="ingredient-list">
                                    <ul class="list-unstyled mb-0">
                                        <li><i class="fas fa-circle text-warning" style="font-size: 0.4rem;"></i> Tepung - 15 kg</li>
                                        <li><i class="fas fa-circle text-info" style="font-size: 0.4rem;"></i> Gula - 3 kg</li>
                                        <li><i class="fas fa-circle text-danger" style="font-size: 0.4rem;"></i> Telur - 30 butir</li>
                                    </ul>
                                </td>
                                <td class="text-center">
                                    <span class="text-muted">Produksi normal</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-warning">In Progress</span>
                                </td>
                                <td class="text-center">
                                    <form class="d-inline">
                                        <button type="button" class="btn btn-success btn-action" onclick="return confirm('Tandai sebagai Completed?')">
                                            <i class="fas fa-check"></i> Selesai
                                        </button>
                                        <button type="button" class="btn btn-danger btn-action" onclick="return confirm('Batalkan Produksi?')">
                                            <i class="fas fa-times"></i> Batal
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Sample Data Row 2 -->
                            <tr>
                                <td class="text-center font-weight-bold">2</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-cookie-bite text-success mr-2"></i>
                                        <strong>Roti Manis</strong>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-info">100 pcs</span>
                                </td>
                                <td class="text-center">
                                    <code>BTH-002</code>
                                </td>
                                <td class="text-center">11-06-2025</td>
                                <td class="text-right">
                                    <strong class="text-success">Rp 650.000,00</strong>
                                </td>
                                <td class="ingredient-list">
                                    <ul class="list-unstyled mb-0">
                                        <li><i class="fas fa-circle text-warning" style="font-size: 0.4rem;"></i> Tepung - 12 kg</li>
                                        <li><i class="fas fa-circle text-info" style="font-size: 0.4rem;"></i> Gula - 5 kg</li>
                                        <li><i class="fas fa-circle text-success" style="font-size: 0.4rem;"></i> Mentega - 2 kg</li>
                                    </ul>
                                </td>
                                <td class="text-center">
                                    <span class="text-muted">Extra manis</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">Completed</span>
                                </td>
                                <td class="text-center">
                                    <span class="status-icon text-success" title="Selesai">✅</span>
                                </td>
                            </tr>

                            <!-- Sample Data Row 3 -->
                            <tr>
                                <td class="text-center font-weight-bold">3</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-hamburger text-primary mr-2"></i>
                                        <strong>Roti Burger</strong>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-info">80 pcs</span>
                                </td>
                                <td class="text-center">
                                    <code>BTH-003</code>
                                </td>
                                <td class="text-center">11-06-2025</td>
                                <td class="text-right">
                                    <strong class="text-success">Rp 520.000,00</strong>
                                </td>
                                <td class="ingredient-list">
                                    <ul class="list-unstyled mb-0">
                                        <li><i class="fas fa-circle text-warning" style="font-size: 0.4rem;"></i> Tepung - 10 kg</li>
                                        <li><i class="fas fa-circle text-danger" style="font-size: 0.4rem;"></i> Telur - 20 butir</li>
                                        <li><i class="fas fa-circle text-dark" style="font-size: 0.4rem;"></i> Wijen - 500 gr</li>
                                    </ul>
                                </td>
                                <td class="text-center">
                                    <span class="text-muted">Dengan wijen</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-danger">Cancelled</span>
                                </td>
                                <td class="text-center">
                                    <span class="status-icon text-danger" title="Dibatalkan">❌</span>
                                </td>
                            </tr>

                            <!-- Empty State (uncomment to show when no data) -->
                            <!-- 
                            <tr>
                                <td colspan="10" class="empty-state">
                                    <i class="fas fa-bread-slice"></i>
                                    <h5>Belum Ada Data Produksi</h5>
                                    <p>Silakan tambah produksi roti terlebih dahulu</p>
                                </td>
                            </tr>
                            -->
                        </tbody>
                    </table>
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

    <script>
        // Enhanced sidebar toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
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
            }

            if (toggleButton) {
                toggleButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleSidebar();
                });
            }

            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
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
                            icon.classList.remove('fa-times icon.classList.add('fa-bars')');
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

            // Initialize sidebar state based on screen size
            if (window.innerWidth <= 768) {
                document.body.classList.add('sidebar-collapse');
            }
        });

        // Date and Time Display
        function updateDateTime() {
            const now = new Date();
            
            // Format date
            const dateOptions = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            };
            const formattedDate = now.toLocaleDateString('id-ID', dateOptions);
            
            // Format time
            const timeOptions = { 
                hour: '2-digit', 
                minute: '2-digit', 
                second: '2-digit',
                hour12: false
            };
            const formattedTime = now.toLocaleTimeString('id-ID', timeOptions);
            
            // Update elements
            const dateElement = document.getElementById('currentDate');
            const timeElement = document.getElementById('currentTime');
            
            if (dateElement) dateElement.textContent = formattedDate;
            if (timeElement) timeElement.textContent = formattedTime;
        }

        // Update time every second
        setInterval(updateDateTime, 1000);
        updateDateTime(); // Initial call

        // Table animations and interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effect to table rows
            const tableRows = document.querySelectorAll('.table tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                });
                
                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });

            // Handle action buttons
            const actionButtons = document.querySelectorAll('.btn-action');
            actionButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const buttonText = this.textContent.trim();
                    const isCompleteButton = this.classList.contains('btn-success');
                    const isCancelButton = this.classList.contains('btn-danger');
                    
                    if (isCompleteButton) {
                        handleCompleteProduction(this);
                    } else if (isCancelButton) {
                        handleCancelProduction(this);
                    }
                });
            });
        });

        // Handle production completion
        function handleCompleteProduction(button) {
            const confirmed = confirm('Apakah Anda yakin ingin menandai produksi ini sebagai selesai?');
            if (confirmed) {
                const row = button.closest('tr');
                const statusBadge = row.querySelector('.badge');
                const actionCell = row.querySelector('td:last-child');
                
                // Update status badge
                statusBadge.className = 'badge bg-success';
                statusBadge.textContent = 'Completed';
                
                // Replace action buttons with success icon
                actionCell.innerHTML = '<span class="status-icon text-success" title="Selesai">✅</span>';
                
                // Add success animation
                row.classList.add('animate__animated', 'animate__pulse');
                
                // Show success message
                showNotification('Produksi berhasil diselesaikan!', 'success');
                
                setTimeout(() => {
                    row.classList.remove('animate__animated', 'animate__pulse');
                }, 1000);
            }
        }

        // Handle production cancellation
        function handleCancelProduction(button) {
            const confirmed = confirm('Apakah Anda yakin ingin membatalkan produksi ini?');
            if (confirmed) {
                const row = button.closest('tr');
                const statusBadge = row.querySelector('.badge');
                const actionCell = row.querySelector('td:last-child');
                
                // Update status badge
                statusBadge.className = 'badge bg-danger';
                statusBadge.textContent = 'Cancelled';
                
                // Replace action buttons with cancel icon
                actionCell.innerHTML = '<span class="status-icon text-danger" title="Dibatalkan">❌</span>';
                
                // Add fade animation
                row.style.opacity = '0.6';
                row.classList.add('animate__animated', 'animate__fadeOut');
                
                // Show warning message
                showNotification('Produksi dibatalkan!', 'warning');
                
                setTimeout(() => {
                    row.classList.remove('animate__animated', 'animate__fadeOut');
                    row.style.opacity = '0.6';
                }, 1000);
            }
        }

        // Notification system
        function showNotification(message, type = 'info') {
            // Remove existing notifications
            const existingNotifications = document.querySelectorAll('.custom-notification');
            existingNotifications.forEach(notification => notification.remove());
            
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `custom-notification alert alert-${type} animate__animated animate__fadeInRight`;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                min-width: 300px;
                box-shadow: 0 8px 25px rgba(0,0,0,0.15);
                border-radius: 10px;
                border: none;
                font-weight: 600;
            `;
            
            // Set background based on type
            const backgrounds = {
                success: 'linear-gradient(45deg, #10b981, #059669)',
                warning: 'linear-gradient(45deg, #f59e0b, #d97706)',
                danger: 'linear-gradient(45deg, #ef4444, #dc2626)',
                info: 'linear-gradient(45deg, #3b82f6, #1d4ed8)'
            };
            
            notification.style.background = backgrounds[type] || backgrounds.info;
            notification.style.color = 'white';
            
            // Add icon based on type
            const icons = {
                success: '✅',
                warning: '⚠️',
                danger: '❌',
                info: 'ℹ️'
            };
            
            notification.innerHTML = `
                <div class="d-flex align-items-center">
                    <span class="mr-2" style="font-size: 1.2rem;">${icons[type] || icons.info}</span>
                    <span>${message}</span>
                    <button type="button" class="close ml-auto" style="color: white; opacity: 0.8;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            `;
            
            // Add to document
            document.body.appendChild(notification);
            
            // Handle close button
            const closeBtn = notification.querySelector('.close');
            closeBtn.addEventListener('click', () => {
                notification.classList.add('animate__fadeOutRight');
                setTimeout(() => notification.remove(), 300);
            });
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.classList.add('animate__fadeOutRight');
                    setTimeout(() => notification.remove(), 300);
                }
            }, 5000);
        }

        // Enhanced button interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Add click effect to custom buttons
            const customButtons = document.querySelectorAll('.btn-custom');
            customButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    // Create ripple effect
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        border-radius: 50%;
                        background: rgba(255, 255, 255, 0.6);
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        left: ${x}px;
                        top: ${y}px;
                        width: ${size}px;
                        height: ${size}px;
                        pointer-events: none;
                    `;
                    
                    this.style.position = 'relative';
                    this.style.overflow = 'hidden';
                    this.appendChild(ripple);
                    
                    setTimeout(() => ripple.remove(), 600);
                });
            });
        });

        // CSS for ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                0% {
                    transform: scale(0);
                    opacity: 1;
                }
                100% {
                    transform: scale(4);
                    opacity: 0;
                }
            }
            
            .custom-notification {
                transition: all 0.3s ease;
            }
            
            .table tbody tr {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            .btn-action {
                position: relative;
                overflow: hidden;
            }
            
            .status-icon {
                display: inline-block;
                transition: transform 0.3s ease;
            }
            
            .status-icon:hover {
                transform: scale(1.2);
            }
        `;
        document.head.appendChild(style);

        // Initialize tooltips if Bootstrap tooltips are available
        if (typeof $().tooltip === 'function') {
            $('[data-toggle="tooltip"], [title]').tooltip({
                placement: 'top',
                trigger: 'hover'
            });
        }

        // Table search functionality (if needed)
        function initTableSearch() {
            const searchInput = document.getElementById('tableSearch');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const tableRows = document.querySelectorAll('.table tbody tr');
                    
                    tableRows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            row.style.display = '';
                            row.classList.add('animate__animated', 'animate__fadeIn');
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }
        }

        // Initialize search when DOM is loaded
        document.addEventListener('DOMContentLoaded', initTableSearch);

        // Performance optimization - lazy loading for large tables
        function initLazyLoading() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });

            const tableRows = document.querySelectorAll('.table tbody tr');
            tableRows.forEach(row => {
                observer.observe(row);
            });
        }

        // Initialize lazy loading when DOM is loaded
        document.addEventListener('DOMContentLoaded', initLazyLoading);

    </script>
</body>
</html>