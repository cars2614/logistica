@extends('adminlte::page')

@section('title', 'Tipos de Vehículo — Carga y Logística Tolima')

@section('content_header')
    <div class="container-fluid pt-3 header-module-container">
        <div class="d-flex justify-content-between align-items-center pb-2">
            <h1 class="m-0 font-weight-bold text-white module-title-main">
                <i class="fas fa-truck mr-2"></i>Tipos de Vehículo
            </h1>
            <ol class="breadcrumb m-0 bg-transparent p-0 custom-breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
                <li class="breadcrumb-item active text-muted">Tipos de Vehículo</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid pb-4 premium-module-wrap">

        {{-- Alertas con diseño premium traslúcido --}}
        @if (session('success'))
            <div class="alert alert-premium-success alert-dismissible fade show mt-2" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle mr-2 fa-lg" style="color: #34D399;"></i>
                    <div class="text-white font-weight-medium">{{ session('success') }}</div>
                </div>
                <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close"
                    style="opacity: 0.5;">
                    <span aria-hidden="true">&times;</span>
                    </< /button>
            </div>
        @endif

        <div class="row mt-3">
            <div class="col-12">
                <div class="card-premium-box">
                    <div class="card-header-premium d-flex align-items-center justify-content-between">
                        <h3 class="card-title-premium">
                            <i class="fas fa-list style-icon-lead"></i>Listado de Tipos de Vehículo
                        </h3>
                        <div class="card-tools d-flex align-items-center" style="gap: 12px;">
                            <span class="badge-count-premium">
                                Total: {{ $tipoVehiculos->total() }}
                            </span>
                            <button class="btn-premium-trigger" data-toggle="modal" data-target="#modalCrear">
                                <i class="fas fa-plus mr-1"></i> Nuevo Tipo
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive table-responsive-cards">
                            <table class="table table-premium-mod table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th width="8%" class="text-center">#</th>
                                        <th width="35%">Nombre</th>
                                        <th width="42%">Descripción</th>
                                        <th width="15%" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tipoVehiculos as $index => $tipoVehiculo)
                                        <tr>
                                            <td data-label="#" class="text-center font-weight-bold"
                                                style="color: rgba(255, 255, 255, 0.35);">
                                                {{ $tipoVehiculos->firstItem() + $index }}
                                            </td>
                                            <td data-label="Nombre">
                                                <strong class="text-white text-uppercase"
                                                    style="font-size: 0.88rem; letter-spacing: 0.2px;">
                                                    <i class="fas fa-truck-moving mr-2"
                                                        style="color: #0EA5E9; opacity: 0.8; font-size: 0.85rem;"></i>{{ $tipoVehiculo->nombre }}
                                                </strong>
                                            </td>
                                            <td data-label="Descripción">
                                                <span style="color: rgba(255, 255, 255, 0.65); font-size: 0.85rem;">
                                                    {{ $tipoVehiculo->descripcion ?? '—' }}
                                                </span>
                                            </td>
                                            <td data-label="Acciones" class="text-center">
                                                <div class="d-inline-flex" style="gap: 6px;">
                                                    {{-- Editar --}}
                                                    <a href="{{ route('admin.tipo-vehiculo.edit', $tipoVehiculo->id) }}"
                                                        class="btn-action-edit" title="Editar">
                                                        <i class="fas fa-pen fa-sm"></i>
                                                    </a>

                                                    {{-- Eliminar --}}
                                                    <form
                                                        action="{{ route('admin.tipo-vehiculo.destroy', $tipoVehiculo->id) }}"
                                                        method="POST" class="d-inline form-eliminar">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn-action-delete btn-eliminar"
                                                            title="Eliminar" data-nombre="{{ $tipoVehiculo->nombre }}">
                                                            <i class="fas fa-trash fa-sm"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5"
                                                style="background-color: transparent;">
                                                <i class="fas fa-folder-open fa-3x mb-3"
                                                    style="color: rgba(255, 255, 255, 0.15);"></i>
                                                <p class="mb-0 font-weight-bold" style="color: rgba(255, 255, 255, 0.45);">
                                                    No hay tipos de vehículo registrados.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if ($tipoVehiculos->hasPages())
                        <div class="card-footer-premium py-3 border-top-divider">
                            <div class="d-flex justify-content-center custom-premium-pagination">
                                {{ $tipoVehiculos->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Crear Premium --}}
    <div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="modalCrearLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-premium-box border-0 shadow-lg">
                <form action="{{ route('admin.tipo-vehiculo.store') }}" method="POST">
                    @csrf
                    <div
                        class="modal-header-premium border-bottom-divider py-3 px-4 d-flex align-items-center justify-content-between">
                        <h5 class="modal-title font-weight-bold mb-0 text-white" id="modalCrearLabel">
                            <i class="fas fa-plus-circle mr-2" style="color: #0EA5E9;"></i>Nuevo Tipo de Vehículo
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"
                            style="opacity: 0.6; background: transparent; border: none; font-size: 1.5rem;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">

                        {{-- Nombre --}}
                        <div class="form-group mb-4">
                            <label for="nombre_modal" class="premium-label">Nombre <span
                                    class="required-dot">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text-premium"><i class="fas fa-tag"></i></span>
                                </div>
                                <input type="text" name="nombre" id="nombre_modal"
                                    class="form-control premium-input @error('nombre') is-invalid @enderror"
                                    value="{{ old('nombre') }}" placeholder="Ej: Camión 5 Ton" maxlength="100"
                                    autocomplete="off" onkeypress="return /[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s]/.test(event.key)"
                                    required>
                                @error('nombre')
                                    <span class="invalid-feedback font-weight-bold mt-2" style="color: #F87171;"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                @enderror
                            </div>
                            <small class="form-text-hint"><i class="fas fa-info-circle mr-1"></i>Letras, números, espacios
                                y tildes. Máx. 100 caracteres.</small>
                        </div>

                        {{-- Descripción --}}
                        <div class="form-group mb-2">
                            <label for="descripcion_modal" class="premium-label">Descripción</label>
                            <textarea name="descripcion" id="descripcion_modal"
                                class="form-control premium-textarea @error('descripcion') is-invalid @enderror" rows="3" maxlength="255"
                                placeholder="Opcional..." style="resize: none;">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <span class="invalid-feedback font-weight-bold mt-2" style="color: #F87171;"><i
                                        class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                            <div class="d-flex justify-content-between mt-2">
                                <small class="form-text-hint"><i class="fas fa-info-circle mr-1"></i>Detalles breves del
                                    tipo.</small>
                                <small class="form-text-hint font-weight-bold"><span id="desc-count-modal"
                                        style="color: #0EA5E9;">0</span>/255</small>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer-premium border-top-divider py-3 px-4 d-flex justify-content-end"
                        style="gap: 10px;">
                        <button type="button" class="btn-premium-modal-close" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i>Cancelar
                        </button>
                        <button type="submit" class="btn-premium-modal-save">
                            <i class="fas fa-save mr-1"></i>Guardar Tipo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Confirmación Eliminar Premium --}}
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-premium-box border-0 shadow-lg">
                <div
                    class="modal-header-premium border-bottom-divider py-3 px-4 d-flex align-items-center justify-content-between">
                    <h5 class="modal-title font-weight-bold mb-0 text-white">
                        <i class="fas fa-exclamation-triangle mr-2" style="color: #EF4444;"></i>Confirmar Eliminación
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal"
                        style="opacity: 0.6; background: transparent; border: none; font-size: 1.5rem;">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <p class="mb-3 text-white" style="font-size: 1rem; font-weight: 500;">¿Está completamente seguro de
                        eliminar el tipo de vehículo <strong id="nombreEliminar"
                            style="color: #EF4444; text-shadow: 0 0 10px rgba(239,68,68,0.2);"></strong>?</p>
                    <div class="premium-danger-notice">
                        <i class="fas fa-info-circle mr-2" style="font-size: 1.1rem; flex-shrink: 0;"></i>
                        <span>Esta acción es permanente y afectará a los vehículos asociados a este tipo.</span>
                    </div>
                </div>
                <div class="modal-footer-premium border-top-divider py-3 px-4 d-flex justify-content-end"
                    style="gap: 10px;">
                    <button type="button" class="btn-premium-modal-close" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Cancelar
                    </button>
                    <button type="button" class="btn-premium-modal-danger" id="btnConfirmarEliminar">
                        <i class="fas fa-trash-alt mr-1"></i>Eliminar Registro
                    </button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        /* ── BASE GENERAL DEL CONTENEDOR ── */
        .content-wrapper {
            background-color: #0A0F1E !important;
            position: relative;
            overflow-x: hidden;
        }

        .content-wrapper::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.015) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.015) 1px, transparent 1px);
            background-size: 35px 35px;
            pointer-events: none;
            z-index: 1;
        }

        .premium-module-wrap {
            font-family: 'Inter', sans-serif;
            position: relative;
            z-index: 2;
        }

        .header-module-container {
            margin-bottom: 10px;
        }

        .module-title-main {
            font-size: 24px;
            letter-spacing: -0.02em;
        }

        .module-title-main i {
            color: #0EA5E9;
        }

        .custom-breadcrumb .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.45);
            transition: color 0.2s;
        }

        .custom-breadcrumb .breadcrumb-item a:hover {
            color: #0EA5E9;
            text-decoration: none;
        }

        .custom-breadcrumb .breadcrumb-item::before {
            color: rgba(255, 255, 255, 0.2) !important;
        }

        /* ── COMPONENTES TARJETA (CARDS) ── */
        .card-premium-box {
            background: rgba(13, 19, 35, 0.65) !important;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            margin-bottom: 24px;
            overflow: hidden;
        }

        .card-header-premium {
            padding: 20px 24px;
            background: transparent;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        .card-title-premium {
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-title-premium .style-icon-lead {
            color: #0EA5E9;
        }

        .badge-count-premium {
            background: rgba(14, 165, 233, 0.15);
            color: #38BDF8;
            font-size: 13px;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 8px;
            border: 1px solid rgba(14, 165, 233, 0.2);
        }

        /* ── BOTONES DE ACCIÓN INTERACTIVOS ── */
        .btn-premium-trigger {
            background: linear-gradient(135deg, #0EA5E9 0%, #2563EB 100%) !important;
            border: none !important;
            border-radius: 10px !important;
            color: #fff !important;
            font-weight: 600 !important;
            font-size: 13px !important;
            padding: 8px 18px !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: transform 0.2s ease, box-shadow 0.2s ease !important;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.2);
        }

        .btn-premium-trigger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(14, 165, 233, 0.35) !important;
        }

        /* ── TABLAS DE DATOS PREMIUM ── */
        .table-premium-mod th {
            background-color: rgba(255, 255, 255, 0.01) !important;
            color: #94A3B8 !important;
            font-size: 11px !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06) !important;
            padding: 16px !important;
            border-top: none !important;
        }

        .table-premium-mod td {
            padding: 16px !important;
            vertical-align: middle !important;
            color: #E2E8F0 !important;
            font-size: 14px !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03) !important;
            border-top: none !important;
        }

        .table-premium-mod tbody tr {
            transition: background-color 0.2s ease;
        }

        .table-premium-mod tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.02) !important;
        }

        /* ── BOTONES DE ACCIÓN INTERNOS ── */
        .btn-action-edit {
            background: rgba(14, 165, 233, 0.1) !important;
            border: 1px solid rgba(14, 165, 233, 0.2) !important;
            color: #38BDF8 !important;
            border-radius: 8px !important;
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .btn-action-edit:hover {
            background: #0EA5E9 !important;
            color: #fff !important;
            transform: scale(1.05);
            text-decoration: none;
        }

        .btn-action-delete {
            background: rgba(239, 68, 68, 0.1) !important;
            border: 1px solid rgba(239, 68, 68, 0.2) !important;
            color: #F87171 !important;
            border-radius: 8px !important;
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            cursor: pointer;
        }

        .btn-action-delete:hover {
            background: #EF4444 !important;
            color: #fff !important;
            transform: scale(1.05);
        }

        /* ── MODALES PREMIUM ADAPTADOS ── */
        .modal-premium-box {
            background: #0D1324 !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            border-radius: 16px !important;
        }

        .modal-header-premium {
            background: transparent;
        }

        .modal-footer-premium {
            background: transparent;
        }

        .border-bottom-divider {
            border-bottom: 1px solid rgba(255, 255, 255, 0.06) !important;
        }

        .border-top-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.06) !important;
        }

        /* FORMULARIOS INTERNOS DEL MODAL */
        .premium-label {
            font-size: 12px;
            font-weight: 600;
            color: #94A3B8;
            letter-spacing: 0.02em;
            margin-bottom: 8px;
            text-transform: uppercase;
            display: block;
        }

        .premium-label .required-dot {
            color: #EF4444;
        }

        .input-group-text-premium {
            background-color: rgba(10, 15, 30, 0.6) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            border-right: none !important;
            border-top-left-radius: 10px !important;
            border-bottom-left-radius: 10px !important;
            color: rgba(255, 255, 255, 0.4) !important;
            padding: 0 14px;
            display: flex;
            align-items: center;
        }

        .premium-input {
            background-color: rgba(10, 15, 30, 0.6) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            border-top-right-radius: 10px !important;
            border-bottom-right-radius: 10px !important;
            color: #FFFFFF !important;
            padding: 12px 14px !important;
            font-size: 14px !important;
            transition: all 0.2s ease-in-out !important;
            height: auto !important;
        }

        .premium-input:focus {
            border-color: #0EA5E9 !important;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.15) !important;
        }

        .premium-input::placeholder {
            color: rgba(255, 255, 255, 0.25);
        }

        .premium-textarea {
            background-color: rgba(10, 15, 30, 0.6) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            border-radius: 10px !important;
            color: #FFFFFF !important;
            padding: 12px 14px !important;
            font-size: 14px !important;
            transition: all 0.2s ease-in-out !important;
        }

        .premium-textarea:focus {
            border-color: #0EA5E9 !important;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.15) !important;
        }

        .form-text-hint {
            color: rgba(255, 255, 255, 0.35);
            font-size: 11px;
            margin-top: 6px;
        }

        /* BOTONES MODAL */
        .btn-premium-modal-save {
            background: linear-gradient(135deg, #0EA5E9 0%, #2563EB 100%) !important;
            border: none !important;
            border-radius: 10px !important;
            color: #fff !important;
            font-weight: 600 !important;
            font-size: 14px !important;
            padding: 10px 22px !important;
            transition: all 0.2s;
        }

        .btn-premium-modal-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(14, 165, 233, 0.3);
        }

        .btn-premium-modal-close {
            background: rgba(255, 255, 255, 0.04) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            border-radius: 10px !important;
            color: #94A3B8 !important;
            font-weight: 500 !important;
            font-size: 14px !important;
            padding: 10px 22px !important;
            transition: all 0.2s;
        }

        .btn-premium-modal-close:hover {
            background: rgba(255, 255, 255, 0.08) !important;
            color: #fff !important;
        }

        .btn-premium-modal-danger {
            background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%) !important;
            border: none !important;
            border-radius: 10px !important;
            color: #fff !important;
            font-weight: 600 !important;
            font-size: 14px !important;
            padding: 10px 22px !important;
            transition: all 0.2s;
        }

        .btn-premium-modal-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(239, 68, 68, 0.3);
        }

        /* CAJA DE ADVERTENCIA ELIMINAR */
        .premium-danger-notice {
            display: flex;
            align-items: flex-start;
            background: rgba(239, 68, 68, 0.08);
            border-left: 4px solid #EF4444;
            padding: 12px 16px;
            border-radius: 8px;
            color: #FCA5A5;
            font-size: 0.88rem;
        }

        /* ALERTAS SUTILES */
        .alert-premium-success {
            background: rgba(16, 185, 129, 0.1) !important;
            border: 1px solid rgba(16, 185, 129, 0.2) !important;
            border-radius: 12px !important;
            padding: 16px !important;
        }

        /* PAGINACIÓN ADAPTADA */
        .card-footer-premium {
            background: transparent;
        }

        .custom-premium-pagination .page-item .page-link {
            background-color: rgba(255, 255, 255, 0.03) !important;
            border-color: rgba(255, 255, 255, 0.06) !important;
            color: rgba(255, 255, 255, 0.6) !important;
        }

        .custom-premium-pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #0EA5E9 0%, #2563EB 100%) !important;
            border-color: transparent !important;
            color: #fff !important;
        }

        .custom-premium-pagination .page-item.disabled .page-link {
            background-color: rgba(255, 255, 255, 0.01) !important;
            border-color: rgba(255, 255, 255, 0.02) !important;
            color: rgba(255, 255, 255, 0.2) !important;
        }
    </style>
@stop

@section('js')
    <script>
        // Nota: La validación de nombre es manejada globalmente por LogisticaValidator
        // en page.blade.php (initAlphanumericInput para input[name="nombre"])

        // Contador dinámico de caracteres en descripción modal
        const descModal = document.getElementById('descripcion_modal');
        const countModal = document.getElementById('desc-count-modal');
        countModal.textContent = descModal.value.length;
        descModal.addEventListener('input', function() {
            countModal.textContent = this.value.length;
        });

        // Manejo personalizado de eliminación
        let formEliminar = null;
        document.querySelectorAll('.btn-eliminar').forEach(function(btn) {
            btn.addEventListener('click', function() {
                document.getElementById('nombreEliminar').textContent = this.getAttribute('data-nombre');
                formEliminar = this.closest('form');
                $('#modalEliminar').modal('show');
            });
        });

        document.getElementById('btnConfirmarEliminar').addEventListener('click', function() {
            if (formEliminar) formEliminar.submit();
        });

        // Reabrir modal en caso de que falle la validación backend
        @if ($errors->any())
            $(document).ready(function() {
                $('#modalCrear').modal('show');
            });
        @endif

        // Cierre controlado de alertas
        setTimeout(function() {
            document.querySelectorAll('.alert-premium-success').forEach(function(alert) {
                $(alert).fadeOut('slow');
            });
        }, 4000);
    </script>
@stop
