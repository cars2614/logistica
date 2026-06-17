{{-- resources/views/admin/vehiculo/index.blade.php --}}

@extends('adminlte::page')

@section('title', 'Vehículos')

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
        @media (max-width: 768px) {
            .card-custom-premium {
                backdrop-filter: blur(4px);
                -webkit-backdrop-filter: blur(4px);
                background: rgba(13, 19, 35, 0.9) !important;
            }
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

        /* Scrollbar horizontal visible y estilizada */
        .table-responsive {
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch;
        }
        .table-responsive::-webkit-scrollbar {
            height: 10px;
        }
        .table-responsive::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 5px;
        }
        .table-responsive::-webkit-scrollbar-thumb {
            background: rgba(99, 102, 241, 0.4);
            border-radius: 5px;
        }
        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: rgba(99, 102, 241, 0.7);
        }
        .table-premium {
            min-width: 1300px;
        }
        #scrollTop::-webkit-scrollbar {
            height: 10px;
        }
        #scrollTop::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 5px;
        }
        #scrollTop::-webkit-scrollbar-thumb {
            background: rgba(99, 102, 241, 0.4);
            border-radius: 5px;
        }
        #scrollTop::-webkit-scrollbar-thumb:hover {
            background: rgba(99, 102, 241, 0.7);
        }
    </style>
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
@stop

@section('content_header')
    <div class="d-flex justify-content-between align-items-center header-dashboard-container">
        <h1 class="text-white font-weight-bold dashboard-title-main m-0">
            <i class="fas fa-car mr-2"></i>Gestión de Vehículos
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
                <i class="fas fa-car" style="color: #6366F1;"></i> Vehículos Registrados
            </h3>
            <div class="card-tools d-flex align-items-center" style="gap: 12px;">
                <span class="badge" style="background: rgba(99, 102, 241, 0.2); color: #818CF8; border: 1px solid rgba(99, 102, 241, 0.3); padding: 6px 12px; border-radius: 6px;">
                    Total: {{ $vehiculos->total() }}
                </span>
                <button class="btn btn-primary btn-sm font-weight-bold" data-toggle="modal" data-target="#modalCrear" style="background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%); border: none; border-radius: 6px; padding: 6px 16px; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);">
                    <i class="fas fa-plus mr-1"></i> Nuevo Vehículo
                </button>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive table-responsive-cards" id="scrollTop">
                <table class="table table-premium mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">#</th>
                            <th width="12%">Placa</th>
                            <th width="15%">Marca</th>
                            <th width="15%">Modelo</th>
                            <th width="15%">Tipo</th>
                            <th width="12%">Capacidad</th>
                            <th width="12%">Estado</th>
                            <th width="14%">Fecha Registro</th>
                            <th width="10%" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                                @forelse ($vehiculos as $index => $vehiculo)
                                    <tr>
                                        <td data-label="#" class="text-center text-muted">{{ $vehiculos->firstItem() + $index }}</td>
                                        <td data-label="Placa">
                                            <span class="badge" style="background: rgba(255,255,255,0.05); color: #E2E8F0; border: 1px solid rgba(255,255,255,0.1); padding: 5px 10px; font-family: monospace; font-size: 13px;">
                                                {{ $vehiculo->placa }}
                                            </span>
                                        </td>
                                        <td data-label="Marca" style="color: #F8FAFC; font-weight: 500;">{{ $vehiculo->marca }}</td>
                                        <td data-label="Modelo" style="color: #CBD5E1;">{{ $vehiculo->modelo }}</td>
                                        
                                        {{-- Celda con Iconos Dinámicos según el Tipo de Vehículo --}}
                                        <td data-label="Tipo">
                                            @php
                                                $nombreTipo = strtolower($vehiculo->tipoVehiculo->nombre ?? '');
                                                $icono = 'fas fa-car'; 

                                                if (str_contains($nombreTipo, 'moto')) {
                                                    $icono = 'fas fa-motorcycle';
                                                } elseif (str_contains($nombreTipo, 'camion') || str_contains($nombreTipo, 'furgon') || str_contains($nombreTipo, 'tracto') || str_contains($nombreTipo, 'carga')) {
                                                    $icono = 'fas fa-truck';
                                                } elseif (str_contains($nombreTipo, 'cicla') || str_contains($nombreTipo, 'bici')) {
                                                    $icono = 'fas fa-bicycle';
                                                } elseif (str_contains($nombreTipo, 'van') || str_contains($nombreTipo, 'bus') || str_contains($nombreTipo, 'colectivo')) {
                                                    $icono = 'fas fa-bus';
                                                }
                                            @endphp
                                            <i class="{{ $icono }}" style="color: #38BDF8; margin-right: 6px;"></i>
                                            <span style="color: #94A3B8;">{{ $vehiculo->tipoVehiculo->nombre ?? '—' }}</span>
                                        </td>

                                        <td data-label="Capacidad" style="color: #E2E8F0; font-weight: 500;">{{ number_format($vehiculo->capacidad) }} kg</td>
                                        <td data-label="Estado">
                                            @if($vehiculo->estado === 'activo')
                                                <span class="badge-estado-premium badge-premium-success">ACTIVO</span>
                                            @elseif($vehiculo->estado === 'inactivo')
                                                <span class="badge-estado-premium badge-premium-secondary">INACTIVO</span>
                                            @else
                                                <span class="badge-estado-premium badge-premium-warning">MANTENIMIENTO</span>
                                            @endif
                                        </td>
                                        <td data-label="Fecha Registro" style="color: #94A3B8;">
                                            {{ \Carbon\Carbon::parse($vehiculo->fecha_registro)->format('d/m/Y') }}
                                        </td>
                                        <td data-label="Acciones" class="text-center">
                                            <div class="d-inline-flex" style="gap: 8px;">
                                                <a href="{{ route('admin.vehiculo.edit', $vehiculo->id) }}"
                                                   class="btn btn-sm" 
                                                   title="Editar" style="background: rgba(14, 165, 233, 0.1); color: #38BDF8; border: 1px solid rgba(14, 165, 233, 0.2); width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 8px; transition: all 0.2s;">
                                                    <i class="fas fa-pen fa-sm"></i>
                                                </a>
                                                
                                                <form action="{{ route('admin.vehiculo.destroy', $vehiculo->id) }}"
                                                      method="POST" class="d-inline form-eliminar">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        type="button"
                                                        class="btn btn-sm btn-eliminar"
                                                        title="Eliminar"
                                                        style="background: rgba(239, 68, 68, 0.1); color: #F87171; border: 1px solid rgba(239, 68, 68, 0.2); width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 8px; transition: all 0.2s;"
                                                        data-placa="{{ $vehiculo->placa }}"
                                                    >
                                                        <i class="fas fa-trash fa-sm"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-5" style="color: #94A3B8;">
                                            <i class="fas fa-car fa-3x mb-3" style="opacity: 0.3;"></i>
                                            <p class="mb-0 font-weight-bold">No hay vehículos registrados.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($vehiculos->hasPages())
                    <div class="card-footer" style="background: transparent !important; border-top: 1px solid rgba(255, 255, 255, 0.05) !important; padding: 15px 24px;">
                        <div class="d-flex justify-content-center">
                            {{ $vehiculos->links() }}
                        </div>
                    </div>
                @endif
            </div>

</div>

{{-- Modal Crear --}}
<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="modalCrearLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content modal-content-premium">
            <form action="{{ route('admin.vehiculo.store') }}" method="POST">
                @csrf
                <div class="modal-header modal-header-premium">
                    <h5 class="modal-title font-weight-bold mb-0" id="modalCrearLabel">
                        <i class="fas fa-car mr-2 text-primary"></i>Nuevo Vehículo
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.8; text-shadow: none;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-body-premium">
                    <div class="row">

                        {{-- Placa --}}
                        <div class="col-md-6 form-group mb-3">
                            <label for="m_placa" class="font-weight-bold text-secondary mb-1">Placa <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-premium"><i class="fas fa-id-card"></i></span>
                                </div>
                                <input
                                    type="text"
                                    name="placa"
                                    id="m_placa"
                                    class="form-control form-control-premium text-uppercase font-weight-bold @error('placa') is-invalid @enderror"
                                    value="{{ old('placa') }}"
                                    placeholder="Ej: ABC-123"
                                    maxlength="10"
                                    autocomplete="off"
                                    style="text-transform: uppercase; letter-spacing: 0.5px;"
                                    required
                                >
                                @error('placa')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Tipo de Vehículo --}}
                        <div class="col-md-6 form-group mb-3">
                            <label for="m_tipo_vehiculo_id" class="font-weight-bold text-secondary mb-1">Tipo de Vehículo <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-premium"><i class="fas fa-truck"></i></span>
                                </div>
                                <select
                                    name="id_tipo_vehiculo"
                                    id="m_tipo_vehiculo_id"
                                    class="form-control form-control-premium @error('id_tipo_vehiculo') is-invalid @enderror"
                                    required
                                >
                                    <option value="">-- Seleccione --</option>
                                    @foreach($tipoVehiculos as $tipo)
                                        <option value="{{ $tipo->id }}" {{ old('id_tipo_vehiculo') == $tipo->id ? 'selected' : '' }}>
                                            {{ $tipo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_tipo_vehiculo')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Marca --}}
                        <div class="col-md-6 form-group mb-3">
                            <label for="m_marca" class="font-weight-bold text-secondary mb-1">Marca <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-premium"><i class="fas fa-copyright"></i></span>
                                </div>
                                <input
                                    type="text"
                                    name="marca"
                                    id="m_marca"
                                    class="form-control form-control-premium @error('marca') is-invalid @enderror"
                                    value="{{ old('marca') }}"
                                    placeholder="Ej: Chevrolet"
                                    maxlength="100"
                                    required
                                >
                                @error('marca')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Modelo --}}
                        <div class="col-md-6 form-group mb-3">
                            <label for="m_modelo" class="font-weight-bold text-secondary mb-1">Modelo / Línea <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-premium"><i class="fas fa-car-side"></i></span>
                                </div>
                                <input
                                    type="text"
                                    name="modelo"
                                    id="m_modelo"
                                    class="form-control form-control-premium @error('modelo') is-invalid @enderror"
                                    value="{{ old('modelo') }}"
                                    placeholder="Ej: NHR 2022"
                                    maxlength="100"
                                    required
                                >
                                @error('modelo')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Capacidad --}}
                        <div class="col-md-6 form-group mb-3">
                            <label for="m_capacidad" class="font-weight-bold text-secondary mb-1">Capacidad (kg) <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-premium"><i class="fas fa-weight-hanging"></i></span>
                                </div>
                                <input
                                    type="number"
                                    name="capacidad"
                                    id="m_capacidad"
                                    class="form-control form-control-premium @error('capacidad') is-invalid @enderror"
                                    value="{{ old('capacidad') }}"
                                    placeholder="Ej: 5000"
                                    min="1"
                                    required
                                >
                                @error('capacidad')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Estado --}}
                        <div class="col-md-6 form-group mb-3">
                            <label for="m_estado" class="font-weight-bold text-secondary mb-1">Estado inicial <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-premium"><i class="fas fa-toggle-on"></i></span>
                                </div>
                                <select
                                    name="estado"
                                    id="m_estado"
                                    class="form-control form-control-premium @error('estado') is-invalid @enderror"
                                    required
                                >
                                    <option value="">-- Seleccione --</option>
                                    <option value="activo" {{ old('estado') === 'activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="inactivo" {{ old('estado') === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                    <option value="mantenimiento" {{ old('estado') === 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                                </select>
                                @error('estado')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Fecha de Registro --}}
                        <div class="col-md-6 form-group mb-0">
                            <label for="m_fecha_registro" class="font-weight-bold text-secondary mb-1">Fecha de Registro <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-premium"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input
                                    type="date"
                                    name="fecha_registro"
                                    id="m_fecha_registro"
                                    class="form-control form-control-premium @error('fecha_registro') is-invalid @enderror"
                                    value="{{ old('fecha_registro') }}"
                                    required
                                >
                                @error('fecha_registro')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer modal-footer-premium">
                    <button type="button" class="btn text-white" data-dismiss="modal" style="background: rgba(255,255,255,0.1); border: none;">Cancelar</button>
                    <button type="submit" class="btn btn-primary" style="background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%); border: none;">Guardar Vehículo</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Eliminar --}}
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-premium">
            <div class="modal-header modal-header-premium" style="border-bottom: 1px solid rgba(239, 68, 68, 0.2) !important;">
                <h5 class="modal-title font-weight-bold mb-0 text-danger"><i class="fas fa-exclamation-triangle mr-2"></i> Confirmar eliminación</h5>
                <button type="button" class="close text-white" data-dismiss="modal" style="opacity: 0.8; text-shadow: none;"><span>&times;</span></button>
            </div>
            <div class="modal-body modal-body-premium">
                <p class="text-white mb-2">¿Está seguro que desea eliminar el vehículo con placa <strong id="placaEliminar" class="text-danger"></strong>?</p>
            </div>
            <div class="modal-footer modal-footer-premium">
                <button type="button" class="btn text-white" data-dismiss="modal" style="background: rgba(255,255,255,0.1); border: none;">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btnConfirmarEliminar" style="background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%); border: none;">Eliminar Registro</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    const hoy = new Date().toISOString().split('T')[0];
    document.getElementById('m_fecha_registro').setAttribute('max', hoy);

    let formEliminar = null;
    document.querySelectorAll('.btn-eliminar').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById('placaEliminar').textContent = this.getAttribute('data-placa');
            formEliminar = this.closest('form');
            $('#modalEliminar').modal('show');
        });
    });

    document.getElementById('btnConfirmarEliminar').addEventListener('click', function () {
        if (formEliminar) formEliminar.submit();
    });

    @if ($errors->any())
        $(document).ready(function () { $('#modalCrear').modal('show'); });
    @endif

    setTimeout(function () {
        $('.alert-dismissible').fadeOut('slow');
    }, 5000);
</script>
@stop
