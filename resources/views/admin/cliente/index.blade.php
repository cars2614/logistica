@extends('adminlte::page')

@section('title', 'Clientes — Carga y Logística Tolima')

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
            margin-bottom: 24px;
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

        .input-group-text-premium {
            background-color: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            color: rgba(255, 255, 255, 0.6) !important;
            border-radius: 8px 0 0 8px !important;
        }

        .input-group-premium .form-control-premium {
            border-radius: 0 8px 8px 0 !important;
            border-left: none !important;
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

        .badge-premium {
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-premium-blue {
            background: rgba(14, 165, 233, 0.12);
            color: #38BDF8;
            border: 1px solid rgba(14, 165, 233, 0.2);
        }

        .btn-primary-premium {
            background: #0EA5E9 !important;
            border: none !important;
            color: #fff !important;
            border-radius: 8px !important;
            padding: 8px 16px !important;
            font-weight: 600 !important;
            transition: all 0.2s ease !important;
        }
        .btn-primary-premium:hover {
            background: #0284C7 !important;
            transform: translateY(-1px) !important;
        }
    </style>
@stop

@section('content_header')
    <div class="d-flex justify-content-between align-items-center header-dashboard-container">
        <h1 class="text-white font-weight-bold dashboard-title-main m-0">
            <i class="fas fa-users mr-2"></i>Gestión de Clientes
        </h1>
        <span class="dashboard-date-badge">
            <i class="fa fa-calendar-alt mr-1"></i> Hoy: {{ \Carbon\Carbon::now()->format('d/m/Y') }}
        </span>
    </div>
@stop

@section('content')
<div class="container-fluid pb-4 premium-container">

    {{-- Alertas de sesión --}}
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

    <div class="row">
        {{-- ===================== FORMULARIO CREAR / EDITAR ===================== --}}
        <div class="col-xl-4 col-lg-5">
            <div class="card-custom-premium">
                <div class="card-header-premium">
                    <h3 class="card-title-premium">
                        @isset($cliente)
                            <i class="fas fa-edit text-warning mr-2"></i>Editar Cliente
                        @else
                            <i class="fas fa-plus-circle text-info mr-2"></i>Nuevo Cliente
                        @endisset
                    </h3>
                </div>

                @isset($cliente)
                    <form action="{{ route('admin.cliente.update', $cliente->id) }}" method="POST">
                        @method('PUT')
                @else
                    <form action="{{ route('admin.cliente.store') }}" method="POST">
                @endisset
                        @csrf

                        <div class="card-body p-4">
                            {{-- Cédula --}}
                            <div class="form-group mb-3">
                                <label for="cedula" class="font-weight-bold text-white mb-1">Cédula <span class="text-danger">*</span></label>
                                <div class="input-group input-group-premium">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-group-text-premium"><i class="fas fa-id-card"></i></span>
                                    </div>
                                    <input type="number" name="cedula" id="cedula"
                                        class="form-control form-control-premium @error('cedula') is-invalid @enderror"
                                        placeholder="Ej: 123456789" value="{{ old('cedula', $cliente->cedula ?? '') }}" required>
                                    @error('cedula')
                                        <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Nombre --}}
                            <div class="form-group mb-3">
                                <label for="nombre" class="font-weight-bold text-white mb-1">Nombre Completo <span class="text-danger">*</span></label>
                                <div class="input-group input-group-premium">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-group-text-premium"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="nombre" id="nombre"
                                        class="form-control form-control-premium @error('nombre') is-invalid @enderror"
                                        placeholder="Ej: Juan Pérez" value="{{ old('nombre', $cliente->nombre ?? '') }}" required>
                                    @error('nombre')
                                        <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Teléfono --}}
                            <div class="form-group mb-3">
                                <label for="telefono" class="font-weight-bold text-white mb-1">Teléfono <span class="text-danger">*</span></label>
                                <div class="input-group input-group-premium">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-group-text-premium"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" name="telefono" id="telefono"
                                        class="form-control form-control-premium @error('telefono') is-invalid @enderror"
                                        placeholder="Ej: 3001234567" value="{{ old('telefono', $cliente->telefono ?? '') }}" required>
                                    @error('telefono')
                                        <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Correo --}}
                            <div class="form-group mb-3">
                                <label for="correo" class="font-weight-bold text-white mb-1">Correo Electrónico <span class="text-danger">*</span></label>
                                <div class="input-group input-group-premium">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-group-text-premium"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" name="correo" id="correo"
                                        class="form-control form-control-premium @error('correo') is-invalid @enderror"
                                        placeholder="Ej: cliente@correo.com" value="{{ old('correo', $cliente->correo ?? '') }}" required>
                                    @error('correo')
                                        <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Dirección --}}
                            <div class="form-group mb-3">
                                <label for="direccion" class="font-weight-bold text-white mb-1">Dirección <span class="text-danger">*</span></label>
                                <div class="input-group input-group-premium">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-group-text-premium"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <input type="text" name="direccion" id="direccion"
                                        class="form-control form-control-premium @error('direccion') is-invalid @enderror"
                                        placeholder="Ej: Calle 10 # 5-23" value="{{ old('direccion', $cliente->direccion ?? '') }}" required>
                                    @error('direccion')
                                        <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Ciudad --}}
                            <div class="form-group mb-3">
                                <label for="id_ciudad" class="font-weight-bold text-white mb-1">Ciudad / Región <span class="text-danger">*</span></label>
                                <div class="input-group input-group-premium">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-group-text-premium"><i class="fas fa-city"></i></span>
                                    </div>
                                    <select name="id_ciudad" id="id_ciudad" class="form-control form-control-premium @error('id_ciudad') is-invalid @enderror" required>
                                        <option value="">Seleccione una ciudad</option>
                                        @foreach ($ciudades as $ciudad)
                                            <option value="{{ $ciudad->id }}" {{ old('id_ciudad', $cliente->id_ciudad ?? '') == $ciudad->id ? 'selected' : '' }}>
                                                {{ $ciudad->nombre }} [{{ $ciudad->codigo_postal }}]
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_ciudad')
                                        <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Descripción --}}
                            <div class="form-group mb-1">
                                <label for="descripcion" class="font-weight-bold text-white mb-1">Descripción / Observaciones</label>
                                <textarea name="descripcion" id="descripcion" rows="2"
                                    class="form-control form-control-premium @error('descripcion') is-invalid @enderror"
                                    placeholder="Notas internas sobre el cliente..." style="resize: none; height: auto !important;">{{ old('descripcion', $cliente->descripcion ?? '') }}</textarea>
                                @error('descripcion')
                                    <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer d-flex flex-column p-4" style="gap: 8px; background: transparent; border-top: 1px solid rgba(255,255,255,0.05);">
                            <button type="submit" class="btn btn-primary-premium btn-block">
                                <i class="fas fa-save mr-2"></i>
                                @isset($cliente) Actualizar Registro @else Guardar Cliente @endisset
                            </button>
                            <a href="{{ route('admin.cliente.index') }}" class="btn btn-outline-light btn-block m-0 font-weight-bold" style="border-radius: 8px;">
                                <i class="fas fa-undo mr-2"></i> Limpiar Campos
                            </a>
                        </div>
                    </form>
            </div>
        </div>

        {{-- ===================== TABLA DE REGISTROS ===================== --}}
        <div class="col-xl-8 col-lg-7">
            <div class="card-custom-premium">
                <div class="card-header-premium">
                    <h3 class="card-title-premium">
                        <i class="fas fa-list mr-2" style="color: #0EA5E9;"></i>Listado de Clientes
                    </h3>
                    <span class="badge-premium badge-premium-blue">
                        Total: {{ $clientes->count() }}
                    </span>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-premium mb-0">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">#</th>
                                    <th width="15%">Cédula</th>
                                    <th width="25%">Nombre</th>
                                    <th width="25%">Contacto</th>
                                    <th width="20%">Ubicación</th>
                                    <th width="10%" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($clientes as $index => $item)
                                    <tr>
                                        <td class="text-center align-middle font-weight-bold" style="color: rgba(255,255,255,0.3);">{{ $index + 1 }}</td>
                                        <td class="align-middle text-white font-weight-bold">{{ $item->cedula }}</td>
                                        <td class="align-middle text-white font-weight-bold text-uppercase" style="font-size: 0.88rem; letter-spacing: 0.2px;">
                                            {{ $item->nombre }}
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex flex-column" style="gap: 1px; font-size: 0.85rem;">
                                                <span class="text-white font-weight-bold"><i class="fas fa-phone text-muted mr-1" style="font-size: 0.75rem;"></i>{{ $item->telefono }}</span>
                                                <span class="text-muted text-truncate" style="font-size: 0.8rem; max-width: 160px;" title="{{ $item->correo }}">{{ $item->correo }}</span>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex flex-column" style="gap: 1px; font-size: 0.85rem;">
                                                <span class="text-white text-truncate" style="max-width: 160px;" title="{{ $item->direccion }}">
                                                    <i class="fas fa-map-marker-alt mr-1" style="color: #EF4444; opacity: 0.7; font-size: 0.75rem;"></i>{{ $item->direccion }}
                                                </span>
                                                <span class="badge-premium badge-premium-blue align-self-start mt-1" style="font-size: 0.75rem; padding: 2px 8px;">
                                                    <i class="fas fa-city mr-1" style="font-size: 0.7rem;"></i>{{ $item->ciudad->nombre ?? 'N/A' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="d-inline-flex" style="gap: 6px;">
                                                {{-- Editar --}}
                                                <a href="{{ route('admin.cliente.edit', $item->id) }}"
                                                    class="btn btn-sm btn-info shadow-sm d-flex align-items-center justify-content-center"
                                                    title="Editar" style="width: 32px; height: 32px; border-radius: 6px;">
                                                    <i class="fas fa-pen fa-sm"></i>
                                                </a>

                                                {{-- Eliminar --}}
                                                <form action="{{ route('admin.cliente.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este cliente?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-danger shadow-sm d-flex align-items-center justify-content-center"
                                                        title="Eliminar" style="width: 32px; height: 32px; border-radius: 6px;">
                                                        <i class="fas fa-trash fa-sm"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-5" style="background: transparent;">
                                            <i class="fas fa-folder-open fa-3x mb-3 text-muted" style="opacity: 0.3;"></i>
                                            <p class="mb-0 font-weight-bold">No hay clientes registrados en el sistema.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        setTimeout(function() {
            $('.alert-dismissible').fadeOut('slow');
        }, 4000);
    </script>
@stop
