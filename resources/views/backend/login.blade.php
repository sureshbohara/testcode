<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
   <link rel="stylesheet" href="{{asset('backend/login.css')}}">
   <link rel="stylesheet" href="{{asset('backend/toastr.css')}}">

    <!-- CSS -->
   <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
   <script src="{{asset('backend/toastr.js')}}"></script>
</head>
<body>

  <div class="center-card">
    <div class="col-md-4 col-offset-4">
      <div class="card  border-0">
        <div class="card-header bg-success">
          <h4 class="card-title text-light text-center">{{ __('Admin Login') }}</h4>
        </div>

        <div class="card-body">
          <form id="loginUser">@csrf
             <div class="mb-3">
              <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" @if(isset($_COOKIE["email"])) value="{{$_COOKIE["email"]}}" @endif>
               @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">{{ __('Password') }}</label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" @if(isset($_COOKIE["password"])) value="{{$_COOKIE["password"]}}" @endif>
              <span class="passwordShow">
                <i class="bi bi-eye-slash" id="eye"></i>
              </span>
               @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3 form-check">
              <input type="checkbox" id="remember" name="remember" @if(isset($_COOKIE["email"])) checked="" @endif>
              <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
              </label>
            </div>

            <button type="submit" class="btn btn-success rounded-0">
              <i class="bi bi-box-arrow-in-right"></i>
              {{ __('Login Process') }}
            </button>

  
          
          </form>
        </div>
      </div>
    </div>
  </div>
  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
     
    $('#loginUser').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $(document).find("span.text-danger").remove();

        $.ajax({
          type: 'POST',
          url: "{{ route('admin.login') }}",
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            if (response.status === 200) {
              toastr.success(response.msg, 'Success');
              window.location.href = "/admin/dashboard";
            } else {
              toastr.error(response.msg, 'Error');
            }
          },
          error: function(response) {
            $.each(response.responseJSON.errors, function(field_name, error) {
              $('[name="' + field_name + '"]').after('<span class="text-strong text-danger">' + error + '</span>');
            });
          }
        });
      });

    $('#eye').click(function() {
      var passwordInput = $('#password');
      var eyeIcon = $(this);
      if (passwordInput.attr('type') === 'password') {
        passwordInput.attr('type', 'text');
        eyeIcon.removeClass('bi-eye-slash').addClass('bi-eye');
      } else {
        passwordInput.attr('type', 'password');
        eyeIcon.removeClass('bi-eye').addClass('bi-eye-slash');
      }
    });
  });
</script> 
<script>
    @if(session('toastr_message'))
        toastr.success('{{ session('toastr_message') }}');
    @endif
</script>

</body>
</html>
