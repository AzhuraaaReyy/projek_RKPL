<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Pelanggan - Galaxy Bakery</title>
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
        /* Custom styles for edit customer page - Galaxy Theme */
        .edit-customer-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 20px 0;
        }

        .edit-customer-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .edit-customer-header::before {
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

        .edit-customer-header h1 {
            font-size: 3rem;
            font-weight: 800;
            margin: 0;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 2;
        }

        .edit-customer-header .subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-top: 10px;
            position: relative;
            z-index: 2;
        }

        .form-section {
            background: #f8fafc;
            padding: 40px;
            border-bottom: 1px solid #e2e8f0;
        }

        .form-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            overflow: hidden;
            position: relative;
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .section-header {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 25px 30px;
            margin: -40px -40px 40px -40px;
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

        .section-header h3 {
            margin: 0;
            font-weight: 700;
            font-size: 1.5rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            transform: translateY(-2px);
            background: #f8faff;
        }

        .form-control:hover {
            border-color: #b794f6;
            transform: translateY(-1px);
        }

        .form-group label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 10px;
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        .form-group label i {
            margin-right: 8px;
            color: #667eea;
        }

        .required {
            color: #e53e3e;
            margin-left: 4px;
        }

        .btn {
            border-radius: 12px;
            font-weight: 600;
            padding: 12px 24px;
            font-size: 14px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #718096 0%, #4a5568 100%);
            border: none;
            color: white;
            box-shadow: 0 4px 15px rgba(113, 128, 150, 0.3);
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(113, 128, 150, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
            border: none;
            color: white;
            box-shadow: 0 4px 15px rgba(237, 137, 54, 0.3);
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #dd6b20 0%, #c05621 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(237, 137, 54, 0.4);
        }

        .preview-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .preview-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #38b2ac 0%, #319795 100%);
        }

        .preview-header {
            background: linear-gradient(135deg, #38b2ac 0%, #319795 100%);
            color: white;
            padding: 20px 25px;
            margin: -30px -30px 25px -30px;
            border-radius: 20px 20px 0 0;
        }

        .preview-header h5 {
            margin: 0;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .customer-preview {
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            border-radius: 15px;
            padding: 25px;
            border-left: 4px solid #667eea;
            position: relative;
            overflow: hidden;
        }

        .customer-preview::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.05) 0%, transparent 70%);
        }

        .customer-preview .user-panel {
            position: relative;
            z-index: 2;
        }

        .info-item {
            background: white;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border-left: 3px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            transform: translateX(5px);
            border-left-color: #667eea;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .status-toggle {
            transform: scale(1.3);
        }

        .custom-control-label::before {
            border-radius: 20px;
            border: 2px solid #e2e8f0;
        }

        .custom-control-input:checked~.custom-control-label::before {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            border-color: #48bb78;
        }

        .alert {
            border-radius: 15px;
            border: none;
            padding: 20px 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            background: linear-gradient(135deg, #c6f6d5 0%, #9ae6b4 100%);
            color: #22543d;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fed7d7 0%, #feb2b2 100%);
            color: #742a2a;
        }

        .alert-info {
            background: linear-gradient(135deg, #bee3f8 0%, #90cdf4 100%);
            color: #2c5282;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: "/";
            color: #a0aec0;
        }

        .breadcrumb-item a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-item a:hover {
            color: #5a67d8;
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            color: #4a5568;
            font-weight: 600;
        }

        /* Statistics Cards */
        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .stats-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 20px;
        }

        .stats-icon.info {
            background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
            color: white;
        }

        .stats-icon.success {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
        }

        /* Help Card */
        .help-card {
            background: linear-gradient(135deg, #e6fffa 0%, #b2f5ea 100%);
            border: 1px solid #81e6d9;
            border-radius: 15px;
            padding: 20px;
        }

        .help-card .card-header {
            background: linear-gradient(135deg, #38b2ac 0%, #319795 100%);
            margin: -20px -20px 20px -20px;
            border-radius: 15px 15px 0 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .edit-customer-container {
                margin: 10px;
                border-radius: 15px;
            }

            .edit-customer-header {
                padding: 30px 20px;
            }

            .edit-customer-header h1 {
                font-size: 2.2rem;
            }

            .form-section {
                padding: 20px;
            }

            .form-card {
                padding: 25px;
            }

            .section-header {
                margin: -25px -25px 25px -25px;
                padding: 20px 25px;
            }

            .preview-card {
                padding: 20px;
            }

            .preview-header {
                margin: -20px -20px 20px -20px;
            }
        }

        /* Animation Enhancements */
        .animate-on-load {
            opacity: 0;
            transform: translateY(30px);
            animation: slideInUp 0.8s ease forwards;
        }

        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Form Validation Styles */
        .is-invalid {
            border-color: #e53e3e !important;
            box-shadow: 0 0 0 0.2rem rgba(229, 62, 62, 0.25) !important;
        }

        .invalid-feedback {
            background: #fed7d7;
            color: #742a2a;
            padding: 8px 12px;
            border-radius: 8px;
            margin-top: 8px;
            font-size: 13px;
            font-weight: 500;
        }

        /* Content Header Styling */
        .content-header {
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            border-bottom: 1px solid #e2e8f0;
            padding: 30px 0;
        }

        .content-header h1 {
            color: #2d3748;
            font-weight: 700;
            font-size: 2rem;
            margin: 0;
        }

        /* Loading Animation */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .loading-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #e2e8f0;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Loading Overlay -->
        <div class="loading-overlay" id="loadingOverlay">
            <div class="loading-spinner"></div>
        </div>

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

                        <li class="nav-item has-treeview menu-open">
                            <a href="{{ route('customers') }}" class="nav-link active">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>Manajemen User<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('customers') }}" class="nav-link active">
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
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>
                                <i class="fas fa-user-edit mr-2"></i>Edit Pelanggan
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('customers') }}">Manajemen Pelanggan</a></li>
                                <li class="breadcrumb-item active">Edit Pelanggan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="content">
                <div class="edit-customer-container animate__animated animate__fadeIn">

                    <!-- Header Section -->
                    <div class="edit-customer-header">
                        <h1><i class="fas fa-user-edit mr-3"></i>Edit Pelanggan</h1>
                        <p class="subtitle">Galaxy Bakery - Customer Management System</p>
                    </div>

                    <!-- Form Section -->
                    <div class="form-section">
                        <div class="container-fluid">

                            <!-- Alert Messages -->
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeInDown" role="alert">
                                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeInDown" role="alert">
                                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <!-- Validation Errors -->
                            @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeInDown" role="alert">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                <strong>Terdapat kesalahan pada form:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <div class="row animate-on-load">
                                <!-- Form Edit Pelanggan -->
                                <div class="col-lg-8">
                                    <div class="form-card">
                                        <div class="section-header">
                                            <h3>
                                                <i class="fas fa-edit mr-2"></i>
                                                Form Edit Data Pelanggan
                                            </h3>
                                        </div>

                                        <form method="POST" action="{{ route('customers.update', $customer->id) }}" id="editCustomerForm">
                                            @csrf
                                            @method('PUT')

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="name">
                                                            <i class="fas fa-user"></i>
                                                            Nama Pelanggan <span class="required">*</span>
                                                        </label>
                                                        <input type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            id="name"
                                                            name="name"
                                                            value="{{ old('name', $customer->name) }}"
                                                            placeholder="Masukkan nama lengkap pelanggan"
                                                            required>
                                                        @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone">
                                                            <i class="fas fa-phone"></i>
                                                            No. Telepon <span class="required">*</span>
                                                        </label>
                                                        <input type="tel"
                                                            class="form-control @error('phone') is-invalid @enderror"
                                                            id="phone"
                                                            name="phone"
                                                            value="{{ old('phone', $customer->phone) }}"
                                                            placeholder="Contoh: 081234567890"
                                                            required>
                                                        @error('phone')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="is_active">
                                                            <i class="fas fa-toggle-on"></i>
                                                            Status Pelanggan
                                                        </label>
                                                        <div class="d-flex align-items-center">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox"
                                                                    class="custom-control-input status-toggle"
                                                                    id="is_active"
                                                                    name="is_active"
                                                                    value="1"
                                                                    {{ old('is_active', $customer->is_active) ? 'checked' : '' }}>
                                                                <label class="custom-control-label" for="is_active">
                                                                    <span class="text-success" id="status-active" style="{{ $customer->is_active ? '' : 'display: none;' }}">
                                                                        <i class="fas fa-check-circle mr-1"></i>Aktif
                                                                    </span>
                                                                    <span class="text-muted" id="status-inactive" style="{{ $customer->is_active ? 'display: none;' : '' }}">
                                                                        <i class="fas fa-times-circle mr-1"></i>Tidak Aktif
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <small class="form-text text-muted">
                                                            Status aktif menandakan pelanggan masih melakukan transaksi
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="address">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                            Alamat Lengkap <span class="required">*</span>
                                                        </label>
                                                        <textarea class="form-control @error('address') is-invalid @enderror"
                                                            id="address"
                                                            name="address"
                                                            rows="4"
                                                            placeholder="Masukkan alamat lengkap pelanggan..."
                                                            required>{{ old('address', $customer->address) }}</textarea>
                                                        @error('address')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <div class="d-flex justify-content-between">
                                                        <a href="{{ route('customers') }}" class="btn btn-secondary">
                                                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                                                        </a>
                                                        <div>
                                                            <button type="reset" class="btn btn-warning mr-2" onclick="resetForm()">
                                                                <i class="fas fa-undo mr-2"></i>Reset
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="fas fa-save mr-2"></i>Simpan Perubahan
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Preview & Info Panel -->
                                <div class="col-lg-4">
                                    <!-- Customer Info Preview -->
                                    <div class="preview-card">
                                        <div class="preview-header">
                                            <h5>
                                                <i class="fas fa-info-circle mr-2"></i>
                                                Preview Data Pelanggan
                                            </h5>
                                        </div>

                                        <div class="customer-preview">
                                            <div class="user-panel d-flex align-items-center mb-3">
                                                <div class="image">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($customer->name) }}&background={{ $customer->is_active ? '007bff' : '6c757d' }}&color=fff&size=60"
                                                        class="img-circle elevation-2"
                                                        alt="Customer Avatar"
                                                        id="preview-avatar">
                                                </div>
                                                <div class="info ml-3">
                                                    <h5 class="mb-1" id="preview-name">{{ $customer->name }}</h5>
                                                    <small class="text-muted" id="preview-status">
                                                        {{ $customer->is_active ? 'Pelanggan Aktif' : 'Pelanggan Tidak Aktif' }}
                                                    </small>
                                                </div>
                                            </div>

                                            <div class="info-item">
                                                <i class="fas fa-phone text-info mr-2"></i>
                                                <span id="preview-phone">{{ $customer->phone }}</span>
                                            </div>

                                            <div class="info-item">
                                                <i class="fas fa-map-marker-alt text-danger mr-2"></i>
                                                <span id="preview-address">{{ $customer->address }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Customer Statistics -->
                                    <div class="preview-card">
                                        <div class="preview-header">
                                            <h5>
                                                <i class="fas fa-chart-bar mr-2"></i>
                                                Statistik Pelanggan
                                            </h5>
                                        </div>

                                        <div class="row text-center">
                                            <div class="col-6">
                                                <div class="stats-card">
                                                    <div class="stats-icon info">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </div>
                                                    <h6>{{ $customer->total_transactions ?? 0 }}</h6>
                                                    <small class="text-muted">Total Transaksi</small>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="stats-card">
                                                    <div class="stats-icon success">
                                                        <i class="fas fa-money-bill-wave"></i>
                                                    </div>
                                                    <h6>Rp {{ number_format($customer->total_spent ?? 0, 0, ',', '.') }}</h6>
                                                    <small class="text-muted">Total Belanja</small>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="text-center">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar mr-1"></i>
                                                Bergabung: {{ $customer->created_at->format('d M Y') }}
                                            </small>
                                            @if($customer->last_purchase)
                                            <br>
                                            <small class="text-muted">
                                                <i class="fas fa-clock mr-1"></i>
                                                Terakhir belanja: {{ \Carbon\Carbon::parse($customer->last_purchase)->diffForHumans() }}
                                            </small>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Help Card -->
                                    <div class="help-card">
                                        <div class="card-header">
                                            <h5 class="text-white mb-0">
                                                <i class="fas fa-question-circle mr-2"></i>
                                                Bantuan
                                            </h5>
                                        </div>
                                        <div class="mt-3">
                                            <small class="text-muted">
                                                <i class="fas fa-lightbulb text-warning mr-1"></i>
                                                <strong>Tips:</strong> Pastikan data yang dimasukkan akurat untuk memudahkan komunikasi dengan pelanggan.
                                            </small>
                                            <hr>
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle text-info mr-1"></i>
                                                Status aktif akan otomatis berubah ketika pelanggan melakukan transaksi.
                                            </small>
                                        </div>
                                    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <script>
        $(document).ready(function() {
            // Add loading animation on page load
            $('#loadingOverlay').addClass('active');
            setTimeout(() => {
                $('#loadingOverlay').removeClass('active');
            }, 1000);

            // Live preview updates
            $('#name').on('input', function() {
                const name = $(this).val() || 'Nama Pelanggan';
                $('#preview-name').text(name);
                updateAvatar();
            });

            $('#phone').on('input', function() {
                const phone = $(this).val() || 'No. Telepon';
                $('#preview-phone').text(phone);
            });

            $('#address').on('input', function() {
                const address = $(this).val() || 'Alamat Pelanggan';
                $('#preview-address').text(address);
            });

            // Status toggle
            $('#is_active').on('change', function() {
                const isActive = $(this).is(':checked');
                if (isActive) {
                    $('#status-active').show();
                    $('#status-inactive').hide();
                    $('#preview-status').text('Pelanggan Aktif');
                } else {
                    $('#status-active').hide();
                    $('#status-inactive').show();
                    $('#preview-status').text('Pelanggan Tidak Aktif');
                }
                updateAvatar();
            });

            function updateAvatar() {
                const name = $('#name').val() || 'Nama Pelanggan';
                const isActive = $('#is_active').is(':checked');
                const backgroundColor = isActive ? '007bff' : '6c757d';
                const avatarUrl = `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&background=${backgroundColor}&color=fff&size=60`;
                $('#preview-avatar').attr('src', avatarUrl);
            }

            // Enhanced form validation
            $('#editCustomerForm').on('submit', function(e) {
                let isValid = true;

                // Show loading
                $('#loadingOverlay').addClass('active');

                // Check required fields
                const requiredFields = ['name', 'phone', 'address'];
                requiredFields.forEach(function(field) {
                    const input = $(`#${field}`);
                    if (!input.val().trim()) {
                        input.addClass('is-invalid');
                        isValid = false;
                    } else {
                        input.removeClass('is-invalid');
                    }
                });

                // Phone number validation
                const phone = $('#phone').val();
                const phonePattern = /^[0-9+\-\s()]+$/;
                if (phone && !phonePattern.test(phone)) {
                    $('#phone').addClass('is-invalid');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                    $('#loadingOverlay').removeClass('active');
                    showAlert('danger', 'Mohon lengkapi semua field yang wajib diisi!');

                    // Scroll to first invalid field
                    const firstInvalid = $('.is-invalid').first();
                    if (firstInvalid.length) {
                        $('html, body').animate({
                            scrollTop: firstInvalid.offset().top - 100
                        }, 500);
                    }
                }
            });

            // Input validation on typing
            $('#phone').on('input', function() {
                const phone = $(this).val();
                const phonePattern = /^[0-9+\-\s()]*$/;
                if (phone && !phonePattern.test(phone)) {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            // Auto hide alerts
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);

            // Add animation to form elements on load
            $('.form-control, .btn').each(function(index) {
                $(this).css({
                    'animation-delay': (index * 0.1) + 's'
                }).addClass('animate__animated animate__fadeInUp');
            });

            // Enhanced hover effects
            $('.form-control').on('focus', function() {
                $(this).parent().addClass('animate__animated animate__pulse animate__faster');
            }).on('blur', function() {
                $(this).parent().removeClass('animate__animated animate__pulse animate__faster');
            });
        });

        function resetForm() {
            if (confirm('Apakah Anda yakin ingin mereset form? Semua perubahan akan hilang.')) {
                document.getElementById('editCustomerForm').reset();

                // Reset preview to original values
                $('#preview-name').text('{{ $customer->name }}');
                $('#preview-phone').text('{{ $customer->phone }}');
                $('#preview-address').text('{{ $customer->address }}');
                $('#preview-status').text('{{ $customer->is_active ? "Pelanggan Aktif" : "Pelanggan Tidak Aktif" }}');

                const originalAvatar = 'https://ui-avatars.com/api/?name={{ urlencode($customer->name) }}&background={{ $customer->is_active ? "007bff" : "6c757d" }}&color=fff&size=60';
                $('#preview-avatar').attr('src', originalAvatar);

                // Reset validation classes
                $('.form-control').removeClass('is-invalid');

                showAlert('info', 'Form telah direset ke data asli.');
            }
        }

        function showAlert(type, message) {
            const alertClass = type === 'danger' ? 'alert-danger' :
                type === 'success' ? 'alert-success' :
                type === 'warning' ? 'alert-warning' : 'alert-info';

            const iconClass = type === 'danger' ? 'fa-exclamation-circle' :
                type === 'success' ? 'fa-check-circle' :
                type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle';

            const alertHtml = `
                <div class="alert ${alertClass} alert-dismissible fade show animate__animated animate__fadeInDown" role="alert">
                    <i class="fas ${iconClass} mr-2"></i>${message}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            `;

            $('.container-fluid').prepend(alertHtml);

            setTimeout(function() {
                $('.alert').first().fadeOut('slow');
            }, 3000);
        }

        // Enhanced sidebar toggle
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.querySelector('[data-widget="pushmenu"]');
            const toggleIcon = document.getElementById('toggleIcon');
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');

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

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey && e.key === 'b') {
                    e.preventDefault();
                    toggleSidebar();
                }
                if (e.ctrlKey && e.key === 's') {
                    e.preventDefault();
                    $('#editCustomerForm').submit();
                }
            });

            // Add stagger animation on load
            const animateElements = document.querySelectorAll('.animate-on-load');
            animateElements.forEach((el, index) => {
                setTimeout(() => {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 200);
            });
        });

        // Initialize tooltips and other Bootstrap components
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="popover"]').popover();
        });

        // Add smooth scrolling
        document.documentElement.style.scrollBehavior = 'smooth';
    </script>
</body>

</html>