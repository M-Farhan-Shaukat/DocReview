@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Preview Your Form</h2>

        <table class="table table-bordered">
            @foreach($validated as $key => $value)
                @if(!in_array($key, ['cnic_copy', 'deposit_copy']))
                    <tr>
                        <th>{{ ucfirst(str_replace('_', ' ', $key)) }}</th>
                        <td>{{ $value }}</td>
                    </tr>
                @endif
            @endforeach
        </table>

        @if(isset($validated['cnic_copy']))
            <p><strong>CNIC Copy:</strong></p>
            <img src="{{ asset('storage/'.$validated['cnic_copy']) }}" width="200">
        @endif

        @if(isset($validated['deposit_copy']))
            <p><strong>Deposit Copy:</strong></p>
            <img src="{{ asset('storage/'.$validated['deposit_copy']) }}" width="200">
        @endif

        <form method="POST" action="{{ route('final-form.store') }}">
            @csrf

            @foreach($validated as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach

            <button type="submit" class="btn btn-success">
                Confirm & Submit
            </button>
        </form>

        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-2">
            Go Back & Edit
        </a>
    </div>
@endsection
