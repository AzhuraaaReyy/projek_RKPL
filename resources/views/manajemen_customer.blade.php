<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manajemen Pelanggan - Galaxy Bakery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- AdminLTE, Bootstrap, FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">

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
        @include('sidebar')

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header animate__animated animate__fadeInDown">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">
                                <i class="fas fa-users mr-2"></i>Manajemen Pelanggan
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                <li class="breadcrumb-item active">Manajemen Pelanggan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="content">
                <div class="container-fluid">

                    <!-- Alert Messages -->
                    @if(session('success') || session('Success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('success') ?: session('Success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <!-- Statistik Pelanggan -->
                    <div class="row animate__animated animate__fadeInUp">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $customers->count() }}</h3>
                                    <p>Total Pelanggan</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $customers->where('is_active', true)->count() }}</h3>
                                    <p>Pelanggan Aktif</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-check"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ number_format($customers->sum('total_spent') ?? 0) }}</h3>
                                    <p>Total Penjualan (Rp)</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $customers->where('created_at', '>=', now()->subDays(30))->count() }}</h3>
                                    <p>Pelanggan Baru (30 hari)</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filter dan Search Card -->
                    <div class="row animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-search mr-1"></i>
                                        Filter Pelanggan
                                    </h3>

                                </div>
                                <form action="{{ route('customers.filter') }}" method="GET">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="search">Cari Pelanggan</label>
                                                    <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Nama, telepon, alamat...">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="filter">Filter Status</label>
                                                    <select name="filter" class="form-control">
                                                        <option value="">Semua</option>
                                                        <option value="active" {{ request('filter') == 'active' ? 'selected' : '' }}>Aktif</option>
                                                        <option value="inactive" {{ request('filter') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="filterProduct">Filter Produk</label>
                                                    <select name="filterProduct" class="form-control">
                                                        <option value="">Semua Produk</option>
                                                        @foreach(['Roti Tawar', 'Croissant', 'Donat', 'Bagel', 'Muffin'] as $produk)
                                                        <option value="{{ $produk }}" {{ request('filterProduct') == $produk ? 'selected' : '' }}>
                                                            {{ $produk }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="filterSpent">Filter Pembelian</label>
                                                    <select name="filterSpent" class="form-control">
                                                        <option value="">Semua</option>
                                                        <option value="high" {{ request('filterSpent') == 'high' ? 'selected' : '' }}>> Rp 1.000.000</option>
                                                        <option value="medium" {{ request('filterSpent') == 'medium' ? 'selected' : '' }}>Rp 500.000 - 1.000.000</option>
                                                        <option value="low" {{ request('filterSpent') == 'low' ? 'selected' : '' }}>
                                                            < Rp 500.000</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <button type="submit" class="btn btn-info form-control">
                                                        <i class="fas fa-search mr-1"></i>Cari & Filter
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <a href="{{ route('customers') }}" class="btn btn-secondary ml-2">Reset</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Pelanggan -->
                    <div class="row animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-list mr-1"></i>
                                        Daftar Pelanggan Galaxy Bakery
                                    </h3>
                                </div>
                                <div class="card-body">
                                    @if($customers->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="customersTable">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Pelanggan</th>
                                                    <th>Alamat</th>
                                                    <th>No. Telepon</th>
                                                    <th>Status</th>
                                                    <th>Produk Favorit</th>
                                                    <th>Total Pembelian</th>
                                                    <th>Tanggal Daftar</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($customers as $index => $customer)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        <div class="user-panel d-flex align-items-center">
                                                            <div class="image">
                                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($customer->name) }}&background={{ $customer->is_active ? '007bff' : '6c757d' }}&color=fff&size=40" class="img-circle elevation-2" alt="User Image">
                                                            </div>
                                                            <div class="info ml-2">
                                                                <strong>{{ $customer->name }}</strong><br>
                                                                <small class="text-muted">
                                                                    {{ $customer->is_active ? 'Pelanggan Aktif' : 'Pelanggan Tidak Aktif' }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $customer->address }}</td>
                                                    <td>{{ $customer->phone }}</td>
                                                    <td>
                                                        @if($customer->is_active)
                                                        <span class="badge badge-success">Aktif</span>
                                                        @else
                                                        <span class="badge badge-secondary">Tidak Aktif</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($customer->favorite_products && $customer->favorite_products != '')
                                                        @php
                                                        $favorites = is_array($customer->favorite_products) ? $customer->favorite_products : explode(',', $customer->favorite_products);
                                                        @endphp
                                                        @foreach(array_slice($favorites, 0, 2) as $product)
                                                        <span class="badge badge-warning mb-1">{{ trim($product) }}</span>
                                                        @endforeach
                                                        @if(count($favorites) > 2)
                                                        <span class="badge badge-light">+{{ count($favorites) - 2 }}</span>
                                                        @endif
                                                        @else
                                                        <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <strong>{{ $customer->total_items ?? 0 }} item</strong><br>
                                                        <small class="text-muted">Rp {{ number_format($customer->total_spent ?? 0, 0, ',', '.') }}</small>
                                                    </td>
                                                    <td>{{ $customer->created_at->format('d M Y') }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailModal{{ $customer->id }}">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form method="POST" action="{{ route('customers.delete', $customer->id) }}" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan {{ $customer->name }}?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- Pagination --}}
                                    @if(isset($customers) && method_exists($customers, 'links'))
                                    <div class="d-flex justify-content-center mt-3">
                                        {{ $customers->links('pagination::bootstrap-4') }}
                                    </div>
                                    @endif
                                    @else
                                    <div class="text-center py-5">
                                        <i class="fas fa-users fa-5x text-muted mb-3"></i>
                                        <h5 class="text-muted">Belum ada data pelanggan</h5>
                                        <p class="text-muted">Mulai tambahkan pelanggan pertama Anda</p>
                                        <a href="" class="btn btn-primary">
                                            <i class="fas fa-plus mr-1"></i>Tambah Pelanggan
                                        </a>
                                    </div>
                                    @endif
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

    <!-- Modal Detail Pelanggan (Dynamic) -->
    @foreach($customers as $customer)
    <div class="modal fade" id="detailModal{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModal{{ $customer->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModal{{ $customer->id }}Label">
                        <i class="fas fa-user-circle mr-2"></i>Detail Pelanggan - {{ $customer->name }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title text-primary">
                                        <i class="fas fa-info-circle mr-1"></i>Informasi Dasar
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <tr>
                                            <td><strong>Nama:</strong></td>
                                            <td>{{ $customer->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Telepon:</strong></td>
                                            <td>{{ $customer->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Alamat:</strong></td>
                                            <td>{{ $customer->address }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td>
                                                @if($customer->is_active)
                                                <span class="badge badge-success">Aktif</span>
                                                @else
                                                <span class="badge badge-secondary">Tidak Aktif</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Bergabung:</strong></td>
                                            <td>{{ $customer->created_at->format('d F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Terakhir Update:</strong></td>
                                            <td>{{ $customer->updated_at->format('d F Y H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title text-success">
                                        <i class="fas fa-chart-line mr-1"></i>Statistik Pembelian
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <tr>
                                            <td><strong>Total Transaksi:</strong></td>
                                            <td>{{ $customer->total_transactions ?? 0 }} kali</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total Item:</strong></td>
                                            <td>{{ $customer->total_items ?? 0 }} produk</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total Belanja:</strong></td>
                                            <td>Rp {{ number_format($customer->total_spent ?? 0, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Rata-rata/transaksi:</strong></td>
                                            <td>Rp {{ $customer->total_transactions > 0 ? number_format(($customer->total_spent ?? 0) / $customer->total_transactions, 0, ',', '.') : '0' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Terakhir Belanja:</strong></td>
                                            <td>{{ $customer->last_purchase ? \Carbon\Carbon::parse($customer->last_purchase)->diffForHumans() : 'Belum pernah' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#customersTable').DataTable({
                "pageLength": 10,
                "lengthChange": false,
                "searching": false,
                "language": {
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ pelanggan",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 pelanggan",
                    "zeroRecords": "Tidak ada data yang ditemukan"
                }
            });

            // Custom search functionality
            $('#search').on('keyup', function() {
                $('#customersTable').DataTable().search(this.value).draw();
            });

            // Filter functionality
            $('#filter, #filterProduct, #filterSpent').on('change', function() {
                filterTable();
            });

            // Real-time search
            $('#search').on('keyup', function() {
                var searchText = this.value;
                $('#customersTable').DataTable().search(searchText).draw();
            });
        });

        function filterTable() {
            var status = $('#filter').val();
            var product = $('#filterProduct').val();
            var spent = $('#filterSpent').val();
            var searchText = $('#search').val();

            var table = $('#customersTable').DataTable();

            // Reset all filters
            table.columns().search('');

            // Apply status filter
            if (status === 'active') {
                table.column(4).search('Aktif');
            } else if (status === 'inactive') {
                table.column(4).search('Tidak Aktif');
            }

            // Apply product filter
            if (product !== '') {
                table.column(5).search(product);
            }

            // Apply search text to all columns
            if (searchText) {
                table.search(searchText);
            }

            // For spent filter, we need custom filtering
            if (spent !== '') {
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var spentText = data[6]; // Total Pembelian column
                        var spentValue = 0;

                        // Extract numeric value from "Rp X" format
                        var match = spentText.match(/Rp ([\d.,]+)/);
                        if (match) {
                            spentValue = parseInt(match[1].replace(/[.,]/g, ''));
                        }

                        if (spent === 'high' && spentValue > 1000000) return true;
                        if (spent === 'medium' && spentValue >= 500000 && spentValue <= 1000000) return true;
                        if (spent === 'low' && spentValue < 500000) return true;
                        if (spent === '') return true;

                        return false;
                    }
                );
            } else {
                // Clear custom search
                $.fn.dataTable.ext.search.pop();
            }

            table.draw();
        }

        // Clear filters function
        function clearFilters() {
            $('#search').val('');
            $('#filter').val('');
            $('#filterProduct').val('');
            $('#filterSpent').val('');
            $('#customersTable').DataTable().search('').columns().search('').draw();
            $.fn.dataTable.ext.search.pop(); // Remove custom filter
        }

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

        // Auto hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    </script>
</body>

</html>