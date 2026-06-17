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
    /* Transición suave para filas */
    .table-hover tbody tr {
        transition: background-color 0.2s ease;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.02) !important;
    }
    
    /* Efecto unificado para los inputs con prefijos */
    .input-group-text {
        border-right: none !important;
    }
    .form-control {
        border-left: none !important;
    }
    .form-control:focus {
        border-color: #ced4da !important;
        box-shadow: none !important;
    }
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