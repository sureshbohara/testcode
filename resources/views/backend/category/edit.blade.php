@extends('layouts.backend.main')
@section('title')
{{ config('app.name') }} || Category
@endsection
@section('content')
<div class="container-fluid">

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('category.index')}}">Category</a></li>
            <li class="breadcrumb-item active" aria-current="page">Category Update</li>
        </ol>
    </nav>
   
    <div class="row">

         <div class="col-md-12 py-2">
            <div class="card rounded-0">
                <div class="card-header bg-primary">
                    <div class="card-title">
                        <a href="{{route('category.index')}}" class="text-light btn btn-success btn-sm"><i class="bi bi-list"></i> View Category List</a>
                    </div>
                </div>
                 @include('backend.category.edit_form')
            </div>
        </div>

    
    </div>
</div>
@endsection
