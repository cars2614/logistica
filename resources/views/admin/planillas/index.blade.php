@extends('adminlte::page')

@section('title', 'Planillas')

@section('content_header')
    <h1>Gestión de Planillas</h1>
@stop

@section('content')

{{-- Alertas --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

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
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Listado de Planillas</h3>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCrear">
            <i class="fas fa-plus mr-1"></i> Nueva Planilla
        </button>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Guía N°</th>
                        <th>Ruta</th>
                        <th>Destinatario</th>
                        <th>Dirección</th>
                        <th>Destino</th>
                        <th>Departamento</th>
                        <th>Entidad</th>
                        <th>Servicio</th>
                        <th>Piezas</th>
                        <th>Kilos</th>
                        <th>Operador</th>
                        <th>Comentario</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($planillas as $planilla)
                        <tr>
                            <td>{{ $planilla->id }}</td>
                            <td>
                                @if($planilla->guia)
                                    <span class="badge badge-info">{{ $planilla->guia->num_guias }}</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>{{ $planilla->ruta->nombre ?? $planilla->ruta->id ?? '—' }}</td>
                            <td>{{ $planilla->destinatario }}</td>
                            <td>{{ $planilla->direccion }}</td>
                            <td>{{ $planilla->destino }}</td>
                            <td>{{ $planilla->departamento }}</td>
                            <td>{{ $planilla->entidad }}</td>
                            <td>{{ $planilla->servicio }}</td>
                            <td>{{ $planilla->piezas }}</td>
                            <td>{{ number_format($planilla->kilos, 2) }}</td>
                            <td>{{ $planilla->opedor }}</td>
                            <td>{{ $planilla->comentario }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.planilla.edit', $planilla->id) }}"
                                   class="btn btn-warning btn-xs" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.planilla.destroy', $planilla->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Eliminar esta planilla?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="14" class="text-center text-muted py-3">
                                No hay planillas registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($planillas->hasPages())
        <div class="card-footer">
            {{ $planillas->links() }}
        </div>
    @endif
</div>

{{-- Modal Crear Planilla --}}
<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog"
     aria-labelledby="modalCrearLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalCrearLabel">
                    <i class="fas fa-plus-circle mr-1"></i> Nueva Planilla
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form id="formCrearPlanilla" action="{{ route('admin.planilla.store') }}" method="POST" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="row">

                        {{-- Guía --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="crear_guia_id">Guía <span class="text-danger">*</span></label>
                                <select name="guia_id" id="crear_guia_id"
                                        class="form-control @error('guia_id') is-invalid @enderror"
                                        required>
                                    <option value="">-- Seleccionar guía --</option>
                                    @foreach($guias as $guia)
                                        <option value="{{ $guia->id_guias }}"
                                            {{ old('guia_id') == $guia->id_guias ? 'selected' : '' }}>
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
                                <div class="invalid-feedback" id="crear_guia_id_error"></div>
                            </div>
                        </div>

                        {{-- Ruta --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="crear_ruta_id">Ruta <span class="text-danger">*</span></label>
                                <select name="ruta_id" id="crear_ruta_id"
                                        class="form-control @error('ruta_id') is-invalid @enderror"
                                        required>
                                    <option value="">-- Seleccionar ruta --</option>
                                    @foreach($rutas as $ruta)
                                        <option value="{{ $ruta->id }}"
                                            {{ old('ruta_id') == $ruta->id ? 'selected' : '' }}>
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
                                <div class="invalid-feedback" id="crear_ruta_id_error"></div>
                            </div>
                        </div>

                        {{-- Destinatario --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="crear_destinatario">Destinatario <span class="text-danger">*</span></label>
                                <input type="text" name="destinatario" id="crear_destinatario"
                                       class="form-control @error('destinatario') is-invalid @enderror"
                                       value="{{ old('destinatario') }}" maxlength="255" required
                                       placeholder="Ej: Juan Pérez García">
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle"></i> Solo letras, espacios y tildes. Máx. 255 caracteres.
                                </small>
                                @error('destinatario')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback" id="crear_destinatario_error"></div>
                            </div>
                        </div>

                        {{-- Dirección --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="crear_direccion">Dirección <span class="text-danger">*</span></label>
                                <input type="text" name="direccion" id="crear_direccion"
                                       class="form-control @error('direccion') is-invalid @enderror"
                                       value="{{ old('direccion') }}" maxlength="255" required
                                       placeholder="Ej: Calle 15 # 20-30">
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle"></i> Dirección completa de entrega. Máx. 255 caracteres.
                                </small>
                                @error('direccion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback" id="crear_direccion_error"></div>
                            </div>
                        </div>

                        {{-- Destino --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="crear_destino">Destino <span class="text-danger">*</span></label>
                                <input type="text" name="destino" id="crear_destino"
                                       class="form-control @error('destino') is-invalid @enderror"
                                       value="{{ old('destino') }}" maxlength="255" required
                                       placeholder="Ej: Bogotá">
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle"></i> Ciudad o municipio de destino. Máx. 255 caracteres.
                                </small>
                                @error('destino')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback" id="crear_destino_error"></div>
                            </div>
                        </div>

                        {{-- Departamento --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="crear_departamento">Departamento <span class="text-danger">*</span></label>
                                <input type="text" name="departamento" id="crear_departamento"
                                       class="form-control @error('departamento') is-invalid @enderror"
                                       value="{{ old('departamento') }}" maxlength="255" required
                                       placeholder="Ej: Cundinamarca">
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle"></i> Solo letras y espacios. Máx. 255 caracteres.
                                </small>
                                @error('departamento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback" id="crear_departamento_error"></div>
                            </div>
                        </div>

                        {{-- Entidad --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="crear_entidad">Entidad <span class="text-danger">*</span></label>
                                <input type="text" name="entidad" id="crear_entidad"
                                       class="form-control @error('entidad') is-invalid @enderror"
                                       value="{{ old('entidad') }}" maxlength="255" required
                                       placeholder="Ej: Empresa XYZ S.A.S">
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle"></i> Nombre de la entidad o empresa. Máx. 255 caracteres.
                                </small>
                                @error('entidad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback" id="crear_entidad_error"></div>
                            </div>
                        </div>

                        {{-- Servicio --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="crear_servicio">Servicio <span class="text-danger">*</span></label>
                                <input type="text" name="servicio" id="crear_servicio"
                                       class="form-control @error('servicio') is-invalid @enderror"
                                       value="{{ old('servicio') }}" maxlength="255" required
                                       placeholder="Ej: Entrega express">
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle"></i> Tipo de servicio prestado. Máx. 255 caracteres.
                                </small>
                                @error('servicio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback" id="crear_servicio_error"></div>
                            </div>
                        </div>

                        {{-- Piezas --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="crear_piezas">Piezas <span class="text-danger">*</span></label>
                                <input type="number" name="piezas" id="crear_piezas"
                                       class="form-control @error('piezas') is-invalid @enderror"
                                       value="{{ old('piezas') }}" min="1" required
                                       placeholder="Ej: 5">
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle"></i> Cantidad de piezas. Mínimo 1.
                                </small>
                                @error('piezas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback" id="crear_piezas_error"></div>
                            </div>
                        </div>

                        {{-- Kilos --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="crear_kilos">Kilos <span class="text-danger">*</span></label>
                                <input type="number" name="kilos" id="crear_kilos"
                                       class="form-control @error('kilos') is-invalid @enderror"
                                       value="{{ old('kilos') }}" step="0.01" min="0.01" required
                                       placeholder="Ej: 2.50">
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle"></i> Peso en kilogramos. Mínimo 0.01.
                                </small>
                                @error('kilos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback" id="crear_kilos_error"></div>
                            </div>
                        </div>

                        {{-- Operador --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="crear_opedor">Operador <span class="text-danger">*</span></label>
                                <input type="text" name="opedor" id="crear_opedor"
                                       class="form-control @error('opedor') is-invalid @enderror"
                                       value="{{ old('opedor') }}" maxlength="255" required
                                       placeholder="Ej: Carlos López">
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle"></i> Nombre del operador responsable.
                                </small>
                                @error('opedor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback" id="crear_opedor_error"></div>
                            </div>
                        </div>

                        {{-- Comentario --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="crear_comentario">Comentario <span class="text-danger">*</span></label>
                                <textarea name="comentario" id="crear_comentario" rows="2"
                                          class="form-control @error('comentario') is-invalid @enderror"
                                          maxlength="255" required
                                          placeholder="Ej: Entregar en horario de oficina">{{ old('comentario') }}</textarea>
                                <small class="form-text text-muted d-flex justify-content-between">
                                    <span><i class="fas fa-info-circle"></i> Opcional. <span id="crear_comentario_count">0</span>/255 caracteres.</span>
                                </small>
                                @error('comentario')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback" id="crear_comentario_error"></div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary" id="btnGuardarPlanilla">
                        <i class="fas fa-save mr-1"></i> Guardar
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@stop

@section('js')
<script>
    @if($errors->any())
        $(document).ready(function () {
            $('#modalCrear').modal('show');
        });
    @endif

    $(document).ready(function () {

        /* ── Contador de caracteres ── */
        $('#crear_comentario').on('input', function () {
            $('#crear_comentario_count').text($(this).val().length);
        });

        /* ── Validación en tiempo real ── */
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

        /* Bindings tiempo real */
        $('#crear_guia_id').on('change',      () => validarSelect('#crear_guia_id',      '#crear_guia_id_error'));
        $('#crear_ruta_id').on('change',      () => validarSelect('#crear_ruta_id',      '#crear_ruta_id_error'));
        $('#crear_destinatario').on('input',  () => validarCampo('#crear_destinatario',  '#crear_destinatario_error',  regexTexto,   'Solo se permiten letras, espacios y tildes.'));
        $('#crear_direccion').on('input',     () => validarCampo('#crear_direccion',     '#crear_direccion_error',     regexGeneral, 'Dirección contiene caracteres no válidos.'));
        $('#crear_destino').on('input',       () => validarCampo('#crear_destino',       '#crear_destino_error',       regexTexto,   'Solo se permiten letras, espacios y tildes.'));
        $('#crear_departamento').on('input',  () => validarCampo('#crear_departamento',  '#crear_departamento_error',  regexTexto,   'Solo se permiten letras, espacios y tildes.'));
        $('#crear_entidad').on('input',       () => validarCampo('#crear_entidad',       '#crear_entidad_error',       regexGeneral, 'Entidad contiene caracteres no válidos.'));
        $('#crear_servicio').on('input',      () => validarCampo('#crear_servicio',      '#crear_servicio_error',      regexGeneral, 'Servicio contiene caracteres no válidos.'));
        $('#crear_piezas').on('input',        () => validarNumero('#crear_piezas',       '#crear_piezas_error',        1));
        $('#crear_kilos').on('input',         () => validarNumero('#crear_kilos',        '#crear_kilos_error',         0.01));
        $('#crear_opedor').on('input',        () => validarCampo('#crear_opedor',        '#crear_opedor_error',        regexTexto,   'Solo se permiten letras, espacios y tildes.'));
        $('#crear_comentario').on('input',    () => validarCampo('#crear_comentario',    '#crear_comentario_error',    null,         ''));

        /* ── Validación al enviar ── */
        $('#formCrearPlanilla').on('submit', function (e) {
            let valido = true;

            validarSelect('#crear_guia_id',      '#crear_guia_id_error');
            validarSelect('#crear_ruta_id',      '#crear_ruta_id_error');
            validarCampo('#crear_destinatario',  '#crear_destinatario_error',  regexTexto,   'Solo se permiten letras, espacios y tildes.');
            validarCampo('#crear_direccion',     '#crear_direccion_error',     regexGeneral, 'Dirección contiene caracteres no válidos.');
            validarCampo('#crear_destino',       '#crear_destino_error',       regexTexto,   'Solo se permiten letras, espacios y tildes.');
            validarCampo('#crear_departamento',  '#crear_departamento_error',  regexTexto,   'Solo se permiten letras, espacios y tildes.');
            validarCampo('#crear_entidad',       '#crear_entidad_error',       regexGeneral, 'Entidad contiene caracteres no válidos.');
            validarCampo('#crear_servicio',      '#crear_servicio_error',      regexGeneral, 'Servicio contiene caracteres no válidos.');
            validarNumero('#crear_piezas',       '#crear_piezas_error',        1);
            validarNumero('#crear_kilos',        '#crear_kilos_error',         0.01);
            validarCampo('#crear_opedor',        '#crear_opedor_error',        regexTexto,   'Solo se permiten letras, espacios y tildes.');
            validarCampo('#crear_comentario',    '#crear_comentario_error',    null,         '');

            if ($('#formCrearPlanilla .is-invalid').length > 0) {
                valido = false;
            }

            if (!valido) {
                e.preventDefault();
                $('#formCrearPlanilla .is-invalid').first().focus();
            }
        });

        /* ── Limpiar al cerrar modal ── */
        $('#modalCrear').on('hidden.bs.modal', function () {
            $('#formCrearPlanilla')[0].reset();
            $('#formCrearPlanilla .form-control, #formCrearPlanilla select').removeClass('is-invalid is-valid');
            $('#formCrearPlanilla .invalid-feedback[id]').text('');
            $('#crear_comentario_count').text('0');
        });

    });
</script>
@stop