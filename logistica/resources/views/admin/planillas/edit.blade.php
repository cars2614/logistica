@extends('adminlte::page')

@section('title', 'Editar Planilla')

@section('content_header')
    <h1>Editar Planilla #{{ $planilla->id }}</h1>
@stop

@section('content')

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

<div class="card">
    <div class="card-header bg-warning">
        <h3 class="card-title mb-0 text-dark">
            <i class="fas fa-edit mr-1"></i> Editar Planilla
        </h3>
    </div>

    <form action="{{ route('admin.planilla.update', $planilla->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="row">

                {{-- Guía --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="guia_id">Guía <span class="text-danger">*</span></label>
                        <select name="guia_id" id="guia_id"
                                class="form-control @error('guia_id') is-invalid @enderror"
                                required>
                            <option value="">-- Seleccionar guía --</option>
                            @foreach($guias as $guia)
                                <option value="{{ $guia->id_guias }}"
                                    {{ old('guia_id', $planilla->guia_id) == $guia->id_guias ? 'selected' : '' }}>
                                    N° {{ $guia->num_guias }}
                                    — {{ $guia->cliente->nombre ?? 'Sin cliente' }}
                                </option>
                            @endforeach
                        </select>
                        @error('guia_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Ruta --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ruta_id">Ruta <span class="text-danger">*</span></label>
                        <select name="ruta_id" id="ruta_id"
                                class="form-control @error('ruta_id') is-invalid @enderror"
                                required>
                            <option value="">-- Seleccionar ruta --</option>
                            @foreach($rutas as $ruta)
                                <option value="{{ $ruta->id }}"
                                    {{ old('ruta_id', $planilla->ruta_id) == $ruta->id ? 'selected' : '' }}>
                                    {{ $ruta->nombre ?? 'Ruta #' . $ruta->id }}
                                </option>
                            @endforeach
                        </select>
                        @error('ruta_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Destinatario --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="destinatario">Destinatario <span class="text-danger">*</span></label>
                        <input type="text" name="destinatario" id="destinatario"
                               class="form-control @error('destinatario') is-invalid @enderror"
                               value="{{ old('destinatario', $planilla->destinatario) }}"
                               maxlength="255" required>
                        @error('destinatario')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Dirección --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="direccion">Dirección <span class="text-danger">*</span></label>
                        <input type="text" name="direccion" id="direccion"
                               class="form-control @error('direccion') is-invalid @enderror"
                               value="{{ old('direccion', $planilla->direccion) }}"
                               maxlength="255" required>
                        @error('direccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Destino --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="destino">Destino <span class="text-danger">*</span></label>
                        <input type="text" name="destino" id="destino"
                               class="form-control @error('destino') is-invalid @enderror"
                               value="{{ old('destino', $planilla->destino) }}"
                               maxlength="255" required>
                        @error('destino')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Departamento --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="departamento">Departamento <span class="text-danger">*</span></label>
                        <input type="text" name="departamento" id="departamento"
                               class="form-control @error('departamento') is-invalid @enderror"
                               value="{{ old('departamento', $planilla->departamento) }}"
                               maxlength="255" required>
                        @error('departamento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Entidad --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="entidad">Entidad <span class="text-danger">*</span></label>
                        <input type="text" name="entidad" id="entidad"
                               class="form-control @error('entidad') is-invalid @enderror"
                               value="{{ old('entidad', $planilla->entidad) }}"
                               maxlength="255" required>
                        @error('entidad')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Servicio --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="servicio">Servicio <span class="text-danger">*</span></label>
                        <input type="text" name="servicio" id="servicio"
                               class="form-control @error('servicio') is-invalid @enderror"
                               value="{{ old('servicio', $planilla->servicio) }}"
                               maxlength="255" required>
                        @error('servicio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Piezas --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="piezas">Piezas <span class="text-danger">*</span></label>
                        <input type="number" name="piezas" id="piezas"
                               class="form-control @error('piezas') is-invalid @enderror"
                               value="{{ old('piezas', $planilla->piezas) }}"
                               min="0" required>
                        @error('piezas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Kilos --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="kilos">Kilos <span class="text-danger">*</span></label>
                        <input type="number" name="kilos" id="kilos"
                               class="form-control @error('kilos') is-invalid @enderror"
                               value="{{ old('kilos', $planilla->kilos) }}"
                               step="0.01" min="0" required>
                        @error('kilos')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Operador --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="opedor">Operador <span class="text-danger">*</span></label>
                        <input type="text" name="opedor" id="opedor"
                               class="form-control @error('opedor') is-invalid @enderror"
                               value="{{ old('opedor', $planilla->opedor) }}"
                               maxlength="255" required>
                        @error('opedor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Comentario --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="comentario">Comentario <span class="text-danger">*</span></label>
                        <textarea name="comentario" id="comentario" rows="2"
                                  class="form-control @error('comentario') is-invalid @enderror"
                                  maxlength="255" required>{{ old('comentario', $planilla->comentario) }}</textarea>
                        @error('comentario')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.planilla.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Volver
            </a>
            <button type="submit" class="btn btn-warning">
                <i class="fas fa-save mr-1"></i> Actualizar
            </button>
        </div>

    </form>
</div>

@stop