<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Wanderlust Travel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #2A6B84;
            --primary-dark: #1E556B;
            --secondary: #F8B400;
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
            --light: #F8F9FA;
            --dark: #1F2937;
            --border: #E5E7EB;
            --sidebar-width: 280px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #F9FAFB;
            color: var(--dark);
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-logo {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-logo i {
            font-size: 20px;
            color: white;
        }

        .sidebar-title {
            font-size: 18px;
            font-weight: 700;
        }

        .sidebar-subtitle {
            font-size: 12px;
            opacity: 0.8;
        }

        .sidebar-nav {
            padding: 20px 0;
        }

        .nav-item {
            margin-bottom: 4px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 14px 24px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: var(--secondary);
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border-left-color: var(--secondary);
        }

        .nav-icon {
            width: 20px;
            margin-right: 12px;
            font-size: 16px;
        }

        .nav-text {
            font-weight: 500;
        }

        .nav-badge {
            margin-left: auto;
            background: var(--secondary);
            color: var(--dark);
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }

        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .topbar {
            background: white;
            border-bottom: 1px solid var(--border);
            padding: 16px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .page-title h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .page-title p {
            color: #6B7280;
            font-size: 14px;
            margin: 0;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .user-menu:hover {
            background: var(--light);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .user-info {
            line-height: 1.4;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
        }

        .user-role {
            font-size: 12px;
            color: #6B7280;
        }

        /* Content Area */
        .content-area {
            padding: 30px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--border);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .stat-header {
            display: flex;
            justify-content: between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .stat-icon.primary { background: rgba(42, 107, 132, 0.1); color: var(--primary); }
        .stat-icon.success { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .stat-icon.warning { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
        .stat-icon.danger { background: rgba(239, 68, 68, 0.1); color: var(--danger); }

        .stat-trend {
            margin-left: auto;
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .stat-trend.positive { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .stat-trend.negative { background: rgba(239, 68, 68, 0.1); color: var(--danger); }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--dark);
            line-height: 1;
            margin-bottom: 8px;
        }

        .stat-label {
            color: #6B7280;
            font-size: 14px;
            font-weight: 500;
        }

        /* Content Cards */
        .content-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--border);
            margin-bottom: 24px;
            overflow: hidden;
        }

        .card-header {
            padding: 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark);
            margin: 0;
        }

        .card-body {
            padding: 24px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            border: 2px solid var(--border);
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(42, 107, 132, 0.1);
        }

        .btn {
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            box-shadow: 0 4px 15px rgba(42, 107, 132, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(42, 107, 132, 0.4);
        }

        /* Alert Styles */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            border-left: 4px solid var(--success);
        }

        /* Tab Styles */
        .nav-tabs {
            border-bottom: 1px solid var(--border);
            margin-bottom: 24px;
        }

        .nav-tabs .nav-link {
            border: none;
            padding: 12px 24px;
            color: #6B7280;
            font-weight: 500;
            border-radius: 8px 8px 0 0;
        }

        .nav-tabs .nav-link.active {
            background: white;
            color: var(--primary);
            border-bottom: 2px solid var(--primary);
        }

        /* Image Preview */
        .image-preview {
            width: 100%;
            height: 200px;
            background: var(--light);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            overflow: hidden;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .topbar {
                padding: 16px 20px;
            }

            .content-area {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="fas fa-compass"></i>
            </div>
            <div>
                <div class="sidebar-title">Wanderlust Admin</div>
                <div class="sidebar-subtitle">Travel Management System</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-item">
                <a href="#dashboard" class="nav-link active" data-bs-toggle="tab">
                    <i class="fas fa-tachometer-alt nav-icon"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="#hero" class="nav-link" data-bs-toggle="tab">
                    <i class="fas fa-image nav-icon"></i>
                    <span class="nav-text">Hero Images</span>
                    <span class="nav-badge">5</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="#content" class="nav-link" data-bs-toggle="tab">
                    <i class="fas fa-edit nav-icon"></i>
                    <span class="nav-text">Site Content</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="#destinations" class="nav-link" data-bs-toggle="tab">
                    <i class="fas fa-map-marker-alt nav-icon"></i>
                    <span class="nav-text">Destinations</span>
                    <span class="nav-badge">4</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="#packages" class="nav-link" data-bs-toggle="tab">
                    <i class="fas fa-suitcase nav-icon"></i>
                    <span class="nav-text">Travel Packages</span>
                    <span class="nav-badge">6</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="#bookings" class="nav-link" data-bs-toggle="tab">
                    <i class="fas fa-calendar-check nav-icon"></i>
                    <span class="nav-text">Bookings</span>
                    <span class="nav-badge">12</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="#analytics" class="nav-link" data-bs-toggle="tab">
                    <i class="fas fa-chart-bar nav-icon"></i>
                    <span class="nav-text">Analytics</span>
                </a>
            </div>

            <div class="nav-item mt-4">
                <a href="{{ route('admin.logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt nav-icon"></i>
                    <span class="nav-text">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="page-title">
                <h1>Admin Dashboard</h1>
                <p>Welcome back, Administrator! Here's what's happening today.</p>
            </div>

            <div class="topbar-actions">
                <div class="user-menu">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-info">
                        <div class="user-name">Admin User</div>
                        <div class="user-role">Administrator</div>
                    </div>
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <!-- Stats Overview -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-trend positive">
                            +12%
                        </div>
                    </div>
                    <div class="stat-value">1,248</div>
                    <div class="stat-label">Total Visitors</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon success">
                            <i class="fas fa-suitcase"></i>
                        </div>
                        <div class="stat-trend positive">
                            +8%
                        </div>
                    </div>
                    <div class="stat-value">156</div>
                    <div class="stat-label">Bookings This Month</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon warning">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="stat-trend positive">
                            +23%
                        </div>
                    </div>
                    <div class="stat-value">42</div>
                    <div class="stat-label">New Inquiries</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon danger">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-trend positive">
                            +15%
                        </div>
                    </div>
                    <div class="stat-value">$24,580</div>
                    <div class="stat-label">Revenue</div>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="tab-content">
                <!-- Dashboard Tab -->
                <div class="tab-pane fade show active" id="dashboard">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="content-card">
                                <div class="card-header">
                                    <h3 class="card-title">Recent Activity</h3>
                                </div>
                                <div class="card-body">
                                    <p>Dashboard overview with charts and recent activities will be displayed here.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="content-card">
                                <div class="card-header">
                                    <h3 class="card-title">Quick Actions</h3>
                                </div>
                                <div class="card-body">
                                    <button class="btn btn-primary w-100 mb-2">
                                        <i class="fas fa-plus me-2"></i>Add New Destination
                                    </button>
                                    <button class="btn btn-outline-primary w-100 mb-2">
                                        <i class="fas fa-edit me-2"></i>Update Content
                                    </button>
                                    <button class="btn btn-outline-primary w-100">
                                        <i class="fas fa-chart-bar me-2"></i>View Reports
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hero Images Tab -->
                <div class="tab-pane fade" id="hero">
                    <div class="content-card">
                        <div class="card-header">
                            <h3 class="card-title">Manage Hero Images</h3>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle me-2"></i>
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('admin.hero-images.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    @for($i = 0; $i < 5; $i++)
                                    <div class="col-lg-6 mb-4">
                                        <div class="content-card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Hero Image {{ $i + 1 }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="image-preview">
                                                    <i class="fas fa-image fa-3x text-muted"></i>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Title</label>
                                                    <input type="text" class="form-control" name="hero_images[{{ $i }}][title]" value="Discover Paradise Beaches" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Subtitle</label>
                                                    <textarea class="form-control" name="hero_images[{{ $i }}][subtitle]" rows="2" required>Experience the world's most beautiful coastal destinations</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Upload Image</label>
                                                    <input type="file" class="form-control" name="hero_images[{{ $i }}][image]" accept="image/*">
                                                    <small class="text-muted">Recommended: 1920×1080px, JPEG/PNG</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Update All Images
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Site Content Tab -->
                <div class="tab-pane fade" id="content">
                    <div class="content-card">
                        <div class="card-header">
                            <h3 class="card-title">Manage Site Content</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.content.update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Site Title</label>
                                            <input type="text" class="form-control" name="site_title" value="Wanderlust Travel" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Company Name</label>
                                            <input type="text" class="form-control" name="company_name" value="Wanderlust Travel Agency" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Contact Email</label>
                                            <input type="email" class="form-control" name="contact_email" value="info@wanderlust.com" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Contact Phone</label>
                                            <input type="text" class="form-control" name="contact_phone" value="+1 (555) 123-4567" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">About Content</label>
                                    <textarea class="form-control" name="about_content" rows="6" required>For over a decade, Wanderlust Travel has been transforming travel dreams into extraordinary realities. We are passionate about creating personalized experiences that go beyond typical tourism.</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Facebook URL</label>
                                            <input type="url" class="form-control" name="facebook_url" value="https://facebook.com/wanderlust">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Instagram URL</label>
                                            <input type="url" class="form-control" name="instagram_url" value="https://instagram.com/wanderlust">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Twitter URL</label>
                                            <input type="url" class="form-control" name="twitter_url" value="https://twitter.com/wanderlust">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Update Content
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Other tabs would go here -->
                <div class="tab-pane fade" id="destinations">
                    <div class="content-card">
                        <div class="card-header">
                            <h3 class="card-title">Manage Destinations</h3>
                            <button class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add Destination
                            </button>
                        </div>
                        <div class="card-body">
                            <p>Destination management interface coming soon...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab functionality
            var triggerTabList = [].slice.call(document.querySelectorAll('.nav-link'))
            triggerTabList.forEach(function (triggerEl) {
                var tabTrigger = new bootstrap.Tab(triggerEl)

                triggerEl.addEventListener('click', function (event) {
                    event.preventDefault()
                    tabTrigger.show()

                    // Update active states
                    document.querySelectorAll('.nav-link').forEach(link => {
                        link.classList.remove('active')
                    })
                    this.classList.add('active')
                })
            })

            // Update page title based on active tab
            const tabTitles = {
                'dashboard': 'Dashboard',
                'hero': 'Hero Images',
                'content': 'Site Content',
                'destinations': 'Destinations',
                'packages': 'Travel Packages',
                'bookings': 'Bookings',
                'analytics': 'Analytics'
            }

            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function() {
                    const tabId = this.getAttribute('href').replace('#', '')
                    const pageTitle = document.querySelector('.page-title h1')
                    pageTitle.textContent = tabTitles[tabId] || 'Admin Dashboard'
                })
            })

            // Image preview functionality
            document.querySelectorAll('input[type="file"]').forEach(input => {
                input.addEventListener('change', function() {
                    const file = this.files[0]
                    if (file) {
                        const reader = new FileReader()
                        const preview = this.closest('.card-body').querySelector('.image-preview')

                        reader.onload = function(e) {
                            preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`
                        }

                        reader.readAsDataURL(file)
                    }
                })
            })

            // Mobile sidebar toggle
            function toggleSidebar() {
                document.getElementById('sidebar').classList.toggle('mobile-open')
            }
        })
    </script>
</body>
</html>
