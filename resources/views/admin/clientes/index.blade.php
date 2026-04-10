@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1><i class="fas fa-users"></i> Clientes</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Clientes</li>
        </ol>
    </nav>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        {{-- Formulario Crear / Editar --}}
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        @isset($cliente)
                            <i class="fas fa-edit"></i> Editar Cliente
                        @else
                            <i class="fas fa-plus-circle"></i> Nuevo Cliente
                        @endisset
                    </h3>
                </div>

                @isset($cliente)
                    <form action="{{ route('admin.cliente.update', $cliente->id) }}" method="POST">
                    @method('PUT')
                @else
                    <form action="{{ route('admin.cliente.store') }}" method="POST">
                @endisset
                @csrf

                <div class="card-body">

                    {{-- Nombre --}}
                    <div class="form-group">
                        <label for="nombre">Nombre <span class="text-danger">*</span></label>
                        <input type="text"
                               name="nombre"
                               id="nombre"
                               class="form-control @error('nombre') is-invalid @enderror"
                               placeholder="Ej: Juan Pérez"
                               value="{{ old('nombre', $cliente->nombre ?? '') }}">
                        @error('nombre')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Teléfono --}}
                    <div class="form-group">
                        <label for="telefono">Teléfono <span class="text-danger">*</span></label>
                        <input type="text"
                               name="telefono"
                               id="telefono"
                               class="form-control @error('telefono') is-invalid @enderror"
                               placeholder="Ej: 3001234567"
                               value="{{ old('telefono', $cliente->telefono ?? '') }}">
                        @error('telefono')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Correo --}}
                    <div class="form-group">
                        <label for="correo">Correo <span class="text-danger">*</span></label>
                        <input type="email"
                               name="correo"
                               id="correo"
                               class="form-control @error('correo') is-invalid @enderror"
                               placeholder="Ej: cliente@correo.com"
                               value="{{ old('correo', $cliente->correo ?? '') }}">
                        @error('correo')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Dirección --}}
                    <div class="form-group">
                        <label for="direccion">Dirección <span class="text-danger">*</span></label>
                        <input type="text"
                               name="direccion"
                               id="direccion"
                               class="form-control @error('direccion') is-invalid @enderror"
                               placeholder="Ej: Calle 10 # 5-23"
                               value="{{ old('direccion', $cliente->direccion ?? '') }}">
                        @error('direccion')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Descripción --}}
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea name="descripcion"
                                  id="descripcion"
                                  rows="3"
                                  class="form-control @error('descripcion') is-invalid @enderror"
                                  placeholder="Descripción del cliente...">{{ old('descripcion', $cliente->descripcion ?? '') }}</textarea>
                        @error('descripcion')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-save"></i>
                        @isset($cliente) Actualizar @else Guardar @endisset
                    </button>
                    <a href="{{ route('admin.cliente.index') }}" class="btn btn-secondary btn-block">
                        <i class="fas fa-undo"></i> Limpiar
                    </a>
                </div>

                </form>
            </div>
        </div>

        {{-- Tabla Listado --}}
        <div class="col-md-8">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-list"></i> Listado de Clientes
                    </h3>
                    <div class="card-tools">
                        <span class="badge badge-primary">Total: {{ $clientes->count() }}</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Dirección</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($clientes as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nombre }}</td>
                                    <td>{{ $item->telefono }}</td>
                                    <td>{{ $item->correo }}</td>
                                    <td>{{ $item->direccion }}</td>
                                    <td>
                                        {{-- Editar --}}
                                        <a href="{{ route('admin.cliente.edit', $item->id) }}"
                                           class="btn btn-warning btn-sm"
                                           title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Eliminar --}}
                                        <form action="{{ route('admin.cliente.destroy', $item->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('¿Estás seguro de eliminar este cliente?')">
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
                                    <td colspan="6" class="text-center text-muted py-3">
                                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                        No hay clientes registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .table thead th { font-size: 0.85rem; }
    </style>
@stop