{{-- resources/views/admin/guia/index.blade.php --}}

@extends('adminlte::page')

@section('title', 'Guías')

@section('content_header')
    <h1>Gestión de Guías</h1>
@stop

{{-- ESTILOS EXCLUSIVOS PARA REPARAR LOS INPUTS PLANOS DEL MODAL DE GUÍAS --}}
@section('css')
    <style>
        /* Forzar a que todos los campos del modal tengan su borde gris y fondo blanco completo */
        #modalCrear .form-control,
        #modalCrear select.form-control,
        #modalCrear .input-group-text {
            border: 1px solid #ced4da !important;
            border-radius: 0.25rem !important;
            background-color: #ffffff !important;
            color: #495057 !important;
            height: calc(2.25rem + 2px) !important;
            padding: 0.375rem 0.75rem !important;
        }

        /* Ajustar el prefijo de los iconos para que no se desfasen ni queden planos */
        #modalCrear .input-group-prepend .input-group-text {
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
            border-right: none !important;
        }

        #modalCrear .input-group>.form-control,
        #modalCrear .input-group>select.form-control {
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
        }

        /* Efecto de borde azul clásico al hacer clic (Focus) */
        #modalCrear .form-control:focus {
            border-color: #80bdff !important;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
        }

        /* Separación correcta entre filas del formulario */
        #modalCrear .form-group {
            margin-bottom: 1.25rem !important;
        }

        #modalCrear .form-text {
            margin-top: 0.3rem !important;
            display: block !important;
        }

        /* Select2 CSS Bootstrap 4 Theme */
        .select2-container--bootstrap4 .select2-selection--single {
            height: calc(2.25rem + 2px) !important;
        }
    </style>
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
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
                            <th>Repartidor</th>
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
                                
                                <td>{{ $guia->repartidor->name ?? 'Sin asignar' }}</td>
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


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Repartidor Asignado (Opcional)</label>
                                    <select name="id_repartidor" class="form-control select2" style="width: 100%;">
                                        <option value="">Sin asignar...</option>
                                        @foreach ($repartidores as $repartidor)
                                            <option value="{{ $repartidor->id }}">
                                                {{ $repartidor->name }} ({{ $repartidor->email }})
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
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cliente Destino</label>

                                    <select name="id_cliente_destino" class="form-control" required>

                                        <option value="">Seleccione...</option>

                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">
                                                {{ $cliente->cedula }}  {{ $cliente->nombre }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Unidades</label>
                                    <input type="number" name="unidades" class="form-control"
                                        value="{{ old('unidades', 1) }}" min="1">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Peso (Kg)</label>
                                    <input type="number" name="peso" class="form-control" value="{{ old('peso', 1) }}"
                                        step="0.01">
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Largo (cm)</label>
                                    <input type="number" name="largo" class="form-control"
                                        value="{{ old('largo', 1) }}" step="0.01">
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Ancho (cm)</label>
                                    <input type="number" name="ancho" class="form-control"
                                        value="{{ old('ancho', 1) }}" step="0.01">
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Alto (cm)</label>
                                    <input type="number" name="alto" class="form-control"
                                        value="{{ old('alto', 1) }}" step="0.01">
                                </div>
                            </div>





                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Precio Envío</label>
                                    <input type="number" name="precio_envio" class="form-control"
                                        value="{{ old('precio_envio', 9800) }}" step="0.01">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Valor Declarado</label>
                                    <input type="number" name="valor_declarado" class="form-control"
                                        value="{{ old('valor_declarado', 20000) }}" step="0.01">
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Observación</label>

                                    <textarea name="observacion" rows="3" class="form-control">{{ old('observacion') }}</textarea>
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
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4',
                dropdownParent: $('#modalCrear'),
                placeholder: 'Buscar repartidor por nombre...',
                allowClear: true
            });
        });

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
            if (formEliminar) formEliminar.submit();
        });

        // Reabrir modal en caso de error de validación
        @if ($errors->any())
            $(document).ready(function() {
                $('#modalCrear').modal('show');
            });
        @endif
    </script>
@endpush
