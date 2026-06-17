{{-- resources/views/admin/tipo-vehiculo/edit.blade.php --}}

@extends('adminlte::page')

@section('title', 'Editar Tipo de Vehículo')

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
    <div class="premium-container">
        <h1 class="text-white"><i class="fas fa-truck text-info"></i> Editar Tipo de Vehículo</h1>
    </div>
@stop

@section('content')
    <div class="container-fluid premium-container">
        <div class="card card-custom-premium">
            <div class="card-header card-header-premium">
                <h3 class="card-title-premium"><i class="fas fa-edit text-info"></i> Modificar registro</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.tipo-vehiculo.update', $tipoVehiculo) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- Nombre --}}
                        <div class="col-md-12 form-group">
                            <label for="nombre">Nombre <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-premium"><i class="fas fa-truck"></i></span>
                                </div>
                                <input type="text" name="nombre" id="nombre"
                                    class="form-control form-control-premium @error('nombre') is-invalid @enderror"
                                    value="{{ old('nombre', $tipoVehiculo->nombre) }}" placeholder="Ej: Camión 5 Ton"
                                    maxlength="100" autocomplete="off" required>
                            </div>
                            @error('nombre')
                                <div class="text-danger mt-1 text-sm">{{ $message }}</div>
                            @enderror
                            <small class="form-text" style="color: #64748B;"><i class="fas fa-info-circle mr-1"></i>Letras, números, espacios y tildes. Máx. 100 caracteres.</small>
                        </div>

                        {{-- Descripción --}}
                        <div class="col-md-12 form-group">
                            <label for="descripcion">Descripción</label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-premium"><i class="fas fa-align-left"></i></span>
                                </div>
                                <textarea name="descripcion" id="descripcion" class="form-control form-control-premium @error('descripcion') is-invalid @enderror"
                                    rows="3" maxlength="255" placeholder="Descripción del tipo de vehículo...">{{ old('descripcion', $tipoVehiculo->descripcion) }}</textarea>
                            </div>
                            @error('descripcion')
                                <div class="text-danger mt-1 text-sm">{{ $message }}</div>
                            @enderror
                            <small class="form-text" style="color: #64748B;"><i class="fas fa-info-circle mr-1"></i>Opcional. <span id="desc-count-edit">0</span>/255 caracteres.</small>
                        </div>
                    </div>

                    <div class="mt-4 pt-3" style="border-top: 1px solid rgba(255,255,255,0.05);">
                        <a href="{{ route('admin.tipo-vehiculo.index') }}" class="btn text-white mr-2" style="background: rgba(255,255,255,0.1); border: none;">
                            <i class="fas fa-arrow-left mr-1"></i> Volver
                        </a>
                        <button type="submit" class="btn text-white" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); border: none;">
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
        $(document).ready(function() {
            // Contador de caracteres para la descripción en edición
            const descInputEdit = $('#descripcion');
            const descCountEdit = $('#desc-count-edit');
            
            function updateCount() {
                const currentLength = descInputEdit.val().length;
                descCountEdit.text(currentLength);
            }
            
            updateCount(); // Inicial
            descInputEdit.on('input', updateCount);
        });
    </script>
@stop
