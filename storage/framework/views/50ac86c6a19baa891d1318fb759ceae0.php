<?php $__env->startSection('title', 'Clientes'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="container-fluid pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
            <h1 class="m-0 font-weight-bold text-secondary">
                <i class="fas fa-users text-primary mr-2"></i>Gestión de Clientes
            </h1>
            <ol class="breadcrumb m-0 bg-transparent p-0">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Inicio</a></li>
                <li class="breadcrumb-item active">Clientes</li>
            </ol>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid pb-4">

        
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle mr-2 fa-lg"></i>
                    <div><?php echo e(session('success')); ?></div>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="row mt-3">
            
            <div class="col-xl-4 col-lg-5 mb-4">
                <div class="card card-primary card-outline shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h3 class="card-title font-weight-bold text-dark mb-0">
                            <?php if(isset($cliente)): ?>
                                <i class="fas fa-edit text-warning mr-2"></i>Editar Cliente
                            <?php else: ?>
                                <i class="fas fa-plus-circle text-primary mr-2"></i>Nuevo Cliente
                                <?php endif; ?>
                            </h3>
                        </div>

                        <?php if(isset($cliente)): ?>
                            <form action="<?php echo e(route('admin.cliente.update', $cliente->id)); ?>" method="POST">
                                <?php echo method_field('PUT'); ?>
                            <?php else: ?>
                                <form action="<?php echo e(route('admin.cliente.store')); ?>" method="POST">
                                <?php endif; ?>
                                <?php echo csrf_field(); ?>

                                <div class="card-body py-3">
                                    
                                    <div class="form-group mb-3">
                                        <label for="cedula" class="font-weight-bold text-secondary mb-1">Cédula <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light text-muted"><i
                                                        class="fas fa-id-card"></i></span>
                                            </div>
                                            <input type="number" name="cedula" id="cedula"
                                                class="form-control border-left-0 <?php $__errorArgs = ['cedula'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                placeholder="Ej: 123456789" value="<?php echo e(old('cedula', $cliente->cedula ?? '')); ?>">
                                            <?php $__errorArgs = ['cedula'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback"><i
                                                        class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group mb-3">
                                        <label for="nombre" class="font-weight-bold text-secondary mb-1">Nombre Completo <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light text-muted"><i
                                                        class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" name="nombre" id="nombre"
                                                class="form-control border-left-0 <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                placeholder="Ej: Juan Pérez"
                                                value="<?php echo e(old('nombre', $cliente->nombre ?? '')); ?>">
                                            <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback"><i
                                                        class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group mb-3">
                                        <label for="telefono" class="font-weight-bold text-secondary mb-1">Teléfono <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light text-muted"><i
                                                        class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" name="telefono" id="telefono"
                                                class="form-control border-left-0 <?php $__errorArgs = ['telefono'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                placeholder="Ej: 3001234567"
                                                value="<?php echo e(old('telefono', $cliente->telefono ?? '')); ?>">
                                            <?php $__errorArgs = ['telefono'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback"><i
                                                        class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group mb-3">
                                        <label for="correo" class="font-weight-bold text-secondary mb-1">Correo Electrónico
                                            <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light text-muted"><i
                                                        class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="email" name="correo" id="correo"
                                                class="form-control border-left-0 <?php $__errorArgs = ['correo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                placeholder="Ej: cliente@correo.com"
                                                value="<?php echo e(old('correo', $cliente->correo ?? '')); ?>">
                                            <?php $__errorArgs = ['correo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback"><i
                                                        class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group mb-3">
                                        <label for="direccion" class="font-weight-bold text-secondary mb-1">Dirección <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light text-muted"><i
                                                        class="fas fa-map-marker-alt"></i></span>
                                            </div>
                                            <input type="text" name="direccion" id="direccion"
                                                class="form-control border-left-0 <?php $__errorArgs = ['direccion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                placeholder="Ej: Calle 10 # 5-23"
                                                value="<?php echo e(old('direccion', $cliente->direccion ?? '')); ?>">
                                            <?php $__errorArgs = ['direccion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback"><i
                                                        class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group mb-3">
                                        <label for="id_ciudad" class="font-weight-bold text-secondary mb-1">Ciudad / Región
                                            <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light text-muted"><i
                                                        class="fas fa-city"></i></span>
                                            </div>
                                            <select name="id_ciudad" id="id_ciudad"
                                                class="form-control border-left-0 <?php $__errorArgs = ['id_ciudad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <option value="">Seleccione una ciudad</option>
                                                <?php $__currentLoopData = $ciudades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ciudad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($ciudad->id); ?>"
                                                        <?php echo e(old('id_ciudad', $cliente->id_ciudad ?? '') == $ciudad->id ? 'selected' : ''); ?>>
                                                        <?php echo e($ciudad->nombre); ?> [<?php echo e($ciudad->codigo_postal); ?>]

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['id_ciudad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback"><i
                                                        class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group mb-1">
                                        <label for="descripcion" class="font-weight-bold text-secondary mb-1">Descripción /
                                            Observaciones</label>
                                        <textarea name="descripcion" id="descripcion" rows="2"
                                            class="form-control form-control-sm <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            placeholder="Notas internas sobre el cliente..." style="resize: none;"><?php echo e(old('descripcion', $cliente->descripcion ?? '')); ?></textarea>
                                        <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback"><i
                                                    class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                                <div class="card-footer bg-light border-top-0 d-flex flex-column p-3" style="gap: 8px;">
                                    <button type="submit" class="btn btn-primary btn-block font-weight-bold shadow-sm py-2">
                                        <i class="fas fa-save mr-2"></i>
                                        <?php if(isset($cliente)): ?> Actualizar Registro
                                        <?php else: ?>
                                        Guardar Cliente <?php endif; ?>
                                    </button>
                                    <a href="<?php echo e(route('admin.cliente.index')); ?>"
                                        class="btn btn-outline-secondary btn-block m-0 font-weight-bold py-2">
                                        <i class="fas fa-undo mr-2"></i> Limpiar Campos
                                    </a>
                                </div>
                            </form>
                    </div>
                </div>



                
                <div class="col-xl-8 col-lg-7">
                    <div class="card card-outline card-primary shadow-sm border-0">
                        <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                            <h3 class="card-title font-weight-bold text-dark mb-0">
                                <i class="fas fa-list text-primary mr-2"></i>Listado de Clientes
                            </h3>
                            <span class="badge badge-pill badge-primary px-3 py-2 font-weight-bold shadow-sm">
                                Total: <?php echo e($clientes->count()); ?>

                            </span>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light border-bottom text-secondary">
                                        <tr>
                                            <th width="5%" class="text-center font-weight-bold border-0">#</th>
                                            <th width="15%" class="font-weight-bold border-0">Cédula</th>
                                            <th width="25%" class="font-weight-bold border-0">Nombre</th>
                                            <th width="20%" class="font-weight-bold border-0">Contacto</th>
                                            <th width="20%" class="font-weight-bold border-0">Ubicación</th>
                                            <th width="15%" class="text-center font-weight-bold border-0">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr class="align-middle">
                                                <td class="text-center align-middle font-weight-bold text-muted">
                                                    <?php echo e($index + 1); ?></td>
                                                <td class="align-middle text-dark font-weight-bold"><?php echo e($item->cedula); ?></td>
                                                <td class="align-middle text-dark font-weight-bold text-uppercase"
                                                    style="font-size: 0.88rem; letter-spacing: 0.2px;">
                                                    <?php echo e($item->nombre); ?>

                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex flex-column" style="gap: 1px; font-size: 0.85rem;">
                                                        <span class="text-dark font-weight-bold"><i
                                                                class="fas fa-phone text-muted mr-1"
                                                                style="font-size: 0.75rem;"></i><?php echo e($item->telefono); ?></span>
                                                        <span class="text-secondary text-muted text-truncate"
                                                            style="font-size: 0.8rem; max-width: 160px;"
                                                            title="<?php echo e($item->correo); ?>"><?php echo e($item->correo); ?></span>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex flex-column" style="gap: 1px; font-size: 0.85rem;">
                                                        <span class="text-dark text-truncate" style="max-width: 160px;"
                                                            title="<?php echo e($item->direccion); ?>">
                                                            <i class="fas fa-map-marker-alt text-danger mr-1"
                                                                style="opacity: 0.7; font-size: 0.75rem;"></i><?php echo e($item->direccion); ?>

                                                        </span>
                                                        <span
                                                            class="badge badge-light align-self-start border px-2 py-1 text-secondary mt-1"
                                                            style="font-size: 0.75rem; font-weight: 600;">
                                                            <i class="fas fa-city mr-1" style="font-size: 0.7rem;"></i>CP:
                                                            <?php echo e($item->codigo_postal); ?>

                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div class="d-inline-flex" style="gap: 6px;">

                                                        
                                                        <a href="<?php echo e(route('admin.cliente.edit', $item->id)); ?>"
                                                            class="btn btn-sm btn-info shadow-sm d-flex align-items-center justify-content-center"
                                                            title="Editar"
                                                            style="width: 32px; height: 32px; border-radius: 6px;">
                                                            <i class="fas fa-pen fa-sm"></i>
                                                        </a>

                                                        
                                                        <form action="<?php echo e(route('admin.cliente.destroy', $item->id)); ?>"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('¿Estás seguro de eliminar este cliente?')">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger shadow-sm d-flex align-items-center justify-content-center"
                                                                title="Eliminar"
                                                                style="width: 32px; height: 32px; border-radius: 6px;">
                                                                <i class="fas fa-trash fa-sm"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-5 bg-white">
                                                    <i class="fas fa-folder-open fa-3x mb-3 text-muted"
                                                        style="opacity: 0.5;"></i>
                                                    <p class="mb-0 font-weight-bold">No hay clientes registrados en el sistema.
                                                    </p>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        /* Efecto hover limpio en filas */
        .table-hover tbody tr {
            transition: background-color 0.2s ease;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.02) !important;
        }

        /* Input groups con diseño unificado sin bordes divisorios gruesos */
        .input-group-text {
            border-right: none !important;
        }

        .form-control {
            border-left: none !important;
        }

        .form-control:focus {
            border-color: #ced4da !important;
            box-shadow: none !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        // Auto-ocultar alertas tras 4 segundos de forma fluida
        setTimeout(function() {
            $('.alert-dismissible').fadeOut('slow');
        }, 4000);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS\Desktop\logistica\resources\views/admin/cliente/index.blade.php ENDPATH**/ ?>