<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Bahan Baku - Galaxy Bakery</title>
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
                            <a href="/dashboard" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <a href="/monitoring" class="nav-link active">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>Bahan Baku<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview" style="display: block;">
                                <li class="nav-item">
                                    <a href="/bahanbaku" class="nav-link active">
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
                            <h1>
                                <i class="fas fa-cubes mr-3"></i>
                                Tambah Bahan Baku
                            </h1>
                            <small>Registrasi bahan baku baru untuk Galaxy Bakery</small>
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
                <!-- Alerts -->
                @if ($errors->any())
                <div class="row animate__animated animate__fadeInUp">
                    <div class="col-12">
                        <div class="alert alert-danger alert-dismissible fade show modern-alert" role="alert">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Form Container -->
                <div class="row animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="col-12">
                        <div class="futuristic-form-container">
                            <div class="form-glow-effect"></div>
                            <div class="form-header">
                                <div class="form-header-content">
                                    <div class="form-icon-container">
                                        <i class="fas fa-atom form-main-icon"></i>
                                    </div>
                                    <div class="form-header-text">
                                        <h2 class="form-title">Registrasi Bahan Baku</h2>
                                        <p class="form-subtitle">Tambahkan bahan baku baru ke inventory Galaxy Bakery</p>
                                    </div>
                                    <div class="form-status-indicator">
                                        <div class="status-dot"></div>
                                        <span>Inventory System</span>
                                    </div>
                                </div>
                            </div>
                            
                            <form action="{{route('bahanBakus')}}" method="POST" class="futuristic-form">
                                @csrf

                                <!-- Basic Information Section -->
                                <div class="futuristic-section" data-step="1">
                                    <div class="section-header">
                                        <div class="section-number">01</div>
                                        <div class="section-info">
                                            <h4 class="section-title">
                                                <i class="fas fa-info-circle text-primary mr-2"></i>
                                                Informasi Dasar
                                            </h4>
                                            <p class="section-subtitle">Detail identitas bahan baku</p>
                                        </div>
                                        <div class="section-progress">
                                            <div class="progress-ring">
                                                <div class="progress-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="section-content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="futuristic-input-group">
                                                    <div class="input-wrapper">
                                                        <label for="nama" class="floating-label">
                                                            <i class="fas fa-tag input-icon"></i>
                                                            Nama Bahan Baku
                                                        </label>
                                                        <input type="text" name="nama" id="nama" 
                                                               class="futuristic-input @error('nama') is-invalid @enderror" 
                                                               value="{{ old('nama') }}" 
                                                               maxlength="255" 
                                                               placeholder="Contoh: Tepung Terigu Premium">
                                                        <div class="input-border-effect"></div>
                                                        <div class="input-glow"></div>
                                                        @error('nama') 
                                                        <div class="futuristic-error">
                                                            <i class="fas fa-exclamation-triangle"></i>
                                                            {{ $message }}
                                                        </div> 
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="futuristic-input-group">
                                                    <div class="input-wrapper">
                                                        
                                                        <select name="kategori" id="kategori" 
                                                                class="futuristic-select @error('kategori') is-invalid @enderror">
                                                            <option value="">Pilih kategori bahan</option>
                                                            <option value="kering" {{ old('kategori') == 'kering' ? 'selected' : '' }}>
                                                                🌾 Kering (Tepung, Gula, dll)
                                                            </option>
                                                            <option value="cair" {{ old('kategori') == 'cair' ? 'selected' : '' }}>
                                                                💧 Cair (Susu, Minyak, dll)
                                                            </option>
                                                            <option value="beku" {{ old('kategori') == 'beku' ? 'selected' : '' }}>
                                                                ❄️ Beku (Butter, Es Krim, dll)
                                                            </option>
                                                        </select>
                                                        <div class="select-arrow-modern">
                                                            <i class="fas fa-chevron-down"></i>
                                                        </div>
                                                        <div class="input-border-effect"></div>
                                                        <div class="input-glow"></div>
                                                        @error('kategori') 
                                                        <div class="futuristic-error">
                                                            <i class="fas fa-exclamation-triangle"></i>
                                                            {{ $message }}
                                                        </div> 
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="futuristic-input-group">
                                            <div class="input-wrapper">
                                                <label for="deskripsi" class="floating-label">
                                                    <i class="fas fa-align-left input-icon"></i>
                                                    Deskripsi Bahan Baku
                                                </label>
                                                <textarea name="deskripsi" id="deskripsi" 
                                                          class="futuristic-textarea @error('deskripsi') is-invalid @enderror" 
                                                          rows="4" 
                                                          placeholder="Deskripsikan kualitas, merek, atau spesifikasi khusus...">{{ old('deskripsi') }}</textarea>
                                                <div class="input-border-effect"></div>
                                                <div class="input-glow"></div>
                                                @error('deskripsi') 
                                                <div class="futuristic-error">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $message }}
                                                </div> 
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Inventory & Stock Section -->
                                <div class="futuristic-section" data-step="2">
                                    <div class="section-header">
                                        <div class="section-number">02</div>
                                        <div class="section-info">
                                            <h4 class="section-title">
                                                <i class="fas fa-warehouse text-success mr-2"></i>
                                                Inventori & Stok
                                            </h4>
                                            <p class="section-subtitle">Manajemen stok dan harga bahan baku</p>
                                        </div>
                                        <div class="section-progress">
                                            <div class="progress-ring">
                                                <div class="progress-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="section-content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="futuristic-input-group">
                                                    <div class="input-wrapper">
                                                        <label for="stok" class="floating-label">
                                                            <i class="fas fa-cubes input-icon"></i>
                                                            Stok Awal
                                                        </label>
                                                        <input type="number" name="stok" id="stok" 
                                                               class="futuristic-input @error('stok') is-invalid @enderror" 
                                                               value="{{ old('stok') }}" 
                                                               min="0" 
                                                               placeholder="100">
                                                        <div class="stock-indicator" id="stockIndicator">
                                                            <span class="stock-status">Normal</span>
                                                        </div>
                                                        <div class="input-border-effect"></div>
                                                        <div class="input-glow"></div>
                                                        @error('stok') 
                                                        <div class="futuristic-error">
                                                            <i class="fas fa-exclamation-triangle"></i>
                                                            {{ $message }}
                                                        </div> 
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="futuristic-input-group">
                                                    <div class="input-wrapper">
                                                        
                                                        <select name="satuan" id="satuan" 
                                                                class="futuristic-select @error('satuan') is-invalid @enderror">
                                                            <option value="">
                                                                <i class="fas fa-balance-scale input-icon"></i>
                                                                Satuan Pengukuran
                                                            </option>
                                                            <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>
                                                                ⚖️ Kilogram (kg)
                                                            </option>
                                                            <option value="gram" {{ old('satuan') == 'gram' ? 'selected' : '' }}>
                                                                📏 Gram (g)
                                                            </option>
                                                            <option value="liter" {{ old('satuan') == 'liter' ? 'selected' : '' }}>
                                                                🥛 Liter (L)
                                                            </option>
                                                        </select>
                                                        <div class="select-arrow-modern">
                                                            <i class="fas fa-chevron-down"></i>
                                                        </div>
                                                        <div class="input-border-effect"></div>
                                                        <div class="input-glow"></div>
                                                        @error('satuan') 
                                                        <div class="futuristic-error">
                                                            <i class="fas fa-exclamation-triangle"></i>
                                                            {{ $message }}
                                                        </div> 
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="futuristic-input-group">
                                                    <div class="input-wrapper">
                                                        <label for="minimum_stok" class="floating-label">
                                                            <i class="fas fa-exclamation-triangle input-icon"></i>
                                                            Minimum Stok Alert
                                                        </label>
                                                        <input type="number" name="minimum_stok" id="minimum_stok" 
                                                               class="futuristic-input @error('minimum_stok') is-invalid @enderror" 
                                                               value="{{ old('minimum_stok') }}" 
                                                               min="0" 
                                                               placeholder="10">
                                                        <button type="button" class="smart-suggest-btn" id="suggestMinStockBtn">
                                                            <i class="fas fa-lightbulb"></i>
                                                        </button>
                                                        <div class="input-border-effect"></div>
                                                        <div class="input-glow"></div>
                                                        @error('minimum_stok') 
                                                        <div class="futuristic-error">
                                                            <i class="fas fa-exclamation-triangle"></i>
                                                            {{ $message }}
                                                        </div> 
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="futuristic-input-group">
                                                    <div class="input-wrapper">
                                                        <label for="harga" class="floating-label">
                                                            <i class="fas fa-dollar-sign input-icon"></i>
                                                            Harga per Satuan
                                                        </label>
                                                        <input type="number" name="harga" id="harga" 
                                                               class="futuristic-input @error('harga') is-invalid @enderror" 
                                                               value="{{ old('harga') }}" 
                                                               step="0.01" 
                                                               min="0" 
                                                               placeholder="25000">
                                                        <div class="input-prefix-modern">Rp</div>
                                                        <button type="button" class="market-price-btn" id="marketPriceBtn">
                                                            <i class="fas fa-chart-line"></i>
                                                        </button>
                                                        <div class="input-border-effect"></div>
                                                        <div class="input-glow"></div>
                                                        @error('harga') 
                                                        <div class="futuristic-error">
                                                            <i class="fas fa-exclamation-triangle"></i>
                                                            {{ $message }}
                                                        </div> 
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Date & Expiry Section -->
                                <div class="futuristic-section" data-step="3">
                                    <div class="section-header">
                                        <div class="section-number">03</div>
                                        <div class="section-info">
                                            <h4 class="section-title">
                                                <i class="fas fa-calendar-check text-warning mr-2"></i>
                                                Tanggal & Masa Berlaku
                                            </h4>
                                            <p class="section-subtitle">Manajemen tanggal dan kedaluwarsa</p>
                                        </div>
                                        <div class="section-progress">
                                            <div class="progress-ring">
                                                <div class="progress-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="section-content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="futuristic-input-group">
                                                    <div class="input-wrapper">
                                                        <label for="tanggal_masuk" class="floating-label">
                                                            <i class="fas fa-sign-in-alt input-icon"></i>
                                                            Tanggal Masuk
                                                        </label>
                                                        <input type="date" name="tanggal_masuk" id="tanggal_masuk" 
                                                               class="futuristic-input @error('tanggal_masuk') is-invalid @enderror" 
                                                               value="{{ old('tanggal_masuk', date('Y-m-d')) }}">
                                                        <div class="input-border-effect"></div>
                                                        <div class="input-glow"></div>
                                                        @error('tanggal_masuk') 
                                                        <div class="futuristic-error">
                                                            <i class="fas fa-exclamation-triangle"></i>
                                                            {{ $message }}
                                                        </div> 
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="futuristic-input-group">
                                                    <div class="input-wrapper">
                                                        <label for="tanggal_masuk" class="floating-label">
                                                            <i class="fas fa-sign-in-alt input-icon"></i>
                                                            Tanggal Kedaluwarsa
                                                        </label>
                                                        <input type="date" name="tanggal_kedaluwarsa" id="tanggal_kedaluwarsa" 
                                                               class="futuristic-input @error('tanggal_kedaluwarsa') is-invalid @enderror" 
                                                               value="{{ old('tanggal_kedaluwarsa') }}">
                                                        <button type="button" class="expiry-calculator-btn" id="expiryCalculatorBtn">
                                                            <i class="fas fa-calculator"></i>
                                                        </button>
                                                        <div class="expiry-indicator" id="expiryIndicator">
                                                            <span class="expiry-days"></span>
                                                        </div>
                                                        <div class="input-border-effect"></div>
                                                        <div class="input-glow"></div>
                                                        @error('tanggal_kedaluwarsa') 
                                                        <div class="futuristic-error">
                                                            <i class="fas fa-exclamation-triangle"></i>
                                                            {{ $message }}
                                                        </div> 
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="futuristic-actions">
                                    <div class="actions-bg"></div>
                                    <button type="button" class="btn-futuristic btn-secondary" onclick="window.history.back()">
                                        <div class="btn-content">
                                            <i class="fas fa-arrow-left btn-icon"></i>
                                            <span class="btn-text">Batal</span>
                                        </div>
                                        <div class="btn-glow-effect"></div>
                                    </button>
                                    <button type="submit" class="btn-futuristic btn-primary btn-submit">
                                        <div class="btn-content">
                                            <i class="fas fa-save btn-icon"></i>
                                            <span class="btn-text">Simpan Bahan Baku</span>
                                            <div class="btn-loader" style="display: none;">
                                                <i class="fas fa-spinner fa-spin"></i>
                                            </div>
                                        </div>
                                        <div class="btn-glow-effect"></div>
                                        <div class="btn-particles"></div>
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

    <script>
        // Enhanced sidebar toggle functionality - Same as dashboard
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

            // Initialize sidebar state based on screen size
            if (window.innerWidth <= 768) {
                document.body.classList.add('sidebar-collapse');
            }

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
        });

        // Date and Time Display - Same as dashboard
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
            
            const dateElement = document.getElementById('currentDate');
            const timeElement = document.getElementById('currentTime');
            
            if (dateElement) dateElement.textContent = date;
            if (timeElement) timeElement.textContent = time;
        }

        // Update time every second
        setInterval(updateDateTime, 1000);
        updateDateTime(); // Initial call

        // Enhanced form interactions for futuristic design
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize form state
            initializeFuturisticIngredientForm();
            
            // Form input animations and floating labels
            const inputs = document.querySelectorAll('.futuristic-input, .futuristic-textarea, .futuristic-select');
            inputs.forEach(input => {
                const wrapper = input.closest('.input-wrapper');
                
                // Function to check if input has value
                function checkInputValue() {
                    let hasValue = false;
                    
                    if (input.tagName === 'SELECT') {
                        // For select elements, check if a valid option is selected
                        hasValue = input.value && input.value !== '' && input.selectedIndex > 0;
                    } else if (input.type === 'date') {
                        // For date inputs, check if a date is set
                        hasValue = input.value && input.value !== '';
                    } else {
                        // For regular inputs and textareas
                        hasValue = input.value && input.value.trim() !== '';
                    }
                    
                    if (hasValue) {
                        wrapper.classList.add('has-value');
                    } else {
                        wrapper.classList.remove('has-value');
                    }
                }

                // Check initial state
                checkInputValue();

                input.addEventListener('focus', function() {
                    wrapper.classList.add('focused');
                    createInputRipple(wrapper);
                });

                input.addEventListener('blur', function() {
                    wrapper.classList.remove('focused');
                    checkInputValue();
                });

                input.addEventListener('input', function() {
                    checkInputValue();
                });

                input.addEventListener('change', function() {
                    checkInputValue();
                    
                    // Force re-check after a small delay for select elements
                    if (input.tagName === 'SELECT') {
                        setTimeout(() => {
                            checkInputValue();
                        }, 50);
                    }
                });

                // Special handling for date inputs - they can change without firing input event
                if (input.type === 'date') {
                    const observer = new MutationObserver(function() {
                        checkInputValue();
                    });
                    observer.observe(input, { 
                        attributes: true, 
                        attributeFilter: ['value'],
                        childList: false,
                        subtree: false
                    });
                    
                    // Also listen for any property changes
                    Object.defineProperty(input, 'value', {
                        get: function() {
                            return this.getAttribute('value') || '';
                        },
                        set: function(val) {
                            this.setAttribute('value', val);
                            checkInputValue();
                        }
                    });
                }

                // For select elements, also check when options change
                if (input.tagName === 'SELECT') {
                    // Listen for programmatic value changes
                    const originalValue = Object.getOwnPropertyDescriptor(HTMLSelectElement.prototype, 'value');
                    Object.defineProperty(input, 'value', {
                        get: originalValue.get,
                        set: function(val) {
                            originalValue.set.call(this, val);
                            setTimeout(() => checkInputValue(), 10);
                        }
                    });
                }
            });

            // Smart suggestions for minimum stock
            const suggestMinStockBtn = document.getElementById('suggestMinStockBtn');
            if (suggestMinStockBtn) {
                suggestMinStockBtn.addEventListener('click', function() {
                    const stokInput = document.getElementById('stok');
                    const minStokInput = document.getElementById('minimum_stok');
                    const kategoriSelect = document.getElementById('kategori');
                    
                    if (!stokInput.value || !kategoriSelect.value) {
                        showFuturisticNotification('Masukkan stok awal dan kategori terlebih dahulu! 📊', 'warning');
                        return;
                    }

                    // Animate button
                    this.style.transform = 'translateY(-50%) scale(1.2)';
                    setTimeout(() => {
                        const suggestedMinStock = calculateSmartMinStock(stokInput.value, kategoriSelect.value);
                        minStokInput.value = suggestedMinStock;
                        minStokInput.closest('.input-wrapper').classList.add('has-value');
                        this.style.transform = 'translateY(-50%) scale(1)';
                        showFuturisticNotification('Minimum stok disarankan berdasarkan kategori! 💡', 'success');
                        createSuccessParticles(minStokInput.closest('.input-wrapper'));
                    }, 300);
                });
            }

            // Market price suggestion
            const marketPriceBtn = document.getElementById('marketPriceBtn');
            if (marketPriceBtn) {
                marketPriceBtn.addEventListener('click', function() {
                    const hargaInput = document.getElementById('harga');
                    const kategoriSelect = document.getElementById('kategori');
                    const namaInput = document.getElementById('nama');
                    
                    if (!kategoriSelect.value || !namaInput.value) {
                        showFuturisticNotification('Masukkan nama dan kategori bahan terlebih dahulu! 🏷️', 'warning');
                        return;
                    }

                    // Animate button
                    this.style.transform = 'translateY(-50%) scale(1.2)';
                    setTimeout(() => {
                        const marketPrice = getMarketPrice(namaInput.value, kategoriSelect.value);
                        hargaInput.value = marketPrice;
                        hargaInput.closest('.input-wrapper').classList.add('has-value');
                        this.style.transform = 'translateY(-50%) scale(1)';
                        showFuturisticNotification('Harga pasar terestimasi berdasarkan data! 📈', 'info');
                        createSuccessParticles(hargaInput.closest('.input-wrapper'));
                    }, 300);
                });
            }

            // Expiry date calculator
            const expiryCalculatorBtn = document.getElementById('expiryCalculatorBtn');
            if (expiryCalculatorBtn) {
                expiryCalculatorBtn.addEventListener('click', function() {
                    const kategoriSelect = document.getElementById('kategori');
                    const tanggalMasukInput = document.getElementById('tanggal_masuk');
                    const tanggalKedaluwarsaInput = document.getElementById('tanggal_kedaluwarsa');
                    
                    if (!kategoriSelect.value || !tanggalMasukInput.value) {
                        showFuturisticNotification('Masukkan kategori dan tanggal masuk terlebih dahulu! 📅', 'warning');
                        return;
                    }

                    // Animate button
                    this.style.transform = 'translateY(-50%) rotate(360deg)';
                    setTimeout(() => {
                        const estimatedExpiry = calculateExpiryDate(tanggalMasukInput.value, kategoriSelect.value);
                        tanggalKedaluwarsaInput.value = estimatedExpiry;
                        tanggalKedaluwarsaInput.closest('.input-wrapper').classList.add('has-value');
                        this.style.transform = 'translateY(-50%) rotate(0deg)';
                        showFuturisticNotification('Tanggal kedaluwarsa diestimasikan! ⏰', 'success');
                        createSuccessParticles(tanggalKedaluwarsaInput.closest('.input-wrapper'));
                        updateExpiryIndicator();
                    }, 300);
                });
            }

            // Stock level monitoring
            const stokInput = document.getElementById('stok');
            const minStokInput = document.getElementById('minimum_stok');
            
            function updateStockIndicator() {
                const stok = parseInt(stokInput.value) || 0;
                const minStok = parseInt(minStokInput.value) || 0;
                const indicator = document.getElementById('stockIndicator');
                const status = indicator.querySelector('.stock-status');
                
                if (stok === 0) {
                    status.textContent = 'Habis';
                    status.className = 'stock-status stock-empty';
                } else if (stok <= minStok) {
                    status.textContent = 'Stok Rendah';
                    status.className = 'stock-status stock-low';
                } else if (stok < minStok * 2) {
                    status.textContent = 'Perhatian';
                    status.className = 'stock-status stock-warning';
                } else {
                    status.textContent = 'Aman';
                    status.className = 'stock-status stock-safe';
                }
            }

            stokInput.addEventListener('input', updateStockIndicator);
            minStokInput.addEventListener('input', updateStockIndicator);

            // Expiry date monitoring
            function updateExpiryIndicator() {
                const tanggalKedaluwarsa = document.getElementById('tanggal_kedaluwarsa').value;
                const indicator = document.getElementById('expiryIndicator');
                const daysSpan = indicator.querySelector('.expiry-days');
                
                if (tanggalKedaluwarsa) {
                    const today = new Date();
                    const expiryDate = new Date(tanggalKedaluwarsa);
                    const diffTime = expiryDate - today;
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    
                    if (diffDays < 0) {
                        daysSpan.innerHTML = '<span class="expired">Kedaluwarsa</span>';
                    } else if (diffDays <= 7) {
                        daysSpan.innerHTML = `<span class="expiring-soon">${diffDays} hari lagi</span>`;
                    } else if (diffDays <= 30) {
                        daysSpan.innerHTML = `<span class="expiring-warning">${diffDays} hari lagi</span>`;
                    } else {
                        daysSpan.innerHTML = `<span class="expiring-safe">${diffDays} hari lagi</span>`;
                    }
                }
            }

            document.getElementById('tanggal_kedaluwarsa').addEventListener('change', updateExpiryIndicator);

            // Form submission with advanced validation
            const form = document.querySelector('.futuristic-form');
            const submitBtn = document.querySelector('.btn-submit');

            form.addEventListener('submit', function(e) {
                if (!validateIngredientForm()) {
                    e.preventDefault();
                    return;
                }

                // Advanced loading state
                submitBtn.disabled = true;
                submitBtn.querySelector('.btn-particles').style.animation = 'particles 0.5s ease-in-out infinite';
                submitBtn.querySelector('.btn-loader').style.display = 'inline-block';
                submitBtn.querySelector('.btn-icon:not(.fa-spinner)').style.display = 'none';
                
                // Add save effect
                setTimeout(() => {
                    showFuturisticNotification('Menyimpan bahan baku ke database... 💾', 'info');
                    createSaveEffect(submitBtn);
                }, 100);
            });

            // Initialize indicators
            updateStockIndicator();
            updateExpiryIndicator();

            // Section progress animations
            animateSectionProgress();

            // Additional event listeners for better label detection
            document.addEventListener('click', function(e) {
                if (e.target.matches('.futuristic-select') || e.target.closest('.input-wrapper')) {
                    setTimeout(() => {
                        const select = e.target.matches('.futuristic-select') ? e.target : e.target.querySelector('.futuristic-select');
                        if (select) {
                            const wrapper = select.closest('.input-wrapper');
                            const hasValue = select.value && select.value !== '' && select.selectedIndex > 0;
                            if (hasValue) {
                                wrapper.classList.add('has-value');
                            } else {
                                wrapper.classList.remove('has-value');
                            }
                        }
                    }, 10);
                }
            });

            // Listen for any programmatic changes to form values
            const formObserver = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'value') {
                        const input = mutation.target;
                        if (input.classList.contains('futuristic-input') || 
                            input.classList.contains('futuristic-select') || 
                            input.classList.contains('futuristic-textarea')) {
                            
                            const wrapper = input.closest('.input-wrapper');
                            let hasValue = false;
                            
                            if (input.tagName === 'SELECT') {
                                hasValue = input.value && input.value !== '' && input.selectedIndex > 0;
                            } else if (input.type === 'date') {
                                hasValue = input.value && input.value !== '';
                            } else {
                                hasValue = input.value && input.value.trim() !== '';
                            }
                            
                            if (hasValue) {
                                wrapper.classList.add('has-value');
                            } else {
                                wrapper.classList.remove('has-value');
                            }
                        }
                    }
                });
            });

            // Observe all form inputs for changes
            document.querySelectorAll('.futuristic-input, .futuristic-textarea, .futuristic-select').forEach(input => {
                formObserver.observe(input, {
                    attributes: true,
                    attributeFilter: ['value', 'selected'],
                    subtree: true
                });
            });
        });

        // Helper Functions for Ingredient Management
        function initializeFuturisticIngredientForm() {
            // Initialize floating labels for pre-filled inputs
            document.querySelectorAll('.futuristic-input, .futuristic-textarea, .futuristic-select').forEach(input => {
                const wrapper = input.closest('.input-wrapper');
                let hasValue = false;
                
                if (input.tagName === 'SELECT') {
                    // For select elements, check if a valid option is selected
                    hasValue = input.value && input.value !== '' && input.selectedIndex > 0;
                    
                    // Also check for old() values from Laravel
                    const selectedOption = input.querySelector('option[selected]');
                    if (selectedOption && selectedOption.value !== '') {
                        hasValue = true;
                        input.value = selectedOption.value;
                    }
                } else if (input.type === 'date') {
                    // For date inputs, check if a date is set
                    hasValue = input.value && input.value !== '';
                } else {
                    // For regular inputs and textareas
                    hasValue = input.value && input.value.trim() !== '';
                }
                
                if (hasValue) {
                    wrapper.classList.add('has-value');
                } else {
                    wrapper.classList.remove('has-value');
                }
            });

            // Set default entry date to today if empty
            const tanggalMasukInput = document.getElementById('tanggal_masuk');
            if (tanggalMasukInput && !tanggalMasukInput.value) {
                tanggalMasukInput.value = new Date().toISOString().split('T')[0];
                tanggalMasukInput.closest('.input-wrapper').classList.add('has-value');
            }

            // Force re-check all inputs after a delay to handle Laravel old() values and dynamic loading
            setTimeout(() => {
                document.querySelectorAll('.futuristic-input, .futuristic-textarea, .futuristic-select').forEach(input => {
                    const wrapper = input.closest('.input-wrapper');
                    let hasValue = false;
                    
                    if (input.tagName === 'SELECT') {
                        hasValue = input.value && input.value !== '' && input.selectedIndex > 0;
                    } else if (input.type === 'date') {
                        hasValue = input.value && input.value !== '';
                    } else {
                        hasValue = input.value && input.value.trim() !== '';
                    }
                    
                    if (hasValue) {
                        wrapper.classList.add('has-value');
                    } else {
                        wrapper.classList.remove('has-value');
                    }
                });
            }, 200);

            // Additional check after page fully loads
            window.addEventListener('load', () => {
                setTimeout(() => {
                    document.querySelectorAll('.futuristic-input, .futuristic-textarea, .futuristic-select').forEach(input => {
                        const wrapper = input.closest('.input-wrapper');
                        let hasValue = false;
                        
                        if (input.tagName === 'SELECT') {
                            hasValue = input.value && input.value !== '' && input.selectedIndex > 0;
                        } else if (input.type === 'date') {
                            hasValue = input.value && input.value !== '';
                        } else {
                            hasValue = input.value && input.value.trim() !== '';
                        }
                        
                        if (hasValue) {
                            wrapper.classList.add('has-value');
                        } else {
                            wrapper.classList.remove('has-value');
                        }
                    });
                }, 100);
            });
        }

        function calculateSmartMinStock(currentStock, category) {
            const multipliers = {
                'kering': 0.15, // 15% for dry ingredients
                'cair': 0.20,   // 20% for liquid ingredients
                'beku': 0.25    // 25% for frozen ingredients
            };
            
            const multiplier = multipliers[category] || 0.20;
            return Math.max(1, Math.ceil(currentStock * multiplier));
        }

        function getMarketPrice(ingredientName, category) {
            // Smart price estimation based on common ingredients
            const priceDatabase = {
                'kering': {
                    'tepung': 12000,
                    'gula': 15000,
                    'garam': 8000,
                    'ragi': 25000,
                    'default': 10000
                },
                'cair': {
                    'susu': 18000,
                    'minyak': 22000,
                    'air': 5000,
                    'vanilla': 45000,
                    'default': 15000
                },
                'beku': {
                    'butter': 35000,
                    'margarin': 25000,
                    'es krim': 40000,
                    'default': 30000
                }
            };
            
            const categoryPrices = priceDatabase[category] || priceDatabase['kering'];
            const name = ingredientName.toLowerCase();
            
            // Find matching ingredient
            for (let key in categoryPrices) {
                if (name.includes(key)) {
                    return categoryPrices[key];
                }
            }
            
            return categoryPrices.default;
        }

        function calculateExpiryDate(entryDate, category) {
            const entryDateObj = new Date(entryDate);
            const shelfLife = {
                'kering': 365,  // 1 year for dry ingredients
                'cair': 30,     // 1 month for liquid ingredients
                'beku': 180     // 6 months for frozen ingredients
            };
            
            const days = shelfLife[category] || 90;
            entryDateObj.setDate(entryDateObj.getDate() + days);
            
            return entryDateObj.toISOString().split('T')[0];
        }

        function validateIngredientForm() {
            const requiredFields = [
                { id: 'nama', message: 'Nama bahan baku harus diisi! 🏷️' },
                { id: 'kategori', message: 'Pilih kategori bahan baku! 📦' },
                { id: 'stok', message: 'Masukkan stok awal! 📊', min: 0 },
                { id: 'satuan', message: 'Pilih satuan pengukuran! ⚖️' },
                { id: 'minimum_stok', message: 'Tentukan minimum stok! ⚠️', min: 0 },
                { id: 'tanggal_masuk', message: 'Tanggal masuk diperlukan! 📅' },
                { id: 'tanggal_kedaluwarsa', message: 'Tanggal kedaluwarsa diperlukan! ⏰' },
                { id: 'deskripsi', message: 'Deskripsi bahan baku diperlukan! 📝' }
            ];

            for (let field of requiredFields) {
                const input = document.getElementById(field.id);
                if (!input.value) {
                    showFuturisticNotification(field.message, 'warning');
                    input.focus();
                    input.closest('.input-wrapper').classList.add('focused');
                    shakeElement(input.closest('.input-wrapper'));
                    return false;
                }
                
                if (field.min !== undefined && input.value < field.min) {
                    showFuturisticNotification(`${field.message} (minimum: ${field.min})`, 'warning');
                    input.focus();
                    shakeElement(input.closest('.input-wrapper'));
                    return false;
                }
            }

            // Validate expiry date is after entry date
            const entryDate = new Date(document.getElementById('tanggal_masuk').value);
            const expiryDate = new Date(document.getElementById('tanggal_kedaluwarsa').value);
            
            if (expiryDate <= entryDate) {
                showFuturisticNotification('Tanggal kedaluwarsa harus setelah tanggal masuk! 📅', 'warning');
                document.getElementById('tanggal_kedaluwarsa').focus();
                return false;
            }
            
            return true;
        }

        function createInputRipple(wrapper) {
            const ripple = document.createElement('div');
            ripple.style.cssText = `
                position: absolute;
                top: 50%;
                left: 50%;
                width: 0;
                height: 0;
                background: radial-gradient(circle, rgba(102, 126, 234, 0.3) 0%, transparent 70%);
                border-radius: 50%;
                transform: translate(-50%, -50%);
                animation: ripple-expand 0.6s ease-out;
                pointer-events: none;
                z-index: 1;
            `;
            
            wrapper.appendChild(ripple);
            
            setTimeout(() => ripple.remove(), 600);
        }

        function createSuccessParticles(element) {
            for (let i = 0; i < 6; i++) {
                const particle = document.createElement('div');
                particle.style.cssText = `
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    width: 4px;
                    height: 4px;
                    background: #10b981;
                    border-radius: 50%;
                    pointer-events: none;
                    z-index: 100;
                    animation: particle-burst-${i} 1s ease-out forwards;
                `;
                
                element.appendChild(particle);
                
                setTimeout(() => particle.remove(), 1000);
            }
        }

        function createSaveEffect(button) {
            const saveIcon = document.createElement('div');
            saveIcon.innerHTML = '💾';
            saveIcon.style.cssText = `
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 2rem;
                z-index: 1000;
                animation: save-effect 2s ease-out forwards;
                pointer-events: none;
            `;
            
            button.appendChild(saveIcon);
            
            const style = document.createElement('style');
            style.textContent = `
                @keyframes save-effect {
                    0% {
                        transform: translate(-50%, -50%) scale(1) rotate(0deg);
                        opacity: 1;
                    }
                    100% {
                        transform: translate(-50%, -300px) scale(0.5) rotate(360deg);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
            
            setTimeout(() => {
                saveIcon.remove();
                style.remove();
            }, 2000);
        }

        function shakeElement(element) {
            element.style.animation = 'shake 0.5s ease-in-out';
            
            setTimeout(() => {
                element.style.animation = '';
            }, 500);
        }

        function animateSectionProgress() {
            const sections = document.querySelectorAll('.futuristic-section');
            sections.forEach((section, index) => {
                const progressCircle = section.querySelector('.progress-ring');
                if (progressCircle) {
                    progressCircle.style.animationDelay = `${index * 0.5}s`;
                }
            });
        }

        // Enhanced futuristic notification system
        function showFuturisticNotification(message, type = 'info') {
            const existingNotifications = document.querySelectorAll('.futuristic-notification');
            existingNotifications.forEach(notification => notification.remove());
            
            const notification = document.createElement('div');
            notification.className = `futuristic-notification animate__animated animate__fadeInRight`;
            
            const typeConfig = {
                success: { 
                    bg: 'linear-gradient(45deg, #10b981, #059669)', 
                    icon: '✅',
                    glow: '0 0 30px rgba(16, 185, 129, 0.5)'
                },
                warning: { 
                    bg: 'linear-gradient(45deg, #f59e0b, #d97706)', 
                    icon: '⚠️',
                    glow: '0 0 30px rgba(245, 158, 11, 0.5)'
                },
                danger: { 
                    bg: 'linear-gradient(45deg, #ef4444, #dc2626)', 
                    icon: '❌',
                    glow: '0 0 30px rgba(239, 68, 68, 0.5)'
                },
                info: { 
                    bg: 'linear-gradient(45deg, #3b82f6, #1d4ed8)', 
                    icon: '💡',
                    glow: '0 0 30px rgba(59, 130, 246, 0.5)'
                }
            };
            
            const config = typeConfig[type] || typeConfig.info;
            
            notification.style.cssText = `
                position: fixed;
                top: 30px;
                right: 30px;
                z-index: 10000;
                min-width: 350px;
                background: ${config.bg};
                color: white;
                padding: 20px 25px;
                border-radius: 15px;
                font-weight: 600;
                font-size: 0.95rem;
                box-shadow: ${config.glow}, 0 10px 30px rgba(0,0,0,0.2);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                transform: translateX(100%);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            `;
            
            notification.innerHTML = `
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center;">
                        <span style="font-size: 1.3rem; margin-right: 12px;">${config.icon}</span>
                        <span>${message}</span>
                    </div>
                    <button type="button" class="futuristic-close" style="
                        background: rgba(255, 255, 255, 0.2);
                        border: none;
                        color: white;
                        border-radius: 50%;
                        width: 25px;
                        height: 25px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        margin-left: 15px;
                    ">×</button>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Slide in
            requestAnimationFrame(() => {
                notification.style.transform = 'translateX(0)';
            });
            
            // Close button
            const closeBtn = notification.querySelector('.futuristic-close');
            closeBtn.addEventListener('click', () => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => notification.remove(), 400);
            });
            
            // Auto remove
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.style.transform = 'translateX(100%)';
                    setTimeout(() => notification.remove(), 400);
                }
            }, 5000);
        }

        // CSS for futuristic form styling (same as production form)
        const style = document.createElement('style');
        style.textContent = `
            /* Import the same futuristic styles from production form */
            /* Futuristic Form Container */
            .futuristic-form-container {
                position: relative;
                background: linear-gradient(145deg, #0f0f23, #1a1a2e);
                border-radius: 30px;
                overflow: hidden;
                box-shadow: 
                    0 25px 50px rgba(0, 0, 0, 0.25),
                    inset 0 1px 0 rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }

            .form-glow-effect {
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: conic-gradient(from 0deg, transparent, #667eea, #764ba2, transparent);
                animation: rotate 20s linear infinite;
                opacity: 0.3;
                z-index: -1;
            }

            @keyframes rotate {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            @keyframes ripple-expand {
                0% { width: 0; height: 0; opacity: 1; }
                100% { width: 200px; height: 200px; opacity: 0; }
            }

            @keyframes particle-burst-0 {
                0% { transform: translate(-50%, -50%) scale(0); opacity: 1; }
                100% { transform: translate(-50%, -50%) translate(-40px, -40px) scale(1); opacity: 0; }
            }
            @keyframes particle-burst-1 {
                0% { transform: translate(-50%, -50%) scale(0); opacity: 1; }
                100% { transform: translate(-50%, -50%) translate(40px, -40px) scale(1); opacity: 0; }
            }
            @keyframes particle-burst-2 {
                0% { transform: translate(-50%, -50%) scale(0); opacity: 1; }
                100% { transform: translate(-50%, -50%) translate(-40px, 40px) scale(1); opacity: 0; }
            }
            @keyframes particle-burst-3 {
                0% { transform: translate(-50%, -50%) scale(0); opacity: 1; }
                100% { transform: translate(-50%, -50%) translate(40px, 40px) scale(1); opacity: 0; }
            }
            @keyframes particle-burst-4 {
                0% { transform: translate(-50%, -50%) scale(0); opacity: 1; }
                100% { transform: translate(-50%, -50%) translate(0px, -50px) scale(1); opacity: 0; }
            }
            @keyframes particle-burst-5 {
                0% { transform: translate(-50%, -50%) scale(0); opacity: 1; }
                100% { transform: translate(-50%, -50%) translate(0px, 50px) scale(1); opacity: 0; }
            }

            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-10px); }
                75% { transform: translateX(10px); }
            }

            /* Form Header */
            .form-header {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                padding: 40px;
                position: relative;
                overflow: hidden;
            }

            .form-header::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="80" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="40" cy="60" r="0.5" fill="rgba(255,255,255,0.08)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
                opacity: 0.3;
            }

            .form-header-content {
                display: flex;
                align-items: center;
                justify-content: space-between;
                position: relative;
                z-index: 2;
            }

            .form-icon-container {
                width: 80px;
                height: 80px;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }

            .form-main-icon {
                font-size: 2.5rem;
                color: white;
                animation: pulse-glow 3s ease-in-out infinite;
            }

            @keyframes pulse-glow {
                0%, 100% { 
                    transform: scale(1); 
                    filter: drop-shadow(0 0 10px rgba(255,255,255,0.5));
                }
                50% { 
                    transform: scale(1.1); 
                    filter: drop-shadow(0 0 20px rgba(255,255,255,0.8));
                }
            }

            .form-header-text {
                flex: 1;
                margin-left: 30px;
            }

            .form-title {
                font-size: 2.5rem;
                font-weight: 800;
                color: white;
                margin: 0;
                text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
                letter-spacing: -0.5px;
            }

            .form-subtitle {
                font-size: 1.1rem;
                color: rgba(255, 255, 255, 0.8);
                margin: 8px 0 0 0;
                font-weight: 400;
            }

            .form-status-indicator {
                display: flex;
                align-items: center;
                background: rgba(255, 255, 255, 0.15);
                padding: 12px 20px;
                border-radius: 25px;
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .status-dot {
                width: 12px;
                height: 12px;
                background: #10b981;
                border-radius: 50%;
                margin-right: 10px;
                animation: pulse-dot 2s ease-in-out infinite;
                box-shadow: 0 0 10px #10b981;
            }

            @keyframes pulse-dot {
                0%, 100% { opacity: 1; transform: scale(1); }
                50% { opacity: 0.7; transform: scale(1.2); }
            }

            .form-status-indicator span {
                color: white;
                font-weight: 600;
                font-size: 0.9rem;
            }

            /* Futuristic Form */
            .futuristic-form {
                padding: 50px;
                background: linear-gradient(145deg, #16213e 0%, #0f3460 100%);
                position: relative;
            }

            /* Futuristic Sections */
            .futuristic-section {
                margin-bottom: 50px;
                background: rgba(255, 255, 255, 0.03);
                border-radius: 25px;
                border: 1px solid rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(20px);
                overflow: hidden;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .futuristic-section:hover {
                background: rgba(255, 255, 255, 0.05);
                border-color: rgba(102, 126, 234, 0.3);
                box-shadow: 0 20px 40px rgba(102, 126, 234, 0.1);
                transform: translateY(-5px);
            }

            .section-header {
                display: flex;
                align-items: center;
                padding: 30px;
                background: linear-gradient(90deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .section-number {
                width: 60px;
                height: 60px;
                background: linear-gradient(45deg, #667eea, #764ba2);
                color: white;
                border-radius: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                font-weight: 800;
                margin-right: 25px;
                box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
                position: relative;
                overflow: hidden;
            }

            .section-number::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
                animation: shimmer 3s ease-in-out infinite;
            }

            @keyframes shimmer {
                0% { left: -100%; }
                50%, 100% { left: 100%; }
            }

            .section-info {
                flex: 1;
            }

            .section-title {
                font-size: 1.4rem;
                font-weight: 700;
                color: white;
                margin: 0 0 8px 0;
                text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
            }

            .section-subtitle {
                color: rgba(255, 255, 255, 0.7);
                margin: 0;
                font-size: 0.95rem;
            }

            .section-progress {
                width: 50px;
                height: 50px;
                position: relative;
            }

            .progress-ring {
                width: 100%;
                height: 100%;
                border-radius: 50%;
                background: conic-gradient(from 0deg, #667eea, #764ba2, #667eea);
                padding: 3px;
                animation: rotate 4s linear infinite;
            }

            .progress-circle {
                width: 100%;
                height: 100%;
                background: #16213e;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .section-content {
                padding: 40px 30px;
            }

            /* Futuristic Input Groups */
            .futuristic-input-group {
                margin-bottom: 35px;
            }

            .input-wrapper {
                position: relative;
                background: rgba(255, 255, 255, 0.05);
                border-radius: 15px;
                border: 2px solid rgba(255, 255, 255, 0.1);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                overflow: hidden;
            }

            .input-wrapper:hover {
                border-color: rgba(102, 126, 234, 0.3);
                background: rgba(255, 255, 255, 0.08);
            }

            .input-wrapper.focused {
                border-color: #667eea;
                background: rgba(102, 126, 234, 0.1);
                box-shadow: 0 0 30px rgba(102, 126, 234, 0.2);
            }

            .floating-label {
                position: absolute;
                top: 50%;
                left: 20px;
                transform: translateY(-50%);
                color: rgba(255, 255, 255, 0.6);
                font-weight: 600;
                font-size: 1rem;
                pointer-events: none;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                display: flex;
                align-items: center;
                z-index: 10;
                background: transparent;
                padding: 0 5px;
                white-space: nowrap;
            }

            /* Label positioning when focused or has value */
            .input-wrapper.focused .floating-label,
            .input-wrapper.has-value .floating-label {
                top: -10px;
                left: 15px;
                font-size: 0.75rem;
                color: #667eea;
                transform: translateY(0);
                background: linear-gradient(145deg, #16213e 0%, #0f3460 100%);
                padding: 2px 8px;
                border-radius: 4px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.3);
            }

            /* Special handling for textarea */
            .futuristic-textarea + .floating-label {
                top: 30px;
                transform: translateY(0);
            }

            .input-wrapper.focused .futuristic-textarea + .floating-label,
            .input-wrapper.has-value .futuristic-textarea + .floating-label {
                top: -10px;
                left: 15px;
                transform: translateY(0);
            }

            /* Special handling for select dropdown */
            .futuristic-select + .floating-label {
                top: 50%;
                transform: translateY(-50%);
            }

            .input-wrapper.focused .futuristic-select + .floating-label,
            .input-wrapper.has-value .futuristic-select + .floating-label {
                top: -10px;
                left: 15px;
                transform: translateY(0);
            }

            /* Special handling for date input */
            .futuristic-input[type="date"] + .floating-label {
                top: 50%;
                transform: translateY(-50%);
            }

            .input-wrapper.focused .futuristic-input[type="date"] + .floating-label,
            .input-wrapper.has-value .futuristic-input[type="date"] + .floating-label {
                top: -10px;
                left: 15px;
                transform: translateY(0);
            }

            /* Ensure labels don't interfere with input content */
            .futuristic-input, .futuristic-textarea, .futuristic-select {
                padding-top: 28px;
                padding-bottom: 12px;
            }

            .futuristic-textarea {
                padding-top: 35px;
                min-height: 120px;
            }

            .input-icon {
                margin-right: 8px;
                font-size: 0.9em;
            }

            .futuristic-input, .futuristic-textarea, .futuristic-select {
                width: 100%;
                background: transparent;
                border: none;
                padding: 25px 20px 15px 20px;
                color: white;
                font-size: 1.1rem;
                font-weight: 500;
                outline: none;
                resize: none;
                font-family: 'Inter', sans-serif;
            }

            .futuristic-input::placeholder,
            .futuristic-textarea::placeholder {
                color: transparent;
                font-weight: 400;
                transition: color 0.3s ease;
            }

            .input-wrapper.focused .futuristic-input::placeholder,
            .input-wrapper.focused .futuristic-textarea::placeholder {
                color: rgba(255, 255, 255, 0.3);
            }

            .input-wrapper.has-value .futuristic-input::placeholder,
            .input-wrapper.has-value .futuristic-textarea::placeholder {
                color: rgba(255, 255, 255, 0.3);
            }

            /* Ensure proper layering */
            .floating-label {
                z-index: 10;
            }

            .input-prefix-modern, .input-suffix-modern {
                z-index: 8;
            }

            .smart-suggest-btn, .market-price-btn, .expiry-calculator-btn {
                z-index: 15;
            }

            .futuristic-textarea {
                min-height: 120px;
                padding-top: 30px;
            }

            .futuristic-select {
                cursor: pointer;
                appearance: none;
                padding-right: 50px;
            }

            .futuristic-select option {
                background: #16213e;
                color: white;
                padding: 10px;
            }

            /* Input Prefix/Suffix */
            .input-prefix-modern, .input-suffix-modern {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                color: rgba(255, 255, 255, 0.6);
                font-weight: 600;
                font-size: 1rem;
                z-index: 5;
            }

            .input-prefix-modern {
                left: 20px;
            }

            .input-suffix-modern {
                right: 20px;
            }

            .input-wrapper:has(.input-prefix-modern) .futuristic-input {
                padding-left: 60px;
            }

            .input-wrapper:has(.input-suffix-modern) .futuristic-input {
                padding-right: 60px;
            }

            .input-wrapper:has(.input-prefix-modern) .floating-label {
                left: 60px;
            }

            .input-wrapper:has(.input-prefix-modern).focused .floating-label,
            .input-wrapper:has(.input-prefix-modern).has-value .floating-label {
                left: 60px;
                top: -10px;
            }

            .input-wrapper:has(.input-suffix-modern) .floating-label {
                right: 60px;
                left: 20px;
            }

            /* Better spacing for inputs with buttons */
            .input-wrapper:has(.smart-suggest-btn) .futuristic-input,
            .input-wrapper:has(.market-price-btn) .futuristic-input,
            .input-wrapper:has(.expiry-calculator-btn) .futuristic-input {
                padding-right: 60px;
            }

            .input-wrapper:has(.smart-suggest-btn) .floating-label,
            .input-wrapper:has(.market-price-btn) .floating-label,
            .input-wrapper:has(.expiry-calculator-btn) .floating-label {
                right: 60px;
            }

            .input-wrapper:has(.smart-suggest-btn).focused .floating-label,
            .input-wrapper:has(.smart-suggest-btn).has-value .floating-label,
            .input-wrapper:has(.market-price-btn).focused .floating-label,
            .input-wrapper:has(.market-price-btn).has-value .floating-label,
            .input-wrapper:has(.expiry-calculator-btn).focused .floating-label,
            .input-wrapper:has(.expiry-calculator-btn).has-value .floating-label {
                right: auto;
                left: 15px;
                top: -10px;
            }

            /* Fix for prefix + button combination */
            .input-wrapper:has(.input-prefix-modern):has(.market-price-btn) .futuristic-input {
                padding-left: 60px;
                padding-right: 60px;
            }

            .input-wrapper:has(.input-prefix-modern):has(.market-price-btn) .floating-label {
                left: 60px;
                right: 60px;
            }

            .input-wrapper:has(.input-prefix-modern):has(.market-price-btn).focused .floating-label,
            .input-wrapper:has(.input-prefix-modern):has(.market-price-btn).has-value .floating-label {
                left: 60px;
                right: auto;
                top: -10px;
            }

            /* Select Arrow */
            .select-arrow-modern {
                position: absolute;
                right: 20px;
                top: 50%;
                transform: translateY(-50%);
                color: rgba(255, 255, 255, 0.6);
                pointer-events: none;
                transition: all 0.3s ease;
                z-index: 5;
            }

            .input-wrapper.focused .select-arrow-modern {
                color: #667eea;
                transform: translateY(-50%) rotate(180deg);
            }

            /* Special Buttons */
            .smart-suggest-btn, .market-price-btn, .expiry-calculator-btn {
                position: absolute;
                right: 15px;
                top: 50%;
                transform: translateY(-50%);
                background: linear-gradient(45deg, #10b981, #059669);
                border: none;
                border-radius: 10px;
                width: 35px;
                height: 35px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                cursor: pointer;
                transition: all 0.3s ease;
                z-index: 10;
            }

            .smart-suggest-btn:hover, .market-price-btn:hover, .expiry-calculator-btn:hover {
                background: linear-gradient(45deg, #059669, #047857);
                transform: translateY(-50%) scale(1.1);
                box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
            }

            .smart-suggest-btn i, .market-price-btn i, .expiry-calculator-btn i {
                font-size: 0.9rem;
            }

            /* Stock and Expiry Indicators */
            .stock-indicator, .expiry-indicator {
                position: absolute;
                right: 20px;
                bottom: 8px;
                font-size: 0.75rem;
                font-weight: 600;
                z-index: 5;
            }

            .stock-status {
                padding: 2px 8px;
                border-radius: 10px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .stock-safe { background: #10b981; color: white; }
            .stock-warning { background: #f59e0b; color: white; }
            .stock-low { background: #ef4444; color: white; }
            .stock-empty { background: #6b7280; color: white; }

            .expiring-safe { color: #10b981; }
            .expiring-warning { color: #f59e0b; }
            .expiring-soon { color: #ef4444; }
            .expired { color: #6b7280; text-decoration: line-through; }

            /* Input Effects */
            .input-border-effect {
                position: absolute;
                bottom: 0;
                left: 50%;
                width: 0;
                height: 2px;
                background: linear-gradient(90deg, #667eea, #764ba2);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                transform: translateX(-50%);
            }

            .input-wrapper.focused .input-border-effect {
                width: 100%;
            }

            .input-glow {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                border-radius: 15px;
                opacity: 0;
                background: linear-gradient(45deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
                transition: opacity 0.3s ease;
                pointer-events: none;
            }

            .input-wrapper.focused .input-glow {
                opacity: 1;
            }

            /* Error Styling */
            .futuristic-error {
                display: flex;
                align-items: center;
                color: #ef4444;
                font-size: 0.85rem;
                margin-top: 10px;
                padding: 8px 15px;
                background: rgba(239, 68, 68, 0.1);
                border-radius: 8px;
                border-left: 3px solid #ef4444;
            }

            .futuristic-error i {
                margin-right: 8px;
            }

            .is-invalid {
                border-color: #ef4444 !important;
            }

            .is-invalid:focus {
                box-shadow: 0 0 20px rgba(239, 68, 68, 0.2) !important;
            }

            /* Futuristic Actions */
            .futuristic-actions {
                position: relative;
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 60px;
                padding: 40px;
                background: rgba(255, 255, 255, 0.03);
                border-radius: 25px;
                border: 1px solid rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(20px);
            }

            .actions-bg {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(45deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
                border-radius: 25px;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .futuristic-actions:hover .actions-bg {
                opacity: 1;
            }

            /* Futuristic Buttons */
            .btn-futuristic {
                position: relative;
                padding: 18px 35px;
                border: none;
                border-radius: 15px;
                font-weight: 700;
                font-size: 1.1rem;
                cursor: pointer;
                overflow: hidden;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                z-index: 2;
                backdrop-filter: blur(10px);
            }

            .btn-futuristic.btn-secondary {
                background: linear-gradient(45deg, #6b7280, #4b5563);
                color: white;
                border: 2px solid rgba(255, 255, 255, 0.1);
            }

            .btn-futuristic.btn-primary {
                background: linear-gradient(45deg, #667eea, #764ba2);
                color: white;
                border: 2px solid rgba(102, 126, 234, 0.3);
                box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            }

            .btn-futuristic:hover {
                transform: translateY(-5px) scale(1.05);
            }

            .btn-futuristic.btn-secondary:hover {
                background: linear-gradient(45deg, #4b5563, #374151);
                box-shadow: 0 15px 35px rgba(107, 114, 128, 0.3);
            }

            .btn-futuristic.btn-primary:hover {
                background: linear-gradient(45deg, #5a67d8, #553c9a);
                box-shadow: 0 20px 40px rgba(102, 126, 234, 0.4);
            }

            .btn-content {
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                z-index: 2;
            }

            .btn-icon {
                margin-right: 10px;
                font-size: 1.1em;
            }

            .btn-text {
                font-weight: 700;
            }

            .btn-loader {
                margin-left: 10px;
            }

            .btn-glow-effect {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(45deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.2));
                border-radius: 15px;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .btn-futuristic:hover .btn-glow-effect {
                opacity: 1;
            }

            .btn-particles {
                position: absolute;
                top: 50%;
                left: 50%;
                width: 100px;
                height: 100px;
                transform: translate(-50%, -50%);
                background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
                background-size: 10px 10px;
                opacity: 0;
                animation: particles 2s ease-in-out infinite;
            }

            @keyframes particles {
                0%, 100% { 
                    opacity: 0; 
                    transform: translate(-50%, -50%) scale(0.5);
                }
                50% { 
                    opacity: 1; 
                    transform: translate(-50%, -50%) scale(1.5);
                }
            }

            .btn-futuristic.btn-primary:hover .btn-particles {
                animation-play-state: running;
            }

            /* Modern Alerts */
            .modern-alert {
                border-radius: 15px;
                border: none;
                background: linear-gradient(45deg, rgba(239, 68, 68, 0.1), rgba(220, 38, 38, 0.1));
                box-shadow: 0 10px 25px rgba(0,0,0,0.1);
                margin-bottom: 30px;
                backdrop-filter: blur(10px);
                border: 1px solid rgba(239, 68, 68, 0.2);
            }

            /* Mobile Responsive */
            @media (max-width: 768px) {
                .futuristic-form {
                    padding: 30px 20px;
                }
                
                .form-header {
                    padding: 30px 20px;
                }

                .form-header-content {
                    flex-direction: column;
                    text-align: center;
                    gap: 20px;
                }

                .form-header-text {
                    margin-left: 0;
                }

                .form-title {
                    font-size: 2rem;
                }
                
                .section-content {
                    padding: 30px 20px;
                }

                .section-header {
                    padding: 25px 20px;
                }

                .section-number {
                    width: 50px;
                    height: 50px;
                    font-size: 1.2rem;
                    margin-right: 15px;
                }
                
                .futuristic-actions {
                    flex-direction: column;
                    gap: 20px;
                    padding: 30px 20px;
                }
                
                .btn-futuristic {
                    width: 100%;
                    padding: 20px;
                }

                .input-prefix-modern, .input-suffix-modern {
                    font-size: 0.9rem;
                }

                /* Mobile specific floating label adjustments */
                .floating-label {
                    font-size: 0.9rem;
                    left: 15px;
                }

                .input-wrapper.focused .floating-label,
                .input-wrapper.has-value .floating-label {
                    font-size: 0.7rem;
                    top: -8px;
                    left: 12px;
                }

                .input-wrapper:has(.input-prefix-modern) .floating-label {
                    left: 45px;
                }

                .input-wrapper:has(.input-prefix-modern).focused .floating-label,
                .input-wrapper:has(.input-prefix-modern).has-value .floating-label {
                    left: 45px;
                    top: -8px;
                }

                .futuristic-input, .futuristic-textarea, .futuristic-select {
                    padding: 25px 15px 10px 15px;
                    font-size: 1rem;
                }

                .futuristic-textarea {
                    padding-top: 30px;
                    min-height: 100px;
                }

                .input-wrapper:has(.input-prefix-modern) .futuristic-input {
                    padding-left: 45px;
                }

                .input-wrapper:has(.smart-suggest-btn) .futuristic-input,
                .input-wrapper:has(.market-price-btn) .futuristic-input,
                .input-wrapper:has(.expiry-calculator-btn) .futuristic-input {
                    padding-right: 50px;
                }

                .smart-suggest-btn, .market-price-btn, .expiry-calculator-btn {
                    width: 30px;
                    height: 30px;
                    right: 12px;
                }

                .smart-suggest-btn i, .market-price-btn i, .expiry-calculator-btn i {
                    font-size: 0.8rem;
                }

                /* Mobile fixes for button + prefix combinations */
                .input-wrapper:has(.input-prefix-modern):has(.market-price-btn) .futuristic-input {
                    padding-left: 45px;
                    padding-right: 50px;
                }

                .input-wrapper:has(.input-prefix-modern):has(.market-price-btn) .floating-label {
                    left: 45px;
                }

                .input-wrapper:has(.input-prefix-modern):has(.market-price-btn).focused .floating-label,
                .input-wrapper:has(.input-prefix-modern):has(.market-price-btn).has-value .floating-label {
                    left: 45px;
                    top: -8px;
                }
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
    </script>
</body>
</html>