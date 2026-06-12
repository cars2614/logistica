@extends('adminlte::page')
 
@section('title', 'Clientes')
 
@section('content_header')
    <div class="container-fluid pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
            <h1 class="m-0 font-weight-bold text-secondary">
                <i class="fas fa-users text-primary mr-2"></i>Gestión de Clientes
            </h1>
            <ol class="breadcrumb m-0 bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Clientes</li>
            </ol>
        </div>
    </div>
@stop
 
@section('content')
    <div class="container-fluid pb-4">
 
        {{-- Alertas de sesión estilizadas --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle mr-2 fa-lg"></i>
                    <div>{{ session('success') }}</div>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
        @endif
 
        <div class="row mt-3">
            {{-- ===================== FORMULARIO CREAR / EDITAR ===================== --}}
            <div class="col-xl-4 col-lg-5 mb-4">
                <div class="card card-primary card-outline shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h3 class="card-title font-weight-bold text-dark mb-0">
                            @isset($cliente)
                                <i class="fas fa-edit text-warning mr-2"></i>Editar Cliente
                            @else
                                <i class="fas fa-plus-circle text-primary mr-2"></i>Nuevo Cliente
                                @endif
                            </h3>
                        </div>
 
                        @isset($cliente)
                            <form action="{{ route('admin.cliente.update', $cliente->id) }}" method="POST">
                                @method('PUT')
                            @else
                                <form action="{{ route('admin.cliente.store') }}" method="POST">
                                @endisset
                                @csrf
 
                                <div class="card-body py-3">
                                    {{-- Cédula --}}
                                    <div class="form-group mb-3">
                                        <label for="cedula" class="font-weight-bold text-secondary mb-1">Cédula <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light text-muted"><i
                                                        class="fas fa-id-card"></i></span>
                                            </div>
                                            <input type="number" name="cedula" id="cedula"
                                                class="form-control border-left-0 @error('cedula') is-invalid @enderror"
                                                placeholder="Ej: 123456789" value="{{ old('cedula', $cliente->cedula ?? '') }}">
                                            @error('cedula')
                                                <span class="invalid-feedback"><i
                                                        class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
 
                                    {{-- Nombre --}}
                                    <div class="form-group mb-3">
                                        <label for="nombre" class="font-weight-bold text-secondary mb-1">Nombre Completo <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light text-muted"><i
                                                        class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" name="nombre" id="nombre"
                                                class="form-control border-left-0 @error('nombre') is-invalid @enderror"
                                                placeholder="Ej: Juan Pérez"
                                                value="{{ old('nombre', $cliente->nombre ?? '') }}">
                                            @error('nombre')
                                                <span class="invalid-feedback"><i
                                                        class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
 
                                    {{-- Teléfono --}}
                                    <div class="form-group mb-3">
                                        <label for="telefono" class="font-weight-bold text-secondary mb-1">Teléfono <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light text-muted"><i
                                                        class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" name="telefono" id="telefono"
                                                class="form-control border-left-0 @error('telefono') is-invalid @enderror"
                                                placeholder="Ej: 3001234567"
                                                value="{{ old('telefono', $cliente->telefono ?? '') }}">
                                            @error('telefono')
                                                <span class="invalid-feedback"><i
                                                        class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
 
                                    {{-- Correo --}}
                                    <div class="form-group mb-3">
                                        <label for="correo" class="font-weight-bold text-secondary mb-1">Correo Electrónico
                                            <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light text-muted"><i
                                                        class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="email" name="correo" id="correo"
                                                class="form-control border-left-0 @error('correo') is-invalid @enderror"
                                                placeholder="Ej: cliente@correo.com"
                                                value="{{ old('correo', $cliente->correo ?? '') }}">
                                            @error('correo')
                                                <span class="invalid-feedback"><i
                                                        class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
 
                                    {{-- Dirección --}}
                                    <div class="form-group mb-3">
                                        <label for="direccion" class="font-weight-bold text-secondary mb-1">Dirección <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light text-muted"><i
                                                        class="fas fa-map-marker-alt"></i></span>
                                            </div>
                                            <input type="text" name="direccion" id="direccion"
                                                class="form-control border-left-0 @error('direccion') is-invalid @enderror"
                                                placeholder="Ej: Calle 10 # 5-23"
                                                value="{{ old('direccion', $cliente->direccion ?? '') }}">
                                            @error('direccion')
                                                <span class="invalid-feedback"><i
                                                        class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
 
                                    {{-- Ciudad --}}
                                    <div class="form-group mb-3">
                                        <label for="id_ciudad" class="font-weight-bold text-secondary mb-1">Ciudad / Región
                                            <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light text-muted"><i
                                                        class="fas fa-city"></i></span>
                                            </div>
                                            <select name="id_ciudad" id="id_ciudad"
                                                class="form-control border-left-0 @error('id_ciudad') is-invalid @enderror">
                                                <option value="">Seleccione una ciudad</option>
                                                @foreach ($ciudades as $ciudad)
                                                    <option value="{{ $ciudad->id }}"
                                                        {{ old('id_ciudad', $cliente->id_ciudad ?? '') == $ciudad->id ? 'selected' : '' }}>
                                                        {{ $ciudad->nombre }} [{{ $ciudad->codigo_postal }}]
 
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('id_ciudad')
                                                <span class="invalid-feedback"><i
                                                        class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
 
                                    {{-- Descripción --}}
                                    <div class="form-group mb-1">
                                        <label for="descripcion" class="font-weight-bold text-secondary mb-1">Descripción /
                                            Observaciones</label>
                                        <textarea name="descripcion" id="descripcion" rows="2"
                                            class="form-control form-control-sm @error('descripcion') is-invalid @enderror"
                                            placeholder="Notas internas sobre el cliente..." style="resize: none;">{{ old('descripcion', $cliente->descripcion ?? '') }}</textarea>
                                        @error('descripcion')
                                            <span class="invalid-feedback"><i
                                                    class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
 
                                <div class="card-footer bg-light border-top-0 d-flex flex-column p-3" style="gap: 8px;">
                                    <button type="submit" class="btn btn-primary btn-block font-weight-bold shadow-sm py-2">
                                        <i class="fas fa-save mr-2"></i>
                                        @isset($cliente) Actualizar Registro
                                        @else
                                        Guardar Cliente @endisset
                                    </button>
                                    <a href="{{ route('admin.cliente.index') }}"
                                        class="btn btn-outline-secondary btn-block m-0 font-weight-bold py-2">
                                        <i class="fas fa-undo mr-2"></i> Limpiar Campos
                                    </a>
                                </div>
                            </form>
                    </div>
                </div>
 
 
 
                {{-- ===================== TABLA DE REGISTROS ===================== --}}
                <div class="col-xl-8 col-lg-7">
                    <div class="card card-outline card-primary shadow-sm border-0">
                        <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                            <h3 class="card-title font-weight-bold text-dark mb-0">
                                <i class="fas fa-list text-primary mr-2"></i>Listado de Clientes
                            </h3>
                            <span class="badge badge-pill badge-primary px-3 py-2 font-weight-bold shadow-sm">
                                Total: {{ $clientes->count() }}
                            </span>
                        </div>
 
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light border-bottom text-secondary">
                                        <tr>
                                            <th width="5%" class="text-center font-weight-bold border-0">#</th>
                                            <th width="15%" class="font-weight-bold border-0">Cédula</th>
                                            <th width="25%" class="font-weight-bold border-0">Nombre</th>
                                            <th width="20%" class="font-weight-bold border-0">Contacto</th>
                                            <th width="20%" class="font-weight-bold border-0">Ubicación</th>
                                            <th width="15%" class="text-center font-weight-bold border-0">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($clientes as $index => $item)
                                            <tr class="align-middle">
                                                <td class="text-center align-middle font-weight-bold text-muted">
                                                    {{ $index + 1 }}</td>
                                                <td class="align-middle text-dark font-weight-bold">{{ $item->cedula }}</td>
                                                <td class="align-middle text-dark font-weight-bold text-uppercase"
                                                    style="font-size: 0.88rem; letter-spacing: 0.2px;">
                                                    {{ $item->nombre }}
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex flex-column" style="gap: 1px; font-size: 0.85rem;">
                                                        <span class="text-dark font-weight-bold"><i
                                                                class="fas fa-phone text-muted mr-1"
                                                                style="font-size: 0.75rem;"></i>{{ $item->telefono }}</span>
                                                        <span class="text-secondary text-muted text-truncate"
                                                            style="font-size: 0.8rem; max-width: 160px;"
                                                            title="{{ $item->correo }}">{{ $item->correo }}</span>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex flex-column" style="gap: 1px; font-size: 0.85rem;">
                                                        <span class="text-dark text-truncate" style="max-width: 160px;"
                                                            title="{{ $item->direccion }}">
                                                            <i class="fas fa-map-marker-alt text-danger mr-1"
                                                                style="opacity: 0.7; font-size: 0.75rem;"></i>{{ $item->direccion }}
                                                        </span>
                                                        <span
                                                            class="badge badge-light align-self-start border px-2 py-1 text-secondary mt-1"
                                                            style="font-size: 0.75rem; font-weight: 600;">
                                                            <i class="fas fa-city mr-1" style="font-size: 0.7rem;"></i>CP:
                                                            {{ $item->codigo_postal }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div class="d-inline-flex" style="gap: 6px;">
 
                                                        {{-- Editar --}}
                                                        <a href="{{ route('admin.cliente.edit', $item->id) }}"
                                                            class="btn btn-sm btn-info shadow-sm d-flex align-items-center justify-content-center"
                                                            title="Editar"
                                                            style="width: 32px; height: 32px; border-radius: 6px;">
                                                            <i class="fas fa-pen fa-sm"></i>
                                                        </a>
 
                                                        {{-- Eliminar --}}
                                                        <form action="{{ route('admin.cliente.destroy', $item->id) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('¿Estás seguro de eliminar este cliente?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger shadow-sm d-flex align-items-center justify-content-center"
                                                                title="Eliminar"
                                                                style="width: 32px; height: 32px; border-radius: 6px;">
                                                                <i class="fas fa-trash fa-sm"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-5 bg-white">
                                                    <i class="fas fa-folder-open fa-3x mb-3 text-muted"
                                                        style="opacity: 0.5;"></i>
                                                    <p class="mb-0 font-weight-bold">No hay clientes registrados en el sistema.
                                                    </p>
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
    @stop
 
@section('css')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
 
    :root {
        --dark:   #080C14;
        --dark2:  #0D1220;
        --card:   #0F1628;
        --border: rgba(59,130,246,0.12);
        --blue:   #3B82F6;
        --indigo: #6366F1;
        --muted:  rgba(200,215,255,0.6);
    }
 
    body, h1, h2, h3, h4, h5, h6, p, a, span, td, th, label, input, select, textarea, button, .nav-link {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }
    i[class*="fa-"] { font-family: "Font Awesome 5 Free","Font Awesome 6 Free" !important; font-weight: 900 !important; }
 
    /* ── NAVBAR ── */
    .main-header.navbar { background: var(--dark2) !important; border-bottom: 1px solid var(--border) !important; }
    .navbar-light, .navbar-white { background: transparent !important; }
    .main-header.navbar .nav-link, .main-header.navbar span, .main-header.navbar a { color: rgba(200,215,255,0.8) !important; }
    .main-header.navbar .nav-link:hover { color: var(--blue) !important; }
    .main-header .dropdown-menu { background: #0F1628 !important; border: 1px solid var(--border) !important; border-radius: 10px !important; }
    .main-header .dropdown-item { color: rgba(200,215,255,0.85) !important; border-radius: 7px !important; font-size: 13px !important; }
    .main-header .dropdown-item:hover { background: rgba(59,130,246,0.1) !important; color: #fff !important; }
 
    /* ── SIDEBAR ── */
    .main-sidebar { background: var(--dark) !important; border-right: 1px solid var(--border) !important; }
    .brand-link { background: var(--dark) !important; border-bottom: 1px solid var(--border) !important; }
    .brand-text { color: #fff !important; font-weight: 700 !important; }
    .nav-sidebar .nav-header { color: rgba(99,130,200,0.6) !important; font-size: 10px !important; font-weight: 700 !important; letter-spacing: 0.12em !important; }
    .nav-sidebar .nav-link { color: rgba(200,215,255,0.7) !important; border-radius: 8px !important; margin: 2px 8px !important; font-size: 13px !important; font-weight: 500 !important; transition: all 0.2s !important; }
    .nav-sidebar .nav-link:hover { background: rgba(59,130,246,0.1) !important; color: #fff !important; }
    .nav-sidebar .nav-link.active { background: linear-gradient(135deg, rgba(59,130,246,0.2), rgba(99,102,241,0.15)) !important; color: #fff !important; border-left: 3px solid var(--blue) !important; font-weight: 600 !important; }
 
    /* ── CONTENT ── */
    .content-wrapper { background: var(--dark) !important; }
    .content-header h1 { color: #fff !important; font-size: 20px !important; font-weight: 700 !important; }
    .content-header .breadcrumb-item a { color: var(--blue) !important; }
    .content-header .breadcrumb-item.active { color: var(--muted) !important; }
    .border-bottom { border-color: var(--border) !important; }
 
    /* ── CARD FORMULARIO ── */
    .card { background: var(--card) !important; border: 1px solid var(--border) !important; border-radius: 12px !important; }
    .card-header { background: rgba(255,255,255,0.03) !important; border-bottom: 1px solid var(--border) !important; }
    .card-title { color: #fff !important; font-weight: 700 !important; }
    .card-body { background: transparent !important; }
    .card-footer { background: rgba(255,255,255,0.02) !important; border-top: 1px solid var(--border) !important; }
 
    /* ── LABELS ── */
    label.font-weight-bold { color: rgba(200,215,255,0.85) !important; }
    .text-secondary { color: rgba(200,215,255,0.6) !important; }
    .text-dark { color: #C8D7FF !important; }
    .text-muted { color: rgba(200,215,255,0.4) !important; }
 
    /* ── INPUTS ── */
    .form-control {
        background: rgba(255,255,255,0.05) !important;
        border: 1px solid var(--border) !important;
        border-left: none !important;
        color: #fff !important;
        border-radius: 0 8px 8px 0 !important;
    }
    .form-control:focus {
        border-color: var(--blue) !important;
        box-shadow: 0 0 0 3px rgba(59,130,246,0.15) !important;
        background: rgba(59,130,246,0.05) !important;
    }
    .form-control::placeholder { color: rgba(200,215,255,0.3) !important; }
    .input-group-text {
        background: rgba(255,255,255,0.06) !important;
        border: 1px solid var(--border) !important;
        border-right: none !important;
        color: rgba(200,215,255,0.6) !important;
        border-radius: 8px 0 0 8px !important;
    }
    select.form-control option { background: var(--card) !important; color: #fff !important; }
    textarea.form-control { border-left: 1px solid var(--border) !important; border-radius: 8px !important; }
 
    /* ── BOTONES ── */
    .btn-primary { background: linear-gradient(135deg, var(--blue), var(--indigo)) !important; border: none !important; color: #fff !important; border-radius: 8px !important; font-weight: 600 !important; }
    .btn-primary:hover { opacity: 0.9 !important; color: #fff !important; }
    .btn-outline-secondary { border-color: var(--border) !important; color: rgba(200,215,255,0.7) !important; border-radius: 8px !important; background: transparent !important; }
    .btn-outline-secondary:hover { background: rgba(255,255,255,0.05) !important; color: #fff !important; }
    .btn-info { background: linear-gradient(135deg, #06B6D4, #0891B2) !important; border: none !important; }
    .btn-danger { background: linear-gradient(135deg, #EF4444, #DC2626) !important; border: none !important; }
 
    /* ── TABLA ── */
    .table { color: #C8D7FF !important; }
    .table thead th {
        background: rgba(255,255,255,0.03) !important;
        color: rgba(200,215,255,0.55) !important;
        font-size: 11px !important; font-weight: 700 !important;
        text-transform: uppercase !important; letter-spacing: 0.07em !important;
        border-bottom: 1px solid var(--border) !important;
        border-top: none !important;
    }
    .table tbody td { border-bottom: 1px solid rgba(255,255,255,0.04) !important; vertical-align: middle !important; color: #C8D7FF !important; }
    .table-hover tbody tr:hover { background: rgba(59,130,246,0.05) !important; }
    .bg-light { background: rgba(255,255,255,0.03) !important; }
 
    /* ── BADGE ── */
    .badge-primary { background: rgba(59,130,246,0.15) !important; color: #60A5FA !important; border-radius: 6px !important; }
    .badge-light { background: rgba(255,255,255,0.06) !important; color: rgba(200,215,255,0.7) !important; border-color: var(--border) !important; }
 
    /* ── ALERTA ── */
    .alert-success { background: rgba(16,185,129,0.1) !important; border: none !important; border-left: 4px solid #10B981 !important; color: #6EE7B7 !important; border-radius: 10px !important; }
 
    /* ── FOOTER ── */
    .main-footer { background: var(--dark2) !important; border-top: 1px solid var(--border) !important; color: var(--muted) !important; }
</style>
@stop
 
@push('js')
    <script>
        // Auto-ocultar alertas tras 4 segundos de forma fluida
        setTimeout(function() {
            $('.alert-dismissible').fadeOut('slow');
        }, 4000);
    </script>
@endpush
 
@section('js')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const brandLink = document.querySelector(".brand-link");
    if (brandLink) {
        brandLink.innerHTML = `
            <div style="display:flex;align-items:center;gap:10px;">
                <img src="{{ asset('images/logo-carga.png') }}" alt="Logo" style="width:38px;height:auto;object-fit:contain;">
                <div style="display:flex;flex-direction:column;line-height:1.2;">
                    <span style="color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:13px;letter-spacing:0.3px;text-transform:uppercase;">Carga y Logística</span>
                    <span style="color:rgba(255,255,255,0.4);font-family:'Plus Jakarta Sans',sans-serif;font-weight:500;font-size:9px;letter-spacing:0.8px;text-transform:uppercase;">Tolima</span>
                </div>
            </div>
        `;
    }
});
</script>
@stop