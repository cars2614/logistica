<?php $__env->startSection('title', 'Roles'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1><i class="fas fa-shield-alt"></i> Roles</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Roles</li>
        </ol>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="row">
        
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-plus-circle"></i> Nuevo Rol
                    </h3>
                </div>

                <form action="<?php echo e(route('admin.rol.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="card-body">

                        
                        <div class="form-group">
                            <label>Nombre <span class="text-danger">*</span></label>
                            <input type="hidden" name="nombreRol" id="nombreRol" value="<?php echo e(old('nombreRol')); ?>">

                            <div class="d-flex flex-wrap" id="roles-botones">
                                <?php $__currentLoopData = [
                                    ['valor' => 'Administrador', 'icono' => 'fas fa-user-shield'],
                                    ['valor' => 'Repartidor',    'icono' => 'fas fa-motorcycle'],
                                    ['valor' => 'Cliente',       'icono' => 'fas fa-user'],
                                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opcion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button type="button"
                                        class="btn btn-rol mr-2 mb-2 <?php echo e(old('nombreRol') === $opcion['valor'] ? 'active' : ''); ?>"
                                        data-valor="<?php echo e($opcion['valor']); ?>"
                                        onclick="seleccionarRol(this)">
                                        <i class="<?php echo e($opcion['icono']); ?> mr-1"></i>
                                        <?php echo e($opcion['valor']); ?>

                                    </button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <?php $__errorArgs = ['nombreRol'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger small d-block mt-1"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save"></i> Guardar
                        </button>
                        <a href="<?php echo e(route('admin.rol.index')); ?>" class="btn btn-secondary btn-block mt-2">
                            <i class="fas fa-undo"></i> Limpiar
                        </a>
                    </div>

                </form>
            </div>
        </div>

        
        <div class="col-md-8">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-list"></i> Listado de Roles
                    </h3>
                    <div class="card-tools">
                        <span class="badge badge-primary">Total: <?php echo e($roles->count()); ?></span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e($rol->nombreRol); ?></td>
                                    <td>
                                        
                                        <a href="<?php echo e(route('admin.rol.edit', $rol->id)); ?>"
                                           class="btn btn-warning btn-sm"
                                           title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        
                                        <form action="<?php echo e(route('admin.rol.destroy', $rol->id)); ?>"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('¿Estás seguro de eliminar este rol?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">
                                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                        No hay roles registrados.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .table thead th { font-size: 0.85rem; }

        .btn-rol {
            border: 2px solid #007bff;
            color: #007bff;
            background-color: white;
            border-radius: 20px;
            padding: 8px 18px;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .btn-rol:hover {
            background-color: #e7f1ff;
        }

        .btn-rol.active {
            background-color: #007bff;
            color: white;
        }

        .btn-rol.active i {
            color: white;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        function seleccionarRol(boton) {
            document.querySelectorAll('.btn-rol').forEach(b => b.classList.remove('active'));
            boton.classList.add('active');
            document.getElementById('nombreRol').value = boton.dataset.valor;
        }

        document.addEventListener('DOMContentLoaded', function () {
            const valorActual = document.getElementById('nombreRol').value;
            if (valorActual) {
                document.querySelectorAll('.btn-rol').forEach(function (b) {
                    if (b.dataset.valor === valorActual) {
                        b.classList.add('active');
                    }
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS\Desktop\logistica\resources\views/admin/roles/index.blade.php ENDPATH**/ ?>