@extends('adminlte::page')

@section('title', 'Rutas')

@section('content_header')
    <h1>Gestión de Rutas</h1>
@stop

@section('content')

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
        <strong><i class="fas fa-exclamation-triangle mr-1"></i> Corrige los siguientes errores:</strong>
        <ul class="mb-0 mt-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

<div class="card card-outline card-primary">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">
            <i class="fas fa-route mr-1"></i> Listado de Rutas
        </h3>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCrear">
            <i class="fas fa-plus mr-1"></i> Nueva Ruta
        </button>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center" style="width:60px;">#</th>
                        <th>Zona</th>
                        <th>Guía</th>
                        <th>Dirección</th>
                        <th>Sector</th>
                        <th>Ciudad</th>
                        <th class="text-center" style="width:110px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rutas as $ruta)
                        <tr>
                            <td class="text-center">{{ $ruta->id }}</td>
                            <td><span class="badge badge-primary">{{ $ruta->zona }}</span></td>
                            <td>{{ $ruta->guia }}</td>
                            <td>{{ $ruta->direccion }}</td>
                            <td>{{ $ruta->sector }}</td>
                            <td>{{ $ruta->ciudad }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.ruta.edit', $ruta->id) }}"
                                   class="btn btn-warning btn-xs" title="Editar ruta">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button"
                                        class="btn btn-danger btn-xs btn-eliminar"
                                        title="Eliminar ruta"
                                        data-id="{{ $ruta->id }}"
                                        data-zona="{{ $ruta->zona }}"
                                        data-ciudad="{{ $ruta->ciudad }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="formEliminar{{ $ruta->id }}"
                                      action="{{ route('admin.ruta.destroy', $ruta->id) }}"
                                      method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                No hay rutas registradas aún.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($rutas->hasPages())
        <div class="card-footer clearfix">
            {{ $rutas->links() }}
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
                    <i class="fas fa-plus-circle mr-1"></i> Nueva Ruta
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form action="{{ route('admin.ruta.store') }}" method="POST"
                  autocomplete="off" id="formCrearRuta" novalidate>
                @csrf

                <div class="modal-body">
                    <div class="row">

                        {{-- Zona --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="c_zona"><i class="fas fa-map mr-1 text-muted"></i> Zona <span class="text-danger">*</span></label>
                                <input type="text" name="zona" id="c_zona"
                                       class="form-control @error('zona') is-invalid @enderror"
                                       value="{{ old('zona') }}" maxlength="255"
                                       placeholder="Ej: Norte, Sur, Centro..." required>
                                <div class="invalid-feedback">
                                    @error('zona') {{ $message }} @else Solo se permiten letras y espacios. @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Guía --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="c_guia"><i class="fas fa-file-alt mr-1 text-muted"></i> Guía <span class="text-danger">*</span></label>
                                <input type="text" name="guia" id="c_guia"
                                       class="form-control @error('guia') is-invalid @enderror"
                                       value="{{ old('guia') }}" maxlength="255"
                                       placeholder="Número o código de guía" required>
                                <div class="invalid-feedback">
                                    @error('guia') {{ $message }} @else Este campo es obligatorio. @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Dirección --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="c_direccion"><i class="fas fa-map-marker-alt mr-1 text-muted"></i> Dirección <span class="text-danger">*</span></label>
                                <input type="text" name="direccion" id="c_direccion"
                                       class="form-control @error('direccion') is-invalid @enderror"
                                       value="{{ old('direccion') }}" maxlength="255"
                                       placeholder="Dirección completa de la ruta" required>
                                <div class="invalid-feedback">
                                    @error('direccion') {{ $message }} @else Ingresa una dirección válida. @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Sector --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="c_sector"><i class="fas fa-compass mr-1 text-muted"></i> Sector <span class="text-danger">*</span></label>
                                <input type="text" name="sector" id="c_sector"
                                       class="form-control @error('sector') is-invalid @enderror"
                                       value="{{ old('sector') }}" maxlength="255"
                                       placeholder="Sector o barrio" required>
                                <div class="invalid-feedback">
                                    @error('sector') {{ $message }} @else Solo se permiten letras y espacios. @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Ciudad --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="c_ciudad"><i class="fas fa-city mr-1 text-muted"></i> Ciudad <span class="text-danger">*</span></label>
                                <input type="text" name="ciudad" id="c_ciudad"
                                       class="form-control @error('ciudad') is-invalid @enderror"
                                       value="{{ old('ciudad') }}" maxlength="255"
                                       placeholder="Ciudad de destino" required>
                                <div class="invalid-feedback">
                                    @error('ciudad') {{ $message }} @else Solo se permiten letras y espacios. @enderror
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
                        <i class="fas fa-save mr-1"></i> Guardar Ruta
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
                <p class="mb-1">¿Eliminar la ruta zona</p>
                <strong id="elim_zona" class="text-danger d-block mb-1"></strong>
                <p class="mb-1">en</p>
                <strong id="elim_ciudad"></strong>
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

    // ── Reglas de validación ───────────────────────────────────────────────
    const soloLetras  = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/;
    const direccionRg = /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑüÜ\s#\-\.\/,]+$/;
    const guiaRg      = /^[a-zA-Z0-9\-_]+$/;

    const rulesCrear = {
        c_zona:      { regex: soloLetras,  msg: 'Solo letras y espacios.',                        blockDigits: true  },
        c_sector:    { regex: soloLetras,  msg: 'Solo letras y espacios.',                        blockDigits: true  },
        c_ciudad:    { regex: soloLetras,  msg: 'Solo letras y espacios.',                        blockDigits: true  },
        c_guia:      { regex: guiaRg,      msg: 'Solo letras, números, guiones y guiones bajos.', blockDigits: false },
        c_direccion: { regex: direccionRg, msg: 'Caracteres no válidos en la dirección.',         blockDigits: false },
    };

    // ── Helpers ────────────────────────────────────────────────────────────
    function setValid(el)        { el.classList.add('is-valid'); el.classList.remove('is-invalid'); }
    function setInvalid(el, msg) {
        el.classList.add('is-invalid'); el.classList.remove('is-valid');
        const fb = el.parentElement.querySelector('.invalid-feedback');
        if (fb && msg) fb.textContent = msg;
    }

    function showToast(type, message) {
        const existing = document.getElementById('_toast');
        if (existing) existing.remove();
        const colors = { warning: '#ffc107', danger: '#dc3545' };
        const icons  = { warning: 'fa-exclamation-triangle', danger: 'fa-times-circle' };
        const t = document.createElement('div');
        t.id = '_toast';
        t.style.cssText = `position:fixed;bottom:20px;right:20px;z-index:9999;
            background:${colors[type]};color:#212529;padding:12px 18px;border-radius:8px;
            box-shadow:0 4px 12px rgba(0,0,0,.2);display:flex;align-items:center;
            gap:10px;font-size:.9rem;max-width:340px;animation:_slideIn .3s ease;`;
        t.innerHTML = `<i class="fas ${icons[type]}"></i><span>${message}</span>`;
        document.body.appendChild(t);
        setTimeout(() => { t.style.opacity='0'; t.style.transition='opacity .5s'; }, 3500);
        setTimeout(() => t.remove(), 4000);
    }

    const style = document.createElement('style');
    style.textContent = `@keyframes _slideIn{from{transform:translateX(100px);opacity:0}to{transform:translateX(0);opacity:1}}`;
    document.head.appendChild(style);

    function validateField(el, rules) {
        const rule = rules[el.id];
        const val  = el.value.trim();
        if (!val) { setInvalid(el, 'Este campo es obligatorio.'); return false; }
        if (rule && !rule.regex.test(val)) { setInvalid(el, rule.msg); return false; }
        setValid(el);
        return true;
    }

    function bindRules(rules) {
        Object.entries(rules).forEach(([id, rule]) => {
            const el = document.getElementById(id);
            if (!el) return;

            // Bloquear dígitos en keypress
            if (rule.blockDigits) {
                el.addEventListener('keypress', function (e) {
                    if (/[0-9]/.test(e.key)) {
                        e.preventDefault();
                        const label = el.closest('.form-group').querySelector('label').textContent.trim();
                        showToast('warning', `"${label}" no admite números.`);
                    }
                });
            }

            // Limpiar al pegar
            el.addEventListener('paste', function (e) {
                e.preventDefault();
                const pasted = (e.clipboardData || window.clipboardData).getData('text');
                const clean  = rule.blockDigits ? pasted.replace(/[0-9]/g, '') : pasted;
                document.execCommand('insertText', false, clean);
            });

            el.addEventListener('blur',  () => validateField(el, rules));
            el.addEventListener('input', () => {
                if (el.classList.contains('is-invalid') || el.classList.contains('is-valid')) {
                    validateField(el, rules);
                }
            });
        });
    }

    // ── Formulario Crear (modal) ───────────────────────────────────────────
    bindRules(rulesCrear);

    const formCrear   = document.getElementById('formCrearRuta');
    const btnGuardar  = document.getElementById('c_btnGuardar');

    formCrear.addEventListener('submit', function (e) {
        const allOk = Object.keys(rulesCrear)
            .map(id => validateField(document.getElementById(id), rulesCrear))
            .every(Boolean);

        if (!allOk) {
            e.preventDefault();
            e.stopPropagation();
            const first = formCrear.querySelector('.is-invalid');
            if (first) { first.scrollIntoView({ behavior: 'smooth', block: 'center' }); first.focus(); }
            showToast('warning', 'Corrige los campos marcados antes de continuar.');
            return;
        }

        btnGuardar.disabled = true;
        btnGuardar.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Guardando...';
    });

    // Reset modal al cerrar
    $('#modalCrear').on('hidden.bs.modal', function () {
        formCrear.reset();
        formCrear.querySelectorAll('.is-valid, .is-invalid')
            .forEach(el => el.classList.remove('is-valid', 'is-invalid'));
        btnGuardar.disabled = false;
        btnGuardar.innerHTML = '<i class="fas fa-save mr-1"></i> Guardar Ruta';
    });

    // Reabrir modal si hubo errores backend
    @if($errors->any())
        $('#modalCrear').modal('show');
    @endif

    // ── Modal Eliminar ─────────────────────────────────────────────────────
    let elimId = null;

    document.querySelectorAll('.btn-eliminar').forEach(btn => {
        btn.addEventListener('click', function () {
            elimId = this.dataset.id;
            document.getElementById('elim_zona').textContent   = this.dataset.zona;
            document.getElementById('elim_ciudad').textContent = this.dataset.ciudad;
            $('#modalEliminar').modal('show');
        });
    });

    document.getElementById('btnConfirmarEliminar').addEventListener('click', function () {
        if (elimId) document.getElementById('formEliminar' + elimId).submit();
    });

});
</script>
@endpush