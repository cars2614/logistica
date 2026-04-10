@extends('adminlte::page')

@section('title', 'Editar Rol')

@section('content_header')
    <h1><i class="fas fa-user-tag"></i> Editar Rol</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.rol.index') }}">Roles</a></li>
            <li class="breadcrumb-item active">Editar</li>
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

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit"></i> Editar Rol
                    </h3>
                </div>

                <form action="{{ route('admin.rol.update', $rol->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        {{-- Nombre --}}
                        <div class="form-group">
                            <label for="nombre">Nombre <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="nombre"
                                   id="nombre"
                                   class="form-control @error('nombre') is-invalid @enderror"
                                   placeholder="Ej: Administrador"
                                   value="{{ old('nombre', $rol->nombre) }}">
                            @error('nombre')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.rol.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Actualizar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card-warning.card-outline {
            border-top: 3px solid #ffc107;
        }
    </style>
@stop