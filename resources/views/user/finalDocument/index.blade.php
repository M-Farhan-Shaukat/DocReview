@extends('user.layouts.app')

@section('content')
    <div class="container py-4">
        <!-- Header Section with Gradient Card -->
        <div class="card border-0 shadow-lg mb-4 overflow-hidden">
            <div class="card-body p-4" style="background: linear-gradient(135deg, #2b3a8a 0%, #1e2b6f 100%);">
                <div class="row align-items-center">
                    <div class="col-12 col-sm-6 mb-3 mb-sm-0">
                        <div class="d-flex align-items-center text-white">
                            <div class="rounded-circle bg-white bg-opacity-20 p-3 me-3 d-none d-md-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-grid-3x3-gap-fill" viewBox="0 0 16 16">
                                    <path d="M1 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2zM1 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V7zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V7zM1 12a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-2z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="fw-bold mb-1 text-white">📋 Final Registration Form</h2>
                                <p class="mb-0 text-white-50">Track and manage your submitted applications</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 text-sm-end">
                        <a href="{{ route('user.final_form.create') }}"
                           class="btn btn-light btn-lg rounded-pill px-4 shadow-sm {{ $disableNewApplicationButton ? 'disabled' : '' }}"  {{ $disableNewApplicationButton  ? 'aria-disabled=true' : '' }}>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle me-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                            New Application
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert messages styled beautifully -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <div class="me-3 bg-white bg-opacity-25 rounded-circle p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                        </svg>
                    </div>
                    <span class="fw-semibold">{{ session('success') }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($applications->count() > 0)
            <!-- Stats Cards Row -->
            <div class="row g-3 mb-4">
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm bg-primary bg-opacity-10">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-primary bg-opacity-25 p-2 me-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-files text-primary" viewBox="0 0 16 16">
                                        <path d="M13 0H6a2 2 0 0 0-2 2 2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 13V4a2 2 0 0 0-2-2H5a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1zM3 4a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h6 class="small text-muted mb-1">Total</h6>
                                    <span class="h5 mb-0 fw-bold">{{ $applications->total() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm bg-warning bg-opacity-10">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-warning bg-opacity-25 p-2 me-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-clock-history text-warning" viewBox="0 0 16 16">
                                        <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zM8 3.5a.5.5 0 0 1 .5.5v4.5h3a.5.5 0 0 1 0 1H8a.5.5 0 0 1-.5-.5V4a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h6 class="small text-muted mb-1">Pending</h6>
                                    <span class="h5 mb-0 fw-bold">{{ $applications->where('status', 'pending')->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm bg-success bg-opacity-10">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-success bg-opacity-25 p-2 me-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check-circle text-success" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h6 class="small text-muted mb-1">Approved</h6>
                                    <span class="h5 mb-0 fw-bold">{{ $applications->where('status', 'approved')->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm bg-danger bg-opacity-10">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-danger bg-opacity-25 p-2 me-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-x-circle text-danger" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h6 class="small text-muted mb-1">Rejected</h6>
                                    <span class="h5 mb-0 fw-bold">{{ $applications->where('status', 'rejected')->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Applications Table Card -->
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-white py-3 border-0">
                    <div class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-table text-primary me-2" viewBox="0 0 16 16">
                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
                        </svg>
                        <h5 class="fw-semibold mb-0">Application History</h5>
                        <span class="badge bg-light text-dark ms-2">{{ $applications->total() }} total</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <!-- Desktop Table View (hidden on mobile) -->
                    <div class="d-none d-md-block">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Application unique Id</th>
                                <th>Status</th>
                                <th>Submitted At</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($applications as $index => $application)
                                <tr>
                                    <td class="ps-4 fw-medium">{{ $applications->firstItem() + $index }}</td>
                                    <td>
                                        <span class="fw-semibold">{{ $application->unique_id }}</span>
                                    </td>
                                    <td>
                                        @if($application->status == 'pending')
                                            <span class="badge bg-warning bg-opacity-25 text-warning px-3 py-2 rounded-pill">
                                                <span class="dot bg-warning me-1"></span> Pending
                                            </span>
                                        @elseif($application->status == 'approved')
                                            <span class="badge bg-success bg-opacity-25 text-success px-3 py-2 rounded-pill">
                                                <span class="dot bg-success me-1"></span> Approved
                                            </span>
                                        @elseif($application->status == 'rejected')
                                            <span class="badge bg-danger bg-opacity-25 text-danger px-3 py-2 rounded-pill">
                                                <span class="dot bg-danger me-1"></span> Rejected
                                            </span>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-25 text-secondary px-3 py-2 rounded-pill">
                                                {{ ucfirst($application->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-calendar3 text-muted me-2" viewBox="0 0 16 16">
                                                <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
                                                <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                            </svg>
                                            <span>{{ $application->created_at->format('d M Y, h:i A') }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('user.final_form.view', $application->id) }}"
                                           class="btn btn-sm btn-primary rounded-pill px-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-eye me-1" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                            </svg>
                                            View
                                        </a>
                                    </td>

                                    @if($application->show_edit_button == true)
                                        <td class="text-center">
                                            <a href="{{ route('user.final_form.create', $application->id) }}"
                                               class="btn btn-sm btn-warning rounded-pill px-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-square me-1" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                                Edit
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View (visible only on mobile) -->
                    <div class="d-md-none p-3">
                        @foreach($applications as $index => $application)
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-light text-dark">#{{ $application->id }}</span>
                                        <span class="text-muted small">#{{ $applications->firstItem() + $index }}</span>
                                    </div>
                                    <div class="mb-2">
                                        @if($application->status == 'pending')
                                            <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                                        @elseif($application->status == 'approved')
                                            <span class="badge bg-success px-3 py-2">Approved</span>
                                        @elseif($application->status == 'rejected')
                                            <span class="badge bg-danger px-3 py-2">Rejected</span>
                                        @else
                                            <span class="badge bg-secondary px-3 py-2">{{ ucfirst($application->status) }}</span>
                                        @endif
                                    </div>
                                    <div class="small text-muted mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-calendar3 me-1" viewBox="0 0 16 16">
                                            <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
                                        </svg>
                                        {{ $application->created_at->format('d M Y, h:i A') }}
                                    </div>
                                    <a href="{{ route('user.final_form.view', $application->id) }}"
                                       class="btn btn-primary w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-eye me-2" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                        </svg>
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Pagination with improved styling -->
            <div class="mt-4 d-flex justify-content-center">
                <div class="pagination-container">
                    {{ $applications->links() }}
                </div>
            </div>
        @else
            <!-- Empty State with illustration -->
            <div class="card border-0 shadow-lg">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-files text-muted opacity-50" viewBox="0 0 16 16">
                            <path d="M13 0H6a2 2 0 0 0-2 2 2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 13V4a2 2 0 0 0-2-2H5a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1zM3 4a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4z"/>
                        </svg>
                    </div>
                    <h4 class="fw-semibold mb-2">No Applications Yet</h4>
                    <p class="text-muted mb-4">Get started by creating your first application.</p>
                    <a href="{{ route('user.final_form.create') }}"
                       class="btn btn-success btn-lg rounded-pill px-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle me-2" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Create New Application
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Custom Styles -->
    <style>
        .bg-opacity-20 { background-color: rgba(255,255,255,0.2); }
        .bg-opacity-10 { background-color: rgba(var(--bs-primary-rgb), 0.1); }
        .bg-opacity-25 { background-color: rgba(255,255,255,0.25); }
        .dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 6px;
        }
        .table > :not(caption) > * > * {
            padding: 1rem 0.75rem;
        }
        .table thead th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            color: #4a5568;
        }
        .pagination-container .pagination {
            margin-bottom: 0;
        }
        .pagination-container .page-link {
            border-radius: 50px;
            margin: 0 3px;
            border: none;
            color: #2d3748;
            font-weight: 500;
        }
        .pagination-container .page-item.active .page-link {
            background: linear-gradient(145deg, #2b3a8a, #1e2b6f);
            color: white;
            box-shadow: 0 4px 10px rgba(43, 58, 138, 0.3);
        }
        .text-white-50 { color: rgba(255,255,255,0.7) !important; }
        .card { border-radius: 1.25rem; }
        .btn { border-radius: 0.75rem; }
        .btn-sm { border-radius: 2rem; }
        @media (max-width: 768px) {
            .container { padding-left: 12px; padding-right: 12px; }
        }
    </style>
@endsection
