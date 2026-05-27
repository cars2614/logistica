@extends('adminlte::page')

@section('title', 'Editar Estado de Guía')

@section('content_header')
    <h1>Editar Estado de Guía #{{ $estadoGuia->id }}</h1>
@stop

@section('content')

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
    <div class="card-header bg-warning">
        <h3 class="card-title mb-0 text-dark">
            <i class="fas fa-edit mr-1"></i> Editar Estado de Guía
        </h3>
    </div>

    <form action="{{ route('admin.estado-guia.update', $estadoGuia->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">
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
                                    {{ old('guia_id', $estadoGuia->guia_id) == $guia->id_guias ? 'selected' : '' }}>
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
                               value="{{ old('fecha_estado', \Carbon\Carbon::parse($estadoGuia->fecha_estado)->format('Y-m-d\TH:i')) }}"
                               required>
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
                               value="{{ old('estado', $estadoGuia->estado) }}"
                               maxlength="255"
                               placeholder="Ej: En tránsito, Entregado, Devuelto..."
                               required>
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
                                  required>{{ old('descripcion', $estadoGuia->descripcion) }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.estado-guia.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Volver
            </a>
            <button type="submit" class="btn btn-warning">
                <i class="fas fa-save mr-1"></i> Actualizar
            </button>
        </div>

    </form>
</div>

@stop