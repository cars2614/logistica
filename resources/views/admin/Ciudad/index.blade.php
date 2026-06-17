@extends('adminlte::page')

@section('title', 'Ciudades — Carga y Logística Tolima')

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
            <i class="fas fa-city mr-2"></i>Gestión de Ciudades
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
        {{-- ===================== FORMULARIO (CREAR / EDITAR) ===================== --}}
        <div class="col-md-5">
            <div class="card-custom-premium">
                <div class="card-header-premium">
                    <h3 class="card-title-premium">
                        <i class="fas {{ isset($ciudad) ? 'fa-edit text-warning' : 'fa-plus-circle text-info' }} mr-2"></i>
                        {{ isset($ciudad) ? 'Editar Ciudad' : 'Nueva Ciudad' }}
                    </h3>
                </div>

                <form action="{{ isset($ciudad) ? route('admin.ciudad.update', $ciudad->id) : route('admin.ciudad.store') }}" method="POST">
                    @csrf
                    @if(isset($ciudad)) @method('PUT') @endif

                    <div class="card-body p-4">
                        {{-- Campo Nombre --}}
                        <div class="form-group mb-3">
                            <label for="nombre" class="font-weight-bold text-white mb-1">Nombre <span class="text-danger">*</span></label>
                            <div class="input-group input-group-premium">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-premium"><i class="fas fa-building"></i></span>
                                </div>
                                <input type="text" name="nombre" id="nombre" 
                                    class="form-control form-control-premium @error('nombre') is-invalid @enderror" 
                                    value="{{ old('nombre', $ciudad->nombre ?? '') }}" 
                                    placeholder="Ej: Bogotá, Medellín..." required>
                                @error('nombre') 
                                    <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span> 
                                @enderror
                            </div>
                        </div>

                        {{-- Campo Código Postal --}}
                        <div class="form-group mb-2">
                            <label for="codigo_postal" class="font-weight-bold text-white mb-1">Código Postal <span class="text-danger">*</span></label>
                            <div class="input-group input-group-premium">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-premium"><i class="fas fa-mail-bulk"></i></span>
                                </div>
                                <input type="text" name="codigo_postal" id="codigo_postal" 
                                    class="form-control form-control-premium @error('codigo_postal') is-invalid @enderror" 
                                    value="{{ old('codigo_postal', $ciudad->codigo_postal ?? '') }}" 
                                    placeholder="Ej: 110111" required>
                                @error('codigo_postal') 
                                    <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span> 
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex flex-column p-4" style="gap: 8px; background: transparent; border-top: 1px solid rgba(255,255,255,0.05);">
                        <button type="submit" class="btn btn-primary-premium btn-block">
                            <i class="fas fa-save mr-2"></i> {{ isset($ciudad) ? 'Actualizar Ciudad' : 'Guardar Ciudad' }}
                        </button>
                        
                        <a href="{{ route('admin.ciudad.index') }}" class="btn btn-outline-light btn-block m-0 font-weight-bold" style="border-radius: 8px;">
                            <i class="fas fa-undo mr-2"></i> {{ isset($ciudad) ? 'Cancelar Edición' : 'Limpiar Campos' }}
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- ===================== TABLA DE LISTADO ===================== --}}
        <div class="col-md-7">
            <div class="card-custom-premium">
                <div class="card-header-premium">
                    <h3 class="card-title-premium">
                        <i class="fas fa-list mr-2" style="color: #0EA5E9;"></i>Listado de Ciudades
                    </h3>
                    <span class="badge-premium badge-premium-blue">
                        Total: {{ $ciudades->count() }}
                    </span>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive table-responsive-cards">
                        <table class="table table-hover table-premium mb-0">
                            <thead>
                                <tr>
                                    <th width="12%" class="text-center">#</th>
                                    <th width="48%">Nombre</th>
                                    <th width="25%">Cod. Postal</th>
                                    <th width="15%" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ciudades as $item)
                                    <tr>
                                        <td data-label="#" class="text-center align-middle font-weight-bold" style="color: rgba(255,255,255,0.3);">{{ $loop->iteration }}</td>
                                        <td data-label="Nombre" class="align-middle text-white font-weight-bold text-uppercase" style="font-size: 0.88rem; letter-spacing: 0.2px;">
                                            <i class="fas fa-map-marker-alt mr-2" style="color: #0EA5E9; opacity: 0.8;"></i>{{ $item->nombre }}
                                        </td>
                                        <td data-label="Cod. Postal" class="align-middle">
                                            <span class="badge-premium badge-premium-blue">
                                                <i class="fas fa-hashtag mr-1" style="font-size: 0.7rem;"></i>{{ $item->codigo_postal }}
                                            </span>
                                        </td>
                                        <td data-label="Acciones" class="text-center align-middle">
                                            <div class="d-inline-flex" style="gap: 6px;">
                                                {{-- Editar --}}
                                                <a href="{{ route('admin.ciudad.edit', $item->id) }}" 
                                                   class="btn btn-sm btn-info shadow-sm d-flex align-items-center justify-content-center" 
                                                   title="Editar" style="width: 32px; height: 32px; border-radius: 6px;">
                                                    <i class="fas fa-pen fa-sm"></i>
                                                </a>

                                                {{-- Eliminar --}}
                                                <form action="{{ route('admin.ciudad.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar esta ciudad?')">
                                                    @csrf @method('DELETE')
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
                                        <td colspan="4" class="text-center text-muted py-5" style="background: transparent;">
                                            <i class="fas fa-folder-open fa-3x mb-3 text-muted" style="opacity: 0.3;"></i>
                                            <p class="mb-0 font-weight-bold">No hay ciudades registradas en el sistema.</p>
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