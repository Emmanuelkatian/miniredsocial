<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/static/adminlte/plugins/fontawesome-free/css/all.min.css?v='.time()) }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ url('/static/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css?v='.time()) }}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/static/adminlte/dist/css/adminlte.min.css?v='.time()) }}">

  <!-- jQuery -->
<script src="{{ url('/static/adminlte/plugins/jquery/jquery.min.js?v='.time()) }}"></script>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  @if (Session::has('message'))
            <div class="container">
                <div class="alert alert-{{ Session::get('typealert') }}" style="display: none">
                    {{ Session::get('message') }}
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <script>
                        $('.alert').slideDown();
                        setTimeout(function() {
                            $('.alert').slideUp();
                        }, 10000);
                    </script>
                </div>
            </div>
        @endif
  <div class="register-logo">
    <a href="{{ url('/') }}"><b>Prueba 789</b>Login</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Registrar una nueva membresía</p>

      {!! Form::open(['url' => '/register']) !!}
        <div class="input-group mb-3">
            {!! Form::email('email', null, ['class' => 'form-control', 'required', 'placeholder' => 'Email']) !!}
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            {!! Form::password('password', ['class' => 'form-control', 'required','placeholder' => 'Contraseña']) !!}
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            {!! Form::password('cpassword', ['class' => 'form-control', 'required', 'placeholder' => 'Repita la Contraseña']) !!}
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
        {!! Form::close() !!}

      <a href="{{ url('/login') }}" class="text-center">Ya tengo cuenta</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->


<!-- Bootstrap 4 -->
<script src="{{ url('/static/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js?v='.time()) }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('/static/adminlte/dist/js/adminlte.min.js?v='.time()) }}"></script>
</body>
</html>
