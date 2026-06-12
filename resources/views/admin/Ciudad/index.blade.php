@extends('adminlte::page')
 
@section('title', 'Ciudades')
 
@section('content_header')
    <div class="container-fluid pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
            <h1 class="m-0 font-weight-bold text-secondary">
                <i class="fas fa-city text-primary mr-2"></i>Gestión de Ciudades
            </h1>
            <ol class="breadcrumb m-0 bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Ciudades</li>
            </ol>
        </div>
    </div>
@endsection
 
@section('content')
<div class="container-fluid pb-4">
 
    {{-- Alertas de sesión automáticas y estilizadas --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mt-2" role="alert">
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
        {{-- ===================== FORMULARIO (CREAR / EDITAR) ===================== --}}
        <div class="col-md-5 mb-4">
            <div class="card card-outline {{ isset($ciudad) ? 'card-warning' : 'card-primary' }} shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h3 class="card-title font-weight-bold text-dark mb-0">
                        <i class="fas {{ isset($ciudad) ? 'fa-edit text-warning' : 'fa-plus-circle text-primary' }} mr-2"></i>
                        {{ isset($ciudad) ? 'Editar Ciudad' : 'Nueva Ciudad' }}
                    </h3>
                </div>
 
                <form action="{{ isset($ciudad) ? route('admin.ciudad.update', $ciudad->id) : route('admin.ciudad.store') }}" method="POST">
                    @csrf
                    @if(isset($ciudad)) @method('PUT') @endif
 
                    <div class="card-body py-3">
                        {{-- Campo Nombre --}}
                        <div class="form-group mb-3">
                            <label for="nombre" class="font-weight-bold text-secondary mb-1">Nombre <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-building"></i></span>
                                </div>
                                <input type="text" name="nombre" id="nombre" 
                                    class="form-control border-left-0 @error('nombre') is-invalid @enderror" 
                                    value="{{ old('nombre', $ciudad->nombre ?? '') }}" 
                                    placeholder="Ej: Bogotá, Medellín..." required>
                                @error('nombre') 
                                    <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span> 
                                @enderror
                            </div>
                        </div>
 
                        {{-- Campo Código Postal --}}
                        <div class="form-group mb-2">
                            <label for="codigo_postal" class="font-weight-bold text-secondary mb-1">Código Postal <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-mail-bulk"></i></span>
                                </div>
                                <input type="text" name="codigo_postal" id="codigo_postal" 
                                    class="form-control border-left-0 @error('codigo_postal') is-invalid @enderror" 
                                    value="{{ old('codigo_postal', $ciudad->codigo_postal ?? '') }}" 
                                    placeholder="Ej: 110111" required>
                                @error('codigo_postal') 
                                    <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span> 
                                @enderror
                            </div>
                        </div>
                    </div>
 
                    <div class="card-footer bg-light border-top-0 d-flex flex-column p-3" style="gap: 8px;">
                        <button type="submit" class="btn {{ isset($ciudad) ? 'btn-warning text-dark' : 'btn-primary' }} btn-block font-weight-bold shadow-sm py-2">
                            <i class="fas fa-save mr-2"></i> {{ isset($ciudad) ? 'Actualizar Ciudad' : 'Guardar Ciudad' }}
                        </button>
                        
                        <a href="{{ route('admin.ciudad.index') }}" class="btn btn-outline-secondary btn-block m-0 font-weight-bold py-2">
                            <i class="fas fa-undo mr-2"></i> {{ isset($ciudad) ? 'Cancelar Edición' : 'Limpiar Campos' }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
 
        {{-- ===================== TABLA DE LISTADO ===================== --}}
        <div class="col-md-7">
            <div class="card card-outline card-primary shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <h3 class="card-title font-weight-bold text-dark mb-0">
                        <i class="fas fa-list text-primary mr-2"></i>Listado de Ciudades
                    </h3>
                    <span class="badge badge-pill badge-primary px-3 py-2 font-weight-bold shadow-sm">
                        Total: {{ $ciudades->count() }}
                    </span>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light border-bottom text-secondary">
                                <tr>
                                    <th width="12%" class="text-center font-weight-bold border-0">#</th>
                                    <th width="48%" class="font-weight-bold border-0">Nombre</th>
                                    <th width="25%" class="font-weight-bold border-0">Cod. Postal</th>
                                    <th width="15%" class="text-center font-weight-bold border-0">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ciudades as $item)
                                    <tr class="align-middle">
                                        <td class="text-center align-middle font-weight-bold text-muted">{{ $loop->iteration }}</td>
                                        <td class="align-middle text-dark font-weight-bold text-uppercase" style="font-size: 0.88rem; letter-spacing: 0.2px;">
                                            <i class="fas fa-map-marker-alt text-muted mr-2" style="opacity: 0.6;"></i>{{ $item->nombre }}
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge badge-light border px-2 py-1 text-secondary font-weight-bold" style="font-size: 0.8rem;">
                                                <i class="fas fa-hashtag text-muted mr-1" style="font-size: 0.7rem;"></i>{{ $item->codigo_postal }}
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="d-inline-flex" style="gap: 6px;">
                                                {{-- Editar --}}
                                                <a href="{{ route('admin.ciudad.edit', $item->id) }}" 
                                                   class="btn btn-sm btn-info shadow-sm d-flex align-items-center justify-content-center" 
                                                   title="Editar" style="width: 32px; height: 32px; border-radius: 6px;">
                                                    <i class="fas fa-pen fa-sm"></i>
                                                </a>
 
                                                {{-- Eliminar --}}
                                                <form action="{{ route('admin.ciudad.destroy', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-danger shadow-sm d-flex align-items-center justify-content-center" 
                                                            title="Eliminar" style="width: 32px; height: 32px; border-radius: 6px;"
                                                            onclick="return confirm('¿Estás seguro de eliminar esta ciudad?')">
                                                        <i class="fas fa-trash fa-sm"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-5 bg-white">
                                            <i class="fas fa-folder-open fa-3x mb-3 text-muted" style="opacity: 0.5;"></i>
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
 
    /* NAVBAR */
    .main-header.navbar { background: var(--dark2) !important; border-bottom: 1px solid var(--border) !important; }
    .navbar-light, .navbar-white { background: transparent !important; }
    .main-header.navbar .nav-link, .main-header.navbar span, .main-header.navbar a { color: rgba(200,215,255,0.8) !important; }
    .main-header.navbar .nav-link:hover { color: var(--blue) !important; }
    .main-header .dropdown-menu { background: #0F1628 !important; border: 1px solid var(--border) !important; border-radius: 10px !important; }
    .main-header .dropdown-item { color: rgba(200,215,255,0.85) !important; border-radius: 7px !important; font-size: 13px !important; }
    .main-header .dropdown-item:hover { background: rgba(59,130,246,0.1) !important; color: #fff !important; }
 
    /* SIDEBAR */
    .main-sidebar { background: var(--dark) !important; border-right: 1px solid var(--border) !important; }
    .brand-link { background: var(--dark) !important; border-bottom: 1px solid var(--border) !important; }
    .brand-text { color: #fff !important; font-weight: 700 !important; }
    .nav-sidebar .nav-header { color: rgba(99,130,200,0.6) !important; font-size: 10px !important; font-weight: 700 !important; letter-spacing: 0.12em !important; }
    .nav-sidebar .nav-link { color: rgba(200,215,255,0.7) !important; border-radius: 8px !important; margin: 2px 8px !important; font-size: 13px !important; font-weight: 500 !important; transition: all 0.2s !important; }
    .nav-sidebar .nav-link:hover { background: rgba(59,130,246,0.1) !important; color: #fff !important; }
    .nav-sidebar .nav-link.active { background: linear-gradient(135deg, rgba(59,130,246,0.2), rgba(99,102,241,0.15)) !important; color: #fff !important; border-left: 3px solid var(--blue) !important; font-weight: 600 !important; }
 
    /* CONTENT */
    .content-wrapper { background: var(--dark) !important; }
    .content-header h1 { color: #fff !important; font-size: 20px !important; font-weight: 700 !important; }
    .content-header .breadcrumb-item a { color: var(--blue) !important; }
    .content-header .breadcrumb-item.active { color: var(--muted) !important; }
    .border-bottom { border-color: var(--border) !important; }
 
    /* CARDS */
    .card { background: var(--card) !important; border: 1px solid var(--border) !important; border-radius: 12px !important; }
    .card-header { background: rgba(255,255,255,0.03) !important; border-bottom: 1px solid var(--border) !important; }
    .card-title { color: #fff !important; font-weight: 700 !important; }
    .card-body { background: transparent !important; }
    .card-footer { background: rgba(255,255,255,0.02) !important; border-top: 1px solid var(--border) !important; }
 
    /* LABELS Y TEXTOS */
    label.font-weight-bold { color: rgba(200,215,255,0.85) !important; }
    .text-secondary { color: rgba(200,215,255,0.6) !important; }
    .text-dark { color: #C8D7FF !important; }
    .text-muted { color: rgba(200,215,255,0.4) !important; }
 
    /* INPUTS */
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
 
    /* BOTONES */
    .btn-primary { background: linear-gradient(135deg, var(--blue), var(--indigo)) !important; border: none !important; color: #fff !important; border-radius: 8px !important; font-weight: 600 !important; }
    .btn-primary:hover { opacity: 0.9 !important; color: #fff !important; }
    .btn-warning { background: linear-gradient(135deg, #F59E0B, #D97706) !important; border: none !important; color: #fff !important; border-radius: 8px !important; font-weight: 600 !important; }
    .btn-outline-secondary { border-color: var(--border) !important; color: rgba(200,215,255,0.7) !important; border-radius: 8px !important; background: transparent !important; }
    .btn-outline-secondary:hover { background: rgba(255,255,255,0.05) !important; color: #fff !important; }
    .btn-info { background: linear-gradient(135deg, #06B6D4, #0891B2) !important; border: none !important; }
    .btn-danger { background: linear-gradient(135deg, #EF4444, #DC2626) !important; border: none !important; }
 
    /* TABLA */
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
 
    /* BADGES */
    .badge-primary { background: rgba(59,130,246,0.15) !important; color: #60A5FA !important; border-radius: 6px !important; }
    .badge-light { background: rgba(255,255,255,0.06) !important; color: rgba(200,215,255,0.7) !important; border-color: var(--border) !important; }
 
    /* ALERTA */
    .alert-success { background: rgba(16,185,129,0.1) !important; border: none !important; border-left: 4px solid #10B981 !important; color: #6EE7B7 !important; border-radius: 10px !important; }
 
    /* FOOTER */
    .main-footer { background: var(--dark2) !important; border-top: 1px solid var(--border) !important; color: var(--muted) !important; }
</style>
@endsection
 
@push('js')
<script>
    // Desvanecer alertas de éxito automáticamente en 4 segundos
    setTimeout(function () {
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
 