<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .user-sidebar {
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .sidebar-brand {
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
        }
        .nav-link-user {
            color: rgba(255,255,255,0.8);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            margin-bottom: 5px;
            transition: all 0.3s;
        }
        .nav-link-user:hover, .nav-link-user.active {
            background: rgba(255,255,255,0.15);
            color: white;
        }
        .user-badge {
            font-size: 0.7rem;
            padding: 2px 8px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar for User -->
        @auth
            @if(auth()->user()->hasRole('User'))
                <div class="col-md-3 col-lg-2 px-0 user-sidebar">
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
                                    <div class="text-white fw-medium">{{ auth()->user()->name }}</div>
                                    <small class="text-white-50">{{ auth()->user()->email }}</small>
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
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('user.upload') }}" class="nav-link-user d-flex align-items-center">--}}
{{--                                    <i class="bi bi-cloud-upload me-2"></i>--}}
{{--                                    Upload Documents--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('user.status') }}" class="nav-link-user d-flex align-items-center">--}}
{{--                                    <i class="bi bi-clock-history me-2"></i>--}}
{{--                                    Application Status--}}
{{--                                </a>--}}
{{--                            </li>--}}
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
            @endif
        @endauth

        <!-- Main Content -->
        <div class="@if(auth()->check() && auth()->user()->hasRole('User')) col-md-9 col-lg-10 @else col-12 @endif p-4">
            <!-- Role Alert -->
            @auth
                @if(auth()->user()->hasRole('User'))
                    <div class="alert alert-info alert-dismissible fade show mb-4 py-2" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle me-2"></i>
                            <div>
                                <strong>User Account:</strong> You have limited access. Contact admin for elevated permissions.
                            </div>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                @endif
            @endauth

            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
