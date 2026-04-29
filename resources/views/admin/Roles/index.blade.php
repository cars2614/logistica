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

                        {{-- Nombre del Rol - Selección por botones --}}
                        <div class="form-group">
                            <label>Nombre <span class="text-danger">*</span></label>
                            <input type="hidden" name="nombreRol" id="nombreRol" value="{{ old('nombreRol') }}">

                            <div class="d-flex flex-wrap" id="roles-botones">
                                @foreach([
                                    ['valor' => 'Administrador', 'icono' => 'fas fa-user-shield'],
                                    ['valor' => 'Repartidor',    'icono' => 'fas fa-motorcycle'],
                                    ['valor' => 'Cliente',       'icono' => 'fas fa-user'],
                                ] as $opcion)
                                    <button type="button"
                                        class="btn btn-rol mr-2 mb-2 {{ old('nombreRol') === $opcion['valor'] ? 'active' : '' }}"
                                        data-valor="{{ $opcion['valor'] }}"
                                        onclick="seleccionarRol(this)">
                                        <i class="{{ $opcion['icono'] }} mr-1"></i>
                                        {{ $opcion['valor'] }}
                                    </button>
                                @endforeach
                            </div>

                            @error('nombreRol')
                                <span class="text-danger small d-block mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save"></i> Guardar
                        </button>
                        <a href="{{ route('admin.rol.index') }}" class="btn btn-secondary btn-block mt-2">
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

        .btn-rol {
            border: 2px solid #007bff;
            color: #007bff;
            background-color: white;
            border-radius: 20px;
            padding: 8px 18px;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .btn-rol:hover {
            background-color: #e7f1ff;
        }

        .btn-rol.active {
            background-color: #007bff;
            color: white;
        }

        .btn-rol.active i {
            color: white;
        }
    </style>
@stop

@section('js')
    <script>
        function seleccionarRol(boton) {
            document.querySelectorAll('.btn-rol').forEach(b => b.classList.remove('active'));
            boton.classList.add('active');
            document.getElementById('nombreRol').value = boton.dataset.valor;
        }

        document.addEventListener('DOMContentLoaded', function () {
            const valorActual = document.getElementById('nombreRol').value;
            if (valorActual) {
                document.querySelectorAll('.btn-rol').forEach(function (b) {
                    if (b.dataset.valor === valorActual) {
                        b.classList.add('active');
                    }
                });
            }
        });
    </script>
@stop
