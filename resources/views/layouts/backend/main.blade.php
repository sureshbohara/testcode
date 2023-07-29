<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Store</title>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <link rel="stylesheet" href="{{asset('backend/style.css')}}">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
   <link rel="stylesheet" href="{{asset('backend/toastr.css')}}">

  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-toggle@2.2.2/css/bootstrap-toggle.min.css">
  
   <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
   <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

   <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
   <script src="{{asset('backend/toastr.js')}}"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

</head>
<body>

  <header>
    @include('layouts.backend.header')
  </header>

  <main>
    @yield('content')
  </main>

  <!-- <footer>
    @include('layouts.backend.footer')
  </footer> -->
  <script type="text/javascript" src="{{asset('backend/script.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
   
      


 <script>
  $('.editor').summernote({
   placeholder: 'Type Your Message',
   tabsize: 2,
   height: 200
 });
</script>
<script type="text/javascript">
    $( '.select2' ).select2( {
    theme: 'bootstrap-5'
} );
</script>

<script>
  let img = document.getElementById('img');
  let input = document.getElementById('input');
  input.onchange = (e) => {
    if (input.files[0]) {
      img.src = URL.createObjectURL(input.files[0]);
    }
  };
</script>

<script>
    function confirmDelete(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm').submit();
            }
        });
    }
</script>

<script>
    document.getElementById('updateStore').addEventListener('submit', function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit();
            }
        });
    });
</script>


<script type="text/javascript">  
  toastr.options = {
  timeOut: 1000,
  extendedTimeOut: 0,
  closeButton: true,
  closeDuration: 300,
  closeEasing: 'swing'
};
</script>

 <script>
    @if(session('toastr_message'))
        toastr.options = {
            timeOut: 1000,
            extendedTimeOut: 0,
            closeButton: true,
            closeDuration: 300,
            closeEasing: 'swing'
        };
        toastr.success('{{ session('toastr_message') }}');
    @endif
</script>



<script>
    var inputtags = document.querySelector("#tags");
    new Tagify(inputtags, {
        whitelist: ["Classics","Horror","Historical Fiction","Detective and Mystery",'Literary Fiction'],
        maxTags: 15,
        dropdown: {
            maxItems: 15,         
            classname: "", 
            enabled: 0,         
            closeOnSelect: false
        }
    });
</script>
@stack('scripts')
</body>
</html>
