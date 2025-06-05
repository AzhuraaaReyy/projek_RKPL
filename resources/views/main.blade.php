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

    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #ec4899;
            --success: #10b981;
            --warning: #f59e0b;
            --info: #06b6d4;
            --danger: #ef4444;
            --dark: #1e293b;
            --light: #f8fafc;
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-secondary: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            --gradient-success: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            --gradient-info: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);
            --gradient-warning: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            --glass-bg: rgba(255, 255, 255, 0.25);
            --glass-border: rgba(255, 255, 255, 0.18);
            --shadow-light: 0 8px 32px rgba(31, 38, 135, 0.37);
            --shadow-dark: 0 8px 32px rgba(0, 0, 0, 0.1);
            --border-radius: 16px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-attachment: fixed;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Glass morphism effect */
        .glass {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: var(--border-radius);
        }

        /* Sidebar Styling */
        .main-sidebar {
            background: rgba(30, 41, 59, 0.95) !important;
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: var(--shadow-dark);
            transition: var(--transition);
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1037;
        }

        .brand-link {
            background: var(--gradient-primary) !important;
            color: white !important;
            border: none !important;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            text-decoration: none;
        }

        .brand-link::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            transition: var(--transition);
            pointer-events: none;
        }

        .brand-link:hover::before {
            animation: shine 0.8s ease-in-out;
        }

        @keyframes shine {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
            }
        }

        .brand-text {
            font-size: 1.4rem !important;
            font-weight: 800 !important;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .sidebar-toggle-btn {
            background: rgba(255, 255, 255, 0.2) !important;
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
            border-radius: 50% !important;
            width: 36px !important;
            height: 36px !important;
            transition: var(--transition) !important;
            backdrop-filter: blur(10px);
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1000;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-toggle-btn:hover {
            background: rgba(255, 255, 255, 0.3) !important;
            transform: translateY(-50%) scale(1.1) !important;
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
        }

        .sidebar-toggle-btn:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.5);
        }

        /* User Panel */
        .user-panel {
            padding: 1.5rem !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1rem;
        }

        .user-panel .image img {
            border: 3px solid rgba(255, 255, 255, 0.3);
            transition: var(--transition);
            width: 45px;
            height: 45px;
        }

        .user-panel:hover .image img {
            border-color: var(--primary);
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.5);
        }

        .user-panel .info a {
            color: #f1f5f9 !important;
            font-weight: 600;
            font-size: 1rem;
            transition: var(--transition);
        }

        .user-panel .info a:hover {
            color: var(--primary) !important;
            text-decoration: none;
        }

        /* Navigation */
        .nav-sidebar .nav-item .nav-link {
            color: #cbd5e1 !important;
            border-radius: 12px;
            margin: 0.3rem 1rem;
            transition: var(--transition);
            padding: 0.8rem 1rem;
            font-weight: 500;
            position: relative;
        }

        .nav-sidebar .nav-item .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 4px;
            height: 0;
            background: var(--primary);
            border-radius: 0 4px 4px 0;
            transition: var(--transition);
            transform: translateY(-50%);
        }

        .nav-sidebar .nav-item .nav-link:hover {
            background: rgba(99, 102, 241, 0.15) !important;
            color: #ffffff !important;
            transform: translateX(8px);
        }

        .nav-sidebar .nav-item .nav-link:hover::before {
            height: 20px;
        }

        .nav-sidebar .nav-item .nav-link.active {
            background: var(--gradient-primary) !important;
            color: white !important;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
            transform: translateX(8px);
        }

        .nav-sidebar .nav-item .nav-link.active::before {
            height: 20px;
        }

        .nav-icon {
            transition: var(--transition);
            margin-right: 0.75rem !important;
            width: 20px;
            text-align: center;
        }

        .nav-link:hover .nav-icon {
            transform: scale(1.2) rotate(5deg);
        }

        /* Treeview */
        .nav-treeview {
            background: rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            margin: 0.3rem 1rem;
            backdrop-filter: blur(10px);
            display: none;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .nav-item.menu-open .nav-treeview {
            display: block;
        }

        .nav-treeview .nav-link {
            padding-left: 3rem !important;
            font-size: 0.9rem;
            margin: 0.2rem 0.5rem;
        }

        .nav-item.has-treeview .right {
            transition: transform 0.3s ease;
        }

        .nav-item.menu-open .right {
            transform: rotate(-90deg);
        }

        /* Logout Button */
        .sidebar-logout {
            margin-top: auto;
            padding: 1.5rem;
        }

        .sidebar-logout .btn {
            background: linear-gradient(135deg, #ef4444, #dc2626) !important;
            border: none !important;
            border-radius: 25px !important;
            padding: 0.8rem 1.5rem;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
            width: 100%;
        }

        .sidebar-logout .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
            background: linear-gradient(135deg, #dc2626, #b91c1c) !important;
        }

        /* Content Wrapper */
        .content-wrapper {
            margin-left: 250px !important;
            transition: var(--transition) !important;
            background: transparent !important;
            min-height: 100vh;
        }

        body.sidebar-collapse .content-wrapper {
            margin-left: 4.6rem !important;
        }

        /* Sidebar collapse styles */
        body.sidebar-collapse .main-sidebar {
            width: 4.6rem !important;
        }

        body.sidebar-collapse .brand-text {
            display: none;
        }

        body.sidebar-collapse .brand-link {
            padding: 1.5rem 0.75rem !important;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            cursor: pointer;
        }

        body.sidebar-collapse .brand-link:hover {
            background: linear-gradient(135deg, #7c3aed, #8b5cf6) !important;
        }

        body.sidebar-collapse .brand-link::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 4px;
            height: 20px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 2px;
            animation: blink 2s infinite;
        }

        @keyframes blink {

            0%,
            50% {
                opacity: 1;
            }

            51%,
            100% {
                opacity: 0.3;
            }
        }

        body.sidebar-collapse .sidebar-toggle-btn {
            position: absolute !important;
            right: 8px !important;
            left: auto !important;
            transform: translateY(-50%) !important;
            top: 50% !important;
            width: 32px !important;
            height: 32px !important;
            z-index: 999;
            display: flex !important;
            visibility: visible !important;
            opacity: 1 !important;
            background: rgba(255, 255, 255, 0.3) !important;
        }

        body.sidebar-collapse .nav-sidebar .nav-link p {
            display: none;
        }

        body.sidebar-collapse .nav-sidebar .nav-link {
            width: calc(4.6rem - 1rem);
            text-align: center;
            padding: 0.8rem 0;
            margin: 0.3rem 0.5rem;
        }

        body.sidebar-collapse .nav-icon {
            margin-right: 0 !important;
        }

        body.sidebar-collapse .user-panel .info {
            display: none;
        }

        body.sidebar-collapse .user-panel {
            padding: 1rem 0.5rem !important;
            justify-content: center;
        }

        body.sidebar-collapse .sidebar-logout {
            padding: 1rem 0.5rem;
        }

        body.sidebar-collapse .sidebar-logout .btn {
            width: 40px;
            height: 40px;
            padding: 0;
            border-radius: 50% !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body.sidebar-collapse .sidebar-logout .btn i {
            margin-right: 0 !important;
        }

        body.sidebar-collapse .sidebar-logout .btn span {
            display: none;
        }

        body.sidebar-collapse .nav-treeview {
            display: none;
        }

        /* Content Header */
        .content-header {
            background: rgba(255, 255, 255, 0.1) !important;
            backdrop-filter: blur(20px);
            color: white !important;
            border-radius: 0 0 24px 24px !important;
            margin: 0 1rem 2rem 1rem !important;
            padding: 2.5rem !important;
            box-shadow: var(--shadow-light);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .content-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            pointer-events: none;
        }

        .content-header h1 {
            font-size: 2.5rem !important;
            font-weight: 800 !important;
            margin: 0 !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 2;
        }

        .content-header small {
            font-size: 1.1rem;
            opacity: 0.9;
            font-weight: 500;
            position: relative;
            z-index: 2;
        }

        .header-info-box {
            background: rgba(255, 255, 255, 0.2) !important;
            backdrop-filter: blur(15px);
            border-radius: 16px !important;
            padding: 1rem !important;
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: var(--transition);
            position: relative;
            z-index: 2;
        }

        .header-info-box:hover {
            background: rgba(255, 255, 255, 0.25) !important;
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        /* Content */
        .content {
            padding: 0 2rem 2rem 2rem;
        }

        /* Info Boxes */
        .info-box {
            border-radius: 20px !important;
            box-shadow: var(--shadow-light) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            transition: var(--transition) !important;
            overflow: hidden;
            position: relative;
            backdrop-filter: blur(15px);
            margin-bottom: 1.5rem;
        }

        .info-box::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            transition: var(--transition);
            pointer-events: none;
        }

        .info-box:hover::before {
            animation: shine 0.8s ease-in-out;
        }

        .info-box:hover {
            transform: translateY(-8px) !important;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15) !important;
        }

        .info-box-icon {
            border-radius: 20px 0 20px 0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 2.2rem !important;
            width: 100px !important;
            position: relative;
            overflow: hidden;
        }

        .info-box-content {
            padding: 1.5rem !important;
            color: white;
        }

        .info-box-text {
            font-size: 0.9rem !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            opacity: 0.9;
            margin-bottom: 0.5rem;
        }

        .info-box-number {
            font-size: 2rem !important;
            font-weight: 800 !important;
            margin-top: 0.5rem !important;
        }

        .bg-success {
            background: linear-gradient(135deg, #10b981, #059669) !important;
        }

        .bg-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706) !important;
        }

        .bg-info {
            background: linear-gradient(135deg, #06b6d4, #0891b2) !important;
        }

        /* Chart Container */
        .chart-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: var(--shadow-light);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
            margin: 2rem 1rem;
        }

        .chart-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.02));
            pointer-events: none;
        }

        .chart-wrapper {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2rem;
            position: relative;
            z-index: 2;
            backdrop-filter: blur(10px);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        .chart-title {
            color: var(--dark);
            font-weight: 800;
            font-size: 1.6rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .chart-stats {
            position: absolute;
            top: 2.5rem;
            right: 2.5rem;
            background: rgba(255, 255, 255, 0.95);
            padding: 0.8rem 1.2rem;
            border-radius: 25px;
            box-shadow: var(--shadow-light);
            z-index: 3;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .pulse-dot {
            width: 12px;
            height: 12px;
            background: var(--success);
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
                transform: scale(1);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
                transform: scale(1.05);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
                transform: scale(1);
            }
        }

        /* Footer */
        .main-footer {
            background: rgba(255, 255, 255, 0.1) !important;
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255, 255, 255, 0.2) !important;
            color: white !important;
            padding: 1.5rem !important;
            margin: 2rem 1rem 0 1rem;
            border-radius: 20px 20px 0 0;
            font-weight: 500;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .content-wrapper {
                margin-left: 0 !important;
            }

            .main-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            body.sidebar-open .main-sidebar {
                transform: translateX(0);
            }

            body.sidebar-collapse .main-sidebar {
                transform: translateX(-100%);
            }

            .content-header {
                border-radius: 0 !important;
                margin: 0 0 2rem 0 !important;
            }

            .content-header h1 {
                font-size: 2rem !important;
            }

            .content {
                padding: 0 1rem 2rem 1rem;
            }

            .chart-container {
                margin: 2rem 0;
                padding: 1.5rem;
            }

            .chart-stats {
                position: static;
                margin-bottom: 1rem;
                display: inline-block;
                width: auto;
            }

            .info-box .info-box-icon {
                width: 80px !important;
                font-size: 1.8rem !important;
            }

            .main-footer {
                margin: 2rem 0 0 0;
                border-radius: 0;
            }

            /* Mobile menu button */
            .mobile-menu-btn {
                display: block;
                position: fixed;
                top: 1rem;
                left: 1rem;
                z-index: 1050;
                background: var(--gradient-primary);
                border: none;
                border-radius: 50%;
                width: 50px;
                height: 50px;
                color: white;
                font-size: 1.2rem;
                box-shadow: var(--shadow-dark);
                transition: var(--transition);
            }

            .mobile-menu-btn:hover {
                transform: scale(1.1);
                box-shadow: var(--shadow-light);
            }
        }

        @media (min-width: 769px) {
            .mobile-menu-btn {
                display: none;
            }
        }

        /* Scrollbar Styling */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
            transition: var(--transition);
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* Enhanced animations */
        .animate__fadeInDown {
            animation-duration: 0.8s;
        }

        .animate__fadeInUp {
            animation-duration: 0.8s;
        }

        .animate__delay-1s {
            animation-delay: 0.3s;
        }

        /* Loading animation for chart */
        .chart-loading {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 400px;
            font-size: 1.2rem;
            color: var(--text-light);
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(99, 102, 241, 0.3);
            border-top: 4px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 1rem;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Tooltip enhancements */
        .tooltip-inner {
            background: rgba(30, 41, 59, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 8px;
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* Button enhancements */
        .btn {
            font-weight: 600;
            transition: var(--transition);
            border-radius: 12px;
        }

        .btn:hover {
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
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

            <div class="sidebar d-flex flex-column" style="height: calc(100vh - 70px);">
                <!-- User Panel -->
                <div class="user-panel d-flex align-items-center">
                    <div class="image">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6366f1&color=fff&size=128" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info ml-3">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="mt-2" style="flex: 1; overflow-y: auto;">
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

                <!-- Logout Button - Always at bottom -->
                <div class="sidebar-logout mt-auto">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Content Wrapper -->
        @yield('content-header')

        <!-- Footer -->
        <footer class="main-footer text-center">
            <strong>&copy; 2025 Galaxy Bakery</strong> - All rights reserved.
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('produksiChart').getContext('2d');

        // Create enhanced gradient
        const createGradient = (ctx, color1, color2) => {
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, color1);
            gradient.addColorStop(0.7, color2);
            gradient.addColorStop(1, 'rgba(255,255,255,0.1)');
            return gradient;
        };

        // Enhanced data with more realistic production patterns
        let labels = ['09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00'];
        let productionData = [185, 192, 178, 225, 208, 195, 215];
        let targetData = [200, 200, 200, 200, 200, 200, 200];

        const produksiChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Produksi Aktual',
                        data: productionData,
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
                        pointShadowColor: 'rgba(16, 185, 129, 0.5)',
                        pointShadowBlur: 10,
                    },
                    {
                        label: 'Target Produksi',
                        data: targetData,
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
                    }
                ]
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
                    duration: 2500,
                    easing: 'easeInOutCubic',
                    onProgress: function(animation) {
                        const progress = animation.currentStep / animation.numSteps;
                        if (progress > 0.8) {
                            this.data.datasets[0].pointRadius = 7 + Math.sin(Date.now() / 300) * 1.5;
                            this.update('none');
                        }
                    }
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
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        suggestedMin: 150,
                        suggestedMax: 250,
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
                            callback: function(value) {
                                return value + ' pcs';
                            },
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
        });

        // Enhanced real-time date and time updates
        const updateDateTime = () => {
            const now = new Date();

            const timeOptions = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };
            const timeString = now.toLocaleTimeString('id-ID', timeOptions);

            const dateOptions = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const dateString = now.toLocaleDateString('id-ID', dateOptions);

            const timeElement = document.getElementById('currentTime');
            const dateElement = document.getElementById('currentDate');

            if (timeElement) {
                timeElement.textContent = timeString;
                // Add subtle glow effect every minute
                if (now.getSeconds() === 0) {
                    timeElement.style.textShadow = '0 0 10px rgba(99, 102, 241, 0.5)';
                    setTimeout(() => {
                        timeElement.style.textShadow = 'none';
                    }, 1000);
                }
            }
            if (dateElement) dateElement.textContent = dateString;
        };

        updateDateTime();
        setInterval(updateDateTime, 1000);

        // Enhanced chart data updates with more realistic patterns
        let updateCounter = 0;
        const updateChart = () => {
            updateCounter++;

            const now = new Date();
            const hours = now.getHours();
            const minutes = now.getMinutes();
            const timeString = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;

            // More sophisticated production simulation
            const baseProduction = 200;
            const timeOfDayFactor = Math.sin(((hours - 6) / 12) * Math.PI) * 30; // Peak around noon
            const randomVariation = (Math.random() - 0.5) * 40;
            const trendFactor = Math.sin(updateCounter / 15) * 15; // Longer trend cycles

            const newProductionValue = Math.max(150, Math.min(280,
                baseProduction + timeOfDayFactor + randomVariation + trendFactor
            ));

            // Smooth data transition
            produksiChart.data.labels.push(timeString);
            produksiChart.data.labels.shift();

            produksiChart.data.datasets[0].data.push(Math.round(newProductionValue));
            produksiChart.data.datasets[0].data.shift();

            produksiChart.data.datasets[1].data.push(200);
            produksiChart.data.datasets[1].data.shift();

            // Enhanced update animation
            produksiChart.update('active');

            // Special effects every 10 updates
            if (updateCounter % 10 === 0) {
                produksiChart.data.datasets[0].borderWidth = 6;
                produksiChart.data.datasets[0].pointRadius = 9;
                setTimeout(() => {
                    produksiChart.data.datasets[0].borderWidth = 4;
                    produksiChart.data.datasets[0].pointRadius = 7;
                    produksiChart.update('none');
                }, 300);
            }
        };

        // Start updates with variable intervals for more natural feel
        const startEnhancedUpdates = () => {
            const updateInterval = () => {
                updateChart();
                const nextInterval = 3000 + Math.random() * 3000; // 3-6 seconds
                setTimeout(updateInterval, nextInterval);
            };
            setTimeout(updateInterval, 4000);
        };

        startEnhancedUpdates();

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

        // Enhanced info box animations
        document.querySelectorAll('.info-box').forEach(box => {
            box.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });

            box.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Add smooth scrolling
        document.documentElement.style.scrollBehavior = 'smooth';
    </script>

</body>

</html>