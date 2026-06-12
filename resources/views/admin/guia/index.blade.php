{{-- resources/views/admin/guia/index.blade.php --}}
 
@extends('adminlte::page')
 
@section('title', 'Guías')
 
@section('content_header')
    <h1>Gestión de Guías</h1>
@stop
 
{{-- ESTILOS EXCLUSIVOS PARA REPARAR LOS INPUTS PLANOS DEL MODAL DE GUÍAS --}}
@section('css')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
 
    :root {
        --dark:   #080C14;
        --dark2:  #0D1220;
        --card:   #0F1628;
        --border: rgba(59,130,246,0.12);
        --blue:   #3B82F6;
        --indigo: #6366F1;
        --muted:  rgba(200,215,255,0.6);
    }
 
    body, h1, h2, h3, h4, h5, h6, p, a, span, td, th, label, input, select, textarea, button, .nav-link {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }
    i[class*="fa-"] { font-family: "Font Awesome 5 Free","Font Awesome 6 Free" !important; font-weight: 900 !important; }
 
    /* NAVBAR */
    .main-header.navbar { background: var(--dark2) !important; border-bottom: 1px solid var(--border) !important; }
    .navbar-light, .navbar-white { background: transparent !important; }
    .main-header.navbar .nav-link, .main-header.navbar span, .main-header.navbar a { color: rgba(200,215,255,0.8) !important; }
    .main-header.navbar .nav-link:hover { color: var(--blue) !important; }
    .main-header .dropdown-menu { background: #0F1628 !important; border: 1px solid var(--border) !important; border-radius: 10px !important; }
    .main-header .dropdown-item { color: rgba(200,215,255,0.85) !important; border-radius: 7px !important; font-size: 13px !important; }
    .main-header .dropdown-item:hover { background: rgba(59,130,246,0.1) !important; color: #fff !important; }
 
    /* SIDEBAR */
    .main-sidebar { background: var(--dark) !important; border-right: 1px solid var(--border) !important; }
    .brand-link { background: var(--dark) !important; border-bottom: 1px solid var(--border) !important; }
    .brand-text { color: #fff !important; font-weight: 700 !important; }
    .nav-sidebar .nav-header { color: rgba(99,130,200,0.6) !important; font-size: 10px !important; font-weight: 700 !important; letter-spacing: 0.12em !important; }
    .nav-sidebar .nav-link { color: rgba(200,215,255,0.7) !important; border-radius: 8px !important; margin: 2px 8px !important; font-size: 13px !important; font-weight: 500 !important; transition: all 0.2s !important; }
    .nav-sidebar .nav-link:hover { background: rgba(59,130,246,0.1) !important; color: #fff !important; }
    .nav-sidebar .nav-link.active { background: linear-gradient(135deg, rgba(59,130,246,0.2), rgba(99,102,241,0.15)) !important; color: #fff !important; border-left: 3px solid var(--blue) !important; font-weight: 600 !important; }
 
    /* CONTENT */
    .content-wrapper { background: var(--dark) !important; }
    .content-header h1 { color: #fff !important; font-size: 20px !important; font-weight: 700 !important; }
    .content-header .breadcrumb-item a { color: var(--blue) !important; }
    .content-header .breadcrumb-item.active { color: var(--muted) !important; }
 
    /* CARDS */
    .card { background: var(--card) !important; border: 1px solid var(--border) !important; border-radius: 12px !important; }
    .card-header { background: rgba(255,255,255,0.03) !important; border-bottom: 1px solid var(--border) !important; }
    .card-title { color: #fff !important; font-weight: 700 !important; }
    .card-body { background: transparent !important; }
    .card-footer { background: rgba(255,255,255,0.02) !important; border-top: 1px solid var(--border) !important; }
 
    /* TEXTOS */
    .text-muted { color: rgba(200,215,255,0.4) !important; }
 
    /* TABLA */
    .table { color: #C8D7FF !important; }
    .table thead th { background: rgba(255,255,255,0.03) !important; color: rgba(200,215,255,0.55) !important; font-size: 11px !important; font-weight: 700 !important; text-transform: uppercase !important; letter-spacing: 0.07em !important; border-bottom: 1px solid var(--border) !important; border-top: none !important; }
    .table tbody td { border-bottom: 1px solid rgba(255,255,255,0.04) !important; vertical-align: middle !important; color: #C8D7FF !important; }
    .table-striped tbody tr:nth-of-type(odd) { background: rgba(255,255,255,0.02) !important; }
    .table-hover tbody tr:hover { background: rgba(59,130,246,0.05) !important; }
    .thead-dark th { background: rgba(255,255,255,0.05) !important; color: rgba(200,215,255,0.7) !important; }
 
    /* INPUTS MODAL */
    #modalCrear .form-control,
    #modalCrear select.form-control {
        background: rgba(255,255,255,0.05) !important;
        border: 1px solid var(--border) !important;
        color: #fff !important;
        border-radius: 0 8px 8px 0 !important;
        height: auto !important;
        padding: 10px 14px !important;
    }
    #modalCrear .form-control:focus { border-color: var(--blue) !important; box-shadow: 0 0 0 3px rgba(59,130,246,0.15) !important; background: rgba(59,130,246,0.05) !important; }
    #modalCrear .form-control::placeholder { color: rgba(200,215,255,0.3) !important; }
    #modalCrear .input-group-prepend .input-group-text {
        background: rgba(255,255,255,0.06) !important;
        border: 1px solid var(--border) !important;
        border-right: none !important;
        color: rgba(200,215,255,0.6) !important;
        border-radius: 8px 0 0 8px !important;
    }
    #modalCrear .input-group > .form-control,
    #modalCrear .input-group > select.form-control {
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
    }
    #modalCrear select.form-control option { background: var(--card) !important; color: #fff !important; }
    #modalCrear label { color: rgba(200,215,255,0.85) !important; font-weight: 600 !important; font-size: 13px !important; }
    #modalCrear .form-text { color: rgba(200,215,255,0.35) !important; }
 
    /* BOTONES */
    .btn-primary { background: linear-gradient(135deg, var(--blue), var(--indigo)) !important; border: none !important; color: #fff !important; border-radius: 8px !important; font-weight: 600 !important; }
    .btn-primary:hover { opacity: 0.9 !important; color: #fff !important; }
    .btn-secondary { background: rgba(255,255,255,0.08) !important; border: 1px solid var(--border) !important; color: rgba(200,215,255,0.7) !important; border-radius: 8px !important; }
    .btn-warning { background: linear-gradient(135deg, #F59E0B, #D97706) !important; border: none !important; color: #fff !important; border-radius: 6px !important; }
    .btn-danger { background: linear-gradient(135deg, #EF4444, #DC2626) !important; border: none !important; color: #fff !important; border-radius: 6px !important; }
 
    /* MODAL */
    .modal-content { background: var(--card) !important; border: 1px solid var(--border) !important; border-radius: 14px !important; }
    .modal-header.bg-primary { background: linear-gradient(135deg, var(--blue), var(--indigo)) !important; }
    .modal-header.bg-danger { background: linear-gradient(135deg, #EF4444, #DC2626) !important; }
    .modal-body { background: transparent !important; color: #C8D7FF !important; }
    .modal-footer { background: rgba(255,255,255,0.02) !important; border-top: 1px solid var(--border) !important; }
 
    /* ALERTAS */
    .alert-success { background: rgba(16,185,129,0.1) !important; border: none !important; border-left: 4px solid #10B981 !important; color: #6EE7B7 !important; border-radius: 10px !important; }
    .alert-danger { background: rgba(239,68,68,0.08) !important; border: none !important; border-left: 4px solid #EF4444 !important; color: #FCA5A5 !important; border-radius: 10px !important; }
 
    /* PAGINACIÓN */
    .pagination .page-link { background: rgba(255,255,255,0.05) !important; border-color: var(--border) !important; color: var(--blue) !important; border-radius: 6px !important; margin: 0 2px !important; }
    .pagination .page-item.active .page-link { background: linear-gradient(135deg, var(--blue), var(--indigo)) !important; border-color: transparent !important; color: #fff !important; }
 
    /* FOOTER */
    .main-footer { background: var(--dark2) !important; border-top: 1px solid var(--border) !important; color: var(--muted) !important; }
</style>
@stop
 
@section('content')

    {{-- Alertas del Sistema --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

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

    {{-- Tabla Principal --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Listado de Guías</h3>
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCrear">
                <i class="fas fa-plus mr-1"></i> Nueva Guía
            </button>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="thead-dark">
                        <tr>

                            <th>Fecha Admisión</th>
                            <th>N° Guía</th>
                            <th>Tipo Entrega</th>
                            <th>Cliente Origen</th>
                            <th>Cliente Destino</th>
                            <th>Unidades</th>
                            <th>Peso</th>
                            <th>Largo</th>
                            <th>Ancho</th>
                            <th>Alto</th>                              
                            <th>Precio Envio</th>
                            <th>Precio Declarado</th>                            
                            
                            <th>Observación</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($guias as $guia)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($guia->created_at)->format('d/m/Y') }}</td>
                                <td>{{ $guia->id }}</td>
                                <td>{{ $guia->tipoEntrega->nombre ?? '—' }}</td>
                                {{-- ojo mejorar la consulta para que aparezca el nombre del tipo de entrega --}}
                                
                                <td>{{ $guia->clienteOrigen->nombre ?? '—' }}</td>
                                <td>{{ $guia->clienteDestino->nombre ?? '—' }}</td>
                                
                             
                                <td>{{ $guia->unidades }}</td>
                                <td>{{ $guia->peso }}</td>

                                <td>{{ $guia->largo }}</td>
                                <td>{{ $guia->ancho }}</td>
                                <td>{{ $guia->alto }}</td>

                                <td>{{ $guia->precio_envio }}</td>
                                <td>{{ $guia->valor_declarado }}</td>
                                

                                <td>{{ $guia->observacion ?? '—' }}</td>

                                <td class="text-center">
                                    <a href="{{ route('admin.guia.edit', $guia->id) }}" class="btn btn-warning btn-xs"
                                        title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
{{-- 
                                    <form action="{{ route('admin.guia.destroy', $guia->id) }}" method="POST"
                                        class="d-inline form-eliminar">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-xs btn-eliminar" title="Eliminar"
                                            data-num="{{ $guia->num_guias }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                     --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center text-muted py-3">
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    No hay guías registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

{{-- 
         @if ($guias->hasPages())
            <div class="card-footer">
                {{ $guias->links() }}
            </div>
        @endif
 --}}

    </div>

    {{-- Modal Crear Guía --}}

    <div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="modalCrearLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalCrearLabel">
                        <i class="fas fa-plus-circle mr-1"></i> Nueva Guía
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <form action="{{ route('admin.guia.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tipo de Entrega</label>
                                    <select name="id_tipo_entrega" class="form-control" required>
                                        <option value="">Seleccione...</option>

                                        @foreach ($tipoEntregas as $tipo)
                                            <option value="{{ $tipo->id }}">
                                                {{ $tipo->nombre }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cliente Origen</label>

                                    <select name="id_cliente_origen" class="form-control" required>

                                        <option value="">Seleccione...</option>

                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">
                                               {{ $cliente->cedula }}  {{ $cliente->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('cliente_id')
                                        <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Seleccione el cliente asociado.</small>
                            </div>
                        </div>
 
                        {{-- Tipo de Entrega --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="m_tipo_entrega_id">Tipo de Entrega <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-box"></i></span>
                                    </div>
                                    <select
                                        name="tipo_entrega_id"
                                        id="m_tipo_entrega_id"
                                        class="form-control @error('tipo_entrega_id') is-invalid @enderror"
                                        required
                                    >
                                        <option value="">-- Seleccionar tipo --</option>
                                        @foreach($tipoEntregas as $tipo)
                                            <option value="{{ $tipo->id }}" {{ old('tipo_entrega_id') == $tipo->id ? 'selected' : '' }}>
                                                {{ $tipo->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tipo_entrega_id')
                                        <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Seleccione el tipo de entrega.</small>
                            </div>
                        </div>
 
                        {{-- Volumen --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="m_volumen">Volumen (m³) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-cube"></i></span>
                                    </div>
                                    <input
                                        type="number"
                                        name="volumen"
                                        id="m_volumen"
                                        class="form-control @error('volumen') is-invalid @enderror"
                                        value="{{ old('volumen') }}"
                                        placeholder="Ej: 1.50"
                                        step="0.01"
                                        min="0.01"
                                        autocomplete="off"
                                        required
                                    >
                                    @error('volumen')
                                        <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Número positivo. Ej: 1.50</small>
                            </div>
                        </div>
 
                        {{-- Peso --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="m_peso">Peso (kg) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-weight-hanging"></i></span>
                                    </div>
                                    <input
                                        type="number"
                                        name="peso"
                                        id="m_peso"
                                        class="form-control @error('peso') is-invalid @enderror"
                                        value="{{ old('peso') }}"
                                        placeholder="Ej: 10.50"
                                        step="0.01"
                                        min="0.01"
                                        autocomplete="off"
                                        required
                                    >
                                    @error('peso')
                                        <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Número positivo. Ej: 10.50</small>
                            </div>
                        </div>
 
                        {{-- Unidades --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="m_unidades">Unidades <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-boxes"></i></span>
                                    </div>
                                    <input
                                        type="number"
                                        name="unidades"
                                        id="m_unidades"
                                        class="form-control @error('unidades') is-invalid @enderror"
                                        value="{{ old('unidades') }}"
                                        placeholder="Ej: 5"
                                        min="1"
                                        autocomplete="off"
                                        required
                                    >
                                    @error('unidades')
                                        <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Solo enteros positivos. Ej: 5</small>
                            </div>
                        </div>
 
                        {{-- Precio --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="m_precio">Precio <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input
                                        type="number"
                                        name="precio"
                                        id="m_precio"
                                        class="form-control @error('precio') is-invalid @enderror"
                                        value="{{ old('precio') }}"
                                        placeholder="Ej: 25000.00"
                                        step="0.01"
                                        min="0.01"
                                        autocomplete="off"
                                        required
                                    >
                                    @error('precio')
                                        <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Valor positivo en pesos.</small>
                            </div>
                        </div>
 
                        {{-- Observación --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="m_observacion">Observación</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-comment-alt"></i></span>
                                    </div>
                                    <input
                                        type="text"
                                        name="observacion"
                                        id="m_observacion"
                                        class="form-control @error('observacion') is-invalid @enderror"
                                        value="{{ old('observacion') }}"
                                        placeholder="Ej: Frágil, manejar con cuidado"
                                        maxlength="255"
                                        autocomplete="off"
                                    >
                                    @error('observacion')
                                        <div class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i>Opcional. <span id="obs-count-modal">0</span>/255 caract.</small>
                            </div>
                        </div>
 
                    </div>
                </div>
 
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Guardar
                    </button>
                </div>
            </form>
 
        </div>
    </div>
</div>
 
{{-- Modal Eliminar --}}
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle mr-2"></i>Confirmar eliminación</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                ¿Está seguro que desea eliminar la guía N° <strong id="numEliminar"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btnConfirmarEliminar">Eliminar</button>
            </div>
        </div>
    </div>
</div>
 
@stop
 
@push('js')
<script>
    const hoy = new Date().toISOString().split('T')[0];
    document.getElementById('m_fecha_admision').setAttribute('max', hoy);
 
    // Filtrar solo números enteros
    ['m_num_guias', 'm_unidades'].forEach(function(id) {
        document.getElementById(id).addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
        });
    });
 
    // Contador de texto dinámico
    const obsModal = document.getElementById('m_observacion');
    const obsCountModal = document.getElementById('obs-count-modal');
    if (obsModal && obsCountModal) {
        obsModal.addEventListener('input', function() {
            obsCountModal.textContent = this.value.length;
        });
    }
 
    // Scripts para el modal de eliminación
    let formEliminar = null;
    document.querySelectorAll('.btn-eliminar').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.getElementById('numEliminar').textContent = this.getAttribute('data-num');
            formEliminar = this.closest('form');
            $('#modalEliminar').modal('show');
        });
    });
 
    document.getElementById('btnConfirmarEliminar').addEventListener('click', function() {
        if(formEliminar) formEliminar.submit();
    });
 
    // Reabrir modal en caso de error de validación
    @if($errors->any())
        $(document).ready(function() { $('#modalCrear').modal('show'); });
    @endif
 
    // Logo sidebar
    document.addEventListener("DOMContentLoaded", function() {
        const brandLink = document.querySelector(".brand-link");
        if (brandLink) {
            brandLink.innerHTML = `
                <div style="display:flex;align-items:center;gap:10px;">
                    <img src="{{ asset('images/logo-carga.png') }}" alt="Logo" style="width:38px;height:auto;object-fit:contain;">
                    <div style="display:flex;flex-direction:column;line-height:1.2;">
                        <span style="color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:13px;letter-spacing:0.3px;text-transform:uppercase;">Carga y Logística</span>
                        <span style="color:rgba(255,255,255,0.4);font-family:'Plus Jakarta Sans',sans-serif;font-weight:500;font-size:9px;letter-spacing:0.8px;text-transform:uppercase;">Tolima</span>
                    </div>
                </div>
            `;
        }
    });
</script>
@endpush