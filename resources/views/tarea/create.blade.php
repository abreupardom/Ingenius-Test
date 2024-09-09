@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Tarea
@endsection

@section('content')
    <section class="content container">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Tarea</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('tareas.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('tarea.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
