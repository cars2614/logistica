@extends('adminlte::page')

@section('title', 'Editar Guía')

@section('content_header')
    <h1>Editar Guía #{{ $guia->num_guias }}</h1>
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
            <i class="fas fa-edit mr-1"></i> Editar Guía
        </h3>
    </div>

    <form action="{{ route('admin.guia.update', $guia->id_guias) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="row">

                {{-- Número de guía --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="num_guias">N° de Guía <span class="text-danger">*</span></label>
                        <input
                            type="number"
                            name="num_guias"
                            id="num_guias"
                            class="form-control @error('num_guias') is-invalid @enderror"
                            value="{{ old('num_guias', $guia->num_guias) }}"
                            placeholder="Ej: 1001"
                            min="1"
                            max="9999999"
                            autocomplete="off"
                            onkeypress="return /[0-9]/.test(event.key)"
                            required
                        >
                        @error('num_guias')
                            <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Solo números enteros positivos.</small>
                    </div>
                </div>

                {{-- Fecha de admisión --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha_admision">Fecha de Admisión <span class="text-danger">*</span></label>
                        <input
                            type="date"
                            name="fecha_admision"
                            id="fecha_admision"
                            class="form-control @error('fecha_admision') is-invalid @enderror"
                            value="{{ old('fecha_admision', \Carbon\Carbon::parse($guia->fecha_admision)->format('Y-m-d')) }}"
                            required
                        >
                        @error('fecha_admision')
                            <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>No puede ser una fecha futura.</small>
                    </div>
                </div>

                {{-- Cliente --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cliente_id">Cliente <span class="text-danger">*</span></label>
                        <select
                            name="cliente_id"
                            id="cliente_id"
                            class="form-control @error('cliente_id') is-invalid @enderror"
                            required
                        >
                            <option value="">-- Seleccionar cliente --</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}"
                                    {{ old('cliente_id', $guia->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('cliente_id')
                            <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Seleccione el cliente asociado a la guía.</small>
                    </div>
                </div>

                {{-- Tipo de Entrega --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipo_entrega_id">Tipo de Entrega <span class="text-danger">*</span></label>
                        <select
                            name="tipo_entrega_id"
                            id="tipo_entrega_id"
                            class="form-control @error('tipo_entrega_id') is-invalid @enderror"
                            required
                        >
                            <option value="">-- Seleccionar tipo --</option>
                            @foreach($tipoEntregas as $tipo)
                                <option value="{{ $tipo->id }}"
                                    {{ old('tipo_entrega_id', $guia->tipo_entrega_id) == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipo_entrega_id')
                            <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Seleccione el tipo de entrega.</small>
                    </div>
                </div>

                {{-- Volumen --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="volumen">Volumen (m³) <span class="text-danger">*</span></label>
                        <input
                            type="number"
                            name="volumen"
                            id="volumen"
                            class="form-control @error('volumen') is-invalid @enderror"
                            value="{{ old('volumen', $guia->volumen) }}"
                            placeholder="Ej: 1.50"
                            step="0.01"
                            min="0.01"
                            max="99999.99"
                            autocomplete="off"
                            required
                        >
                        @error('volumen')
                            <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Número positivo. Ej: 1.50</small>
                    </div>
                </div>

                {{-- Peso --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="peso">Peso (kg) <span class="text-danger">*</span></label>
                        <input
                            type="number"
                            name="peso"
                            id="peso"
                            class="form-control @error('peso') is-invalid @enderror"
                            value="{{ old('peso', $guia->peso) }}"
                            placeholder="Ej: 10.50"
                            step="0.01"
                            min="0.01"
                            max="99999.99"
                            autocomplete="off"
                            required
                        >
                        @error('peso')
                            <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Número positivo. Ej: 10.50</small>
                    </div>
                </div>

                {{-- Unidades --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="unidades">Unidades <span class="text-danger">*</span></label>
                        <input
                            type="number"
                            name="unidades"
                            id="unidades"
                            class="form-control @error('unidades') is-invalid @enderror"
                            value="{{ old('unidades', $guia->unidades) }}"
                            placeholder="Ej: 5"
                            min="1"
                            max="99999"
                            autocomplete="off"
                            onkeypress="return /[0-9]/.test(event.key)"
                            required
                        >
                        @error('unidades')
                            <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Solo enteros positivos. Ej: 5</small>
                    </div>
                </div>

                {{-- Precio --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="precio">Precio <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input
                                type="number"
                                name="precio"
                                id="precio"
                                class="form-control @error('precio') is-invalid @enderror"
                                value="{{ old('precio', $guia->precio) }}"
                                placeholder="Ej: 25000.00"
                                step="0.01"
                                min="0.01"
                                max="999999999.99"
                                autocomplete="off"
                                required
                            >
                            @error('precio')
                                <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Valor positivo en pesos. Ej: 25000.00</small>
                    </div>
                </div>

                {{-- Observación --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="observacion">Observación</label>
                        <input
                            type="text"
                            name="observacion"
                            id="observacion"
                            class="form-control @error('observacion') is-invalid @enderror"
                            value="{{ old('observacion', $guia->observacion) }}"
                            placeholder="Ej: Frágil, manejar con cuidado"
                            maxlength="255"
                            autocomplete="off"
                        >
                        @error('observacion')
                            <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Opcional. <span id="obs-count-edit">0</span>/255 caracteres.</small>
                    </div>
                </div>

            </div>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.guia.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Volver
            </a>
            <button type="submit" class="btn btn-warning">
                <i class="fas fa-save mr-1"></i> Actualizar
            </button>
        </div>

    </form>
</div>

@stop

@push('js')
<script>
    // Fecha de admisión: no permite fechas futuras
    document.getElementById('fecha_admision').setAttribute('max', new Date().toISOString().split('T')[0]);

    // Número de guía: solo enteros positivos
    document.getElementById('num_guias').addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '');
        if (parseInt(this.value) < 1) this.value = '';
    });

    // Unidades: solo enteros positivos
    document.getElementById('unidades').addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '');
        if (parseInt(this.value) < 1) this.value = '';
    });

    // Volumen: no permite negativos
    document.getElementById('volumen').addEventListener('input', function () {
        if (parseFloat(this.value) < 0) this.value = '';
    });

    // Peso: no permite negativos
    document.getElementById('peso').addEventListener('input', function () {
        if (parseFloat(this.value) < 0) this.value = '';
    });

    // Precio: no permite negativos
    document.getElementById('precio').addEventListener('input', function () {
        if (parseFloat(this.value) < 0) this.value = '';
    });

    // Contador observación
    const obsEdit = document.getElementById('observacion');
    const obsCountEdit = document.getElementById('obs-count-edit');
    obsCountEdit.textContent = obsEdit.value.length;
    obsEdit.addEventListener('input', function () {
        obsCountEdit.textContent = this.value.length;
    });

    // Auto-cerrar alertas tras 4 segundos
    setTimeout(function () {
        document.querySelectorAll('.alert-dismissible').forEach(function (alert) {
            $(alert).fadeOut('slow');
        });
    }, 4000);
</script>
@endpush