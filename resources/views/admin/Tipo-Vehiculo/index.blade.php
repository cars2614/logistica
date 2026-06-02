@extends('adminlte::page')

@section('title', 'Tipos de Vehículo')

@section('content_header')
    <div class="container-fluid pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
            <h1 class="m-0 font-weight-bold text-secondary">
                <i class="fas fa-truck text-primary mr-2"></i>Tipos de Vehículo
            </h1>
            <ol class="breadcrumb m-0 bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Tipos de Vehículo</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
<div class="container-fluid pb-4">

    {{-- Alertas con diseño premium --}}
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
        <div class="col-12">
            <div class="card card-outline card-primary shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <h3 class="card-title font-weight-bold text-dark mb-0">
                        <i class="fas fa-list text-primary mr-2"></i>Listado de Tipos de Vehículo
                    </h3>
                    <div class="card-tools d-flex align-items-center" style="gap: 10px;">
                        <span class="badge badge-pill badge-primary px-3 py-2 font-weight-bold shadow-sm">
                            Total: {{ $tipoVehiculos->total() }}
                        </span>
                        <button class="btn btn-primary btn-sm font-weight-bold shadow-sm px-3" data-toggle="modal" data-target="#modalCrear">
                            <i class="fas fa-plus mr-1"></i> Nuevo Tipo
                        </button>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light border-bottom text-secondary">
                                <tr>
                                    <th width="8%" class="text-center font-weight-bold border-0">#</th>
                                    <th width="35%" class="font-weight-bold border-0">Nombre</th>
                                    <th width="42%" class="font-weight-bold border-0">Descripción</th>
                                    <th width="15%" class="text-center font-weight-bold border-0">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tipoVehiculos as $index => $tipoVehiculo)
                                    <tr class="align-middle">
                                        <td class="text-center align-middle font-weight-bold text-muted">
                                            {{ $tipoVehiculos->firstItem() + $index }}
                                        </td>
                                        <td class="align-middle text-dark font-weight-bold text-uppercase" style="font-size: 0.88rem; letter-spacing: 0.2px;">
                                            <i class="fas fa-truck-moving text-muted mr-2" style="opacity: 0.6; font-size: 0.85rem;"></i>{{ $tipoVehiculo->nombre }}
                                        </td>
                                        <td class="align-middle text-secondary text-muted" style="font-size: 0.85rem;">
                                            {{ $tipoVehiculo->descripcion ?? '—' }}
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="d-inline-flex" style="gap: 6px;">
                                                {{-- Editar --}}
                                                <a href="{{ route('admin.tipo-vehiculo.edit', $tipoVehiculo->id) }}"
                                                   class="btn btn-sm btn-info shadow-sm d-flex align-items-center justify-content-center" 
                                                   title="Editar" style="width: 32px; height: 32px; border-radius: 6px;">
                                                    <i class="fas fa-pen fa-sm"></i>
                                                </a>
                                                
                                                {{-- Eliminar --}}
                                                <form action="{{ route('admin.tipo-vehiculo.destroy', $tipoVehiculo->id) }}"
                                                      method="POST" class="d-inline form-eliminar">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        type="button"
                                                        class="btn btn-sm btn-danger shadow-sm d-flex align-items-center justify-content-center btn-eliminar"
                                                        title="Eliminar"
                                                        style="width: 32px; height: 32px; border-radius: 6px;"
                                                        data-nombre="{{ $tipoVehiculo->nombre }}"
                                                    >
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
                                            <p class="mb-0 font-weight-bold">No hay tipos de vehículo registrados.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($tipoVehiculos->hasPages())
                    <div class="card-footer bg-white border-top py-3">
                        <div class="d-flex justify-content-center">
                            {{ $tipoVehiculos->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Modal Crear Premium --}}
<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="modalCrearLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <form action="{{ route('admin.tipo-vehiculo.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white py-3">
                    <h5 class="modal-title font-weight-bold mb-0" id="modalCrearLabel">
                        <i class="fas fa-plus-circle mr-2"></i>Nuevo Tipo de Vehículo
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">

                    {{-- Nombre --}}
                    <div class="form-group mb-3">
                        <label for="nombre_modal" class="font-weight-bold text-secondary mb-1">Nombre <span class="text-danger">*</span></label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light text-muted"><i class="fas fa-tag"></i></span>
                            </div>
                            <input
                                type="text"
                                name="nombre"
                                id="nombre_modal"
                                class="form-control border-left-0 @error('nombre') is-invalid @enderror"
                                value="{{ old('nombre') }}"
                                placeholder="Ej: Camión 5 Ton"
                                maxlength="100"
                                autocomplete="off"
                                onkeypress="return /[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s]/.test(event.key)"
                                required
                            >
                            @error('nombre')
                                <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>
                        <small class="form-text text-muted mt-1"><i class="fas fa-info-circle mr-1"></i>Letras, números, espacios y tildes. Máx. 100 caracteres.</small>
                    </div>

                    {{-- Descripción --}}
                    <div class="form-group mb-2">
                        <label for="descripcion_modal" class="font-weight-bold text-secondary mb-1">Descripción</label>
                        <textarea
                            name="descripcion"
                            id="descripcion_modal"
                            class="form-control form-control-sm @error('descripcion') is-invalid @enderror"
                            rows="3"
                            maxlength="255"
                            placeholder="Opcional..."
                            style="resize: none;"
                        >{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                        @enderror
                        <div class="d-flex justify-content-between mt-1">
                            <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Detalles breves del tipo.</small>
                            <small class="text-muted font-weight-bold"><span id="desc-count-modal">0</span>/255</small>
                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-light border-top-0 py-3">
                    <button type="button" class="btn btn-outline-secondary font-weight-bold shadow-sm px-3" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary font-weight-bold shadow-sm px-3">
                        <i class="fas fa-save mr-1"></i>Guardar Tipo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Confirmación Eliminar Premium --}}
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white py-3">
                <h5 class="modal-title font-weight-bold mb-0">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Confirmar Eliminación
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <p class="text-dark mb-2" style="font-size: 1rem;">¿Está completamente seguro de eliminar el tipo de vehículo <strong id="nombreEliminar" class="text-danger"></strong>?</p>
                <small class="text-muted bg-light d-block p-2 rounded border-left border-danger">
                    <i class="fas fa-info-circle mr-1"></i>Esta acción es permanente y afectará a los vehículos asociados a este tipo.
                </small>
            </div>
            <div class="modal-footer bg-light border-top-0 py-3">
                <button type="button" class="btn btn-outline-secondary font-weight-bold shadow-sm px-3" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-danger font-weight-bold shadow-sm px-3" id="btnConfirmarEliminar">
                    <i class="fas fa-trash-alt mr-1"></i>Eliminar Registro
                </button>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    /* Efecto hover elegante para las filas */
    .table-hover tbody tr {
        transition: background-color 0.2s ease;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.02) !important;
    }
    
    /* Inputs con bordes unificados e iconos integrados */
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
@stop

@section('js')
<script>
    // Nombre modal: letras, números y tildes
    document.getElementById('nombre_modal').addEventListener('input', function () {
        this.value = this.value.replace(/[^a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s]/g, '');
    });

    // Contador dinámico de caracteres en descripción modal
    const descModal = document.getElementById('descripcion_modal');
    const countModal = document.getElementById('desc-count-modal');
    countModal.textContent = descModal.value.length;
    descModal.addEventListener('input', function () {
        countModal.textContent = this.value.length;
    });

    // Manejo personalizado de eliminación
    let formEliminar = null;
    document.querySelectorAll('.btn-eliminar').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById('nombreEliminar').textContent = this.getAttribute('data-nombre');
            formEliminar = this.closest('form');
            $('#modalEliminar').modal('show');
        });
    });

    document.getElementById('btnConfirmarEliminar').addEventListener('click', function () {
        if (formEliminar) formEliminar.submit();
    });

    // Reabrir modal en caso de que falle la validación backend
    @if ($errors->any())
        $(document).ready(function () {
            $('#modalCrear').modal('show');
        });
    @endif

    // Cierre controlado de alertas
    setTimeout(function () {
        document.querySelectorAll('.alert-dismissible').forEach(function (alert) {
            $(alert).fadeOut('slow');
        });
    }, 4000);
</script>
@stop