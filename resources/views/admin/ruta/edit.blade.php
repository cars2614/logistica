@extends('adminlte::page')

@section('title', 'Editar Ruta')

@section('content_header')
    <h1>Editar Ruta <small class="text-muted">#{{ $ruta->id }}</small></h1>
@stop

@section('content')

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

<div class="card card-outline card-warning">
    <div class="card-header">
        <h3 class="card-title mb-0">
            <i class="fas fa-edit mr-1"></i> Modificar datos de la Ruta
        </h3>
    </div>

    <form action="{{ route('admin.ruta.update', $ruta->id) }}" method="POST"
          autocomplete="off" id="formEditRuta" novalidate>
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="row">

                {{-- Zona --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="zona"><i class="fas fa-map mr-1 text-muted"></i> Zona <span class="text-danger">*</span></label>
                        <input type="text" name="zona" id="zona"
                               class="form-control @error('zona') is-invalid @enderror"
                               value="{{ old('zona', $ruta->zona) }}"
                               maxlength="255"
                               placeholder="Ej: Norte, Sur, Centro..."
                               required>
                        <div class="invalid-feedback">
                            @error('zona') {{ $message }} @else Ingresa una zona válida (solo letras). @enderror
                        </div>
                    </div>
                </div>

                {{-- Guía --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="guia"><i class="fas fa-file-alt mr-1 text-muted"></i> Guía <span class="text-danger">*</span></label>
                        <input type="text" name="guia" id="guia"
                               class="form-control @error('guia') is-invalid @enderror"
                               value="{{ old('guia', $ruta->guia) }}"
                               maxlength="255"
                               placeholder="Número o código de guía"
                               required>
                        <div class="invalid-feedback">
                            @error('guia') {{ $message }} @else Este campo es obligatorio. @enderror
                        </div>
                    </div>
                </div>

                {{-- Dirección --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="direccion"><i class="fas fa-map-marker-alt mr-1 text-muted"></i> Dirección <span class="text-danger">*</span></label>
                        <input type="text" name="direccion" id="direccion"
                               class="form-control @error('direccion') is-invalid @enderror"
                               value="{{ old('direccion', $ruta->direccion) }}"
                               maxlength="255"
                               placeholder="Dirección completa de la ruta"
                               required>
                        <div class="invalid-feedback">
                            @error('direccion') {{ $message }} @else Ingresa una dirección válida. @enderror
                        </div>
                    </div>
                </div>

                {{-- Sector --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sector"><i class="fas fa-compass mr-1 text-muted"></i> Sector <span class="text-danger">*</span></label>
                        <input type="text" name="sector" id="sector"
                               class="form-control @error('sector') is-invalid @enderror"
                               value="{{ old('sector', $ruta->sector) }}"
                               maxlength="255"
                               placeholder="Sector o barrio"
                               required>
                        <div class="invalid-feedback">
                            @error('sector') {{ $message }} @else Ingresa un sector válido (solo letras). @enderror
                        </div>
                    </div>
                </div>

                {{-- Ciudad --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ciudad"><i class="fas fa-city mr-1 text-muted"></i> Ciudad <span class="text-danger">*</span></label>
                        <input type="text" name="ciudad" id="ciudad"
                               class="form-control @error('ciudad') is-invalid @enderror"
                               value="{{ old('ciudad', $ruta->ciudad) }}"
                               maxlength="255"
                               placeholder="Ciudad de destino"
                               required>
                        <div class="invalid-feedback">
                            @error('ciudad') {{ $message }} @else Solo se permiten letras y espacios. @enderror
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="card-footer d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.ruta.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Volver al listado
            </a>
            <button type="submit" class="btn btn-warning" id="btnActualizar">
                <i class="fas fa-save mr-1"></i> Actualizar Ruta
            </button>
        </div>

    </form>
</div>

@stop

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('formEditRuta');

    // ── Reglas por campo ───────────────────────────────────────────────────
    // soloLetras: zona, sector, ciudad  → bloquea dígitos en keypress
    // alfanumerico: guia               → letras, números, guiones
    // direccion: letras, números, #, -, espacios

    const soloLetrasReg   = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/;
    const direccionReg    = /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑüÜ\s#\-\.\/,]+$/;
    const guiaReg         = /^[a-zA-Z0-9\-_]+$/;

    const rules = {
        zona:      { regex: soloLetrasReg,  msg: 'Solo se permiten letras y espacios.',           blockDigits: true  },
        sector:    { regex: soloLetrasReg,  msg: 'Solo se permiten letras y espacios.',           blockDigits: true  },
        ciudad:    { regex: soloLetrasReg,  msg: 'Solo se permiten letras y espacios.',           blockDigits: true  },
        guia:      { regex: guiaReg,        msg: 'Solo letras, números, guiones y guiones bajos.', blockDigits: false },
        direccion: { regex: direccionReg,   msg: 'Caracteres no válidos en la dirección.',        blockDigits: false },
    };

    // ── Helpers ────────────────────────────────────────────────────────────
    function setValid(el)        { el.classList.add('is-valid'); el.classList.remove('is-invalid'); }
    function setInvalid(el, msg) {
        el.classList.add('is-invalid'); el.classList.remove('is-valid');
        const fb = el.parentElement.querySelector('.invalid-feedback');
        if (fb && msg) fb.textContent = msg;
    }
    function clearState(el)      { el.classList.remove('is-valid', 'is-invalid'); }

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

    // ── Bloquear dígitos en keypress (zona, sector, ciudad) ───────────────
    Object.entries(rules).forEach(([id, rule]) => {
        const el = document.getElementById(id);
        if (!el) return;

        if (rule.blockDigits) {
            el.addEventListener('keypress', function (e) {
                if (/[0-9]/.test(e.key)) {
                    e.preventDefault();
                    showToast('warning', `El campo "${el.previousElementSibling.textContent.trim()}" no admite números.`);
                }
            });
        }

        // Limpiar caracteres inválidos al pegar (paste)
        el.addEventListener('paste', function (e) {
            e.preventDefault();
            const pasted = (e.clipboardData || window.clipboardData).getData('text');
            const clean  = rule.blockDigits
                ? pasted.replace(/[0-9]/g, '')
                : pasted;
            document.execCommand('insertText', false, clean);
        });

        // Validar en blur
        el.addEventListener('blur', () => validateField(el));
        // Validar en input (después de escribir)
        el.addEventListener('input', () => {
            if (el.classList.contains('is-invalid') || el.classList.contains('is-valid')) {
                validateField(el);
            }
        });
    });

    // ── Validar campo individual ───────────────────────────────────────────
    function validateField(el) {
        const rule = rules[el.id];
        const val  = el.value.trim();

        if (!val) {
            setInvalid(el, 'Este campo es obligatorio.');
            return false;
        }
        if (rule && !rule.regex.test(val)) {
            setInvalid(el, rule.msg);
            return false;
        }
        setValid(el);
        return true;
    }

    // ── Validación al enviar ───────────────────────────────────────────────
    const btn = document.getElementById('btnActualizar');

    form.addEventListener('submit', function (e) {
        const ids   = ['zona', 'guia', 'direccion', 'sector', 'ciudad'];
        const allOk = ids.map(id => validateField(document.getElementById(id))).every(Boolean);

        if (!allOk) {
            e.preventDefault();
            e.stopPropagation();
            const first = form.querySelector('.is-invalid');
            if (first) { first.scrollIntoView({ behavior: 'smooth', block: 'center' }); first.focus(); }
            showToast('warning', 'Corrige los campos marcados antes de continuar.');
            return;
        }

        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Guardando...';
    });

});
</script>
@endpush