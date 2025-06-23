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
                                    <a href="/categories-pengeluaran" class="btn btn-success btn-sm mr-2">
                                        <i class="fas fa-tags mr-1"></i>
                                        Tambah Kategori
                                    </a>
                                    <a href="/formpengeluaran" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus mr-1"></i>
                                        Tambah Pengeluaran
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                <!-- Filter Form -->
                                <form action="{{ route('filterBy') }}" method="GET">
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
                                                    <a href="{{ route('filterBy') }}" class="btn btn-secondary">
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
                                                        <button type="button" class="btn btn-info btn-sm" onclick="showDetail({{ $expense->id }})" title="Detail" data-toggle="tooltip">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-warning btn-sm" onclick="editData({{ $expense->id }})" title="Edit" data-toggle="tooltip">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="deletedata({{ $expense->id }})"
                                                            title="Hapus"
                                                            data-toggle="tooltip">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="8" class="text-center">
                                                    <div class="alert alert-warning m-0" role="alert">
                                                        Data tidak dapat ditemukan.
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6" style="text-align: center;"><strong>Total Pengeluaran</strong></td>
                                                <td><strong>Rp{{ number_format($totalAmount ?? 0, 2, ',', '.') }}</strong></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
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

                <!-- Detail Modal -->
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

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-warning text-white">
                                <h5 class="modal-title">Edit Pengeluaran</h5>
                                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" id="editContent">
                                <!-- Form dinamis akan dimasukkan di sini -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="saveExpenseBtn" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i>Simpan
                                </button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    <i class="fas fa-times mr-1"></i>Tutup
                                </button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Chart.js (jika digunakan untuk grafik) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Global variables
        const kategoriList = @json($categories ?? []);
        let currentEditId = null;

        // Setup axios defaults
        $(document).ready(function() {
            // Setup CSRF token untuk semua request axios
            const token = $('meta[name="csrf-token"]').attr('content');
            if (token) {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
            }
            
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();
            
            console.log('Page loaded, CSRF token set:', token);
            console.log('Categories loaded:', kategoriList.length);
        });

        // Function untuk menampilkan detail
        function showDetail(id) {
            console.log('Showing detail for ID:', id);
            
            // Coba menggunakan route yang berbeda
            const possibleRoutes = [
                `/api/peng/${id}`,
                `/api/pengeluaran/${id}`,
                `/pengeluaran/${id}/detail`
            ];
            
            tryMultipleRoutes(possibleRoutes, 'GET')
                .then(data => {
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
                                <p><strong>Deskripsi:</strong> ${data.description ?? '-'}</p>
                                <p><strong>Catatan:</strong> ${data.notes ?? '-'}</p>
                                <p><strong>Jumlah:</strong> Rp${Number(data.amount).toLocaleString('id-ID', { minimumFractionDigits: 2 })}</p>
                            </div>
                        </div>
                    `;

                    document.getElementById('detailContent').innerHTML = detailHtml;
                    $('#detailModal').modal('show');
                })
                .catch(error => {
                    console.error('Error showing detail:', error);
                    handleError(error, 'Gagal mengambil detail data');
                });
        }

        // Function untuk edit data
        function editData(id) {
            console.log('Editing data for ID:', id);
            currentEditId = id;
            
            // Show loading state
            Swal.fire({
                title: 'Memuat data...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Coba beberapa route yang mungkin
            const possibleRoutes = [
                `/api/pengeluaran/${id}`,
                `/api/peng/${id}`,
                `/pengeluaran/${id}/edit`
            ];
            
            tryMultipleRoutes(possibleRoutes, 'GET')
                .then(data => {
                    Swal.close();
                    console.log('Data loaded for edit:', data);
                    
                    // Buat options untuk kategori
                    let kategoriOptions = `<option value="">-- Pilih Kategori --</option>`;
                    kategoriList.forEach(kategori => {
                        const selected = data.expense_category_id === kategori.id ? 'selected' : '';
                        kategoriOptions += `<option value="${kategori.id}" ${selected}>${kategori.name}</option>`;
                    });

                    const tanggal = new Date(data.expense_date).toISOString().split('T')[0];

                    const editHtml = `
                        <form id="editExpenseForm">
                            <input type="hidden" name="id" value="${data.id}">
                            
                            <div class="form-group">
                                <label for="creator">Nama Penginput <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="creator" value="${data.creator?.name ?? '-'}" readonly>
                                <small class="form-text text-muted">Field ini tidak dapat diubah</small>
                            </div>

                            <div class="form-group">
                                <label for="expense_date">Tanggal <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="expense_date" value="${tanggal}" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="expense_category_id">Kategori <span class="text-danger">*</span></label>
                                <select name="expense_category_id" class="form-control" required>
                                    ${kategoriOptions}
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="amount">Jumlah (Rp) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="amount" value="${data.amount}" min="0" step="1" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea class="form-control" name="description" rows="3">${data.description ?? ''}</textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="notes">Catatan</label>
                                <textarea class="form-control" name="notes" rows="3">${data.notes ?? ''}</textarea>
                            </div>
                        </form>
                    `;

                    document.getElementById('editContent').innerHTML = editHtml;
                    $('#editModal').modal('show');
                })
                .catch(error => {
                    Swal.close();
                    console.error('Error loading edit data:', error);
                    handleError(error, 'Gagal mengambil data untuk edit');
                });
        }

        // Handle save button click
        $(document).on('click', '#saveExpenseBtn', function() {
            const form = document.getElementById('editExpenseForm');
            if (!form) {
                Swal.fire('Error', 'Form tidak ditemukan', 'error');
                return;
            }

            const formData = new FormData(form);
            const data = {};
            
            // Convert FormData to object
            for (let [key, value] of formData.entries()) {
                data[key] = value;
            }
            
            console.log('Saving data:', data);

            const submitBtn = $(this);
            const originalHtml = submitBtn.html();
            submitBtn.html('<i class="fas fa-spinner fa-spin mr-1"></i>Menyimpan...').prop('disabled', true);

            // Coba beberapa route untuk update
            const possibleRoutes = [
                `/api/pengeluaran/${currentEditId}`,
                `/pengeluaran/${currentEditId}/update`,
                `/pengeluaran/${currentEditId}`
            ];
            
            tryMultipleRoutes(possibleRoutes, 'PUT', data)
                .then(response => {
                    submitBtn.html(originalHtml).prop('disabled', false);
                    $('#editModal').modal('hide');

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data pengeluaran berhasil diupdate.',
                        showConfirmButton: false,
                        timer: 2000
                    });

                    // Reload halaman setelah 2 detik
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                })
                .catch(error => {
                    submitBtn.html(originalHtml).prop('disabled', false);
                    console.error('Error saving data:', error);
                    handleError(error, 'Gagal mengupdate data');
                });
        });

        // Function untuk delete data
        function deletedata(id) {
            console.log('Deleting data for ID:', id);
            
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Coba beberapa route untuk delete
                    const possibleRoutes = [
                        `/api/pengeluaran/${id}`,
                        `/pengeluaran/${id}/delete`,
                        `/pengeluaran/${id}`
                    ];
                    
                    tryMultipleRoutes(possibleRoutes, 'DELETE')
                        .then(response => {
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

                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        })
                        .catch(error => {
                            console.error('Error deleting data:', error);
                            handleError(error, 'Gagal menghapus data');
                        });
                }
            });
        }

        // Function untuk mencoba beberapa route
        function tryMultipleRoutes(routes, method, data = null) {
            return new Promise((resolve, reject) => {
                let currentRouteIndex = 0;
                
                function tryNextRoute() {
                    if (currentRouteIndex >= routes.length) {
                        reject(new Error('Semua route gagal'));
                        return;
                    }
                    
                    const route = routes[currentRouteIndex];
                    console.log(`Trying route ${currentRouteIndex + 1}/${routes.length}: ${method} ${route}`);
                    
                    let promise;
                    
                    switch(method.toLowerCase()) {
                        case 'get':
                            promise = axios.get(route);
                            break;
                        case 'put':
                            promise = axios.put(route, data);
                            break;
                        case 'delete':
                            promise = axios.delete(route);
                            break;
                        case 'post':
                            promise = axios.post(route, data);
                            break;
                        default:
                            promise = axios.get(route);
                    }
                    
                    promise
                        .then(response => {
                            console.log(`Route ${route} berhasil:`, response.data);
                            resolve(response.data);
                        })
                        .catch(error => {
                            console.log(`Route ${route} gagal:`, error.response?.status || error.message);
                            currentRouteIndex++;
                            tryNextRoute();
                        });
                }
                
                tryNextRoute();
            });
        }

        // Function untuk handle error
        function handleError(error, defaultMessage) {
            let message = defaultMessage;
            
            if (error.response) {
                // Server merespons dengan status error
                switch(error.response.status) {
                    case 404:
                        message = 'Data tidak ditemukan atau route tidak tersedia';
                        break;
                    case 403:
                        message = 'Anda tidak memiliki akses untuk melakukan tindakan ini';
                        break;
                    case 422:
                        message = 'Data yang dikirim tidak valid';
                        if (error.response.data.errors) {
                            const errors = Object.values(error.response.data.errors).flat();
                            message += ': ' + errors.join(', ');
                        }
                        break;
                    case 500:
                        message = 'Terjadi kesalahan server internal';
                        break;
                    default:
                        message = `${defaultMessage} (Status: ${error.response.status})`;
                }
                
                console.error('Response error:', error.response.data);
            } else if (error.request) {
                message = 'Tidak ada respons dari server. Periksa koneksi internet atau route backend.';
                console.error('Request error:', error.request);
            } else {
                message = `Error: ${error.message}`;
                console.error('General error:', error.message);
            }
            
            Swal.fire('Error', message, 'error');
        }

        // Set waktu dan tanggal real time
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

            const timeEl = document.getElementById('currentTime');
            const dateEl = document.getElementById('currentDate');
            
            if (timeEl) timeEl.textContent = time;
            if (dateEl) dateEl.textContent = date;
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

        // Debug function
        window.debugExpense = function() {
            console.log('=== Debug Info ===');
            console.log('CSRF Token:', $('meta[name="csrf-token"]').attr('content'));
            console.log('Categories:', kategoriList);
            console.log('Current Edit ID:', currentEditId);
            console.log('Axios defaults:', axios.defaults.headers.common);
        };
        
        console.log('Script loaded successfully. Type debugExpense() for debug info.');
    </script>
</body>
</html>