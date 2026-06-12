@extends('adminlte::page')

@section('title', 'Editar Guía')

@section('content_header')


    <h1>Editar Guía #{{ $guia->id }}</h1>
@stop

@section('css')
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
@stop

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
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

        <form action="{{ route('admin.guia.update', $guia->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="row">

                    {{-- Número de guía --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id">N° de Guía <span class="text-danger">*</span></label>
                            <input type="number" name="id" id="id"
                                class="form-control @error('id') is-invalid @enderror" value="{{ old('id', $guia->id) }}"
                                required readonly>
                            @error('id')
                                <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>

                    {{-- id_tipo_entrega --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_tipo_entrega">Tipo de Entrega <span class="text-danger">*</span></label>
                            <select name="id_tipo_entrega" id="id_tipo_entrega"
                                class="form-control @error('id_tipo_entrega') is-invalid @enderror" required>
                                <option value="">-- Seleccionar tipo de entrega --</option>
                                @foreach ($tipoEntregas as $tipoEntrega)
                                    <option value="{{ $tipoEntrega->id }}"
                                        {{ old('id_tipo_entrega', $guia->id_tipo_entrega) == $tipoEntrega->id ? 'selected' : '' }}>
                                        {{ $tipoEntrega->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_tipo_entrega')
                                <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>




                    {{-- Repartidor --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_repartidor">Repartidor Asignado</label>
                            <select name="id_repartidor" id="id_repartidor" class="form-control select2 @error('id_repartidor') is-invalid @enderror" style="width: 100%;">
                                <option value="">-- Sin asignar --</option>
                                @foreach ($repartidores as $repartidor)
                                    <option value="{{ $repartidor->id }}"
                                        {{ old('id_repartidor', $guia->id_repartidor) == $repartidor->id ? 'selected' : '' }}>
                                        {{ $repartidor->name }} ({{ $repartidor->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('id_repartidor')
                                <div class="invalid-feedback" style="display:block;"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Deje vacío si no está asignado aún.</small>
                        </div>
                    </div>

                    {{-- Cliente origen --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_cliente_origen">Cliente Origen <span class="text-danger">*</span></label>
                            <select name="id_cliente_origen" id="id_cliente_origen"
                                class="form-control @error('id_cliente_origen') is-invalid @enderror" required>
                                <option value="">-- Seleccionar cliente --</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}"
                                        {{ old('id_cliente_origen', $guia->id_cliente_origen) == $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->cedula }} - {{ $cliente->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_cliente_origen')
                                <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </div>
                            @enderror
                            <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Seleccione el cliente
                                asociado a la guía.</small>
                        </div>
                    </div>

                    {{-- Cliente destino --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_cliente_destino">Cliente Destino <span class="text-danger">*</span></label>
                            <select name="id_cliente_destino" id="id_cliente_destino"
                                class="form-control @error('id_cliente_destino') is-invalid @enderror" required>
                                <option value="">-- Seleccionar cliente --</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}"
                                        {{ old('id_cliente_destino', $guia->id_cliente_destino) == $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->cedula }} - {{ $cliente->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_cliente_destino')
                                <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </div>
                            @enderror
                            <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Seleccione el cliente
                                asociado a la guía.</small>
                        </div>
                    </div>

                    {{-- Unidades --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="unidades">Unidades <span class="text-danger">*</span></label>
                            <input type="number" name="unidades" id="unidades"
                                class="form-control @error('unidades') is-invalid @enderror"
                                value="{{ old('unidades', $guia->unidades) }}" placeholder="Ej: 5" min="1"
                                max="99999" autocomplete="off" onkeypress="return /[0-9]/.test(event.key)" required>
                            @error('unidades')
                                <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </div>
                            @enderror
                            <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Solo enteros
                                positivos. Ej:
                                5</small>
                        </div>
                    </div>



                    {{-- Peso --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="peso">Peso (kg) <span class="text-danger">*</span></label>
                            <input type="number" name="peso" id="peso"
                                class="form-control @error('peso') is-invalid @enderror"
                                value="{{ old('peso', $guia->peso) }}" placeholder="Ej: 10.50" step="0.01"
                                min="0.01" max="99999.99" autocomplete="off" required>
                            @error('peso')
                                <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </div>
                            @enderror
                            <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Número positivo. Ej:
                                10.50</small>
                        </div>
                    </div>

                    {{-- Largo --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="largo">Largo (m) <span class="text-danger">*</span></label>
                            <input type="number" name="largo" id="largo"
                                class="form-control @error('largo') is-invalid @enderror"
                                value="{{ old('largo', $guia->largo) }}" placeholder="Ej: 10.50" step="0.01"
                                min="0.01" max="99999.99" autocomplete="off" required>
                            @error('largo')
                                <div class="invalid-feedback"><i
                                        class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Número positivo.
                                Ej:
                                10.50</small>
                        </div>
                    </div>

                    {{-- Ancho --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ancho">Ancho (m) <span class="text-danger">*</span></label>
                            <input type="number" name="ancho" id="ancho"
                                class="form-control @error('ancho') is-invalid @enderror"
                                value="{{ old('ancho', $guia->ancho) }}" placeholder="Ej: 10.50" step="0.01"
                                min="0.01" max="99999.99" autocomplete="off" required>
                            @error('ancho')
                                <div class="invalid-feedback"><i
                                        class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Número positivo.
                                Ej:
                                10.50</small>
                        </div>
                    </div>

                    {{-- Alto --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="alto">Alto (m) <span class="text-danger">*</span></label>
                            <input type="number" name="alto" id="alto"
                                class="form-control @error('alto') is-invalid @enderror"
                                value="{{ old('alto', $guia->alto) }}" placeholder="Ej: 10.50" step="0.01"
                                min="0.01" max="99999.99" autocomplete="off" required>
                            @error('alto')
                                <div class="invalid-feedback"><i
                                        class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Número positivo.
                                Ej:
                                10.50</small>
                        </div>
                    </div>



                    {{-- Precio Envio --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="precio_envio">Precio Envio <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" name="precio_envio" id="precio_envio"
                                    class="form-control @error('precio_envio') is-invalid @enderror"
                                    value="{{ old('precio_envio', $guia->precio_envio) }}" placeholder="Ej: 25000.00"
                                    step="0.01" min="0.01" max="999999999.99" autocomplete="off" required>
                                @error('precio_envio')
                                    <div class="invalid-feedback"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Valor positivo en
                                pesos.
                                Ej: 9.800.00</small>
                        </div>
                    </div>

                    {{-- Precio Declarado --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="valor_declarado">Valor Declarado <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" name="valor_declarado" id="valor_declarado"
                                    class="form-control @error('valor_declarado') is-invalid @enderror"
                                    value="{{ old('valor_declarado', $guia->valor_declarado) }}"
                                    placeholder="Ej: 25000.00" step="0.01" min="0.01" max="999999999.99"
                                    autocomplete="off" required>
                                @error('valor_declarado')
                                    <div class="invalid-feedback"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Valor positivo en
                                pesos.
                                Ej: 20.000.00</small>
                        </div>
                    </div>

                    {{-- Observación --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="observacion">Observación</label>
                            <input type="text" name="observacion" id="observacion"
                                class="form-control @error('observacion') is-invalid @enderror"
                                value="{{ old('observacion', $guia->observacion) }}"
                                placeholder="Ej: Frágil, manejar con cuidado" maxlength="255" autocomplete="off">
                            @error('observacion')
                                <div class="invalid-feedback"><i
                                        class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Opcional. <span
                                    id="obs-count-edit">0</span>/255 caracteres.</small>
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
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: 'Buscar repartidor por nombre...',
                allowClear: true
            });
        });

        // Fecha de admisión: no permite fechas futuras
        document.getElementById('fecha_admision').setAttribute('max', new Date().toISOString().split('T')[0]);

        // Número de guía: solo enteros positivos
        document.getElementById('num_guias').addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
            if (parseInt(this.value) < 1) this.value = '';
        });

        // Unidades: solo enteros positivos
        document.getElementById('unidades').addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
            if (parseInt(this.value) < 1) this.value = '';
        });

        // Volumen: no permite negativos
        document.getElementById('volumen').addEventListener('input', function() {
            if (parseFloat(this.value) < 0) this.value = '';
        });

        // Peso: no permite negativos
        document.getElementById('peso').addEventListener('input', function() {
            if (parseFloat(this.value) < 0) this.value = '';
        });

        // Precio: no permite negativos
        document.getElementById('precio').addEventListener('input', function() {
            if (parseFloat(this.value) < 0) this.value = '';
        });

        // Contador observación
        const obsEdit = document.getElementById('observacion');
        const obsCountEdit = document.getElementById('obs-count-edit');
        obsCountEdit.textContent = obsEdit.value.length;
        obsEdit.addEventListener('input', function() {
            obsCountEdit.textContent = this.value.length;
        });

        // Auto-cerrar alertas tras 4 segundos
        setTimeout(function() {
            document.querySelectorAll('.alert-dismissible').forEach(function(alert) {
                $(alert).fadeOut('slow');
            });
        }, 4000);
    </script>
@endpush
