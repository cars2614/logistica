{{-- resources/views/admin/tipo-vehiculo/index.blade.php --}}

@extends('adminlte::page')

@section('title', 'Tipos de Vehículo')

@section('content_header')
    <h1><i class="fas fa-truck"></i> Tipos de Vehículo</h1>
@stop

@section('content')
<div class="container-fluid">

    {{-- Alertas --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-1"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Listado de Tipos de Vehículo</h3>
            <div class="card-tools">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCrear">
                    <i class="fas fa-plus"></i> Nuevo Tipo
                </button>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th style="width: 50px">#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tipoVehiculos as $index => $tipoVehiculo)
                        <tr>
                            <td>{{ $tipoVehiculos->firstItem() + $index }}</td>
                            <td><strong>{{ $tipoVehiculo->nombre }}</strong></td>
                            <td>{{ $tipoVehiculo->descripcion ?? '—' }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.tipo-vehiculo.edit', $tipoVehiculo->id) }}"
                                   class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.tipo-vehiculo.destroy', $tipoVehiculo->id) }}"
                                      method="POST" class="d-inline form-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="button"
                                        class="btn btn-danger btn-sm btn-eliminar"
                                        title="Eliminar"
                                        data-nombre="{{ $tipoVehiculo->nombre }}"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                No hay tipos de vehículo registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($tipoVehiculos->hasPages())
        <div class="card-footer clearfix">
            <div class="float-right">
                {{ $tipoVehiculos->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

{{-- Modal Crear --}}
<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="modalCrearLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.tipo-vehiculo.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalCrearLabel">
                        <i class="fas fa-plus mr-1"></i>Nuevo Tipo de Vehículo
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    {{-- Nombre --}}
                    <div class="form-group">
                        <label for="nombre_modal">Nombre <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            name="nombre"
                            id="nombre_modal"
                            class="form-control @error('nombre') is-invalid @enderror"
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
                        <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Letras, números, espacios y tildes. Máx. 100 caracteres.</small>
                    </div>

                    {{-- Descripción --}}
                    <div class="form-group">
                        <label for="descripcion_modal">Descripción</label>
                        <textarea
                            name="descripcion"
                            id="descripcion_modal"
                            class="form-control @error('descripcion') is-invalid @enderror"
                            rows="3"
                            maxlength="255"
                            placeholder="Opcional..."
                        >{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Opcional. <span id="desc-count-modal">0</span>/255 caracteres.</small>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i>Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal confirmación eliminar --}}
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Confirmar eliminación
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Está seguro que desea eliminar el tipo de vehículo
                <strong id="nombreEliminar"></strong>?
                <br>
                <small class="text-muted">Esta acción no se puede deshacer.</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-danger" id="btnConfirmarEliminar">
                    <i class="fas fa-trash mr-1"></i>Eliminar
                </button>
            </div>
        </div>
    </div>
</div>

@stop

@push('js')
<script>
    // Nombre modal: letras, números y tildes — limpia si se pega texto
    document.getElementById('nombre_modal').addEventListener('input', function () {
        this.value = this.value.replace(/[^a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s]/g, '');
    });

    // Contador de caracteres descripción modal
    const descModal = document.getElementById('descripcion_modal');
    const countModal = document.getElementById('desc-count-modal');
    countModal.textContent = descModal.value.length;
    descModal.addEventListener('input', function () {
        countModal.textContent = this.value.length;
    });

    // Modal eliminar
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

    // Reabrir modal si hay errores de validación
    @if ($errors->any())
        $(document).ready(function () {
            $('#modalCrear').modal('show');
        });
    @endif

    // Auto-cerrar alertas tras 4 segundos
    setTimeout(function () {
        document.querySelectorAll('.alert-dismissible').forEach(function (alert) {
            $(alert).fadeOut('slow');
        });
    }, 4000);
</script>
@endpush