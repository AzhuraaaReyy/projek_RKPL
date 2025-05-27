<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Galaxy Bakery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <span class="brand-text font-weight-light">Galaxy Bakery</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- User Panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a href="#" class="nav-link"></i>
                                        <p>Input Produksi</p>
                                    </a></li>
                                <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon fas fa-boxes"></i>
                                        <p>Riwayat Produksi</p>
                                    </a></li>
                            </ul>
                        </li>

                        <!-- 1. Manajemen Bahan Baku -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>Manajemen Bahan Baku<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a href="#" class="nav-link"></i>
                                        <p>Input Produksi</p>
                                    </a></li>
                                <li class="nav-item"><a href="#" class="nav-link"><i class="far fa-circle nav-icon"></i>
                                        <p>Riwayat Produksi</p>
                                    </a></li>
                            </ul>
                        </li>

                        <!-- 2. Manajemen Produksi Roti -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-bread-slice"></i>
                                <p>Manajemen Produksi Roti<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a href="#" class="nav-link"><i class="far fa-circle nav-icon"></i>
                                        <p>Input Produksi</p>
                                    </a></li>
                                <li class="nav-item"><a href="#" class="nav-link"><i class="far fa-circle nav-icon"></i>
                                        <p>Riwayat Produksi</p>
                                    </a></li>
                            </ul>
                        </li>

                        <!-- 3. Laporan dan Monitoring -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>Laporan & Monitoring<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a href="#" class="nav-link"><i class="far fa-circle nav-icon"></i>
                                        <p>Laporan Stok</p>
                                    </a></li>
                                <li class="nav-item"><a href="#" class="nav-link"><i class="far fa-circle nav-icon"></i>
                                        <p>Laporan Produksi</p>
                                    </a></li>
                            </ul>
                        </li>

                        <!-- 4. Pencatatan Pengeluaran -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-wallet"></i>
                                <p>Pencatatan Pengeluaran<i class="right fas fa-angle-left"></i></p>
                            </a>
                        </li>

                        <!-- 5. Pencatatan Penjualan -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-receipt"></i>
                                <p>Pencatatan Penjualan<i class="right fas fa-angle-left"></i></p>
                            </a>
                        </li>

                        <!-- 7. Manajemen User -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>Manajemen User<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a href="#" class="nav-link"><i class="far fa-circle nav-icon"></i>
                                        <p>Hak Akses</p>
                                    </a></li>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <h1 class="m-0">Dashboard</h1>
                </div>
            </div>

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="alert alert-success">
                        Selamat datang, <strong>{{ Auth::user()->name }}</strong>!
                    </div>
                    <!-- Tambahkan konten dashboard di sini -->
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="main-footer text-sm text-center">
            <strong>&copy; 2025 Galaxy Bakery</strong> All rights reserved.
        </footer>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>