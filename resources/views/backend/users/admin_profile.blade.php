@extends('layouts.backend.main')

@section('title')
{{ config('app.name') }} || User Profiles
@endsection
@section('content')
<div class="container-fluid">
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="">Users</a></li>
       <li class="breadcrumb-item active" aria-current="page">Profiles</li>
  </ol>
</nav>

  <section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
               <img src="{{ $adminProfile->profiles ? asset('images/'.$adminProfile->profiles) : asset('noimage.png') }}" alt="Logo" style="width:150px;">
            <h5 class="my-3">{{$adminProfile['name']}}</h5>
            <p class="text-muted mb-1">{{$adminProfile['type']}}</p>
            <p class="text-muted mb-4">{{$adminProfile['address']}}</p>
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body p-0">
            <ul class="list-group list-group-flush rounded-3">

              <li class="list-group-item d-flex align-items-center p-3">
                <i class="bi bi-facebook" style="color:#0d6efd;"></i> &nbsp;&nbsp;
                <p class="mb-0">{{$adminProfile['facebook']}}</p>
              </li>

              <li class="list-group-item d-flex align-items-center p-3">
                <i class="bi bi-instagram fa-lg" style="color: #333333;"></i> &nbsp;&nbsp;
                <p class="mb-0">{{$adminProfile['instagram']}}</p>
              </li>

              <li class="list-group-item d-flex align-items-center p-3">
                <i class="bi bi-twitter fa-lg" style="color: #55acee;"></i> &nbsp;&nbsp;
                <p class="mb-0">{{$adminProfile['twitter']}}</p>
              </li>

            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$adminProfile['name']}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$adminProfile['email']}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$adminProfile['contact']}}</p>
              </div>
            </div>
  
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$adminProfile['address']}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Gender</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$adminProfile['gender']}}</p>
              </div>
            </div>

            <hr>
            <div class="row">
              <div class="col-sm-12">
                <p class="mb-0"><b>Information</b></p>
              </div>
              <div class="col-sm-12">
                <p class="text-muted mb-0">{{$adminProfile['bio']}}</p>
              </div>
            </div>


            
          </div>
        </div>
     
      </div>
    </div>
  </div>
</section>

</div>
@endsection
