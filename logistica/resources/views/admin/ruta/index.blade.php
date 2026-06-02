@extends('adminlte::page')

@section('title', 'Rutas')

@section('content_header')
    <h1>Gestión de Rutas</h1>
@stop

@section('content')

{{-- Alertas de sesión --}}
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

{{-- Errores de validación --}}
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class="fas fa-exclamation-triangle mr-1"></i> Corrige los siguientes errores:</strong>
        <ul class="mb-0 mt-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

{{-- Tabla principal --}}
<div class="card card-outline card-primary">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">
            <i class="fas fa-route mr-1"></i> Listado de Rutas
        </h3>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCrear">
            <i class="fas fa-plus mr-1"></i> Nueva Ruta
        </button>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center" style="width:60px;">#</th>
                        <th>Zona</th>
                        <th>Guía</th>
                        <th>Dirección</th>
                        <th>Sector</th>
                        <th>Ciudad</th>
                        <th class="text-center" style="width:110px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rutas as $ruta)
                        <tr>
                            <td class="text-center">{{ $ruta->id }}</td>
                            <td>
                                <span class="badge badge-primary">{{ $ruta->zona }}</span>
                            </td>
                            <td>{{ $ruta->guia }}</td>
                            <td>{{ $ruta->direccion }}</td>
                            <td>{{ $ruta->sector }}</td>
                            <td>{{ $ruta->ciudad }}</td>
                            <td class="text-center">
                                {{-- Botón Editar --}}
                                <a href="{{ route('admin.ruta.edit', $ruta->id) }}"
                                   class="btn btn-warning btn-xs"
                                   title="Editar ruta">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Botón Eliminar --}}
                                <form action="{{ route('admin.ruta.destroy', $ruta->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('¿Está seguro de eliminar esta ruta?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-danger btn-xs"
                                            title="Eliminar ruta">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                No hay rutas registradas aún.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Paginación --}}
    @if($rutas->hasPages())
        <div class="card-footer clearfix">
            {{ $rutas->links() }}
        </div>
    @endif
</div>


{{-- ===================== MODAL CREAR RUTA ===================== --}}
<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog"
     aria-labelledby="modalCrearLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalCrearLabel">
                    <i class="fas fa-plus-circle mr-1"></i> Nueva Ruta
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('admin.ruta.store') }}" method="POST" autocomplete="off">
                @csrf

                <div class="modal-body">
                    <div class="row">

                        {{-- Zona --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="zona">
                                    Zona <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="zona"
                                       id="zona"
                                       class="form-control @error('zona') is-invalid @enderror"
                                       value="{{ old('zona') }}"
                                       maxlength="255"
                                       placeholder="Ej: Norte, Sur, Centro..."
                                       required>
                                @error('zona')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Guía --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="guia">
                                    Guía <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="guia"
                                       id="guia"
                                       class="form-control @error('guia') is-invalid @enderror"
                                       value="{{ old('guia') }}"
                                       maxlength="255"
                                       placeholder="Número o código de guía"
                                       required>
                                @error('guia')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Dirección --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="direccion">
                                    Dirección <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="direccion"
                                       id="direccion"
                                       class="form-control @error('direccion') is-invalid @enderror"
                                       value="{{ old('direccion') }}"
                                       maxlength="255"
                                       placeholder="Dirección completa de la ruta"
                                       required>
                                @error('direccion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Sector --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sector">
                                    Sector <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="sector"
                                       id="sector"
                                       class="form-control @error('sector') is-invalid @enderror"
                                       value="{{ old('sector') }}"
                                       maxlength="255"
                                       placeholder="Sector o barrio"
                                       required>
                                @error('sector')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Ciudad --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ciudad">
                                    Ciudad <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="ciudad"
                                       id="ciudad"
                                       class="form-control @error('ciudad') is-invalid @enderror"
                                       value="{{ old('ciudad') }}"
                                       maxlength="255"
                                       placeholder="Ciudad de destino"
                                       required>
                                @error('ciudad')
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
                        <i class="fas fa-save mr-1"></i> Guardar Ruta
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
{{-- ===================== FIN MODAL ===================== --}}

@stop

@section('js')
<script>
    {{-- Reabrir modal si hubo errores de validación al crear --}}
    @if($errors->any())
        $(document).ready(function () {
            $('#modalCrear').modal('show');
        });
    @endif
</script>
@stop