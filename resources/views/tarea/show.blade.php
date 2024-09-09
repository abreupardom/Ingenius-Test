@extends('layouts.app')

@section('template_title')
    {{ $tarea->name ?? __('Show') . " " . __('Tarea') }}
@endsection

@section('content')
    <section class="content container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} Tarea</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-success btn-sm"
                               href="{{ route('tareas.edit', $tarea->id) }}"><i
                                    class="fa fa-fw fa-edit"></i> {{ __('Actualizar') }}</a>
                            <a class="btn btn-primary btn-sm" href="{{ url()->previous() }}"> {{ __('Atrás') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    {{ $tarea->nombre }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Estado:</strong>
                                    {{ $tarea->estado }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Prioridad:</strong>
                                    {{ $tarea->prioridad }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Proyecto:</strong>
                                    {{ $tarea->proyecto->nombre }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
