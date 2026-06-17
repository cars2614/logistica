@extends('adminlte::page')

@section('title', 'Editar Planilla')

@section('content_header')
    <h1>Editar Planilla #{{ $planilla->id }}</h1>
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
            <i class="fas fa-edit mr-1"></i> Editar Planilla
        </h3>
    </div>

    <form id="formEditarPlanilla" action="{{ route('admin.planilla.update', $planilla->id) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="row">

                {{-- Guía --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="guia_id">Guía <span class="text-danger">*</span></label>
                        <select name="guia_id" id="guia_id"
                                class="form-control @error('guia_id') is-invalid @enderror"
                                required>
                            <option value="">-- Seleccionar guía --</option>
                            @foreach($guias as $guia)
                                <option value="{{ $guia->id_guias }}"
                                    {{ old('guia_id', $planilla->guia_id) == $guia->id_guias ? 'selected' : '' }}>
                                    N° {{ $guia->num_guias }}
                                    — {{ $guia->cliente->nombre ?? 'Sin cliente' }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i> Seleccione la guía asociada.
                        </small>
                        @error('guia_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="guia_id_error"></div>
                    </div>
                </div>

                {{-- Ruta --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ruta_id">Ruta <span class="text-danger">*</span></label>
                        <select name="ruta_id" id="ruta_id"
                                class="form-control @error('ruta_id') is-invalid @enderror"
                                required>
                            <option value="">-- Seleccionar ruta --</option>
                            @foreach($rutas as $ruta)
                                <option value="{{ $ruta->id }}"
                                    {{ old('ruta_id', $planilla->ruta_id) == $ruta->id ? 'selected' : '' }}>
                                    {{ $ruta->nombre ?? 'Ruta #' . $ruta->id }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i> Seleccione la ruta de entrega.
                        </small>
                        @error('ruta_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="ruta_id_error"></div>
                    </div>
                </div>

                {{-- Destinatario --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="destinatario">Destinatario <span class="text-danger">*</span></label>
                        <input type="text" name="destinatario" id="destinatario"
                               class="form-control @error('destinatario') is-invalid @enderror"
                               value="{{ old('destinatario', $planilla->destinatario) }}"
                               maxlength="255" required
                               placeholder="Ej: Juan Pérez García">
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i> Solo letras, espacios y tildes. Máx. 255 caracteres.
                        </small>
                        @error('destinatario')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="destinatario_error"></div>
                    </div>
                </div>

                {{-- Dirección --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="direccion">Dirección <span class="text-danger">*</span></label>
                        <input type="text" name="direccion" id="direccion"
                               class="form-control @error('direccion') is-invalid @enderror"
                               value="{{ old('direccion', $planilla->direccion) }}"
                               maxlength="255" required
                               placeholder="Ej: Calle 15 # 20-30">
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i> Dirección completa de entrega. Máx. 255 caracteres.
                        </small>
                        @error('direccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="direccion_error"></div>
                    </div>
                </div>

                {{-- Destino --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="destino">Destino <span class="text-danger">*</span></label>
                        <input type="text" name="destino" id="destino"
                               class="form-control @error('destino') is-invalid @enderror"
                               value="{{ old('destino', $planilla->destino) }}"
                               maxlength="255" required
                               placeholder="Ej: Bogotá">
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i> Ciudad o municipio de destino. Máx. 255 caracteres.
                        </small>
                        @error('destino')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="destino_error"></div>
                    </div>
                </div>

                {{-- Departamento --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="departamento">Departamento <span class="text-danger">*</span></label>
                        <input type="text" name="departamento" id="departamento"
                               class="form-control @error('departamento') is-invalid @enderror"
                               value="{{ old('departamento', $planilla->departamento) }}"
                               maxlength="255" required
                               placeholder="Ej: Cundinamarca">
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i> Solo letras y espacios. Máx. 255 caracteres.
                        </small>
                        @error('departamento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="departamento_error"></div>
                    </div>
                </div>

                {{-- Entidad --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="entidad">Entidad <span class="text-danger">*</span></label>
                        <input type="text" name="entidad" id="entidad"
                               class="form-control @error('entidad') is-invalid @enderror"
                               value="{{ old('entidad', $planilla->entidad) }}"
                               maxlength="255" required
                               placeholder="Ej: Empresa XYZ S.A.S">
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i> Nombre de la entidad o empresa. Máx. 255 caracteres.
                        </small>
                        @error('entidad')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="entidad_error"></div>
                    </div>
                </div>

                {{-- Servicio --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="servicio">Servicio <span class="text-danger">*</span></label>
                        <input type="text" name="servicio" id="servicio"
                               class="form-control @error('servicio') is-invalid @enderror"
                               value="{{ old('servicio', $planilla->servicio) }}"
                               maxlength="255" required
                               placeholder="Ej: Entrega express">
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i> Tipo de servicio prestado. Máx. 255 caracteres.
                        </small>
                        @error('servicio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="servicio_error"></div>
                    </div>
                </div>

                {{-- Piezas --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="piezas">Piezas <span class="text-danger">*</span></label>
                        <input type="number" name="piezas" id="piezas"
                               class="form-control @error('piezas') is-invalid @enderror"
                               value="{{ old('piezas', $planilla->piezas) }}"
                               min="1" required
                               placeholder="Ej: 5">
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i> Cantidad de piezas. Mínimo 1.
                        </small>
                        @error('piezas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="piezas_error"></div>
                    </div>
                </div>

                {{-- Kilos --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="kilos">Kilos <span class="text-danger">*</span></label>
                        <input type="number" name="kilos" id="kilos"
                               class="form-control @error('kilos') is-invalid @enderror"
                               value="{{ old('kilos', $planilla->kilos) }}"
                               step="0.01" min="0.01" required
                               placeholder="Ej: 2.50">
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i> Peso en kilogramos. Mínimo 0.01.
                        </small>
                        @error('kilos')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="kilos_error"></div>
                    </div>
                </div>

                {{-- Operador --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="opedor">Operador <span class="text-danger">*</span></label>
                        <input type="text" name="opedor" id="opedor"
                               class="form-control @error('opedor') is-invalid @enderror"
                               value="{{ old('opedor', $planilla->opedor) }}"
                               maxlength="255" required
                               placeholder="Ej: Carlos López">
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i> Nombre del operador responsable.
                        </small>
                        @error('opedor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="opedor_error"></div>
                    </div>
                </div>

                {{-- Comentario --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="comentario">Comentario <span class="text-danger">*</span></label>
                        <textarea name="comentario" id="comentario" rows="2"
                                  class="form-control @error('comentario') is-invalid @enderror"
                                  maxlength="255" required
                                  placeholder="Ej: Entregar en horario de oficina">{{ old('comentario', $planilla->comentario) }}</textarea>
                        <small class="form-text text-muted d-flex justify-content-between">
                            <span><i class="fas fa-info-circle"></i> Opcional. <span id="comentario_count">0</span>/255 caracteres.</span>
                        </small>
                        @error('comentario')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="comentario_error"></div>
                    </div>
                </div>

            </div>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.planilla.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Volver
            </a>
            <button type="submit" class="btn btn-warning" id="btnActualizarPlanilla">
                <i class="fas fa-save mr-1"></i> Actualizar
            </button>
        </div>

    </form>
</div>

@stop

@section('js')
<script>
    $(document).ready(function () {

        /* ── Inicializar contador con valor actual ── */
        const comentarioActual = $('#comentario').val().length;
        $('#comentario_count').text(comentarioActual);

        $('#comentario').on('input', function () {
            $('#comentario_count').text($(this).val().length);
        });

        /* ── Funciones de validación ── */
        const regexTexto   = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/;
        const regexGeneral = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ0-9\s\.\,\-\#\/]+$/;

        function validarCampo(campo, errorId, regex, msg) {
            const val = $(campo).val().trim();
            if (!val) {
                $(campo).addClass('is-invalid').removeClass('is-valid');
                $(errorId).text('Este campo es obligatorio.');
            } else if (regex && !regex.test(val)) {
                $(campo).addClass('is-invalid').removeClass('is-valid');
                $(errorId).text(msg);
            } else {
                $(campo).addClass('is-valid').removeClass('is-invalid');
                $(errorId).text('');
            }
        }

        function validarSelect(campo, errorId) {
            if (!$(campo).val()) {
                $(campo).addClass('is-invalid').removeClass('is-valid');
                $(errorId).text('Debe seleccionar una opción.');
            } else {
                $(campo).addClass('is-valid').removeClass('is-invalid');
                $(errorId).text('');
            }
        }

        function validarNumero(campo, errorId, min) {
            const val = parseFloat($(campo).val());
            if ($(campo).val() === '' || isNaN(val)) {
                $(campo).addClass('is-invalid').removeClass('is-valid');
                $(errorId).text('Este campo es obligatorio.');
            } else if (val < min) {
                $(campo).addClass('is-invalid').removeClass('is-valid');
                $(errorId).text('El valor mínimo es ' + min + '.');
            } else {
                $(campo).addClass('is-valid').removeClass('is-invalid');
                $(errorId).text('');
            }
        }

        /* ── Bindings en tiempo real ── */
        $('#guia_id').on('change',      () => validarSelect('#guia_id',      '#guia_id_error'));
        $('#ruta_id').on('change',      () => validarSelect('#ruta_id',      '#ruta_id_error'));
        $('#destinatario').on('input',  () => validarCampo('#destinatario',  '#destinatario_error',  regexTexto,   'Solo se permiten letras, espacios y tildes.'));
        $('#direccion').on('input',     () => validarCampo('#direccion',     '#direccion_error',     regexGeneral, 'Dirección contiene caracteres no válidos.'));
        $('#destino').on('input',       () => validarCampo('#destino',       '#destino_error',       regexTexto,   'Solo se permiten letras, espacios y tildes.'));
        $('#departamento').on('input',  () => validarCampo('#departamento',  '#departamento_error',  regexTexto,   'Solo se permiten letras, espacios y tildes.'));
        $('#entidad').on('input',       () => validarCampo('#entidad',       '#entidad_error',       regexGeneral, 'Entidad contiene caracteres no válidos.'));
        $('#servicio').on('input',      () => validarCampo('#servicio',      '#servicio_error',      regexGeneral, 'Servicio contiene caracteres no válidos.'));
        $('#piezas').on('input',        () => validarNumero('#piezas',       '#piezas_error',        1));
        $('#kilos').on('input',         () => validarNumero('#kilos',        '#kilos_error',         0.01));
        $('#opedor').on('input',        () => validarCampo('#opedor',        '#opedor_error',        regexTexto,   'Solo se permiten letras, espacios y tildes.'));
        $('#comentario').on('input',    () => validarCampo('#comentario',    '#comentario_error',    null,         ''));

        /* ── Validación al enviar ── */
        $('#formEditarPlanilla').on('submit', function (e) {
            validarSelect('#guia_id',      '#guia_id_error');
            validarSelect('#ruta_id',      '#ruta_id_error');
            validarCampo('#destinatario',  '#destinatario_error',  regexTexto,   'Solo se permiten letras, espacios y tildes.');
            validarCampo('#direccion',     '#direccion_error',     regexGeneral, 'Dirección contiene caracteres no válidos.');
            validarCampo('#destino',       '#destino_error',       regexTexto,   'Solo se permiten letras, espacios y tildes.');
            validarCampo('#departamento',  '#departamento_error',  regexTexto,   'Solo se permiten letras, espacios y tildes.');
            validarCampo('#entidad',       '#entidad_error',       regexGeneral, 'Entidad contiene caracteres no válidos.');
            validarCampo('#servicio',      '#servicio_error',      regexGeneral, 'Servicio contiene caracteres no válidos.');
            validarNumero('#piezas',       '#piezas_error',        1);
            validarNumero('#kilos',        '#kilos_error',         0.01);
            validarCampo('#opedor',        '#opedor_error',        regexTexto,   'Solo se permiten letras, espacios y tildes.');
            validarCampo('#comentario',    '#comentario_error',    null,         '');

            if ($('#formEditarPlanilla .is-invalid').length > 0) {
                e.preventDefault();
                $('#formEditarPlanilla .is-invalid').first().focus();
            }
        });

    });
</script>
@stop