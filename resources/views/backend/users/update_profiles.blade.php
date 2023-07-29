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
            <li class="breadcrumb-item active" aria-current="page">Update Profiles</li>
        </ol>
    </nav>
   
    <div class="card rounded-0">
        <div class="card-header bg-primary">
            <div class="card-title text-light">Update Profiles</div>
        </div>

        <div class="card-body">
            <form id="updateProfiles" enctype="multipart/form-data">@csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="card mb-4">
                            <div class="card-body text-center">

                                 <img src="{{ $adminDetails->profiles ? asset('images/'.$adminDetails->profiles) : asset('noimage.png') }}" alt="Logo" style="width:150px;" id="img">

                                <div class="form-group text-center">
                                    <label>Choose Profiles</label>
                                    <input type="file" name="profiles" class="form-control" id="input">
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-primary btn-sm" type="submit">Update Profiles</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="row">

                            <div class="form-group col-lg-3 col-12 mb-4">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control rounded-0" value="{{ $adminDetails['email'] }}" readonly />
                            </div>

                            <div class="form-group col-lg-3 col-12 mb-4">
                                <label>User Full Name</label>
                                <input type="text" name="name" class="form-control rounded-0" value="{{ $adminDetails['name'] }}" />
                            </div>

                            <div class="form-group col-lg-3 col-12 mb-4">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control rounded-0" value="{{ $adminDetails['address'] }}" />
                            </div>

                            <div class="form-group col-lg-3 col-12 mb-4">
                                <label>Contact</label>
                                <input type="text" name="contact" class="form-control rounded-0" value="{{ $adminDetails['contact'] }}" />
                            </div>

                            <div class="form-group col-lg-3 col-12 mb-4">
                              <label>Gender</label>
                              <select name="gender" class="form-control rounded-0">
                                  <option value="Male" {{ $adminDetails['gender'] == 'Male' ? 'selected' : '' }}>Male</option>
                                  <option value="Female" {{ $adminDetails['gender'] == 'Female' ? 'selected' : '' }}>Female</option>
                                  <option value="Other" {{ $adminDetails['gender'] == 'Other' ? 'selected' : '' }}>Other</option>
                              </select>
                          </div>

                            <div class="form-group col-lg-3 col-12 mb-4">
                                <label>Facebook</label>
                                <input type="text" name="facebook" class="form-control rounded-0" value="{{ $adminDetails['facebook'] }}" />
                            </div>

                            <div class="form-group col-lg-3 col-12 mb-4">
                                <label>Instagram</label>
                                <input type="text" name="instagram" class="form-control rounded-0" value="{{ $adminDetails['instagram'] }}" />
                            </div>

                            <div class="form-group col-lg-3 col-12 mb-4">
                                <label>Twitter</label>
                                <input type="text" name="twitter" class="form-control rounded-0" value="{{ $adminDetails['twitter'] }}" />
                            </div>

                            <div class="form-group col-lg-12">
                                <label>Bio</label>
                                <textarea name="bio" class="form-control rounded-0 editor">{!! $adminDetails['bio'] !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#updateProfiles').submit(function (e) {
            e.preventDefault();
            $(this).find("span.text-danger").remove();
            $.ajax({
                url: "{{ route('update.details') }}",
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
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
