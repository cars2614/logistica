@extends('adminlte::page')

@section('title', 'Tipos de Entrega')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0 text-dark">
            <i class="fas fa-truck mr-2"></i>Tipos de Entrega
        </h1>
        <ol class="breadcrumb float-sm-right m-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Inicio</a>
            </li>
            <li class="breadcrumb-item active">Tipos de Entrega</li>
        </ol>
    </div>
@stop

@section('content')

    {{-- Alertas de sesión --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="row">

        {{-- ===================== FORMULARIO DE INGRESO ===================== --}}
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-plus-circle mr-1"></i> Nuevo Tipo de Entrega
                    </h3>
                </div>

                <form action="{{ route('admin.tipo-entrega.store') }}" method="POST" id="formCrear">
                    @csrf

                    <div class="card-body">

                        {{-- Nombre --}}
                        <div class="form-group">
                            <label for="nombre">
                                Nombre <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                id="nombre"
                                name="nombre"
                                value="{{ old('nombre') }}"
                                placeholder="Ej: Entrega a domicilio"
                                class="form-control @error('nombre') is-invalid @enderror"
                                maxlength="255"
                                autocomplete="off"
                            >
                            @error('nombre')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Descripción --}}
                        <div class="form-group">
                            <label for="descripcion">
                                Descripción <span class="text-danger">*</span>
                            </label>
                            <textarea
                                id="descripcion"
                                name="descripcion"
                                rows="3"
                                placeholder="Descripción del tipo de entrega..."
                                class="form-control @error('descripcion') is-invalid @enderror"
                                maxlength="255"
                            >{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Estado --}}
                        <div class="form-group">
                            <label for="estado">
                                Estado <span class="text-danger">*</span>
                            </label>
                            <select
                                id="estado"
                                name="estado"
                                class="form-control @error('estado') is-invalid @enderror"
                            >
                                <option value="">-- Seleccione --</option>
                                <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ old('estado') === '0' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('estado')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save mr-1"></i> Guardar
                        </button>
                        <button type="reset" class="btn btn-secondary btn-block mt-1">
                            <i class="fas fa-undo mr-1"></i> Limpiar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ===================== TABLA DE REGISTROS ===================== --}}
        <div class="col-md-8">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-list mr-1"></i> Listado de Tipos de Entrega
                    </h3>
                    <div class="card-tools">
                        <span class="badge badge-primary">
                            Total: {{ $tipoEntregas->total() }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="5%" class="text-center">#</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th width="10%" class="text-center">Estado</th>
                                    <th width="15%" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tipoEntregas as $item)
                                    <tr>
                                        <td class="text-center align-middle">{{ $item->id }}</td>
                                        <td class="align-middle">{{ $item->nombre }}</td>
                                        <td class="align-middle">
                                            <span title="{{ $item->descripcion }}">
                                                {{ Str::limit($item->descripcion, 50) }}
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge {{ $item->estado_badge }}">
                                                {{ $item->estado_label }}
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">
                                            {{-- Botón Editar --}}
                                            <a
                                                href="{{ route('admin.tipo-entrega.edit', $item) }}"
                                                class="btn btn-sm btn-warning"
                                                title="Editar"
                                            >
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            {{-- Botón Eliminar --}}
                                            <form
                                                action="{{ route('admin.tipo-entrega.destroy', $item) }}"
                                                method="POST"
                                                class="d-inline form-eliminar"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="button"
                                                    class="btn btn-sm btn-danger btn-eliminar"
                                                    title="Eliminar"
                                                    data-nombre="{{ $item->nombre }}"
                                                >
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                            No hay tipos de entrega registrados.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($tipoEntregas->hasPages())
                    <div class="card-footer">
                        {{ $tipoEntregas->links() }}
                    </div>
                @endif

            </div>
        </div>

    </div>

    {{-- Modal de confirmación de eliminación --}}
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
                    ¿Está seguro que desea eliminar el tipo de entrega
                    <strong id="nombreEliminar"></strong>?
                    <br>
                    <small class="text-muted">Esta acción no se puede deshacer.</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Cancelar
                    </button>
                    <button type="button" class="btn btn-danger" id="btnConfirmarEliminar">
                        <i class="fas fa-trash-alt mr-1"></i>Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
<script>
    let formEliminar = null;

    // Captura del botón eliminar — abre el modal de confirmación
    document.querySelectorAll('.btn-eliminar').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const nombre = this.getAttribute('data-nombre');
            document.getElementById('nombreEliminar').textContent = nombre;
            formEliminar = this.closest('form');
            $('#modalEliminar').modal('show');
        });
    });

    // Confirmación de eliminación
    document.getElementById('btnConfirmarEliminar').addEventListener('click', function () {
        if (formEliminar) {
            formEliminar.submit();
        }
    });

    // Auto-cerrar alertas de sesión tras 4 segundos
    setTimeout(function () {
        document.querySelectorAll('.alert-dismissible').forEach(function (alert) {
            $(alert).fadeOut('slow');
        });
    }, 4000);
</script>
@stop