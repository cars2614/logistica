@extends('adminlte::page')

@section('title', 'Detalle Planilla #' . $planilla->numero_planilla)

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

        /* KPI Cards */
        .kpi-card-premium {
            border-radius: 16px;
            padding: 20px;
            position: relative;
            overflow: hidden;
            margin-bottom: 24px;
            border: 1px solid rgba(255, 255, 255, 0.04);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
            transition: transform 0.25s ease, border-color 0.25s ease;
        }
        .kpi-card-premium:hover {
            transform: translateY(-4px);
            border-color: rgba(255, 255, 255, 0.1);
        }
        
        .kpi-blue { background: linear-gradient(135deg, #0B3C5D 0%, #06243A 100%); }
        .kpi-green { background: linear-gradient(135deg, #063C2E 0%, #03241B 100%); }
        .kpi-yellow { background: linear-gradient(135deg, #5C4B0B 0%, #362B03 100%); }
        .kpi-teal { background: linear-gradient(135deg, #0B5C55 0%, #033632 100%); }
        
        .kpi-icon-box {
            width: 44px; height: 44px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.06);
            display: flex; align-items: center; justify-content: center;
            margin-right: 15px; color: #fff; font-size: 18px;
            flex-shrink: 0;
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
            padding: 15px !important;
        }

        .table-premium td {
            padding: 15px !important;
            vertical-align: middle !important;
            color: #E2E8F0 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03) !important;
        }

        .table-premium tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.02) !important;
        }

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

        .avatar-circle-premium {
            width: 32px; height: 32px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 12px;
            color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        }
        .avatar-origen { background: linear-gradient(135deg, #0EA5E9 0%, #0284C7 100%); }
        .avatar-destino { background: linear-gradient(135deg, #10B981 0%, #059669 100%); }
    </style>
@stop

@section('content_header')
    <div class="d-flex justify-content-between align-items-center header-dashboard-container">
        <h1 class="text-white font-weight-bold dashboard-title-main m-0">
            <i class="fas fa-clipboard-list mr-2"></i>Planilla <strong>#{{ $planilla->numero_planilla }}</strong>
        </h1>
        <span class="dashboard-date-badge">
            <i class="fa fa-calendar-alt mr-1"></i> Creada: {{ $planilla->created_at->format('d/m/Y') }}
        </span>
    </div>
@stop

@section('content')
<div class="container-fluid pb-4 premium-container">

    {{-- Alertas --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mt-2" style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.25) !important; color: #34D399;" role="alert">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

    {{-- KPI Cards --}}
    <div class="row">
        {{-- Número de Planilla --}}
        <div class="col-lg-3 col-sm-6">
            <div class="kpi-card-premium kpi-blue">
                <div class="d-flex align-items-center">
                    <div class="kpi-icon-box"><i class="fas fa-file-alt"></i></div>
                    <div>
                        <p class="text-white mb-0 small text-uppercase" style="opacity: 0.6; font-size: 11px;">N° Planilla</p>
                        <h4 class="font-weight-bold mb-0 text-white">{{ $planilla->numero_planilla }}</h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- Ruta --}}
        <div class="col-lg-3 col-sm-6">
            <div class="kpi-card-premium kpi-green">
                <div class="d-flex align-items-center">
                    <div class="kpi-icon-box"><i class="fas fa-route"></i></div>
                    <div>
                        <p class="text-white mb-0 small text-uppercase" style="opacity: 0.6; font-size: 11px;">Ruta</p>
                        <h5 class="font-weight-bold mb-0 text-white">{{ $planilla->ruta->nombre ?? 'Sin ruta' }}</h5>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Piezas --}}
        <div class="col-lg-3 col-sm-6">
            <div class="kpi-card-premium kpi-yellow">
                <div class="d-flex align-items-center">
                    <div class="kpi-icon-box"><i class="fas fa-boxes"></i></div>
                    <div>
                        <p class="text-white mb-0 small text-uppercase" style="opacity: 0.6; font-size: 11px;">Total Piezas</p>
                        <h4 class="font-weight-bold mb-0 text-white">{{ $planilla->piezas ?? $planilla->guias->sum('unidades') }}</h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Kilos --}}
        <div class="col-lg-3 col-sm-6">
            <div class="kpi-card-premium kpi-teal">
                <div class="d-flex align-items-center">
                    <div class="kpi-icon-box"><i class="fas fa-weight-hanging"></i></div>
                    <div>
                        <p class="text-white mb-0 small text-uppercase" style="opacity: 0.6; font-size: 11px;">Total Kilos</p>
                        <h4 class="font-weight-bold mb-0 text-white">{{ number_format($planilla->kilos ?? $planilla->guias->sum('peso'), 2) }} kg</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabla de Guías Vinculadas --}}
    <div class="row">
        <div class="col-12">
            <div class="card-custom-premium">
                <div class="card-header-premium">
                    <h3 class="card-title-premium">
                        <i class="fas fa-shipping-fast mr-2" style="color: #0EA5E9;"></i>Guías en esta Planilla
                        <span class="badge badge-light ml-2" style="border-radius: 6px; font-weight: 700;">{{ $planilla->guias->count() }}</span>
                    </h3>
                    <a href="{{ route('admin.planilla.index') }}" class="btn btn-sm" style="border-radius: 8px; border: 1px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.04); color: #fff; font-weight: 500;">
                        <i class="fas fa-arrow-left mr-1"></i> Volver a Planillas
                    </a>
                </div>

                <div class="card-body p-0">
                    @if($planilla->guias->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-premium mb-0" id="tablaGuiasPlanilla">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 60px;">#</th>
                                        <th>Guía ID</th>
                                        <th>Remitente</th>
                                        <th>Destinatario</th>
                                        <th class="text-center">Piezas</th>
                                        <th class="text-center">Peso (kg)</th>
                                        <th class="text-center">Valor Declarado</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center" style="width: 100px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($planilla->guias as $index => $guia)
                                        @php
                                            $estadoActual = $guia->estados->sortByDesc('id')->first();
                                            $nombreEstado = $estadoActual->estado ?? 'Registrada';

                                            $badgeClass = match(strtolower($nombreEstado)) {
                                                'entregado', 'entregada' => 'badge-premium-success',
                                                'en tránsito', 'en transito', 'en camino' => 'badge-premium-info',
                                                'en bodega', 'recibida' => 'badge-premium-warning',
                                                'devuelta', 'rechazada' => 'badge-premium-danger',
                                                default => 'badge-premium-secondary',
                                            };
                                        @endphp
                                        <tr>
                                            <td class="text-center align-middle font-weight-bold" style="color: rgba(255,255,255,0.3);">{{ $index + 1 }}</td>
                                            <td class="align-middle">
                                                <i class="fas fa-barcode text-muted mr-1"></i>
                                                <strong class="text-white">{{ $guia->id }}</strong>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle-premium avatar-origen mr-2">
                                                        {{ strtoupper(substr($guia->clienteOrigen->nombre ?? 'N', 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div class="font-weight-bold text-white">{{ $guia->clienteOrigen->nombre ?? 'N/A' }}</div>
                                                        <small class="text-muted">
                                                            <i class="fas fa-id-card mr-1"></i>{{ $guia->clienteOrigen->cedula ?? '' }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle-premium avatar-destino mr-2">
                                                        {{ strtoupper(substr($guia->clienteDestino->nombre ?? 'N', 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div class="font-weight-bold text-white">{{ $guia->clienteDestino->nombre ?? 'N/A' }}</div>
                                                        <small class="text-muted">
                                                            <i class="fas fa-id-card mr-1"></i>{{ $guia->clienteDestino->cedula ?? '' }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle text-white font-weight-bold">
                                                {{ $guia->unidades }}
                                            </td>
                                            <td class="text-center align-middle text-white font-weight-bold">
                                                {{ number_format($guia->peso, 2) }}
                                            </td>
                                            <td class="text-center align-middle text-white">
                                                ${{ number_format($guia->valor_declarado ?? 0, 0, ',', '.') }}
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="badge-estado-premium {{ $badgeClass }}">
                                                    {{ $nombreEstado }}
                                                </span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="{{ route('admin.guia.edit', $guia->id) }}" 
                                                   class="btn btn-sm btn-info shadow-sm" title="Ver/Editar Guía" style="border-radius: 6px;">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="font-weight-bold" style="background: rgba(255,255,255,0.02); color: #fff;">
                                        <td colspan="4" class="text-right text-uppercase small" style="border-top: 1px solid rgba(255, 255, 255, 0.05) !important;">Totales de la Planilla:</td>
                                        <td class="text-center text-info" style="border-top: 1px solid rgba(255, 255, 255, 0.05) !important;">{{ $planilla->guias->sum('unidades') }}</td>
                                        <td class="text-center text-info" style="border-top: 1px solid rgba(255, 255, 255, 0.05) !important;">{{ number_format($planilla->guias->sum('peso'), 2) }}</td>
                                        <td class="text-center text-info" style="border-top: 1px solid rgba(255, 255, 255, 0.05) !important;">${{ number_format($planilla->guias->sum('valor_declarado'), 0, ',', '.') }}</td>
                                        <td colspan="2" style="border-top: 1px solid rgba(255, 255, 255, 0.05) !important;"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3" style="opacity: 0.3;"></i>
                            <h5 class="text-muted">No hay guías vinculadas a esta planilla</h5>
                            <p class="text-muted">Importa un archivo Excel desde el listado de planillas para agregar guías.</p>
                            <a href="{{ route('admin.planilla.index') }}" class="btn btn-primary-premium">
                                <i class="fas fa-upload mr-1"></i> Ir a Importar
                            </a>
                        </div>
                    @endif
                </div>

                @if($planilla->guias->count() > 0)
                    <div class="card-footer text-muted small d-flex justify-content-between" style="background: transparent; border-top: 1px solid rgba(255, 255, 255, 0.05) !important;">
                        <span>
                            <i class="fas fa-calendar-alt mr-1"></i>
                            Creada: {{ $planilla->created_at->format('d/m/Y H:i') }}
                        </span>
                        <span>
                            <i class="fas fa-truck mr-1"></i>
                            {{ $planilla->guias->count() }} guía(s) en total
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $(document).ready(function () {
        @if($planilla->guias->count() > 10)
            $('#tablaGuiasPlanilla').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                pageLength: 25,
                order: [[0, 'asc']],
                responsive: true
            });
        @endif
    });
</script>
@stop