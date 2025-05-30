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

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --sidebar-bg: #2c3e50;
            --sidebar-hover: #34495e;
            --text-dark: #2c3e50;
            --text-light: #7f8c8d;
            --shadow: 0 4px 20px rgba(0,0,0,0.1);
            --shadow-hover: 0 8px 25px rgba(0,0,0,0.15);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }

        /* Sidebar Styling */
        .main-sidebar {
            background: var(--sidebar-bg) !important;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .brand-link {
            background: var(--primary-gradient) !important;
            color: white !important;
            border-bottom: none !important;
            padding: 1rem 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .brand-link::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: rotate(45deg);
            transition: all 0.6s;
        }

        .brand-link:hover::before {
            animation: shine 0.6s ease-in-out;
        }

        @keyframes shine {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }

        .brand-text {
            font-size: 1.3rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.5px;
        }

        .sidebar-toggle-btn {
            background: rgba(255,255,255,0.15) !important;
            border: 1px solid rgba(255,255,255,0.3) !important;
            border-radius: 50% !important;
            width: 40px !important;
            height: 40px !important;
            transition: all 0.3s ease !important;
        }

        .sidebar-toggle-btn:hover {
            background: rgba(255,255,255,0.25) !important;
            transform: translateY(-50%) scale(1.1) !important;
            box-shadow: 0 4px 15px rgba(255,255,255,0.2);
        }

        .sidebar-toggle-btn i {
            transition: transform 0.3s ease;
        }

        body.sidebar-collapse .sidebar-toggle-btn i {
            transform: rotate(180deg);
        }

        /* User Panel */
        .user-panel {
            padding: 1rem !important;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .user-panel .image img {
            border: 3px solid rgba(255,255,255,0.3);
            transition: all 0.3s ease;
        }

        .user-panel:hover .image img {
            border-color: rgba(255,255,255,0.6);
            transform: scale(1.05);
        }

        .user-panel .info a {
            color: #ecf0f1 !important;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .user-panel .info a:hover {
            color: #3498db !important;
        }

        /* Navigation */
        .nav-sidebar .nav-item .nav-link {
            color: #bdc3c7 !important;
            border-radius: 8px;
            margin: 0.2rem 0.5rem;
            transition: all 0.3s ease;
            padding: 0.7rem 1rem;
        }

        .nav-sidebar .nav-item .nav-link:hover {
            background: var(--sidebar-hover) !important;
            color: #3498db !important;
            transform: translateX(5px);
        }

        .nav-sidebar .nav-item .nav-link.active {
            background: var(--primary-gradient) !important;
            color: white !important;
            box-shadow: 0 4px 10px rgba(102, 126, 234, 0.3);
        }

        .nav-icon {
            transition: transform 0.3s ease;
            margin-right: 0.5rem !important;
        }

        .nav-link:hover .nav-icon {
            transform: scale(1.2);
        }

        /* Treeview */
        .nav-treeview {
            background: rgba(0,0,0,0.1);
            border-radius: 8px;
            margin: 0.2rem 0;
        }

        .nav-treeview .nav-link {
            padding-left: 2rem !important;
            font-size: 0.9rem;
        }

        /* Logout Button */
        .sidebar-logout {
            margin-top: auto;
            padding: 1rem;
        }

        .sidebar-logout .btn {
            background: var(--secondary-gradient) !important;
            border: none !important;
            border-radius: 25px !important;
            padding: 0.7rem 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: var(--shadow);
        }

        .sidebar-logout .btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        /* Content Header */
        .content-header {
            background: var(--primary-gradient) !important;
            color: white !important;
            border-radius: 0 0 20px 20px !important;
            margin: 0 !important;
            padding: 2rem !important;
            box-shadow: var(--shadow);
        }

        .content-header h1 {
            font-size: 2.5rem !important;
            font-weight: 700 !important;
            margin: 0 !important;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .content-header small {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .header-info-box {
            background: rgba(255,255,255,0.15) !important;
            backdrop-filter: blur(10px);
            border-radius: 15px !important;
            padding: 1rem !important;
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s ease;
        }

        .header-info-box:hover {
            background: rgba(255,255,255,0.2) !important;
            transform: translateY(-2px);
        }

        /* Info Boxes */
        .info-box {
            border-radius: 15px !important;
            box-shadow: var(--shadow) !important;
            border: none !important;
            transition: all 0.3s ease !important;
            overflow: hidden;
            position: relative;
        }

        .info-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .info-box:hover::before {
            left: 100%;
        }

        .info-box:hover {
            transform: translateY(-8px) !important;
            box-shadow: var(--shadow-hover) !important;
        }

        .info-box-icon {
            border-radius: 15px 0 15px 0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 2rem !important;
            width: 90px !important;
        }

        .info-box-content {
            padding: 1rem !important;
        }

        .info-box-text {
            font-size: 0.9rem !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            opacity: 0.8;
        }

        .info-box-number {
            font-size: 1.8rem !important;
            font-weight: 700 !important;
            margin-top: 0.5rem !important;
        }

        /* Chart Container */
        .chart-container {
            background: var(--primary-gradient);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
            margin-top: 2rem;
        }

        .chart-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, rgba(255,255,255,0.05) 0%, transparent 50%, rgba(255,255,255,0.05) 100%);
            animation: shimmer 4s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }

        .chart-wrapper {
            background: rgba(255,255,255,0.95);
            border-radius: 15px;
            padding: 1.5rem;
            position: relative;
            z-index: 2;
            backdrop-filter: blur(10px);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.3);
        }

        .chart-title {
            color: var(--text-dark);
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .chart-stats {
            position: absolute;
            top: 2rem;
            right: 2rem;
            background: rgba(255,255,255,0.95);
            padding: 0.7rem 1rem;
            border-radius: 25px;
            box-shadow: var(--shadow);
            z-index: 3;
            backdrop-filter: blur(10px);
        }

        .pulse-dot {
            width: 12px;
            height: 12px;
            background: #28a745;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { 
                box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
                transform: scale(1);
            }
            70% { 
                box-shadow: 0 0 0 10px rgba(40, 167, 69, 0);
                transform: scale(1.05);
            }
            100% { 
                box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
                transform: scale(1);
            }
        }

        /* Footer */
        .main-footer {
            background: white !important;
            border-top: 1px solid #e9ecef !important;
            color: var(--text-light) !important;
            padding: 1rem !important;
            margin-top: 2rem;
        }

        /* Content Wrapper */
        .content-wrapper {
            margin-left: 250px !important;
            transition: margin-left 0.3s ease !important;
        }

        body.sidebar-collapse .content-wrapper {
            margin-left: 4.6rem !important;
        }

        .content {
            padding: 0 1.5rem 1.5rem 1.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .content-wrapper {
                margin-left: 0 !important;
            }
            
            .content-header {
                border-radius: 0 !important;
            }
            
            .content-header h1 {
                font-size: 2rem !important;
            }
            
            .header-info-box {
                margin-bottom: 1rem;
            }
            
            .info-box .info-box-icon {
                width: 70px !important;
                font-size: 1.5rem !important;
            }
            
            .chart-stats {
                position: static;
                margin-bottom: 1rem;
                display: inline-block;
            }
        }

        /* Scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.5);
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

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
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info ml-3">
                    <a href="#" class="d-block text-white">{{ Auth::user()->name }}</a>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="mt-3 flex-grow-1">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link active">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p>Bahan Baku<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Input Produksi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
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
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Input Produksi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Riwayat Produksi</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>Laporan<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Laporan Stok</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Laporan Produksi</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-wallet"></i>
                            <p>Pengeluaran</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-receipt"></i>
                            <p>Penjualan</p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>Manajemen User<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Hak Akses</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </nav>

            <!-- Logout Button -->
            <!-- Logout Button -->
            <div class="sidebar-logout">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-block">
                        <i class="fas fa-sign-out-alt"></i> Logout
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
                        <h1>Dashboard</h1>
                        <small>Selamat datang kembali di Galaxy Bakery!</small>
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
                                    <div class="font-weight-bold" id="currentTime">21:34:22</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="header-info-box text-center">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <div class="small" id="currentDate">Kamis, 29 Mei 2025</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="content">
            <!-- Info Boxes -->
            <div class="row animate__animated animate__fadeInUp">
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="info-box bg-success">
                        <span class="info-box-icon">
                            <i class="fas fa-bread-slice"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Produksi Hari Ini</span>
                            <span class="info-box-number">150 <small>Roti</small></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="info-box bg-warning">
                        <span class="info-box-icon">
                            <i class="fas fa-boxes"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Stok Bahan</span>
                            <span class="info-box-number">20 <small>Jenis</small></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="info-box bg-info">
                        <span class="info-box-icon">
                            <i class="fas fa-receipt"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Penjualan Hari Ini</span>
                            <span class="info-box-number">Rp 1.250.000</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="row animate__animated animate__fadeInUp animate__delay-1s">
                <div class="col-12">
                    <div class="chart-container">
                        <div class="chart-stats">
                            <span class="pulse-dot"></span>
                            <small class="text-success font-weight-bold">Live Data</small>
                        </div>
                        <div class="chart-wrapper">
                            <h3 class="chart-title">
                                <i class="fas fa-chart-line text-primary"></i>
                                Statistik Produksi Real-time
                            </h3>
                            <div style="position: relative; height: 400px; width: 100%;">
                                <canvas id="produksiChart"></canvas>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('produksiChart').getContext('2d');

    // Membuat gradien yang lebih dinamis
    const createGradient = (ctx, color1, color2) => {
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, color1);
        gradient.addColorStop(0.5, color2);
        gradient.addColorStop(1, 'rgba(255,255,255,0.1)');
        return gradient;
    };

    // Inisialisasi data dengan variasi yang lebih menarik
    let labels = ['10:00', '10:15', '10:30', '10:45', '11:00', '11:15', '11:30'];
    let productionData = [180, 195, 175, 220, 205, 190, 210];
    let targetData = [200, 200, 200, 200, 200, 200, 200];

    const produksiChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Produksi Aktual',
                    data: productionData,
                    backgroundColor: createGradient(ctx, 'rgba(46, 204, 113, 0.8)', 'rgba(46, 204, 113, 0.3)'),
                    borderColor: '#2ecc71',
                    borderWidth: 4,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 6,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#2ecc71',
                    pointBorderWidth: 3,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: '#2ecc71',
                    pointHoverBorderColor: '#fff',
                    pointHoverBorderWidth: 2,
                },
                {
                    label: 'Target Produksi',
                    data: targetData,
                    backgroundColor: 'transparent',
                    borderColor: '#e74c3c',
                    borderWidth: 3,
                    borderDash: [10, 5],
                    fill: false,
                    tension: 0,
                    pointRadius: 0,
                    pointHoverRadius: 6,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    top: 20,
                    bottom: 20,
                    left: 10,
                    right: 10
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeInOutBounce',
                onProgress: function(animation) {
                    // Efek berkedip pada titik data saat animasi
                    const progress = animation.currentStep / animation.numSteps;
                    if (progress > 0.8) {
                        this.data.datasets[0].pointRadius = 6 + Math.sin(Date.now() / 200) * 2;
                        this.update('none');
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: '#2ecc71',
                    borderWidth: 2,
                    cornerRadius: 10,
                    displayColors: true,
                    callbacks: {
                        label: function(context) {
                            const value = context.formattedValue;
                            const target = context.dataset.label === 'Produksi Aktual' ? 200 : null;
                            let label = context.dataset.label + ': ' + value + ' pcs';
                            
                            if (target && context.dataset.label === 'Produksi Aktual') {
                                const percentage = ((context.raw / target) * 100).toFixed(1);
                                label += ` (${percentage}% dari target)`;
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: false,
                    suggestedMin: 150,
                    suggestedMax: 250,
                    grid: {
                        color: 'rgba(0,0,0,0.1)',
                        lineWidth: 1
                    },
                    ticks: {
                        color: '#2c3e50',
                        font: {
                            size: 12,
                            weight: 'bold'
                        },
                        callback: function(value) {
                            return value + ' pcs';
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#34495e',
                        font: {
                            size: 12,
                            weight: '600'
                        }
                    }
                }
            }
        }
    });

    
    // Sidebar toggle functionality
    document.querySelector('[data-widget="pushmenu"]').addEventListener('click', function(e) {
        e.preventDefault();
        document.body.classList.toggle('sidebar-collapse');
    });
    
    // Fungsi untuk update waktu dan tanggal real-time
    const updateDateTime = () => {
        const now = new Date();
        
        // Format waktu
        const timeOptions = {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false
        };
        const timeString = now.toLocaleTimeString('id-ID', timeOptions);
        
        // Format tanggal
        const dateOptions = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        const dateString = now.toLocaleDateString('id-ID', dateOptions);
        
        // Update DOM
        const timeElement = document.getElementById('currentTime');
        const dateElement = document.getElementById('currentDate');
        
        if (timeElement) timeElement.textContent = timeString;
        if (dateElement) dateElement.textContent = dateString;
    };
    
    // Update waktu setiap detik
    updateDateTime();
    setInterval(updateDateTime, 1000);

    // Fungsi untuk update data dengan efek yang lebih menarik
    let updateCounter = 0;
    const updateChart = () => {
        updateCounter++;
        
        // Generate waktu baru
        const now = new Date();
        const hours = now.getHours();
        const minutes = now.getMinutes();
        const timeString = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;
        
        // Generate data produksi dengan pola yang lebih realistis
        const baseProduction = 200;
        const timeVariation = Math.sin(updateCounter / 10) * 20; // Variasi berdasarkan waktu
        const randomVariation = (Math.random() - 0.5) * 30; // Variasi random
        const newProductionValue = Math.max(150, Math.min(250, 
            baseProduction + timeVariation + randomVariation
        ));
        
        // Efek transisi yang smooth
        produksiChart.data.labels.push(timeString);
        produksiChart.data.labels.shift();
        
        produksiChart.data.datasets[0].data.push(Math.round(newProductionValue));
        produksiChart.data.datasets[0].data.shift();
        
        produksiChart.data.datasets[1].data.push(200);
        produksiChart.data.datasets[1].data.shift();
        
        // Update dengan animasi
        produksiChart.update('active');
        
        // Efek visual tambahan setiap 5 update
        if (updateCounter % 5 === 0) {
            // Flash effect pada border
            produksiChart.data.datasets[0].borderWidth = 6;
            setTimeout(() => {
                produksiChart.data.datasets[0].borderWidth = 4;
                produksiChart.update('none');
            }, 200);
        }
    };
    
    // Update setiap 3 detik dengan variasi interval
    const startUpdates = () => {
        const updateInterval = () => {
            updateChart();
            // Variasi interval antara 2-4 detik untuk efek yang lebih natural
            const nextInterval = 2000 + Math.random() * 2000;
            setTimeout(updateInterval, nextInterval);
        };
        setTimeout(updateInterval, 3000); // Mulai setelah 3 detik
    };
    
    // Mulai update otomatis
    startUpdates();
    
    // Efek hover yang enhanced
    document.getElementById('produksiChart').addEventListener('mouseover', function() {
        produksiChart.data.datasets[0].pointRadius = 8;
        produksiChart.update('none');
    });
    
    document.getElementById('produksiChart').addEventListener('mouseout', function() {
        produksiChart.data.datasets[0].pointRadius = 6;
        produksiChart.update('none');
    });
</script>

</body>
</html>