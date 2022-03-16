@extends('layouts.master')

@section('title', 'Inicio')

@section('link')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ url('/static/adminlte/plugins/summernote/summernote-bs4.min.css') }}">
    <script src="{{ url('/static/adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('/static/admin.js?v=' . time()) }}"></script>
    <script src="{{ url('/static/sweetalert.min.js?v=' . time()) }}"></script>
@stop

@section('header_name')
    <h1>Inicio</h1>
@stop

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item active">Feed</li>
@stop


@section('menu_sidebar')
    <li class="nav-item">
        <a href="/feeds" class="nav-link">
            <i class="nav-icon far fa-calendar-alt"></i>
            <p>
                Inicio
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/account/edit" class="nav-link">
            <i class="nav-icon far fa-calendar-alt"></i>
            <p>
                Editar cuenta
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

    {!! Form::open(['url' => '/newpost']) !!}
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <textarea id="summernote" name="content_post"></textarea>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary mt-4">Publicar 😀</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if (is_null(Auth::user()->avatar))
                                    <img width="128" class="img-circle img-bordered-sm"
                                        src="{{ url('/static/images/default-user.jpg') }}">
                                @else
                                    <img width="128" class="img-circle img-bordered-sm"
                                        src="{{ url('/static/uploads_user/' . Auth::user()->id . '/av_' . Auth::user()->avatar) }}"
                                        alt="">
                                @endif

                            </div>

                            <h3 class="profile-username text-center text-capitalize">{{ Auth::user()->fullname }}</h3>

                            <p class="text-muted text-center">{{ Auth::user()->email }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Nacionalidad</b>
                                    <a class="float-right">
                                        @if (is_null(Auth::user()->nationality))
                                            Aun por definir
                                        @else
                                            {{ Auth::user()->country->name }}
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Fecha de Nacimiento</b>
                                    <a class="float-right">
                                        @if (is_null(Auth::user()->birthday))
                                            Aun por definir
                                        @else
                                            {{ date('d-m-Y', strtotime(Auth::user()->birthday)) }}
                                        @endif
                                    </a>
                                </li>
                            </ul>

                            <a href="{{ url('/account/edit') }}" class="btn btn-primary btn-block"><b>Editar
                                    Perfil</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    @foreach ($reads as $read)
                                        <!-- Post -->
                                        <div class="post clearfix">
                                            <div class="user-block">
                                                @if (is_null($read->user->avatar))
                                                    <img class="img-circle img-bordered-sm"
                                                        src="{{ url('/static/images/default-user.jpg') }}">
                                                @else
                                                    <img class="img-circle img-bordered-sm"
                                                        src="{{ url('/static/uploads_user/' . $read->user_id . '/av_' . $read->user->avatar) }}"
                                                        alt="">
                                                @endif
                                                <span class="username">
                                                    <a href="{{ url('/account/edit') }}">
                                                        @if (is_null($read->user->fullname))
                                                            {{ $read->user->email }}
                                                        @else
                                                            <span
                                                                class="text-capitalize">{{ $read->user->fullname }}</span>
                                                        @endif
                                                    </a>

                                                    @role('Super-Admin')
                                                        <a href="#" class="float-right btn-tool btn-deleted bold"
                                                            data-path="post" data-object="{{ $read->id }}"
                                                            data-action="delete"><i class="fas fa-times"></i></a>
                                                        <br><br>
                                                        <a href="{{ url('/post/' . $read->id . '/edit') }}"
                                                            class="float-sm-right btn-tool"><i class="fas fa-edit"></i></a>
                                                    
                                                    @endrole
                                                    @role('usuario')
                                                        <a href="#" class="float-right btn-tool btn-deleted bold"
                                                            data-path="post" data-object="{{ $read->id }}"
                                                            data-action="delete"><i class="fas fa-times"></i></a>
                                                        <br><br>
                                                        <a href="{{ url('/post/' . $read->id . '/edit') }}"
                                                            class="float-sm-right btn-tool"><i
                                                                class="fas fa-edit"></i></a>
                                                    @endrole

                                                </span>
                                                <span class="description">Publicado - {!! $read->updated_at->diffForHumans() !!}</span>
                                            </div>
                                            <!-- /.user-block -->
                                            <p>
                                                {!! html_entity_decode($read->body) !!}
                                            </p>

                                            {!! Form::open(['url' => '/new/comment/' . $read->id, 'class' => 'form-horizontal']) !!}
                                            <div class="input-group input-group-sm mb-0">
                                                <input class="form-control form-control-sm"
                                                    placeholder="Escribe un comentario" name="comment_body">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-danger">Send</button>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="well">
                                                    @foreach ($read->comment as $c)
                                                        <div class="callout callout-danger">

                                                            <p>
                                                                @if (is_null($c->user->avatar))
                                                                    <img width="30" class="img-circle img-bordered-sm"
                                                                        src="{{ url('/static/images/default-user.jpg') }}">
                                                                @else
                                                                    <img width="30" class="img-circle img-bordered-sm"
                                                                        src="{{ url('/static/uploads_user/' . $c->user_id . '/av_' . $c->user->avatar) }}"
                                                                        alt="">
                                                                @endif
                                                                @role('Super-Admin')
                                                                    <a href="#" class="float-right btn-tool btn-deleted"
                                                                        data-path="comment" data-object="{{ $c->id }}"
                                                                        data-action="delete"><i
                                                                            class="fas fa-times"></i></a><br>
                                                                    <a href="#" data-toggle="modal"
                                                                        data-target="#editModal{{ $c->id }}"
                                                                        class="float-sm-right btn-tool"><i
                                                                            class="fas fa-edit"></i></a>
                                                                @endrole
                                                                @role('usuario')
                                                                        <a href="#" class="float-right btn-tool btn-deleted"
                                                                            data-path="comment"
                                                                            data-object="{{ $c->id }}"
                                                                            data-action="delete"><i
                                                                                class="fas fa-times"></i></a><br>

                                                                        <a href="#" data-toggle="modal"
                                                                            data-target="#editModal{{ $c->id }}"
                                                                            class="float-sm-right btn-tool"><i
                                                                                class="fas fa-edit"></i></a>
                                                                @endrole
                                                                {{ $c->body }} -
                                                                {!! $c->created_at->diffForHumans() !!}
                                                                @include('model_comment_edit')
                                                            </p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.post -->
                                    @endforeach
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@stop


@section('js')
    <!-- Summernote -->
    <script src="{{ url('/static/adminlte/plugins/summernote/summernote-bs4.js') }}"></script>
    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote()
        })
    </script>
@show
