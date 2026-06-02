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
                            <input
                                type="text"
                                name="nombre"
                                id="nombre"
                                class="form-control @error('nombre') is-invalid @enderror"
                                placeholder="Ej: Juan Pérez"
                                value="{{ old('nombre', $cliente->nombre) }}"
                                maxlength="100"
                                autocomplete="off"
                                onkeypress="return /[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]/.test(event.key)"
                            >
                            @error('nombre')
                                <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Solo letras, espacios y tildes. Máx. 100 caracteres.</small>
                        </div>

                        {{-- Teléfono --}}
                        <div class="form-group">
                            <label for="telefono">Teléfono <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                name="telefono"
                                id="telefono"
                                class="form-control @error('telefono') is-invalid @enderror"
                                placeholder="Ej: 3001234567"
                                value="{{ old('telefono', $cliente->telefono) }}"
                                maxlength="15"
                                autocomplete="off"
                                onkeypress="return /[0-9]/.test(event.key)"
                            >
                            @error('telefono')
                                <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Solo números. Entre 7 y 15 dígitos.</small>
                        </div>

                        {{-- Correo --}}
                        <div class="form-group">
                            <label for="correo">Correo <span class="text-danger">*</span></label>
                            <input
                                type="email"
                                name="correo"
                                id="correo"
                                class="form-control @error('correo') is-invalid @enderror"
                                placeholder="Ej: cliente@correo.com"
                                value="{{ old('correo', $cliente->correo) }}"
                                maxlength="150"
                                autocomplete="off"
                            >
                            @error('correo')
                                <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Ingrese un correo válido. Ej: nombre@dominio.com</small>
                        </div>

                        {{-- Dirección --}}
                        <div class="form-group">
                            <label for="direccion">Dirección <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                name="direccion"
                                id="direccion"
                                class="form-control @error('direccion') is-invalid @enderror"
                                placeholder="Ej: Calle 10 # 5-23"
                                value="{{ old('direccion', $cliente->direccion) }}"
                                maxlength="200"
                                autocomplete="off"
                                onkeypress="return /[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s#\-\.]/.test(event.key)"
                            >
                            @error('direccion')
                                <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Letras, números, espacios, #, - y puntos. Máx. 200 caracteres.</small>
                        </div>

                        {{-- Descripción --}}
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea
                                name="descripcion"
                                id="descripcion"
                                rows="4"
                                class="form-control @error('descripcion') is-invalid @enderror"
                                placeholder="Descripción del cliente..."
                                maxlength="500"
                            >{{ old('descripcion', $cliente->descripcion) }}</textarea>
                            @error('descripcion')
                                <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Opcional. Máx. 500 caracteres. <span id="desc-count-edit">0</span>/500</small>
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
@endsection

@push('js')
<script>
    // Nombre: solo letras
    document.getElementById('nombre').addEventListener('input', function () {
        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]/g, '');
    });

    // Teléfono: solo números
    document.getElementById('telefono').addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '');
    });

    // Correo: validación visual al salir del campo
    document.getElementById('correo').addEventListener('blur', function () {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (this.value && !regex.test(this.value)) {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
        } else if (this.value) {
            this.classList.remove('is-invalid');
            this.classList.add('is-valid');
        }
    });

    // Dirección: filtra caracteres no permitidos al pegar
    document.getElementById('direccion').addEventListener('input', function () {
        this.value = this.value.replace(/[^a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s#\-\.]/g, '');
    });

    // Contador de caracteres descripción
    const descEdit = document.getElementById('descripcion');
    const countEdit = document.getElementById('desc-count-edit');
    countEdit.textContent = descEdit.value.length;
    descEdit.addEventListener('input', function () {
        countEdit.textContent = this.value.length;
    });
</script>
@endpush
