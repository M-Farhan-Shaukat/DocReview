@extends('user.layouts.app')

@section('content')

    <div class="container">

        <div class="d-flex justify-content-between mb-3">
            <h3>Your Documents</h3>
            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Back</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('user.documents.create') }}" class="btn btn-primary mb-3">Upload New Document</a>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Attachment</th>
                <th>File Name</th>
                <th>Status</th>
                <th>Uploaded At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($documents as $doc)
                <tr>
                    <td>{{ $doc->id }}</td>
                    <td>{{ $doc->attachment?->name ?? 'Payment Slip / Signed Agreement' }}</td>
                    <td>{{ $doc->original_name }}</td>
                    <td>{{ ucfirst($doc->status) }}</td>
                    <td>{{ $doc->created_at->format('d M Y') }}</td>
                    <td>
                        @php
                            $previewableTypes = ['pdf','jpg','jpeg','png'];
                            $extension = strtolower(pathinfo($doc->original_name, PATHINFO_EXTENSION));
                            $canPreview = in_array($extension, $previewableTypes);
                        @endphp

                        <button class="btn btn-sm btn-primary"
                                @if($canPreview)
                                    data-bs-toggle="modal"
                                data-bs-target="#previewModal"
                                data-url="{{ route('user.documents.preview', $doc->id) }}"
                                @else
                                    disabled
                            @endif>
                            Preview
                        </button>

{{--                        <a href="{{ route('user.documents.download', $doc->id) }}" class="btn btn-sm btn-success">Download</a>--}}

                        <form action="{{ route('user.documents.destroy', $doc->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this file?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">No documents uploaded yet.</td></tr>
            @endforelse
            </tbody>
        </table>

        {{ $documents->links() }}

    </div>

    <!-- Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalLabel">Preview Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="previewContent" style="height: 80vh; overflow:auto;">
                    Loading...
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        var previewModal = document.getElementById('previewModal');
        previewModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var url = button.getAttribute('data-url');
            var modalBody = document.getElementById('previewContent');

            // detect file type from URL extension
            var ext = url.split('.').pop().toLowerCase();

            if(['jpg','jpeg','png'].includes(ext)){
                modalBody.innerHTML = `<img src="${url}" style="width:100%; max-height:80vh; object-fit:contain;">`;
            } else if(ext === 'pdf'){
                modalBody.innerHTML = `<iframe src="${url}" width="100%" height="80vh" style="border:none;"></iframe>`;
            } else {
                modalBody.innerHTML = `<p>Preview not available for this file type.</p>`;
            }
        });

    </script>
@endsection
