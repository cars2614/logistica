@extends('adminlte::page')

@section('title', 'Estados de Guía')

@section('content_header')
    <h1>Estados de Guía</h1>
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
        <h3 class="card-title mb-0">Listado de Estados de Guía</h3>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCrear">
            <i class="fas fa-plus mr-1"></i> Nuevo Estado
        </button>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Guía N°</th>
                        <th>Fecha Estado</th>
                        <th>Estado</th>
                        <th>Descripción</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($estadoGuias as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                @if($item->guia)
                                    <span class="badge badge-info">{{ $item->guia->num_guias }}</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->fecha_estado)->format('d/m/Y H:i') }}</td>
                            <td>
                                @php
                                    $badgeClass = match($item->estado) {
                                        'Entregado'     => 'badge-success',
                                        'En tránsito'   => 'badge-info',
                                        'En camino'     => 'badge-primary',
                                        'Pendiente'     => 'badge-warning',
                                        'Devuelto'      => 'badge-secondary',
                                        'Cancelado'     => 'badge-danger',
                                        'Reprogramado'  => 'badge-dark',
                                        'No encontrado' => 'badge-light',
                                        default         => 'badge-secondary',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $item->estado }}</span>
                            </td>
                            <td>{{ $item->descripcion }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.estado-guia.edit', $item->id) }}"
                                   class="btn btn-warning btn-xs" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button"
                                        class="btn btn-danger btn-xs btn-eliminar"
                                        title="Eliminar"
                                        data-id="{{ $item->id }}"
                                        data-guia="{{ $item->guia->num_guias ?? '—' }}"
                                        data-estado="{{ $item->estado }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                                {{-- Form oculto para DELETE --}}
                                <form id="formEliminar{{ $item->id }}"
                                      action="{{ route('admin.estado-guia.destroy', $item->id) }}"
                                      method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">
                                <i class="fas fa-inbox fa-2x d-block mb-2"></i>
                                No hay estados de guía registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($estadoGuias->hasPages())
        <div class="card-footer">
            {{ $estadoGuias->links() }}
        </div>
    @endif
</div>

{{-- Modal Crear --}}
<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog"
     aria-labelledby="modalCrearLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalCrearLabel">
                    <i class="fas fa-plus-circle mr-1"></i> Nuevo Estado de Guía
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form action="{{ route('admin.estado-guia.store') }}" method="POST"
                  id="formCrear" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="row">

                        {{-- Guía --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="c_guia_id">
                                    <i class="fas fa-file-alt mr-1 text-muted"></i>
                                    Guía <span class="text-danger">*</span>
                                </label>
                                <select name="guia_id" id="c_guia_id"
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
                                <div class="invalid-feedback">
                                    @error('guia_id')
                                        {{ $message }}
                                    @else
                                        Por favor selecciona una guía.
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Fecha Estado --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="c_fecha_estado">
                                    <i class="fas fa-calendar-alt mr-1 text-muted"></i>
                                    Fecha y Hora del Estado <span class="text-danger">*</span>
                                </label>
                                <input type="datetime-local" name="fecha_estado" id="c_fecha_estado"
                                       class="form-control @error('fecha_estado') is-invalid @enderror"
                                       value="{{ old('fecha_estado') }}" required>
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle"></i> La fecha no puede ser futura.
                                </small>
                                <div class="invalid-feedback">
                                    @error('fecha_estado')
                                        {{ $message }}
                                    @else
                                        Ingresa una fecha y hora válida (no puede ser futura).
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Estado --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="c_estado">
                                    <i class="fas fa-tag mr-1 text-muted"></i>
                                    Estado <span class="text-danger">*</span>
                                </label>
                                <select name="estado" id="c_estado"
                                        class="form-control @error('estado') is-invalid @enderror"
                                        required>
                                    <option value="">-- Seleccionar estado --</option>
                                    @foreach([
                                        'Pendiente', 'En tránsito', 'En camino',
                                        'Entregado', 'Devuelto', 'Cancelado',
                                        'Reprogramado', 'No encontrado'
                                    ] as $op)
                                        <option value="{{ $op }}"
                                            {{ old('estado') == $op ? 'selected' : '' }}>
                                            {{ $op }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('estado')
                                        {{ $message }}
                                    @else
                                        Selecciona un estado válido.
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Descripción --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="c_descripcion">
                                    <i class="fas fa-align-left mr-1 text-muted"></i>
                                    Descripción <span class="text-danger">*</span>
                                </label>
                                <textarea name="descripcion" id="c_descripcion" rows="3"
                                          class="form-control @error('descripcion') is-invalid @enderror"
                                          maxlength="255" minlength="10"
                                          placeholder="Describe el estado actual de la guía..."
                                          required>{{ old('descripcion') }}</textarea>
                                <div class="d-flex justify-content-between mt-1">
                                    <div class="invalid-feedback d-block" id="c_desc_error"
                                         style="display:none!important">
                                        @error('descripcion') {{ $message }} @else &nbsp; @enderror
                                    </div>
                                    <small id="c_char_counter" class="text-muted ml-auto">
                                        <span id="c_char_count">0</span>/255 caracteres
                                    </small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary" id="c_btnGuardar">
                        <i class="fas fa-save mr-1"></i> Guardar
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- Modal Confirmar Eliminar --}}
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle mr-1"></i> Confirmar Eliminación
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p class="mb-1">¿Eliminar el estado</p>
                <strong id="eliminar_estado" class="text-danger d-block mb-1"></strong>
                <p class="mb-1">de la guía N°</p>
                <strong id="eliminar_guia"></strong>
                <p class="mt-2 text-muted small">Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Cancelar
                </button>
                <button type="button" class="btn btn-danger btn-sm" id="btnConfirmarEliminar">
                    <i class="fas fa-trash mr-1"></i> Eliminar
                </button>
            </div>
        </div>
    </div>
</div>

@stop

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Helpers ────────────────────────────────────────────────────────────
    function nowLocal() {
        const now = new Date();
        now.setSeconds(0, 0);
        return now.toISOString().slice(0, 16);
    }

    function setValid(field) {
        field.classList.add('is-valid');
        field.classList.remove('is-invalid');
    }

    function setInvalid(field, msg) {
        field.classList.add('is-invalid');
        field.classList.remove('is-valid');
        const fb = field.parentElement.querySelector('.invalid-feedback');
        if (fb && msg) fb.textContent = msg;
    }

    function showToast(type, message) {
        const existing = document.getElementById('validationToast');
        if (existing) existing.remove();
        const colors = { warning: '#ffc107', danger: '#dc3545', success: '#28a745' };
        const icons  = { warning: 'fa-exclamation-triangle', danger: 'fa-times-circle', success: 'fa-check-circle' };
        const toast  = document.createElement('div');
        toast.id = 'validationToast';
        toast.style.cssText = `
            position:fixed;bottom:20px;right:20px;z-index:9999;
            background:${colors[type]};color:#212529;
            padding:12px 18px;border-radius:8px;
            box-shadow:0 4px 12px rgba(0,0,0,.2);
            display:flex;align-items:center;gap:10px;
            font-size:.9rem;max-width:340px;animation:slideIn .3s ease;
        `;
        toast.innerHTML = `<i class="fas ${icons[type]}"></i><span>${message}</span>`;
        document.body.appendChild(toast);
        setTimeout(() => { toast.style.opacity = '0'; toast.style.transition = 'opacity .5s'; }, 3500);
        setTimeout(() => toast.remove(), 4000);
    }

    const style = document.createElement('style');
    style.textContent = `@keyframes slideIn{from{transform:translateX(100px);opacity:0}to{transform:translateX(0);opacity:1}}`;
    document.head.appendChild(style);

    // ── Modal Crear: setup ─────────────────────────────────────────────────
    const form        = document.getElementById('formCrear');
    const cGuia       = document.getElementById('c_guia_id');
    const cFecha      = document.getElementById('c_fecha_estado');
    const cEstado     = document.getElementById('c_estado');
    const cDesc       = document.getElementById('c_descripcion');
    const cCharCount  = document.getElementById('c_char_count');
    const cDescError  = document.getElementById('c_desc_error');
    const cBtnGuardar = document.getElementById('c_btnGuardar');

    // Fecha máxima = ahora
    cFecha.setAttribute('max', nowLocal());

    // Contador de caracteres
    function updateCounter() {
        const len = cDesc.value.length;
        cCharCount.textContent = len;
        cCharCount.parentElement.className =
            len > 230 ? 'text-danger ml-auto' :
            len > 200 ? 'text-warning ml-auto' : 'text-muted ml-auto';
    }
    cDesc.addEventListener('input', updateCounter);

    // Validar campo individual
    function validateField(field) {
        field.classList.remove('is-valid', 'is-invalid');

        if (field === cFecha) {
            if (!field.value) {
                setInvalid(field, 'La fecha y hora son obligatorias.');
                return false;
            }
            if (field.value > nowLocal()) {
                setInvalid(field, 'La fecha no puede ser futura.');
                return false;
            }
            setValid(field);
            return true;
        }

        if (field === cDesc) {
            const len = field.value.trim().length;
            if (len === 0) {
                cDescError.textContent = 'La descripción es obligatoria.';
                cDescError.style.setProperty('display', 'block', 'important');
                field.classList.add('is-invalid');
                return false;
            }
            if (len < 10) {
                cDescError.textContent = 'Mínimo 10 caracteres.';
                cDescError.style.setProperty('display', 'block', 'important');
                field.classList.add('is-invalid');
                return false;
            }
            cDescError.style.setProperty('display', 'none', 'important');
            setValid(field);
            return true;
        }

        if (!field.value) {
            setInvalid(field, 'Este campo es obligatorio.');
            return false;
        }
        setValid(field);
        return true;
    }

    // Listeners en tiempo real
    [cGuia, cEstado].forEach(el => el.addEventListener('change', () => validateField(el)));
    cFecha.addEventListener('change', () => validateField(cFecha));
    cFecha.addEventListener('blur',   () => validateField(cFecha));
    cDesc.addEventListener('blur',    () => validateField(cDesc));

    // Validación al enviar
    form.addEventListener('submit', function (e) {
        const allOk = [cGuia, cFecha, cEstado, cDesc]
            .map(f => validateField(f))
            .every(Boolean);

        if (!allOk) {
            e.preventDefault();
            e.stopPropagation();
            const firstInvalid = form.querySelector('.is-invalid');
            if (firstInvalid) {
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstInvalid.focus();
            }
            showToast('warning', 'Revisa los campos marcados antes de continuar.');
            return;
        }

        cBtnGuardar.disabled = true;
        cBtnGuardar.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Guardando...';
    });

    // Resetear modal al cerrar
    $('#modalCrear').on('hidden.bs.modal', function () {
        form.reset();
        cCharCount.textContent = '0';
        form.querySelectorAll('.is-valid, .is-invalid').forEach(el => {
            el.classList.remove('is-valid', 'is-invalid');
        });
        cDescError.style.setProperty('display', 'none', 'important');
        cBtnGuardar.disabled = false;
        cBtnGuardar.innerHTML = '<i class="fas fa-save mr-1"></i> Guardar';
    });

    // Reabrir modal si hay errores de validación backend
    @if($errors->any())
        $('#modalCrear').modal('show');
    @endif

    // ── Modal Eliminar ─────────────────────────────────────────────────────
    let formIdEliminar = null;

    document.querySelectorAll('.btn-eliminar').forEach(function (btn) {
        btn.addEventListener('click', function () {
            formIdEliminar = this.dataset.id;
            document.getElementById('eliminar_guia').textContent  = this.dataset.guia;
            document.getElementById('eliminar_estado').textContent = this.dataset.estado;
            $('#modalEliminar').modal('show');
        });
    });

    document.getElementById('btnConfirmarEliminar').addEventListener('click', function () {
        if (formIdEliminar) {
            document.getElementById('formEliminar' + formIdEliminar).submit();
        }
    });

});
</script>
@endpush