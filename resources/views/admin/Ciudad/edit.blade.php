@extends('adminlte::page')

@section('title', 'Editar Ciudad')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-city mr-2"></i> Editar Ciudad</h1>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('ciudad.index') }}">Ciudades</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
    </div>
@stop

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit mr-1"></i> Editar Ciudad
                    </h3>
                </div>

                <form action="{{ route('ciudad.update', $ciudad) }}" method="POST">
                    @csrf
                    @method('PUT')

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
                                placeholder="Ej: Bogotá"
                                class="form-control @error('nombre') is-invalid @enderror"
                                value="{{ old('nombre', $ciudad->nombre) }}"
                                maxlength="255"
                                autocomplete="off"
                            >
                            @error('nombre')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Código Postal --}}
                        <div class="form-group">
                            <label for="codigo_postal">
                                Código Postal <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                id="codigo_postal"
                                name="codigo_postal"
                                placeholder="Ej: 110111"
                                class="form-control @error('codigo_postal') is-invalid @enderror"
                                value="{{ old('codigo_postal', $ciudad->codigo_postal) }}"
                                maxlength="20"
                                autocomplete="off"
                            >
                            @error('codigo_postal')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save mr-1"></i> Actualizar
                        </button>
                        <a href="{{ route('ciudad.index') }}" class="btn btn-secondary ml-2">
                            <i class="fas fa-arrow-left mr-1"></i> Cancelar
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>

@stop
