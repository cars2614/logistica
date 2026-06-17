{{-- resources/views/admin/vehiculo/edit.blade.php --}}

@extends('adminlte::page')

@section('title', 'Editar Vehículo')

@section('content_header')
    <h1><i class="fas fa-car"></i> Editar Vehículo</h1>
@stop

@section('content')
    <div class="container-fluid">

        <div class="card card-outline card-warning">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-edit"></i> Modificar registro</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.vehiculo.update', $vehiculo) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        {{-- Placa --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="placa">Placa <span class="text-danger">*</span></label>
                                <input type="text" name="placa" id="placa"
                                    class="form-control @error('placa') is-invalid @enderror"
                                    value="{{ old('placa', $vehiculo->placa) }}" placeholder="Ej: ABC-123" maxlength="10"
                                    autocomplete="off" onkeypress="return /[a-zA-Z0-9\-]/.test(event.key)"
                                    style="text-transform: uppercase;" required>
                                @error('placa')
                                    <div class="invalid-feedback"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Letras, números y
                                    guión. Ej: ABC-123. Máx. 10 caracteres.</small>
                            </div>
                        </div>

                        {{-- Tipo de Vehículo --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_tipo_vehiculo">Tipo de Vehículo <span class="text-danger">*</span></label>
                                <select name="id_tipo_vehiculo" id="id_tipo_vehiculo"
                                    class="form-control @error('id_tipo_vehiculo') is-invalid @enderror" required>
                                    <option value="">-- Seleccione --</option>
                                    @foreach ($tipoVehiculos as $tipo)
                                        <option value="{{ $tipo->id }}"
                                            {{ old('id_tipo_vehiculo', $vehiculo->id_tipo_vehiculo) == $tipo->id ? 'selected' : '' }}>
                                            {{ $tipo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tipo_vehiculo_id')
                                    <div class="invalid-feedback"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Seleccione el
                                    tipo de vehículo.</small>
                            </div>
                        </div>

                        {{-- Marca --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="marca">Marca <span class="text-danger">*</span></label>
                                <input type="text" name="marca" id="marca"
                                    class="form-control @error('marca') is-invalid @enderror"
                                    value="{{ old('marca', $vehiculo->marca) }}" placeholder="Ej: Chevrolet" maxlength="100"
                                    autocomplete="off" onkeypress="return /[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]/.test(event.key)"
                                    required>
                                @error('marca')
                                    <div class="invalid-feedback"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Solo letras,
                                    espacios y tildes. Máx. 100 caracteres.</small>
                            </div>
                        </div>

                        {{-- Modelo --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modelo">Modelo <span class="text-danger">*</span></label>
                                <input type="text" name="modelo" id="modelo"
                                    class="form-control @error('modelo') is-invalid @enderror"
                                    value="{{ old('modelo', $vehiculo->modelo) }}" placeholder="Ej: NHR 2022"
                                    maxlength="100" autocomplete="off"
                                    onkeypress="return /[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s]/.test(event.key)" required>
                                @error('modelo')
                                    <div class="invalid-feedback"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Letras y números.
                                    Ej: NHR 2022. Máx. 100 caracteres.</small>
                            </div>
                        </div>

                        {{-- Capacidad --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="capacidad">Capacidad (kg) <span class="text-danger">*</span></label>
                                <input type="number" name="capacidad" id="capacidad"
                                    class="form-control @error('capacidad') is-invalid @enderror"
                                    value="{{ old('capacidad', $vehiculo->capacidad) }}" placeholder="Ej: 5000"
                                    min="1" max="999999" autocomplete="off"
                                    onkeypress="return /[0-9]/.test(event.key)" required>
                                @error('capacidad')
                                    <div class="invalid-feedback"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Solo números
                                    enteros positivos. Ej: 5000.</small>
                            </div>
                        </div>

                        {{-- Estado --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estado">Estado <span class="text-danger">*</span></label>
                                <select name="estado" id="estado"
                                    class="form-control @error('estado') is-invalid @enderror" required>
                                    <option value="">-- Seleccione --</option>
                                    <option value="activo"
                                        {{ old('estado', $vehiculo->estado) === 'activo' ? 'selected' : '' }}>Activo
                                    </option>
                                    <option value="inactivo"
                                        {{ old('estado', $vehiculo->estado) === 'inactivo' ? 'selected' : '' }}>
                                        Inactivo</option>
                                    <option value="mantenimiento"
                                        {{ old('estado', $vehiculo->estado) === 'mantenimiento' ? 'selected' : '' }}>
                                        Mantenimiento</option>
                                </select>
                                @error('estado')
                                    <div class="invalid-feedback"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Seleccione el
                                    estado actual del vehículo.</small>
                            </div>
                        </div>

                        {{-- Fecha de Registro --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_registro">Fecha de Registro <span class="text-danger">*</span></label>
                                <input type="date" name="fecha_registro" id="fecha_registro"
                                    class="form-control @error('fecha_registro') is-invalid @enderror"
                                    value="{{ old('fecha_registro', \Carbon\Carbon::parse($vehiculo->fecha_registro)->format('Y-m-d')) }}"
                                    required>
                                @error('fecha_registro')
                                    <div class="invalid-feedback"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>No puede ser
                                    una fecha futura.</small>
                            </div>
                        </div>

                    </div>

                    <div class="d-flex gap-2 mt-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Actualizar
                        </button>
                        <a href="{{ route('admin.vehiculo.index') }}" class="btn btn-secondary ml-2">
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
        // Placa: mayúsculas automáticas y limpia caracteres no permitidos al pegar
        document.getElementById('placa').addEventListener('input', function() {
            this.value = this.value.toUpperCase().replace(/[^A-Z0-9\-]/g, '');
        });

        // Marca: solo letras y tildes
        document.getElementById('marca').addEventListener('input', function() {
            this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]/g, '');
        });

        // Modelo: letras y números
        document.getElementById('modelo').addEventListener('input', function() {
            this.value = this.value.replace(/[^a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s]/g, '');
        });

        // Capacidad: solo enteros positivos
        document.getElementById('capacidad').addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
            if (parseInt(this.value) < 1) this.value = '';
        });

        // Fecha: no permite fechas futuras
        const fechaEdit = document.getElementById('fecha_registro');
        fechaEdit.setAttribute('max', new Date().toISOString().split('T')[0]);
    </script>
@endpush
