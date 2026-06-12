<?php $__env->startSection('title', 'Gestión de Repartidores'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Gestión de Repartidores</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Registrar Nuevo</h3>
                </div>

                <form id="form-crear-repartidor" action="<?php echo e(route('admin.repartidor.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        
                        <div class="form-group">
                            <label for="name">Nombre Completo <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="name" id="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('name')); ?>" placeholder="Ej: Juan Pérez" required>
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label for="email">Correo Electrónico <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" id="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('email')); ?>" placeholder="Ej: juan.perez@logistica.com" required>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label for="password">Contraseña <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" name="password" id="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Mínimo 8 caracteres" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <i class="fas fa-eye" id="eyeIcon"></i>
                                    </button>
                                </div>
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" style="display: block;" role="alert"><strong><?php echo e($message); ?></strong></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                            <?php $__empty_1 = true; $__currentLoopData = $repartidores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $repartidor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><strong><?php echo e($repartidor->name); ?></strong></td>
                                    <td><?php echo e($repartidor->email); ?></td>
                                    <td>
                                        <span class="badge badge-warning text-dark px-2 py-1">
                                            <?php echo e($repartidor->guias_pendientes_count); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-success px-2 py-1">
                                            <?php echo e($repartidor->guias_entregadas_count); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-dark btn-reset-password" 
                                            data-id="<?php echo e($repartidor->id); ?>" 
                                            data-name="<?php echo e($repartidor->name); ?>" 
                                            data-toggle="modal" 
                                            data-target="#modalPassword">
                                            <i class="fas fa-key mr-1"></i> Credenciales
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No hay repartidores registrados aún.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
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
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
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
            let actionUrl = "<?php echo e(url('admin/repartidores')); ?>/" + id + "/password";
            $('#form-reset-password').attr('action', actionUrl);
            
            // Limpiar inputs
            $('#reset_password').val('');
            $('#reset_password_confirmation').val('');
        });

        // SweetAlert2
        <?php if(session('success')): ?>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '<?php echo e(session('success')); ?>',
                confirmButtonColor: '#3085d6'
            });
        <?php endif; ?>

        <?php if(session('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?php echo e(session('error')); ?>',
                confirmButtonColor: '#d33'
            });
        <?php endif; ?>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS\Desktop\logistica\resources\views/admin/repartidor/create.blade.php ENDPATH**/ ?>