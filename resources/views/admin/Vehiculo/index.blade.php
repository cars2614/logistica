{{-- resources/views/admin/vehiculo/index.blade.php --}}

@extends('adminlte::page')

@section('title', 'Vehículos')

@section('content_header')
    <h1><i class="fas fa-car"></i> Vehículos</h1>
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

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle mr-1"></i>{{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Listado de Vehículos</h3>
            <div class="card-tools">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCrear">
                    <i class="fas fa-plus"></i> Nuevo Vehículo
                </button>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th style="width:50px">#</th>
                        <th>Placa</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Tipo</th>
                        <th>Capacidad</th>
                        <th>Estado</th>
                        <th>Fecha Registro</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($vehiculos as $index => $vehiculo)
                        <tr>
                            <td>{{ $vehiculos->firstItem() + $index }}</td>
                            <td><strong>{{ $vehiculo->placa }}</strong></td>
                            <td>{{ $vehiculo->marca }}</td>
                            <td>{{ $vehiculo->modelo }}</td>
                            <td>{{ $vehiculo->tipoVehiculo->nombre ?? '—' }}</td>
                            <td>{{ number_format($vehiculo->capacidad) }} kg</td>
                            <td>
                                @if($vehiculo->estado === 'activo')
                                    <span class="badge badge-success">Activo</span>
                                @elseif($vehiculo->estado === 'inactivo')
                                    <span class="badge badge-secondary">Inactivo</span>
                                @else
                                    <span class="badge badge-warning">Mantenimiento</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($vehiculo->fecha_registro)->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.vehiculo.edit', $vehiculo->id) }}"
                                   class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.vehiculo.destroy', $vehiculo->id) }}"
                                      method="POST" class="d-inline form-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="button"
                                        class="btn btn-danger btn-sm btn-eliminar"
                                        title="Eliminar"
                                        data-placa="{{ $vehiculo->placa }}"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                No hay vehículos registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($vehiculos->hasPages())
        <div class="card-footer clearfix">
            <div class="float-right">
                {{ $vehiculos->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

{{-- Modal Crear --}}
<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="modalCrearLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.vehiculo.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalCrearLabel"><i class="fas fa-plus mr-1"></i>Nuevo Vehículo</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        {{-- Placa --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="m_placa">Placa <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="placa"
                                    id="m_placa"
                                    class="form-control @error('placa') is-invalid @enderror"
                                    value="{{ old('placa') }}"
                                    placeholder="Ej: ABC-123"
                                    maxlength="10"
                                    autocomplete="off"
                                    onkeypress="return /[a-zA-Z0-9\-]/.test(event.key)"
                                    style="text-transform: uppercase;"
                                    required
                                >
                                @error('placa')
                                    <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Letras, números y guión. Ej: ABC-123.</small>
                            </div>
                        </div>

                        {{-- Tipo de Vehículo --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="m_tipo_vehiculo_id">Tipo de Vehículo <span class="text-danger">*</span></label>
                                <select
                                    name="tipo_vehiculo_id"
                                    id="m_tipo_vehiculo_id"
                                    class="form-control @error('tipo_vehiculo_id') is-invalid @enderror"
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
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Seleccione el tipo de vehículo.</small>
                            </div>
                        </div>

                        {{-- Marca --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="m_marca">Marca <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="marca"
                                    id="m_marca"
                                    class="form-control @error('marca') is-invalid @enderror"
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
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Solo letras, espacios y tildes.</small>
                            </div>
                        </div>

                        {{-- Modelo --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="m_modelo">Modelo <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="modelo"
                                    id="m_modelo"
                                    class="form-control @error('modelo') is-invalid @enderror"
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
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Letras y números. Ej: NHR 2022.</small>
                            </div>
                        </div>

                        {{-- Capacidad --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="m_capacidad">Capacidad (kg) <span class="text-danger">*</span></label>
                                <input
                                    type="number"
                                    name="capacidad"
                                    id="m_capacidad"
                                    class="form-control @error('capacidad') is-invalid @enderror"
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
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Solo números enteros positivos. Ej: 5000.</small>
                            </div>
                        </div>

                        {{-- Estado --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="m_estado">Estado <span class="text-danger">*</span></label>
                                <select
                                    name="estado"
                                    id="m_estado"
                                    class="form-control @error('estado') is-invalid @enderror"
                                    required
                                >
                                    <option value="">-- Seleccione --</option>
                                    <option value="activo"        {{ old('estado') === 'activo'        ? 'selected' : '' }}>Activo</option>
                                    <option value="inactivo"      {{ old('estado') === 'inactivo'      ? 'selected' : '' }}>Inactivo</option>
                                    <option value="mantenimiento" {{ old('estado') === 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                                </select>
                                @error('estado')
                                    <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Seleccione el estado actual del vehículo.</small>
                            </div>
                        </div>

                        {{-- Fecha de Registro --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="m_fecha_registro">Fecha de Registro <span class="text-danger">*</span></label>
                                <input
                                    type="date"
                                    name="fecha_registro"
                                    id="m_fecha_registro"
                                    class="form-control @error('fecha_registro') is-invalid @enderror"
                                    value="{{ old('fecha_registro') }}"
                                    required
                                >
                                @error('fecha_registro')
                                    <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>No puede ser una fecha futura.</small>
                            </div>
                        </div>

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
                ¿Está seguro que desea eliminar el vehículo con placa
                <strong id="placaEliminar"></strong>?
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

    // Modal eliminar
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

    // Abrir modal si hay errores de validación
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