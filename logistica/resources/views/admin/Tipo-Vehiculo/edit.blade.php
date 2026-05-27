{{-- resources/views/admin/tipo-vehiculo/edit.blade.php --}}

@extends('adminlte::page')

@section('title', 'Editar Tipo de Vehículo')

@section('content_header')
    <h1><i class="fas fa-truck"></i> Editar Tipo de Vehículo</h1>
@stop

@section('content')
<div class="container-fluid">

    <div class="card card-outline card-warning">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-edit me-1"></i> Modificar registro</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.tipo-vehiculo.update', $tipoVehiculo) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre">Nombre <span class="text-danger">*</span></label>
                    <input type="text" name="nombre" id="nombre"
                           class="form-control @error('nombre') is-invalid @enderror"
                           value="{{ old('nombre', $tipoVehiculo->nombre) }}"
                           required maxlength="100">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion"
                              class="form-control @error('descripcion') is-invalid @enderror"
                              rows="3" maxlength="255">{{ old('descripcion', $tipoVehiculo->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save"></i> Actualizar
                    </button>
                    <a href="{{ route('admin.tipo-vehiculo.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@stop

@section('js')
    {{-- Espacio para scripts futuros en esta vista --}}
@stop