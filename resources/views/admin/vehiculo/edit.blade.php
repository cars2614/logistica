{{-- resources/views/admin/vehiculo/edit.blade.php --}}

@extends('adminlte::page')

@section('title', 'Editar Vehículo')

@section('css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        .content-wrapper {
            background-color: #0A0F1E !important;
            position: relative;
            overflow-x: hidden;
            font-family: 'Inter', sans-serif;
        }

        .content-wrapper::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.015) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.015) 1px, transparent 1px);
            background-size: 35px 35px;
            pointer-events: none;
            z-index: 1;
        }

        .premium-container {
            position: relative;
            z-index: 2;
        }

        .card-custom-premium {
            background: rgba(13, 19, 35, 0.65) !important;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: 16px !important;
            border: 1px solid rgba(255, 255, 255, 0.05) !important;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3) !important;
            overflow: hidden;
            margin-top: 15px;
        }

        .card-header-premium {
            padding: 20px 24px !important;
            background: transparent !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
        }

        .card-title-premium {
            font-size: 16px;
            font-weight: 600;
            color: #ffffff;
            margin: 0;
        }

        .form-control-premium {
            background-color: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            color: #fff !important;
            border-radius: 8px !important;
            height: calc(2.25rem + 2px) !important;
        }

        .form-control-premium:focus {
            border-color: #0EA5E9 !important;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.15) !important;
            background-color: rgba(255, 255, 255, 0.05) !important;
            color: #fff !important;
        }

        .form-control-premium option {
            background-color: #131A2E !important;
            color: #fff !important;
        }

        .input-group-text-premium {
            background-color: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            border-right: none !important;
            color: #0EA5E9 !important;
            border-top-left-radius: 8px !important;
            border-bottom-left-radius: 8px !important;
        }

        .input-group > .form-control-premium {
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
            flex: 1 1 auto;
            width: 1%;
        }

        label {
            color: #94A3B8;
            font-weight: 500;
        }
    </style>
@stop

@section('content_header')
    <div class="premium-container">
        <h1 class="text-white"><i class="fas fa-car text-info"></i> Editar Vehículo</h1>
    </div>
@stop

@section('content')
    <div class="container-fluid premium-container">
        <div class="card card-custom-premium">
            <div class="card-header card-header-premium">
                <h3 class="card-title-premium"><i class="fas fa-edit text-info"></i> Modificar registro</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.vehiculo.update', $vehiculo) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- Placa --}}
                        <div class="col-md-6 form-group">
                            <label for="placa">Placa <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-premium"><i class="fas fa-id-card"></i></span>
                                </div>
                                <input type="text" name="placa" id="placa"
                                    class="form-control form-control-premium @error('placa') is-invalid @enderror"
                                    value="{{ old('placa', $vehiculo->placa) }}" placeholder="Ej: ABC-123" maxlength="10"
                                    autocomplete="off" onkeypress="return /[a-zA-Z0-9\-]/.test(event.key)"
                                    style="text-transform: uppercase;" required>
                            </div>
                            @error('placa')
                                <div class="text-danger mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tipo de Vehículo --}}
                        <div class="col-md-6 form-group">
                            <label for="id_tipo_vehiculo">Tipo de Vehículo <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-premium"><i class="fas fa-truck"></i></span>
                                </div>
                                <select name="id_tipo_vehiculo" id="id_tipo_vehiculo"
                                    class="form-control form-control-premium @error('id_tipo_vehiculo') is-invalid @enderror" required>
                                    <option value="">-- Seleccione --</option>
                                    @foreach ($tipoVehiculos as $tipo)
                                        <option value="{{ $tipo->id }}"
                                            {{ old('id_tipo_vehiculo', $vehiculo->id_tipo_vehiculo) == $tipo->id ? 'selected' : '' }}>
                                            {{ $tipo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('id_tipo_vehiculo')
                                <div class="text-danger mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Marca --}}
                        <div class="col-md-6 form-group">
                            <label for="marca">Marca <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-premium"><i class="fas fa-copyright"></i></span>
                                </div>
                                <input type="text" name="marca" id="marca"
                                    class="form-control form-control-premium @error('marca') is-invalid @enderror"
                                    value="{{ old('marca', $vehiculo->marca) }}" placeholder="Ej: Chevrolet" maxlength="100"
                                    autocomplete="off" onkeypress="return /[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]/.test(event.key)"
                                    required>
                            </div>
                            @error('marca')
                                <div class="text-danger mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Modelo --}}
                        <div class="col-md-6 form-group">
                            <label for="modelo">Modelo / Línea <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-premium"><i class="fas fa-car-side"></i></span>
                                </div>
                                <input type="text" name="modelo" id="modelo"
                                    class="form-control form-control-premium @error('modelo') is-invalid @enderror"
                                    value="{{ old('modelo', $vehiculo->modelo) }}" placeholder="Ej: NHR 2022"
                                    maxlength="100" autocomplete="off"
                                    onkeypress="return /[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s]/.test(event.key)" required>
                            </div>
                            @error('modelo')
                                <div class="text-danger mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Capacidad --}}
                        <div class="col-md-6 form-group">
                            <label for="capacidad">Capacidad (kg) <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-premium"><i class="fas fa-weight-hanging"></i></span>
                                </div>
                                <input type="number" name="capacidad" id="capacidad"
                                    class="form-control form-control-premium @error('capacidad') is-invalid @enderror"
                                    value="{{ old('capacidad', $vehiculo->capacidad) }}" placeholder="Ej: 5000"
                                    min="1" max="999999" autocomplete="off"
                                    onkeypress="return /[0-9]/.test(event.key)" required>
                            </div>
                            @error('capacidad')
                                <div class="text-danger mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Estado --}}
                        <div class="col-md-6 form-group">
                            <label for="estado">Estado <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-premium"><i class="fas fa-toggle-on"></i></span>
                                </div>
                                <select name="estado" id="estado"
                                    class="form-control form-control-premium @error('estado') is-invalid @enderror" required>
                                    <option value="Activo" {{ old('estado', $vehiculo->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="Inactivo" {{ old('estado', $vehiculo->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                    <option value="En Mantenimiento" {{ old('estado', $vehiculo->estado) == 'En Mantenimiento' ? 'selected' : '' }}>En Mantenimiento</option>
                                </select>
                            </div>
                            @error('estado')
                                <div class="text-danger mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Fecha de Registro --}}
                        <div class="col-md-6 form-group">
                            <label for="fecha_registro">Fecha de Registro <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-premium"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" name="fecha_registro" id="fecha_registro"
                                    class="form-control form-control-premium @error('fecha_registro') is-invalid @enderror"
                                    value="{{ old('fecha_registro', $vehiculo->fecha_registro) }}" required>
                            </div>
                            @error('fecha_registro')
                                <div class="text-danger mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-4 pt-3" style="border-top: 1px solid rgba(255,255,255,0.05);">
                        <a href="{{ route('admin.vehiculo.index') }}" class="btn text-white mr-2" style="background: rgba(255,255,255,0.1); border: none;">
                            <i class="fas fa-arrow-left mr-1"></i> Cancelar
                        </a>
                        <button type="submit" class="btn text-white" style="background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%); border: none;">
                            <i class="fas fa-save mr-1"></i> Actualizar Vehículo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
