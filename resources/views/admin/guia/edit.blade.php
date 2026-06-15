@extends('adminlte::page')

@section('title', 'Editar Guía — Carga y Logística Tolima')

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

        .dashboard-date-badge {
            font-size: 14px;
            color: rgba(255,255,255,0.5);
        }

        .dashboard-date-badge i {
            color: #6366F1;
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
            display: flex;
            align-items: center;
            justify-content: space-between;
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

        .form-control-premium[readonly] {
            background-color: rgba(255, 255, 255, 0.01) !important;
            color: rgba(255, 255, 255, 0.4) !important;
            cursor: not-allowed;
            border: 1px solid rgba(255, 255, 255, 0.04) !important;
        }

        .input-group-text-premium {
            background-color: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            color: rgba(255, 255, 255, 0.6) !important;
            border-radius: 8px 0 0 8px !important;
        }

        .input-group-premium .form-control-premium {
            border-radius: 0 8px 8px 0 !important;
        }

        /* Select2 Premium */
        .select2-container--bootstrap4 .select2-selection--single {
            background-color: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            color: #fff !important;
            border-radius: 8px !important;
            height: calc(2.25rem + 2px) !important;
        }
        .select2-container--bootstrap4 .select2-selection__rendered {
            color: #fff !important;
        }
        .select2-dropdown {
            background-color: #131A2E !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
        }
        .select2-results__option {
            color: #fff !important;
        }
        .select2-results__option--highlighted[aria-selected] {
            background-color: #0EA5E9 !important;
        }
        .select2-search__field {
            background-color: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            color: #fff !important;
        }
    </style>
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
@stop

@section('content_header')
    <div class="d-flex justify-content-between align-items-center header-dashboard-container">
        <h1 class="text-white font-weight-bold dashboard-title-main m-0">
            <i class="fas fa-edit mr-2"></i>Editar Guía #{{ $guia->id }}
        </h1>
        <span class="dashboard-date-badge">
            <i class="fa fa-calendar-alt mr-1"></i> Estado: {{ $guia->estados->sortByDesc('id')->first()->estado ?? 'Registrada' }}
        </span>
    </div>
@stop

@section('content')
<div class="container-fluid pb-4 premium-container">

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mt-2" style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.25) !important; color: #F87171;" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

    <div class="card-custom-premium">
        <div class="card-header-premium">
            <h3 class="card-title-premium">
                <i class="fas fa-info-circle mr-2" style="color: #0EA5E9;"></i> Datos de la Guía
            </h3>
        </div>

        <form action="{{ route('admin.guia.update', $guia->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body p-4">
                <div class="row">

                    {{-- Número de guía --}}
                    <div class="col-md-6 form-group">
                        <label class="text-white">N° de Guía <span class="text-danger">*</span></label>
                        <input type="number" name="id" id="id" class="form-control form-control-premium" value="{{ old('id', $guia->id) }}" required readonly>
                    </div>

                    {{-- id_tipo_entrega --}}
                    <div class="col-md-6 form-group">
                        <label class="text-white">Tipo de Entrega <span class="text-danger">*</span></label>
                        <select name="id_tipo_entrega" id="id_tipo_entrega" class="form-control form-control-premium" required>
                            <option value="">-- Seleccionar tipo de entrega --</option>
                            @foreach ($tipoEntregas as $tipoEntrega)
                                <option value="{{ $tipoEntrega->id }}" {{ old('id_tipo_entrega', $guia->id_tipo_entrega) == $tipoEntrega->id ? 'selected' : '' }}>
                                    {{ $tipoEntrega->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Repartidor --}}
                    <div class="col-md-6 form-group">
                        <label class="text-white">Repartidor Asignado</label>
                        <select name="id_repartidor" id="id_repartidor" class="form-control select2" style="width: 100%;">
                            <option value="">-- Sin asignar --</option>
                            @foreach ($repartidores as $repartidor)
                                <option value="{{ $repartidor->id }}" {{ old('id_repartidor', $guia->id_repartidor) == $repartidor->id ? 'selected' : '' }}>
                                    {{ $repartidor->name }} ({{ $repartidor->email }})
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Deje vacío si no está asignado aún.</small>
                    </div>

                    {{-- Cliente origen --}}
                    <div class="col-md-6 form-group">
                        <label class="text-white">Cliente Origen <span class="text-danger">*</span></label>
                        <select name="id_cliente_origen" id="id_cliente_origen" class="form-control select2-field" required>
                            <option value="">-- Seleccionar cliente --</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('id_cliente_origen', $guia->id_cliente_origen) == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->cedula }} — {{ $cliente->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Cliente destino --}}
                    <div class="col-md-6 form-group">
                        <label class="text-white">Cliente Destino <span class="text-danger">*</span></label>
                        <select name="id_cliente_destino" id="id_cliente_destino" class="form-control select2-field" required>
                            <option value="">-- Seleccionar cliente --</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('id_cliente_destino', $guia->id_cliente_destino) == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->cedula }} — {{ $cliente->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Unidades --}}
                    <div class="col-md-6 form-group">
                        <label class="text-white">Unidades <span class="text-danger">*</span></label>
                        <input type="number" name="unidades" id="unidades" class="form-control form-control-premium" value="{{ old('unidades', $guia->unidades) }}" min="1" required>
                    </div>

                    {{-- Peso --}}
                    <div class="col-md-6 form-group">
                        <label class="text-white">Peso (kg) <span class="text-danger">*</span></label>
                        <input type="number" name="peso" id="peso" class="form-control form-control-premium" value="{{ old('peso', $guia->peso) }}" step="0.01" min="0.01" required>
                    </div>

                    {{-- Largo --}}
                    <div class="col-md-4 form-group">
                        <label class="text-white">Largo (m) <span class="text-danger">*</span></label>
                        <input type="number" name="largo" id="largo" class="form-control form-control-premium" value="{{ old('largo', $guia->largo) }}" step="0.01" min="0.01" required>
                    </div>

                    {{-- Ancho --}}
                    <div class="col-md-4 form-group">
                        <label class="text-white">Ancho (m) <span class="text-danger">*</span></label>
                        <input type="number" name="ancho" id="ancho" class="form-control form-control-premium" value="{{ old('ancho', $guia->ancho) }}" step="0.01" min="0.01" required>
                    </div>

                    {{-- Alto --}}
                    <div class="col-md-4 form-group">
                        <label class="text-white">Alto (m) <span class="text-danger">*</span></label>
                        <input type="number" name="alto" id="alto" class="form-control form-control-premium" value="{{ old('alto', $guia->alto) }}" step="0.01" min="0.01" required>
                    </div>

                    {{-- Precio Envio --}}
                    <div class="col-md-6 form-group">
                        <label class="text-white">Precio Envío <span class="text-danger">*</span></label>
                        <div class="input-group input-group-premium">
                            <div class="input-group-prepend">
                                <span class="input-group-text input-group-text-premium">$</span>
                            </div>
                            <input type="number" name="precio_envio" id="precio_envio" class="form-control form-control-premium" value="{{ old('precio_envio', $guia->precio_envio) }}" step="0.01" min="0" required>
                        </div>
                    </div>

                    {{-- Precio Declarado --}}
                    <div class="col-md-6 form-group">
                        <label class="text-white">Valor Declarado <span class="text-danger">*</span></label>
                        <div class="input-group input-group-premium">
                            <div class="input-group-prepend">
                                <span class="input-group-text input-group-text-premium">$</span>
                            </div>
                            <input type="number" name="valor_declarado" id="valor_declarado" class="form-control form-control-premium" value="{{ old('valor_declarado', $guia->valor_declarado) }}" step="0.01" min="0" required>
                        </div>
                    </div>

                    {{-- Observación --}}
                    <div class="col-md-12 form-group">
                        <label class="text-white">Observación</label>
                        <textarea name="observacion" id="observacion" rows="3" class="form-control form-control-premium" style="height: auto !important;" maxlength="255">{{ old('observacion', $guia->observacion) }}</textarea>
                        <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Opcional. <span id="obs-count-edit">0</span>/255 caracteres.</small>
                    </div>

                </div>
            </div>

            <div class="card-footer d-flex justify-content-between" style="background: transparent; border-top: 1px solid rgba(255,255,255,0.05);">
                <a href="{{ route('admin.guia.index') }}" class="btn btn-outline-light font-weight-bold" style="border-radius: 8px;">
                    <i class="fas fa-arrow-left mr-1"></i> Volver
                </a>
                <button type="submit" class="btn btn-warning font-weight-bold" style="border-radius: 8px; color: #111;">
                    <i class="fas fa-save mr-1"></i> Actualizar
                </button>
            </div>

        </form>
    </div>
</div>
@stop

@section('js')
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: 'Buscar repartidor...',
                allowClear: true
            });
            $('.select2-field').select2({
                theme: 'bootstrap4',
                placeholder: 'Seleccionar cliente...',
                allowClear: true
            });
        });

        // Unidades: solo enteros positivos
        const uField = document.getElementById('unidades');
        if (uField) {
            uField.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });
        }

        // Contador observación
        const obsEdit = document.getElementById('observacion');
        const obsCountEdit = document.getElementById('obs-count-edit');
        if (obsEdit && obsCountEdit) {
            obsCountEdit.textContent = obsEdit.value.length;
            obsEdit.addEventListener('input', function() {
                obsCountEdit.textContent = this.value.length;
            });
        }

        // Auto-cerrar alertas tras 4 segundos
        setTimeout(function() {
            $('.alert-dismissible').fadeOut('slow');
        }, 4000);
    </script>
@stop
