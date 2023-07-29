@extends('layouts.backend.main')

@section('title')
{{ config('app.name') }} || Dashboard
@endsection

@section('content')
<div class="container-fluid">
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Home</li>
  </ol>
</nav>
 
 

</div>
@endsection
