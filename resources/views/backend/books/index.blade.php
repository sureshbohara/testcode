@extends('layouts.backend.main')
@section('title')
{{ config('app.name') }} || Books
@endsection
@section('content')
<div class="container-fluid">

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('books.index')}}">Books</a></li>
            <li class="breadcrumb-item active" aria-current="page">Books List</li>
        </ol>
    </nav>
   
    <div class="row">

         <div class="col-md-12 py-2">
            <div class="card rounded-0">
                <div class="card-header bg-primary">
                    <div class="card-title">
                      
                        <a href="{{route('books.create')}}" class="text-light btn btn-success btn-sm"><i class="bi bi-plus-circle"></i> Add Books</a>
                       
                    </div>
                </div>
                 @include('backend.books.table')
            </div>
        </div>

    
    </div>
</div>
@endsection
@push('scripts')

<script>
    $(function() {
        $('[type="checkbox"]').on('change', function() {
            var status = $(this).prop('checked') ? 1 : 0;
            var id = $(this).closest('form').find('[name="status_id"]').val();
            $.ajax({
                url: "{{ route('status.books') }}",
                method: "POST",
                data: {
                    status: status,
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    toastr.success(response.msg, 'Success');
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
    });
</script>
@endpush
