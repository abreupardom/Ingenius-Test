@extends('layouts.app')

@section('template_title')
    Proyectos
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Proyectos') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('proyectos.create') }}" class="btn btn-primary btn-sm float-right"
                                   data-placement="left">
                                    {{ __('Crear nuevo proyecto') }}
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
                                    <th>Descripci&oacute;n</th>
                                    <th>Archivado</th>
                                    {{--<th >Usuario Id</th>--}}

                                    <th></th>
                                </tr>
                                <tr>
                                    {{--formulario para los filtros--}}
                                    <form id="filtro" method="GET" action="{{ route('proyectos.store') }}" role="form">
                                        @csrf
                                        <th></th>
                                        <th><select name="nombre"
                                                    class="form-control select2" {{--onchange="this.form.submit()"--}}>
                                                <option></option>
                                                @foreach($proyectos as $proyecto )
                                                    <option
                                                            value="{{$proyecto->nombre}}" {{ $proyecto->nombre == $nombre ? 'selected' : '' }}>{{$proyecto->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <th><select name="descripcion"
                                                    class="form-control select2" {{--onchange="this.form.submit()"--}}>
                                                <option></option>
                                                @foreach($proyectos as $proyecto )
                                                    <option
                                                            value="{{$proyecto->descripcion}}" {{ $proyecto->descripcion == $descripcion ? 'selected' : '' }}>{{$proyecto->descripcion}}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <th>
                                        </th>
                                        <th></th>
                                    </form>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($proyectos as $proyecto)
                                    <tr>
                                        <td>{{ ++$i }}</td>

                                        <td>{{ $proyecto->nombre }}</td>
                                        <td>{{ $proyecto->descripcion }}</td>
                                        <td>{{ $proyecto->archivado?'Si':'No' }}</td>
                                        {{--<td >{{ $proyecto->usuario_id }}</td>--}}

                                        <td>
                                            <form action="{{ route('proyectos.destroy', $proyecto->id) }}"
                                                  method="POST">
                                                <a class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                                   data-bs-title="Mostrar detalles"
                                                   href="{{ route('proyectos.show', $proyecto->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>
                                                <a class="btn btn-sm btn-success" data-bs-toggle="tooltip"
                                                   data-bs-title="Actualizar proyecto"
                                                   href="{{ route('proyectos.edit', $proyecto->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Actualizar') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-title="Eliminar proyecto"
                                                        onclick="event.preventDefault(); confirm('Esta usted seguro de eliminar este proyecto? De hacerlo se eliminarán todas las tareas asociadas a este.') ? this.closest('form').submit() : false;">
                                                    <i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {!! $proyectos->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
