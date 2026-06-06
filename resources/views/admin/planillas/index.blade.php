{{-- resources/views/admin/planillas/index.blade.php --}}

@extends('adminlte::page')

@section('title', 'Planillas de Transporte')

@section('content_header')
    <div class="container-fluid pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
            <h1 class="m-0 font-weight-bold text-secondary">
                <i class="fas fa-file-invoice-dollar text-primary mr-2"></i>Planillas de Transporte
            </h1>
            <ol class="breadcrumb m-0 bg-transparent p-0">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Planillas</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
<div class="container-fluid pb-4">

    {{-- Alertas de Éxito y Error --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mt-2" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle mr-2 fa-lg"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mt-2" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-triangle mr-2 fa-lg"></i>
                <div>
                    <strong class="d-block mb-1">Por favor corrige los errores del formulario:</strong>
                    <ul class="mb-0 pl-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>
    @endif

    {{-- Tabla de Contenido --}}
    <div class="row mt-3">
        <div class="col-12">
            <div class="card card-outline card-primary shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <h3 class="card-title font-weight-bold text-dark mb-0">
                        <i class="fas fa-list text-primary mr-2"></i>Listado de Planillas
                    </h3>
                    <div class="card-tools d-flex align-items-center" style="gap: 10px;">
                        <button class="btn btn-primary btn-sm font-weight-bold shadow-sm px-3" data-toggle="modal" data-target="#modalCrearPlanilla">
                            <i class="fas fa-plus mr-1"></i> Nueva Planilla
                        </button>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light border-bottom text-secondary">
                                <tr>
                                    <th width="10%" class="text-center font-weight-bold border-0"># ID</th>
                                    <th width="25%" class="font-weight-bold border-0">N° Planilla</th>
                                    <th width="25%" class="font-weight-bold border-0">Ruta de Destino</th>
                                    <th width="15%" class="text-center font-weight-bold border-0">Piezas</th>
                                    <th width="15%" class="text-center font-weight-bold border-0">Kilos</th>
                                    <th width="10%" class="text-center font-weight-bold border-0">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($planillas as $planilla)
                                    <tr class="align-middle">
                                        <td class="text-center align-middle font-weight-bold text-muted">{{ $planilla->id }}</td>
                                        <td class="align-middle">
                                            <span class="badge badge-success px-2 py-1 shadow-sm font-weight-bold">
                                                {{ $planilla->numero_planilla ?? 'Sin número' }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-dark font-weight-bold">
                                            {{ $planilla->ruta->nombre ?? 'Ruta #'.$planilla->id_ruta }}
                                        </td>
                                        <td class="text-center align-middle text-secondary font-weight-bold">
                                            {{ $planilla->piezas }}
                                        </td>
                                        <td class="text-center align-middle text-secondary font-weight-bold">
                                            {{ $planilla->kilos }} kg
                                        </td>
                                        <td class="text-center align-middle">
                                            <form action="{{ route('admin.planilla.destroy', $planilla->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger shadow-sm" title="Eliminar" onclick="return confirm('¿Seguro que desea eliminar esta planilla?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-5 bg-white">
                                            <i class="fas fa-folder-open fa-3x mb-3 text-muted" style="opacity: 0.5;"></i>
                                            <p class="mb-0 font-weight-bold">No hay planillas registradas.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                @if($planillas->hasPages())
                    <div class="card-footer bg-white border-top py-3">
                        <div class="d-flex justify-content-center">{{ $planillas->links() }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Modal Crear Planilla COMPLETO Y CORREGIDO --}}
<div class="modal fade" id="modalCrearPlanilla" tabindex="-1" role="dialog" aria-labelledby="modalCrearPlanillaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <form action="{{ route('admin.planilla.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white py-3">
                    <h5 class="modal-title font-weight-bold mb-0" id="modalCrearPlanillaLabel">
                        <i class="fas fa-plus-circle mr-2"></i>Nueva Planilla
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">

                        {{-- Input Select de Guías (CORREGIDO CON CLIENTE ORIGEN) --}}
                        <div class="col-md-6 form-group mb-3">
                            <label for="crear_guia_id" class="font-weight-bold text-secondary mb-1">Guía <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-file-invoice"></i></span>
                                </div>
                                <select 
                                    name="guia_id" 
                                    id="crear_guia_id" 
                                    class="form-control border-left-0 @error('guia_id') is-invalid @enderror" 
                                    required
                                >
                                    <option value="">-- Seleccionar guía --</option>
                                    @foreach($guias as $guia)
                                        <option value="{{ $guia->id }}" {{ old('guia_id') == $guia->id ? 'selected' : '' }}>
                                            N° {{ $guia->num_guias }} — {{ $guia->clienteOrigen->nombre ?? 'Cliente Registrado' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('guia_id')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <small class="form-text text-muted mt-1"><i class="fas fa-info-circle mr-1"></i>Muestra el N° de guía y su remitente original.</small>
                        </div>

                        {{-- Input Select de Rutas --}}
                        <div class="col-md-6 form-group mb-3">
                            <label for="crear_ruta_id" class="font-weight-bold text-secondary mb-1">Ruta <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-map-marked-alt"></i></span>
                                </div>
                                <select 
                                    name="ruta_id" 
                                    id="crear_ruta_id" 
                                    class="form-control border-left-0 @error('ruta_id') is-invalid @enderror" 
                                    required
                                >
                                    <option value="">-- Seleccionar ruta --</option>
                                    @foreach($rutas as $ruta)
                                        <option value="{{ $ruta->id }}" {{ old('ruta_id') == $ruta->id ? 'selected' : '' }}>
                                            {{ $ruta->nombre ?? 'Ruta #'.$ruta->id }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ruta_id')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Input Destinatario --}}
                        <div class="col-md-6 form-group mb-3">
                            <label for="destinatario" class="font-weight-bold text-secondary mb-1">Destinatario <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="destinatario" id="destinatario" class="form-control border-left-0" placeholder="Ej: Juan Pérez" value="{{ old('destinatario') }}" required>
                            </div>
                        </div>

                        {{-- Input Dirección --}}
                        <div class="col-md-6 form-group mb-3">
                            <label for="direccion" class="font-weight-bold text-secondary mb-1">Dirección <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-map-marker-alt"></i></span>
                                </div>
                                <input type="text" name="direccion" id="direccion" class="form-control border-left-0" placeholder="Ej: Calle 15 # 20-30" value="{{ old('direccion') }}" required>
                            </div>
                        </div>

                        {{-- Input Destino --}}
                        <div class="col-md-6 form-group mb-3">
                            <label for="destino" class="font-weight-bold text-secondary mb-1">Ciudad Destino <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-city"></i></span>
                                </div>
                                <input type="text" name="destino" id="destino" class="form-control border-left-0" placeholder="Ej: Bogotá" value="{{ old('destino') }}" required>
                            </div>
                        </div>

                        {{-- Input Departamento --}}
                        <div class="col-md-6 form-group mb-3">
                            <label for="departamento" class="font-weight-bold text-secondary mb-1">Departamento <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-globe"></i></span>
                                </div>
                                <input type="text" name="departamento" id="departamento" class="form-control border-left-0" placeholder="Ej: Cundinamarca" value="{{ old('departamento') }}" required>
                            </div>
                        </div>

                        {{-- Input Entidad --}}
                        <div class="col-md-6 form-group mb-3">
                            <label for="entidad" class="font-weight-bold text-secondary mb-1">Entidad / Empresa <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-building"></i></span>
                                </div>
                                <input type="text" name="entidad" id="entidad" class="form-control border-left-0" placeholder="Ej: Empresa XYZ S.A.S" value="{{ old('entidad') }}" required>
                            </div>
                        </div>

                        {{-- Input Servicio --}}
                        <div class="col-md-6 form-group mb-3">
                            <label for="servicio" class="font-weight-bold text-secondary mb-1">Servicio <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-concierge-bell"></i></span>
                                </div>
                                <input type="text" name="servicio" id="servicio" class="form-control border-left-0" placeholder="Ej: Entrega Express" value="{{ old('servicio') }}" required>
                            </div>
                        </div>

                        {{-- Input Piezas --}}
                        <div class="col-md-4 form-group mb-3">
                            <label for="piezas" class="font-weight-bold text-secondary mb-1">Piezas <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-boxes"></i></span>
                                </div>
                                <input type="number" name="piezas" id="piezas" class="form-control border-left-0" min="1" placeholder="5" value="{{ old('piezas') }}" required>
                            </div>
                        </div>

                        {{-- Input Kilos --}}
                        <div class="col-md-4 form-group mb-3">
                            <label for="kilos" class="font-weight-bold text-secondary mb-1">Kilos <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-weight-hanging"></i></span>
                                </div>
                                <input type="number" step="0.01" name="kilos" id="kilos" class="form-control border-left-0" placeholder="2.50" value="{{ old('kilos') }}" required>
                            </div>
                        </div>

                        {{-- Input Operador --}}
                        <div class="col-md-4 form-group mb-3">
                            <label for="operador" class="font-weight-bold text-secondary mb-1">Operador <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-id-badge"></i></span>
                                </div>
                                <input type="text" name="operador" id="operador" class="form-control border-left-0" placeholder="Ej: Carlos López" value="{{ old('operador') }}" required>
                            </div>
                        </div>

                        {{-- Input Comentario --}}
                        <div class="col-md-12 form-group mb-0">
                            <label for="comentario" class="font-weight-bold text-secondary mb-1">Comentario</label>
                            <textarea name="comentario" id="comentario" class="form-control" rows="2" placeholder="Opcional. Datos adicionales de entrega...">{{ old('comentario') }}</textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0 py-3">
                    <button type="button" class="btn btn-outline-secondary font-weight-bold" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">Guardar Planilla</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    @if ($errors->any())
        $(document).ready(function () {
            $('#modalCrearPlanilla').modal('show');
        });
    @endif

    setTimeout(function () {
        $('.alert-dismissible').fadeOut('slow');
    }, 4000);
</script>
@stop