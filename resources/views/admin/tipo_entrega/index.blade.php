@extends('adminlte::page')

@section('title', 'Tipos de Entrega')

@section('content_header')
    <div class="container-fluid pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
            <h1 class="m-0 font-weight-bold text-secondary">
                <i class="fas fa-truck text-primary mr-2"></i>Tipos de Entrega
            </h1>
            <ol class="breadcrumb m-0 bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Tipos de Entrega</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
<div class="container-fluid pb-4">

    {{-- Alertas de sesión premium --}}
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

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mt-2" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle mr-2 fa-lg"></i>
                <div>{{ session('error') }}</div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>
    @endif

    <div class="row mt-3">

        {{-- ===================== FORMULARIO DE INGRESO ===================== --}}
        <div class="col-md-4 mb-4">
            <div class="card card-primary card-outline shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h3 class="card-title font-weight-bold text-dark mb-0">
                        <i class="fas fa-plus-circle text-primary mr-2"></i>Nuevo Tipo de Entrega
                    </h3>
                </div>

                <form action="{{ route('admin.tipo-entrega.store') }}" method="POST" id="formCrear">
                    @csrf

                    <div class="card-body py-3">

                        {{-- Nombre --}}
                        <div class="form-group mb-3">
                            <label for="nombre" class="font-weight-bold text-secondary mb-1">Nombre <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-tag"></i></span>
                                </div>
                                <input
                                    type="text"
                                    id="nombre"
                                    name="nombre"
                                    value="{{ old('nombre') }}"
                                    placeholder="Ej: Entrega a domicilio"
                                    class="form-control border-left-0 @error('nombre') is-invalid @enderror"
                                    maxlength="100"
                                    autocomplete="off"
                                    onkeypress="return /[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]/.test(event.key)"
                                >
                                @error('nombre')
                                    <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                @enderror
                            </div>
                            <small class="form-text text-muted mt-1"><i class="fas fa-info-circle mr-1"></i>Solo letras, espacios y tildes. Máx. 100 carac.</small>
                        </div>

                        {{-- Descripción --}}
                        <div class="form-group mb-3">
                            <label for="descripcion" class="font-weight-bold text-secondary mb-1">Descripción <span class="text-danger">*</span></label>
                            <textarea
                                id="descripcion"
                                name="descripcion"
                                rows="3"
                                placeholder="Descripción del tipo de entrega..."
                                class="form-control form-control-sm @error('descripcion') is-invalid @enderror"
                                maxlength="255"
                                style="resize: none;"
                            >{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                            <div class="d-flex justify-content-between mt-1">
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Opcional.</small>
                                <small class="text-muted font-weight-bold"><span id="desc-count">0</span>/255</small>
                            </div>
                        </div>

                        {{-- Estado --}}
                        <div class="form-group mb-2">
                            <label for="estado" class="font-weight-bold text-secondary mb-1">Estado <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-toggle-on"></i></span>
                                </div>
                                <select
                                    id="estado"
                                    name="estado"
                                    class="form-control border-left-0 @error('estado') is-invalid @enderror"
                                >
                                    <option value="">-- Seleccione --</option>
                                    <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ old('estado') === '0' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                                @error('estado')
                                    <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="card-footer bg-light border-top-0 d-flex flex-column p-3" style="gap: 8px;">
                        <button type="submit" class="btn btn-primary btn-block font-weight-bold shadow-sm py-2">
                            <i class="fas fa-save mr-2"></i> Guardar Registro
                        </button>
                        <button type="reset" class="btn btn-outline-secondary btn-block m-0 font-weight-bold py-2" id="btnLimpiar">
                            <i class="fas fa-undo mr-2"></i> Limpiar Campos
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ===================== TABLA DE REGISTROS ===================== --}}
        <div class="col-md-8">
            <div class="card card-outline card-primary shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <h3 class="card-title font-weight-bold text-dark mb-0">
                        <i class="fas fa-list text-primary mr-2"></i>Listado de Tipos de Entrega
                    </h3>
                    <span class="badge badge-pill badge-primary px-3 py-2 font-weight-bold shadow-sm">
                        Total: {{ $tipoEntregas->total() }}
                    </span>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light border-bottom text-secondary">
                                <tr>
                                    <th width="8%" class="text-center font-weight-bold border-0">#</th>
                                    <th width="32%" class="font-weight-bold border-0">Nombre</th>
                                    <th width="35%" class="font-weight-bold border-0">Descripción</th>
                                    <th width="12%" class="text-center font-weight-bold border-0">Estado</th>
                                    <th width="13%" class="text-center font-weight-bold border-0">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tipoEntregas as $item)
                                    <tr class="align-middle">
                                        <td class="text-center align-middle font-weight-bold text-muted">{{ $item->id }}</td>
                                        <td class="align-middle text-dark font-weight-bold text-uppercase" style="font-size: 0.88rem; letter-spacing: 0.2px;">
                                            <i class="fas fa-shipping-fast text-muted mr-2" style="opacity: 0.6; font-size: 0.85rem;"></i>{{ $item->nombre }}
                                        </td>
                                        <td class="align-middle text-secondary text-muted" style="font-size: 0.85rem;">
                                            <span title="{{ $item->descripcion }}">
                                                {{ Str::limit($item->descripcion, 50) }}
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge badge-pill px-2 py-1 font-weight-bold shadow-xs {{ str_contains($item->estado_badge, 'success') ? 'badge-success' : 'badge-danger' }}" style="font-size: 0.75rem;">
                                                {{ $item->estado_label }}
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="d-inline-flex" style="gap: 6px;">
                                                {{-- Editar --}}
                                                <a href="{{ route('admin.tipo-entrega.edit', $item) }}" 
                                                   class="btn btn-sm btn-info shadow-sm d-flex align-items-center justify-content-center" 
                                                   title="Editar" style="width: 32px; height: 32px; border-radius: 6px;">
                                                    <i class="fas fa-pen fa-sm"></i>
                                                </a>
                                                
                                                {{-- Eliminar --}}
                                                <form action="{{ route('admin.tipo-entrega.destroy', $item) }}" method="POST" class="d-inline form-eliminar">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        type="button"
                                                        class="btn btn-sm btn-danger shadow-sm d-flex align-items-center justify-content-center btn-eliminar"
                                                        title="Eliminar"
                                                        style="width: 32px; height: 32px; border-radius: 6px;"
                                                        data-nombre="{{ $item->nombre }}"
                                                    >
                                                        <i class="fas fa-trash fa-sm"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-5 bg-white">
                                            <i class="fas fa-folder-open fa-3x mb-3 text-muted" style="opacity: 0.5;"></i>
                                            <p class="mb-0 font-weight-bold">No hay tipos de entrega registrados.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($tipoEntregas->hasPages())
                    <div class="card-footer bg-white border-top py-3">
                        <div class="d-flex justify-content-center">
                            {{ $tipoEntregas->links() }}
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

{{-- Modal Premium de confirmación de eliminación --}}
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white py-3">
                <h5 class="modal-title font-weight-bold mb-0">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Confirmar Eliminación
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <p class="text-dark mb-2" style="font-size: 1rem;">¿Está completamente seguro de eliminar el tipo de entrega <strong id="nombreEliminar" class="text-danger"></strong>?</p>
                <small class="text-muted bg-light d-block p-2 rounded border-left border-danger">
                    <i class="fas fa-info-circle mr-1"></i>Esta acción es permanente y no se podrá deshacer en el sistema.
                </small>
            </div>
            <div class="modal-footer bg-light border-top-0 py-3">
                <button type="button" class="btn btn-outline-secondary font-weight-bold px-3 shadow-sm" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-danger font-weight-bold px-3 shadow-sm" id="btnConfirmarEliminar">
                    <i class="fas fa-trash-alt mr-1"></i>Eliminar Registro
                </button>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    /* Efecto hover suave para filas */
    .table-hover tbody tr {
        transition: background-color 0.2s ease;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.02) !important;
    }
    
    /* Inputs unificados con prefijo de iconos */
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
    
    /* Estilos limpios para paginación */
    .pagination {
        margin-bottom: 0px !important;
    }
</style>
@stop

@section('js')
<script>
    // Nombre: solo letras y tildes
    document.getElementById('nombre').addEventListener('input', function () {
        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]/g, '');
    });

    // Contador de caracteres descripción
    const desc = document.getElementById('descripcion');
    const count = document.getElementById('desc-count');
    count.textContent = desc.value.length;
    desc.addEventListener('input', function () {
        count.textContent = this.value.length;
    });

    // Limpiar contador al resetear formulario
    document.getElementById('btnLimpiar').addEventListener('click', function () {
        setTimeout(() => { count.textContent = 0; }, 10);
    });

    // Modal de eliminación
    let formEliminar = null;
    document.querySelectorAll('.btn-eliminar').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const nombre = this.getAttribute('data-nombre');
            document.getElementById('nombreEliminar').textContent = nombre;
            formEliminar = this.closest('form');
            $('#modalEliminar').modal('show');
        });
    });

    document.getElementById('btnConfirmarEliminar').addEventListener('click', function () {
        if (formEliminar) formEliminar.submit();
    });

    // Auto-cerrar alertas tras 4 segundos
    setTimeout(function () {
        document.querySelectorAll('.alert-dismissible').forEach(function (alert) {
            $(alert).fadeOut('slow');
        });
    }, 4000);
</script>
@stop