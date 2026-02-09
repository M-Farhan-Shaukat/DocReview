<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="d-flex">

    <!-- Sidebar: Only visible for Admin, Manager, Staff -->
    @auth
        @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Manager') || auth()->user()->hasRole('Staff'))
            <div class="bg-dark text-white vh-100 p-3" style="width: 220px;">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary rounded-circle p-2 me-2">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">Admin Panel</h5>
                        <small class="text-white-50">
                            @role('Admin')
                            <span class="badge bg-danger">Admin</span>
                            @endrole
                            @role('Manager')
                            <span class="badge bg-warning">Manager</span>
                            @endrole
                            @role('Staff')
                            <span class="badge bg-info">Staff</span>
                            @endrole
                        </small>
                    </div>
                </div>

                <ul class="nav flex-column mt-4">
                    <!-- Dashboard - All roles -->
                    <li class="nav-item mb-2">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </li>

                    <!-- Upload Attachments - Admin only -->
                    @if(auth()->user()->hasPermission('upload_documents'))
                        <li class="nav-item mb-2">
                            <a href="{{ route('admin.attachments') }}" class="nav-link text-white">
                                <i class="bi bi-cloud-upload me-2"></i> Upload Attachments
                            </a>
                        </li>
                    @endif

                    <!-- Manage Users - Admin only -->
                    @if(auth()->user()->hasPermission('manage_users'))
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link text-white">
                                <i class="bi bi-people me-2"></i> Manage Users
                            </a>
                        </li>
                    @endif

                    <!-- Reports - Admin & Manager -->
                    @if(auth()->user()->hasPermission('view_reports'))
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link text-white">
                                <i class="bi bi-bar-chart me-2"></i> Reports
                            </a>
                        </li>
                    @endif

                    <!-- Agreement Approval - Admin & Staff -->
                    @if(auth()->user()->hasPermission('approve_agreement'))
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link text-white">
                                <i class="bi bi-file-check me-2"></i> Approve Agreements
                            </a>
                        </li>
                    @endif

                    <!-- Payment Verification - Admin & Manager -->
                    @if(auth()->user()->hasPermission('verify_payment'))
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link text-white">
                                <i class="bi bi-credit-card me-2"></i> Verify Payments
                            </a>
                        </li>
                    @endif

                    <hr class="text-white-50 my-3">

                    <li class="nav-item">
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button class="btn btn-sm btn-outline-light w-100">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @endif
    @endauth

    <!-- Main content -->
    <div class="flex-grow-1 p-4">
        <!-- Role Indicator -->
        @auth
            <div class="alert alert-info d-flex align-items-center py-2 mb-3" style="font-size: 0.9rem;">
                <i class="bi bi-info-circle me-2"></i>
                Logged in as:
                <strong class="mx-1">{{ auth()->user()->name }}</strong> |
                Role:
                <span class="badge ms-1
                    @if(auth()->user()->hasRole('Admin')) bg-danger
                    @elseif(auth()->user()->hasRole('Manager')) bg-warning
                    @elseif(auth()->user()->hasRole('Staff')) bg-info
                    @else bg-secondary @endif">
                    {{ auth()->user()->role->name ?? 'No Role' }}
                </span>
            </div>
        @endauth

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword() {
        const password = document.getElementById('password');
        const icon = document.getElementById('passwordIcon');

        if (password) {
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    }
</script>

</body>
</html>
