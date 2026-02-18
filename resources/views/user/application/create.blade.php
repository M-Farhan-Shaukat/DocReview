@extends('user.layouts.app')

@section('content')
    <div class="container py-4">
        <!-- Header Card with gradient -->
        <div class="card border-0 shadow-sm mb-4 overflow-hidden">
            <div class="card-body p-4" style="background: linear-gradient(105deg, #2b3a8a 0%, #1e2b6f 100%);">
                <div class="d-flex align-items-center text-white">
                    <div class="rounded-circle bg-white bg-opacity-20 p-3 me-3 d-none d-sm-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-file-text" viewBox="0 0 16 16">
                            <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-1 text-white">📋 Application Form</h3>
                        <p class="mb-0 text-white-50">Complete your profile and upload required documents</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert messages styled beautifully -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
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

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <div class="me-3 bg-white bg-opacity-25 rounded-circle p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                            <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                            <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                        </svg>
                    </div>
                    <span class="fw-semibold">{{ session('error') }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- MAIN FORM CARD -->
        <div class="card border-0 shadow-lg">
            <div class="card-body p-4 p-xl-5">
                <form id="applicationForm"
                      action="{{ route('user.application.submit', $application->id ?? null) }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <!-- SECTION: User Information -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center mb-4 pb-1 border-bottom">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-circle text-primary" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
                            </div>
                            <h5 class="fw-semibold mb-0 text-primary">User Information</h5>
                            <span class="ms-2 small text-muted">(read-only)</span>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-medium text-secondary small text-uppercase">Full Name</label>
                                <input type="text" value="{{ $user->name }}" name="name" class="form-control bg-light border-0" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-medium text-secondary small text-uppercase">Email Address</label>
                                <input type="text" value="{{ $user->email }}" name="email" class="form-control bg-light border-0" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-medium text-secondary small text-uppercase">Age</label>
                                <input type="text" value="{{ $user->age }}" name="age" class="form-control bg-light border-0" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-medium text-secondary small text-uppercase">City</label>
                                <input type="text" value="{{ $user->city }}" name="city" class="form-control bg-light border-0" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-medium text-secondary small text-uppercase">Phone Number</label>
                                <input type="text" value="{{ $user->phone }}" name="phone" class="form-control bg-light border-0" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-medium text-secondary small text-uppercase">CNIC</label>
                                <input type="text" value="{{ $user->cnic }}" name="cnic" class="form-control bg-light border-0" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-medium text-secondary small text-uppercase">Postal Code</label>
                                <input type="text" value="{{ $user->postal_code }}" name="postal_code" class="form-control bg-light border-0" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION: Document Upload -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-4 pb-1 border-bottom">
                            <div class="bg-success bg-opacity-10 rounded-3 p-2 me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-cloud-upload text-success" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.501-1.643 1.026-2.206a.53.53 0 0 1 .438-.177z"/>
                                    <path fill-rule="evenodd" d="M7.646 7.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854a.5.5 0 1 1-.708-.708l2-2z"/>
                                </svg>
                            </div>
                            <h5 class="fw-semibold mb-0 text-success">Upload Required Documents</h5>
                        </div>

                        @foreach($attachments as $attachment)
                            <div class="card border-0 bg-light mb-3 p-3">
                                <div class="row align-items-center g-2">
                                    <div class="col-12 col-md-4">
                                        <label class="form-label fw-semibold mb-1">
                                            {{ $attachment->filename }}
                                            <span class="badge bg-warning text-dark ms-2">required</span>
                                        </label>
                                        <p class="small text-muted mb-0">Admin requirement</p>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <input type="file"
                                               name="documents[{{ $attachment->id }}]"
                                               class="form-control shadow-sm"
                                               required>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        @php
                                            $uploaded = $documents->where('attachment_id', $attachment->id)->first();
                                        @endphp
                                        @if($uploaded)
                                            <div class="d-flex align-items-center text-success">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill me-1" viewBox="0 0 16 16">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                </svg>
                                                <small>
                                                    <a href="{{ route('user.document.preview', $uploaded->id) }}"
                                                       target="_blank"
                                                       class="text-success text-decoration-none fw-medium">
                                                        {{ \Str::limit($uploaded->original_name, 25) }}
                                                    </a>
                                                </small>
                                            </div>
                                        @else
                                            <div class="text-muted small">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-clock me-1" viewBox="0 0 16 16">
                                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                                </svg>
                                                Not uploaded yet
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- SUBMIT BUTTON AREA -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-5 pt-3 border-top">
                        <p class="small text-muted mb-3 mb-sm-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-info-circle me-1" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                            Once submitted, you cannot edit your application.
                        </p>
                        <button type="button" class="btn btn-success px-5 py-3 shadow-lg" onclick="confirmSubmit()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-send-check me-2" viewBox="0 0 16 16">
                                <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372l2.8-7Zm-2.54 1.183L5.93 9.363 1.591 6.602l11.833-4.733Z"/>
                                <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z"/>
                            </svg>
                            Submit Application
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SweetAlert and custom styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmSubmit() {
            Swal.fire({
                title: 'Ready to submit?',
                text: "Once submitted, you will not be able to edit your application.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, submit now',
                cancelButtonText: 'Review again',
                reverseButtons: true,
                background: '#f8f9fa',
                backdrop: `
                    rgba(0,0,0,0.4)
                    left top
                    no-repeat
                `
            }).then((result) => {
                if(result.isConfirmed) {
                    document.getElementById('applicationForm').submit();
                }
            });
        }

        // Optional: live preview file names (just for better UX)
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name;
                if(fileName) {
                    // you could display it somewhere if needed
                }
            });
        });
    </script>

    <!-- Additional responsive styles -->
    <style>
        .bg-opacity-20 { background-color: rgba(255,255,255,0.2); }
        .bg-opacity-10 { background-color: rgba(var(--bs-primary-rgb), 0.1); }
        .fw-medium { font-weight: 500; }
        .text-white-50 { color: rgba(255,255,255,0.7) !important; }
        .form-control:read-only { opacity: 0.9; cursor: default; }
        .card { border-radius: 1.25rem; }
        .btn { border-radius: 0.75rem; }
        @media (max-width: 576px) {
            .container { padding-left: 12px; padding-right: 12px; }
        }
    </style>
@endsection
