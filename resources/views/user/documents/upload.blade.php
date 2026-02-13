@extends('user.layouts.app')

@section('content')

    <div class="container">

        <h3>Upload Document</h3>

        <a href="{{ route('user.documents.index') }}" class="btn btn-secondary mb-3">Back</a>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('user.documents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Attachment Type</label>
                <select name="attachment_id" class="form-control" required>
                    <option value="">Select</option>
                    @foreach($attachments as $att)
                        <option value="{{ $att->id }}">{{ $att->filename }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Select File</label>
                <input type="file" name="document" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Notes (optional)</label>
                <textarea name="notes" class="form-control"></textarea>
            </div>

            <button class="btn btn-primary">Upload</button>

        </form>

    </div>

@endsection
