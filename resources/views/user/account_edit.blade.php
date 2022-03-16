@extends('layouts.master')

@section('title', 'Editar mi Cuenta')

@section('link')
    <link rel="stylesheet" href="{{ url('/static/adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ url('/static/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <script src="{{ url('/static/adminlte/plugins/jquery/jquery.min.js') }}"></script>
@stop

@section('header_name')
    <h1>Editar Perfil</h1>
@stop

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item active">Editar Perfil</li>
@stop

@section('menu_sidebar')
    <li class="nav-item">
        <a href="{{ url('/feeds') }}" class="nav-link">
            <i class="nav-icon far fa-calendar-alt"></i>
            <p>
                Inicio
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/account/edit') }}" class="nav-link">
            <i class="nav-icon far fa-calendar-alt"></i>
            <p>
                Editar Cuenta
            </p>
        </a>
    </li>
@stop

@section('main')
    @parent

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

    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Cambiar Contraseña</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    {!! Form::open(['url' => '/account/edit/password']) !!}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Contraseña Anterior</label>
                            {!! Form::password('apassword', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Contraseña Nueva</label>
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirmar Contraseña</label>
                            {!! Form::password('cpassword', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- /.card -->


            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Editar Información</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    {!! Form::open(['url' => '/account/edit/info']) !!}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre Completo</label>
                            {!! Form::text('fullname', Auth::user()->fullname, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Correo Electrónico</label>
                            {!! Form::text('email', Auth::user()->email, ['class' => 'form-control', 'disabled']) !!}
                        </div>

                        <div class="col-md-8">
                            <label for="module">Fecha de Nacimiento</label>
                            <div class="input-group">
                                {!! Form::number('day', $birthday[2], ['class' => 'form-control', 'min' => 1, 'max' => 31, 'required', 'placeholder' => '01']) !!}
                                <span class="ml-3"></span>

                                {!! Form::select('month', getMonths('list', null), $birthday[1], ['class' => 'form-select']) !!}
                                <span class="mr-3"></span>

                                {!! Form::number('year', $birthday[0], ['class' => 'form-control', 'min' => getUserYears()[1], 'max' => getUserYears()[0], 'required', 'placeholder' => '2021']) !!}

                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label for="module">Nacionalidad</label>
                            <select class="select2bs4" name="nationality" style="width: 100%;">
                                <option value="">
                                    @if(is_null($nationality))
                                        @else
                                        {{ $nationality }}
                                    @endif
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Avatar</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {!! Form::open(['url' => 'account/edit/avatar', 'id' => 'form_avatar', 'files' => true]) !!}
                <div class="card-body">
                    <div class="form-group">
                        @if (is_null(Auth::user()->avatar))
                            <img width="100" src="{{ url('/static/images/default-user.jpg') }}">
                        @else
                            <img src="{{ url('/static/uploads_user/' . Auth::id() . '/av_' . Auth::user()->avatar) }}"
                                alt="">
                        @endif
                        {!! Form::file('avatar', ['id' => 'input_file_avatar', 'accept' => 'image/*', 'class' => 'form-control mt-3']) !!}
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop

@section('js')
    <!-- Select2 -->
    <script src="{{ url('/static/adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4',
            ajax: {
                url: 'http://127.0.0.1:8000/api/country',
                dataType: 'json',
                delay: 220,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(data) {
                            return {
                                text: data.name,
                                id: data.id
                            }
                        })
                    };
                },
                cache: true
            }

        });
    </script>
@stop
