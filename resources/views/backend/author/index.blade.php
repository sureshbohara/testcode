@extends('layouts.backend.main')
@section('title')
{{ config('app.name') }} || Author
@endsection
@section('content')
<div class="container-fluid">

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('author.index')}}">Author</a></li>
            <li class="breadcrumb-item active" aria-current="page">Author Manage</li>
        </ol>
    </nav>
   
    <div class="row">
        
    

        <div class="col-md-5 py-2">
            <div class="card rounded-0">

                <div class="card-header bg-primary">
                    <div class="card-title text-light">Create New Author</div>
                </div>
                @include('backend.author.form')
            </div>
        </div>

        <div class="col-md-7 py-2">
            <div class="card rounded-0">

                <div class="card-header bg-primary">
                    <div class="card-title text-light">Author List</div>
                </div>
                @include('backend.author.table')
            
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
    $('#authorStore').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $(document).find("span.text-danger").remove();
        $.ajax({
            type:'POST',
            url: "{{ route('author.store') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response) {
                    this.reset();
                    toastr.success(response.msg, 'Success');
                    window.location.reload();
                }
            },
            error: function(response) {
                if (response.responseJSON && response.responseJSON.error) {
                    toastr.error(response.responseJSON.error, 'Error');
                }
                else if (response.responseJSON && response.responseJSON.errors) {
                    $.each(response.responseJSON.errors, function(field_name, error) {
                        $(document).find('[name=' + field_name + ']').after('<span class="text-strong text-danger">' + error + '</span>');
                    });
                }
                else {
                    toastr.error('Failed to create data.', 'Error');
                }
            }
       });
    });
</script>


<script>
    $(function() {
        $('[type="checkbox"]').on('change', function() {
            var status = $(this).prop('checked') ? 1 : 0;
            var id = $(this).closest('form').find('[name="status_id"]').val();
            $.ajax({
                url: "{{ route('status.author') }}",
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
