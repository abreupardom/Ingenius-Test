@extends('layouts.app')

@section('template_title')
    Tareas
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Tareas') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('tareas.create') }}" class="btn btn-primary btn-sm float-right"
                                   data-placement="left">
                                    {{ __('Crear nueva tarea') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4 alert-dismissible fade show">
                            <p>{{ $message }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

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
                                <tr>
                                    {{--formulario para los filtros--}}
                                    <form id="filtro" method="GET" action="{{ route('tareas.store') }}" role="form">
                                        @csrf
                                        <th></th>
                                        <th><select name="nombre"
                                                    class="form-control select2" {{--onchange="this.form.submit()"--}}>
                                                <option></option>
                                                @foreach($tareas as $tarea )
                                                    <option
                                                        value="{{$tarea->nombre}}" {{ $tarea->nombre == $nombre ? 'selected' : '' }}>{{$tarea->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <th><select name="estado"
                                                    class="form-control select2" {{--onchange="this.form.submit()"--}}>
                                                <option></option>
                                                @foreach($tareas as $tarea )
                                                    <option
                                                        value="{{$tarea->estado}}" {{ $tarea->estado == $estado ? 'selected' : '' }}>{{$tarea->estado}}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <th><select name="prioridad"
                                                    class="form-control select2" {{--onchange="this.form.submit()"--}}>
                                                <option></option>
                                                @foreach($tareas as $tarea )
                                                    <option
                                                        value="{{$tarea->prioridad}}" {{ $tarea->prioridad == $prioridad ? 'selected' : '' }}>{{$tarea->prioridad}}</option>
                                                @endforeach
                                            </select></th>
                                        <th><select name="proyecto_id"
                                                    class="form-control select2" {{--onchange="this.form.submit()"--}}>
                                                <option></option>
                                                @foreach($tareas as $tarea )
                                                    <option
                                                        value="{{$tarea->proyecto_id}}" {{ $tarea->proyecto_id == $proyecto_id ? 'selected' : '' }}>{{$tarea->proyecto->nombre}}</option>
                                                @endforeach
                                            </select>

                                        </th>
                                        <th></th>
                                    </form>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($tareas as $tarea)
                                    <tr>
                                        <td>{{ ++$i }}</td>

                                        <td>{{ $tarea->nombre }}</td>
                                        <td>{{$tarea->estado}}  {!! $tarea->iconoEstado() !!}</td>
                                        <td class="{{$tarea->colorPrioridad()}}">{{ $tarea->prioridad }}</td>
                                        <td><a class="btn btn-sm btn-outline-primary" data-bs-toggle="popover"
                                               data-bs-title="Detalles del proyecto"
                                               data-bs-trigger="hover"
                                               data-bs-html="true"
                                               data-bs-content="<ul>
                                                                   <li><strong>Nombre:</strong> {{$tarea->proyecto->nombre}}</li>{{--obtener con la llave forenea el nombre del proyecto--}}
                                                                   <li><strong>Descripcion:</strong> {{$tarea->proyecto->descripcion}}</li>{{--obtener con la llave forenea la descripcion del proyecto--}}
                                                                   <li><strong>Archivado:</strong> {{$tarea->proyecto->archivado?'Si':'No'}}</li>{{--obtener con la llave forenea esta archivado el proyecto--}}
                                                               </ul>"
                                               href="{{route('proyectos.show',$tarea->proyecto_id)}}">{{ $tarea->proyecto->nombre }}</a>{{--obtener con la llave forenea el nombre del proyecto--}}
                                        </td>
                                        <td>
                                            @if(!$tarea->proyecto->archivado)
                                                <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                                       data-bs-title="Mostrar detalles"
                                                       href="{{ route('tareas.show', $tarea->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>
                                                    <a class="btn btn-sm btn-success" data-bs-toggle="tooltip"
                                                       data-bs-title="Actualizar tarea"
                                                       href="{{ route('tareas.edit', $tarea->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Actualizar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            data-bs-toggle="tooltip" data-bs-title="Eliminar tarea"
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
                        {!! $tareas->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
