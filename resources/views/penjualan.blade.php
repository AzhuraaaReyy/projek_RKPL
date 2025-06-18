<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Form Penjualan - Galaxy Bakery</title>
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
        @include('sidebar')

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header animate__animated animate__fadeInDown">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">
                            <h1>
                                <i class="fas fa-receipt mr-3"></i>
                                Penjualan
                            </h1>
                            <small>Kelola transaksi penjualan Galaxy Bakery</small>
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
                @if ($errors->any())
                <div class="alert alert-danger animate__animated animate__fadeInUp">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="row animate__animated animate__fadeInUp">
                    <div class="col-lg-6 col-md-12">
                        <div class="action-card">
                            <a href="/form-customers" class="action-btn btn-add-customer">
                                <div class="action-icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="action-content">
                                    <h4>Tambah Customer</h4>
                                    <p>Daftarkan pelanggan baru</p>
                                </div>
                                <div class="action-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="action-card">
                            <button type="button" class="action-btn btn-add-sale" onclick="toggleFormVisibility()">
                                <div class="action-icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="action-content">
                                    <h4>Input Penjualan</h4>
                                    <p>Buat transaksi penjualan baru</p>
                                </div>
                                <div class="action-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sales Form -->
                <div class="row animate__animated animate__fadeInUp" id="salesForm" style="display: none;">
                    <div class="col-12">
                        <div class="data-container">
                            <div class="data-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3>
                                            <i class="fas fa-shopping-cart mr-3"></i>
                                            Form Input Penjualan
                                        </h3>
                                        <small>Input data penjualan produk Galaxy Bakery</small>
                                    </div>
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="toggleFormVisibility()">
                                        <i class="fas fa-times mr-1"></i>
                                        Tutup Form
                                    </button>
                                </div>
                            </div>

                            <form action="{{ route('sale') }}" method="POST">
                                @csrf
                                <div class="form-content">
                                    <!-- Basic Information -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sale_date">Tanggal Penjualan:</label>
                                                <input type="date" name="sale_date" id="sale_date" class="form-control" value="{{ old('sale_date') }}" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="customer_id">Pilih Customer:</label>
                                                <select name="customer_id" id="customer_id" class="form-control" required>
                                                    <option value="">-- Pilih --</option>
                                                    @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                                        {{ $customer->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <hr />

                                    <!-- Products Section -->
                                    <h5><i class="fas fa-box mr-2"></i>Produk yang Dibeli</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="items-table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Nama Produk</th>
                                                    <th>Deskripsi Produk</th>
                                                    <th>Quantity</th>
                                                    <th>Harga Satuan</th>
                                                    <th>Subtotal</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select name="product_type_id[]" class="form-control product-type" required>
                                                            <option value="">-- Pilih Produk --</option>
                                                            @foreach ($producType as $type)
                                                            <option value="{{ $type->id }}" data-name="{{ $type->name }}"
                                                                data-description="{{ $type->description }}">
                                                                {{ $type->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><input type="text" name="product_description[]" class="form-control" readonly required /></td>
                                                    <td><input type="number" name="quantity[]" class="form-control qty" value="1" min="1" required /></td>
                                                    <td><input type="number" name="unit_price[]" class="form-control price" value="0" min="0" required /></td>
                                                    <td class="subtotal text-right font-weight-bold">Rp 0</td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                    <!-- Input hidden untuk nama produk -->
                                                    <input type="hidden" name="product_name[]" class="product-name" />
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>



                                    <button type="button" class="btn btn-success mb-3" onclick="addRow()">
                                        <i class="fas fa-plus mr-1"></i>
                                        Tambah Produk
                                    </button>

                                    <hr />

                                    <!-- Payment Information -->
                                    <h5><i class="fas fa-credit-card mr-2"></i>Informasi Pembayaran</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="payment_method">Metode Pembayaran:</label>
                                                <select name="payment_method" id="payment_method" class="form-control" required>
                                                    <option value="cash">Cash</option>
                                                    <option value="transfer">Transfer</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="notes">Catatan:</label>
                                        <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Masukkan catatan tambahan...">{{ old('notes') }}</textarea>
                                    </div>
                                </div>

                                <div class="form-footer">
                                    <div class="float-right">
                                        <button type="button" class="btn btn-secondary mr-2" onclick="toggleFormVisibility()">
                                            <i class="fas fa-times mr-1"></i>
                                            Batal
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save mr-1"></i>
                                            Simpan Penjualan
                                        </button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sales Table -->
                <div class="row animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="col-12">
                        <div class="data-container">
                            <div class="data-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3>
                                            <i class="fas fa-chart-bar mr-3"></i>
                                            Laporan Penjualan
                                        </h3>
                                        <small>Daftar semua transaksi penjualan</small>
                                    </div>
                                    <div class="data-stats">
                                        <span class="pulse-dot"></span>
                                        <small class="text-success font-weight-bold">Live Data</small>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="12%">Nama Pelanggan</th>
                                            <th width="15%">Barang Yang di Beli</th>
                                            <th width="10%">Total Harga</th>
                                            <th width="10%">Tanggal Penjualan</th>
                                            <th width="10%">Catatan</th>
                                            <th width="10%">Nama Kasir</th>
                                            <th width="8%">Metode Pembayaran</th>
                                            <th width="10%">Status Pembayaran</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($sales as $index => $sale)
                                        <tr>
                                            <td class="text-center font-weight-bold">{{ $sales->firstItem() + $index }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-user text-primary mr-2"></i>
                                                    <strong>{{ $sale->customer->name ?? '-' }}</strong>
                                                </div>
                                            </td>
                                            <td class="ingredient-list">
                                                <ul class="list-unstyled mb-0">
                                                    @php
                                                    $warnaIkon = ['text-warning', 'text-info', 'text-danger', 'text-success', 'text-primary'];
                                                    @endphp
                                                    @foreach ($sale->saleItems as $itemIndex => $item)
                                                    <li>
                                                        <i class="fas fa-circle {{ $warnaIkon[$itemIndex % count($warnaIkon)] }}" style="font-size: 0.4rem;"></i>
                                                        {{ $item->productType->name ?? 'Produk tidak ditemukan' }} (x{{ $item->quantity }})
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td class="text-right">
                                                <strong class="text-success">Rp{{ number_format($sale->total_amount, 2, ',', '.') }}</strong>
                                            </td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($sale->sale_date)->format('d-m-Y') }}</td>
                                            <td class="text-center">{{ $sale->notes ?? '-' }}</td>
                                            <td class="text-center">{{ $sale->creator->name ?? '-' }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-info text-capitalize">{{ $sale->payment_method }}</span>
                                            </td>
                                            <td class="text-center">
                                                @if($sale->payment_status == 'paid')
                                                <span class="badge bg-success">Lunas</span>
                                                @elseif($sale->payment_status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                                @elseif($sale->payment_status == 'cancelled')
                                                <span class="badge bg-danger">Dibatalkan</span>
                                                @else
                                                <span class="badge bg-secondary">{{ $sale->payment_status }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($sale->payment_status == 'pending')
                                                <div class="btn-group" role="group">
                                                    <form action="{{ route('karyawan.update', $sale->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" name="action" value="paid" class="btn btn-sm btn-success"
                                                            onclick="return confirm('Tandai sebagai lunas?')">
                                                            ✅ Lunas
                                                        </button>
                                                    </form>

                                                </div>
                                                @elseif($sale->payment_status == 'paid')
                                                <span class="text-success fs-4" title="Lunas">✅ Lunas</span>
                                                @else
                                                <span class="text-muted fs-4" title="{{ $sale->payment_status }}">{{ $sale->payment_status }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10" class="text-center text-muted">Data penjualan belum tersedia.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            @if(isset($sales) && method_exists($sales, 'links'))
                            <div class="d-flex justify-content-center mt-3">
                                {{ $sales->links('pagination::bootstrap-4') }}
                            </div>
                            @endif
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
        // Set today's date as default
        document.getElementById('sale_date').value = new Date().toISOString().split('T')[0];

        // Toggle form visibility
        function toggleFormVisibility() {
            const formContainer = document.getElementById('salesForm');
            if (formContainer.style.display === 'none' || formContainer.style.display === '') {
                formContainer.style.display = 'block';
                formContainer.classList.add('animate__fadeIn');
                // Scroll to form
                formContainer.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            } else {
                formContainer.classList.add('animate__fadeOut');
                setTimeout(() => {
                    formContainer.style.display = 'none';
                    formContainer.classList.remove('animate__fadeOut', 'animate__fadeIn');
                }, 500);
            }
        }

        function addRow() {
            const template = document.querySelector('#items-table tbody tr');
            const clone = template.cloneNode(true);

            // Reset semua input di baris baru
            clone.querySelectorAll('input').forEach(input => {
                if (input.type === 'hidden') {
                    input.value = '';
                } else if (input.type === 'number') {
                    input.value = input.classList.contains('qty') ? 1 : 0;
                } else {
                    input.value = '';
                }
            });

            clone.querySelector('.product-type').selectedIndex = 0;
            clone.querySelector('.subtotal').textContent = 'Rp 0';

            document.querySelector('#items-table tbody').appendChild(clone);

            attachEventListeners(clone);
        }

        function removeRow(button) {
            const rows = document.querySelectorAll('#items-table tbody tr');
            if (rows.length > 1) {
                button.closest('tr').remove();
                updateSubtotals();
            } else {
                alert('Minimal 1 produk harus ada.');
            }
        }

        function updateSubtotals() {
            document.querySelectorAll('#items-table tbody tr').forEach(row => {
                const qty = parseFloat(row.querySelector('.qty').value) || 0;
                const price = parseFloat(row.querySelector('.price').value) || 0;
                const subtotal = qty * price;
                row.querySelector('.subtotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
            });
        }

        function attachEventListeners(row) {
            row.querySelector('.qty').addEventListener('input', updateSubtotals);
            row.querySelector('.price').addEventListener('input', updateSubtotals);

            row.querySelector('.product-type').addEventListener('change', function() {
                const selected = this.options[this.selectedIndex];
                const description = selected.getAttribute('data-description') || '';
                const name = selected.getAttribute('data-name') || '';

                const descInput = row.querySelector('input[name="product_description[]"]');
                if (descInput) {
                    descInput.value = description;
                }

                const nameInput = row.querySelector('input[name="product_name[]"]');
                if (nameInput) {
                    nameInput.value = name;
                }

                updateSubtotals();
            });
        }

        window.onload = function() {
            document.querySelectorAll('#items-table tbody tr').forEach(row => {
                attachEventListeners(row);
            });
            updateSubtotals();
        };

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

            // Enhanced hover effects for action cards
            document.querySelectorAll('.action-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        });

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

        // Notification system
        function showNotification(message, type = 'info') {
            // Remove existing notifications
            const existingNotifications = document.querySelectorAll('.custom-notification');
            existingNotifications.forEach(notification => notification.remove());

            // Create notification element
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

            // Set background based on type
            const backgrounds = {
                success: 'linear-gradient(45deg, #10b981, #059669)',
                warning: 'linear-gradient(45deg, #f59e0b, #d97706)',
                danger: 'linear-gradient(45deg, #ef4444, #dc2626)',
                info: 'linear-gradient(45deg, #3b82f6, #1d4ed8)'
            };

            notification.style.background = backgrounds[type] || backgrounds.info;
            notification.style.color = 'white';

            // Add icon based on type
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

            // Add to document
            document.body.appendChild(notification);

            // Handle close button
            const closeBtn = notification.querySelector('.close');
            closeBtn.addEventListener('click', () => {
                notification.classList.add('animate__fadeOutRight');
                setTimeout(() => notification.remove(), 300);
            });

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.classList.add('animate__fadeOutRight');
                    setTimeout(() => notification.remove(), 300);
                }
            }, 5000);
        }

        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Add smooth scrolling
        document.documentElement.style.scrollBehavior = 'smooth';
    </script>

</body>

</html>