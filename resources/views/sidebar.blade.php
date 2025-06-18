<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Galaxy Bakery</title>
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
        /* FIXED SIDEBAR STYLES - TAMBAHAN */
        .main-sidebar {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            height: 100vh !important;
            width: 250px !important;
            z-index: 1000 !important;
            overflow: hidden !important;
            transition: all 0.3s ease !important;
        }

        .sidebar-collapse .main-sidebar {
            width: 70px !important;
        }

        .sidebar {
            height: 100vh !important;
            display: flex !important;
            flex-direction: column !important;
            overflow: hidden !important;
        }

        .sidebar nav {
            flex: 1 !important;
            overflow-y: auto !important;
            overflow-x: hidden !important;
            padding-bottom: 20px !important;
        }

        /* Enhanced Navigation Link Styles */
        .nav-sidebar .nav-link {
            transition: all 0.3s ease !important;
            border-radius: 8px !important;
            margin: 2px 8px !important;
            position: relative !important;
            overflow: hidden !important;
        }

        .nav-sidebar .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .nav-sidebar .nav-link:hover::before {
            left: 100%;
        }

        .nav-sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
            transform: translateX(5px) !important;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3) !important;
        }

        .nav-sidebar .nav-link.active {
            background: linear-gradient(135deg, #6366f1, #8b5cf6) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4) !important;
            transform: translateX(3px) !important;
        }

        .nav-sidebar .nav-link.active::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 60%;
            background: #ffffff;
            border-radius: 2px 0 0 2px;
        }

        /* Tree view enhancements */
        .nav-treeview .nav-link {
            padding-left: 50px !important;
            font-size: 0.9rem !important;
        }

        .nav-treeview .nav-link:hover {
            background: rgba(255, 255, 255, 0.08) !important;
            transform: translateX(8px) !important;
        }

        .nav-treeview .nav-link.active {
            background: linear-gradient(135deg, #4f46e5, #7c3aed) !important;
            transform: translateX(5px) !important;
        }

        /* Icon animations */
        .nav-icon {
            transition: all 0.3s ease !important;
        }

        .nav-link:hover .nav-icon {
            transform: scale(1.1) !important;
            color: #fbbf24 !important;
        }

        .nav-link.active .nav-icon {
            color: #ffffff !important;
            transform: scale(1.05) !important;
        }

        /* Logout button styling - moved to navigation area */
        .logout-nav-item {
            margin-top: 30px !important;
            padding-top: 20px !important;
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        .logout-nav-item .nav-link {
            background: linear-gradient(135deg, #ef4444, #dc2626) !important;
            color: white !important;
            border-radius: 8px !important;
            margin: 0 10px !important;
            padding: 12px 15px !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 2px 10px rgba(239, 68, 68, 0.3) !important;
        }

        .logout-nav-item .nav-link:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c) !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4) !important;
        }

        .sidebar-collapse .logout-nav-item .nav-link {
            margin: 0 5px !important;
            padding: 12px !important;
            text-align: center !important;
        }

        /* Content wrapper adjustment */
        .content-wrapper,
        .main-footer {
            margin-left: 250px !important;
            transition: margin-left 0.3s ease !important;
        }

        .sidebar-collapse .content-wrapper,
        .sidebar-collapse .main-footer {
            margin-left: 70px !important;
        }

        /* Custom scrollbar untuk navigasi */
        .sidebar nav::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar nav::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar nav::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }

        .sidebar nav::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .main-sidebar {
                transform: translateX(-100%) !important;
                transition: transform 0.3s ease !important;
            }

            .sidebar-open .main-sidebar {
                transform: translateX(0) !important;
            }

            .content-wrapper,
            .main-footer {
                margin-left: 0 !important;
            }

            .mobile-menu-btn {
                position: fixed;
                top: 15px;
                left: 15px;
                z-index: 1001;
                background: #6366f1;
                color: white;
                border: none;
                padding: 10px 12px;
                border-radius: 8px;
                font-size: 16px;
                box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
                transition: all 0.3s ease;
            }

            .mobile-menu-btn:hover {
                background: #5855eb;
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
            }
        }

        /* Modal Enhancement Styles */
        .detail-card {
            background: #f8f9fa;
            border-left: 4px solid #6366f1;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .detail-card:hover {
            background: #e3f2fd;
            transform: translateX(5px);
        }

        .detail-card label {
            font-weight: 600;
            color: #475569;
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
        }

        .detail-value {
            font-size: 16px;
            font-weight: 500;
            color: #1e293b;
            margin: 0;
        }

        .status-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.2));
            color: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }

        .status-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .status-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            opacity: 0.9;
        }

        .status-count {
            display: block;
            font-size: 24px;
            font-weight: 800;
        }

        .status-count.small {
            font-size: 14px;
        }

        .clickable-info-box {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .clickable-info-box:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .clickable-info-box:active {
            transform: translateY(-2px) scale(1.01);
        }

        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            border-radius: 15px 15px 0 0;
            border-bottom: none;
            padding: 20px 25px;
        }

        .modal-body {
            padding: 25px;
        }

        .badge {
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Animation for modal appearance */
        .modal.fade .modal-dialog {
            transform: scale(0.8) translateY(-50px);
            transition: all 0.3s ease;
        }

        .modal.show .modal-dialog {
            transform: scale(1) translateY(0);
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Sample error display -->
        <div class="alert alert-danger d-none">
            Error message here
        </div>

        <!-- Mobile Menu Button -->
        <button class="mobile-menu-btn d-md-none" id="mobileMenuBtn">
            <i class="fas fa-bars"></i>
        </button>

        @if (Auth::user()->role == 'admin')
        <div class="wrapper">
            <!-- Sample error display -->
            <div class="alert alert-danger d-none">
                Error message here
            </div>

            <!-- Mobile Menu Button -->
            <button class="mobile-menu-btn d-md-none" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Admin Sidebar -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="#" class="brand-link text-center position-relative">
                    <span class="brand-text">🌌 Galaxy Bakery</span>
                    <button class="btn btn-sm position-absolute sidebar-toggle-btn"
                        data-widget="pushmenu"
                        style="right: 15px; top: 50%; transform: translateY(-50%);">
                        <i class="fas fa-chevron-left" id="toggleIcon"></i>
                    </button>
                </a>

                <div class="sidebar d-flex flex-column" style="min-height: 100vh;">

                    <!-- User Panel -->
                    <div class="user-panel d-flex align-items-center mt-3 pb-3 mb-3">
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
                                <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>

                            <!-- Bahan Baku -->
                            <li class="nav-item {{ request()->is('bahanbaku*') || request()->is('riwayatBahanBaku*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ request()->is('bahanbaku*') || request()->is('riwayatBahanBaku*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-boxes"></i>
                                    <p>
                                        Bahan Baku
                                        <i class="right fas fa-angle-left" style="{{ request()->is('bahanbaku*') || request()->is('riwayatBahanBaku*') ? 'transform: rotate(-90deg);' : '' }}"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="{{ request()->is('bahanbaku*') || request()->is('riwayatBahanBaku*') ? 'display: block; max-height: 200px;' : '' }}">
                                    <li class="nav-item">
                                        <a href="/bahanbaku" class="nav-link {{ request()->is('bahanbaku') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Input Produksi</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/riwayatBahanBaku" class="nav-link {{ request()->is('riwayatBahanBaku') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Proses Bahan Baku</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Produksi Roti -->
                            <li class="nav-item {{ request()->is('produksiRoti*') || request()->is('riwayatProduksiRoti*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ request()->is('produksiRoti*') || request()->is('riwayatProduksiRoti*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-bread-slice"></i>
                                    <p>
                                        Produksi Roti
                                        <i class="right fas fa-angle-left" style="{{ request()->is('produksiRoti*') || request()->is('riwayatProduksiRoti*') ? 'transform: rotate(-90deg);' : '' }}"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="{{ request()->is('produksiRoti*') || request()->is('riwayatProduksiRoti*') ? 'display: block; max-height: 200px;' : '' }}">
                                    <li class="nav-item">
                                        <a href="/produksiRoti" class="nav-link {{ request()->is('produksiRoti') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Input Produksi</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/riwayatProduksiRoti" class="nav-link {{ request()->is('riwayatProduksiRoti') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Riwayat Produksi</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="/laporan" class="nav-link {{ request()->is('laporan*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-chart-line"></i>
                                    <p>Laporan</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/pengeluaran" class="nav-link {{ request()->is('pengeluaran*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-wallet"></i>
                                    <p>Pengeluaran</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/penjualan" class="nav-link {{ request()->is('penjualan*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-receipt"></i>
                                    <p>Penjualan</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/customer" class="nav-link {{ request()->is('customer*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users-cog"></i>
                                    <p>Manajemen Pelanggan</p>
                                </a>
                            </li>

                            <!-- Logout Button - Moved here for better visibility -->
                            <li class="nav-item logout-nav-item">
                                <a href="{{route('logout')}}" class="nav-link">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>Logout</p>
                                </a>
                            </li>
                        </ul>
                    </nav>

                </div>
            </aside>
        </div>
    </div>
    @elseif (Auth::user()->role == 'karyawan')

    <div class="wrapper">
        <!-- Sample error display -->
        <div class="alert alert-danger d-none">
            Error message here
        </div>

        <!-- Mobile Menu Button -->
        <button class="mobile-menu-btn d-md-none" id="mobileMenuBtn">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Karyawan Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link text-center position-relative">
                <span class="brand-text">🌌 Galaxy Bakery</span>
                <button class="btn btn-sm position-absolute sidebar-toggle-btn"
                    data-widget="pushmenu"
                    style="right: 15px; top: 50%; transform: translateY(-50%);">
                    <i class="fas fa-chevron-left" id="toggleIcon"></i>
                </button>
            </a>

            <div class="sidebar d-flex flex-column" style="min-height: 100vh;">

                <!-- User Panel -->
                <div class="user-panel d-flex align-items-center mt-3 pb-3 mb-3">
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
                            <a href="/dashboard-karyawan" class="nav-link {{ request()->is('dashboard-karyawan') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- Bahan Baku -->
                        <li class="nav-item {{ request()->is('karyawan-bahanbaku*') || request()->is('karyawan-riwayatbahanbaku*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('karyawan-bahanbaku*') || request()->is('karyawan-riwayatbahanbaku*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>
                                    Bahan Baku
                                    <i class="right fas fa-angle-left" style="{{ request()->is('karyawan-bahanbaku*') || request()->is('karyawan-riwayatbahanbaku*') ? 'transform: rotate(-90deg);' : '' }}"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="{{ request()->is('karyawan-bahanbaku*') || request()->is('karyawan-riwayatbahanbaku*') ? 'display: block; max-height: 200px;' : '' }}">
                                <li class="nav-item">
                                    <a href="/karyawan-bahanbaku" class="nav-link {{ request()->is('karyawan-bahanbaku') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Input Produksi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/karyawan-riwayatbahanbaku" class="nav-link {{ request()->is('karyawan-riwayatbahanbaku') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Proses Bahan Baku</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Produksi Roti -->
                        <li class="nav-item {{ request()->is('karyawan-produksiRoti*') || request()->is('karyawan-riwayatproduksiRoti*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('karyawan-produksiRoti*') || request()->is('karyawan-riwayatproduksiRoti*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-bread-slice"></i>
                                <p>
                                    Produksi Roti
                                    <i class="right fas fa-angle-left" style="{{ request()->is('karyawan-produksiRoti*') || request()->is('karyawan-riwayatproduksiRoti*') ? 'transform: rotate(-90deg);' : '' }}"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="{{ request()->is('karyawan-produksiRoti*') || request()->is('karyawan-riwayatproduksiRoti*') ? 'display: block; max-height: 200px;' : '' }}">
                                <li class="nav-item">
                                    <a href="/karyawan-produksiRoti" class="nav-link {{ request()->is('karyawan-produksiRoti') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Input Produksi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/karyawanriwayatProduksiRoti" class="nav-link {{ request()->is('karyawan-riwayatproduksiRoti') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Riwayat Produksi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="/karyawan-laporan" class="nav-link {{ request()->is('karyawan-laporan*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>Laporan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('karyawan.pengeluaran')}}" class="nav-link {{ request()->routeIs('karyawan.pengeluaran*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-wallet"></i>
                                <p>Pengeluaran</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/karyawan-penjualan" class="nav-link {{ request()->is('karyawan-penjualan*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-receipt"></i>
                                <p>Penjualan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/karyawan-customer" class="nav-link {{ request()->is('karyawan-customer*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>Manajemen Pelanggan</p>
                            </a>
                        </li>

                        <!-- Logout Button - Moved here for better visibility -->
                        <li class="nav-item logout-nav-item">
                            <a href="{{route('logout')}}" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </aside>
    </div>
    </div>
    @endif


    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <!-- Chart.js (opsional jika pakai chart) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Logout function
        function logout() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                // In Laravel, this would be handled by a form post to logout route
                // For demo purposes, we'll just show an alert
                alert('Logout functionality - In Laravel, this would redirect to logout route');
                // window.location.href = '/logout';
            }
        }

        // Enhanced sidebar toggle - SCRIPT SAMA SEPERTI ASLI
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

                // Force chart resize after sidebar toggle
                setTimeout(() => {
                    if (typeof produksiChart !== 'undefined') {
                        produksiChart.resize();
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

            // Enhanced Treeview Menu Handler
            document.querySelectorAll('.nav-item > .nav-link').forEach(function(link) {
                // Only handle links that have treeview submenu and right arrow icon
                const navItem = link.parentElement;
                const treeview = navItem.querySelector('.nav-treeview');
                const rightIcon = link.querySelector('.right');

                if (treeview && rightIcon) {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        // Don't open treeview when sidebar is collapsed on desktop
                        if (document.body.classList.contains('sidebar-collapse') && window.innerWidth > 768) {
                            return;
                        }

                        // Toggle the menu-open class
                        const isCurrentlyOpen = navItem.classList.contains('menu-open');

                        if (isCurrentlyOpen) {
                            // Close the treeview
                            navItem.classList.remove('menu-open');
                            treeview.style.maxHeight = '0px';
                            treeview.style.overflow = 'hidden';
                            rightIcon.style.transform = 'rotate(0deg)';

                            setTimeout(() => {
                                if (!navItem.classList.contains('menu-open')) {
                                    treeview.style.display = 'none';
                                }
                            }, 300);
                        } else {
                            // Open the treeview
                            navItem.classList.add('menu-open');
                            treeview.style.display = 'block';
                            treeview.style.overflow = 'hidden';
                            treeview.style.transition = 'max-height 0.3s ease';

                            // Calculate the height needed
                            const height = treeview.scrollHeight;

                            // Set max-height to enable smooth animation
                            requestAnimationFrame(() => {
                                treeview.style.maxHeight = height + 'px';
                            });

                            // Rotate the icon
                            rightIcon.style.transform = 'rotate(-90deg)';
                        }
                    });
                }
            });

            // Initialize treeview state on page load based on server-side classes
            document.querySelectorAll('.nav-item.menu-open').forEach(function(navItem) {
                const treeview = navItem.querySelector('.nav-treeview');
                const rightIcon = navItem.querySelector('.nav-link .right');

                if (treeview) {
                    // Ensure the treeview is visible and properly sized
                    treeview.style.display = 'block';
                    treeview.style.maxHeight = 'none';
                    treeview.style.overflow = 'visible';

                    // Set the icon rotation
                    if (rightIcon) {
                        rightIcon.style.transform = 'rotate(-90deg)';
                    }
                }
            });
        });

        // Enhanced info box animations
        document.querySelectorAll('.info-box').forEach(box => {
            box.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });

            box.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Add smooth scrolling
        document.documentElement.style.scrollBehavior = 'smooth';
    </script>

</body>

</html>