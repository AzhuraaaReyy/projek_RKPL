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

    <style>
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

        <!-- Mobile Menu Button -->
        <button class="mobile-menu-btn d-md-none" id="mobileMenuBtn">
            <i class="fas fa-bars"></i>
        </button>

        @include('sidebar')

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
                        <div class="info-box bg-success clickable-info-box" data-toggle="modal" data-target="#produksiModal">
                            <span class="info-box-icon">
                                <i class="fas fa-bread-slice"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Produksi Hari Ini</span>
                                <span class="info-box-number">{{ $totalProduksiHariIni ?? 50 }} <small>Roti</small></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="info-box bg-warning clickable-info-box" data-toggle="modal" data-target="#bahanBakuModal">
                            <span class="info-box-icon">
                                <i class="fas fa-boxes"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Stok Bahan</span>
                                <span class="info-box-number">{{$totalbahanbaku ?? 5}} <small>Jenis</small></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="info-box bg-info clickable-info-box" data-toggle="modal" data-target="#penjualanModal">
                            <span class="info-box-icon">
                                <i class="fas fa-receipt"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Penjualan Hari Ini</span>
                                <span class="info-box-number">Rp{{ number_format($totalPenjualan ?? 25, 2, ',', '.') }}</span>
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

    <!-- Modal Detail Produksi -->
    <div class="modal fade" id="produksiModal" tabindex="-1" role="dialog" aria-labelledby="produksiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="produksiModalLabel">
                        <i class="fas fa-bread-slice mr-2"></i>Detail Produksi Hari Ini
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($produksi)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Tanggal Produksi:</label>
                                <p class="detail-value" id="produksiDate">{{ $today->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Waktu Produksi:</label>
                                <p class="detail-value" id="currentProductionTime-{{ $produksi->id }}">
                                    {{$produksi->productType->waktu_produksi_format ?? 'Tidak tersedia'  }}
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Produk:</label>
                                <p class="detail-value">{{$produksi->productType->name ?? 'Tidak tersedia'  }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Status Produksi:</label>
                                <span class="badge 
            {{ 
                $produksi->status === 'in_progress' ? 'badge-warning' : 
                ($produksi->status === 'completed' ? 'badge-success' : 'badge-secondary') 
            }}">
                                    {{ ucfirst($produksi->status) ?? 'Tidak tersedia' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Jumlah Produksi:</label>
                                <p class="detail-value">{{$produksi->quantity_produced ?? 'Tidak tersedia'  }} Roti</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Target Produksi:</label>
                                <p class="detail-value">200 Roti</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Batch Number:</label>
                                <p class="detail-value">{{$produksi->batch_number ?? 'Tidak tersedia'  }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Dibuat Oleh:</label>
                                <p class="detail-value">{{$produksi->creator->name ?? 'Tidak tersedia'  }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="detail-card">
                        <label>Catatan:</label>
                        <p class="detail-value">Produksi berjalan lancar sesuai standar kualitas Galaxy Bakery</p>
                    </div>
                    @else
                    <p class="text-muted">Tidak ada data produksi hari ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Bahan Baku -->
    <div class="modal fade" id="bahanBakuModal" tabindex="-1" role="dialog" aria-labelledby="bahanBakuModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="bahanBakuModalLabel">
                        <i class="fas fa-boxes mr-2"></i>Detail Pergerakan Stok Bahan Baku
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($bahan)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Tanggal Masuk Bahan:</label>
                                <p class="detail-value" id="stockDate-{{ $bahan->id }}">{{ \Carbon\Carbon::parse($bahan->tanggal_masuk)->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Tanggal Kadaluwarsa Bahan:</label>
                                <p class="detail-value" id="currentStockTime-{{ $bahan->id }}">{{ \Carbon\Carbon::parse($bahan->tanggal_kedaluwarsa)->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Bahan Baku:</label>
                                <p class="detail-value">{{$bahan->nama ?? 'bahan baku tidak tersedia'}}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Jenis Pergerakan:</label>
                                <span class="badge badge-danger">{{$bahan->stokMovements->first()?->movement_type ?? 'Tidak tersedia'  }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Stok Saat Ini:</label>
                                <p class="detail-value">{{$bahan->stok ?? 'bahan baku tidak tersedia'}}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Minimal Stok:</label>
                                <p class="detail-value">{{$bahan->minimum_stok ?? 'bahan baku tidak tersedia'}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Deskripsi:</label>
                                <p class="detail-value">{{$bahan->deskripsi ?? 'bahan baku tidak tersedia'}}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Kategori:</label>
                                <p class="detail-value">{{$bahan->kategori ?? 'bahan baku tidak tersedia'}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="detail-card">
                        <label>Catatan:</label>
                        <p class="detail-value">Digunakan untuk produksi roti tawar batch BTH-{{ date('Ymd') }}-001</p>
                    </div>

                    <!-- Stok Terkini -->
                    <div class="mt-4">
                        <h6 class="font-weight-bold">Status Stok Terkini:</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="status-card bg-success">
                                    <span class="status-label">Tersedia</span>
                                    <span class="status-count">{{ ($totalbahanbaku)}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="status-card bg-warning">
                                    <span class="status-label">Stok Rendah</span>
                                    <span class="status-count">{{$jumlahStokRendah }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="status-card bg-danger">
                                    <span class="status-label">Habis</span>
                                    <span class="status-count">{{$stokHabis->count() ?? 0}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <p class="text-muted">Tidak ada data produksi hari ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Penjualan -->
    <div class="modal fade" id="penjualanModal" tabindex="-1" role="dialog" aria-labelledby="penjualanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="penjualanModalLabel">
                        <i class="fas fa-receipt mr-2"></i>Detail Penjualan Hari Ini
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($penjualan)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Tanggal Transaksi:</label>
                                <p class="detail-value" id="salesDate-{{ $penjualan->id }}">{{ \Carbon\Carbon::parse($penjualan->sale_date)->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Nama Pelanggan:</label>
                                <p class="detail-value">{{$penjualan->customer->name ?? 'Tidak tersedia'  }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Produk Terjual:</label>
                                <p class="detail-value">
                                    {{ $penjualan->saleItems->first()->product_name ?? 'Tidak tersedia' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Status Penjualan:</label>
                                <span class="badge badge-success">{{ $penjualan->payment_status ?? 'Tidak tersedia' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Jumlah Terjual:</label>
                                <p class="detail-value">{{ $penjualan->saleItems->first()->quantity ?? 'Tidak tersedia' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Harga per Unit:</label>
                                <p class="detail-value">{{ $penjualan->saleItems->first()->unit_price ?? 'Tidak tersedia' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>SubTotal:</label>
                                <p class="detail-value text-success font-weight-bold">Rp {{ number_format(($penjualan->total_amount ?? 0), 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-card">
                                <label>Kasir:</label>
                                <p class="detail-value">{{ $penjualan->creator->first()->name ?? 'Tidak tersedia' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="detail-card">
                        <label>Catatan:</label>
                        <p class="detail-value">Penjualan lancar, produk laris manis di pasaran</p>
                    </div>

                    <!-- Ringkasan Penjualan -->
                    <div class="mt-4">
                        <h6 class="font-weight-bold">Ringkasan Penjualan Hari Ini:</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="status-card bg-primary">
                                    <span class="status-label">Total Transaksi</span>
                                    <span class="status-count">{{ ($jumlahTransaksi ?? 0) }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="status-card bg-success">
                                    <span class="status-label">Total Penjualan Bulan Ini</span>
                                    <span class="status-count small">Rp {{ number_format(($totalPenjualan ?? 0), 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="status-card bg-info">
                                    <span class="status-label">Target Penjualan Barang</span>
                                    <span class="status-count">100 Pcs</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <p class="text-muted">Tidak ada data penjualan hari ini.</p>
                    @endif
                </div>
            </div>
        </div>
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
                    },
                    zoom: {
                        pan: {
                            enabled: true,
                            mode: 'x', // hanya geser horizontal
                            modifierKey: 'ctrl' // bisa dihilangkan jika tidak ingin pakai tombol Ctrl
                        },
                        zoom: {
                            wheel: {
                                enabled: true
                            },
                            pinch: {
                                enabled: true
                            },
                            mode: 'x',
                        },
                        limits: {
                            x: {
                                minRange: 3
                            } // supaya tidak zoom terlalu dekat
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
            axios.get('/api/production-karyawan').then(res => {
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

            // Enhanced hover effects for clickable info boxes
            $('.clickable-info-box').hover(
                function() {
                    $(this).addClass('animate__animated animate__pulse animate__faster');
                },
                function() {
                    $(this).removeClass('animate__animated animate__pulse animate__faster');
                }
            );

            // Update real-time dalam modal
            function updateModalTimes() {
                const now = new Date();
                const timeString = now.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });

                const dateString = now.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                });

                $('#currentProductionTime').text(timeString);
                $('#currentStockTime').text(timeString);
                $('#currentSalesTime').text(timeString);
                $('#produksiDate').text(dateString);
                $('#stockDate').text(dateString);
                $('#salesDate').text(dateString);
            }

            // Update setiap detik
            setInterval(updateModalTimes, 1000);
            updateModalTimes(); // Initial call

            // Enhanced modal animations
            $('.modal').on('show.bs.modal', function() {
                $(this).find('.modal-dialog').addClass('animate__animated animate__zoomIn animate__faster');
            });

            $('.modal').on('hidden.bs.modal', function() {
                $(this).find('.modal-dialog').removeClass('animate__animated animate__zoomIn animate__faster');
            });

            // Add click sound effect (optional)
            $('.clickable-info-box').on('click', function() {
                // Vibration for mobile devices
                if (navigator.vibrate) {
                    navigator.vibrate(50);
                }
            });

            // Keyboard shortcuts for modals
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape') {
                    $('.modal').modal('hide');
                }

                // Ctrl + 1, 2, 3 untuk buka modal
                if (e.ctrlKey) {
                    switch (e.key) {
                        case '1':
                            e.preventDefault();
                            $('#produksiModal').modal('show');
                            break;
                        case '2':
                            e.preventDefault();
                            $('#bahanBakuModal').modal('show');
                            break;
                        case '3':
                            e.preventDefault();
                            $('#penjualanModal').modal('show');
                            break;
                    }
                }
            });

            // Auto refresh data in modals every 30 seconds
            setInterval(function() {
                // Simulate data refresh
                console.log('Refreshing modal data...');
                // Here you could add AJAX calls to refresh actual data
            }, 30000);

            // Enhanced detail card animations
            $('.detail-card').hover(
                function() {
                    $(this).addClass('animate__animated animate__pulse animate__faster');
                },
                function() {
                    $(this).removeClass('animate__animated animate__pulse animate__faster');
                }
            );
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

        // Jalankan saat pertama kali dan setiap 1 detik
        updateDateTime();
        setInterval(updateDateTime, 1000);

        // Initialize tooltips and other interactive elements
        $(document).ready(function() {
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Add smooth scrolling
            document.documentElement.style.scrollBehavior = 'smooth';
        });

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
    </script>

</body>

</html>