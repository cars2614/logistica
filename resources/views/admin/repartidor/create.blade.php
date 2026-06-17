@extends('adminlte::page')

@section('title', 'Gestión de Repartidores')

@section('content_header')
    <h1>Gestión de Repartidores</h1>
@stop

@section('content')
    <div class="row">
        {{-- Formulario de Creación (Lado Izquierdo) --}}
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Registrar Nuevo</h3>
                </div>

                <form id="form-crear-repartidor" action="{{ route('admin.repartidor.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        {{-- Nombre --}}
                        <div class="form-group">
                            <label for="name">Nombre Completo <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Ej: Juan Pérez" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Correo Electrónico --}}
                        <div class="form-group">
                            <label for="email">Correo Electrónico <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Ej: juan.perez@logistica.com" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Contraseña con visibilidad --}}
                        <div class="form-group">
                            <label for="password">Contraseña <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mínimo 8 caracteres" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <i class="fas fa-eye" id="eyeIcon"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" style="display: block;" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary" id="btn-submit">
                            <i class="fas fa-save mr-1"></i> Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tabla de Repartidores Registrados (Lado Derecho) --}}
        <div class="col-md-8">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Repartidores Registrados</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead class="bg-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Pendientes</th>
                                <th>Entregadas</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($repartidores as $repartidor)
                                <tr>
                                    <td><strong>{{ $repartidor->name }}</strong></td>
                                    <td>{{ $repartidor->email }}</td>
                                    <td>
                                        <span class="badge badge-warning text-dark px-2 py-1">
                                            {{ $repartidor->guias_pendientes_count }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-success px-2 py-1">
                                            {{ $repartidor->guias_entregadas_count }}
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-dark btn-reset-password" 
                                            data-id="{{ $repartidor->id }}" 
                                            data-name="{{ $repartidor->name }}" 
                                            data-toggle="modal" 
                                            data-target="#modalPassword">
                                            <i class="fas fa-key mr-1"></i> Credenciales
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No hay repartidores registrados aún.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal para Cambiar Contraseña --}}
    <div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title"><i class="fas fa-key mr-2"></i> Cambiar Credenciales</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-reset-password" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <p>Actualizar contraseña para: <strong id="modal-repartidor-name" class="text-primary"></strong></p>

                        <div class="form-group">
                            <label>Nueva Contraseña <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" name="password" id="reset_password" class="form-control" placeholder="Mínimo 8 caracteres" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" id="toggleResetPassword">
                                        <i class="fas fa-eye" id="eyeResetIcon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Confirmar Contraseña <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" id="reset_password_confirmation" class="form-control" placeholder="Repite la contraseña" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" id="toggleResetPasswordConfirm">
                                        <i class="fas fa-eye" id="eyeResetConfirmIcon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Actualizar Credenciales</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Visibilidad Contraseña Formulario Principal
        document.getElementById('togglePassword').addEventListener('click', function () {
            toggleVisibilidad('password', 'eyeIcon');
        });

        // Visibilidad Contraseña Reset
        document.getElementById('toggleResetPassword').addEventListener('click', function () {
            toggleVisibilidad('reset_password', 'eyeResetIcon');
        });

        // Visibilidad Contraseña Reset Confirmación
        document.getElementById('toggleResetPasswordConfirm').addEventListener('click', function () {
            toggleVisibilidad('reset_password_confirmation', 'eyeResetConfirmIcon');
        });

        function toggleVisibilidad(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        // Cargar datos en el Modal
        $('.btn-reset-password').on('click', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            $('#modal-repartidor-name').text(name);
            
            // Reemplazar la URL base con el ID correspondiente
            let actionUrl = "{{ url('admin/repartidores') }}/" + id + "/password";
            $('#form-reset-password').attr('action', actionUrl);
            
            // Limpiar inputs
            $('#reset_password').val('');
            $('#reset_password_confirmation').val('');
        });

        // SweetAlert2
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33'
            });
        @endif

        // Prevención de doble envío
        document.getElementById('form-crear-repartidor').addEventListener('submit', function() {
            const btnSubmit = document.getElementById('btn-submit');
            btnSubmit.disabled = true;
            btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Guardando...';
        });
        document.getElementById('form-reset-password').addEventListener('submit', function() {
            const btnSubmit = this.querySelector('button[type="submit"]');
            btnSubmit.disabled = true;
            btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Actualizando...';
        });
    </script>
@stop
