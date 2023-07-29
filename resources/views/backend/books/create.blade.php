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
            <li class="breadcrumb-item active" aria-current="page">Books Create</li>
        </ol>
    </nav>
   
    <div class="row">

         <div class="col-md-12 py-2">
            <div class="card rounded-0">
                <div class="card-header bg-primary">
                    <div class="card-title">
                        <a href="{{route('books.index')}}" class="text-light btn btn-success btn-sm"><i class="bi bi-list"></i> View Books List</a>
                    </div>
                </div>
                 @include('backend.books.form')
            </div>
        </div>

    
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#booksStore').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        // Convert 'tags' to a comma-separated string and add it to FormData as 'tags' field
        formData.append('tags', $('#tags').val());

        $(document).find("span.text-danger").remove();
        $.ajax({
            type:'POST',
            url: "{{ route('books.store') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response) {
                    this.reset();
                    toastr.success(response.msg, 'Success');
                    window.location.href = '/admin/books';
                }
            },
            error: function(response) {
                if (response.responseJSON && response.responseJSON.error) {
                    toastr.error(response.responseJSON.error, 'Error');
                }
                else if (response.responseJSON && response.responseJSON.errors) {
                    $.each(response.responseJSON.errors, function(field_name, error) {
                        if (field_name === 'tags') {
                            // Handle 'tags' field validation errors
                            $(document).find('#tags').after('<span class="text-danger">' + error[0] + '</span>');
                        } else if (field_name === 'author_id') {
                            // Handle 'author_id' field validation errors (checkboxes)
                            $(document).find('#author').after('<span class="text-danger">' + error[0] + '</span>');
                        } else {
                            // Handle other field validation errors
                            $(document).find('[name="' + field_name + '"]').after('<span class="text-danger">' + error + '</span>');
                        }
                    });
                }
                else {
                    toastr.error('Failed to create data.', 'Error');
                }
            }
        });
    });
</script>


@endpush
