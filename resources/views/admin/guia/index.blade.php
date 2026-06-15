{{-- resources/views/admin/guia/index.blade.php --}}

@extends('adminlte::page')

@section('title', 'Gestión de Guías — Carga y Logística Tolima')

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

        .table-premium th {
            background-color: rgba(255, 255, 255, 0.01) !important;
            color: #94A3B8 !important;
            font-size: 12px !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06) !important;
            padding: 12px 15px !important;
        }

        .table-premium td {
            padding: 12px 15px !important;
            vertical-align: middle !important;
            color: #E2E8F0 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03) !important;
            font-size: 13px !important;
        }

        .table-premium tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.02) !important;
        }

        /* Badge status styled */
        .badge-estado-premium {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .badge-premium-success { background: rgba(16, 185, 129, 0.12); color: #10B981; border: 1px solid rgba(16, 185, 129, 0.2); }
        .badge-premium-info { background: rgba(14, 165, 233, 0.12); color: #38BDF8; border: 1px solid rgba(14, 165, 233, 0.2); }
        .badge-premium-warning { background: rgba(245, 158, 11, 0.12); color: #F59E0B; border: 1px solid rgba(245, 158, 11, 0.2); }
        .badge-premium-danger { background: rgba(239, 68, 68, 0.12); color: #EF4444; border: 1px solid rgba(239, 68, 68, 0.2); }
        .badge-premium-secondary { background: rgba(148, 163, 184, 0.12); color: #94A3B8; border: 1px solid rgba(148, 163, 184, 0.2); }

        /* Modals Premium */
        .modal-content-premium {
            background-color: #131A2E !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            border-radius: 16px !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important;
        }

        .modal-header-premium {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
            background: transparent !important;
            color: #fff !important;
            padding: 20px 24px !important;
        }

        .modal-body-premium {
            padding: 24px !important;
        }

        .modal-footer-premium {
            border-top: 1px solid rgba(255, 255, 255, 0.05) !important;
            background: transparent !important;
            padding: 16px 24px !important;
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

        /* Select2 Premium style overrides */
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
            <i class="fas fa-file-alt mr-2"></i>Gestión de Guías
        </h1>
        <span class="dashboard-date-badge">
            <i class="fa fa-calendar-alt mr-1"></i> Hoy: {{ \Carbon\Carbon::now()->format('d/m/Y') }}
        </span>
    </div>
@stop

@section('content')
<div class="container-fluid pb-4 premium-container">

    {{-- Alertas del Sistema --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mt-2" style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.25) !important; color: #34D399;" role="alert">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mt-2" style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.25) !important; color: #F87171;" role="alert">
            <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

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

    {{-- Tabla Principal --}}
    <div class="card-custom-premium">
        <div class="card-header-premium">
            <h3 class="card-title-premium">
                <i class="fas fa-list mr-2" style="color: #0EA5E9;"></i>Listado de Guías
            </h3>
            <button class="btn btn-sm font-weight-bold shadow-sm px-3 text-white" data-toggle="modal" data-target="#modalCrear" style="background: #0EA5E9; border: none; border-radius: 8px;">
                <i class="fas fa-plus mr-1"></i> Nueva Guía
            </button>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-premium mb-0">
                    <thead>
                        <tr>
                            <th>Fecha Admisión</th>
                            <th>N° Guía</th>
                            <th>Tipo Entrega</th>
                            <th>Cliente Origen</th>
                            <th>Cliente Destino</th>
                            <th class="text-center">Unidades</th>
                            <th class="text-center">Peso</th>
                            <th class="text-center">Volumen (L×A×A)</th>
                            <th>Precio Envío</th>
                            <th>Valor Declarado</th>                            
                            <th>Repartidor</th>
                            <th>Estado Actual</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($guias as $guia)
                            @php
                                $estadoActual = $guia->estados->sortByDesc('id')->first();
                                $nombreEstado = $estadoActual->estado ?? 'Registrada';

                                $badgeClass = match(strtolower($nombreEstado)) {
                                    'entregado', 'entregada' => 'badge-premium-success',
                                    'en tránsito', 'en transito', 'en camino', 'en reparto' => 'badge-premium-info',
                                    'en bodega', 'recibida' => 'badge-premium-warning',
                                    'devuelta', 'rechazada' => 'badge-premium-danger',
                                    default => 'badge-premium-secondary',
                                };
                            @endphp
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($guia->created_at)->format('d/m/Y') }}</td>
                                <td><strong class="text-white">GUIA-{{ str_pad($guia->id, 5, '0', STR_PAD_LEFT) }}</strong></td>
                                <td>{{ $guia->tipoEntrega->nombre ?? '—' }}</td>
                                <td class="text-white font-weight-bold">{{ $guia->clienteOrigen->nombre ?? '—' }}</td>
                                <td class="text-white font-weight-bold">{{ $guia->clienteDestino->nombre ?? '—' }}</td>
                                <td class="text-center font-weight-bold text-white">{{ $guia->unidades }}</td>
                                <td class="text-center text-white">{{ $guia->peso }} kg</td>
                                <td class="text-center text-muted">{{ $guia->largo }}×{{ $guia->ancho }}×{{ $guia->alto }} m</td>
                                <td class="text-white">${{ number_format($guia->precio_envio, 0, ',', '.') }}</td>
                                <td class="text-white">${{ number_format($guia->valor_declarado, 0, ',', '.') }}</td>
                                <td>{{ $guia->repartidor->name ?? 'Sin asignar' }}</td>
                                <td>
                                    <span class="badge-estado-premium {{ $badgeClass }}">
                                        {{ $nombreEstado }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-success btn-xs btn-estado mr-1" title="Actualizar Estado"
                                        data-id="{{ $guia->id }}"
                                        data-toggle="modal" data-target="#modalEstado" style="border-radius: 4px;">
                                        <i class="fas fa-truck-loading"></i>
                                    </button>
                                    <a href="{{ route('admin.guia.edit', $guia->id) }}" class="btn btn-warning btn-xs mr-1"
                                        title="Editar" style="border-radius: 4px; color: #111;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('tracking.show', $guia->id) }}" class="btn btn-info btn-xs" title="Ver Tracking" style="border-radius: 4px;">
                                        <i class="fas fa-satellite-dish"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="text-center text-muted py-5" style="background: transparent;">
                                    <i class="fas fa-inbox fa-3x mb-3 text-muted" style="opacity: 0.3;"></i>
                                    <p class="mb-0 font-weight-bold">No hay guías registradas.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Crear Guía --}}
    <div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="modalCrearLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content modal-content-premium">
                <div class="modal-header modal-header-premium">
                    <h5 class="modal-title" id="modalCrearLabel">
                        <i class="fas fa-plus-circle mr-1" style="color: #0EA5E9;"></i> Nueva Guía
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <form action="{{ route('admin.guia.store') }}" method="POST">
                    @csrf
                    <div class="modal-body modal-body-premium">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="text-white">Tipo de Entrega <span class="text-danger">*</span></label>
                                <select name="id_tipo_entrega" class="form-control form-control-premium" required>
                                    <option value="">Seleccione...</option>
                                    @foreach ($tipoEntregas as $tipo)
                                        <option value="{{ $tipo->id }}" {{ old('id_tipo_entrega') == $tipo->id ? 'selected' : '' }}>
                                            {{ $tipo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label class="text-white">Repartidor Asignado (Opcional)</label>
                                <select name="id_repartidor" class="form-control select2" style="width: 100%;">
                                    <option value="">Sin asignar...</option>
                                    @foreach ($repartidores as $repartidor)
                                        <option value="{{ $repartidor->id }}" {{ old('id_repartidor') == $repartidor->id ? 'selected' : '' }}>
                                            {{ $repartidor->name }} ({{ $repartidor->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label class="text-white">Cliente Origen <span class="text-danger">*</span></label>
                                <select name="id_cliente_origen" class="form-control form-control-premium select2-field" required>
                                    <option value="">Seleccione...</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" {{ old('id_cliente_origen') == $cliente->id ? 'selected' : '' }}>
                                           {{ $cliente->cedula }} — {{ $cliente->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label class="text-white">Cliente Destino <span class="text-danger">*</span></label>
                                <select name="id_cliente_destino" class="form-control form-control-premium select2-field" required>
                                    <option value="">Seleccione...</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" {{ old('id_cliente_destino') == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->cedula }} — {{ $cliente->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label class="text-white">Unidades <span class="text-danger">*</span></label>
                                <input type="number" name="unidades" id="m_unidades" class="form-control form-control-premium" value="{{ old('unidades', 1) }}" min="1" required>
                            </div>

                            <div class="col-md-6 form-group">
                                <label class="text-white">Peso (Kg) <span class="text-danger">*</span></label>
                                <input type="number" name="peso" class="form-control form-control-premium" value="{{ old('peso', 1) }}" step="0.01" min="0.01" required>
                            </div>

                            <div class="col-md-4 form-group">
                                <label class="text-white">Largo (m) <span class="text-danger">*</span></label>
                                <input type="number" name="largo" class="form-control form-control-premium" value="{{ old('largo', 0.1) }}" step="0.01" min="0.01" required>
                            </div>

                            <div class="col-md-4 form-group">
                                <label class="text-white">Ancho (m) <span class="text-danger">*</span></label>
                                <input type="number" name="ancho" class="form-control form-control-premium" value="{{ old('ancho', 0.1) }}" step="0.01" min="0.01" required>
                            </div>

                            <div class="col-md-4 form-group">
                                <label class="text-white">Alto (m) <span class="text-danger">*</span></label>
                                <input type="number" name="alto" class="form-control form-control-premium" value="{{ old('alto', 0.1) }}" step="0.01" min="0.01" required>
                            </div>

                            <div class="col-md-6 form-group">
                                <label class="text-white">Precio Envío <span class="text-danger">*</span></label>
                                <input type="number" name="precio_envio" class="form-control form-control-premium" value="{{ old('precio_envio', 9800) }}" step="0.01" min="0" required>
                            </div>

                            <div class="col-md-6 form-group">
                                <label class="text-white">Valor Declarado <span class="text-danger">*</span></label>
                                <input type="number" name="valor_declarado" class="form-control form-control-premium" value="{{ old('valor_declarado', 20000) }}" step="0.01" min="0" required>
                            </div>

                            <div class="col-md-12 form-group">
                                <label class="text-white">Observación</label>
                                <textarea name="observacion" rows="2" class="form-control form-control-premium" style="height: auto !important;">{{ old('observacion') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer modal-footer-premium">
                        <button type="button" class="btn btn-outline-light font-weight-bold" style="border-radius: 8px;" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary-premium">
                            <i class="fas fa-save mr-1"></i> Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Actualizar Estado --}}
    <div class="modal fade" id="modalEstado" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-premium">
                <div class="modal-header modal-header-premium">
                    <h5 class="modal-title"><i class="fas fa-truck-loading mr-2" style="color: #10B981;"></i>Actualizar Estado</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form id="formEstado" method="POST" action="">
                    @csrf
                    <div class="modal-body modal-body-premium">
                        <div class="form-group mb-3">
                            <label class="text-white">Estado <span class="text-danger">*</span></label>
                            <select name="estado" id="estado_select" class="form-control form-control-premium" required>
                                <option value="">Seleccione...</option>
                                <option value="Bodega">Bodega</option>
                                <option value="En tránsito">En tránsito</option>
                                <option value="En reparto">En reparto</option>
                                <option value="Entregado">Entregado</option>
                                <option value="Devuelto">Devuelto</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-white">Descripción <span class="text-danger">*</span></label>
                            <textarea name="descripcion" id="descripcion_text" class="form-control form-control-premium" rows="2" required placeholder="Ej: Paquete recibido en bodega principal..." style="height: auto !important;"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-premium">
                        <button type="button" class="btn btn-outline-light font-weight-bold" style="border-radius: 8px;" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary-premium" style="background: #10B981 !important;"><i class="fas fa-save mr-1"></i> Guardar Estado</button>
                    </div>
                </form>
            </div>
        </div>
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
                dropdownParent: $('#modalCrear'),
                placeholder: 'Buscar repartidor...',
                allowClear: true
            });
            $('.select2-field').select2({
                theme: 'bootstrap4',
                dropdownParent: $('#modalCrear'),
                placeholder: 'Seleccionar cliente...',
                allowClear: true
            });
        });

        // Filtrar solo números enteros
        const uField = document.getElementById('m_unidades');
        if (uField) {
            uField.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });
        }

        // Script para modal de estado
        document.querySelectorAll('.btn-estado').forEach(function(btn) {
            btn.addEventListener('click', function() {
                let id = this.getAttribute('data-id');
                let form = document.getElementById('formEstado');
                form.action = `/admin/guia/${id}/estado`;
            });
        });

        // Reabrir modal en caso de error de validación
        @if ($errors->any())
            $(document).ready(function() {
                $('#modalCrear').modal('show');
            });
        @endif

        // Fadeout alerts
        setTimeout(function() {
            $('.alert-dismissible').fadeOut('slow');
        }, 4000);
    </script>
@stop
