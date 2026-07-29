                                    <?php
if (session_id() == '') {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ogani Admin Dashboard">
    <meta name="theme-color" content="#7fad39">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/icons/favicon.png">
    
    <!-- Title -->
    <title>Dashboard - Ogani Admin</title>
    
    <!-- Bootstrap 5 CSS (CDN Fallback) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Main Dashboard CSS -->
    <link rel="stylesheet" href="assets/main-DAEQKee6.css">
    
    <!-- Custom Dashboard CSS -->
    <link rel="stylesheet" href="assets/custom.css">
    
    <!-- Bootstrap 5 JS Bundle (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Alpine.js (CDN) - loaded after Bootstrap -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    
    <script>
        // Hide loading screen immediately
        (function() {
            var ls = document.getElementById('loading-screen');
            if (ls) { ls.style.display = 'none'; }
        })();
        setTimeout(function() {
            var ls = document.getElementById('loading-screen');
            if (ls) { ls.style.display = 'none'; }
        }, 1500);
    </script>
</head>

<body data-page="dashboard" class="admin-layout">
    <a href="#main-content" class="skip-link">Skip to main content</a>
    
    <!-- Loading Screen -->
    <div id="loading-screen" class="loading-screen" style="display:none;">
        <div class="loading-spinner">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- Main Wrapper -->
    <div class="admin-wrapper" id="admin-wrapper">
        
        <!-- Header -->
        <header class="admin-header">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                <div class="container-fluid">
                    <!-- Logo -->
                    <a class="navbar-brand d-flex align-items-center ms-5" href="index.php">
                        <img src="assets/images/logo.png" alt="Logo" height="32" class="d-inline-block align-text-top me-2">
                    </a>

                    <!-- Sidebar Toggle -->
                    <button class="hamburger-menu" type="button" data-sidebar-toggle="" aria-label="Toggle sidebar">
                        <i class="bi bi-list"></i>
                    </button>

                    <!-- Search Bar -->
                    <div class="search-container flex-grow-1 mx-4" x-data="searchComponent">
                        <div class="position-relative">
                            <input type="search" class="form-control" placeholder="Search... (Ctrl+K)" x-model="query" @input="search()" data-search-input="" aria-label="Search">
                            <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-3"></i>
                            
                            <div x-show="results.length > 0" class="position-absolute top-100 start-0 w-100 bg-white border rounded-2 shadow-lg mt-1 z-3">
                                <template x-for="result in results" :key="result.title">
                                    <a :href="result.url" class="d-block px-3 py-2 text-decoration-none text-dark border-bottom">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-file-text me-2 text-muted"></i>
                                            <span x-text="result.title"></span>
                                            <small class="ms-auto text-muted" x-text="result.type"></small>
                                        </div>
                                    </a>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side Icons -->
                    <div class="navbar-nav flex-row">
                        <!-- Theme Toggle -->
                        <div x-data="themeSwitch">
                            <button class="btn btn-outline-secondary me-2" type="button" @click="toggle()" data-bs-toggle="tooltip" title="Toggle theme">
                                <i class="bi bi-sun-fill" x-show="currentTheme === 'light'"></i>
                                <i class="bi bi-moon-fill" x-show="currentTheme === 'dark'"></i>
                            </button>
                        </div>

                        <!-- Fullscreen Toggle -->
                        <button class="btn btn-outline-secondary me-2 d-none d-lg-inline-block" type="button" data-fullscreen-toggle="" data-bs-toggle="tooltip" title="Toggle fullscreen">
                            <i class="bi bi-arrows-fullscreen icon-hover"></i>
                        </button>

                        <!-- Notifications -->
                        <div class="dropdown me-2">
                            <button class="btn btn-outline-secondary position-relative" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-bell"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><h6 class="dropdown-header">Notifications</h6></li>
                                <li><a class="dropdown-item" href="#">New user registered</a></li>
                                <li><a class="dropdown-item" href="#">Server status update</a></li>
                                <li><a class="dropdown-item" href="#">New message received</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-center" href="#">View all notifications</a></li>
                            </ul>
                        </div>

                        <!-- User Menu -->
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                                <img src="assets/images/avatar-placeholder.svg" alt="User Avatar" width="24" height="24" class="rounded-circle me-2">
                                <span class="d-none d-md-inline">
                                    <?php
                                    if ($_SESSION['role'] == 'admin') {
                                        echo $_SESSION['name'];
                                    } 
                                    
                                    ?>
                                </span>
                                <i class="bi bi-chevron-down ms-1"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Sidebar -->
        <aside class="admin-sidebar" id="admin-sidebar">
            <div class="sidebar-content">
                <nav class="sidebar-nav">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">
                                <i class="bi bi-speedometer2"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="users.php">
                                <i class="bi bi-people"></i>
                                <span>Users</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="category.php">
                                <i class="bi bi-list"></i>
                                <span>Category</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="product.php">
                                <i class="bi bi-box"></i>
                                <span>Product</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="orders.php">
                                <i class="bi bi-bag-check"></i>
                                <span>Orders</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Sidebar Backdrop (mobile overlay) -->
        <div class="sidebar-backdrop" aria-hidden="true"></div>

    <!-- Alpine.js Component Definitions (must be after Alpine loads) -->
    <script>
        document.addEventListener('alpine:init', function() {
            Alpine.data('searchComponent', function() { 
                return {
                    query: '',
                    results: [],
                    isLoading: false,
                    async search() {
                        if (this.query.length < 2) { this.results = []; return; }
                        this.isLoading = true;
                        var self = this;
                        await new Promise(function(r) { setTimeout(r, 300); });
                        self.results = [
                            { title: 'Dashboard', url: 'index.php', type: 'page' },
                            { title: 'Users', url: 'users.php', type: 'page' },
                            { title: 'Categories', url: 'category.php', type: 'page' },
                            { title: 'Products', url: 'product.php', type: 'page' },
                            { title: 'Orders', url: 'orders.php', type: 'page' }
                        ].filter(function(r) { return r.title.toLowerCase().includes(self.query.toLowerCase()); });
                        self.isLoading = false;
                    }
                };
            });

            Alpine.data('themeSwitch', function() {
                return {
                    currentTheme: 'light',
                    init() {
                        this.currentTheme = localStorage.getItem('theme') || 'light';
                        document.documentElement.setAttribute('data-bs-theme', this.currentTheme);
                    },
                    toggle() {
                        this.currentTheme = this.currentTheme === 'light' ? 'dark' : 'light';
                        document.documentElement.setAttribute('data-bs-theme', this.currentTheme);
                        localStorage.setItem('theme', this.currentTheme);
                    }
                };
            });
        });
    </script>

    <!-- Initialize Bootstrap components -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize dropdowns
            var dropdowns = document.querySelectorAll('[data-bs-toggle="dropdown"]');
            dropdowns.forEach(function(el) {
                try { new bootstrap.Dropdown(el); } catch(e) {}
            });
            // Initialize tooltips
            var tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltips.forEach(function(el) {
                try { new bootstrap.Tooltip(el); } catch(e) {}
            });
            
            // Sidebar toggle
            var sidebarToggle = document.querySelector('[data-sidebar-toggle]');
            var sidebar = document.getElementById('admin-sidebar');
            var backdrop = document.querySelector('.sidebar-backdrop');
            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    if (backdrop) backdrop.classList.toggle('show');
                });
            }
            if (backdrop) {
                backdrop.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    backdrop.classList.remove('show');
                });
            }
            
            // Fullscreen toggle
            var fullscreenToggle = document.querySelector('[data-fullscreen-toggle]');
            if (fullscreenToggle) {
                fullscreenToggle.addEventListener('click', function() {
                    if (!document.fullscreenElement) {
                        document.documentElement.requestFullscreen();
                    } else {
                        if (document.exitFullscreen) document.exitFullscreen();
                    }
                });
            }
            
            // Ctrl+K shortcut for search
            document.addEventListener('keydown', function(e) {
                if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                    e.preventDefault();
                    var searchInput = document.querySelector('[data-search-input]');
                    if (searchInput) searchInput.focus();
                }
            });
        });
    </script>
</body>
</html>
