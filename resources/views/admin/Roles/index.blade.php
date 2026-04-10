@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1><i class="fas fa-shield-alt"></i> Roles</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Roles</li>
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
        {{-- Formulario Crear --}}
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-plus-circle"></i> Nuevo Rol
                    </h3>
                </div>

                <form action="{{ route('admin.rol.store') }}" method="POST">
                    @csrf

                    <div class="card-body">

                        {{-- Nombre del Rol - Corregido a nombreRol --}}
                        <div class="form-group">
                            <label for="nombreRol">Nombre <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="nombreRol" 
                                   id="nombreRol" 
                                   class="form-control @error('nombreRol') is-invalid @enderror" 
                                   placeholder="Ej: Administrador" 
                                   value="{{ old('nombreRol') }}">
                            @error('nombreRol')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save"></i> Guardar
                        </button>
                        <a href="{{ route('admin.rol.index') }}" class="btn btn-secondary btn-block">
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
                        <i class="fas fa-list"></i> Listado de Roles
                    </h3>
                    <div class="card-tools">
                        <span class="badge badge-primary">Total: {{ $roles->count() }}</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $index => $rol)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    {{-- Corregido para mostrar nombreRol --}}
                                    <td>{{ $rol->nombreRol }}</td> 
                                    <td>
                                        {{-- Editar --}}
                                        <a href="{{ route('admin.rol.edit', $rol->id) }}" 
                                           class="btn btn-warning btn-sm" 
                                           title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Eliminar --}}
                                        <form action="{{ route('admin.rol.destroy', $rol->id) }}" 
                                              method="POST" 
                                              class="d-inline" 
                                              onsubmit="return confirm('¿Estás seguro de eliminar este rol?')">
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
                                    <td colspan="3" class="text-center text-muted py-3">
                                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                        No hay roles registrados.
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