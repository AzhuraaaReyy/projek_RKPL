<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Customer - Galaxy Bakery</title>
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
        /* Custom styles for tambah customer page - matching laporan theme */
        .customer-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 20px 0;
        }

        .customer-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .customer-header::before {
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

        .customer-header h1 {
            font-size: 3rem;
            font-weight: 800;
            margin: 0;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 2;
        }

        .customer-header .subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-top: 10px;
            position: relative;
            z-index: 2;
        }

        .form-section {
            background: #f8fafc;
            padding: 50px 30px;
        }

        .form-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .form-title {
            color: #2d3748;
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 30px;
            text-align: center;
            position: relative;
        }

        .form-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 8px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: white;
            transform: translateY(-2px);
        }

        .form-control:hover {
            border-color: #cbd5e0;
            background: white;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .btn {
            border-radius: 12px;
            padding: 15px 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: all 0.6s ease;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #718096 0%, #4a5568 100%);
            color: white;
            box-shadow: 0 8px 25px rgba(113, 128, 150, 0.3);
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%);
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(113, 128, 150, 0.4);
        }

        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid #e2e8f0;
        }

        .form-check {
            background: #f7fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 15px 20px;
            margin: 20px 0;
            transition: all 0.3s ease;
        }

        .form-check:hover {
            background: #edf2f7;
            border-color: #cbd5e0;
        }

        .form-check-input {
            margin-top: 0.25rem;
        }

        .form-check-label {
            font-weight: 500;
            color: #4a5568;
            margin-left: 8px;
        }

        .input-group-text {
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e0 100%);
            border: 2px solid #e2e8f0;
            border-right: none;
            color: #4a5568;
            font-weight: 600;
        }

        .input-group .form-control {
            border-left: none;
        }

        .input-group:focus-within .input-group-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
            color: white;
        }

        /* Icon styling */
        .form-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
            pointer-events: none;
            z-index: 10;
        }

        .form-group {
            position: relative;
        }

        .form-control.with-icon {
            padding-right: 45px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .customer-container {
                margin: 10px;
                border-radius: 15px;
            }

            .customer-header {
                padding: 30px 20px;
            }

            .customer-header h1 {
                font-size: 2.2rem;
            }

            .form-section {
                padding: 30px 20px;
            }

            .form-card {
                padding: 25px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }

        /* Animation for form elements */
        .form-group {
            opacity: 0;
            transform: translateY(30px);
            animation: slideInUp 0.6s ease forwards;
        }

        .form-group:nth-child(1) {
            animation-delay: 0.1s;
        }

        .form-group:nth-child(2) {
            animation-delay: 0.2s;
        }

        .form-group:nth-child(3) {
            animation-delay: 0.3s;
        }

        .form-group:nth-child(4) {
            animation-delay: 0.4s;
        }

        .form-actions {
            animation-delay: 0.5s;
        }

        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Success message styling */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 20px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
        }

        /* Loading state */
        .btn.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .btn.loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            margin: auto;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: button-loading-spinner 1s ease infinite;
        }

        @keyframes button-loading-spinner {
            from {
                transform: rotate(0turn);
            }

            to {
                transform: rotate(1turn);
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
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=6366f1&color=fff&size=128" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info ml-3">
                        <a href="#" class="d-block">{{ Auth::user()->name ?? 'User' }}</a>
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
                            <a href="/customer" class="nav-link active">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>Manajemen User<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/customer" class="nav-link active">
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
                            <h1>Tambah Customer</h1>
                            <small>Add New Customer - Galaxy Bakery</small>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="row mt-3 mt-lg-0">
                                <div class="col-12 mb-2">
                                    <div class="header-info-box text-center">
                                        <i class="fas fa-user-circle mr-2"></i>
                                        <span class="font-weight-bold">{{ Auth::user()->name ?? 'User' }}</span>
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
                <div class="customer-container animate__animated animate__fadeIn">

                    <!-- Header Section -->
                    <div class="customer-header">
                        <h1>👥 Tambah Customer</h1>
                        <p class="subtitle">Galaxy Bakery - Customer Management</p>
                    </div>

                    <!-- Form Section -->
                    <div class="form-section">
                        <div class="form-card">
                            <h2 class="form-title">Form Tambah Customer Baru</h2>

                            <!-- Success/Error Messages -->
                            @if(session('success'))
                            <div class="alert alert-success animate__animated animate__fadeInDown">
                                <i class="fas fa-check-circle mr-2"></i>
                                {{ session('success') }}
                            </div>
                            @endif

                            @if($errors->any())
                            <div class="alert alert-danger animate__animated animate__fadeInDown">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                <strong>Terjadi kesalahan:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form action="{{route('karyawan.addcustomers')}}" method="POST" id="customerForm">
                                @csrf

                                <div class="form-group">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-user mr-2"></i>Nama Customer
                                    </label>
                                    <input type="text" class="form-control with-icon" id="name" name="name"
                                        value="{{ old('name') }}" required maxlength="100"
                                        placeholder="Masukkan nama lengkap customer">
                                    <i class="fas fa-user form-icon"></i>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="form-label">
                                        <i class="fas fa-phone mr-2"></i>Nomor Telepon
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            value="{{ old('phone') }}" maxlength="13"
                                            placeholder="08xxxxxxxxxx"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    </div>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Masukkan nomor telepon yang aktif (maksimal 13 digit)
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="address" class="form-label">
                                        <i class="fas fa-map-marker-alt mr-2"></i>Alamat
                                    </label>
                                    <textarea class="form-control" id="address" name="address" rows="4"
                                        placeholder="Masukkan alamat lengkap customer">{{ old('address') }}</textarea>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Alamat lengkap untuk pengiriman produk
                                    </small>
                                </div>

                                <div class="form-group" style="display: none;">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" checked>
                                        <label class="form-check-label" for="is_active">
                                            <i class="fas fa-check-circle mr-2"></i>Status Aktif
                                        </label>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="button" class="btn btn-secondary" onclick="resetForm()">
                                        <i class="fas fa-undo mr-2"></i>Reset Form
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="submitBtn">
                                        <i class="fas fa-save mr-2"></i>Simpan Customer
                                    </button>
                                </div>
                            </form>
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
        // Enhanced sidebar toggle - Same as laporan
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

        // Form functionality
        function resetForm() {
            document.getElementById('customerForm').reset();

            // Remove any validation classes
            document.querySelectorAll('.form-control').forEach(function(input) {
                input.classList.remove('is-valid', 'is-invalid');
            });

            // Add reset animation
            document.querySelector('.form-card').classList.add('animate__animated', 'animate__pulse');
            setTimeout(() => {
                document.querySelector('.form-card').classList.remove('animate__animated', 'animate__pulse');
            }, 1000);
        }

        // Form submission with loading state
        document.getElementById('customerForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');

            // Add loading state
            submitBtn.classList.add('loading');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
            submitBtn.disabled = true;

            // If form validation fails, restore button
            setTimeout(() => {
                if (!this.checkValidity()) {
                    submitBtn.classList.remove('loading');
                    submitBtn.innerHTML = '<i class="fas fa-save mr-2"></i>Simpan Customer';
                    submitBtn.disabled = false;
                }
            }, 100);
        });

        // Input validation and formatting
        document.getElementById('name').addEventListener('input', function() {
            this.value = this.value.replace(/[0-9]/g, ''); // Remove numbers
        });

        document.getElementById('phone').addEventListener('input', function() {
            // Format phone number
            let value = this.value.replace(/[^0-9]/g, '');
            if (value.length > 13) {
                value = value.slice(0, 13);
            }
            this.value = value;
        });

        // Real-time form validation
        document.querySelectorAll('.form-control').forEach(function(input) {
            input.addEventListener('blur', function() {
                if (this.value.trim() !== '' && this.checkValidity()) {
                    this.classList.add('is-valid');
                    this.classList.remove('is-invalid');
                } else if (this.value.trim() !== '') {
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');
                }
            });

            input.addEventListener('input', function() {
                this.classList.remove('is-valid', 'is-invalid');
            });
        });

        // Initialize
        $(document).ready(function() {
            // Add hover effects to form elements
            $('.form-control').hover(
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

            // Phone number formatting
            $('#phone').on('input', function() {
                let value = $(this).val().replace(/[^0-9]/g, '');
                if (value.length > 4 && value.length <= 8) {
                    value = value.slice(0, 4) + '-' + value.slice(4);
                } else if (value.length > 8) {
                    value = value.slice(0, 4) + '-' + value.slice(4, 8) + '-' + value.slice(8, 13);
                }
                $(this).val(value);
            });
        });

        // Start date/time updates
        updateDateTime();
        setInterval(updateDateTime, 1000);

        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Add smooth scrolling
        document.documentElement.style.scrollBehavior = 'smooth';

        // Form focus management
        document.getElementById('name').focus();
    </script>

</body>

</html>