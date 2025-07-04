<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Buat Produksi Baru - Galaxy Bakery</title>
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
                                <i class="fas fa-industry mr-3"></i>
                                Buat Produksi Baru
                            </h1>
                            <small>Buat batch produksi baru untuk roti Galaxy Bakery</small>
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
                <!-- Alerts -->
                @if(session('success'))
                <div class="row animate__animated animate__fadeInUp">
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible fade show modern-alert" role="alert">
                            <i class="fas fa-check-circle mr-2"></i>
                            <strong>Berhasil!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                @endif

                @if (session('error'))
                <div class="row animate__animated animate__fadeInUp">
                    <div class="col-12">
                        <div class="alert alert-danger alert-dismissible fade show modern-alert" role="alert">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <strong>Terjadi kesalahan:</strong> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Form Container -->
                <div class="row animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="col-12">
                        <div class="futuristic-form-container">
                            <div class="form-glow-effect"></div>
                            <div class="form-header">
                                <div class="form-header-content">
                                    <div class="form-icon-container">
                                        <i class="fas fa-rocket form-main-icon"></i>
                                    </div>
                                    <div class="form-header-text">
                                        <h2 class="form-title">Form Produksi Baru</h2>
                                        <p class="form-subtitle">Mulai batch produksi dengan teknologi Galaxy Bakery</p>
                                    </div>
                                    <div class="form-status-indicator">
                                        <div class="status-dot"></div>
                                        <span>Real-time</span>
                                    </div>
                                </div>
                            </div>
                            
                            <form action="{{route('karyawan.storeproduksi')}}" method="POST" class="futuristic-form">
                                @csrf

                                <!-- Production Information Section -->
                                <div class="futuristic-section" data-step="1">
                                    <div class="section-header">
                                        <div class="section-number">01</div>
                                        <div class="section-info">
                                            <h4 class="section-title">
                                                <i class="fas fa-info-circle text-primary mr-2"></i>
                                                Informasi Produksi
                                            </h4>
                                            <p class="section-subtitle">Detail dasar untuk batch produksi</p>
                                        </div>
                                        <div class="section-progress">
                                            <div class="progress-ring">
                                                <div class="progress-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="section-content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="futuristic-input-group">
                                                    <div class="input-wrapper">
                                                        <label for="production_date" class="floating-label">
                                                            <i class="fas fa-calendar-alt input-icon"></i>
                                                            Tanggal Produksi
                                                        </label>
                                                        <input type="date" name="production_date" id="production_date" 
                                                               class="futuristic-input @error('production_date') is-invalid @enderror" 
                                                               value="{{ old('production_date', date('Y-m-d')) }}">
                                                        <div class="input-border-effect"></div>
                                                        <div class="input-glow"></div>
                                                        @error('production_date') 
                                                        <div class="futuristic-error">
                                                            <i class="fas fa-exclamation-triangle"></i>
                                                            {{ $message }}
                                                        </div> 
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="futuristic-input-group">
                                                    <div class="input-wrapper">
                                                        <label for="batch_number" class="floating-label">
                                                            <i class="fas fa-barcode input-icon"></i>
                                                            Nomor Batch
                                                        </label>
                                                        <input type="text" name="batch_number" id="batch_number" 
                                                               class="futuristic-input @error('batch_number') is-invalid @enderror" 
                                                               value="{{ old('batch_number') }}" 
                                                               placeholder="BTH-001">
                                                        <button type="button" class="batch-generator-btn" id="generateBatchBtn">
                                                            <i class="fas fa-sync"></i>
                                                        </button>
                                                        <div class="input-border-effect"></div>
                                                        <div class="input-glow"></div>
                                                        @error('batch_number') 
                                                        <div class="futuristic-error">
                                                            <i class="fas fa-exclamation-triangle"></i>
                                                            {{ $message }}
                                                        </div> 
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="futuristic-input-group">
                                                    <div class="input-wrapper">
                                                        <label for="product_type_id" class="floating-label">
                                                            <i class="fas fa-bread-slice input-icon"></i>
                                                            Jenis Produk
                                                        </label>
                                                        <select name="product_type_id" id="product_type_id" 
                                                                class="futuristic-select @error('product_type_id') is-invalid @enderror">
                                                            <option value="">Pilih jenis produk</option>
                                                            @foreach($producType as $type)
                                                            <option value="{{ $type->id }}" {{ old('product_type_id') == $type->id ? 'selected' : '' }}>
                                                                {{ $type->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="select-arrow-modern">
                                                            <i class="fas fa-chevron-down"></i>
                                                        </div>
                                                        <div class="input-border-effect"></div>
                                                        <div class="input-glow"></div>
                                                        @error('product_type_id') 
                                                        <div class="futuristic-error">
                                                            <i class="fas fa-exclamation-triangle"></i>
                                                            {{ $message }}
                                                        </div> 
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="futuristic-input-group">
                                                    <div class="input-wrapper">
                                                        <label for="quantity_produced" class="floating-label">
                                                            <i class="fas fa-sort-numeric-up input-icon"></i>
                                                            Jumlah Produksi
                                                        </label>
                                                        <input type="number" name="quantity_produced" id="quantity_produced" 
                                                               class="futuristic-input @error('quantity_produced') is-invalid @enderror" 
                                                               value="{{ old('quantity_produced') }}" 
                                                               placeholder="100" min="1">
                                                        <div class="input-suffix-modern">pcs</div>
                                                        <div class="input-border-effect"></div>
                                                        <div class="input-glow"></div>
                                                        @error('quantity_produced') 
                                                        <div class="futuristic-error">
                                                            <i class="fas fa-exclamation-triangle"></i>
                                                            {{ $message }}
                                                        </div> 
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Cost and Status Section -->
                                <div class="futuristic-section" data-step="2">
                                    <div class="section-header">
                                        <div class="section-number">02</div>
                                        <div class="section-info">
                                            <h4 class="section-title">
                                                <i class="fas fa-cog text-success mr-2"></i>
                                                Biaya & Status
                                            </h4>
                                            <p class="section-subtitle">Konfigurasi biaya dan status produksi</p>
                                        </div>
                                        <div class="section-progress">
                                            <div class="progress-ring">
                                                <div class="progress-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="section-content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="futuristic-input-group">
                                                    <div class="input-wrapper">
                                                        <label for="production_cost" class="floating-label">
                                                            <i class="fas fa-dollar-sign input-icon"></i>
                                                            Biaya Produksi
                                                        </label>
                                                        <input type="number" step="0.01" name="production_cost" id="production_cost" 
                                                               class="futuristic-input @error('production_cost') is-invalid @enderror" 
                                                               value="{{ old('production_cost', 0) }}" 
                                                               placeholder="750000">
                                                        <div class="input-prefix-modern">Rp</div>
                                                        <button type="button" class="cost-calculator-btn" id="calculateCostBtn">
                                                            <i class="fas fa-calculator"></i>
                                                        </button>
                                                        <div class="input-border-effect"></div>
                                                        <div class="input-glow"></div>
                                                        @error('production_cost') 
                                                        <div class="futuristic-error">
                                                            <i class="fas fa-exclamation-triangle"></i>
                                                            {{ $message }}
                                                        </div> 
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="futuristic-input-group">
                                                    <div class="input-wrapper">
                                                        <label for="status" class="floating-label">
                                                            <i class="fas fa-flag input-icon"></i>
                                                            Status Produksi
                                                        </label>
                                                        <select name="status" id="status" 
                                                                class="futuristic-select @error('status') is-invalid @enderror">
                                                            <option value="planning" {{ old('status') == 'planning' ? 'selected' : '' }}>
                                                                🎯 Perencanaan
                                                            </option>
                                                            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>
                                                                ⚡ Sedang Diproses
                                                            </option>
        
                                                           
                                                        </select>
                                                        <div class="select-arrow-modern">
                                                            <i class="fas fa-chevron-down"></i>
                                                        </div>
                                                        <div class="input-border-effect"></div>
                                                        <div class="input-glow"></div>
                                                        @error('status') 
                                                        <div class="futuristic-error">
                                                            <i class="fas fa-exclamation-triangle"></i>
                                                            {{ $message }}
                                                        </div> 
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="futuristic-input-group">
                                            <div class="input-wrapper">
                                                <label for="notes" class="floating-label">
                                                    <i class="fas fa-sticky-note input-icon"></i>
                                                    Catatan Produksi
                                                </label>
                                                <textarea name="notes" id="notes" 
                                                          class="futuristic-textarea @error('notes') is-invalid @enderror" 
                                                          rows="4" 
                                                          placeholder="Catatan khusus untuk batch produksi ini...">{{ old('notes') }}</textarea>
                                                <div class="input-border-effect"></div>
                                                <div class="input-glow"></div>
                                                @error('notes') 
                                                <div class="futuristic-error">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $message }}
                                                </div> 
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="futuristic-actions">
                                    <div class="actions-bg"></div>
                                    <button type="button" class="btn-futuristic btn-secondary" onclick="window.history.back()">
                                        <div class="btn-content">
                                            <i class="fas fa-arrow-left btn-icon"></i>
                                            <span class="btn-text">Kembali</span>
                                        </div>
                                        <div class="btn-glow-effect"></div>
                                    </button>
                                    <button type="submit" class="btn-futuristic btn-primary btn-submit">
                                        <div class="btn-content">
                                            <i class="fas fa-rocket btn-icon"></i>
                                            <span class="btn-text">Buat Produksi</span>
                                            <div class="btn-loader" style="display: none;">
                                                <i class="fas fa-spinner fa-spin"></i>
                                            </div>
                                        </div>
                                        <div class="btn-glow-effect"></div>
                                        <div class="btn-particles"></div>
                                    </button>
                                </div>
                            </form>
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
        // Enhanced sidebar toggle functionality - Same as dashboard
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.querySelector('[data-widget="pushmenu"]');
            const toggleIcon = document.getElementById('toggleIcon');
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const sidebar = document.querySelector('.main-sidebar');

            function toggleSidebar() {
                const isMobile = window.innerWidth <= 768;

                if (isMobile) {
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
                    document.body.classList.toggle('sidebar-collapse');
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

            if (toggleButton) {
                toggleButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleSidebar();
                });
            }

            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleSidebar();
                });
            }

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

            // Initialize sidebar state based on screen size
            if (window.innerWidth <= 768) {
                document.body.classList.add('sidebar-collapse');
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

                            const height = treeview.scrollHeight;
                            setTimeout(() => {
                                treeview.style.maxHeight = height + 'px';
                            }, 10);

                            if (icon) {
                                icon.style.transform = 'rotate(-90deg)';
                            }
                        } else {
                            treeview.style.maxHeight = '0';

                            setTimeout(() => {
                                treeview.style.display = 'none';
                            }, 300);

                            if (icon) {
                                icon.style.transform = 'rotate(0deg)';
                            }
                        }
                    }
                });
            });
        });

        // Date and Time Display - Same as dashboard
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
            
            const dateElement = document.getElementById('currentDate');
            const timeElement = document.getElementById('currentTime');
            
            if (dateElement) dateElement.textContent = date;
            if (timeElement) timeElement.textContent = time;
        }

        // Update time every second
        setInterval(updateDateTime, 1000);
        updateDateTime(); // Initial call

        // Legacy batch number generator
        function generateBatchNumber() {
            return generateAdvancedBatchNumber();
        }

        // Enhanced form interactions for futuristic design
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize form state
            initializeFuturisticForm();
            
            // Form input animations and floating labels
            const inputs = document.querySelectorAll('.futuristic-input, .futuristic-textarea, .futuristic-select');
            inputs.forEach(input => {
                const wrapper = input.closest('.input-wrapper');
                
                // Check initial state
                if (input.value !== '') {
                    wrapper.classList.add('has-value');
                }

                input.addEventListener('focus', function() {
                    wrapper.classList.add('focused');
                    createInputRipple(wrapper);
                });

                input.addEventListener('blur', function() {
                    wrapper.classList.remove('focused');
                    if (this.value === '') {
                        wrapper.classList.remove('has-value');
                    } else {
                        wrapper.classList.add('has-value');
                    }
                });

                input.addEventListener('input', function() {
                    if (this.value !== '') {
                        wrapper.classList.add('has-value');
                    } else {
                        wrapper.classList.remove('has-value');
                    }
                });
            });

            // Batch number generator
            const generateBatchBtn = document.getElementById('generateBatchBtn');
            if (generateBatchBtn) {
                generateBatchBtn.addEventListener('click', function() {
                    const batchInput = document.getElementById('batch_number');
                    const newBatch = generateAdvancedBatchNumber();
                    
                    // Animate the generation
                    this.style.transform = 'translateY(-50%) rotate(360deg)';
                    setTimeout(() => {
                        batchInput.value = newBatch;
                        batchInput.closest('.input-wrapper').classList.add('has-value');
                        this.style.transform = 'translateY(-50%) rotate(0deg)';
                        showFuturisticNotification('Nomor batch baru telah dibuat! 🚀', 'success');
                        createSuccessParticles(batchInput.closest('.input-wrapper'));
                    }, 300);
                });
            }

            // Cost calculator
            const calculateCostBtn = document.getElementById('calculateCostBtn');
            if (calculateCostBtn) {
                calculateCostBtn.addEventListener('click', function() {
                    const quantityInput = document.getElementById('quantity_produced');
                    const costInput = document.getElementById('production_cost');
                    const productSelect = document.getElementById('product_type_id');
                    
                    if (!quantityInput.value || !productSelect.value) {
                        showFuturisticNotification('Pilih produk dan masukkan jumlah terlebih dahulu! ⚠️', 'warning');
                        return;
                    }

                    // Animate calculator
                    this.style.transform = 'translateY(-50%) scale(1.2)';
                    setTimeout(() => {
                        const estimatedCost = calculateSmartCost(quantityInput.value, productSelect.value);
                        costInput.value = estimatedCost;
                        costInput.closest('.input-wrapper').classList.add('has-value');
                        this.style.transform = 'translateY(-50%) scale(1)';
                        showFuturisticNotification('Biaya produksi telah dihitung! 💡', 'info');
                        createSuccessParticles(costInput.closest('.input-wrapper'));
                    }, 300);
                });
            }

            // Form submission with advanced loading
            const form = document.querySelector('.futuristic-form');
            const submitBtn = document.querySelector('.btn-submit');

            form.addEventListener('submit', function(e) {
                if (!validateFuturisticForm()) {
                    e.preventDefault();
                    return;
                }

                // Advanced loading state
                submitBtn.disabled = true;
                submitBtn.querySelector('.btn-particles').style.animation = 'particles 0.5s ease-in-out infinite';
                submitBtn.querySelector('.btn-loader').style.display = 'inline-block';
                submitBtn.querySelector('.btn-icon:not(.fa-spinner)').style.display = 'none';
                
                // Add launch effect
                setTimeout(() => {
                    showFuturisticNotification('Meluncurkan batch produksi baru... 🚀', 'info');
                    createLaunchEffect(submitBtn);
                }, 100);
            });

            // Auto-generate batch number on page load if empty
            const batchInput = document.getElementById('batch_number');
            if (batchInput && !batchInput.value) {
                setTimeout(() => {
                    batchInput.value = generateAdvancedBatchNumber();
                    batchInput.closest('.input-wrapper').classList.add('has-value');
                    createSuccessParticles(batchInput.closest('.input-wrapper'));
                }, 1000);
            }

            // Real-time cost estimation
            const quantityInput = document.getElementById('quantity_produced');
            if (quantityInput) {
                quantityInput.addEventListener('input', debounce(function() {
                    const costInput = document.getElementById('production_cost');
                    const productSelect = document.getElementById('product_type_id');
                    
                    if (this.value && productSelect.value && !costInput.value) {
                        const estimatedCost = calculateSmartCost(this.value, productSelect.value);
                        costInput.value = estimatedCost;
                        costInput.closest('.input-wrapper').classList.add('has-value');
                        showFuturisticNotification('Biaya otomatis dihitung berdasarkan kuantitas 📊', 'info');
                    }
                }, 500));
            }

            // Section progress animations
            animateSectionProgress();
        });

        // Helper Functions
        function initializeFuturisticForm() {
            // Add space theme background sounds (optional)
            // playAmbientSound();
            
            // Initialize floating labels for pre-filled inputs
            document.querySelectorAll('.futuristic-input, .futuristic-textarea, .futuristic-select').forEach(input => {
                if (input.value) {
                    input.closest('.input-wrapper').classList.add('has-value');
                }
            });
        }

        function generateAdvancedBatchNumber() {
            const date = new Date();
            const year = date.getFullYear().toString().substr(-2);
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            const hour = String(date.getHours()).padStart(2, '0');
            const minute = String(date.getMinutes()).padStart(2, '0');
            
            return `BTH-${year}${month}${day}-${hour}${minute}`;
        }

        function calculateSmartCost(quantity, productType) {
            // Smart cost calculation based on product type
            const baseCosts = {
                '1': 4500, // Roti Tawar
                '2': 5500, // Roti Manis  
                '3': 6000, // Roti Burger
                'default': 5000
            };
            
            const baseCost = baseCosts[productType] || baseCosts.default;
            const totalCost = quantity * baseCost;
            
            // Add complexity bonus for large batches
            const complexityMultiplier = quantity > 200 ? 1.1 : quantity > 100 ? 1.05 : 1;
            
            return Math.round(totalCost * complexityMultiplier);
        }

        function validateFuturisticForm() {
            const requiredFields = [
                { id: 'product_type_id', message: 'Pilih jenis produk terlebih dahulu! 🍞' },
                { id: 'quantity_produced', message: 'Masukkan jumlah produksi! 📊', min: 1 },
                { id: 'production_date', message: 'Tentukan tanggal produksi! 📅' },
                { id: 'batch_number', message: 'Nomor batch diperlukan! 🏷️' }
            ];

            for (let field of requiredFields) {
                const input = document.getElementById(field.id);
                if (!input.value) {
                    showFuturisticNotification(field.message, 'warning');
                    input.focus();
                    input.closest('.input-wrapper').classList.add('focused');
                    shakeElement(input.closest('.input-wrapper'));
                    return false;
                }
                
                if (field.min && input.value < field.min) {
                    showFuturisticNotification(`${field.message} (minimum: ${field.min})`, 'warning');
                    input.focus();
                    shakeElement(input.closest('.input-wrapper'));
                    return false;
                }
            }
            
            return true;
        }

        function createInputRipple(wrapper) {
            const ripple = document.createElement('div');
            ripple.style.cssText = `
                position: absolute;
                top: 50%;
                left: 50%;
                width: 0;
                height: 0;
                background: radial-gradient(circle, rgba(102, 126, 234, 0.3) 0%, transparent 70%);
                border-radius: 50%;
                transform: translate(-50%, -50%);
                animation: ripple-expand 0.6s ease-out;
                pointer-events: none;
                z-index: 1;
            `;
            
            wrapper.appendChild(ripple);
            
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple-expand {
                    0% { width: 0; height: 0; opacity: 1; }
                    100% { width: 200px; height: 200px; opacity: 0; }
                }
            `;
            document.head.appendChild(style);
            
            setTimeout(() => {
                ripple.remove();
                style.remove();
            }, 600);
        }

        function createSuccessParticles(element) {
            for (let i = 0; i < 8; i++) {
                const particle = document.createElement('div');
                particle.style.cssText = `
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    width: 4px;
                    height: 4px;
                    background: #10b981;
                    border-radius: 50%;
                    pointer-events: none;
                    z-index: 100;
                    animation: particle-burst-${i} 1s ease-out forwards;
                `;
                
                element.appendChild(particle);
                
                const style = document.createElement('style');
                style.textContent = `
                    @keyframes particle-burst-${i} {
                        0% {
                            transform: translate(-50%, -50%) scale(0);
                            opacity: 1;
                        }
                        100% {
                            transform: translate(-50%, -50%) translate(${(Math.random() - 0.5) * 100}px, ${(Math.random() - 0.5) * 100}px) scale(1);
                            opacity: 0;
                        }
                    }
                `;
                document.head.appendChild(style);
                
                setTimeout(() => {
                    particle.remove();
                    style.remove();
                }, 1000);
            }
        }

        function createLaunchEffect(button) {
            const rocket = document.createElement('div');
            rocket.innerHTML = '🚀';
            rocket.style.cssText = `
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 2rem;
                z-index: 1000;
                animation: rocket-launch 2s ease-out forwards;
                pointer-events: none;
            `;
            
            button.appendChild(rocket);
            
            const style = document.createElement('style');
            style.textContent = `
                @keyframes rocket-launch {
                    0% {
                        transform: translate(-50%, -50%) scale(1) rotate(0deg);
                        opacity: 1;
                    }
                    100% {
                        transform: translate(-50%, -200px) scale(0.5) rotate(45deg);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
            
            setTimeout(() => {
                rocket.remove();
                style.remove();
            }, 2000);
        }

        function shakeElement(element) {
            element.style.animation = 'shake 0.5s ease-in-out';
            
            const style = document.createElement('style');
            style.textContent = `
                @keyframes shake {
                    0%, 100% { transform: translateX(0); }
                    25% { transform: translateX(-10px); }
                    75% { transform: translateX(10px); }
                }
            `;
            document.head.appendChild(style);
            
            setTimeout(() => {
                element.style.animation = '';
                style.remove();
            }, 500);
        }

        function animateSectionProgress() {
            const sections = document.querySelectorAll('.futuristic-section');
            sections.forEach((section, index) => {
                const progressCircle = section.querySelector('.progress-ring');
                if (progressCircle) {
                    progressCircle.style.animationDelay = `${index * 0.5}s`;
                }
            });
        }

        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Enhanced futuristic notification system
        function showFuturisticNotification(message, type = 'info') {
            const existingNotifications = document.querySelectorAll('.futuristic-notification');
            existingNotifications.forEach(notification => notification.remove());
            
            const notification = document.createElement('div');
            notification.className = `futuristic-notification animate__animated animate__fadeInRight`;
            
            const typeConfig = {
                success: { 
                    bg: 'linear-gradient(45deg, #10b981, #059669)', 
                    icon: '🚀',
                    glow: '0 0 30px rgba(16, 185, 129, 0.5)'
                },
                warning: { 
                    bg: 'linear-gradient(45deg, #f59e0b, #d97706)', 
                    icon: '⚠️',
                    glow: '0 0 30px rgba(245, 158, 11, 0.5)'
                },
                danger: { 
                    bg: 'linear-gradient(45deg, #ef4444, #dc2626)', 
                    icon: '❌',
                    glow: '0 0 30px rgba(239, 68, 68, 0.5)'
                },
                info: { 
                    bg: 'linear-gradient(45deg, #3b82f6, #1d4ed8)', 
                    icon: '💡',
                    glow: '0 0 30px rgba(59, 130, 246, 0.5)'
                }
            };
            
            const config = typeConfig[type] || typeConfig.info;
            
            notification.style.cssText = `
                position: fixed;
                top: 30px;
                right: 30px;
                z-index: 10000;
                min-width: 350px;
                background: ${config.bg};
                color: white;
                padding: 20px 25px;
                border-radius: 15px;
                font-weight: 600;
                font-size: 0.95rem;
                box-shadow: ${config.glow}, 0 10px 30px rgba(0,0,0,0.2);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                transform: translateX(100%);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            `;
            
            notification.innerHTML = `
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center;">
                        <span style="font-size: 1.3rem; margin-right: 12px;">${config.icon}</span>
                        <span>${message}</span>
                    </div>
                    <button type="button" class="futuristic-close" style="
                        background: rgba(255, 255, 255, 0.2);
                        border: none;
                        color: white;
                        border-radius: 50%;
                        width: 25px;
                        height: 25px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        margin-left: 15px;
                    ">×</button>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Slide in
            requestAnimationFrame(() => {
                notification.style.transform = 'translateX(0)';
            });
            
            // Close button
            const closeBtn = notification.querySelector('.futuristic-close');
            closeBtn.addEventListener('click', () => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => notification.remove(), 400);
            });
            
            closeBtn.addEventListener('mouseenter', () => {
                closeBtn.style.background = 'rgba(255, 255, 255, 0.3)';
                closeBtn.style.transform = 'scale(1.1)';
            });
            
            closeBtn.addEventListener('mouseleave', () => {
                closeBtn.style.background = 'rgba(255, 255, 255, 0.2)';
                closeBtn.style.transform = 'scale(1)';
            });
            
            // Auto remove
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.style.transform = 'translateX(100%)';
                    setTimeout(() => notification.remove(), 400);
                }
            }, 5000);
        }

        // Notification system (legacy support)
        function showNotification(message, type = 'info') {
            showFuturisticNotification(message, type);
        }

        // CSS for futuristic form styling
        const style = document.createElement('style');
        style.textContent = `
            /* Futuristic Form Container */
            .futuristic-form-container {
                position: relative;
                background: linear-gradient(145deg, #0f0f23, #1a1a2e);
                border-radius: 30px;
                overflow: hidden;
                box-shadow: 
                    0 25px 50px rgba(0, 0, 0, 0.25),
                    inset 0 1px 0 rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }

            .form-glow-effect {
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: conic-gradient(from 0deg, transparent, #667eea, #764ba2, transparent);
                animation: rotate 20s linear infinite;
                opacity: 0.3;
                z-index: -1;
            }

            @keyframes rotate {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            /* Form Header */
            .form-header {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                padding: 40px;
                position: relative;
                overflow: hidden;
            }

            .form-header::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="80" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="40" cy="60" r="0.5" fill="rgba(255,255,255,0.08)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
                opacity: 0.3;
            }

            .form-header-content {
                display: flex;
                align-items: center;
                justify-content: space-between;
                position: relative;
                z-index: 2;
            }

            .form-icon-container {
                width: 80px;
                height: 80px;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }

            .form-main-icon {
                font-size: 2.5rem;
                color: white;
                animation: pulse-glow 3s ease-in-out infinite;
            }

            @keyframes pulse-glow {
                0%, 100% { 
                    transform: scale(1); 
                    filter: drop-shadow(0 0 10px rgba(255,255,255,0.5));
                }
                50% { 
                    transform: scale(1.1); 
                    filter: drop-shadow(0 0 20px rgba(255,255,255,0.8));
                }
            }

            .form-header-text {
                flex: 1;
                margin-left: 30px;
            }

            .form-title {
                font-size: 2.5rem;
                font-weight: 800;
                color: white;
                margin: 0;
                text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
                letter-spacing: -0.5px;
            }

            .form-subtitle {
                font-size: 1.1rem;
                color: rgba(255, 255, 255, 0.8);
                margin: 8px 0 0 0;
                font-weight: 400;
            }

            .form-status-indicator {
                display: flex;
                align-items: center;
                background: rgba(255, 255, 255, 0.15);
                padding: 12px 20px;
                border-radius: 25px;
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .status-dot {
                width: 12px;
                height: 12px;
                background: #10b981;
                border-radius: 50%;
                margin-right: 10px;
                animation: pulse-dot 2s ease-in-out infinite;
                box-shadow: 0 0 10px #10b981;
            }

            @keyframes pulse-dot {
                0%, 100% { opacity: 1; transform: scale(1); }
                50% { opacity: 0.7; transform: scale(1.2); }
            }

            .form-status-indicator span {
                color: white;
                font-weight: 600;
                font-size: 0.9rem;
            }

            /* Futuristic Form */
            .futuristic-form {
                padding: 50px;
                background: linear-gradient(145deg, #16213e 0%, #0f3460 100%);
                position: relative;
            }

            /* Futuristic Sections */
            .futuristic-section {
                margin-bottom: 50px;
                background: rgba(255, 255, 255, 0.03);
                border-radius: 25px;
                border: 1px solid rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(20px);
                overflow: hidden;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .futuristic-section:hover {
                background: rgba(255, 255, 255, 0.05);
                border-color: rgba(102, 126, 234, 0.3);
                box-shadow: 0 20px 40px rgba(102, 126, 234, 0.1);
                transform: translateY(-5px);
            }

            .section-header {
                display: flex;
                align-items: center;
                padding: 30px;
                background: linear-gradient(90deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .section-number {
                width: 60px;
                height: 60px;
                background: linear-gradient(45deg, #667eea, #764ba2);
                color: white;
                border-radius: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                font-weight: 800;
                margin-right: 25px;
                box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
                position: relative;
                overflow: hidden;
            }

            .section-number::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
                animation: shimmer 3s ease-in-out infinite;
            }

            @keyframes shimmer {
                0% { left: -100%; }
                50%, 100% { left: 100%; }
            }

            .section-info {
                flex: 1;
            }

            .section-title {
                font-size: 1.4rem;
                font-weight: 700;
                color: white;
                margin: 0 0 8px 0;
                text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
            }

            .section-subtitle {
                color: rgba(255, 255, 255, 0.7);
                margin: 0;
                font-size: 0.95rem;
            }

            .section-progress {
                width: 50px;
                height: 50px;
                position: relative;
            }

            .progress-ring {
                width: 100%;
                height: 100%;
                border-radius: 50%;
                background: conic-gradient(from 0deg, #667eea, #764ba2, #667eea);
                padding: 3px;
                animation: rotate 4s linear infinite;
            }

            .progress-circle {
                width: 100%;
                height: 100%;
                background: #16213e;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .section-content {
                padding: 40px 30px;
            }

            /* Futuristic Input Groups */
            .futuristic-input-group {
                margin-bottom: 35px;
            }

            .input-wrapper {
                position: relative;
                background: rgba(255, 255, 255, 0.05);
                border-radius: 15px;
                border: 2px solid rgba(255, 255, 255, 0.1);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                overflow: hidden;
            }

            .input-wrapper:hover {
                border-color: rgba(102, 126, 234, 0.3);
                background: rgba(255, 255, 255, 0.08);
            }

            .input-wrapper.focused {
                border-color: #667eea;
                background: rgba(102, 126, 234, 0.1);
                box-shadow: 0 0 30px rgba(102, 126, 234, 0.2);
            }

            .floating-label {
                position: absolute;
                top: 50%;
                left: 20px;
                transform: translateY(-50%);
                color: rgba(255, 255, 255, 0.6);
                font-weight: 600;
                font-size: 1rem;
                pointer-events: none;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                display: flex;
                align-items: center;
                z-index: 5;
            }

            .input-wrapper.focused .floating-label,
            .input-wrapper.has-value .floating-label {
                top: 15px;
                font-size: 0.75rem;
                color: #667eea;
                transform: translateY(0);
            }

            .input-icon {
                margin-right: 8px;
                font-size: 0.9em;
            }

            .futuristic-input, .futuristic-textarea, .futuristic-select {
                width: 100%;
                background: transparent;
                border: none;
                padding: 25px 20px 15px 20px;
                color: white;
                font-size: 1.1rem;
                font-weight: 500;
                outline: none;
                resize: none;
                font-family: 'Inter', sans-serif;
            }

            .futuristic-input::placeholder,
            .futuristic-textarea::placeholder {
                color: rgba(255, 255, 255, 0.3);
                font-weight: 400;
            }

            .futuristic-textarea {
                min-height: 120px;
                padding-top: 30px;
            }

            .futuristic-select {
                cursor: pointer;
                appearance: none;
                padding-right: 50px;
            }

            .futuristic-select option {
                background: #16213e;
                color: white;
                padding: 10px;
            }

            /* Input Prefix/Suffix */
            .input-prefix-modern, .input-suffix-modern {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                color: rgba(255, 255, 255, 0.6);
                font-weight: 600;
                font-size: 1rem;
                z-index: 5;
            }

            .input-prefix-modern {
                left: 20px;
            }

            .input-suffix-modern {
                right: 20px;
            }

            .input-wrapper:has(.input-prefix-modern) .futuristic-input {
                padding-left: 60px;
            }

            .input-wrapper:has(.input-suffix-modern) .futuristic-input {
                padding-right: 60px;
            }

            .input-wrapper:has(.input-prefix-modern) .floating-label {
                left: 60px;
            }

            /* Select Arrow */
            .select-arrow-modern {
                position: absolute;
                right: 20px;
                top: 50%;
                transform: translateY(-50%);
                color: rgba(255, 255, 255, 0.6);
                pointer-events: none;
                transition: all 0.3s ease;
                z-index: 5;
            }

            .input-wrapper.focused .select-arrow-modern {
                color: #667eea;
                transform: translateY(-50%) rotate(180deg);
            }

            /* Special Buttons */
            .batch-generator-btn, .cost-calculator-btn {
                position: absolute;
                right: 15px;
                top: 50%;
                transform: translateY(-50%);
                background: linear-gradient(45deg, #667eea, #764ba2);
                border: none;
                border-radius: 10px;
                width: 35px;
                height: 35px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                cursor: pointer;
                transition: all 0.3s ease;
                z-index: 10;
            }

            .batch-generator-btn:hover, .cost-calculator-btn:hover {
                background: linear-gradient(45deg, #5a67d8, #553c9a);
                transform: translateY(-50%) scale(1.1);
                box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            }

            .batch-generator-btn i, .cost-calculator-btn i {
                font-size: 0.9rem;
            }

            /* Input Effects */
            .input-border-effect {
                position: absolute;
                bottom: 0;
                left: 50%;
                width: 0;
                height: 2px;
                background: linear-gradient(90deg, #667eea, #764ba2);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                transform: translateX(-50%);
            }

            .input-wrapper.focused .input-border-effect {
                width: 100%;
            }

            .input-glow {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                border-radius: 15px;
                opacity: 0;
                background: linear-gradient(45deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
                transition: opacity 0.3s ease;
                pointer-events: none;
            }

            .input-wrapper.focused .input-glow {
                opacity: 1;
            }

            /* Error Styling */
            .futuristic-error {
                display: flex;
                align-items: center;
                color: #ef4444;
                font-size: 0.85rem;
                margin-top: 10px;
                padding: 8px 15px;
                background: rgba(239, 68, 68, 0.1);
                border-radius: 8px;
                border-left: 3px solid #ef4444;
            }

            .futuristic-error i {
                margin-right: 8px;
            }

            .is-invalid {
                border-color: #ef4444 !important;
            }

            .is-invalid:focus {
                box-shadow: 0 0 20px rgba(239, 68, 68, 0.2) !important;
            }

            /* Futuristic Actions */
            .futuristic-actions {
                position: relative;
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 60px;
                padding: 40px;
                background: rgba(255, 255, 255, 0.03);
                border-radius: 25px;
                border: 1px solid rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(20px);
            }

            .actions-bg {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(45deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
                border-radius: 25px;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .futuristic-actions:hover .actions-bg {
                opacity: 1;
            }

            /* Futuristic Buttons */
            .btn-futuristic {
                position: relative;
                padding: 18px 35px;
                border: none;
                border-radius: 15px;
                font-weight: 700;
                font-size: 1.1rem;
                cursor: pointer;
                overflow: hidden;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                z-index: 2;
                backdrop-filter: blur(10px);
            }

            .btn-futuristic.btn-secondary {
                background: linear-gradient(45deg, #6b7280, #4b5563);
                color: white;
                border: 2px solid rgba(255, 255, 255, 0.1);
            }

            .btn-futuristic.btn-primary {
                background: linear-gradient(45deg, #667eea, #764ba2);
                color: white;
                border: 2px solid rgba(102, 126, 234, 0.3);
                box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            }

            .btn-futuristic:hover {
                transform: translateY(-5px) scale(1.05);
            }

            .btn-futuristic.btn-secondary:hover {
                background: linear-gradient(45deg, #4b5563, #374151);
                box-shadow: 0 15px 35px rgba(107, 114, 128, 0.3);
            }

            .btn-futuristic.btn-primary:hover {
                background: linear-gradient(45deg, #5a67d8, #553c9a);
                box-shadow: 0 20px 40px rgba(102, 126, 234, 0.4);
            }

            .btn-content {
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                z-index: 2;
            }

            .btn-icon {
                margin-right: 10px;
                font-size: 1.1em;
            }

            .btn-text {
                font-weight: 700;
            }

            .btn-loader {
                margin-left: 10px;
            }

            .btn-glow-effect {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(45deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.2));
                border-radius: 15px;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .btn-futuristic:hover .btn-glow-effect {
                opacity: 1;
            }

            .btn-particles {
                position: absolute;
                top: 50%;
                left: 50%;
                width: 100px;
                height: 100px;
                transform: translate(-50%, -50%);
                background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
                background-size: 10px 10px;
                opacity: 0;
                animation: particles 2s ease-in-out infinite;
            }

            @keyframes particles {
                0%, 100% { 
                    opacity: 0; 
                    transform: translate(-50%, -50%) scale(0.5);
                }
                50% { 
                    opacity: 1; 
                    transform: translate(-50%, -50%) scale(1.5);
                }
            }

            .btn-futuristic.btn-primary:hover .btn-particles {
                animation-play-state: running;
            }

            /* Modern Alerts */
            .modern-alert {
                border-radius: 15px;
                border: none;
                background: linear-gradient(45deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1));
                box-shadow: 0 10px 25px rgba(0,0,0,0.1);
                margin-bottom: 30px;
                backdrop-filter: blur(10px);
                border: 1px solid rgba(16, 185, 129, 0.2);
            }

            .alert-danger.modern-alert {
                background: linear-gradient(45deg, rgba(239, 68, 68, 0.1), rgba(220, 38, 38, 0.1));
                border-color: rgba(239, 68, 68, 0.2);
            }

            /* Mobile Responsive */
            @media (max-width: 768px) {
                .futuristic-form {
                    padding: 30px 20px;
                }
                
                .form-header {
                    padding: 30px 20px;
                }

                .form-header-content {
                    flex-direction: column;
                    text-align: center;
                    gap: 20px;
                }

                .form-header-text {
                    margin-left: 0;
                }

                .form-title {
                    font-size: 2rem;
                }
                
                .section-content {
                    padding: 30px 20px;
                }

                .section-header {
                    padding: 25px 20px;
                }

                .section-number {
                    width: 50px;
                    height: 50px;
                    font-size: 1.2rem;
                    margin-right: 15px;
                }
                
                .futuristic-actions {
                    flex-direction: column;
                    gap: 20px;
                    padding: 30px 20px;
                }
                
                .btn-futuristic {
                    width: 100%;
                    padding: 20px;
                }

                .input-prefix-modern, .input-suffix-modern {
                    font-size: 0.9rem;
                }
            }

            /* Dark theme scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
            }

            ::-webkit-scrollbar-track {
                background: rgba(255, 255, 255, 0.05);
                border-radius: 4px;
            }

            ::-webkit-scrollbar-thumb {
                background: linear-gradient(45deg, #667eea, #764ba2);
                border-radius: 4px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: linear-gradient(45deg, #5a67d8, #553c9a);
            }
        `;
        document.head.appendChild(style);

        // Initialize tooltips if Bootstrap tooltips are available
        if (typeof $().tooltip === 'function') {
            $('[data-toggle="tooltip"], [title]').tooltip({
                placement: 'top',
                trigger: 'hover'
            });
        }
    </script>
</body>
</html>