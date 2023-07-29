@extends('layouts.backend.main')

@section('title')
{{ config('app.name') }} || Update Profiles
@endsection

@section('content')
<div class="container-fluid">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Password</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card rounded-0">
                <div class="card-header bg-primary">
                    <div class="card-title text-light">Update Password</div>
                </div>
                <form id="change-password-form">@csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-sm-12 mb-4">
                                <label>Email address</label>
                                <input type="email" class="form-control" value="{{Auth::guard('admin')->user()->email}}" readonly>
                            </div>

                            <div class="form-group col-sm-12 mb-4">
                                <label>User Name</label>
                                <input type="text" class="form-control" value="{{Auth::guard('admin')->user()->name}}" readonly>
                            </div>

                            <div class="form-group col-sm-12 mb-4">
                                <label>Current Password</label>
                                <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Current Password">
                                <span class="passwordShow">
                                    <i class="bi bi-eye-slash" id="eye" onclick="toggle()"></i>
                                </span>
                            </div>

                            <div class="form-group col-sm-12 mb-4">
                                <label>New Password</label>
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password">
                                <span class="passwordShow">
                                    <i class="bi bi-eye-slash" id="eye1" onclick="toggle1()"></i>
                                </span>
                            </div>

                            <div class="form-group col-sm-12 mb-4">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation" placeholder="Confirm Password">
                                <span class="passwordShow">
                                    <i class="bi bi-eye-slash" id="eye2" onclick="toggle2()"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit"> Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
    function toggle() {
        var passwordInput = document.getElementById("current_password");
        var eyeIcon = document.getElementById("eye");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.className = "bi bi-eye";
        } else {
            passwordInput.type = "password";
            eyeIcon.className = "bi bi-eye-slash";
        }
    }

    function toggle1() {
        var passwordInput = document.getElementById("new_password");
        var eyeIcon = document.getElementById("eye1");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.className = "bi bi-eye";
        } else {
            passwordInput.type = "password";
            eyeIcon.className = "bi bi-eye-slash";
        }
    }

    function toggle2() {
        var passwordInput = document.getElementById("new_password_confirmation");
        var eyeIcon = document.getElementById("eye2");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.className = "bi bi-eye";
        } else {
            passwordInput.type = "password";
            eyeIcon.className = "bi bi-eye-slash";
        }
    }

     $(document).ready(function () {

        $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });

        $('#change-password-form').submit(function (e) {
            e.preventDefault();
            $(this).find("span.text-danger").remove();
            $.ajax({
                url: "{{ route('update.password') }}",
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                     toastr.success(response.msg, 'Success');

                },
                error: function (response) {
                    if (response.status === 422) {
                        $.each(response.responseJSON.errors, function (field_name, error) {
                            $('[name=' + field_name + ']').after('<span class="text-strong text-danger">' + error + '</span>');
                        });
                    } else {
                         toastr.error("An error occurred. Please try again later.", "Error");
                    }
                }
            });
        });
    });
</script>
@endpush
