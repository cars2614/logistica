@extends('adminlte::page')

@section('title', 'Editar Tipo de Entrega')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0 text-dark">
            <i class="fas fa-edit mr-2"></i>Editar Tipo de Entrega
        </h1>
        <ol class="breadcrumb float-sm-right m-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Inicio</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.tipo-entrega.index') }}">Tipos de Entrega</a>
            </li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
    </div>
@stop

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-pen mr-1"></i>
                        Editando: <strong>{{ $tipoEntrega->nombre }}</strong>
                    </h3>
                </div>

                <form action="{{ route('admin.tipo-entrega.update', $tipoEntrega) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        {{-- Nombre --}}
                        <div class="form-group">
                            <label for="nombre">
                                Nombre <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                id="nombre"
                                name="nombre"
                                value="{{ old('nombre', $tipoEntrega->nombre) }}"
                                placeholder="Ej: Entrega a domicilio"
                                class="form-control @error('nombre') is-invalid @enderror"
                                maxlength="255"
                                autocomplete="off"
                            >
                            @error('nombre')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Descripción --}}
                        <div class="form-group">
                            <label for="descripcion">
                                Descripción <span class="text-danger">*</span>
                            </label>
                            <textarea
                                id="descripcion"
                                name="descripcion"
                                rows="4"
                                placeholder="Descripción del tipo de entrega..."
                                class="form-control @error('descripcion') is-invalid @enderror"
                                maxlength="255"
                            >{{ old('descripcion', $tipoEntrega->descripcion) }}</textarea>
                            @error('descripcion')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Estado --}}
                        <div class="form-group">
                            <label for="estado">
                                Estado <span class="text-danger">*</span>
                            </label>
                            <select
                                id="estado"
                                name="estado"
                                class="form-control @error('estado') is-invalid @enderror"
                            >
                                <option value="">-- Seleccione --</option>
                                <option value="1" {{ old('estado', $tipoEntrega->estado) == '1' ? 'selected' : '' }}>
                                    Activo
                                </option>
                                <option value="0" {{ old('estado', (string) $tipoEntrega->estado) === '0' ? 'selected' : '' }}>
                                    Inactivo
                                </option>
                            </select>
                            @error('estado')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.tipo-entrega.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save mr-1"></i> Actualizar
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>

@stop

@section('js')
<script>
    // Auto-cerrar alertas de sesión tras 4 segundos
    setTimeout(function () {
        document.querySelectorAll('.alert-dismissible').forEach(function (alert) {
            $(alert).fadeOut('slow');
        });
    }, 4000);
</script>
@stop