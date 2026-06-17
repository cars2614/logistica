@extends('adminlte::page')

@section('title', 'Gestión de Repartidores')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center header-dashboard-container">
        <h1 class="text-white font-weight-bold dashboard-title-main">
            <i class="fas fa-motorcycle mr-2" style="color: #0EA5E9;"></i>Gestión de Repartidores
        </h1>
    </div>
@stop

@section('content')
    <div class="row">
        {{-- Formulario de Creación (Lado Izquierdo) --}}
        <div class="col-md-4">
            <div class="card card-custom-premium">
                <div class="card-header-premium">
                    <h3 class="card-title-premium">
                        <i class="fas fa-user-plus mr-2" style="color: #10B981;"></i>Registrar Nuevo
                    </h3>
                </div>

                <form id="form-crear-repartidor" action="{{ route('admin.repartidor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body-premium">
                        {{-- Nombre --}}
                        <div class="form-group">
                            <label for="name" class="premium-label">Nombre Completo <span class="text-danger">*</span></label>
                            <div class="input-group premium-input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="name" id="name" class="form-control premium-input @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Ej: Juan Pérez" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Correo Electrónico --}}
                        <div class="form-group">
                            <label for="email" class="premium-label">Correo Electrónico <span class="text-danger">*</span></label>
                            <div class="input-group premium-input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" id="email" class="form-control premium-input @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Ej: juan.perez@logistica.com" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Cédula --}}
                        <div class="form-group">
                            <label for="cedula" class="premium-label">Cédula / ID <span class="text-danger">*</span></label>
                            <div class="input-group premium-input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <input type="text" name="cedula" id="cedula" class="form-control premium-input @error('cedula') is-invalid @enderror" value="{{ old('cedula') }}" placeholder="Ej: 0912345678" required>
                                @error('cedula')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Número Telefónico --}}
                        <div class="form-group">
                            <label for="numero_telefonico" class="premium-label">Teléfono <span class="text-danger">*</span></label>
                            <div class="input-group premium-input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" name="numero_telefonico" id="numero_telefonico" class="form-control premium-input @error('numero_telefonico') is-invalid @enderror" value="{{ old('numero_telefonico') }}" placeholder="Ej: 0998765432" required>
                                @error('numero_telefonico')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Licencia --}}
                        <div class="form-group">
                            <label for="licencia" class="premium-label">Licencia <span class="text-danger">*</span></label>
                            <div class="input-group premium-input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
                                </div>
                                <input type="text" name="licencia" id="licencia" class="form-control premium-input @error('licencia') is-invalid @enderror" value="{{ old('licencia') }}" placeholder="Ej: Tipo B" required>
                                @error('licencia')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Foto de Perfil --}}
                        <div class="form-group">
                            <label for="foto_perfil" class="premium-label">Foto de Perfil</label>
                            <div class="input-group premium-input-group">
                                <div class="custom-file">
                                    <input type="file" name="foto_perfil" id="foto_perfil" class="custom-file-input premium-input @error('foto_perfil') is-invalid @enderror" accept="image/*">
                                    <label class="custom-file-label premium-file-label" for="foto_perfil" data-browse="Examinar">Seleccionar Archivo...</label>
                                </div>
                                @error('foto_perfil')
                                    <span class="invalid-feedback" role="alert" style="display:block;"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Contraseña con visibilidad --}}
                        <div class="form-group mb-0">
                            <label for="password" class="premium-label">Contraseña <span class="text-danger">*</span></label>
                            <div class="input-group premium-input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" name="password" id="password" class="form-control premium-input @error('password') is-invalid @enderror" placeholder="Mínimo 8 caracteres" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-premium-icon" id="togglePassword">
                                        <i class="fas fa-eye" id="eyeIcon"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" style="display: block;" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer-premium">
                        <button type="submit" class="btn premium-btn-submit w-100" id="btn-submit">
                            <i class="fas fa-save mr-2"></i> Registrar Repartidor
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tabla de Repartidores Registrados (Lado Derecho) --}}
        <div class="col-md-8">
            <div class="card card-custom-premium">
                <div class="card-header-premium">
                    <h3 class="card-title-premium">
                        <i class="fas fa-list-ul mr-2" style="color: #6366F1;"></i>Directorio de Repartidores
                    </h3>
                </div>
                <div class="table-responsive table-responsive-cards p-0">
                    <table class="table table-premium text-nowrap m-0">
                        <thead>
                            <tr>
                                <th>Conductor</th>
                                <th>Vehículo</th>
                                <th class="text-center">Guías</th>
                                <th class="text-right" style="padding-right: 24px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($repartidores as $repartidor)
                                <tr>
                                    <td data-label="Conductor">
                                        <div class="d-flex align-items-center">
                                            @if($repartidor->repartidor && $repartidor->repartidor->foto_perfil)
                                                <img src="{{ Storage::url($repartidor->repartidor->foto_perfil) }}" alt="Foto" class="img-circle img-avatar mr-3">
                                            @else
                                                <div class="avatar-placeholder mr-3">
                                                    <i class="fas fa-user text-white"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="mb-0 font-weight-bold text-white">{{ $repartidor->name }}</h6>
                                                <small class="text-muted d-block mb-1">{{ $repartidor->email }}</small>
                                                @if($repartidor->repartidor)
                                                    <span class="text-xs" style="color: #0EA5E9;"><i class="fas fa-phone-alt mr-1"></i>{{ $repartidor->repartidor->numero_telefonico }}</span>
                                                    <span class="text-xs text-secondary ml-2"><i class="fas fa-id-card mr-1"></i>{{ $repartidor->repartidor->cedula }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Vehículo">
                                        @if($repartidor->repartidor && $repartidor->repartidor->vehiculo)
                                            <div class="vehicle-badge text-white">
                                                <i class="fas fa-truck" style="color: #10B981;"></i> {{ $repartidor->repartidor->vehiculo->placa }}
                                            </div>
                                        @else
                                            <span class="badge-status-premium" style="color: #94A3B8; border-color: rgba(255,255,255,0.1); background: rgba(255,255,255,0.02);">
                                                <i class="fas fa-exclamation-circle mr-1"></i> Sin Asignar
                                            </span>
                                        @endif
                                    </td>
                                    <td data-label="Guías" class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <span class="badge-status-premium" style="color: #F59E0B; border-color: rgba(245, 158, 11, 0.25); background: rgba(245, 158, 11, 0.12);" title="Pendientes" data-toggle="tooltip">
                                                <i class="fas fa-clock mr-1"></i> {{ $repartidor->guias_pendientes_count }}
                                            </span>
                                            <span class="badge-status-premium ml-2" style="color: #10B981; border-color: rgba(16, 185, 129, 0.25); background: rgba(16, 185, 129, 0.12);" title="Entregadas" data-toggle="tooltip">
                                                <i class="fas fa-check mr-1"></i> {{ $repartidor->guias_entregadas_count }}
                                            </span>
                                        </div>
                                    </td>
                                    <td data-label="Acciones" class="text-right" style="padding-right: 24px;">
                                        <div class="btn-group premium-btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-info btn-assign-vehicle" 
                                                data-id="{{ $repartidor->id }}" 
                                                data-name="{{ $repartidor->name }}" 
                                                data-vehiculo="{{ $repartidor->repartidor ? $repartidor->repartidor->id_vehiculo : '' }}"
                                                data-toggle="modal" 
                                                data-target="#modalVehicle" title="Asignar Vehículo">
                                                <i class="fas fa-car-side"></i>
                                            </button>
                                            
                                            <button type="button" class="btn btn-sm btn-outline-primary btn-edit-repartidor" 
                                                data-id="{{ $repartidor->id }}" 
                                                data-name="{{ $repartidor->name }}" 
                                                data-email="{{ $repartidor->email }}" 
                                                data-cedula="{{ $repartidor->repartidor ? $repartidor->repartidor->cedula : '' }}" 
                                                data-telefono="{{ $repartidor->repartidor ? $repartidor->repartidor->numero_telefonico : '' }}" 
                                                data-licencia="{{ $repartidor->repartidor ? $repartidor->repartidor->licencia : '' }}" 
                                                data-toggle="modal" 
                                                data-target="#modalEdit" title="Editar Datos">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <button type="button" class="btn btn-sm btn-outline-secondary btn-reset-password" 
                                                data-id="{{ $repartidor->id }}" 
                                                data-name="{{ $repartidor->name }}" 
                                                data-toggle="modal" 
                                                data-target="#modalPassword" title="Cambiar Contraseña">
                                                <i class="fas fa-key"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-inbox fa-3x mb-3 text-secondary"></i>
                                            <h5>No hay repartidores registrados aún</h5>
                                            <p style="opacity: 0.6;">Utiliza el formulario de la izquierda para registrar al primero.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal para Asignar Vehículo --}}
    <div class="modal fade dark-modal" id="modalVehicle" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content premium-modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold text-white"><i class="fas fa-car-side mr-2" style="color: #0EA5E9;"></i> Asignar Vehículo</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-assign-vehicle" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="alert premium-alert mb-4">
                            <i class="fas fa-user-tag mr-2" style="color: #0EA5E9;"></i> Repartidor seleccionado: <strong id="modal-vehicle-name" class="text-white"></strong>
                        </div>

                        <div class="form-group">
                            <label class="premium-label">Seleccionar Vehículo <span class="text-danger">*</span></label>
                            <select name="id_vehiculo" id="select_vehiculo" class="form-control premium-input" required>
                                <option value="">-- Quitar Asignación / Ninguno --</option>
                                @foreach($vehiculos as $v)
                                    <option value="{{ $v->id }}">🚘 {{ $v->placa }} - {{ $v->marca }} {{ $v->modelo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-outline-secondary rounded-lg" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn premium-btn-submit"><i class="fas fa-save mr-1"></i> Confirmar Asignación</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal para Editar Repartidor --}}
    <div class="modal fade dark-modal" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content premium-modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold text-white"><i class="fas fa-user-edit mr-2" style="color: #10B981;"></i> Editar Datos de Repartidor</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-edit-repartidor" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="premium-label">Nombre Completo <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="edit_name" class="form-control premium-input" required>
                                </div>
                                <div class="form-group">
                                    <label class="premium-label">Correo Electrónico <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="edit_email" class="form-control premium-input" required>
                                </div>
                                <div class="form-group">
                                    <label class="premium-label">Cédula <span class="text-danger">*</span></label>
                                    <input type="text" name="cedula" id="edit_cedula" class="form-control premium-input" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="premium-label">Teléfono <span class="text-danger">*</span></label>
                                    <input type="text" name="numero_telefonico" id="edit_telefono" class="form-control premium-input" required>
                                </div>
                                <div class="form-group">
                                    <label class="premium-label">Licencia <span class="text-danger">*</span></label>
                                    <input type="text" name="licencia" id="edit_licencia" class="form-control premium-input" required>
                                </div>
                                <div class="form-group">
                                    <label class="premium-label">Actualizar Foto de Perfil</label>
                                    <div class="custom-file">
                                        <input type="file" name="foto_perfil" id="edit_foto_perfil" class="custom-file-input premium-input" accept="image/*">
                                        <label class="custom-file-label premium-file-label" for="edit_foto_perfil" data-browse="Examinar">Elegir nueva...</label>
                                    </div>
                                    <small class="text-muted mt-2 d-block"><i class="fas fa-info-circle" style="color: #0EA5E9;"></i> Dejar vacío para mantener la actual.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-outline-secondary rounded-lg" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn premium-btn-submit" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); border-color: #059669;"><i class="fas fa-sync-alt mr-1"></i> Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal para Cambiar Contraseña --}}
    <div class="modal fade dark-modal" id="modalPassword" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content premium-modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold text-white"><i class="fas fa-shield-alt mr-2" style="color: #F59E0B;"></i> Cambiar Credenciales</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-reset-password" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="alert premium-alert mb-4">
                            <i class="fas fa-user-lock mr-2" style="color: #F59E0B;"></i> Actualizar contraseña para: <strong id="modal-repartidor-name" class="text-white"></strong>
                        </div>

                        <div class="form-group">
                            <label class="premium-label">Nueva Contraseña <span class="text-danger">*</span></label>
                            <div class="input-group premium-input-group">
                                <input type="password" name="password" id="reset_password" class="form-control premium-input" placeholder="Mínimo 8 caracteres" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-premium-icon" id="toggleResetPassword">
                                        <i class="fas fa-eye" id="eyeResetIcon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <label class="premium-label">Confirmar Contraseña <span class="text-danger">*</span></label>
                            <div class="input-group premium-input-group">
                                <input type="password" name="password_confirmation" id="reset_password_confirmation" class="form-control premium-input" placeholder="Repite la contraseña" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-premium-icon" id="toggleResetPasswordConfirm">
                                        <i class="fas fa-eye" id="eyeResetConfirmIcon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-outline-secondary rounded-lg" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn premium-btn-submit" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); border-color: #D97706;"><i class="fas fa-key mr-1"></i> Actualizar Seguridad</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        /* ── FONDO GLOBAL (Integración con Dashboard) ── */
        .content-wrapper {
            background-color: #0A0F1E !important;
            font-family: 'Inter', sans-serif;
        }

        /* ── TIPOGRAFÍA Y TEXTOS GLOBALES ── */
        .header-dashboard-container {
            margin-bottom: 20px; 
            padding: 10px 15px; 
            position: relative; 
            z-index: 5;
        }
        .dashboard-title-main {
            font-size: 24px; 
            letter-spacing: -0.02em;
        }

        /* ── TARJETAS (CARDS) ── */
        .card-custom-premium {
            background: rgba(13, 19, 35, 0.65) !important; 
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            margin-bottom: 24px;
            overflow: hidden;
            color: #fff;
        }
        .card-header-premium {
            padding: 20px 24px;
            background: transparent;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            display: flex; align-items: center; justify-content: space-between;
        }
        .card-title-premium {
            font-size: 16px; font-weight: 600;
            color: #ffffff; margin: 0;
            display: flex; align-items: center; gap: 8px;
        }
        .card-body-premium { padding: 24px; }
        .card-footer-premium {
            padding: 24px;
            background: transparent;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* ── FORMULARIOS Y CAMPOS DE TEXTO ── */
        .premium-label {
            color: #94A3B8;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }
        
        .premium-input {
            background-color: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #fff !important;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .premium-input::placeholder { color: rgba(255, 255, 255, 0.3) !important; }
        .premium-input:focus {
            background-color: rgba(255, 255, 255, 0.05) !important;
            border-color: #0EA5E9 !important;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.15) !important;
        }

        .premium-input-group .input-group-text {
            background-color: rgba(255, 255, 255, 0.02) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-right: none !important;
            color: #94A3B8 !important;
            border-radius: 8px 0 0 8px;
        }
        .premium-input-group .form-control {
            border-left: none !important;
            border-radius: 0 8px 8px 0;
        }
        
        /* Ojos de contraseña */
        .btn-premium-icon {
            background-color: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-left: none;
            color: #94A3B8;
            border-radius: 0 8px 8px 0;
            padding: 0.375rem 0.75rem;
            transition: all 0.2s;
        }
        .btn-premium-icon:hover { color: #0EA5E9; }
        .premium-input:focus + .input-group-append .btn-premium-icon { border-color: #0EA5E9; }

        /* Selects Options */
        option { background-color: #131A2E; color: #fff; }

        /* Custom File Input */
        .premium-file-label {
            background-color: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #94A3B8 !important;
            border-radius: 8px;
        }
        .premium-file-label::after {
            background-color: rgba(255, 255, 255, 0.08) !important;
            color: #fff !important;
            border-radius: 0 8px 8px 0;
        }

        /* ── BOTONES GLOBALES ── */
        .premium-btn-submit {
            background: linear-gradient(135deg, #0EA5E9 0%, #0284C7 100%);
            border: 1px solid #0284C7;
            color: #fff;
            border-radius: 8px;
            font-weight: 600;
            padding: 10px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .premium-btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(14, 165, 233, 0.3);
            color: #fff;
        }

        .premium-btn-group .btn {
            border-radius: 6px !important;
            margin: 0 3px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.1);
            color: #E2E8F0;
            transition: all 0.2s;
        }
        .premium-btn-group .btn:hover {
            transform: translateY(-2px);
            background: rgba(255,255,255,0.1);
            color: #fff;
            border-color: rgba(255,255,255,0.2);
        }
        .premium-btn-group .btn-outline-info:hover { color: #0EA5E9; border-color: #0EA5E9; }
        .premium-btn-group .btn-outline-primary:hover { color: #10B981; border-color: #10B981; }
        .premium-btn-group .btn-outline-secondary:hover { color: #F59E0B; border-color: #F59E0B; }

        /* ── TABLA DE DATOS ── */
        .table-premium th {
            background-color: rgba(255, 255, 255, 0.01);
            color: #94A3B8; font-size: 12px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.5px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06) !important;
            padding: 15px;
        }
        .table-premium td {
            padding: 15px; vertical-align: middle;
            color: #E2E8F0; font-size: 14px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            border-top: none;
        }
        .table-premium tbody tr { transition: all 0.2s ease-in-out; }
        .table-premium tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.03);
            transform: scale(1.005);
            border-radius: 8px;
        }

        /* ── AVATARES ── */
        .img-avatar {
            width: 45px; height: 45px; object-fit: cover;
            border: 2px solid rgba(255,255,255,0.1);
            box-shadow: 0 3px 8px rgba(0,0,0,0.3);
            transition: transform 0.3s;
        }
        .img-avatar:hover { transform: scale(1.1) rotate(5deg); border-color: #0EA5E9; }
        .avatar-placeholder {
            width: 45px; height: 45px; border-radius: 50%;
            background: linear-gradient(135deg, #1E293B 0%, #0F172A 100%);
            border: 1px solid rgba(255,255,255,0.1);
            display: inline-flex; justify-content: center; align-items: center;
            box-shadow: 0 3px 8px rgba(0,0,0,0.3); font-size: 1.2rem;
            transition: transform 0.3s;
        }
        .avatar-placeholder:hover { transform: scale(1.1); border-color: #10B981; }

        /* ── BADGES Y ESTADOS ── */
        .badge-status-premium {
            padding: 5px 12px; border-radius: 6px;
            font-size: 12px; font-weight: 500;
        }
        .vehicle-badge {
            background-color: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 6px 12px; border-radius: 8px;
            display: inline-block; font-weight: 600;
        }

        /* ── MODALES ── */
        .premium-modal-content {
            background: #131A2E !important; 
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px rgba(0,0,0,0.5);
            color: #fff;
        }
        .premium-alert {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: #E2E8F0;
            padding: 12px;
        }
        
        /* Fix SweetAlert on Dark Mode */
        .swal2-popup.dark-swal {
            background: #131A2E !important;
            color: #fff !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
        }
        .swal2-title { color: #fff !important; }
        .swal2-html-container { color: #94A3B8 !important; }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    <script>
        $(document).ready(function () {
            bsCustomFileInput.init();
            $('[data-toggle="tooltip"]').tooltip();
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

        document.getElementById('togglePassword').addEventListener('click', function () { toggleVisibilidad('password', 'eyeIcon'); });
        document.getElementById('toggleResetPassword').addEventListener('click', function () { toggleVisibilidad('reset_password', 'eyeResetIcon'); });
        document.getElementById('toggleResetPasswordConfirm').addEventListener('click', function () { toggleVisibilidad('reset_password_confirmation', 'eyeResetConfirmIcon'); });

        $('.btn-reset-password').on('click', function() {
            let id = $(this).data('id');
            $('#modal-repartidor-name').text($(this).data('name'));
            $('#form-reset-password').attr('action', "{{ url('admin/repartidores') }}/" + id + "/password");
            $('#reset_password, #reset_password_confirmation').val('');
        });

        $('.btn-assign-vehicle').on('click', function() {
            let id = $(this).data('id');
            $('#modal-vehicle-name').text($(this).data('name'));
            $('#select_vehiculo').val($(this).data('vehiculo'));
            $('#form-assign-vehicle').attr('action', "{{ url('admin/repartidores') }}/" + id + "/vehicle");
        });

        $('.btn-edit-repartidor').on('click', function() {
            let id = $(this).data('id');
            $('#edit_name').val($(this).data('name'));
            $('#edit_email').val($(this).data('email'));
            $('#edit_cedula').val($(this).data('cedula'));
            $('#edit_telefono').val($(this).data('telefono'));
            $('#edit_licencia').val($(this).data('licencia'));
            $('#form-edit-repartidor').attr('action', "{{ url('admin/repartidores') }}/" + id);
            
            $('#edit_foto_perfil').val('');
            $('#edit_foto_perfil').next('.custom-file-label').html('Elegir nueva...');
        });

        @if(session('success'))
            Swal.fire({ 
                icon: 'success', 
                title: '¡Éxito!', 
                text: '{{ session('success') }}', 
                confirmButtonColor: '#0EA5E9',
                customClass: { popup: 'dark-swal' }
            });
        @endif

        @if(session('error'))
            Swal.fire({ 
                icon: 'error', 
                title: 'Error detectado', 
                text: '{{ session('error') }}', 
                confirmButtonColor: '#EF4444',
                customClass: { popup: 'dark-swal' }
            });
        @endif

        $('form').on('submit', function() {
            let btn = $(this).find('button[type="submit"]');
            btn.prop('disabled', true);
            btn.html('<i class="fas fa-spinner fa-spin mr-2"></i> Procesando...');
        });
    </script>
@stop
