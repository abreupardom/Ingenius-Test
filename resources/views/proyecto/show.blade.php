@extends('layouts.app')

@section('template_title')
    {{ $proyecto->name ?? __('Show') . " " . __('Proyecto') }}
@endsection
@section('content')
    <section class="content container">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"
                         style="display: flex; justify-content: space-between; align-items: center;">

                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} Proyecto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm"
                               href="{{ route('proyectos.index') }}"> {{ __('Atrás') }}</a>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre:</strong>
                            {{ $proyecto->nombre }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Descripcion:</strong>
                            {{ $proyecto->descripcion }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Archivado:</strong>
                            {{ $proyecto->archivado ? 'Si':'No' }}
                        </div>
                        {{-- <div class="form-group mb-2 mb20">--}}
                        {{--   <strong>Usuario Id:</strong>--}}
                        {{--   {{ $proyecto->usuario_id }}--}}
                        {{--</div>--}}

                    </div>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                @if ($proyecto->archivado) disabled @endif>
            <i class="fa fa-plus-circle"></i> Adicionar Tareas
        </button>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <p>{{ $message }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                 <span id="card_title">
                     {{ __('Tareas') }}
                 </span>
            </div>
            <div class="card-body bg-white">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead">
                        <tr>
                            <th>No</th>

                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Prioridad</th>
                            <th>Proyecto</th>

                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($listaTareas as $tarea)
                            <tr>
                                <td>{{ ++$i }}</td>

                                <td>{{ $tarea->nombre }}</td>
                                <td>{{ $tarea->estado }}</td>
                                <td>{{ $tarea->prioridad }}</td>
                                <td>{{ $tarea->proyecto->nombre }}</td>

                                <td>
                                    @if(!$proyecto->archivado)
                                        <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary "
                                               href="{{ route('tareas.show', $tarea->id) }}"><i
                                                    class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>
                                            <a class="btn btn-sm btn-success"
                                               href="{{ route('tareas.edit', $tarea->id) }}"><i
                                                    class="fa fa-fw fa-edit"></i> {{ __('Actualizar') }}</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="event.preventDefault(); confirm('Esta usted seguro de eliminar esta tarea?') ? this.closest('form').submit() : false;">
                                                <i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $listaTareas->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Crear tareas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('tareas.store') }}" role="form"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row padding-1 p-1">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group mb-2 mb20 col-lg-6">
                                            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
                                            <input type="text" name="nombre"
                                                   class="form-control @error('nombre') is-invalid @enderror"
                                                   value="{{ old('nombre', '') }}" id="nombre"
                                                   placeholder="Nombre">
                                            {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                        </div>
                                        <div class="form-group mb-2 mb20 col-lg-6">
                                            <label for="estado" class="form-label">{{ __('Estado') }}</label>
                                            <select name="estado" id="estado" class="form-control">
                                                <option value="Pendiente">Pendiente</option>
                                                <option value="En progreso">En progreso</option>
                                                <option value="Completada">Completada</option>
                                            </select>
                                            {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group mb-2 mb20 col-lg-6">
                                            <label for="prioridad" class="form-label">{{ __('Prioridad') }}</label>
                                            <select name="prioridad" id="prioridad" class="form-control">
                                                <option value="Media">Media</option>
                                                <option value="Baja">Baja</option>
                                                <option value="Alta">Alta</option>
                                            </select>
                                            {!! $errors->first('prioridad', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                        </div>
                                        <div class="form-group mb-2 mb20 col-lg-6">
                                            <label for="proyecto_id" class="form-label">{{ __('Proyecto') }}</label>
                                            <select name="proyecto_id" id="proyecto_id" class="form-control">
                                                <option value={{$proyecto->id}}>{{$proyecto->nombre}}</option>
                                            </select>
                                            {!! $errors->first('proyecto_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt20 mt-2">
                                    <button name="guardartarea" type="submit"
                                            class="btn btn-primary float-end">{{ __('Guardar') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer collapse">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
