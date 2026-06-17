@extends('adminlte::page')

@section('title', 'Editar Cliente — Carga y Logística Tolima')

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

        .content-wrapper::after {
            content: "";
            position: absolute;
            width: 600px; height: 600px;
            top: -100px; right: -100px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.06) 0%, transparent 70%);
            pointer-events: none;
            z-index: 1;
        }

        .premium-container {
            position: relative;
            z-index: 2;
        }

        .header-dashboard-container {
            margin-bottom: 20px;
            padding: 10px 15px;
            position: relative;
            z-index: 5;
        }

        .dashboard-title-main {
            font-size: 24px;
            letter-spacing: -0.02em;
        }

        .dashboard-title-main i {
            color: #0EA5E9;
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
            display: flex;
            align-items: center;
            gap: 8px;
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

        .btn-warning-premium {
            background: #F59E0B !important;
            border: none !important;
            color: #111 !important;
            border-radius: 8px !important;
            font-weight: 600 !important;
            transition: all 0.2s ease !important;
        }
        .btn-warning-premium:hover {
            background: #D97706 !important;
            transform: translateY(-1px) !important;
        }
    </style>
@stop

@section('content_header')
    <div class="d-flex justify-content-between align-items-center header-dashboard-container">
        <h1 class="text-white font-weight-bold dashboard-title-main m-0">
            <i class="fas fa-user-edit mr-2"></i>Editar Cliente
        </h1>
    </div>
@stop

@section('content')
<div class="container-fluid pb-4 premium-container">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mt-2" style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.25) !important; color: #34D399;" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card-custom-premium">
                <div class="card-header-premium">
                    <h3 class="card-title-premium">
                        <i class="fas fa-edit mr-1" style="color: #F59E0B;"></i> Editar Cliente
                    </h3>
                </div>

                <form action="{{ route('admin.cliente.update', $cliente->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body p-4">
                        {{-- Cedula --}}
                        <div class="form-group mb-3">
                            <label class="text-white font-weight-bold mb-1" for="cedula">Cédula <span class="text-danger">*</span></label>
                            <input type="text" name="cedula" id="cedula"
                                class="form-control form-control-premium @error('cedula') is-invalid @enderror" placeholder="Ej: 123456789"
                                value="{{ old('cedula', $cliente->cedula) }}" required>
                            @error('cedula')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Nombre --}}
                        <div class="form-group mb-3">
                            <label class="text-white font-weight-bold mb-1" for="nombre">Nombre <span class="text-danger">*</span></label>
                            <input type="text" name="nombre" id="nombre"
                                class="form-control form-control-premium @error('nombre') is-invalid @enderror" placeholder="Ej: Juan Pérez"
                                value="{{ old('nombre', $cliente->nombre) }}" required>
                            @error('nombre')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Teléfono --}}
                        <div class="form-group mb-3">
                            <label class="text-white font-weight-bold mb-1" for="telefono">Teléfono <span class="text-danger">*</span></label>
                            <input type="text" name="telefono" id="telefono"
                                class="form-control form-control-premium @error('telefono') is-invalid @enderror" placeholder="Ej: 3001234567"
                                value="{{ old('telefono', $cliente->telefono) }}" required>
                            @error('telefono')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Correo --}}
                        <div class="form-group mb-3">
                            <label class="text-white font-weight-bold mb-1" for="correo">Correo <span class="text-danger">*</span></label>
                            <input type="email" name="correo" id="correo"
                                class="form-control form-control-premium @error('correo') is-invalid @enderror"
                                placeholder="Ej: cliente@correo.com" value="{{ old('correo', $cliente->correo) }}" required>
                            @error('correo')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Dirección --}}
                        <div class="form-group mb-3">
                            <label class="text-white font-weight-bold mb-1" for="direccion">Dirección <span class="text-danger">*</span></label>
                            <input type="text" name="direccion" id="direccion"
                                class="form-control form-control-premium @error('direccion') is-invalid @enderror"
                                placeholder="Ej: Calle 10 # 5-23" value="{{ old('direccion', $cliente->direccion) }}" required>
                            @error('direccion')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Ciudad --}}
                        <div class="form-group mb-3">
                            <label class="text-white font-weight-bold mb-1" for="id_ciudad">Ciudad</label>
                            <select name="id_ciudad" id="id_ciudad" class="form-control form-control-premium @error('id_ciudad') is-invalid @enderror" required>
                                <option value="">Seleccione una ciudad</option>
                                @foreach ($ciudades as $ciudad)
                                    <option value="{{ $ciudad->id }}" {{ old('id_ciudad', $cliente->id_ciudad ?? '') == $ciudad->id ? 'selected' : '' }}>
                                        [{{ $ciudad->codigo_postal }}] {{ $ciudad->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_ciudad')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Descripción --}}
                        <div class="form-group mb-1">
                            <label class="text-white font-weight-bold mb-1" for="descripcion">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="3"
                                class="form-control form-control-premium @error('descripcion') is-invalid @enderror" placeholder="Descripción del cliente..." style="height: auto !important;">{{ old('descripcion', $cliente->descripcion) }}</textarea>
                            @error('descripcion')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between p-4" style="background: transparent; border-top: 1px solid rgba(255,255,255,0.05);">
                        <a href="{{ route('admin.cliente.index') }}" class="btn btn-outline-light font-weight-bold" style="border-radius: 8px;">
                            <i class="fas fa-arrow-left mr-1"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-warning-premium px-4">
                            <i class="fas fa-save mr-1"></i> Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
