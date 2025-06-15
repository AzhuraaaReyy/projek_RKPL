<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Jenis Produk - Galaxy Bakery</title>
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
                                <i class="fas fa-bread-slice mr-3"></i>
                                Tambah Jenis Produk
                            </h1>
                            <small>Daftarkan jenis roti baru ke katalog Galaxy Bakery</small>
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
                @if(session('success'))
                <div class="row animate__animated animate__fadeInUp">
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible fade show modern-alert" role="alert">
                            <i class="fas fa-check-circle mr-2"></i>
                            <strong>Berhasil!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                @endif

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
                        <div class="modern-form-container">
                            <div class="chart-wrapper">
                                <h3 class="chart-title">
                                    <i class="fas fa-plus-circle text-warning mr-3"></i>
                                    Form Tambah Produk Roti
                                </h3>
                                <small class="text-muted">Lengkapi informasi produk dan bahan baku yang diperlukan</small>

                                <form action="{{route('store.tambah')}}" method="POST" class="modern-form mt-4">
                                    @csrf

                                    <!-- Basic Information Section -->
                                    <div class="form-section">
                                        <h5 class="section-title">
                                            <i class="fas fa-info-circle text-primary mr-2"></i>
                                            Informasi Dasar
                                        </h5>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="modern-form-group">
                                                    <label for="name" class="modern-label">
                                                        <i class="fas fa-bread-slice mr-2"></i>
                                                        Nama Produk
                                                    </label>
                                                    <input type="text" name="name" id="name" class="modern-input" required
                                                        placeholder="Contoh: Roti Tawar Premium">
                                                    <div class="input-border"></div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="modern-form-group">
                                                    <label for="estimated_production_time" class="modern-label">
                                                        <i class="fas fa-clock mr-2"></i>
                                                        Estimasi Waktu Produksi (menit)
                                                    </label>
                                                    <input type="number" name="estimated_production_time" id="estimated_production_time"
                                                        class="modern-input" min="0" required placeholder="120">
                                                    <div class="input-border"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modern-form-group">
                                            <label for="description" class="modern-label">
                                                <i class="fas fa-align-left mr-2"></i>
                                                Deskripsi Produk
                                            </label>
                                            <textarea name="description" id="description" class="modern-textarea" rows="4"
                                                placeholder="Deskripsikan produk roti ini dengan detail..."></textarea>
                                            <div class="input-border"></div>
                                        </div>

                                        <div class="modern-checkbox-group">
                                            <label class="modern-checkbox">
                                                <input type="checkbox" name="is_active" id="is_active" checked>
                                                <span class="checkmark"></span>
                                                <span class="checkbox-text">
                                                    <strong>Status Aktif</strong>
                                                    <small>Produk dapat diproduksi</small>
                                                </span>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Ingredients Section -->
                                    <div class="form-section">
                                        <h5 class="section-title">
                                            <i class="fas fa-boxes text-success mr-2"></i>
                                            Bahan Baku yang Diperlukan
                                        </h5>
                                        <p class="text-muted mb-4">Pilih bahan baku dan tentukan jumlah yang dibutuhkan per unit produk</p>

                                        <div class="ingredients-grid">
                                            @foreach ($bahanBakus as $index => $bahanBaku)
                                            <div class="ingredient-card">
                                                <div class="ingredient-header">
                                                    <label class="ingredient-checkbox">
                                                        <input type="checkbox" name="bahan_baku_id[]" value="{{ $bahanBaku->id }}"
                                                            id="bahan_{{ $index }}" onchange="toggleIngredientQuantity({{ $index }})">
                                                        <span class="checkmark"></span>
                                                        <div class="ingredient-info">
                                                            <h6 class="ingredient-name">{{ $bahanBaku->nama }}</h6>
                                                            <span class="ingredient-unit">Satuan: {{ $bahanBaku->satuan }}</span>
                                                        </div>
                                                    </label>
                                                </div>

                                                <div class="ingredient-quantity" id="quantity_{{ $index }}" style="display: none;">
                                                    <label class="quantity-label">Jumlah per unit produk</label>
                                                    <div class="quantity-input-group">
                                                        <input type="number" step="0.01"
                                                            name="quantity_per_unit[{{ $bahanBaku->id }}]"
                                                            class="quantity-input"
                                                            placeholder="0.00">
                                                        <span class="quantity-unit">{{ $bahanBaku->satuan }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="form-actions">
                                        <button type="button" class="btn btn-secondary btn-modern" onclick="window.history.back()">
                                            <i class="fas fa-arrow-left mr-2"></i>
                                            Kembali
                                        </button>
                                        <button type="submit" class="btn btn-primary btn-modern btn-submit">
                                            <i class="fas fa-save mr-2"></i>
                                            Simpan Produk
                                            <div class="btn-loader" style="display: none;">
                                                <i class="fas fa-spinner fa-spin"></i>
                                            </div>
                                        </button>
                                    </div>
                                </form>
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

        // Toggle ingredient quantity input
        function toggleIngredientQuantity(index) {
            const checkbox = document.getElementById(`bahan_${index}`);
            const quantityDiv = document.getElementById(`quantity_${index}`);
            const quantityInput = quantityDiv.querySelector('input');

            if (checkbox.checked) {
                quantityDiv.style.display = 'block';
                quantityDiv.classList.add('animate__animated', 'animate__fadeInDown');
                quantityInput.focus();
            } else {
                quantityDiv.style.display = 'none';
                quantityInput.value = '';
            }
        }

        // Form validation and submission
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.modern-form');
            const submitBtn = document.querySelector('.btn-submit');
            const btnLoader = document.querySelector('.btn-loader');
            const btnText = submitBtn.querySelector('i:not(.fa-spinner)').nextSibling;

            // Form input animations
            const inputs = document.querySelectorAll('.modern-input, .modern-textarea');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });

                input.addEventListener('blur', function() {
                    if (this.value === '') {
                        this.parentElement.classList.remove('focused');
                    }
                });

                // Check if input has value on load
                if (input.value !== '') {
                    input.parentElement.classList.add('focused');
                }
            });

            // Form submission with loading state
            form.addEventListener('submit', function(e) {
                // Basic validation
                const nameInput = document.getElementById('name');
                const timeInput = document.getElementById('estimated_production_time');

                if (!nameInput.value.trim()) {
                    e.preventDefault();
                    showNotification('Nama produk harus diisi!', 'danger');
                    nameInput.focus();
                    return;
                }

                if (!timeInput.value || timeInput.value <= 0) {
                    e.preventDefault();
                    showNotification('Estimasi waktu produksi harus diisi dan lebih dari 0!', 'danger');
                    timeInput.focus();
                    return;
                }

                // Check if at least one ingredient is selected
                const selectedIngredients = document.querySelectorAll('input[name="bahan_baku_id[]"]:checked');
                if (selectedIngredients.length === 0) {
                    e.preventDefault();
                    showNotification('Pilih minimal satu bahan baku!', 'warning');
                    return;
                }

                // Validate quantities for selected ingredients
                let hasValidQuantity = true;
                selectedIngredients.forEach(checkbox => {
                    const id = checkbox.value;
                    const quantityInput = document.querySelector(`input[name="quantity_per_unit[${id}]"]`);
                    if (!quantityInput.value || quantityInput.value <= 0) {
                        hasValidQuantity = false;
                    }
                });

                if (!hasValidQuantity) {
                    e.preventDefault();
                    showNotification('Isi jumlah bahan baku yang diperlukan!', 'warning');
                    return;
                }

                // Show loading state
                submitBtn.disabled = true;
                btnLoader.style.display = 'inline-block';
                submitBtn.querySelector('.fas:not(.fa-spinner)').style.display = 'none';

                // Allow form to submit
                setTimeout(() => {
                    showNotification('Menyimpan data produk...', 'info');
                }, 100);
            });
        });

        // Notification system
        function showNotification(message, type = 'info') {
            const existingNotifications = document.querySelectorAll('.custom-notification');
            existingNotifications.forEach(notification => notification.remove());

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

            const backgrounds = {
                success: 'linear-gradient(45deg, #10b981, #059669)',
                warning: 'linear-gradient(45deg, #f59e0b, #d97706)',
                danger: 'linear-gradient(45deg, #ef4444, #dc2626)',
                info: 'linear-gradient(45deg, #3b82f6, #1d4ed8)'
            };

            notification.style.background = backgrounds[type] || backgrounds.info;
            notification.style.color = 'white';

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

            document.body.appendChild(notification);

            const closeBtn = notification.querySelector('.close');
            closeBtn.addEventListener('click', () => {
                notification.classList.add('animate__fadeOutRight');
                setTimeout(() => notification.remove(), 300);
            });

            setTimeout(() => {
                if (notification.parentNode) {
                    notification.classList.add('animate__fadeOutRight');
                    setTimeout(() => notification.remove(), 300);
                }
            }, 5000);
        }

        // CSS for modern form styling
        const style = document.createElement('style');
        style.textContent = `
            /* Modern Form Container */
            .modern-form-container {
                background: white;
                border-radius: 20px;
                box-shadow: 0 10px 40px rgba(0,0,0,0.1);
                overflow: hidden;
                margin-bottom: 30px;
            }

            .modern-form {
                padding: 30px;
            }

            /* Form Sections */
            .form-section {
                margin-bottom: 40px;
                padding: 25px;
                background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
                border-radius: 15px;
                border: 1px solid #e2e8f0;
            }

            .section-title {
                font-size: 1.3rem;
                font-weight: 700;
                margin-bottom: 20px;
                color: #1e293b;
                border-bottom: 2px solid #e2e8f0;
                padding-bottom: 10px;
            }

            /* Modern Form Groups */
            .modern-form-group {
                position: relative;
                margin-bottom: 25px;
            }

            .modern-label {
                display: block;
                font-weight: 600;
                color: #374151;
                margin-bottom: 8px;
                font-size: 0.95rem;
            }

            .modern-input, .modern-textarea {
                width: 100%;
                padding: 15px 20px;
                border: 2px solid #e5e7eb;
                border-radius: 12px;
                font-size: 1rem;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                background: #ffffff;
                color: #1f2937;
            }

            .modern-input:focus, .modern-textarea:focus {
                outline: none;
                border-color: #667eea;
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
                transform: translateY(-2px);
            }

            .modern-textarea {
                resize: vertical;
                min-height: 120px;
                font-family: 'Inter', sans-serif;
            }

            /* Modern Checkbox */
            .modern-checkbox-group {
                margin: 25px 0;
            }

            .modern-checkbox {
                display: flex;
                align-items: center;
                cursor: pointer;
                padding: 15px;
                background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
                border-radius: 12px;
                border: 2px solid #e0f2fe;
                transition: all 0.3s ease;
            }

            .modern-checkbox:hover {
                background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
                border-color: #38bdf8;
                transform: translateY(-2px);
            }

            .modern-checkbox input[type="checkbox"] {
                display: none;
            }

            .modern-checkbox .checkmark {
                width: 24px;
                height: 24px;
                background: white;
                border: 2px solid #d1d5db;
                border-radius: 6px;
                margin-right: 15px;
                position: relative;
                transition: all 0.3s ease;
            }

            .modern-checkbox input[type="checkbox"]:checked + .checkmark {
                background: linear-gradient(45deg, #10b981, #059669);
                border-color: #10b981;
            }

            .modern-checkbox input[type="checkbox"]:checked + .checkmark::after {
                content: '✓';
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                color: white;
                font-weight: bold;
                font-size: 14px;
            }

            .checkbox-text {
                flex: 1;
            }

            .checkbox-text strong {
                display: block;
                color: #1f2937;
                font-size: 1rem;
            }

            .checkbox-text small {
                color: #6b7280;
                font-size: 0.85rem;
            }

            /* Ingredients Grid */
            .ingredients-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 20px;
                margin-top: 20px;
            }

            .ingredient-card {
                background: white;
                border: 2px solid #e5e7eb;
                border-radius: 15px;
                padding: 20px;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .ingredient-card:hover {
                border-color: #667eea;
                box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
                transform: translateY(-3px);
            }

            .ingredient-checkbox {
                display: flex;
                align-items: center;
                cursor: pointer;
                margin-bottom: 15px;
            }

            .ingredient-checkbox input[type="checkbox"] {
                display: none;
            }

            .ingredient-checkbox .checkmark {
                width: 20px;
                height: 20px;
                background: white;
                border: 2px solid #d1d5db;
                border-radius: 5px;
                margin-right: 12px;
                position: relative;
                transition: all 0.3s ease;
            }

            .ingredient-checkbox input[type="checkbox"]:checked + .checkmark {
                background: linear-gradient(45deg, #f59e0b, #d97706);
                border-color: #f59e0b;
            }

            .ingredient-checkbox input[type="checkbox"]:checked + .checkmark::after {
                content: '✓';
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                color: white;
                font-weight: bold;
                font-size: 12px;
            }

            .ingredient-info h6 {
                margin: 0;
                font-weight: 600;
                color: #1f2937;
                font-size: 1rem;
            }

            .ingredient-unit {
                color: #6b7280;
                font-size: 0.85rem;
            }

            .ingredient-quantity {
                padding-top: 15px;
                border-top: 1px solid #e5e7eb;
            }

            .quantity-label {
                display: block;
                font-weight: 600;
                color: #374151;
                margin-bottom: 8px;
                font-size: 0.9rem;
            }

            .quantity-input-group {
                display: flex;
                align-items: center;
            }

            .quantity-input {
                flex: 1;
                padding: 10px 15px;
                border: 2px solid #e5e7eb;
                border-radius: 8px;
                font-size: 0.95rem;
                transition: all 0.3s ease;
            }

            .quantity-input:focus {
                outline: none;
                border-color: #f59e0b;
                box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.1);
            }

            .quantity-unit {
                margin-left: 10px;
                font-weight: 600;
                color: #6b7280;
                font-size: 0.9rem;
            }

            /* Form Actions */
            .form-actions {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 40px;
                padding-top: 30px;
                border-top: 2px solid #e5e7eb;
            }

            .btn-modern {
                padding: 15px 30px;
                border-radius: 12px;
                font-weight: 600;
                font-size: 1rem;
                border: none;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
            }

            .btn-modern:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            }

            .btn-modern:active {
                transform: translateY(0);
            }

            .btn-modern.btn-secondary {
                background: linear-gradient(45deg, #6b7280, #4b5563);
                color: white;
            }

            .btn-modern.btn-primary {
                background: linear-gradient(45deg, #667eea, #764ba2);
                color: white;
            }

            .btn-loader {
                margin-left: 10px;
            }

            /* Modern Alerts */
            .modern-alert {
                border-radius: 12px;
                border: none;
                box-shadow: 0 5px 20px rgba(0,0,0,0.1);
                margin-bottom: 25px;
            }

            /* Mobile Responsive */
            @media (max-width: 768px) {
                .modern-form {
                    padding: 20px;
                }
                
                .form-section {
                    padding: 20px;
                    margin-bottom: 25px;
                }
                
                .ingredients-grid {
                    grid-template-columns: 1fr;
                }
                
                .form-actions {
                    flex-direction: column;
                    gap: 15px;
                }
                
                .btn-modern {
                    width: 100%;
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