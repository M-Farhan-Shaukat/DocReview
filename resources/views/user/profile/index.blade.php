@extends('user.layouts.app')

@section('content')

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>User Profile</h3>
            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Back</a>
        </div>

        {{-- Success message --}}
        <div id="successMsg" class="alert alert-success" style="display:none;"></div>

        <form id="profileForm">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" class="form-control">
                <div class="invalid-feedback" id="error_name"></div>
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" id="email"  value="{{ old('email', auth()->user()->email) }}" class="form-control">
                <div class="invalid-feedback" id="error_email"></div>
            </div>

            {{-- Age --}}
            <div class="mb-3">
                <label class="form-label">Age</label>
                <input type="number" name="age" id="age"   value="{{ old('age', auth()->user()->age) }}" class="form-control">
                <div class="invalid-feedback" id="error_age"></div>
            </div>

            {{-- City --}}
            <div class="mb-3">
                <label class="form-label">City</label>
                <input type="text" name="city" id="city" value="{{ old('city', auth()->user()->city) }}" class="form-control">
                <div class="invalid-feedback" id="error_city"></div>
            </div>

            {{-- Phone --}}
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', auth()->user()->phone) }}" class="form-control">
                <div class="invalid-feedback" id="error_phone"></div>
            </div>

            {{-- CNIC --}}
            <div class="mb-3">
                <label class="form-label">CNIC</label>
                <input type="text" name="cnic" id="cnic" value="{{ old('cnic', auth()->user()->cnic) }}" class="form-control">
                <div class="invalid-feedback" id="error_cnic"></div>
            </div>

            {{-- Postal Code --}}
            <div class="mb-3">
                <label class="form-label">Postal Code</label>
                <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', auth()->user()->postal_code) }}" class="form-control">
                <div class="invalid-feedback" id="error_postal_code"></div>
            </div>

            <hr>

            {{-- Change Password Switch --}}
            <div class="form-check form-switch mb-3">
                <input class="form-check-input"
                       type="checkbox"
                       id="changePasswordSwitch"
                       name="change_password"
                       value="1">

                <label class="form-check-label">
                    Change Password
                </label>
            </div>

            {{-- Password Fields --}}
            <div id="passwordFields" style="display:none;">
                {{-- Current Password --}}
                <div class="mb-3">
                    <label class="form-label">Current Password</label>
                    <div class="input-group">
                        <input type="password" name="current_password" id="current_password" class="form-control">
                        <button type="button" class="btn btn-outline-secondary"
                                onclick="togglePassword('current_password', this)">👁</button>
                        <div class="invalid-feedback" id="error_current_password"></div>
                    </div>
                </div>

                {{-- New Password --}}
                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control">
                        <button type="button" class="btn btn-outline-secondary"
                                onclick="togglePassword('password', this)">👁</button>
                        <div class="invalid-feedback" id="error_password"></div>
                    </div>
                </div>

                {{-- Confirm Password --}}
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        <button type="button" class="btn btn-outline-secondary"
                                onclick="togglePassword('password_confirmation', this)">👁</button>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>

        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function(){

            // switch toggle
            $('#changePasswordSwitch').on('change', function(){

                if($(this).is(':checked')){
                    $('#passwordFields').slideDown();
                }
                else{
                    $('#passwordFields').slideUp();
                }

            });


            $('#profileForm').submit(function(e){

                e.preventDefault();

                // clear errors
                $('.invalid-feedback').text('');
                $('.form-control').removeClass('is-invalid');
                $('#successMsg').hide();

                $.ajax({

                    url: "{{ route('user.profile.update') }}",
                    type: "POST",
                    data: $(this).serialize(),

                    success: function(res){

                        $('#successMsg')
                            .text(res.message)
                            .show();

                        // reset password fields only on success
                        $('#current_password').val('');
                        $('#password').val('');
                        $('#password_confirmation').val('');

                        $('#changePasswordSwitch').prop('checked', false);
                        $('#passwordFields').hide();

                    },

                    error: function(xhr){

                        if(xhr.status === 422){

                            let errors = xhr.responseJSON.errors;

                            // show password fields if password error exists
                            if(errors.current_password || errors.password){

                                $('#changePasswordSwitch').prop('checked', true);
                                $('#passwordFields').show();

                            }

                            $.each(errors, function(key, value){

                                $('#'+key).addClass('is-invalid');
                                $('#error_'+key).text(value[0]);

                            });

                        }

                    }

                });

            });

        });


        // Toggle password visibility
        function togglePassword(fieldId, btn){
            let field = document.getElementById(fieldId);
            if(field.type === 'password'){
                field.type = 'text';
                btn.innerHTML = '🙈';
            } else {
                field.type = 'password';
                btn.innerHTML = '👁';
            }
        }
    </script>

@endsection
