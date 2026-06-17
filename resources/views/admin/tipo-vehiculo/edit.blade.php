{{-- resources/views/admin/tipo-vehiculo/edit.blade.php --}}

@extends('adminlte::page')

@section('title', 'Editar Tipo de Vehículo')

@section('content_header')
    <h1><i class="fas fa-truck"></i> Editar Tipo de Vehículo</h1>
@stop

@section('content')
    <div class="container-fluid">

        <div class="card card-outline card-warning">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-edit mr-1"></i> Modificar registro</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.tipo-vehiculo.update', $tipoVehiculo) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nombre --}}
                    <div class="form-group">
                        <label for="nombre">Nombre <span class="text-danger">*</span></label>
                        <input type="text" name="nombre" id="nombre"
                            class="form-control @error('nombre') is-invalid @enderror"
                            value="{{ old('nombre', $tipoVehiculo->nombre) }}" placeholder="Ej: Camión 5 Ton"
                            maxlength="100" autocomplete="off"
                             required>
                        @error('nombre')
                            <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                        @enderror
                        <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Letras, números, espacios
                            y tildes. Máx. 100 caracteres.</small>
                    </div>

                    {{-- Descripción --}}
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror"
                            rows="3" maxlength="255" placeholder="Descripción del tipo de vehículo...">{{ old('descripcion', $tipoVehiculo->descripcion) }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                        @enderror
                        <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Opcional. <span
                                id="desc-count-edit">0</span>/255 caracteres.</small>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Actualizar
                        </button>
                        <a href="{{ route('admin.tipo-vehiculo.index') }}" class="btn btn-secondary ml-2">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        // Nombre: letras, números y tildes — limpia si se pega texto
        document.getElementById('nombre').addEventListener('input', function() {
            this.value = this.value.replace(/[^a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s]/g, '');
        });

        // Contador de caracteres descripción
        const descEdit = document.getElementById('descripcion');
        const countEdit = document.getElementById('desc-count-edit');
        countEdit.textContent = descEdit.value.length;
        descEdit.addEventListener('input', function() {
            countEdit.textContent = this.value.length;
        });
    </script>
@endpush
