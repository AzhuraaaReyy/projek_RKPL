<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Input Produksi Bahan Baku - Galaxy Bakery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- AdminLTE, Bootstrap, FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

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

            @include('sidebar')

            <!-- Content Wrapper -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header animate__animated animate__fadeInDown">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-12">
                                <h1>Input Produksi Bahan Baku</h1>
                                <small>Kelola input dan stok bahan baku untuk produksi</small>
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
                            <div class="info-box bg-primary">
                                <span class="info-box-icon">
                                    <i class="fas fa-boxes"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Input Hari Ini</span>
                                    <span class="info-box-number">{{ $countinput ?? 15 }} <small>Transaksi</small></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="info-box bg-success">
                                <span class="info-box-icon">
                                    <i class="fas fa-plus-circle"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Barang Masuk</span>
                                    <span class="info-box-number">{{ $baranginput ?? 125 }} <small>Kg</small></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="info-box bg-warning">
                                <span class="info-box-icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Harga Bahan</span>
                                    <span class="info-box-number" style="font-size: 15px;">Rp {{ number_format($hargainput ?? 0, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="info-box bg-info">
                                <span class="info-box-icon">
                                    <i class="fas fa-archive"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Bahan Aktif</span>
                                    <span class="info-box-number">{{ $jumlahAktif ?? 8 }} <small>Item</small></span>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Filter and Search Section -->
                    <div class="row animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-filter mr-2"></i>
                                        Filter & Pencarian Data
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <form method="GET" action="{{ route('filter.karyawan.bahan') }} " onsubmit="return validateFilterForm()">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Kategori</label>
                                                    <select name="kategori" class="form-control">
                                                        <option value="">-- Semua Kategori --</option>
                                                        <option value="kering" {{ request('kategori') == 'kering' ? 'selected' : '' }}>Kering</option>
                                                        <option value="cair" {{ request('kategori') == 'cair' ? 'selected' : '' }}>Cair</option>
                                                        <option value="beku" {{ request('kategori') == 'beku' ? 'selected' : '' }}>Beku</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Tanggal Dari</label>
                                                    <input type="date" name="tanggal_dari" class="form-control" value="{{ request('tanggal_dari') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Tanggal Sampai</label>
                                                    <input type="date" name="tanggal_sampai" class="form-control" value="{{ request('tanggal_sampai') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Cari Bahan</label>
                                                    <input type="text" name="search" class="form-control" placeholder="Nama bahan..." value="{{ request('search') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <button type="submit" class="btn btn-primary btn-block">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Table -->
                    <div class="row animate__animated animate__fadeInUp animate__delay-3s">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <h3 class="card-title">
                                                <i class="fas fa-list mr-2"></i>
                                                Riwayat Input Bahan Baku
                                            </h3>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <div class="btn-group">
                                                <a href="{{route('karyawan.inputbahan')}}">
                                                    <button type="button" class="btn btn-success btn-sm">
                                                        <i class="fas fa-sync-alt mr-1"></i> Refresh
                                                    </button>
                                                </a>
                                                <form id="downloadForm" action="{{ route('karyawan.download') }}" method="GET">
                                                    <button type="submit" id="exportBtn" class="btn btn-info btn-sm">
                                                        <i class="fas fa-download mr-1"></i> Export
                                                    </button>
                                                </form>
                                                <a href="{{route('karyawan.formbahanbaku')}}">
                                                    <button type="button" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-plus mr-1"></i> Input Baru
                                                    </button>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">

                                        <table class="table table-bordered table-striped table-hover" id="inputBahanTable">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th width="15%">Tanggal</th>
                                                    <th width="20%">Nama Bahan</th>
                                                    <th width="10%">Kategori</th>
                                                    <th width="10%">Jumlah Stok</th>
                                                    <th width="8%">Tanggal Kadaluwarsa</th>
                                                    <th width="12%">Harga/Unit</th>
                                                    <th width="10%">Deskripsi</th>
                                                    <th width="10%">Status</th>
                                                    <th width="10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($bahanBakus as $index => $input)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($input->tanggal_masuk ?? $input->created_at ?? now())) }}</td>
                                                    <td><strong>{{ $input->nama ?? '-' }}</strong></td>
                                                    <td><span class="badge badge-info">{{ ucfirst($input->kategori ?? '-') }}</span></td>
                                                    <td class="text-center">{{ number_format($input->stok ?? 0) }} {{ $input->satuan ?? '-' }}</td>
                                                    <td class="text-center">{{ date('d/m/Y', strtotime($input->tanggal_kedaluwarsa ?? $input->created_at ?? now())) }}</td>
                                                    <td class="text-right">Rp {{ number_format($input->harga ?? 0, 0, ',', '.') }}</td>
                                                    <td class="text-center">{{ $input->deskripsi ?? '-' }}</td>
                                                    <td class="text-center">
                                                        <span class="badge bg-{{ $input->status_class }}">
                                                            {{ $input->status }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-sm">
                                                            <button type="button" class="btn btn-info btn-sm" onclick="showDetail({{ $input->id ?? 1 }})" title="Detail" data-toggle="tooltip">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm"
                                                                onclick="deletedata({{ $input->id ?? 1 }})"
                                                                title="Hapus"
                                                                data-toggle="tooltip">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="9" class="text-center">Data tidak ditemukan.</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-center">

                                        </div>
                                    </div>

                                    {{-- Pagination --}}
                                    @if(isset($bahanBakus) && method_exists($bahanBakus, 'links'))
                                    <div class="d-flex justify-content-center mt-3">
                                        {{ $bahanBakus->links('pagination::bootstrap-4') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-info text-white">
                                    <h5 class="modal-title" id="detailModalLabel">Detail Bahan Baku</h5>
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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        document.getElementById('downloadForm').addEventListener('submit', function(e) {
            e.preventDefault(); // cegah submit langsung

            Swal.fire({
                title: 'Laporan sedang diproses',
                text: 'File PDF akan segera diunduh...',
                icon: 'success',
                position: 'center', // TAMPIL DI TENGAH
                showConfirmButton: false,
                timer: 1500,
                toast: false // pastikan bukan toast supaya di tengah, bukan pojok kanan atas
            });

            setTimeout(() => {
                e.target.submit(); // lanjutkan submit form setelah animasi selesai
            }, 1000);
        });

        function updateTime() {
            const now = new Date();

            const time = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

            const date = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            document.getElementById('currentTime').textContent = time;
            document.getElementById('currentDate').textContent = date;
        }

        // Panggil sekali saat load
        updateTime();

        // Update setiap detik
        setInterval(updateTime, 1000);


        function validateFilterForm() {
            const dari = document.querySelector('input[name="tanggal_dari"]').value;
            const sampai = document.querySelector('input[name="tanggal_sampai"]').value;

            if (dari && sampai && dari > sampai) {
                alert("Tanggal Dari tidak boleh lebih besar dari Tanggal Sampai.");
                return false;
            }

            return true;
        }

        function showDetail(id) {
            axios.get(`/api/karyawan-baku/${id}`)
                .then(response => {
                    const data = response.data;
                    const total = data.stok * data.harga;

                    const detailHtml = `
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            
                            <tr><td><strong>Nama Bahan:</strong></td><td>${data.nama}</td></tr>
                            <tr><td><strong>Kategori:</strong></td><td><span class="badge badge-info">${data.kategori}</span></td></tr>
                            <tr><td><strong>Stok:</strong></td><td>${data.stok} ${data.satuan}</td></tr>
                            <tr><td><strong>Harga per Unit:</strong></td><td>Rp ${parseInt(data.harga).toLocaleString('id-ID')}</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                  
                            <tr><td><strong>Stok Minimum:</strong></td><td>${data.minimum_stok ?? '-'} ${data.satuan}</td></tr>
                            <tr><td><strong>Tanggal Masuk:</strong></td><td>${new Date(data.tanggal_masuk).toLocaleDateString('id-ID')}</td></tr>
                            <tr><td><strong>Keterangan:</strong></td><td>${data.deskripsi ?? '-'}</td></tr>
                           <tr><td><strong>Status:</strong></td><td><span class="badge bg-${data.status_class ?? 'secondary'}">${data.status ?? '-'}</span></td></tr>


                            
                        </table>
                    </div>
                </div>
            `;

                    document.getElementById('detailContent').innerHTML = detailHtml;
                    $('#detailModal').modal('show');
                })
                .catch(error => {
                    let message = 'Terjadi kesalahan tak dikenal.';

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

                    Swal.fire('Gagal', message, 'error');
                });
        }

        function deletedata(id) {
            fetch(`/api/karyawan-baku/${id}`, {
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
    </script>
    <!-- jQuery (cukup satu kali) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap Bundle (sudah termasuk popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Chart.js (jika digunakan untuk grafik) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <script>
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

        function updateTime() {
            const now = new Date();

            const time = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

            const date = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            document.getElementById('currentTime').textContent = time;
            document.getElementById('currentDate').textContent = date;
        }



        // Jalankan saat pertama kali dan setiap 1 detik
        updateDateTime();
        setInterval(updateDateTime, 1000);

        // Enhanced info box animations
        document.querySelectorAll('.info-box').forEach(box => {
            box.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
                this.style.transition = 'all 0.3s ease';
            });

            box.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
                this.style.transition = 'all 0.3s ease';
            });
        });

        // Sample data untuk CRUD operations


        // Function to show input modal
        function showInputModal() {
            // Reset form
            document.getElementById('inputBahanForm').reset();
            document.getElementById('tanggal_masuk').value = '{{ date("Y-m-d") }}';
            document.getElementById('stok_minimum').value = '10';
            document.getElementById('totalNilai').textContent = 'Rp 0';

            // Show modal
            $('#inputBahanModal').modal('show');
        }

        // Form submission handler
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

        // Function to add new row to table
        function addNewRowToTable(data) {
            const tbody = document.querySelector('#inputBahanTable tbody');
            const newId = Object.keys(sampleData).length + 1;
            const total = (parseFloat(data.stok) || 0) * (parseFloat(data.harga) || 0);

            const newRow = `
            <tr data-id="${newId}" class="animate__animated animate__fadeIn">
                <td>${newId}</td>
                <td>${new Date().toLocaleDateString('id-ID')}</td>
                <td><strong>${data.nama_bahan}</strong></td>
                <td><span class="badge badge-info">${data.kategori.charAt(0).toUpperCase() + data.kategori.slice(1)}</span></td>
                <td class="text-center">${parseFloat(data.stok).toFixed(2)}</td>
                <td class="text-center">${data.satuan}</td>
                <td class="text-right">Rp ${parseInt(data.harga_per_unit).toLocaleString('id-ID')}</td>
                <td class="text-right">Rp ${total.toLocaleString('id-ID')}</td>
                <td class="text-center">
                    <div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-info btn-sm" onclick="showDetail(${newId})" title="Detail" data-toggle="tooltip">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button type="button" class="btn btn-warning btn-sm" onclick="editData(${newId})" title="Edit" data-toggle="tooltip">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteData(${newId})" title="Hapus" data-toggle="tooltip">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            `;

            tbody.insertAdjacentHTML('afterbegin', newRow);

            // Add to sample data
            sampleData[newId] = {
                id: newId,
                nama_bahan: data.nama_bahan,
                kategori: data.kategori,
                jumlah: parseFloat(data.jumlah),
                satuan: data.satuan,
                harga_per_unit: parseInt(data.harga_per_unit),
                stok_minimum: parseFloat(data.stok_minimum) || 10,
                supplier: data.supplier || '',
                tanggal_masuk: data.tanggal_masuk,
                keterangan: data.keterangan || ''
            };

            // Initialize tooltips for new row
            $('[data-toggle="tooltip"]').tooltip();
        }

        // Functions
        function refreshData() {
            // Show loading
            $('#inputBahanTable tbody').html('<tr> <
                td colspan = "9"
                class = "text-center" > < i class = "fas fa-spinner fa-spin" > < /i> Memuat data...</td >
                <
                /tr>');

                // Simulate data refresh
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }

            function exportData() {
                Swal.fire({
                    title: 'Export Data',
                    html: `
            <div class="text-left">
                <p>Pilih format export:</p>
                <div class="btn-group-vertical w-100">
                    <button class="btn btn-outline-success mb-2" onclick="exportToExcel()">
                        <i class="fas fa-file-excel mr-2"></i> Export ke Excel
                    </button>
                    <button class="btn btn-outline-danger mb-2" onclick="exportToPDF()">
                        <i class="fas fa-file-pdf mr-2"></i> Export ke PDF
                    </button>
                    <button class="btn btn-outline-info" onclick="exportToCSV()">
                        <i class="fas fa-file-csv mr-2"></i> Export ke CSV
                    </button>
                </div>
            </div>
            `,
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'Tutup'
                });
            }

            function exportToExcel() {
                Swal.fire('Info', 'Fitur export Excel sedang dalam pengembangan.', 'info');
            }

            function exportToPDF() {
                Swal.fire('Info', 'Fitur export PDF sedang dalam pengembangan.', 'info');
            }

            function exportToCSV() {
                Swal.fire('Info', 'Fitur export CSV sedang dalam pengembangan.', 'info');
            }










            // Auto-calculate total when price or quantity changes
            $('#jumlah, #harga_per_unit, #edit_jumlah, #edit_harga_per_unit').on('input', function() {
                const isEdit = this.id.startsWith('edit_');
                const prefix = isEdit ? 'edit_' : '';

                const jumlah = parseFloat($(`#${prefix}jumlah`).val()) || 0;
                const harga = parseFloat($(`#${prefix}harga_per_unit`).val()) || 0;
                const total = jumlah * harga;

                if (!isEdit) {
                    $('#totalNilai').text('Rp ' + total.toLocaleString('id-ID'));
                }
            });

            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Add smooth scrolling
            document.documentElement.style.scrollBehavior = 'smooth';
    </script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>