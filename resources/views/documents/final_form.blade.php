@extends('user.layouts.app')

@section('content')
    <div class="container mt-4">

        <div class="card shadow-sm">
            <div class="card-body">

                <h4 class="mb-3">Review Final Document</h4>

                {{-- Document Preview --}}
                @if($finalDocument)
                    <div class="border rounded mb-4" style="height:600px;">
                        <iframe
                            src="{{ route('user.final.preview') }}"
                            width="100%"
                            height="100%"
                            style="border:none;">
                        </iframe>
                    </div>
                @endif

                {{-- Submit Form --}}
                <form method="POST" action="{{ route('user.final.submit') }}">
                    @csrf

                    <div class="form-check mb-3">
                        <input type="checkbox"
                               class="form-check-input"
                               required>
                        <label class="form-check-label">
                            I have reviewed the document and confirm it is correct.
                        </label>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Submit to Admin
                    </button>

                </form>

            </div>
        </div>

    </div>

@endsection
