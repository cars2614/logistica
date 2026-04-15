@extends('adminlte::page')

@section('title', 'Estados de Guía')

@section('content_header')
    <h1>Estados de Guía</h1>
@stop

@section('content')

{{-- Alertas --}}
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

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Listado de Estados de Guía</h3>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCrear">
            <i class="fas fa-plus mr-1"></i> Nuevo Estado
        </button>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Guía N°</th>
                        <th>Fecha Estado</th>
                        <th>Estado</th>
                        <th>Descripción</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($estadoGuias as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                @if($item->guia)
                                    <span class="badge badge-info">{{ $item->guia->num_guias }}</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->fecha_estado)->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge badge-secondary">{{ $item->estado }}</span>
                            </td>
                            <td>{{ $item->descripcion }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.estado-guia.edit', $item->id) }}"
                                   class="btn btn-warning btn-xs" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.estado-guia.destroy', $item->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Eliminar este estado de guía?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">
                                No hay estados de guía registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($estadoGuias->hasPages())
        <div class="card-footer">
            {{ $estadoGuias->links() }}
        </div>
    @endif
</div>

{{-- Modal Crear --}}
<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog"
     aria-labelledby="modalCrearLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalCrearLabel">
                    <i class="fas fa-plus-circle mr-1"></i> Nuevo Estado de Guía
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form action="{{ route('admin.estado-guia.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        {{-- Guía --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="guia_id">Guía <span class="text-danger">*</span></label>
                                <select name="guia_id" id="guia_id"
                                        class="form-control @error('guia_id') is-invalid @enderror"
                                        required>
                                    <option value="">-- Seleccionar guía --</option>
                                    @foreach($guias as $guia)
                                        <option value="{{ $guia->id_guias }}"
                                            {{ old('guia_id') == $guia->id_guias ? 'selected' : '' }}>
                                            N° {{ $guia->num_guias }}
                                            — {{ $guia->cliente->nombre ?? 'Sin cliente' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('guia_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Fecha Estado --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_estado">
                                    Fecha y Hora del Estado <span class="text-danger">*</span>
                                </label>
                                <input type="datetime-local" name="fecha_estado" id="fecha_estado"
                                       class="form-control @error('fecha_estado') is-invalid @enderror"
                                       value="{{ old('fecha_estado') }}" required>
                                @error('fecha_estado')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Estado --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estado">Estado <span class="text-danger">*</span></label>
                                <input type="text" name="estado" id="estado"
                                       class="form-control @error('estado') is-invalid @enderror"
                                       value="{{ old('estado') }}" maxlength="255"
                                       placeholder="Ej: En tránsito, Entregado, Devuelto..." required>
                                @error('estado')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Descripción --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion">
                                    Descripción <span class="text-danger">*</span>
                                </label>
                                <textarea name="descripcion" id="descripcion" rows="3"
                                          class="form-control @error('descripcion') is-invalid @enderror"
                                          maxlength="255"
                                          placeholder="Describe el estado actual de la guía..."
                                          required>{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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

@stop

@section('js')
<script>
    @if($errors->any())
        $(document).ready(function () {
            $('#modalCrear').modal('show');
        });
    @endif
</script>
@stop