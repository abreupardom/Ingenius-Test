<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="row">
            <div class="form-group mb-2 mb20 col-lg-6">
                <label for="nombre" class="form-label">{{ __('nombre') }}</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                       value="{{ old('nombre', $proyecto?->nombre) }}" id="nombre" placeholder="Nombre">
                {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <div class="form-group mb-2 mb20 col-lg-6">
                <label for="descripcion" class="form-label">{{ __('Descripción') }}</label>
                <textarea type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror"
                          id="descripcion"
                          placeholder="Descripcion">{{ old('descripcion', $proyecto?->descripcion) }}</textarea>
                {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
        </div>
        <div class="row">
            <div class="form-group mb-2 mb20 col-lg-6">
                <label for="archivado" class="form-label">{{ __('Archivado') }}</label>
                <select name="archivado" id="archivado" class="bg-light border-0">
                    <option value="0" {{ $proyecto->archivado == 0 ? 'selected' : '' }}>No</option>
                    <option value="1" {{ $proyecto->archivado == 1 ? 'selected' : '' }}>Si</option>
                </select>
                {!! $errors->first('archivado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <div class="form-group mb-2 mb20 col-lg-6 collapse">
                <label for="usuario_id" class="form-label">{{ __('Usuario Id') }}</label>
                <input type="text" name="usuario_id" class="form-control @error('usuario_id') is-invalid @enderror"
                       value="{{ old('usuario_id', Auth::user()->id) }}" id="usuario_id" placeholder="Usuario Id">
                {!! $errors->first('usuario_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
        </div>


    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary float-end">{{ __('Guardar') }}</button>
</div>
</div>
