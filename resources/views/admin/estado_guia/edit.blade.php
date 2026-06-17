@extends('adminlte::page')

@section('title', 'Editar Estado de Guía')

@section('content_header')
    <h1>Editar Estado de Guía #{{ $estadoGuia->id }}</h1>
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
            <i class="fas fa-edit mr-1"></i> Editar Estado de Guía
        </h3>
    </div>

    <form action="{{ route('admin.estado-guia.update', $estadoGuia->id) }}"
          method="POST" id="formEstadoGuia" novalidate>
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="row">

                {{-- Guía --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="guia_id">
                            <i class="fas fa-file-alt mr-1 text-muted"></i>
                            Guía <span class="text-danger">*</span>
                        </label>
                        <select name="guia_id" id="guia_id"
                                class="form-control @error('guia_id') is-invalid @enderror"
                                required>
                            <option value="">-- Seleccionar guía --</option>
                            @foreach($guias as $guia)
                                <option value="{{ $guia->id_guias }}"
                                    {{ old('guia_id', $estadoGuia->guia_id) == $guia->id_guias ? 'selected' : '' }}>
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
                        <label for="fecha_estado">
                            <i class="fas fa-calendar-alt mr-1 text-muted"></i>
                            Fecha y Hora del Estado <span class="text-danger">*</span>
                        </label>
                        <input type="datetime-local"
                               name="fecha_estado"
                               id="fecha_estado"
                               class="form-control @error('fecha_estado') is-invalid @enderror"
                               value="{{ old('fecha_estado', \Carbon\Carbon::parse($estadoGuia->fecha_estado)->format('Y-m-d\TH:i')) }}"
                               required>
                        <small class="form-text text-muted" id="fecha_hint">
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
                        <label for="estado">
                            <i class="fas fa-tag mr-1 text-muted"></i>
                            Estado <span class="text-danger">*</span>
                        </label>
                        <select name="estado" id="estado"
                                class="form-control @error('estado') is-invalid @enderror"
                                required>
                            <option value="">-- Seleccionar estado --</option>
                            @php
                                $estados = [
                                    'Pendiente'     => 'Pendiente',
                                    'En tránsito'   => 'En tránsito',
                                    'En camino'     => 'En camino',
                                    'Entregado'     => 'Entregado',
                                    'Devuelto'      => 'Devuelto',
                                    'Cancelado'     => 'Cancelado',
                                    'Reprogramado'  => 'Reprogramado',
                                    'No encontrado' => 'No encontrado',
                                ];
                            @endphp
                            @foreach($estados as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('estado', $estadoGuia->estado) == $value ? 'selected' : '' }}>
                                    {{ $label }}
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
                        <label for="descripcion">
                            <i class="fas fa-align-left mr-1 text-muted"></i>
                            Descripción <span class="text-danger">*</span>
                        </label>
                        <textarea name="descripcion"
                                  id="descripcion"
                                  rows="3"
                                  class="form-control @error('descripcion') is-invalid @enderror"
                                  maxlength="255"
                                  minlength="10"
                                  placeholder="Describe el estado actual de la guía..."
                                  required>{{ old('descripcion', $estadoGuia->descripcion) }}</textarea>
                        <div class="d-flex justify-content-between">
                            <div class="invalid-feedback d-block" id="desc_error" style="display:none!important">
                                @error('descripcion')
                                    {{ $message }}
                                @else
                                    &nbsp;
                                @enderror
                            </div>
                            <small class="text-muted ml-auto" id="char_counter">
                                <span id="char_count">0</span>/255 caracteres
                            </small>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="card-footer d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.estado-guia.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Volver
            </a>
            <button type="submit" class="btn btn-warning" id="btnSubmit">
                <i class="fas fa-save mr-1"></i> Actualizar
            </button>
        </div>

    </form>
</div>

@stop

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const form        = document.getElementById('formEstadoGuia');
    const guiaSelect  = document.getElementById('guia_id');
    const fechaInput  = document.getElementById('fecha_estado');
    const estadoSel   = document.getElementById('estado');
    const descArea    = document.getElementById('descripcion');
    const charCount   = document.getElementById('char_count');
    const btnSubmit   = document.getElementById('btnSubmit');
    const descError   = document.getElementById('desc_error');

    // ── 1. Fijar fecha máxima = ahora ──────────────────────────────────────
    function nowLocal() {
        const now = new Date();
        now.setSeconds(0, 0);
        return now.toISOString().slice(0, 16);
    }
    fechaInput.setAttribute('max', nowLocal());

    // ── 2. Contador de caracteres descripción ─────────────────────────────
    function updateCounter() {
        const len = descArea.value.length;
        charCount.textContent = len;
        charCount.parentElement.className =
            len > 230 ? 'text-danger ml-auto' :
            len > 200 ? 'text-warning ml-auto' : 'text-muted ml-auto';
    }
    updateCounter(); // inicializar con valor actual
    descArea.addEventListener('input', updateCounter);

    // ── 3. Validación en tiempo real ───────────────────────────────────────
    function validateField(field) {
        field.classList.remove('is-valid', 'is-invalid');

        if (field === fechaInput) {
            const val = field.value;
            if (!val) {
                setInvalid(field, 'La fecha y hora son obligatorias.');
                return false;
            }
            if (val > nowLocal()) {
                setInvalid(field, 'La fecha no puede ser futura.');
                return false;
            }
            setValid(field);
            return true;
        }

        if (field === descArea) {
            const len = field.value.trim().length;
            if (len === 0) {
                showDescError('La descripción es obligatoria.');
                setInvalid(field, '');
                return false;
            }
            if (len < 10) {
                showDescError('Mínimo 10 caracteres.');
                setInvalid(field, '');
                return false;
            }
            hideDescError();
            setValid(field);
            return true;
        }

        if (!field.value) {
            setInvalid(field, field.tagName === 'SELECT'
                ? 'Este campo es obligatorio.'
                : 'Este campo es obligatorio.');
            return false;
        }
        setValid(field);
        return true;
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
    function showDescError(msg) {
        descError.textContent = msg;
        descError.style.setProperty('display', 'block', 'important');
    }
    function hideDescError() {
        descError.style.setProperty('display', 'none', 'important');
    }

    // Listeners individuales
    [guiaSelect, estadoSel].forEach(el =>
        el.addEventListener('change', () => validateField(el))
    );
    fechaInput.addEventListener('change', () => validateField(fechaInput));
    fechaInput.addEventListener('blur',   () => validateField(fechaInput));
    descArea.addEventListener('blur',     () => validateField(descArea));

    // ── 4. Validación al enviar ────────────────────────────────────────────
    form.addEventListener('submit', function (e) {
        const fields  = [guiaSelect, fechaInput, estadoSel, descArea];
        const allOk   = fields.map(f => validateField(f)).every(Boolean);

        if (!allOk) {
            e.preventDefault();
            e.stopPropagation();

            // Scroll al primer campo inválido
            const firstInvalid = form.querySelector('.is-invalid');
            if (firstInvalid) {
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstInvalid.focus();
            }

            // Toast de advertencia
            showToast('warning', 'Revisa los campos marcados en rojo antes de continuar.');
            return;
        }

        // Deshabilitar botón para evitar doble envío
        btnSubmit.disabled = true;
        btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Guardando...';
    });

    // ── 5. Mini toast no intrusivo ─────────────────────────────────────────
    function showToast(type, message) {
        const existing = document.getElementById('validationToast');
        if (existing) existing.remove();

        const colors = { warning: '#ffc107', danger: '#dc3545', success: '#28a745' };
        const icons  = { warning: 'fa-exclamation-triangle', danger: 'fa-times-circle', success: 'fa-check-circle' };

        const toast = document.createElement('div');
        toast.id = 'validationToast';
        toast.style.cssText = `
            position:fixed; bottom:20px; right:20px; z-index:9999;
            background:${colors[type]}; color:#212529;
            padding:12px 18px; border-radius:8px;
            box-shadow:0 4px 12px rgba(0,0,0,.2);
            display:flex; align-items:center; gap:10px;
            font-size:.9rem; max-width:340px;
            animation: slideIn .3s ease;
        `;
        toast.innerHTML = `<i class="fas ${icons[type]}"></i><span>${message}</span>`;
        document.body.appendChild(toast);
        setTimeout(() => { toast.style.opacity='0'; toast.style.transition='opacity .5s'; }, 3500);
        setTimeout(() => toast.remove(), 4000);
    }

    // Animación CSS inline
    const style = document.createElement('style');
    style.textContent = `@keyframes slideIn { from { transform: translateX(100px); opacity:0; } to { transform: translateX(0); opacity:1; } }`;
    document.head.appendChild(style);

});
</script>
@endpush