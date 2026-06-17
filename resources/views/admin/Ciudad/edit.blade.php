@extends('adminlte::page')

@section('title', 'Editar Ciudad — Carga y Logística Tolima')

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
            <i class="fas fa-city mr-2"></i>Editar Ciudad
        </h1>
    </div>
@stop

@section('content')
<div class="container-fluid pb-4 premium-container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card-custom-premium">
                <div class="card-header-premium">
                    <h3 class="card-title-premium">
                        <i class="fas fa-edit mr-1" style="color: #F59E0B;"></i> Editar Ciudad
                    </h3>
                </div>

                <form action="{{ route('admin.ciudad.update', $ciudad->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body p-4">
                        {{-- Nombre --}}
                        <div class="form-group mb-3">
                            <label class="text-white font-weight-bold mb-1" for="nombre">Nombre <span class="text-danger">*</span></label>
                            <input type="text" id="nombre" name="nombre" placeholder="Ej: Bogotá"
                                class="form-control form-control-premium @error('nombre') is-invalid @enderror"
                                value="{{ old('nombre', $ciudad->nombre) }}" maxlength="255" autocomplete="off" required>
                            @error('nombre')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Código Postal --}}
                        <div class="form-group mb-3">
                            <label class="text-white font-weight-bold mb-1" for="codigo_postal">Código Postal <span class="text-danger">*</span></label>
                            <input type="text" id="codigo_postal" name="codigo_postal" placeholder="Ej: 110111"
                                class="form-control form-control-premium @error('codigo_postal') is-invalid @enderror"
                                value="{{ old('codigo_postal', $ciudad->codigo_postal) }}" maxlength="20" autocomplete="off" required>
                            @error('codigo_postal')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between p-4" style="background: transparent; border-top: 1px solid rgba(255,255,255,0.05);">
                        <a href="{{ route('admin.ciudad.index') }}" class="btn btn-outline-light font-weight-bold" style="border-radius: 8px;">
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
