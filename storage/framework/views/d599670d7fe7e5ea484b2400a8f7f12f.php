<?php $__env->startSection('title', 'Vehículos'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="container-fluid pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
            <h1 class="m-0 font-weight-bold text-secondary">
                <i class="fas fa-car text-primary mr-2"></i>Vehículos
            </h1>
            <ol class="breadcrumb m-0 bg-transparent p-0">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Vehículos</li>
            </ol>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid pb-4">

    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mt-2" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle mr-2 fa-lg"></i>
                <div><?php echo e(session('success')); ?></div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mt-2" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle mr-2 fa-lg"></i>
                <div><?php echo e(session('error')); ?></div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mt-2" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-triangle mr-2 fa-lg"></i>
                <div>
                    <strong class="d-block mb-1">Por favor corrige los siguientes errores:</strong>
                    <ul class="mb-0 pl-3">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card card-outline card-primary shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <h3 class="card-title font-weight-bold text-dark mb-0">
                        <i class="fas fa-list text-primary mr-2"></i>Listado de Vehículos
                    </h3>
                    <div class="card-tools d-flex align-items-center" style="gap: 10px;">
                        <span class="badge badge-pill badge-primary px-3 py-2 font-weight-bold shadow-sm">
                            Total: <?php echo e($vehiculos->total()); ?>

                        </span>
                        <button class="btn btn-primary btn-sm font-weight-bold shadow-sm px-3" data-toggle="modal" data-target="#modalCrear">
                            <i class="fas fa-plus mr-1"></i> Nuevo Vehículo
                        </button>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light border-bottom text-secondary">
                                <tr>
                                    <th width="5%" class="text-center font-weight-bold border-0">#</th>
                                    <th width="12%" class="font-weight-bold border-0">Placa</th>
                                    <th width="15%" class="font-weight-bold border-0">Marca</th>
                                    <th width="15%" class="font-weight-bold border-0">Modelo</th>
                                    <th width="15%" class="font-weight-bold border-0">Tipo</th>
                                    <th width="12%" class="font-weight-bold border-0">Capacidad</th>
                                    <th width="12%" class="font-weight-bold border-0">Estado</th>
                                    <th width="14%" class="font-weight-bold border-0">Fecha Registro</th>
                                    <th width="10%" class="text-center font-weight-bold border-0">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $vehiculos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $vehiculo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="align-middle">
                                        <td class="text-center align-middle font-weight-bold text-muted">
                                            <?php echo e($vehiculos->firstItem() + $index); ?>

                                        </td>
                                        <td class="align-middle">
                                            <span class="badge badge-plate px-2 py-1 shadow-sm font-weight-bold text-uppercase">
                                                <?php echo e($vehiculo->placa); ?>

                                            </span>
                                        </td>
                                        <td class="align-middle text-dark font-weight-bold text-uppercase" style="font-size: 0.85rem;"><?php echo e($vehiculo->marca); ?></td>
                                        <td class="align-middle text-secondary" style="font-size: 0.85rem;"><?php echo e($vehiculo->modelo); ?></td>
                                        
                                        
                                        <td class="align-middle text-secondary" style="font-size: 0.85rem;">
                                            <?php
                                                $nombreTipo = strtolower($vehiculo->tipoVehiculo->nombre ?? '');
                                                $icono = 'fas fa-car'; 

                                                if (str_contains($nombreTipo, 'moto')) {
                                                    $icono = 'fas fa-motorcycle';
                                                } elseif (str_contains($nombreTipo, 'camion') || str_contains($nombreTipo, 'furgon') || str_contains($nombreTipo, 'tracto') || str_contains($nombreTipo, 'carga')) {
                                                    $icono = 'fas fa-truck';
                                                } elseif (str_contains($nombreTipo, 'cicla') || str_contains($nombreTipo, 'bici')) {
                                                    $icono = 'fas fa-bicycle';
                                                } elseif (str_contains($nombreTipo, 'van') || str_contains($nombreTipo, 'bus') || str_contains($nombreTipo, 'colectivo')) {
                                                    $icono = 'fas fa-bus';
                                                }
                                            ?>
                                            <i class="<?php echo e($icono); ?> text-primary mr-2" style="opacity: 0.8;"></i>
                                            <strong><?php echo e($vehiculo->tipoVehiculo->nombre ?? '—'); ?></strong>
                                        </td>

                                        <td class="align-middle font-weight-bold text-dark" style="font-size: 0.85rem;"><?php echo e(number_format($vehiculo->capacidad)); ?> kg</td>
                                        <td class="align-middle">
                                            <?php if($vehiculo->estado === 'activo'): ?>
                                                <span class="badge badge-pill badge-success px-2 py-1" style="font-size: 0.75rem; font-weight: 700;">ACTIVO</span>
                                            <?php elseif($vehiculo->estado === 'inactivo'): ?>
                                                <span class="badge badge-pill badge-secondary px-2 py-1" style="font-size: 0.75rem; font-weight: 700;">INACTIVO</span>
                                            <?php else: ?>
                                                <span class="badge badge-pill badge-warning px-2 py-1 text-dark" style="font-size: 0.75rem; font-weight: 700;">MANTENIMIENTO</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="align-middle text-muted" style="font-size: 0.85rem;">
                                            <?php echo e(\Carbon\Carbon::parse($vehiculo->fecha_registro)->format('d/m/Y')); ?>

                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="d-inline-flex" style="gap: 6px;">
                                                <a href="<?php echo e(route('admin.vehiculo.edit', $vehiculo->id)); ?>"
                                                   class="btn btn-sm btn-info shadow-sm d-flex align-items-center justify-content-center" 
                                                   title="Editar" style="width: 32px; height: 32px; border-radius: 6px;">
                                                    <i class="fas fa-pen fa-sm"></i>
                                                </a>
                                                
                                                <form action="<?php echo e(route('admin.vehiculo.destroy', $vehiculo->id)); ?>"
                                                      method="POST" class="d-inline form-eliminar">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button
                                                        type="button"
                                                        class="btn btn-sm btn-danger shadow-sm d-flex align-items-center justify-content-center btn-eliminar"
                                                        title="Eliminar"
                                                        style="width: 32px; height: 32px; border-radius: 6px;"
                                                        data-placa="<?php echo e($vehiculo->placa); ?>"
                                                    >
                                                        <i class="fas fa-trash fa-sm"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-5 bg-white">
                                            <i class="fas fa-folder-open fa-3x mb-3 text-muted" style="opacity: 0.5;"></i>
                                            <p class="mb-0 font-weight-bold">No hay vehículos registrados.</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php if($vehiculos->hasPages()): ?>
                    <div class="card-footer bg-white border-top py-3">
                        <div class="d-flex justify-content-center">
                            <?php echo e($vehiculos->links()); ?>

                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="modalCrearLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <form action="<?php echo e(route('admin.vehiculo.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-header bg-primary text-white py-3">
                    <h5 class="modal-title font-weight-bold mb-0" id="modalCrearLabel">
                        <i class="fas fa-plus-circle mr-2"></i>Nuevo Vehículo
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">

                        
                        <div class="col-md-6 form-group mb-3">
                            <label for="m_placa" class="font-weight-bold text-secondary mb-1">Placa <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-id-card"></i></span>
                                </div>
                                <input
                                    type="text"
                                    name="placa"
                                    id="m_placa"
                                    class="form-control border-left-0 text-uppercase font-weight-bold <?php $__errorArgs = ['placa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('placa')); ?>"
                                    placeholder="Ej: ABC-123"
                                    maxlength="10"
                                    autocomplete="off"
                                    style="text-transform: uppercase; letter-spacing: 0.5px;"
                                    required
                                >
                                <?php $__errorArgs = ['placa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        
                        <div class="col-md-6 form-group mb-3">
                            <label for="m_tipo_vehiculo_id" class="font-weight-bold text-secondary mb-1">Tipo de Vehículo <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-truck"></i></span>
                                </div>
                                <select
                                    name="id_tipo_vehiculo"
                                    id="m_tipo_vehiculo_id"
                                    class="form-control border-left-0 <?php $__errorArgs = ['id_tipo_vehiculo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    required
                                >
                                    <option value="">-- Seleccione --</option>
                                    <?php $__currentLoopData = $tipoVehiculos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($tipo->id); ?>" <?php echo e(old('id_tipo_vehiculo') == $tipo->id ? 'selected' : ''); ?>>
                                            <?php echo e($tipo->nombre); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['id_tipo_vehiculo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        
                        <div class="col-md-6 form-group mb-3">
                            <label for="m_marca" class="font-weight-bold text-secondary mb-1">Marca <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-copyright"></i></span>
                                </div>
                                <input
                                    type="text"
                                    name="marca"
                                    id="m_marca"
                                    class="form-control border-left-0 <?php $__errorArgs = ['marca'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('marca')); ?>"
                                    placeholder="Ej: Chevrolet"
                                    maxlength="100"
                                    required
                                >
                                <?php $__errorArgs = ['marca'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        
                        <div class="col-md-6 form-group mb-3">
                            <label for="m_modelo" class="font-weight-bold text-secondary mb-1">Modelo / Línea <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-car-side"></i></span>
                                </div>
                                <input
                                    type="text"
                                    name="modelo"
                                    id="m_modelo"
                                    class="form-control border-left-0 <?php $__errorArgs = ['modelo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('modelo')); ?>"
                                    placeholder="Ej: NHR 2022"
                                    maxlength="100"
                                    required
                                >
                                <?php $__errorArgs = ['modelo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        
                        <div class="col-md-6 form-group mb-3">
                            <label for="m_capacidad" class="font-weight-bold text-secondary mb-1">Capacidad (kg) <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-weight-hanging"></i></span>
                                </div>
                                <input
                                    type="number"
                                    name="capacidad"
                                    id="m_capacidad"
                                    class="form-control border-left-0 <?php $__errorArgs = ['capacidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('capacidad')); ?>"
                                    placeholder="Ej: 5000"
                                    min="1"
                                    required
                                >
                                <?php $__errorArgs = ['capacidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        
                        <div class="col-md-6 form-group mb-3">
                            <label for="m_estado" class="font-weight-bold text-secondary mb-1">Estado inicial <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-toggle-on"></i></span>
                                </div>
                                <select
                                    name="estado"
                                    id="m_estado"
                                    class="form-control border-left-0 <?php $__errorArgs = ['estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    required
                                >
                                    <option value="">-- Seleccione --</option>
                                    <option value="activo" <?php echo e(old('estado') === 'activo' ? 'selected' : ''); ?>>Activo</option>
                                    <option value="inactivo" <?php echo e(old('estado') === 'inactivo' ? 'selected' : ''); ?>>Inactivo</option>
                                    <option value="mantenimiento" <?php echo e(old('estado') === 'mantenimiento' ? 'selected' : ''); ?>>Mantenimiento</option>
                                </select>
                                <?php $__errorArgs = ['estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        
                        <div class="col-md-6 form-group mb-0">
                            <label for="m_fecha_registro" class="font-weight-bold text-secondary mb-1">Fecha de Registro <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input
                                    type="date"
                                    name="fecha_registro"
                                    id="m_fecha_registro"
                                    class="form-control border-left-0 <?php $__errorArgs = ['fecha_registro'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('fecha_registro')); ?>"
                                    required
                                >
                                <?php $__errorArgs = ['fecha_registro'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0 py-3">
                    <button type="button" class="btn btn-outline-secondary font-weight-bold" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">Guardar Vehículo</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white py-3">
                <h5 class="modal-title font-weight-bold mb-0">Confirmar eliminación</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body p-4">
                <p class="text-dark mb-2">¿Está seguro que desea eliminar el vehículo con placa <strong id="placaEliminar" class="text-danger"></strong>?</p>
            </div>
            <div class="modal-footer bg-light py-3">
                <button type="button" class="btn btn-outline-secondary font-weight-bold" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger font-weight-bold" id="btnConfirmarEliminar">Eliminar Registro</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>
    .table-hover tbody tr:hover { background-color: rgba(0, 123, 255, 0.02) !important; }
    .input-group-text { border-right: none !important; }
    .form-control { border-left: none !important; }
    .badge-plate {
        background-color: #f9f9f9; color: #2c3e50; border: 2px solid #bdc3c7;
        font-family: 'Courier New', Courier, monospace; letter-spacing: 1px;
        font-size: 0.9rem; border-radius: 4px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    const hoy = new Date().toISOString().split('T')[0];
    document.getElementById('m_fecha_registro').setAttribute('max', hoy);

    document.getElementById('m_placa').addEventListener('input', function () {
        this.value = this.value.toUpperCase().replace(/[^A-Z0-9\-]/g, '');
    });

    let formEliminar = null;
    document.querySelectorAll('.btn-eliminar').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById('placaEliminar').textContent = this.getAttribute('data-placa');
            formEliminar = this.closest('form');
            $('#modalEliminar').modal('show');
        });
    });

    document.getElementById('btnConfirmarEliminar').addEventListener('click', function () {
        if (formEliminar) formEliminar.submit();
    });

    <?php if($errors->any()): ?>
        $(document).ready(function () { $('#modalCrear').modal('show'); });
    <?php endif; ?>

    setTimeout(function () {
        $('.alert-dismissible').fadeOut('slow');
    }, 5000);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS\Desktop\logistica\resources\views/admin/vehiculo/index.blade.php ENDPATH**/ ?>