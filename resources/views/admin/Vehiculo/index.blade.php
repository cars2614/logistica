{{-- resources/views/admin/vehiculo/index.blade.php --}}

@extends('adminlte::page')

@section('title', 'Vehículos')

@section('content_header')
    <div class="container-fluid pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
            <h1 class="m-0 font-weight-bold text-secondary">
                <i class="fas fa-car text-primary mr-2"></i>Vehículos
            </h1>
            <ol class="breadcrumb m-0 bg-transparent p-0">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Vehículos</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
<div class="container-fluid pb-4">

    {{-- Alertas Premium --}}
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
        <div class="col-12">
            <div class="card card-outline card-primary shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <h3 class="card-title font-weight-bold text-dark mb-0">
                        <i class="fas fa-list text-primary mr-2"></i>Listado de Vehículos
                    </h3>
                    <div class="card-tools d-flex align-items-center" style="gap: 10px;">
                        <span class="badge badge-pill badge-primary px-3 py-2 font-weight-bold shadow-sm">
                            Total: {{ $vehiculos->total() }}
                        </span>
                        <button class="btn btn-primary btn-sm font-weight-bold shadow-sm px-3" data-toggle="modal" data-target="#modalCrear">
                            <i class="fas fa-plus mr-1"></i> Nuevo Vehículo
                        </button>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light border-bottom text-secondary">
                                <tr>
                                    <th width="5%" class="text-center font-weight-bold border-0">#</th>
                                    <th width="12%" class="font-weight-bold border-0">Placa</th>
                                    <th width="15%" class="font-weight-bold border-0">Marca</th>
                                    <th width="15%" class="font-weight-bold border-0">Modelo</th>
                                    <th width="15%" class="font-weight-bold border-0">Tipo</th>
                                    <th width="12%" class="font-weight-bold border-0">Capacidad</th>
                                    <th width="12%" class="font-weight-bold border-0">Estado</th>
                                    <th width="14%" class="font-weight-bold border-0">Fecha Registro</th>
                                    <th width="10%" class="text-center font-weight-bold border-0">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($vehiculos as $index => $vehiculo)
                                    <tr class="align-middle">
                                        <td class="text-center align-middle font-weight-bold text-muted">
                                            {{ $vehiculos->firstItem() + $index }}
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge badge-plate px-2 py-1 shadow-sm font-weight-bold text-uppercase">
                                                {{ $vehiculo->placa }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-dark font-weight-bold text-uppercase" style="font-size: 0.85rem;">{{ $vehiculo->marca }}</td>
                                        <td class="align-middle text-secondary" style="font-size: 0.85rem;">{{ $vehiculo->modelo }}</td>
                                        <td class="align-middle text-secondary" style="font-size: 0.85rem;">
                                            <i class="fas fa-truck text-muted mr-1" style="opacity: 0.5;"></i>{{ $vehiculo->tipoVehiculo->nombre ?? '—' }}
                                        </td>
                                        <td class="align-middle font-weight-bold text-dark" style="font-size: 0.85rem;">{{ number_format($vehiculo->capacidad) }} kg</td>
                                        <td class="align-middle">
                                            @if($vehiculo->estado === 'activo')
                                                <span class="badge badge-pill badge-success px-2 py-1" style="font-size: 0.75rem; font-weight: 700;">ACTIVO</span>
                                            @elseif($vehiculo->estado === 'inactivo')
                                                <span class="badge badge-pill badge-secondary px-2 py-1" style="font-size: 0.75rem; font-weight: 700;">INACTIVO</span>
                                            @else
                                                <span class="badge badge-pill badge-warning px-2 py-1 text-dark" style="font-size: 0.75rem; font-weight: 700;">MANTENIMIENTO</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-muted" style="font-size: 0.85rem;">
                                            {{ \Carbon\Carbon::parse($vehiculo->fecha_registro)->format('d/m/Y') }}
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="d-inline-flex" style="gap: 6px;">
                                                <a href="{{ route('admin.vehiculo.edit', $vehiculo->id) }}"
                                                   class="btn btn-sm btn-info shadow-sm d-flex align-items-center justify-content-center" 
                                                   title="Editar" style="width: 32px; height: 32px; border-radius: 6px;">
                                                    <i class="fas fa-pen fa-sm"></i>
                                                </a>
                                                
                                                <form action="{{ route('admin.vehiculo.destroy', $vehiculo->id) }}"
                                                      method="POST" class="d-inline form-eliminar">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        type="button"
                                                        class="btn btn-sm btn-danger shadow-sm d-flex align-items-center justify-content-center btn-eliminar"
                                                        title="Eliminar"
                                                        style="width: 32px; height: 32px; border-radius: 6px;"
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
                                        <td colspan="9" class="text-center text-muted py-5 bg-white">
                                            <i class="fas fa-folder-open fa-3x mb-3 text-muted" style="opacity: 0.5;"></i>
                                            <p class="mb-0 font-weight-bold">No hay vehículos registrados.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($vehiculos->hasPages())
                    <div class="card-footer bg-white border-top py-3">
                        <div class="d-flex justify-content-center">
                            {{ $vehiculos->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Modal Crear Premium --}}
<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="modalCrearLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <form action="{{ route('admin.vehiculo.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white py-3">
                    <h5 class="modal-title font-weight-bold mb-0" id="modalCrearLabel">
                        <i class="fas fa-plus-circle mr-2"></i>Nuevo Vehículo
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">

                        {{-- Placa --}}
                        <div class="col-md-6 form-group mb-3">
                            <label for="m_placa" class="font-weight-bold text-secondary mb-1">Placa <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-id-card"></i></span>
                                </div>
                                <input
                                    type="text"
                                    name="placa"
                                    id="m_placa"
                                    class="form-control border-left-0 text-uppercase font-weight-bold @error('placa') is-invalid @enderror"
                                    value="{{ old('placa') }}"
                                    placeholder="Ej: ABC-123"
                                    maxlength="10"
                                    autocomplete="off"
                                    onkeypress="return /[a-zA-Z0-9\-]/.test(event.key)"
                                    style="text-transform: uppercase; letter-spacing: 0.5px;"
                                    required
                                >
                                @error('placa')
                                    <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                @enderror
                            </div>
                            <small class="form-text text-muted mt-1"><i class="fas fa-info-circle mr-1"></i>Letras, números y guión. Ej: ABC-123.</small>
                        </div>

                        {{-- Tipo de Vehículo --}}
                        <div class="col-md-6 form-group mb-3">
                            <label for="m_tipo_vehiculo_id" class="font-weight-bold text-secondary mb-1">Tipo de Vehículo <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-truck"></i></span>
                                </div>
                                <select
                                    name="tipo_vehiculo_id"
                                    id="m_tipo_vehiculo_id"
                                    class="form-control border-left-0 @error('tipo_vehiculo_id') is-invalid @enderror"
                                    required
                                >
                                    <option value="">-- Seleccione --</option>
                                    @foreach($tipoVehiculos as $tipo)
                                        <option value="{{ $tipo->id }}" {{ old('tipo_vehiculo_id') == $tipo->id ? 'selected' : '' }}>
                                            {{ $tipo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tipo_vehiculo_id')
                                    <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                @enderror
                            </div>
                            <small class="form-text text-muted mt-1"><i class="fas fa-info-circle mr-1"></i>Seleccione la categoría correspondiente.</small>
                        </div>

                        {{-- Marca --}}
                        <div class="col-md-6 form-group mb-3">
                            <label for="m_marca" class="font-weight-bold text-secondary mb-1">Marca <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-copyright"></i></span>
                                </div>
                                <input
                                    type="text"
                                    name="marca"
                                    id="m_marca"
                                    class="form-control border-left-0 @error('marca') is-invalid @enderror"
                                    value="{{ old('marca') }}"
                                    placeholder="Ej: Chevrolet"
                                    maxlength="100"
                                    autocomplete="off"
                                    onkeypress="return /[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]/.test(event.key)"
                                    required
                                >
                                @error('marca')
                                    <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                @enderror
                            </div>
                            <small class="form-text text-muted mt-1"><i class="fas fa-info-circle mr-1"></i>Solo letras, espacios y tildes.</small>
                        </div>

                        {{-- Modelo --}}
                        <div class="col-md-6 form-group mb-3">
                            <label for="m_modelo" class="font-weight-bold text-secondary mb-1">Modelo / Línea <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-car-side"></i></span>
                                </div>
                                <input
                                    type="text"
                                    name="modelo"
                                    id="m_modelo"
                                    class="form-control border-left-0 @error('modelo') is-invalid @enderror"
                                    value="{{ old('modelo') }}"
                                    placeholder="Ej: NHR 2022"
                                    maxlength="100"
                                    autocomplete="off"
                                    onkeypress="return /[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s]/.test(event.key)"
                                    required
                                >
                                @error('modelo')
                                    <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                @enderror
                            </div>
                            <small class="form-text text-muted mt-1"><i class="fas fa-info-circle mr-1"></i>Letras y números. Ej: NHR 2022.</small>
                        </div>

                        {{-- Capacidad --}}
                        <div class="col-md-6 form-group mb-3">
                            <label for="m_capacidad" class="font-weight-bold text-secondary mb-1">Capacidad (kg) <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-weight-hanging"></i></span>
                                </div>
                                <input
                                    type="number"
                                    name="capacidad"
                                    id="m_capacidad"
                                    class="form-control border-left-0 @error('capacidad') is-invalid @enderror"
                                    value="{{ old('capacidad') }}"
                                    placeholder="Ej: 5000"
                                    min="1"
                                    max="999999"
                                    autocomplete="off"
                                    onkeypress="return /[0-9]/.test(event.key)"
                                    required
                                >
                                @error('capacidad')
                                    <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                @enderror
                            </div>
                            <small class="form-text text-muted mt-1"><i class="fas fa-info-circle mr-1"></i>Solo números enteros positivos.</small>
                        </div>

                        {{-- Estado --}}
                        <div class="col-md-6 form-group mb-3">
                            <label for="m_estado" class="font-weight-bold text-secondary mb-1">Estado inicial <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-toggle-on"></i></span>
                                </div>
                                <select
                                    name="estado"
                                    id="m_estado"
                                    class="form-control border-left-0 @error('estado') is-invalid @enderror"
                                    required
                                >
                                    <option value="">-- Seleccione --</option>
                                    <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                    <option value="mantenimiento" {{ old('estado') == 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                                </select>
                                @error('estado')
                                    <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                @enderror
                            </div>
                            <small class="form-text text-muted mt-1"><i class="fas fa-info-circle mr-1"></i>Disponibilidad inicial de la unidad.</small>
                        </div>

                        {{-- Fecha de Registro --}}
                        <div class="col-md-6 form-group mb-0">
                            <label for="m_fecha_registro" class="font-weight-bold text-secondary mb-1">Fecha de Registro <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input
                                    type="date"
                                    name="fecha_registro"
                                    id="m_fecha_registro"
                                    class="form-control border-left-0 @error('fecha_registro') is-invalid @enderror"
                                    value="{{ old('fecha_registro') }}"
                                    required
                                >
                                @error('fecha_registro')
                                    <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                @enderror
                            </div>
                            <small class="form-text text-muted mt-1"><i class="fas fa-info-circle mr-1"></i>No puede ser una fecha futura.</small>
                        </div>

                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0 py-3">
                    <button type="button" class="btn btn-outline-secondary font-weight-bold shadow-sm px-3" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary font-weight-bold shadow-sm px-3">
                        <i class="fas fa-save mr-1"></i>Guardar Vehículo
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
                    <i class="fas fa-exclamation-triangle mr-2"></i>Confirmar eliminación
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <p class="text-dark mb-2" style="font-size: 1rem;">¿Está seguro que desea eliminar el vehículo con placa <strong id="placaEliminar" class="text-danger"></strong>?</p>
                <small class="text-muted bg-light d-block p-2 rounded border-left border-danger">
                    <i class="fas fa-info-circle mr-1"></i>Esta acción no se puede deshacer y desvinculará el historial operativo del vehículo.
                </small>
            </div>
            <div class="modal-footer bg-light border-top-0 py-3">
                <button type="button" class="btn btn-outline-secondary font-weight-bold shadow-sm px-3" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-danger font-weight-bold shadow-sm px-3" id="btnConfirmarEliminar">
                    <i class="fas fa-trash mr-1"></i>Eliminar Registro
                </button>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    /* Efecto hover suave en la tabla */
    .table-hover tbody tr {
        transition: background-color 0.2s ease;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.02) !important;
    }
    
    /* Inputs unificados con iconos integrados */
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

    /* Estilo premium simulación placa vehicular */
    .badge-plate {
        background-color: #f9f9f9;
        color: #2c3e50;
        border: 2px solid #bdc3c7;
        font-family: 'Courier New', Courier, monospace;
        letter-spacing: 1px;
        font-size: 0.9rem;
        border-radius: 4px;
    }
</style>
@stop

@section('js')
<script>
    const hoy = new Date().toISOString().split('T')[0];

    // Fecha máxima = hoy en modal
    document.getElementById('m_fecha_registro').setAttribute('max', hoy);

    // Placa modal: mayúsculas y filtra al pegar
    document.getElementById('m_placa').addEventListener('input', function () {
        this.value = this.value.toUpperCase().replace(/[^A-Z0-9\-]/g, '');
    });

    // Marca modal: solo letras
    document.getElementById('m_marca').addEventListener('input', function () {
        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]/g, '');
    });

    // Modelo modal: letras y números
    document.getElementById('m_modelo').addEventListener('input', function () {
        this.value = this.value.replace(/[^a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s]/g, '');
    });

    // Capacidad modal: solo enteros positivos
    document.getElementById('m_capacidad').addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '');
        if (parseInt(this.value) < 1) this.value = '';
    });

    // Modal eliminar personalizado
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

    // Reabrir el modal en caso de que falle la validación backend de Laravel
    @if ($errors->any())
        $(document).ready(function () {
            $('#modalCrear').modal('show');
        });
    @endif

    // Desvanecimiento suave controlado de las alertas
    setTimeout(function () {
        document.querySelectorAll('.alert-dismissible').forEach(function (alert) {
            $(alert).fadeOut('slow');
        });
    }, 4000);
</script>
@stop