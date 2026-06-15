{{-- resources/views/admin/planillas/index.blade.php --}}

@extends('adminlte::page')

@section('title', 'Planillas de Transporte')

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

        .custom-file-label-premium {
            background-color: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            color: rgba(255, 255, 255, 0.6) !important;
            border-radius: 8px !important;
            height: calc(2.25rem + 2px) !important;
            line-height: 1.8;
        }
        .custom-file-label-premium::after {
            background-color: rgba(255, 255, 255, 0.08) !important;
            color: #fff !important;
            border-left: 1px solid rgba(255, 255, 255, 0.08) !important;
            border-radius: 0 8px 8px 0 !important;
            height: 100% !important;
            padding: .375rem .75rem !important;
        }

        .badge-premium {
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-premium-success {
            background: rgba(16, 185, 129, 0.12);
            color: #10B981;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .pagination .page-link {
            background-color: rgba(255, 255, 255, 0.03) !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
            color: #94A3B8 !important;
        }
        .pagination .page-item.active .page-link {
            background-color: #0EA5E9 !important;
            border-color: #0EA5E9 !important;
            color: #fff !important;
        }
        .pagination .page-item.disabled .page-link {
            background-color: rgba(255, 255, 255, 0.01) !important;
            border-color: rgba(255, 255, 255, 0.04) !important;
        }
    </style>
@stop

@section('content_header')
    <div class="d-flex justify-content-between align-items-center header-dashboard-container">
        <h1 class="text-white font-weight-bold dashboard-title-main m-0">
            <i class="fas fa-file-invoice-dollar mr-2"></i>Planillas de Transporte
        </h1>
        <span class="dashboard-date-badge">
            <i class="fa fa-calendar-alt mr-1"></i> Hoy: {{ \Carbon\Carbon::now()->format('d/m/Y') }}
        </span>
    </div>
@stop

@section('content')
<div class="container-fluid pb-4 premium-container">

    {{-- Alertas de Éxito y Error --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mt-2" style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.25) !important; color: #34D399;" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle mr-2 fa-lg"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="color: #34D399;">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mt-2" style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.25) !important; color: #F87171;" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-triangle mr-2 fa-lg"></i>
                <div>
                    <strong class="d-block mb-1">Por favor corrige los errores del formulario:</strong>
                    <ul class="mb-0 pl-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="color: #F87171;">&times;</span>
            </button>
        </div>
    @endif

    {{-- Tabla de Contenido --}}
    <div class="row">
        <div class="col-12">
            <div class="card-custom-premium">
                <div class="card-header-premium">
                    <h3 class="card-title-premium">
                        <i class="fas fa-list mr-2" style="color: #0EA5E9;"></i>Listado de Planillas
                    </h3>
                    <div class="card-tools d-flex align-items-center" style="gap: 10px;">
                        <a href="{{ route('admin.planilla.plantilla') }}" class="btn btn-outline-success btn-sm font-weight-bold shadow-sm px-3" style="border-radius: 8px;">
                            <i class="fas fa-file-excel mr-1"></i> Descargar Plantilla
                        </a>
                        <button class="btn btn-sm font-weight-bold shadow-sm px-3 text-white" data-toggle="modal" data-target="#modalImportarPlanilla" style="background: #0EA5E9; border: none; border-radius: 8px;">
                            <i class="fas fa-upload mr-1"></i> Importar Guías (Excel)
                        </button>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-premium mb-0">
                            <thead>
                                <tr>
                                    <th width="10%" class="text-center border-0"># ID</th>
                                    <th width="25%" class="border-0">N° Planilla</th>
                                    <th width="25%" class="border-0">Ruta de Destino</th>
                                    <th width="15%" class="text-center border-0">Piezas</th>
                                    <th width="15%" class="text-center border-0">Kilos</th>
                                    <th width="10%" class="text-center border-0">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($planillas as $planilla)
                                    <tr>
                                        <td class="text-center align-middle font-weight-bold" style="color: rgba(255,255,255,0.3);">#{{ $planilla->id }}</td>
                                        <td class="align-middle">
                                            <span class="badge-premium badge-premium-success">
                                                {{ $planilla->numero_planilla ?? 'Sin número' }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-white font-weight-bold">
                                            {{ $planilla->ruta->nombre ?? 'Ruta #'.$planilla->id_ruta }}
                                        </td>
                                        <td class="text-center align-middle text-white font-weight-bold">
                                            {{ $planilla->piezas }}
                                        </td>
                                        <td class="text-center align-middle text-white font-weight-bold">
                                            {{ $planilla->kilos }} kg
                                        </td>
                                        <td class="text-center align-middle">
                                            <a href="{{ route('admin.planilla.edit', $planilla->id) }}" class="btn btn-sm btn-info shadow-sm mr-1" title="Ver Guías" style="border-radius: 6px;">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="{{ route('admin.planilla.destroy', $planilla->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger shadow-sm" title="Eliminar" style="border-radius: 6px;" onclick="return confirm('¿Seguro que desea eliminar esta planilla?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-5" style="background: transparent;">
                                            <i class="fas fa-folder-open fa-3x mb-3 text-muted" style="opacity: 0.3;"></i>
                                            <p class="mb-0 font-weight-bold">No hay planillas registradas.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                @if($planillas->hasPages())
                    <div class="card-footer border-top py-3" style="background: transparent; border-top: 1px solid rgba(255, 255, 255, 0.05) !important;">
                        <div class="d-flex justify-content-center">{{ $planillas->links() }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Modal Importar Planilla (Excel) --}}
<div class="modal fade" id="modalImportarPlanilla" tabindex="-1" role="dialog" aria-labelledby="modalImportarPlanillaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-premium">
            <form action="{{ route('admin.planilla.importar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header modal-header-premium">
                    <h5 class="modal-title font-weight-bold mb-0" id="modalImportarPlanillaLabel">
                        <i class="fas fa-upload mr-2" style="color: #0EA5E9;"></i>Importar Guías (Excel)
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-body-premium">
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                            <label for="id_ruta" class="font-weight-bold text-white mb-1">Ruta Asignada <span class="text-danger">*</span></label>
                            <select name="id_ruta" id="id_ruta" class="form-control form-control-premium" required>
                                <option value="">-- Seleccionar ruta --</option>
                                @foreach($rutas as $ruta)
                                    <option value="{{ $ruta->id }}">{{ $ruta->nombre ?? 'Ruta #'.$ruta->id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label for="excel" class="font-weight-bold text-white mb-1">Archivo Excel (.xlsx) <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" name="excel" class="custom-file-input" id="excel" accept=".xlsx, .xls, .csv" required>
                                <label class="custom-file-label custom-file-label-premium" for="excel">Elegir archivo...</label>
                            </div>
                            <small class="form-text text-muted mt-2"><i class="fas fa-info-circle mr-1"></i>Asegúrese de usar la plantilla oficial para evitar errores de validación.</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-premium">
                    <button type="button" class="btn btn-outline-light font-weight-bold" style="border-radius: 8px;" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary-premium"><i class="fas fa-cogs mr-1"></i> Procesar Excel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    @if ($errors->any())
        $(document).ready(function () {
            $('#modalImportarPlanilla').modal('show');
        });
    @endif

    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    setTimeout(function () {
        $('.alert-dismissible').fadeOut('slow');
    }, 4000);
</script>
@stop