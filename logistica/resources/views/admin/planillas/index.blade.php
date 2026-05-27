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

            <form action="{{ route('admin.planilla.store') }}" method="POST">
                @csrf
                <div class="modal-body">
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
                                            {{ old('guia_id') == $guia->id_guias ? 'selected' : '' }}>
                                            N° {{ $guia->num_guias }}
                                            — {{ $guia->cliente->nombre ?? 'Sin cliente' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('guia_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
                                            {{ old('ruta_id') == $ruta->id ? 'selected' : '' }}>
                                            {{ $ruta->nombre ?? 'Ruta #' . $ruta->id }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ruta_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Destinatario --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="destinatario">Destinatario <span class="text-danger">*</span></label>
                                <input type="text" name="destinatario" id="destinatario"
                                       class="form-control @error('destinatario') is-invalid @enderror"
                                       value="{{ old('destinatario') }}" maxlength="255" required>
                                @error('destinatario')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Dirección --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion">Dirección <span class="text-danger">*</span></label>
                                <input type="text" name="direccion" id="direccion"
                                       class="form-control @error('direccion') is-invalid @enderror"
                                       value="{{ old('direccion') }}" maxlength="255" required>
                                @error('direccion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Destino --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="destino">Destino <span class="text-danger">*</span></label>
                                <input type="text" name="destino" id="destino"
                                       class="form-control @error('destino') is-invalid @enderror"
                                       value="{{ old('destino') }}" maxlength="255" required>
                                @error('destino')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Departamento --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="departamento">Departamento <span class="text-danger">*</span></label>
                                <input type="text" name="departamento" id="departamento"
                                       class="form-control @error('departamento') is-invalid @enderror"
                                       value="{{ old('departamento') }}" maxlength="255" required>
                                @error('departamento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Entidad --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="entidad">Entidad <span class="text-danger">*</span></label>
                                <input type="text" name="entidad" id="entidad"
                                       class="form-control @error('entidad') is-invalid @enderror"
                                       value="{{ old('entidad') }}" maxlength="255" required>
                                @error('entidad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Servicio --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="servicio">Servicio <span class="text-danger">*</span></label>
                                <input type="text" name="servicio" id="servicio"
                                       class="form-control @error('servicio') is-invalid @enderror"
                                       value="{{ old('servicio') }}" maxlength="255" required>
                                @error('servicio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Piezas --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="piezas">Piezas <span class="text-danger">*</span></label>
                                <input type="number" name="piezas" id="piezas"
                                       class="form-control @error('piezas') is-invalid @enderror"
                                       value="{{ old('piezas') }}" min="0" required>
                                @error('piezas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Kilos --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kilos">Kilos <span class="text-danger">*</span></label>
                                <input type="number" name="kilos" id="kilos"
                                       class="form-control @error('kilos') is-invalid @enderror"
                                       value="{{ old('kilos') }}" step="0.01" min="0" required>
                                @error('kilos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Operador --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="opedor">Operador <span class="text-danger">*</span></label>
                                <input type="text" name="opedor" id="opedor"
                                       class="form-control @error('opedor') is-invalid @enderror"
                                       value="{{ old('opedor') }}" maxlength="255" required>
                                @error('opedor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Comentario --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="comentario">Comentario <span class="text-danger">*</span></label>
                                <textarea name="comentario" id="comentario" rows="2"
                                          class="form-control @error('comentario') is-invalid @enderror"
                                          maxlength="255" required>{{ old('comentario') }}</textarea>
                                @error('comentario')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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

@stop

@section('js')
<script>
    @if($errors->any())
        $(document).ready(function () {
            $('#modalCrear').modal('show');
        });
    @endif
</script>
@stop