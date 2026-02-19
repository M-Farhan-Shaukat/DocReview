@extends('user.layouts.app')

@section('content')
    <div class="container py-4">

        <!-- Header with navigation and status -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div class="d-flex align-items-center">
                <a href="{{ route('user.applications.index') }}"
                   class="btn btn-outline-secondary rounded-circle p-2 me-3"
                   style="width: 40px; height: 40px;"
                   title="Back to Applications">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                </a>
                <div>
                    <h3 class="fw-bold mb-1">📄 Application Details</h3>
                    <p class="text-muted mb-0">Review your submitted information and documents</p>
                </div>
            </div>
            <div>
                @if($application->status == 'pending')
                    <span class="badge bg-warning bg-opacity-25 text-warning px-4 py-3 rounded-pill fs-6">
                        <span class="dot bg-warning me-2"></span> Pending Review
                    </span>
                @elseif($application->status == 'approved')
                    <span class="badge bg-success bg-opacity-25 text-success px-4 py-3 rounded-pill fs-6">
                        <span class="dot bg-success me-2"></span> Approved
                    </span>
                @elseif($application->status == 'rejected')
                    <span class="badge bg-danger bg-opacity-25 text-danger px-4 py-3 rounded-pill fs-6">
                        <span class="dot bg-danger me-2"></span> Rejected
                    </span>
                @else
                    <span class="badge bg-secondary bg-opacity-25 text-secondary px-4 py-3 rounded-pill fs-6">
                        {{ ucfirst($application->status) }}
                    </span>
                @endif
            </div>
        </div>

        <!-- Main Application Details Card -->
        <div class="card border-0 shadow-lg mb-4 overflow-hidden">
            <div class="card-header bg-white py-3 border-0">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-circle text-primary" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                        </svg>
                    </div>
                    <h5 class="fw-semibold mb-0">Application Overview</h5>
                </div>
            </div>
            <div class="card-body p-4">
                <!-- Application Info Cards Row -->
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="bg-light rounded-4 p-3 h-100">
                            <small class="text-muted text-uppercase fw-semibold">Application ID</small>
                            <div class="d-flex align-items-center mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-hash text-primary me-2" viewBox="0 0 16 16">
                                    <path d="M8.39 12.648a1.32 1.32 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-.975l.516-2.492c.058-.25-.078-.405-.348-.405-.227 0-.36.148-.402.32l-.52 2.577h-1.765l.516-2.492c.058-.25-.078-.405-.348-.405-.227 0-.36.148-.402.32l-.52 2.577H6.28c-.406 0-.61.225-.61.532 0 .313.188.524.61.524h1.18l-.515 2.524H5.877c-.402 0-.602.222-.602.516 0 .313.187.53.602.53h1.09l-.504 2.45c-.058.242.074.405.34.405.227 0 .36-.148.398-.32l.52-2.535h1.765zm.79-3.178.515-2.524h-1.76l-.516 2.524h1.76z"/>
                                </svg>
                                <span class="fs-4 fw-bold">#{{ $application->id }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-light rounded-4 p-3 h-100">
                            <small class="text-muted text-uppercase fw-semibold">Submitted</small>
                            <div class="d-flex align-items-center mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-calendar-check text-success me-2" viewBox="0 0 16 16">
                                    <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.0z"/>
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                </svg>
                                <span class="fw-semibold">{{ $application->created_at->format('d M Y') }}</span>
                                <span class="text-muted ms-2 small">{{ $application->created_at->format('h:i A') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-light rounded-4 p-3 h-100">
                            <small class="text-muted text-uppercase fw-semibold">Last Updated</small>
                            <div class="d-flex align-items-center mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-clock-history text-info me-2" viewBox="0 0 16 16">
                                    <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zM8 3.5a.5.5 0 0 1 .5.5v4.5h3a.5.5 0 0 1 0 1H8a.5.5 0 0 1-.5-.5V4a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                                <span>{{ $application->updated_at->format('d M Y h:i A') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Information Section -->
                <div class="mb-5">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 rounded-2 p-2 me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-badge text-primary" viewBox="0 0 16 16">
                                <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803A4.2 4.2 0 0 0 3 13.294V2.5z"/>
                            </svg>
                        </div>
                        <h5 class="fw-semibold mb-0">Personal Information</h5>
                    </div>

                    <div class="row g-3">
                        <div class="col-sm-6 col-md-4">
                            <div class="border-0 bg-light p-3 rounded-3">
                                <small class="text-muted d-block mb-1">Full Name</small>
                                <strong>{{ $application->name }}</strong>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="border-0 bg-light p-3 rounded-3">
                                <small class="text-muted d-block mb-1">Email Address</small>
                                <strong>{{ $application->email }}</strong>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="border-0 bg-light p-3 rounded-3">
                                <small class="text-muted d-block mb-1">Age</small>
                                <strong>{{ $application->age }} years</strong>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="border-0 bg-light p-3 rounded-3">
                                <small class="text-muted d-block mb-1">City</small>
                                <strong>{{ $application->city }}</strong>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="border-0 bg-light p-3 rounded-3">
                                <small class="text-muted d-block mb-1">Phone Number</small>
                                <strong>{{ $application->phone }}</strong>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="border-0 bg-light p-3 rounded-3">
                                <small class="text-muted d-block mb-1">CNIC</small>
                                <strong>{{ $application->cnic }}</strong>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="border-0 bg-light p-3 rounded-3">
                                <small class="text-muted d-block mb-1">Postal Code</small>
                                <strong>{{ $application->postal_code }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- documents Section -->
                <div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success bg-opacity-10 rounded-2 p-2 me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-earmark-text text-success" viewBox="0 0 16 16">
                                <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
                                <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                            </svg>
                        </div>
                        <h5 class="fw-semibold mb-0">Uploaded Documents</h5>
                        <span class="badge bg-light text-dark ms-2">{{ $application->documents->count() }} files</span>
                    </div>

                    @if($application->documents->count() > 0)
                        <div class="row g-3">
                            @foreach($application->documents as $index => $document)
                                <div class="col-md-6">
                                    <div class="card border-0 bg-light h-100">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-start">
                                                <div class="me-3">
                                                    @php
                                                        $extension = pathinfo($document->original_name, PATHINFO_EXTENSION);
                                                    @endphp
                                                    <div class="bg-white rounded-3 p-2 shadow-sm">
                                                        @if(in_array(strtolower($extension), ['pdf']))
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-file-pdf text-danger" viewBox="0 0 16 16">
                                                                <path d="M5.523 10.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.323.221c-.133.087-.28.186-.396.265.088-.084.184-.169.28-.25.203-.154.386-.304.58-.424.141-.087.297-.175.464-.262.107-.058.216-.114.323-.166l.003-.001a6.62 6.62 0 0 1 .513-.217 4.86 4.86 0 0 1 .593-.158c.255-.055.53-.09.817-.09.363 0 .708.062 1.025.173.382.131.683.336.892.59.218.266.347.601.347.994 0 .387-.125.714-.367.95-.245.241-.59.389-.978.389-.215 0-.414-.046-.598-.131a2.143 2.143 0 0 1-.497-.33c.037.097.106.19.207.289.184.19.426.342.712.438.276.094.586.141.906.141.407 0 .771-.09 1.06-.27.283-.18.498-.44.64-.744.138-.3.207-.65.207-1.045 0-.402-.069-.77-.208-1.073-.143-.309-.36-.55-.637-.726-.279-.176-.625-.265-1.005-.265-.343 0-.656.07-.932.194-.284.128-.54.291-.766.46-.087.066-.173.134-.256.202l.002.002c-.165.135-.324.276-.473.422-.119.118-.23.24-.334.363l-.005.006a8.93 8.93 0 0 1-.427-.437c-.14-.158-.282-.318-.414-.484l-.01-.013c-.152-.191-.292-.391-.414-.605-.097-.168-.171-.34-.222-.518-.05-.175-.078-.36-.078-.555 0-.232.036-.436.106-.618.072-.191.181-.358.328-.497.148-.138.339-.248.569-.322.233-.074.516-.111.838-.111.371 0 .69.063.953.19.264.126.473.305.622.532.145.223.225.488.225.79 0 .014-.002.028-.003.042l.014.003c.004-.043.006-.087.006-.131 0-.324-.087-.6-.246-.832a1.658 1.658 0 0 0-.679-.56 2.49 2.49 0 0 0-1.013-.21c-.427 0-.801.074-1.106.216-.301.142-.532.344-.683.589-.145.231-.219.506-.219.816 0 .24.04.46.115.66.073.194.177.37.307.52.128.147.28.274.448.376.16.097.334.173.518.222.183.05.373.075.566.075.192 0 .375-.02.547-.058.164-.036.324-.09.474-.158-.017.021-.034.041-.051.062l-.002.002c-.15.188-.314.363-.483.523-.164.155-.336.296-.51.418-.14.1-.278.187-.413.262-.146.082-.294.157-.443.226-.127.061-.254.118-.381.171l-.004.002zM14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                                            </svg>
                                                        @elseif(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-file-image text-primary" viewBox="0 0 16 16">
                                                                <path d="M8.002 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                                                                <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v8l-2.083-2.083a.5.5 0 0 0-.76.063L8 11 5.835 9.7a.5.5 0 0 0-.611.076L3 12V2z"/>
                                                            </svg>
                                                        @else
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-file-earmark text-secondary" viewBox="0 0 16 16">
                                                                <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                                                            </svg>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start gap-2">
                                                        <div>
                                                            <strong class="d-block mb-1">{{ $document->original_name }}</strong>
                                                            <small class="text-muted">
                                                                {{ $document->attachment->filename ?? 'Required Document' }}
                                                            </small>
                                                        </div>
                                                        <a href="{{ route('user.document.preview', $document->id) }}"
                                                           target="_blank"
                                                           class="btn btn-sm btn-primary rounded-pill px-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-eye me-1" viewBox="0 0 16 16">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                            </svg>
                                                            Preview
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info bg-light border-0 d-flex align-items-center p-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-info-circle me-3 text-info" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                            <span class="fw-semibold">No documents have been uploaded for this application.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="d-flex justify-content-center mt-4">
            <a href="{{ route('user.applications.index') }}"
               class="btn btn-outline-secondary btn-lg rounded-pill px-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left me-2" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
                Back to Applications List
            </a>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .bg-opacity-10 { background-color: rgba(var(--bs-primary-rgb), 0.1); }
        .bg-opacity-25 { background-color: rgba(255,255,255,0.25); }
        .dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }
        .rounded-4 { border-radius: 1rem; }
        .card {
            border-radius: 1.5rem;
        }
        .btn-rounded {
            border-radius: 2rem;
        }
        @media (max-width: 576px) {
            .container { padding-left: 12px; padding-right: 12px; }
        }
    </style>
@endsection
