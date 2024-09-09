<div class="row padding-1 p-1">
    <div class="col-md-12">
        <div class="row">
            <div class="form-group mb-2 mb20 col-lg-6">
                <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                       value="{{ old('nombre', $tarea?->nombre) }}" id="nombre" placeholder="Nombre">
                {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <div class="form-group mb-2 mb20 col-lg-6">
                <label for="estado" class="form-label">{{ __('Estado') }}</label>
                <select name="estado" id="estado" class="form-control select2">
                    <option value="Pendiente" {{ $tarea->estado == "Pendiente" ? 'selected' : '' }}>Pendiente</option>
                    <option value="En progreso" {{ $tarea->estado == "En progreso" ? 'selected' : '' }}>En progreso
                    </option>
                    <option value="Completada" {{ $tarea->estado == "Completada" ? 'selected' : '' }}>Completada
                    </option>
                </select>
                {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
        </div>
        <div class="row">
            <div class="form-group mb-2 mb20 col-lg-6">
                <label for="prioridad" class="form-label">{{ __('Prioridad') }}</label>
                <select name="prioridad" id="prioridad" class="form-control select2">
                    <option value="Media" {{ $tarea->prioridad == "Media" ? 'selected' : '' }}>Media</option>
                    <option value="Baja" {{ $tarea->prioridad == "Baja" ? 'selected' : '' }}>Baja</option>
                    <option value="Alta" {{ $tarea->prioridad == "Alta" ? 'selected' : '' }}>Alta</option>
                </select>
                {!! $errors->first('prioridad', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <div class="form-group mb-2 mb20 col-lg-6">
                <label for="proyecto_id" class="form-label">{{ __('Proyecto') }}</label>
                <select name="proyecto_id" id="proyecto_id" class="form-control select2">
                    @foreach ($listaProyectos as $proyecto)
                        @if(!$proyecto->archivado)
                            <option
                                value={{$proyecto->id}} {{ $tarea->proyecto_id == $proyecto->id ? 'selected' : '' }} >{{$proyecto->nombre}}</option>
                        @endif
                    @endforeach
                </select>
                {!! $errors->first('proyecto_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
        </div>
    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary float-end">{{ __('Guardar') }}</button>
    </div>
</div>
