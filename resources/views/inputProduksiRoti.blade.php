<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Input Produksi Roti - Galaxy Bakery</title>
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

       @include('sidebar')

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header animate__animated animate__fadeInDown">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">
                            <h1>
                                <i class="fas fa-bread-slice mr-3"></i>
                                Input Produksi Roti
                            </h1>
                            <small>Kelola produksi roti harian Galaxy Bakery</small>
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
                <!-- Action Buttons -->
                <div class="row animate__animated animate__fadeInUp">
                    <div class="col-lg-6 col-md-12">
                        <div class="action-card">
                            <a href="/form-produk" class="action-btn btn-add-product">
                                <div class="action-icon">
                                    <i class="fas fa-plus-circle"></i>
                                </div>
                                <div class="action-content">
                                    <h4>Tambah Produk Roti</h4>
                                    <p>Daftarkan jenis roti baru</p>
                                </div>
                                <div class="action-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="action-card">
                            <a href="/form-produksi" class="action-btn btn-add-production">
                                <div class="action-icon">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                <div class="action-content">
                                    <h4>Tambah Produksi</h4>
                                    <p>Buat batch produksi baru</p>
                                </div>
                                <div class="action-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Production Table -->
                <div class="row animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="col-12">
                        <div class="data-container">
                            <div class="data-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3>
                                            <i class="fas fa-list-alt mr-3"></i>
                                            Detail Produksi
                                        </h3>
                                        <small>Daftar semua produksi roti hari ini</small>
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
                                            <th width="12%">Nama Produk</th>
                                            <th width="10%">Jumlah Produksi</th>
                                            <th width="8%">Nomor Batch</th>
                                            <th width="10%">Tanggal Produksi</th>
                                            <th width="12%">Biaya Produksi</th>
                                            <th width="15%">Bahan Baku</th>
                                            <th width="10%">Catatan</th>
                                            <th width="8%">Status</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Sample Data Row 1 -->
                                        @forelse ($productions as $index => $product)
                                        <tr>

                                            <td class="text-center font-weight-bold">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-bread-slice text-warning mr-2"></i>
                                                    <strong>{{ $product->productType->name ?? '-' }}</strong>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-info">{{ $product->quantity_produced }}</span>
                                            </td>
                                            <td class="text-center">
                                                <code>{{ $product->batch_number }}</code>
                                            </td>
                                            <td class="text-center">{{ $product->production_date->format('d-m-Y') }}</td>
                                            <td class="text-right">
                                                <strong class="text-success">Rp{{ number_format($product->production_cost, 2, ',', '.') }}</strong>
                                            </td>
                                            <td class="ingredient-list">
                                                <ul class="list-unstyled mb-0">
                                                    @php
                                                    $warnaIkon = ['text-warning', 'text-info', 'text-danger', 'text-success', 'text-primary'];
                                                    @endphp

                                                    @foreach ($product->productType->bahanBaku as $index => $bahan)
                                                    <li>
                                                        <i class="fas fa-circle {{ $warnaIkon[$index % count($warnaIkon)] }}" style="font-size: 0.4rem;"></i>
                                                        {{ $bahan->nama }} - {{ $bahan->pivot->quantity_per_unit * $product->quantity_produced }} {{ $bahan->satuan }}
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td class="text-center">{{$product->notes}}</td>
                                            <td class="text-center">
                                                <span class="badge bg-{{ $product->status_class }}">
                                                    {{ $product->status }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @if($product->getRawOriginal('status') === 'in_progress')
                                                <form action="{{ route('productions.update', $product->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="btn-group" role="group">
                                                        <button type="submit" name="action" value="completed" class="btn btn-sm btn-success"
                                                            onclick="return confirm('Tandai sebagai Completed?')">
                                                            ✅ Selesai
                                                        </button>
                                                        <button type="submit" name="action" value="cancelled" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Batalkan Produksi?')">
                                                            ❌ Batalkan
                                                        </button>
                                                    </div>
                                                </form>

                                                @else
                                                @if($product->status === 'completed')
                                                <span class="text-success fs-4" title="Selesai">✅</span>
                                                @elseif($product->status === 'cancelled')
                                                <span class="text-danger fs-4" title="Dibatalkan">❌</span>
                                                @endif
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10" class="text-center text-muted">Data bahan baku belum tersedia.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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

        // Enhanced table interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Handle action buttons
            const actionButtons = document.querySelectorAll('.btn-action');
            actionButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const isCompleteButton = this.classList.contains('btn-success');
                    const isCancelButton = this.classList.contains('btn-danger');

                    if (isCompleteButton) {
                        handleCompleteProduction(this);
                    } else if (isCancelButton) {
                        handleCancelProduction(this);
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

        // Handle production completion
        function handleCompleteProduction(button) {
            const confirmed = confirm('Apakah Anda yakin ingin menandai produksi ini sebagai selesai?');
            if (confirmed) {
                const row = button.closest('tr');
                const statusBadge = row.querySelector('.badge');
                const actionCell = row.querySelector('td:last-child');

                // Update status badge
                statusBadge.className = 'badge bg-success';
                statusBadge.textContent = 'Completed';

                // Replace action buttons with success icon
                actionCell.innerHTML = '<span class="status-icon text-success" title="Selesai">✅</span>';

                // Add success animation
                row.classList.add('animate__animated', 'animate__pulse');

                // Show success message
                showNotification('Produksi berhasil diselesaikan!', 'success');

                setTimeout(() => {
                    row.classList.remove('animate__animated', 'animate__pulse');
                }, 1000);
            }
        }

        // Handle production cancellation
        function handleCancelProduction(button) {
            const confirmed = confirm('Apakah Anda yakin ingin membatalkan produksi ini?');
            if (confirmed) {
                const row = button.closest('tr');
                const statusBadge = row.querySelector('.badge');
                const actionCell = row.querySelector('td:last-child');

                // Update status badge
                statusBadge.className = 'badge bg-danger';
                statusBadge.textContent = 'Cancelled';

                // Replace action buttons with cancel icon
                actionCell.innerHTML = '<span class="status-icon text-danger" title="Dibatalkan">❌</span>';

                // Add fade animation
                row.style.opacity = '0.6';
                row.classList.add('animate__animated', 'animate__fadeOut');

                // Show warning message
                showNotification('Produksi dibatalkan!', 'warning');

                setTimeout(() => {
                    row.classList.remove('animate__animated', 'animate__fadeOut');
                    row.style.opacity = '0.6';
                }, 1000);
            }
        }

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


        function handleActionConfirm(event) {
            const clickedButton = event.submitter;
            const message = clickedButton.getAttribute('data-message');
            if (!confirm(message)) {
                event.preventDefault();
                return false;
            }
            return true;
        }
    </script>

</body>

</html>