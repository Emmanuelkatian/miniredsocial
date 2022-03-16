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

@section('bpostcrumb')
    <li class="bpostcrumb-item"><a href="/">Inicio</a></li>
    <li class="bpostcrumb-item active">Editar Publicación</li>
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

    {!! Form::open(['url' => '/post/' . $post->id . '/edit']) !!}
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <textarea id="summernote" name="content_post">{!! html_entity_decode($post->body) !!}</textarea>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary mt-4">Actualizar 😀</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    <section class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <!-- Post -->
                                <div class="post clearfix">
                                    <div class="user-block">
                                        @if (is_null($post->user->avatar))
                                            <img class="img-circle img-bordered-sm"
                                                src="{{ url('/static/images/default-user.jpg') }}">
                                        @else
                                            <img class="img-circle img-bordered-sm"
                                                src="{{ url('/static/uploads_user/' . $post->user_id . '/av_' . $post->user->avatar) }}"
                                                alt="">
                                        @endif
                                        <span class="username">
                                            <a href="{{ url('/account/edit') }}">
                                                @if (is_null($post->user->fullname))
                                                    {{ $post->user->email }}
                                                @else
                                                    <span class="text-capitalize">{{ $post->user->fullname }}</span>
                                                @endif
                                            </a>
                                            @if ($post->user_id == Auth::id())
                                                <a href="#" class="float-right btn-tool btn-deleted bold" data-path="post"
                                                    data-object="{{ $post->id }}" data-action="delete"><i
                                                        class="fas fa-times"></i></a>
                                                <br><br>
                                                <a href="{{ url('/post/' . $post->id . '/edit') }}"
                                                    class="float-sm-right btn-tool"><i class="fas fa-edit"></i></a>
                                                <!-- Small button groups (default and split) -->
                                            @endif

                                        </span>
                                        <span class="description">Publicado - {!! $post->updated_at->diffForHumans() !!}</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        {!! html_entity_decode($post->body) !!}
                                    </p>

                                    {!! Form::open(['url' => '/new/comment/' . $post->id, 'class' => 'form-horizontal']) !!}
                                    <div class="input-group input-group-sm mb-0">
                                        <input class="form-control form-control-sm" placeholder="Escribe un comentario"
                                            name="comment_body">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-danger">Send</button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="well">
                                            @foreach ($post->comment as $c)
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
                                                                data-action="delete"><i class="fas fa-times"></i></a><br>
                                                            <a href="#" data-toggle="modal"
                                                                data-target="#editModal{{ $c->id }}"
                                                                class="float-sm-right btn-tool"><i
                                                                    class="fas fa-edit"></i></a>
                                                        @endrole
                                                        @role('usuario')
                                                        <a href="#" class="float-right btn-tool btn-deleted"
                                                                data-path="comment" data-object="{{ $c->id }}"
                                                                data-action="delete"><i class="fas fa-times"></i></a><br>
                                                            <a href="#" data-toggle="modal"
                                                                data-target="#editModal{{ $c->id }}"
                                                                class="float-sm-right btn-tool"><i
                                                                    class="fas fa-edit"></i></a>
                                                        @endrole
                                                        {{ $c->body }} -
                                                        {!! $c->created_at->diffForHumans() !!}


                                                        <!-- Modal -->
                                                    <div class="modal fade" id="editModal{{ $c->id }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Editar
                                                                        Comentario
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    {!! Form::open(['url' => '/comment/' . $c->id . '/edit', 'class' => 'form-horizontal']) !!}
                                                                    <div class="input-group input-group-sm mb-0">
                                                                        <input class="form-control form-control-sm"
                                                                            value="{{ $c->body }}"
                                                                            name="comment_body">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cerrar</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Actualizar</button>
                                                                </div>
                                                                {!! Form::close() !!}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- /.post -->
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
