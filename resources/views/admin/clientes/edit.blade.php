@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content_header')
    <h1><i class="fas fa-user-edit"></i> Editar Cliente</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.cliente.index') }}">Clientes</a></li>
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
        <div class="col-md-7">
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit"></i> Editar Cliente
                    </h3>
                </div>

                <form action="{{ route('admin.cliente.update', $cliente->id) }}" method="POST">
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
                                   placeholder="Ej: Juan Pérez"
                                   value="{{ old('nombre', $cliente->nombre) }}">
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
                                   value="{{ old('telefono', $cliente->telefono) }}">
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
                                   value="{{ old('correo', $cliente->correo) }}">
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
                                   value="{{ old('direccion', $cliente->direccion) }}">
                            @error('direccion')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Descripción --}}
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion"
                                      id="descripcion"
                                      rows="4"
                                      class="form-control @error('descripcion') is-invalid @enderror"
                                      placeholder="Descripción del cliente...">{{ old('descripcion', $cliente->descripcion) }}</textarea>
                            @error('descripcion')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.cliente.index') }}" class="btn btn-secondary">
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
