@extends('adminlte::page')

@section('title', 'Guías')

@section('content_header')
    <h1>Gestión de Guías</h1>
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
                        <th>#</th>
                        <th>N° Guía</th>
                        <th>Cliente</th>
                        <th>Tipo Entrega</th>
                        <th>Volumen</th>
                        <th>Peso</th>
                        <th>Precio</th>
                        <th>Unidades</th>
                        <th>Fecha Admisión</th>
                        <th>Observación</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($guias as $guia)
                        <tr>
                            <td>{{ $guia->id_guias }}</td>
                            <td>{{ $guia->num_guias }}</td>
                            <td>{{ $guia->cliente->nombre ?? '—' }}</td>
                            <td>{{ $guia->tipoEntrega->nombre ?? '—' }}</td>
                            <td>{{ number_format($guia->volumen, 2) }}</td>
                            <td>{{ number_format($guia->peso, 2) }}</td>
                            <td>${{ number_format($guia->precio, 2) }}</td>
                            <td>{{ $guia->unidades }}</td>
                            <td>{{ \Carbon\Carbon::parse($guia->fecha_admision)->format('d/m/Y') }}</td>
                            <td>{{ $guia->observacion ?? '—' }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.guia.edit', $guia->id_guias) }}"
                                   class="btn btn-warning btn-xs" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.guia.destroy', $guia->id_guias) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Eliminar esta guía?')">
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
                            <td colspan="11" class="text-center text-muted py-3">No hay guías registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($guias->hasPages())
        <div class="card-footer">
            {{ $guias->links() }}
        </div>
    @endif
</div>

{{-- Modal Crear Guía --}}
<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="modalCrearLabel" aria-hidden="true">
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

                        {{-- Número de guía --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="num_guias">N° de Guía <span class="text-danger">*</span></label>
                                <input type="number" name="num_guias" id="num_guias"
                                       class="form-control @error('num_guias') is-invalid @enderror"
                                       value="{{ old('num_guias') }}" min="1" required>
                                @error('num_guias')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Fecha de admisión --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_admision">Fecha de Admisión <span class="text-danger">*</span></label>
                                <input type="date" name="fecha_admision" id="fecha_admision"
                                       class="form-control @error('fecha_admision') is-invalid @enderror"
                                       value="{{ old('fecha_admision') }}" required>
                                @error('fecha_admision')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Cliente --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cliente_id">Cliente <span class="text-danger">*</span></label>
                                <select name="cliente_id" id="cliente_id"
                                        class="form-control @error('cliente_id') is-invalid @enderror" required>
                                    <option value="">-- Seleccionar cliente --</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}"
                                            {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('cliente_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Tipo de Entrega --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_entrega_id">Tipo de Entrega <span class="text-danger">*</span></label>
                                <select name="tipo_entrega_id" id="tipo_entrega_id"
                                        class="form-control @error('tipo_entrega_id') is-invalid @enderror" required>
                                    <option value="">-- Seleccionar tipo --</option>
                                    @foreach($tipoEntregas as $tipo)
                                        <option value="{{ $tipo->id }}"
                                            {{ old('tipo_entrega_id') == $tipo->id ? 'selected' : '' }}>
                                            {{ $tipo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tipo_entrega_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Volumen --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="volumen">Volumen <span class="text-danger">*</span></label>
                                <input type="number" name="volumen" id="volumen"
                                       class="form-control @error('volumen') is-invalid @enderror"
                                       value="{{ old('volumen') }}" step="0.01" min="0" required>
                                @error('volumen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Peso --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="peso">Peso <span class="text-danger">*</span></label>
                                <input type="number" name="peso" id="peso"
                                       class="form-control @error('peso') is-invalid @enderror"
                                       value="{{ old('peso') }}" step="0.01" min="0" required>
                                @error('peso')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Unidades --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="unidades">Unidades <span class="text-danger">*</span></label>
                                <input type="number" name="unidades" id="unidades"
                                       class="form-control @error('unidades') is-invalid @enderror"
                                       value="{{ old('unidades') }}" min="1" required>
                                @error('unidades')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Precio --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="precio">Precio <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" name="precio" id="precio"
                                           class="form-control @error('precio') is-invalid @enderror"
                                           value="{{ old('precio') }}" step="0.01" min="0" required>
                                    @error('precio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Observación --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="observacion">Observación</label>
                                <input type="text" name="observacion" id="observacion"
                                       class="form-control @error('observacion') is-invalid @enderror"
                                       value="{{ old('observacion') }}" maxlength="255">
                                @error('observacion')
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
    {{-- Reabrir modal si hubo errores de validación --}}
    @if($errors->any())
        $(document).ready(function () {
            $('#modalCrear').modal('show');
        });
    @endif
</script>
@stop