@extends('adminlte::page')

@section('title', 'Editar Ruta')

@section('content_header')
    <h1>Editar Ruta <small class="text-muted">#{{ $ruta->id }}</small></h1>
@stop

@section('content')

{{-- Errores de validación --}}
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class="fas fa-exclamation-triangle mr-1"></i> Corrige los siguientes errores:</strong>
        <ul class="mb-0 mt-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

<div class="card card-outline card-warning">

    <div class="card-header">
        <h3 class="card-title mb-0">
            <i class="fas fa-edit mr-1"></i> Modificar datos de la Ruta
        </h3>
    </div>

    <form action="{{ route('admin.ruta.update', $ruta->id) }}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="row">

                {{-- Zona --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="zona">
                            Zona <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="zona"
                               id="zona"
                               class="form-control @error('zona') is-invalid @enderror"
                               value="{{ old('zona', $ruta->zona) }}"
                               maxlength="255"
                               placeholder="Ej: Norte, Sur, Centro..."
                               required>
                        @error('zona')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Guía --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="guia">
                            Guía <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="guia"
                               id="guia"
                               class="form-control @error('guia') is-invalid @enderror"
                               value="{{ old('guia', $ruta->guia) }}"
                               maxlength="255"
                               placeholder="Número o código de guía"
                               required>
                        @error('guia')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Dirección --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="direccion">
                            Dirección <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="direccion"
                               id="direccion"
                               class="form-control @error('direccion') is-invalid @enderror"
                               value="{{ old('direccion', $ruta->direccion) }}"
                               maxlength="255"
                               placeholder="Dirección completa de la ruta"
                               required>
                        @error('direccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Sector --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sector">
                            Sector <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="sector"
                               id="sector"
                               class="form-control @error('sector') is-invalid @enderror"
                               value="{{ old('sector', $ruta->sector) }}"
                               maxlength="255"
                               placeholder="Sector o barrio"
                               required>
                        @error('sector')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Ciudad --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ciudad">
                            Ciudad <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="ciudad"
                               id="ciudad"
                               class="form-control @error('ciudad') is-invalid @enderror"
                               value="{{ old('ciudad', $ruta->ciudad) }}"
                               maxlength="255"
                               placeholder="Ciudad de destino"
                               required>
                        @error('ciudad')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>
        </div>

        {{-- Footer con acciones --}}
        <div class="card-footer d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.ruta.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Volver al listado
            </a>
            <button type="submit" class="btn btn-warning">
                <i class="fas fa-save mr-1"></i> Actualizar Ruta
            </button>
        </div>

    </form>
</div>

@stop