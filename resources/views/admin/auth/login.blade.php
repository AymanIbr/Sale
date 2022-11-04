<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>تسجيل الدخول</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- SweetAlert2 -->
  {{-- <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}"> --}}
  <!-- Toastr -->
  {{-- <link rel="stylesheet" href="{{ asset('admin/plugins/toastr/toastr.min.css') }}"> --}}
  <link rel="stylesheet" href="{{ asset('public_asset/css/bootstrap_rtl-v4.2.1/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public_asset/css/bootstrap_rtl-v4.2.1/custom_rtl.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('public_asset/css/bootstrap_rtl-v4.2.1/custom_rtl.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('public_asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public_asset/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">تسجيل الدخول</p>

      <form action="{{ route('admin.login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="User Name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          @error('username')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          @error('password')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit"  class="btn btn-primary btn-block btn-flat">تسجيل الدخول</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
{{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- SweetAlert2 -->
{{-- <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script> --}}
<!-- Toastr -->
{{-- <script src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></scrip --}}
<!-- jQuery -->
<script src="{{ asset('public_asset/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('public_asset/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
