{{-- resources/views/admin/guia/index.blade.php --}}

@extends('adminlte::page')

@section('title', 'Guías')

@section('content_header')
    <h1>Gestión de Guías</h1>
@stop

{{-- ESTILOS EXCLUSIVOS PARA REPARAR LOS INPUTS PLANOS DEL MODAL DE GUÍAS --}}
@section('css')
<style>
    /* Forzar a que todos los campos del modal tengan su borde gris y fondo blanco completo */
    #modalCrear .form-control, 
    #modalCrear select.form-control,
    #modalCrear .input-group-text {
        border: 1px solid #ced4da !important;
        border-radius: 0.25rem !important;
        background-color: #ffffff !important;
        color: #495057 !important;
        height: calc(2.25rem + 2px) !important;
        padding: 0.375rem 0.75rem !important;
    }

    /* Ajustar el prefijo del signo de precio ($) para que no se desfase */
    #modalCrear .input-group-prepend .input-group-text {
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
        border-right: none !important;
    }
    #modalCrear .input-group > .form-control {
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
    }

    /* Efecto de borde azul clásico al hacer clic (Focus) */
    #modalCrear .form-control:focus {
        border-color: #80bdff !important;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
    }

    /* Separación correcta entre filas del formulario */
    #modalCrear .form-group {
        margin-bottom: 1.25rem !important;
    }
    #modalCrear .form-text {
        margin-top: 0.3rem !important;
        display: block !important;
    }
</style>
@stop

@section('content')

{{-- Alertas del Sistema --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

{{-- Tabla Principal --}}
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Listado de Guías</h3>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCrear">
            <i class="fas fa-plus mr-1"></i> Nueva Guía
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>N° Guía</th>
                        <th>Cliente</th>
                        <th>Tipo Entrega</th>
                        <th>Volumen</th>
                        <th>Peso</th>
                        <th>Precio</th>
                        <th>Unidades</th>
                        <th>Fecha Admisión</th>
                        <th>Observación</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($guias as $guia)
                        <tr>
                            <td>{{ $guia->id }}</td>
                            <td>{{ $guia->num_guias }}</td>
                            <td>{{ $guia->clienteOrigen->nombre ?? '—' }}</td>
                            <td>{{ $guia->tipoEntrega->nombre ?? '—' }}</td>
                            <td>{{ number_format($guia->volumen, 2) }} m³</td>
                            <td>{{ number_format($guia->peso, 2) }} kg</td>
                            <td>${{ number_format($guia->precio, 2) }}</td>
                            <td>{{ $guia->unidades }}</td>
                            <td>{{ \Carbon\Carbon::parse($guia->fecha_admision)->format('d/m/Y') }}</td>
                            <td>{{ $guia->observacion ?? '—' }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.guia.edit', $guia->id) }}" class="btn btn-warning btn-xs" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.guia.destroy', $guia->id) }}" method="POST" class="d-inline form-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-xs btn-eliminar" title="Eliminar" data-num="{{ $guia->num_guias }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center text-muted py-3">
                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                No hay guías registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($guias->hasPages())
        <div class="card-footer">
            {{ $guias->links() }}
        </div>
    @endif
</div>

{{-- Modal Crear Guía --}}
<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="modalCrearLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalCrearLabel">
                    <i class="fas fa-plus-circle mr-1"></i> Nueva Guía
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form action="{{ route('admin.guia.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        {{-- Número de guía --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="m_num_guias">N° de Guía <span class="text-danger">*</span></label>
                                <input
                                    type="number"
                                    name="num_guias"
                                    id="m_num_guias"
                                    class="form-control @error('num_guias') is-invalid @enderror"
                                    value="{{ old('num_guias') }}"
                                    placeholder="Ej: 1001"
                                    min="1"
                                    autocomplete="off"
                                    required
                                >
                                @error('num_guias')
                                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Solo números enteros positivos.</small>
                            </div>
                        </div>

                        {{-- Fecha de admisión --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="m_fecha_admision">Fecha de Admisión <span class="text-danger">*</span></label>
                                <input
                                    type="date"
                                    name="fecha_admision"
                                    id="m_fecha_admision"
                                    class="form-control @error('fecha_admision') is-invalid @enderror"
                                    value="{{ old('fecha_admision') }}"
                                    required
                                >
                                @error('fecha_admision')
                                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>No puede ser una fecha futura.</small>
                            </div>
                        </div>

                        {{-- Cliente --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="m_cliente_id">Cliente <span class="text-danger">*</span></label>
                                <select
                                    name="cliente_id"
                                    id="m_cliente_id"
                                    class="form-control @error('cliente_id') is-invalid @enderror"
                                    required
                                >
                                    <option value="">-- Seleccionar cliente --</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('cliente_id')
                                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Seleccione el cliente asociado.</small>
                            </div>
                        </div>

                        {{-- Tipo de Entrega --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="m_tipo_entrega_id">Tipo de Entrega <span class="text-danger">*</span></label>
                                <select
                                    name="tipo_entrega_id"
                                    id="m_tipo_entrega_id"
                                    class="form-control @error('tipo_entrega_id') is-invalid @enderror"
                                    required
                                >
                                    <option value="">-- Seleccionar tipo --</option>
                                    @foreach($tipoEntregas as $tipo)
                                        <option value="{{ $tipo->id }}" {{ old('tipo_entrega_id') == $tipo->id ? 'selected' : '' }}>
                                            {{ $tipo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tipo_entrega_id')
                                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Seleccione el tipo de entrega.</small>
                            </div>
                        </div>

                        {{-- Volumen --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="m_volumen">Volumen (m³) <span class="text-danger">*</span></label>
                                <input
                                    type="number"
                                    name="volumen"
                                    id="m_volumen"
                                    class="form-control @error('volumen') is-invalid @enderror"
                                    value="{{ old('volumen') }}"
                                    placeholder="Ej: 1.50"
                                    step="0.01"
                                    min="0.01"
                                    autocomplete="off"
                                    required
                                >
                                @error('volumen')
                                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Número positivo. Ej: 1.50</small>
                            </div>
                        </div>

                        {{-- Peso --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="m_peso">Peso (kg) <span class="text-danger">*</span></label>
                                <input
                                    type="number"
                                    name="peso"
                                    id="m_peso"
                                    class="form-control @error('peso') is-invalid @enderror"
                                    value="{{ old('peso') }}"
                                    placeholder="Ej: 10.50"
                                    step="0.01"
                                    min="0.01"
                                    autocomplete="off"
                                    required
                                >
                                @error('peso')
                                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Número positivo. Ej: 10.50</small>
                            </div>
                        </div>

                        {{-- Unidades --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="m_unidades">Unidades <span class="text-danger">*</span></label>
                                <input
                                    type="number"
                                    name="unidades"
                                    id="m_unidades"
                                    class="form-control @error('unidades') is-invalid @enderror"
                                    value="{{ old('unidades') }}"
                                    placeholder="Ej: 5"
                                    min="1"
                                    autocomplete="off"
                                    required
                                >
                                @error('unidades')
                                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Solo enteros positivos. Ej: 5</small>
                            </div>
                        </div>

                        {{-- Precio --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="m_precio">Precio <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input
                                        type="number"
                                        name="precio"
                                        id="m_precio"
                                        class="form-control @error('precio') is-invalid @enderror"
                                        value="{{ old('precio') }}"
                                        placeholder="Ej: 25000.00"
                                        step="0.01"
                                        min="0.01"
                                        autocomplete="off"
                                        required
                                    >
                                    @error('precio')
                                        <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Valor positivo en pesos.</small>
                            </div>
                        </div>

                        {{-- Observación --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="m_observacion">Observación</label>
                                <input
                                    type="text"
                                    name="observacion"
                                    id="m_observacion"
                                    class="form-control @error('observacion') is-invalid @enderror"
                                    value="{{ old('observacion') }}"
                                    placeholder="Ej: Frágil, manejar con cuidado"
                                    maxlength="255"
                                    autocomplete="off"
                                >
                                @error('observacion')
                                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Opcional. <span id="obs-count-modal">0</span>/255 caract.</small>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Guardar
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- Modal Eliminar --}}
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle mr-2"></i>Confirmar eliminación</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                ¿Está seguro que desea eliminar la guía N° <strong id="numEliminar"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btnConfirmarEliminar">Eliminar</button>
            </div>
        </div>
    </div>
</div>

@stop

@push('js')
<script>
    const hoy = new Date().toISOString().split('T')[0];
    document.getElementById('m_fecha_admision').setAttribute('max', hoy);

    // Filtrar solo números enteros
    ['m_num_guias', 'm_unidades'].forEach(function(id) {
        document.getElementById(id).addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
        });
    });

    // Contador de texto dinámico
    const obsModal = document.getElementById('m_observacion');
    const obsCountModal = document.getElementById('obs-count-modal');
    obsModal.addEventListener('input', function() {
        obsCountModal.textContent = this.value.length;
    });

    // Scripts para el modal de eliminación
    let formEliminar = null;
    document.querySelectorAll('.btn-eliminar').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.getElementById('numEliminar').textContent = this.getAttribute('data-num');
            formEliminar = this.closest('form');
            $('#modalEliminar').modal('show');
        });
    });

    document.getElementById('btnConfirmarEliminar').addEventListener('click', function() {
        if(formEliminar) formEliminar.submit();
    });

    // Reabrir modal en caso de error de validación
    @if($errors->any())
        $(document).ready(function() { $('#modalCrear').modal('show'); });
    @endif
</script>
@endpush