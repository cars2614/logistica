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
            {{ session('success') }}
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
                            {{-- Se usa el offset de paginación para que el # sea correcto en todas las páginas --}}
                            <td>{{ $tipoVehiculos->firstItem() + $index }}</td>
                            <td><strong>{{ $tipoVehiculo->nombre }}</strong></td>
                            <td>{{ $tipoVehiculo->descripcion ?? '—' }}</td>
                            <td class="text-center">
                                {{-- Editar --}}
                                <a href="{{ route('admin.tipo-vehiculo.edit', $tipoVehiculo->id) }}"
                                   class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Eliminar --}}
                                <form action="{{ route('admin.tipo-vehiculo.destroy', $tipoVehiculo->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Eliminar este tipo de vehículo?')">
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
                            <td colspan="4" class="text-center text-muted py-4">
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
                    <h5 class="modal-title" id="modalCrearLabel">Nuevo Tipo de Vehículo</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre_modal">Nombre <span class="text-danger">*</span></label>
                        <input type="text" name="nombre" id="nombre_modal"
                               class="form-control @error('nombre') is-invalid @enderror"
                               value="{{ old('nombre') }}" required maxlength="100" placeholder="Ej: Camión 5 Ton">
                        @error('nombre')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="descripcion_modal">Descripción</label>
                        <textarea name="descripcion" id="descripcion_modal"
                                  class="form-control @error('descripcion') is-invalid @enderror"
                                  rows="3" maxlength="255" placeholder="Opcional...">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
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
    {{-- Reabrir modal si hay errores de validación --}}
    @if ($errors->any())
        <script>
            $(document).ready(function () {
                $('#modalCrear').modal('show');
            });
        </script>
    @endif
@stop