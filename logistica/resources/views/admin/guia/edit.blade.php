@extends('adminlte::page')

@section('title', 'Editar Guía')

@section('content_header')
    <h1>Editar Guía #{{ $guia->num_guias }}</h1>
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
            <i class="fas fa-edit mr-1"></i> Editar Guía
        </h3>
    </div>

    <form action="{{ route('admin.guia.update', $guia->id_guias) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="row">

                {{-- Número de guía --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="num_guias">N° de Guía <span class="text-danger">*</span></label>
                        <input type="number" name="num_guias" id="num_guias"
                               class="form-control @error('num_guias') is-invalid @enderror"
                               value="{{ old('num_guias', $guia->num_guias) }}" min="1" required>
                        @error('num_guias')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Fecha de admisión --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha_admision">Fecha de Admisión <span class="text-danger">*</span></label>
                        <input type="date" name="fecha_admision" id="fecha_admision"
                               class="form-control @error('fecha_admision') is-invalid @enderror"
                               value="{{ old('fecha_admision', \Carbon\Carbon::parse($guia->fecha_admision)->format('Y-m-d')) }}"
                               required>
                        @error('fecha_admision')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Cliente --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cliente_id">Cliente <span class="text-danger">*</span></label>
                        <select name="cliente_id" id="cliente_id"
                                class="form-control @error('cliente_id') is-invalid @enderror" required>
                            <option value="">-- Seleccionar cliente --</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}"
                                    {{ old('cliente_id', $guia->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('cliente_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tipo de Entrega --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipo_entrega_id">Tipo de Entrega <span class="text-danger">*</span></label>
                        <select name="tipo_entrega_id" id="tipo_entrega_id"
                                class="form-control @error('tipo_entrega_id') is-invalid @enderror" required>
                            <option value="">-- Seleccionar tipo --</option>
                            @foreach($tipoEntregas as $tipo)
                                <option value="{{ $tipo->id }}"
                                    {{ old('tipo_entrega_id', $guia->tipo_entrega_id) == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipo_entrega_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Volumen --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="volumen">Volumen <span class="text-danger">*</span></label>
                        <input type="number" name="volumen" id="volumen"
                               class="form-control @error('volumen') is-invalid @enderror"
                               value="{{ old('volumen', $guia->volumen) }}" step="0.01" min="0" required>
                        @error('volumen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Peso --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="peso">Peso <span class="text-danger">*</span></label>
                        <input type="number" name="peso" id="peso"
                               class="form-control @error('peso') is-invalid @enderror"
                               value="{{ old('peso', $guia->peso) }}" step="0.01" min="0" required>
                        @error('peso')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Unidades --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="unidades">Unidades <span class="text-danger">*</span></label>
                        <input type="number" name="unidades" id="unidades"
                               class="form-control @error('unidades') is-invalid @enderror"
                               value="{{ old('unidades', $guia->unidades) }}" min="1" required>
                        @error('unidades')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Precio --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="precio">Precio <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="precio" id="precio"
                                   class="form-control @error('precio') is-invalid @enderror"
                                   value="{{ old('precio', $guia->precio) }}" step="0.01" min="0" required>
                            @error('precio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Observación --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="observacion">Observación</label>
                        <input type="text" name="observacion" id="observacion"
                               class="form-control @error('observacion') is-invalid @enderror"
                               value="{{ old('observacion', $guia->observacion) }}" maxlength="255">
                        @error('observacion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.guia.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Volver
            </a>
            <button type="submit" class="btn btn-warning">
                <i class="fas fa-save mr-1"></i> Actualizar
            </button>
        </div>

    </form>
</div>

@stop