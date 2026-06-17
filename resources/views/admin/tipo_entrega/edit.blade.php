@extends('adminlte::page')

@section('title', 'Editar Tipo de Entrega')

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
        }
        
        input.form-control-premium {
            height: calc(2.25rem + 2px) !important;
        }

        .form-control-premium:focus {
            border-color: #0EA5E9 !important;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.15) !important;
            background-color: rgba(255, 255, 255, 0.05) !important;
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
    <div class="d-flex justify-content-between align-items-center premium-container">
        <h1 class="m-0 text-white">
            <i class="fas fa-truck-loading text-info mr-2"></i>Editar Tipo de Entrega
        </h1>
        <ol class="breadcrumb float-sm-right m-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" style="color: #0EA5E9;">Inicio</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.tipo-entrega.index') }}" style="color: #0EA5E9;">Tipos de Entrega</a>
            </li>
            <li class="breadcrumb-item active" style="color: #94A3B8;">Editar</li>
        </ol>
    </div>
@stop

@section('content')
    <div class="row justify-content-center premium-container">
        <div class="col-md-7">
            <div class="card card-custom-premium">
                <div class="card-header card-header-premium">
                    <h3 class="card-title-premium">
                        <i class="fas fa-pen text-info mr-1"></i>
                        Editando: <strong class="ml-1 text-info">{{ $tipoEntrega->nombre }}</strong>
                    </h3>
                </div>

                <form action="{{ route('admin.tipo-entrega.update', $tipoEntrega) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        {{-- Nombre --}}
                        <div class="form-group">
                            <label for="nombre">Nombre <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-premium"><i class="fas fa-tag"></i></span>
                                </div>
                                <input
                                    type="text"
                                    id="nombre"
                                    name="nombre"
                                    value="{{ old('nombre', $tipoEntrega->nombre) }}"
                                    placeholder="Ej: Entrega a domicilio"
                                    class="form-control form-control-premium @error('nombre') is-invalid @enderror"
                                    maxlength="100"
                                    autocomplete="off"
                                    required
                                >
                            </div>
                            @error('nombre')
                                <div class="text-danger mt-1 text-sm"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                            @enderror
                            <small class="form-text" style="color: #64748B;"><i class="fas fa-info-circle mr-1"></i>Solo letras, espacios y tildes. Máx. 100 caracteres.</small>
                        </div>

                        {{-- Descripción --}}
                        <div class="form-group mt-4">
                            <label for="descripcion">Descripción</label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-premium"><i class="fas fa-align-left"></i></span>
                                </div>
                                <textarea
                                    id="descripcion"
                                    name="descripcion"
                                    class="form-control form-control-premium @error('descripcion') is-invalid @enderror"
                                    rows="3"
                                    maxlength="255"
                                    placeholder="Detalles sobre este tipo de entrega..."
                                >{{ old('descripcion', $tipoEntrega->descripcion) }}</textarea>
                            </div>
                            @error('descripcion')
                                <div class="text-danger mt-1 text-sm"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                            @enderror
                            <small class="form-text" style="color: #64748B;">
                                <i class="fas fa-info-circle mr-1"></i>Opcional. 
                                <span id="char-count" class="font-weight-bold">0</span>/255 caracteres permitidos.
                            </small>
                        </div>
                    </div>

                    <div class="mt-4 pt-3" style="border-top: 1px solid rgba(255,255,255,0.05); padding: 24px;">
                        <a href="{{ route('admin.tipo-entrega.index') }}" class="btn text-white mr-2" style="background: rgba(255,255,255,0.1); border: none;">
                            <i class="fas fa-times-circle mr-1"></i> Cancelar
                        </a>
                        <button type="submit" class="btn text-white" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); border: none;">
                            <i class="fas fa-save mr-1"></i> Actualizar Tipo de Entrega
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const descInput = document.getElementById('descripcion');
        const countSpan = document.getElementById('char-count');

        const updateCount = () => {
            const length = descInput.value.length;
            countSpan.textContent = length;
            if (length >= 255) {
                countSpan.classList.add('text-danger');
            } else {
                countSpan.classList.remove('text-danger');
            }
        };

        descInput.addEventListener('input', updateCount);
        updateCount(); 
    });
</script>
@stop