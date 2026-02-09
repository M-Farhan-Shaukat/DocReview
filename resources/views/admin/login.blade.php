@extends('admin.layouts.app')

@section('title', 'Admin Login')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">

                    <h4 class="text-center mb-4">Admin Login</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.login.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control">
                                <span class="input-group-text" style="cursor: pointer" onclick="togglePassword()">
                                    <i id="passwordIcon" class="bi bi-eye"></i>
                                </span>
                            </div>
                        </div>

                        <button class="btn btn-dark w-100">Login</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
