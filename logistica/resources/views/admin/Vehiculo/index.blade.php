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
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
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
                            <td>{{ $vehiculo->capacidad }}</td>
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
                                {{-- Editar --}}
                                <a href="{{ route('admin.vehiculo.edit', $vehiculo->id) }}"
                                   class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Eliminar --}}
                                <form action="{{ route('admin.vehiculo.destroy', $vehiculo->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Eliminar este vehículo?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
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
                    <h5 class="modal-title" id="modalCrearLabel">Nuevo Vehículo</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="placa">Placa <span class="text-danger">*</span></label>
                                <input type="text" name="placa" id="placa"
                                       class="form-control @error('placa') is-invalid @enderror"
                                       value="{{ old('placa') }}" required maxlength="10"
                                       placeholder="Ej: ABC-123">
                                @error('placa')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_vehiculo_id">Tipo de Vehículo <span class="text-danger">*</span></label>
                                <select name="tipo_vehiculo_id" id="tipo_vehiculo_id"
                                        class="form-control @error('tipo_vehiculo_id') is-invalid @enderror" required>
                                    <option value="">-- Seleccione --</option>
                                    @foreach($tipoVehiculos as $tipo)
                                        <option value="{{ $tipo->id }}" {{ old('tipo_vehiculo_id') == $tipo->id ? 'selected' : '' }}>
                                            {{ $tipo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tipo_vehiculo_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="marca">Marca <span class="text-danger">*</span></label>
                                <input type="text" name="marca" id="marca"
                                       class="form-control @error('marca') is-invalid @enderror"
                                       value="{{ old('marca') }}" required maxlength="100"
                                       placeholder="Ej: Chevrolet">
                                @error('marca')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modelo">Modelo <span class="text-danger">*</span></label>
                                <input type="text" name="modelo" id="modelo"
                                       class="form-control @error('modelo') is-invalid @enderror"
                                       value="{{ old('modelo') }}" required maxlength="100"
                                       placeholder="Ej: NHR 2022">
                                @error('modelo')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="capacidad">Capacidad (kg) <span class="text-danger">*</span></label>
                                <input type="number" name="capacidad" id="capacidad"
                                       class="form-control @error('capacidad') is-invalid @enderror"
                                       value="{{ old('capacidad') }}" required min="0"
                                       placeholder="Ej: 5000">
                                @error('capacidad')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estado">Estado <span class="text-danger">*</span></label>
                                <select name="estado" id="estado"
                                        class="form-control @error('estado') is-invalid @enderror" required>
                                    <option value="">-- Seleccione --</option>
                                    <option value="activo"        {{ old('estado') === 'activo'        ? 'selected' : '' }}>Activo</option>
                                    <option value="inactivo"      {{ old('estado') === 'inactivo'      ? 'selected' : '' }}>Inactivo</option>
                                    <option value="mantenimiento" {{ old('estado') === 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                                </select>
                                @error('estado')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_registro">Fecha de Registro <span class="text-danger">*</span></label>
                                <input type="date" name="fecha_registro" id="fecha_registro"
                                       class="form-control @error('fecha_registro') is-invalid @enderror"
                                       value="{{ old('fecha_registro') }}" required>
                                @error('fecha_registro')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('js')
    @if ($errors->any())
        <script>
            $(document).ready(function () {
                $('#modalCrear').modal('show');
            });
        </script>
    @endif
@stop