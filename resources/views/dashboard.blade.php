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
                            <a href="/dashboard" class="nav-link active">
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
                <!-- Info Boxes -->
                <div class="row animate__animated animate__fadeInUp">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="info-box bg-success">
                            <span class="info-box-icon">
                                <i class="fas fa-bread-slice"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Produksi Hari Ini</span>
                                <span class="info-box-number">{{ $totalProduksiHariIni ?? 0 }} <small>Roti</small></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="info-box bg-warning">
                            <span class="info-box-icon">
                                <i class="fas fa-boxes"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Stok Bahan</span>
                                <span class="info-box-number">{{$totalbahanbaku ?? 0}} <small>Jenis</small></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="info-box bg-info">
                            <span class="info-box-icon">
                                <i class="fas fa-receipt"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Penjualan Hari Ini</span>
                                <span class="info-box-number">{{$totalPenjualan ?? 0}}</span>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        const ctx = document.getElementById('produksiChart').getContext('2d');

        // Fungsi buat gradient warna (optional)
        const createGradient = (ctx, color1, color2) => {
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, color1);
            gradient.addColorStop(0.7, color2);
            gradient.addColorStop(1, 'rgba(255,255,255,0.1)');
            return gradient;
        };

        // Inisialisasi Chart.js tanpa data dulu
        let produksiChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Produksi Aktual',
                    data: [],
                    backgroundColor: createGradient(ctx, 'rgba(16, 185, 129, 0.8)', 'rgba(16, 185, 129, 0.2)'),
                    borderColor: '#10b981',
                    borderWidth: 4,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 7,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#10b981',
                    pointBorderWidth: 3,
                    pointHoverRadius: 9,
                    pointHoverBackgroundColor: '#10b981',
                    pointHoverBorderColor: '#fff',
                    pointHoverBorderWidth: 3,
                }, {
                    label: 'Target Produksi',
                    data: [],
                    backgroundColor: 'transparent',
                    borderColor: '#ef4444',
                    borderWidth: 3,
                    borderDash: [8, 4],
                    fill: false,
                    tension: 0,
                    pointRadius: 0,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: '#ef4444',
                    pointHoverBorderColor: '#fff',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        top: 20,
                        bottom: 20,
                        left: 15,
                        right: 15
                    }
                },
                animation: {
                    duration: 1500,
                    easing: 'easeInOutCubic',
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
                            padding: 25,
                            font: {
                                size: 14,
                                weight: '600',
                                family: "'Inter', sans-serif"
                            },
                            color: '#1e293b'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(30, 41, 59, 0.95)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: '#10b981',
                        borderWidth: 2,
                        cornerRadius: 12,
                        displayColors: true,
                        padding: 12,
                        titleFont: {
                            size: 14,
                            weight: '600'
                        },
                        bodyFont: {
                            size: 13,
                            weight: '500'
                        },
                        callbacks: {
                            label: function(context) {
                                const value = context.formattedValue;
                                const target = 200;
                                let label = context.dataset.label + ': ' + value + ' pcs';
                                if (context.dataset.label === 'Produksi Aktual') {
                                    const percentage = ((context.raw / target) * 100).toFixed(1);
                                    const status = context.raw >= target ? '✅' : '⚠️';
                                    label += ` (${percentage}% dari target ${status})`;
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
                        suggestedMax: 280,
                        grid: {
                            color: 'rgba(148, 163, 184, 0.2)',
                            lineWidth: 1
                        },
                        ticks: {
                            color: '#475569',
                            font: {
                                size: 12,
                                weight: '600',
                                family: "'Inter', sans-serif"
                            },
                            callback: (value) => value + ' pcs',
                            padding: 10
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#64748b',
                            font: {
                                size: 12,
                                weight: '600',
                                family: "'Inter', sans-serif"
                            },
                            padding: 10
                        }
                    }
                }
            }
        });

        let lastDataHash = null;

        function hashData(data) {
            return JSON.stringify(data);
        }

        function fetchDataAndUpdateChart() {
            axios.get('/api/production-stats').then(res => {
                let labels = res.data.labels;
                let actual = res.data.actual;
                let target = res.data.target;

                // Gabungkan jadi objek array supaya mudah di-sort
                const combinedData = labels.map((label, idx) => ({
                    label,
                    actual: actual[idx],
                    target: target[idx]
                }));

                // Urutkan ascending berdasarkan tanggal (label)
                combinedData.sort((a, b) => new Date(a.label) - new Date(b.label));

                // Pisahkan kembali
                labels = combinedData.map(item => item.label);
                actual = combinedData.map(item => item.actual);
                target = combinedData.map(item => item.target);

                const currentHash = hashData({
                    labels,
                    actual,
                    target
                });

                if (currentHash === lastDataHash) {
                    return;
                }

                lastDataHash = currentHash;

                produksiChart.data.labels = labels;
                produksiChart.data.datasets[0].data = actual;
                produksiChart.data.datasets[1].data = target;
                produksiChart.update();
            }).catch(error => {
                console.error('Error fetching production stats:', error);
            });
        }


        // Load data pertama kali
        fetchDataAndUpdateChart();

        // Update data setiap 10 detik
        setInterval(fetchDataAndUpdateChart, 10000);

        // Enhanced sidebar toggle
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

        // Enhanced real-time date and time updates


        // Start updates with variable intervals for more natural feel
        const startEnhancedUpdates = () => {
            const updateInterval = () => {
                updateChart();
                const nextInterval = 3000 + Math.random() * 3000; // 3-6 seconds
                setTimeout(updateInterval, nextInterval);
            };
            setTimeout(updateInterval, 4000);
        };

        startEnhancedUpdates();

        // Enhanced hover effects for chart
        document.getElementById('produksiChart').addEventListener('mouseover', function() {
            produksiChart.data.datasets[0].pointRadius = 9;
            produksiChart.data.datasets[0].borderWidth = 5;
            produksiChart.update('none');
        });

        document.getElementById('produksiChart').addEventListener('mouseout', function() {
            produksiChart.data.datasets[0].pointRadius = 7;
            produksiChart.data.datasets[0].borderWidth = 4;
            produksiChart.update('none');
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


        //set waktu dan tanggal real time
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

        // Jalankan saat pertama kali dan setiap 1 detik
        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>

</body>

</html>