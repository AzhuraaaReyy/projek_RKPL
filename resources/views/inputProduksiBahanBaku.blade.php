<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Stok Bahan Baku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="container mt-5">
        <h1 class="text-center mb-4">📦 Monitoring Stok Bahan Baku</h1>

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
                                    <a href="/monitoring" class="nav-link">
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

                <a href="{{ route('bahan') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Tambah Bahan Baku
                </a>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark text-center">
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
                            @forelse ($bahanBakus as $index => $bahan)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $bahan->nama }}</td>
                                <td class="text-capitalize text-center">{{ $bahan->kategori }}</td>
                                <td class="text-end">{{ number_format($bahan->stok) }}</td>
                                <td class="text-center">{{ $bahan->satuan }}</td>
                                <td class="text-end">{{ number_format($bahan->minimum_stok) }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($bahan->tanggal_masuk)->format('d-m-Y') }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($bahan->tanggal_kedaluwarsa)->format('d-m-Y') }}</td>
                                <td class="text-center">Rp{{ number_format($bahan->harga, 2, ',', '.') }}</td>
                                <td class="text-center">{{ $bahan->deskripsi }}</td>
                                <td class="text-center">
                                    <span class="badge bg-{{ $bahan->status_class }}">
                                        {{ $bahan->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">Data bahan baku belum tersedia.</td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
</body>

</html>