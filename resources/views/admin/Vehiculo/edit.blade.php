{{-- resources/views/admin/vehiculo/edit.blade.php --}}

@extends('adminlte::page')

@section('title', 'Editar Vehículo')

@section('content_header')
    <h1><i class="fas fa-car"></i> Editar Vehículo</h1>
@stop

@section('content')
<div class="container-fluid">

    <div class="card card-outline card-warning">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-edit"></i> Modificar registro</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.vehiculo.update', $vehiculo) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="placa">Placa <span class="text-danger">*</span></label>
                            <input type="text" name="placa" id="placa"
                                   class="form-control @error('placa') is-invalid @enderror"
                                   value="{{ old('placa', $vehiculo->placa) }}"
                                   required maxlength="10">
                            @error('placa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipo_vehiculo_id">Tipo de Vehículo <span class="text-danger">*</span></label>
                            <select name="tipo_vehiculo_id" id="tipo_vehiculo_id"
                                    class="form-control @error('tipo_vehiculo_id') is-invalid @enderror" required>
                                <option value="">-- Seleccione --</option>
                                @foreach($tipoVehiculos as $tipo)
                                    <option value="{{ $tipo->id }}"
                                        {{ old('tipo_vehiculo_id', $vehiculo->tipo_vehiculo_id) == $tipo->id ? 'selected' : '' }}>
                                        {{ $tipo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_vehiculo_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="marca">Marca <span class="text-danger">*</span></label>
                            <input type="text" name="marca" id="marca"
                                   class="form-control @error('marca') is-invalid @enderror"
                                   value="{{ old('marca', $vehiculo->marca) }}"
                                   required maxlength="100">
                            @error('marca')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="modelo">Modelo <span class="text-danger">*</span></label>
                            <input type="text" name="modelo" id="modelo"
                                   class="form-control @error('modelo') is-invalid @enderror"
                                   value="{{ old('modelo', $vehiculo->modelo) }}"
                                   required maxlength="100">
                            @error('modelo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="capacidad">Capacidad (kg) <span class="text-danger">*</span></label>
                            <input type="number" name="capacidad" id="capacidad"
                                   class="form-control @error('capacidad') is-invalid @enderror"
                                   value="{{ old('capacidad', $vehiculo->capacidad) }}"
                                   required min="0">
                            @error('capacidad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estado">Estado <span class="text-danger">*</span></label>
                            <select name="estado" id="estado"
                                    class="form-control @error('estado') is-invalid @enderror" required>
                                <option value="">-- Seleccione --</option>
                                <option value="activo"        {{ old('estado', $vehiculo->estado) === 'activo'        ? 'selected' : '' }}>Activo</option>
                                <option value="inactivo"      {{ old('estado', $vehiculo->estado) === 'inactivo'      ? 'selected' : '' }}>Inactivo</option>
                                <option value="mantenimiento" {{ old('estado', $vehiculo->estado) === 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha_registro">Fecha de Registro <span class="text-danger">*</span></label>
                            <input type="date" name="fecha_registro" id="fecha_registro"
                                   class="form-control @error('fecha_registro') is-invalid @enderror"
                                   value="{{ old('fecha_registro', \Carbon\Carbon::parse($vehiculo->fecha_registro)->format('Y-m-d')) }}"
                                   required>
                            @error('fecha_registro')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save"></i> Actualizar
                    </button>
                    <a href="{{ route('admin.vehiculo.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@stop

@section('js')
@stop