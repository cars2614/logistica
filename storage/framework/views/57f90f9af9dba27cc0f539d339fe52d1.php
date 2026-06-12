<?php $__env->startSection('title', 'Ciudades'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="container-fluid pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
            <h1 class="m-0 font-weight-bold text-secondary">
                <i class="fas fa-city text-primary mr-2"></i>Gestión de Ciudades
            </h1>
            <ol class="breadcrumb m-0 bg-transparent p-0">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
                <li class="breadcrumb-item active">Ciudades</li>
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

    <div class="row mt-3">
        
        <div class="col-md-5 mb-4">
            <div class="card card-outline <?php echo e(isset($ciudad) ? 'card-warning' : 'card-primary'); ?> shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h3 class="card-title font-weight-bold text-dark mb-0">
                        <i class="fas <?php echo e(isset($ciudad) ? 'fa-edit text-warning' : 'fa-plus-circle text-primary'); ?> mr-2"></i>
                        <?php echo e(isset($ciudad) ? 'Editar Ciudad' : 'Nueva Ciudad'); ?>

                    </h3>
                </div>

                <form action="<?php echo e(isset($ciudad) ? route('admin.ciudad.update', $ciudad->id) : route('admin.ciudad.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php if(isset($ciudad)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

                    <div class="card-body py-3">
                        
                        <div class="form-group mb-3">
                            <label for="nombre" class="font-weight-bold text-secondary mb-1">Nombre <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-building"></i></span>
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
                                    value="<?php echo e(old('nombre', $ciudad->nombre ?? '')); ?>" 
                                    placeholder="Ej: Bogotá, Medellín..." required>
                                <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                                    <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></span> 
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        
                        <div class="form-group mb-2">
                            <label for="codigo_postal" class="font-weight-bold text-secondary mb-1">Código Postal <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-mail-bulk"></i></span>
                                </div>
                                <input type="text" name="codigo_postal" id="codigo_postal" 
                                    class="form-control border-left-0 <?php $__errorArgs = ['codigo_postal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    value="<?php echo e(old('codigo_postal', $ciudad->codigo_postal ?? '')); ?>" 
                                    placeholder="Ej: 110111" required>
                                <?php $__errorArgs = ['codigo_postal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                                    <span class="invalid-feedback"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></span> 
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light border-top-0 d-flex flex-column p-3" style="gap: 8px;">
                        <button type="submit" class="btn <?php echo e(isset($ciudad) ? 'btn-warning text-dark' : 'btn-primary'); ?> btn-block font-weight-bold shadow-sm py-2">
                            <i class="fas fa-save mr-2"></i> <?php echo e(isset($ciudad) ? 'Actualizar Ciudad' : 'Guardar Ciudad'); ?>

                        </button>
                        
                        <a href="<?php echo e(route('admin.ciudad.index')); ?>" class="btn btn-outline-secondary btn-block m-0 font-weight-bold py-2">
                            <i class="fas fa-undo mr-2"></i> <?php echo e(isset($ciudad) ? 'Cancelar Edición' : 'Limpiar Campos'); ?>

                        </a>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="col-md-7">
            <div class="card card-outline card-primary shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <h3 class="card-title font-weight-bold text-dark mb-0">
                        <i class="fas fa-list text-primary mr-2"></i>Listado de Ciudades
                    </h3>
                    <span class="badge badge-pill badge-primary px-3 py-2 font-weight-bold shadow-sm">
                        Total: <?php echo e($ciudades->count()); ?>

                    </span>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light border-bottom text-secondary">
                                <tr>
                                    <th width="12%" class="text-center font-weight-bold border-0">#</th>
                                    <th width="48%" class="font-weight-bold border-0">Nombre</th>
                                    <th width="25%" class="font-weight-bold border-0">Cod. Postal</th>
                                    <th width="15%" class="text-center font-weight-bold border-0">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $ciudades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="align-middle">
                                        <td class="text-center align-middle font-weight-bold text-muted"><?php echo e($loop->iteration); ?></td>
                                        <td class="align-middle text-dark font-weight-bold text-uppercase" style="font-size: 0.88rem; letter-spacing: 0.2px;">
                                            <i class="fas fa-map-marker-alt text-muted mr-2" style="opacity: 0.6;"></i><?php echo e($item->nombre); ?>

                                        </td>
                                        <td class="align-middle">
                                            <span class="badge badge-light border px-2 py-1 text-secondary font-weight-bold" style="font-size: 0.8rem;">
                                                <i class="fas fa-hashtag text-muted mr-1" style="font-size: 0.7rem;"></i><?php echo e($item->codigo_postal); ?>

                                            </span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="d-inline-flex" style="gap: 6px;">
                                                
                                                <a href="<?php echo e(route('admin.ciudad.edit', $item->id)); ?>" 
                                                   class="btn btn-sm btn-info shadow-sm d-flex align-items-center justify-content-center" 
                                                   title="Editar" style="width: 32px; height: 32px; border-radius: 6px;">
                                                    <i class="fas fa-pen fa-sm"></i>
                                                </a>

                                                
                                                <form action="<?php echo e(route('admin.ciudad.destroy', $item->id)); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-danger shadow-sm d-flex align-items-center justify-content-center" 
                                                            title="Eliminar" style="width: 32px; height: 32px; border-radius: 6px;"
                                                            onclick="return confirm('¿Estás seguro de eliminar esta ciudad?')">
                                                        <i class="fas fa-trash fa-sm"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-5 bg-white">
                                            <i class="fas fa-folder-open fa-3x mb-3 text-muted" style="opacity: 0.5;"></i>
                                            <p class="mb-0 font-weight-bold">No hay ciudades registradas en el sistema.</p>
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
    /* Transición suave para filas */
    .table-hover tbody tr {
        transition: background-color 0.2s ease;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.02) !important;
    }
    
    /* Efecto unificado para los inputs con prefijos */
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
    // Desvanecer alertas de éxito automáticamente en 4 segundos
    setTimeout(function () {
        $('.alert-dismissible').fadeOut('slow');
    }, 4000);
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS\Desktop\logistica\resources\views/admin/Ciudad/index.blade.php ENDPATH**/ ?>