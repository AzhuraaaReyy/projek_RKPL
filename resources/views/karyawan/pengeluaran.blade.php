<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pengeluaran - Galaxy Bakery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        @include('sidebar')

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header animate__animated animate__fadeInDown">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">
                            <h1>Pengeluaran</h1>
                            <small>Kelola dan pantau semua pengeluaran Galaxy Bakery</small>
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
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="info-box bg-warning">
                            <span class="info-box-icon">
                                <i class="fas fa-money-bill-wave"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Pengeluaran Hari Ini</span>
                                <span class="info-box-number">Rp{{ number_format($todayTotalAmount ?? 0, 2, ',', '.') }} <small>IDR</small></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="info-box bg-success">
                            <span class="info-box-icon">
                                <i class="fas fa-chart-line"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Pengeluaran Bulan Ini</span>
                                <span class="info-box-number">Rp{{ number_format($totalAmount ?? 0, 2, ',', '.') }} <small>IDR</small></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="info-box bg-info">
                            <span class="info-box-icon">
                                <i class="fas fa-tags"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Kategori Pengeluaran</span>
                                <span class="info-box-number">{{$totalcategories}} <small>Kategori</small></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="info-box bg-danger">
                            <span class="info-box-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Budget Alert</span>
                                <span class="info-box-number">85% <small>Terpakai</small></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons & Main Card -->
                <div class="row animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-money-bill-wave mr-2"></i>
                                    Data Pengeluaran
                                </h3>
                                <div class="card-tools">
                                    <a href="/karyawan-categoriespengeluaran" class="btn btn-success btn-sm mr-2">
                                        <i class="fas fa-tags mr-1"></i>
                                        Tambah Kategori
                                    </a>
                                    <a href="/karyawanformpengeluaran" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus mr-1"></i>
                                        Tambah Pengeluaran
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                <!-- Filter Form -->
                                <form action="{{ route('filterBykaryawan') }}" method="GET">
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="expense_date">Filter Tanggal:</label>
                                                <input type="date" id="expense_date" name="expense_date" class="form-control"
                                                    value="{{ request('expense_date') }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="expense_category_id">Filter Kategori:</label>
                                                <select id="expense_category_id" name="expense_category_id" class="form-control">
                                                    <option value="">-- Semua Kategori --</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ request('expense_category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <div class="d-block">
                                                    <button type="submit" class="btn btn-info mr-2">
                                                        <i class="fas fa-search mr-1"></i> Filter
                                                    </button>
                                                    <a href="{{ route('karyawan.pengeluaran') }}" class="btn btn-secondary">
                                                        <i class="fas fa-undo mr-1"></i> Reset
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>


                                <!-- Table -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Pengeluaran</th>
                                                <th>Tanggal</th>
                                                <th>Deskripsi</th>
                                                <th>Catatan</th>
                                                <th>Harga</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($expenses as $index => $expense)
                                            <tr data-id="{{ $expense->id }}">
                                                <td>{{ $expenses->firstItem() + $index  }}</td>
                                                <td>{{ $expense->creator->name ?? '-' }}</td>
                                                <td>{{ $expense->category->name ?? '-' }}</td>
                                                <td>{{ $expense->expense_date }}</td>
                                                <td>{{ $expense->description }}</td>
                                                <td>{{ $expense->notes }}</td>
                                                <td>Rp{{ number_format($expense->amount, 2, ',', '.') }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm">
                                                        <button type="button" class="btn btn-info btn-sm" onclick="showDetail({{ $expense->id ?? 1 }})" title="Detail" data-toggle="tooltip">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="deletedata({{ $expense->id ?? 1 }})"
                                                            title="Hapus"
                                                            data-toggle="tooltip">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            @empty
                                            <tr>
                                                <td colspan="11" class="text-center">
                                                    <div class="alert alert-warning m-0" role="alert">
                                                        Data tidak dapat ditemukan.
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforelse
                                        <tfoot>
                                            <tr>
                                                <td colspan="6" style="text-align: center;"><strong>Total Pengeluaran</strong></td>
                                                <td><strong>Rp{{ number_format($totalAmount, 2, ',', '.') }}</strong></td>
                                            </tr>
                                        </tfoot>

                                        </tbody>

                                    </table>
                                    {{-- Pagination --}}
                                    @if(isset($expenses) && method_exists($expenses, 'links'))
                                    <div class="d-flex justify-content-center mt-3">
                                        {{ $expenses->links('pagination::bootstrap-4') }}
                                    </div>
                                    @endif
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title" id="detailModalLabel">Detail Pengeluaran</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="detailContent">
                                <!-- Konten detail akan dimuat di sini oleh JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <form id="editBahanForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Bahan Baku</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body" id="editContent">
                                    <!-- Form dinamis akan dimasukkan di sini -->
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </form>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Chart.js (jika digunakan untuk grafik) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        function showDetail(id) {
            axios.get(`/api/karpe/${id}`)
                .then(response => {
                    const data = response.data;
                    const tanggal = new Date(data.expense_date).toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    });
                    const detailHtml = `
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nama Penginput:</strong> ${data.creator?.name ?? '-'}</p>
                        <p><strong>Kategori:</strong> ${data.category?.name ?? '-'}</p>
                       <p><strong>Tanggal:</strong> ${tanggal}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Deskripsi:</strong> ${data.description}</p>
                        <p><strong>Catatan:</strong> ${data.notes ?? '-'}</p>
                        <p><strong>Jumlah:</strong> Rp${Number(data.amount).toLocaleString('id-ID', { minimumFractionDigits: 2 })}</p>
                    </div>
                </div>
            `;

                    document.getElementById('detailContent').innerHTML = detailHtml;
                    $('#detailModal').modal('show');
                })
                .catch(error => {
                    let message = 'Terjadi kesalahan tak dikenal.';
                    if (error.response) {
                        message = `Gagal mengambil data. Status: ${error.response.status} - ${error.response.statusText}`;
                        console.error('Detail error:', error.response.data);
                    } else if (error.request) {
                        message = 'Tidak ada respons dari server. Cek koneksi atau endpoint.';
                        console.error('Permintaan:', error.request);
                    } else {
                        message = `Error saat menyiapkan permintaan: ${error.message}`;
                    }
                    Swal.fire('Gagal', message, 'error');
                });
        }

        function deletedata(id) {
            fetch(`/api/karyawan-pengeluaran/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal menghapus data');
                    }
                    return response.json();
                })
                .then(() => {
                    const row = document.querySelector(`tr[data-id="${id}"]`);
                    if (row) {
                        row.classList.add('animate__animated', 'animate__fadeOut');
                        setTimeout(() => {
                            row.remove();
                        }, 500);
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Terhapus!',
                        text: 'Data berhasil dihapus.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    location.reload();
                })
                .catch(error => {
                    let message = 'Gagal mengupdate data.';

                    if (error.response) {
                        message += ` (${error.response.status} - ${error.response.statusText})`;
                        console.error(error.response.data);
                    }

                    if (error.response) {
                        // Server merespons dengan status di luar 2xx
                        message = `Gagal mengambil data. Status: ${error.response.status} - ${error.response.statusText}`;
                        console.error('Detail error:', error.response.data);
                    } else if (error.request) {
                        // Permintaan dikirim tapi tidak ada respons
                        message = 'Tidak ada respons dari server. Cek koneksi atau endpoint.';
                        console.error('Permintaan:', error.request);
                    } else {
                        // Terjadi kesalahan saat men-setup request
                        message = `Error saat menyiapkan permintaan: ${error.message}`;
                    }
                    Swal.fire('Error', message, 'error');
                    console.error('Error detail:', error);
                });
        }
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

        // Add hover effects to table rows
        document.querySelectorAll('.table tbody tr').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#f8f9fa';
            });

            row.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '';
            });
        });











        function showInputModal() {
            // Reset form
            document.getElementById('inputBahanForm').reset();
            document.getElementById('tanggal_masuk').value = '{{ date("Y-m-d") }}';
            document.getElementById('stok_minimum').value = '10';
            document.getElementById('totalNilai').textContent = 'Rp 0';

            // Show modal
            $('#inputBahanModal').modal('show');
        }

        $('#inputBahanForm').on('submit', function(e) {
            e.preventDefault();

            // Show loading state
            const submitBtn = $(this).find('button[type="submit"]');
            const originalHtml = submitBtn.html();
            submitBtn.html('<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...').prop('disabled', true);

            // Get form data
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);

            // Simulate API call
            setTimeout(() => {
                // Reset button
                submitBtn.html(originalHtml).prop('disabled', false);

                // Hide modal
                $('#inputBahanModal').modal('hide');

                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data bahan baku berhasil disimpan.',
                    showConfirmButton: false,
                    timer: 2000
                });

                // Add new row to table (in real implementation, refresh from server)
                addNewRowToTable(data);

            }, 1500);
        });
        // Set today's date as default for filter
        document.getElementById('filter_date').value = new Date().toISOString().split('T')[0];

        // Filter Functions
        function applyFilter() {
            const date = document.getElementById('filter_date').value;
            const category = document.getElementById('filter_category').value;

            // Simulate filtering (in real implementation, this would send AJAX request)
            console.log('Applying filter:', {
                date,
                category
            });

            // Show loading state
            const btn = event.target;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Filtering...';
            btn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.disabled = false;

                // Show success message
                showNotification('Filter berhasil diterapkan!', 'success');
            }, 1000);
        }

        function resetFilter() {
            document.getElementById('filter_date').value = new Date().toISOString().split('T')[0];
            document.getElementById('filter_category').value = '';
            showNotification('Filter berhasil direset!', 'info');
        }

        // Notification function
        function showNotification(message, type = 'info') {
            const alertClass = type === 'success' ? 'alert-success' : type === 'danger' ? 'alert-danger' : 'alert-info';
            const iconClass = type === 'success' ? 'fa-check-circle' : type === 'danger' ? 'fa-exclamation-triangle' : 'fa-info-circle';

            const alert = document.createElement('div');
            alert.className = `alert ${alertClass} alert-dismissible fade show position-fixed`;
            alert.style.cssText = 'top: 20px; right: 20px; z-index: 9999; max-width: 350px;';
            alert.innerHTML = `
                <i class="fas ${iconClass} mr-2"></i>
                ${message}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            `;

            document.body.appendChild(alert);

            // Auto remove after 3 seconds
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.remove();
                }
            }, 3000);
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


        // Add click animation to action buttons
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                // Add ripple effect
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    background: rgba(255, 255, 255, 0.4);
                    border-radius: 50%;
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    pointer-events: none;
                `;

                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add CSS for ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Add smooth scrolling
        document.documentElement.style.scrollBehavior = 'smooth';

        // Simulate real-time data updates for info boxes
        function updateInfoBoxes() {
            const infoBoxNumbers = document.querySelectorAll('.info-box-number');
            // This would be replaced with actual API calls in production

            // Just for demo - add subtle animation to show "live" data
            infoBoxNumbers.forEach(box => {
                box.style.transform = 'scale(1.02)';
                setTimeout(() => {
                    box.style.transform = 'scale(1)';
                }, 200);
            });
        }

        // Update info boxes every 30 seconds (demo)
        setInterval(updateInfoBoxes, 30000);

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl + N for new expense
            if (e.ctrlKey && e.key === 'n') {
                e.preventDefault();
                window.location.href = '/formpengeluaran';
            }

            // Ctrl + F for focus on date filter
            if (e.ctrlKey && e.key === 'f') {
                e.preventDefault();
                document.getElementById('filter_date').focus();
            }
        });
    </script>

</body>

</html>