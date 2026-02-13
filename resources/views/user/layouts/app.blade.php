<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=yes">
    <title>@yield('title', 'User Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        /* Mobile First Approach */
        .user-sidebar {
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
            min-height: auto;
            transition: all 0.3s ease;
        }

        @media (min-width: 768px) {
            .user-sidebar {
                min-height: 100vh;
            }
        }

        .sidebar-brand {
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
        }

        @media (min-width: 768px) {
            .sidebar-brand {
                font-size: 1.2rem;
            }
        }

        .nav-link-user {
            color: rgba(255,255,255,0.85);
            border-radius: 8px;
            padding: 0.6rem 0.8rem;
            margin-bottom: 4px;
            transition: all 0.3s;
            font-size: 0.95rem;
        }

        .nav-link-user:hover, .nav-link-user.active {
            background: rgba(255,255,255,0.2);
            color: white;
        }

        .nav-link-user i {
            font-size: 1.1rem;
            width: 1.5rem;
            text-align: center;
        }

        .user-badge {
            font-size: 0.65rem;
            padding: 2px 6px;
        }

        /* Mobile Header */
        .mobile-header {
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: white;
        }

        .mobile-header-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .mobile-header-brand .brand-icon {
            background: white;
            border-radius: 50%;
            padding: 0.35rem;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mobile-header-brand .brand-icon i {
            color: #667eea;
            font-size: 1rem;
        }

        .mobile-header .btn-link {
            color: white;
            text-decoration: none;
            padding: 0.35rem 0.5rem;
            border-radius: 8px;
        }

        .mobile-header .btn-link:hover {
            background: rgba(255,255,255,0.1);
        }

        /* Sidebar Collapse Animation */
        .sidebar-collapse {
            transition: height 0.3s ease;
        }

        /* Touch-friendly targets */
        .btn, .nav-link, .form-check-label, a {
            cursor: pointer;
        }

        /* Improved spacing for mobile */
        @media (max-width: 767.98px) {
            .container-fluid {
                padding-left: 0;
                padding-right: 0;
            }

            .main-content {
                padding: 1rem !important;
            }

            .user-sidebar {
                border-radius: 0;
            }

            .nav-link-user {
                padding: 0.7rem 1rem;
                margin-bottom: 2px;
            }

            .alert {
                margin: 0 0.5rem 1rem 0.5rem;
            }
        }

        /* Tablet optimizations */
        @media (min-width: 768px) and (max-width: 991.98px) {
            .user-sidebar .p-3 {
                padding: 1rem 0.75rem !important;
            }

            .nav-link-user {
                padding: 0.5rem 0.75rem;
                font-size: 0.9rem;
            }

            .sidebar-brand {
                font-size: 1rem;
            }
        }

        /* Smooth transitions */
        .collapse {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
@auth
    @if(auth()->user()->hasRole('User'))
        <!-- Mobile Header - Visible only on mobile -->
        <div class="d-md-none mobile-header">
            <div class="mobile-header-brand">
                <div class="brand-icon">
                    <i class="bi bi-person-circle"></i>
                </div>
                <div>
                    <div class="sidebar-brand mb-0">Document System</div>
                    <small class="text-white-50">User Panel</small>
                </div>
            </div>
            <button class="btn btn-link text-white" type="button" data-bs-toggle="collapse" data-bs-target="#mobileSidebar" aria-expanded="false">
                <i class="bi bi-list fs-4"></i>
            </button>
        </div>
    @endif
@endauth

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar for User -->
        @auth
            @if(auth()->user()->hasRole('User'))
                <div class="col-md-3 col-lg-2 px-0">
                    <!-- Desktop Sidebar (visible on md and up) -->
                    <div class="user-sidebar d-none d-md-block">
                        <div class="d-flex flex-column p-3">
                            <!-- Brand -->
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-white rounded-circle p-2 me-2">
                                    <i class="bi bi-person-circle text-primary"></i>
                                </div>
                                <div>
                                    <div class="sidebar-brand">Document System</div>
                                    <small class="text-white-50">User Panel</small>
                                </div>
                            </div>

                            <!-- User Info -->
                            <div class="bg-white bg-opacity-10 rounded p-3 mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-white rounded-circle p-2">
                                            <i class="bi bi-person text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <div class="text-white fw-medium small">{{ auth()->user()->name }}</div>
                                        <small class="text-white-50" style="font-size: 0.7rem;">{{ auth()->user()->email }}</small>
                                    </div>
                                </div>
                                <div class="mt-2">
                                        <span class="badge bg-info user-badge">
                                            {{ auth()->user()->role->name ?? 'User' }}
                                        </span>
                                </div>
                            </div>

                            <!-- Navigation -->
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('user.dashboard') }}" class="nav-link-user d-flex align-items-center">
                                        <i class="bi bi-speedometer2 me-2"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('user.profile') }}" class="nav-link-user d-flex align-items-center">
                                        <i class="bi bi-person me-2"></i>
                                        My Profile
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('user.documents') }}" class="nav-link-user d-flex align-items-center">
                                        <i class="bi bi-folder me-2"></i>
                                        My Documents
                                    </a>
                                </li>
                                <li class="nav-item mt-4">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-light w-100">
                                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Mobile Sidebar (collapsible) -->
                    <div class="collapse sidebar-collapse" id="mobileSidebar">
                        <div class="user-sidebar">
                            <div class="d-flex flex-column p-3">
                                <!-- Close button for mobile -->
                                <div class="d-flex justify-content-end mb-2 d-md-none">
                                    <button class="btn btn-sm btn-outline-light" type="button" data-bs-toggle="collapse" data-bs-target="#mobileSidebar">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>

                                <!-- User Info (Mobile) -->
                                <div class="bg-white bg-opacity-10 rounded p-3 mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="bg-white rounded-circle p-2">
                                                <i class="bi bi-person text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <div class="text-white fw-medium small">{{ auth()->user()->name }}</div>
                                            <small class="text-white-50" style="font-size: 0.7rem;">{{ auth()->user()->email }}</small>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                            <span class="badge bg-info user-badge">
                                                {{ auth()->user()->role->name ?? 'User' }}
                                            </span>
                                    </div>
                                </div>

                                <!-- Navigation (Mobile) -->
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('user.dashboard') }}" class="nav-link-user d-flex align-items-center" onclick="closeMobileSidebar()">
                                            <i class="bi bi-speedometer2 me-2"></i>
                                            Dashboard
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('user.profile') }}" class="nav-link-user d-flex align-items-center" onclick="closeMobileSidebar()">
                                            <i class="bi bi-person me-2"></i>
                                            My Profile
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('user.documents') }}" class="nav-link-user d-flex align-items-center" onclick="closeMobileSidebar()">
                                            <i class="bi bi-folder me-2"></i>
                                            My Documents
                                        </a>
                                    </li>
                                    <li class="nav-item mt-4">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-light w-100">
                                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endauth

        <!-- Main Content -->
        <div class="main-content @if(auth()->check() && auth()->user()->hasRole('User')) col-md-9 col-lg-10 @else col-12 @endif p-3 p-md-4">
            <!-- Role Alert -->
            @auth
                @if(auth()->user()->hasRole('User'))
                    <div class="alert alert-info alert-dismissible fade show mb-3 mb-md-4 py-2 px-3" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle me-2 flex-shrink-0"></i>
                            <div class="small">
                                <strong>User Account:</strong> You have limited access. Contact admin for elevated permissions.
                            </div>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
            @endauth

            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Close mobile sidebar when clicking on nav links
    function closeMobileSidebar() {
        if (window.innerWidth < 768) {
            const mobileSidebar = document.getElementById('mobileSidebar');
            if (mobileSidebar) {
                const bsCollapse = bootstrap.Collapse.getInstance(mobileSidebar);
                if (bsCollapse) {
                    bsCollapse.hide();
                }
            }
        }
    }

    // Auto-close sidebar on window resize from mobile to desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            const mobileSidebar = document.getElementById('mobileSidebar');
            if (mobileSidebar && mobileSidebar.classList.contains('show')) {
                const bsCollapse = bootstrap.Collapse.getInstance(mobileSidebar);
                if (bsCollapse) {
                    bsCollapse.hide();
                }
            }
        }
    });

    // Initialize tooltips if any
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

@stack('scripts')
</body>
</html>
