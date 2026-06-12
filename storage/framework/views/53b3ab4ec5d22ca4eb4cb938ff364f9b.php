<?php $__env->startSection('title', 'Tipos de Entrega — Carga y Logística Tolima'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="container-fluid pt-3 header-module-container">
        <div class="d-flex justify-content-between align-items-center pb-2">
            <h1 class="m-0 font-weight-bold text-white module-title-main">
                <i class="fas fa-shipping-fast mr-2"></i>Tipos de Entrega
            </h1>
            <ol class="breadcrumb m-0 bg-transparent p-0 custom-breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Inicio</a></li>
                <li class="breadcrumb-item active text-muted">Tipos de Entrega</li>
            </ol>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid pb-4 premium-module-wrap">

    
    <?php if(session('success')): ?>
        <div class="alert alert-premium-success alert-dismissible fade show mt-2" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle mr-2 fa-lg" style="color: #34D399;"></i>
                <div class="text-white font-weight-medium"><?php echo e(session('success')); ?></div>
            </div>
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close" style="opacity: 0.5; background: transparent; border: none;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-premium-danger alert-dismissible fade show mt-2" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle mr-2 fa-lg" style="color: #F87171;"></i>
                <div class="text-white font-weight-medium"><?php echo e(session('error')); ?></div>
            </div>
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close" style="opacity: 0.5; background: transparent; border: none;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="row mt-3">
        
        <div class="col-xl-4 col-lg-5 col-12 mb-4">
            <div class="card-premium-box">
                <div class="card-header-premium">
                    <h3 class="card-title-premium" id="form-action-title">
                        <i class="fas fa-plus-circle style-icon-lead"></i>Nuevo Tipo de Entrega
                    </h3>
                </div>
                <div class="card-body p-4">
                    <form action="<?php echo e(route('admin.tipo-entrega.store')); ?>" method="POST" id="formTipoEntrega">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="_method" id="formMethod" value="POST">
                        <input type="hidden" name="id" id="registroId">

                        
                        <div class="form-group mb-4">
                            <label for="nombre" class="premium-label">Nombre <span class="required-dot">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text-premium"><i class="fas fa-tag"></i></span>
                                </div>
                                <input
                                    type="text"
                                    name="nombre"
                                    id="nombre"
                                    class="form-control premium-input <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('nombre')); ?>"
                                    placeholder="Ej: Entrega a domicilio"
                                    maxlength="100"
                                    autocomplete="off"
                                    required
                                    onkeypress="return /[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]/.test(event.key)"
                                >
                                <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback font-weight-bold mt-2" style="color: #F87171;"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <small class="form-text-hint"><i class="fas fa-info-circle mr-1"></i>Solo letras, espacios y tildes. Máx. 100 carac.</small>
                        </div>

                        
                        <div class="form-group mb-4">
                            <label for="descripcion" class="premium-label">Descripción</label>
                            <textarea
                                name="descripcion"
                                id="descripcion"
                                class="form-control premium-textarea <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                rows="3"
                                maxlength="255"
                                placeholder="Descripción del tipo de entrega..."
                                style="resize: none;"
                            ><?php echo e(old('descripcion')); ?></textarea>
                            <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback font-weight-bold mt-2" style="color: #F87171;"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="d-flex justify-content-between mt-2">
                                <small class="form-text-hint"><i class="fas fa-info-circle mr-1"></i>Opcional.</small>
                                <small class="form-text-hint font-weight-bold"><span id="desc-count" style="color: #0EA5E9;">0</span>/255</small>
                            </div>
                        </div>

                        
                        <div class="form-group mb-4">
                            <label for="estado" class="premium-label">Estado <span class="required-dot">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text-premium"><i class="fas fa-toggle-on"></i></span>
                                </div>
                                <select
                                    name="estado"
                                    id="estado"
                                    class="form-control premium-input <?php $__errorArgs = ['estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    required
                                >
                                    <option value="" style="background-color: #0D1324;">-- Seleccione --</option>
                                    <option value="1" <?php echo e(old('estado') == '1' ? 'selected' : ''); ?> style="background-color: #0D1324;">Activo</option>
                                    <option value="0" <?php echo e(old('estado') === '0' ? 'selected' : ''); ?> style="background-color: #0D1324;">Inactivo</option>
                                </select>
                                <?php $__errorArgs = ['estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback font-weight-bold mt-2" style="color: #F87171;"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        
                        <div class="pt-2">
                            <button type="submit" class="btn-premium-save" id="btnGuardar">
                                <i class="fas fa-save"></i> Guardar Registro
                            </button>
                            <button type="button" class="btn-premium-clear" id="btnLimpiar" onclick="resetFormulario()">
                                <i class="fas fa-eraser"></i> Limpiar Campos
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
        <div class="col-xl-8 col-lg-7 col-12">
            <div class="card-premium-box">
                <div class="card-header-premium d-flex align-items-center justify-content-between">
                    <h3 class="card-title-premium">
                        <i class="fas fa-th-list style-icon-lead" style="color: #10B981;"></i>Listado de Tipos de Entrega
                    </h3>
                    <span class="badge-count-premium">
                        Total: <?php echo e($tipoEntregas->total()); ?>

                    </span>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-premium-mod table-hover mb-0">
                            <thead>
                                <tr>
                                    <th width="8%" class="text-center">#</th>
                                    <th width="32%">Nombre</th>
                                    <th width="35%">Descripción</th>
                                    <th width="12%" class="text-center">Estado</th>
                                    <th width="13%" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $tipoEntregas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="text-center font-weight-bold" style="color: rgba(255, 255, 255, 0.35);">
                                            <?php echo e($item->id); ?>

                                        </td>
                                        <td>
                                            <strong class="text-white text-uppercase" style="font-size: 0.88rem; letter-spacing: 0.2px;">
                                                <i class="fas fa-shipping-fast mr-2" style="color: #10B981; opacity: 0.8; font-size: 0.85rem;"></i><?php echo e($item->nombre); ?>

                                            </strong>
                                        </td>
                                        <td>
                                            <span style="color: rgba(255, 255, 255, 0.65); font-size: 0.85rem;" title="<?php echo e($item->descripcion); ?>">
                                                <?php echo e(Str::limit($item->descripcion, 50)); ?>

                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-pill px-2 py-1 font-weight-bold <?php echo e(str_contains($item->estado_badge, 'success') ? 'badge-premium-active' : 'badge-premium-inactive'); ?>">
                                                <?php echo e($item->estado_label); ?>

                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex" style="gap: 6px;">
                                                
                                                <button type="button" 
                                                        class="btn-action-edit" 
                                                        title="Editar"
                                                        onclick="prepararEdicion(<?php echo e($item->id); ?>, '<?php echo e(addslashes($item->nombre)); ?>', '<?php echo e(addslashes($item->descripcion ?? '')); ?>', '<?php echo e($item->getRawOriginal('estado') ?? ($item->estado ? '1' : '0')); ?>')">
                                                    <i class="fas fa-pen fa-sm"></i>
                                                </button>
                                                
                                                
                                                <form action="<?php echo e(route('admin.tipo-entrega.destroy', $item)); ?>" method="POST" class="d-inline form-eliminar">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button
                                                        type="button"
                                                        class="btn-action-delete btn-eliminar"
                                                        title="Eliminar"
                                                        data-nombre="<?php echo e($item->nombre); ?>"
                                                    >
                                                        <i class="fas fa-trash fa-sm"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5" style="background-color: transparent;">
                                            <i class="fas fa-folder-open fa-3x mb-3" style="color: rgba(255, 255, 255, 0.15);"></i>
                                            <p class="mb-0 font-weight-bold" style="color: rgba(255, 255, 255, 0.45);">No hay tipos de entrega registrados.</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php if($tipoEntregas->hasPages()): ?>
                    <div class="card-footer-premium py-3 border-top-divider">
                        <div class="d-flex justify-content-center custom-premium-pagination">
                            <?php echo e($tipoEntregas->links()); ?>

                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-premium-box border-0 shadow-lg">
            <div class="modal-header-premium border-bottom-divider py-3 px-4 d-flex align-items-center justify-content-between">
                <h5 class="modal-title font-weight-bold mb-0 text-white">
                    <i class="fas fa-exclamation-triangle mr-2" style="color: #EF4444;"></i>Confirmar Eliminación
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" style="opacity: 0.6; background: transparent; border: none; font-size: 1.5rem;">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <p class="mb-3 text-white" style="font-size: 1rem; font-weight: 500;">¿Está completamente seguro de eliminar el tipo de entrega <strong id="nombreEliminar" style="color: #EF4444; text-shadow: 0 0 10px rgba(239,68,68,0.2);"></strong>?</p>
                <div class="premium-danger-notice">
                    <i class="fas fa-info-circle mr-2" style="font-size: 1.1rem; flex-shrink: 0;"></i>
                    <span>Esta acción es permanente y no se podrá deshacer en el sistema.</span>
                </div>
            </div>
            <div class="modal-footer-premium border-top-divider py-3 px-4 d-flex justify-content-end" style="gap: 10px;">
                <button type="button" class="btn-premium-modal-close" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>Cancelar
                </button>
                <button type="button" class="btn-premium-modal-danger" id="btnConfirmarEliminar">
                    <i class="fas fa-trash-alt mr-1"></i>Eliminar Registro
                </button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

    /* Base General del Contenedor Dark */
    .content-wrapper {
        background-color: #0A0F1E !important; 
        position: relative;
        overflow-x: hidden;
    }
    .content-wrapper::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: 
            linear-gradient(rgba(255, 255, 255, 0.015) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.015) 1px, transparent 1px);
        background-size: 35px 35px;
        pointer-events: none;
        z-index: 1;
    }

    .premium-module-wrap {
        font-family: 'Inter', sans-serif;
        position: relative;
        z-index: 2;
    }

    .module-title-main { font-size: 24px; letter-spacing: -0.02em; }
    .module-title-main i { color: #0EA5E9; }
    .custom-breadcrumb .breadcrumb-item a { color: rgba(255,255,255,0.45); transition: color 0.2s; }
    .custom-breadcrumb .breadcrumb-item a:hover { color: #0EA5E9; text-decoration: none; }
    .custom-breadcrumb .breadcrumb-item::before { color: rgba(255,255,255,0.2) !important; }

    /* Tarjetas (Cards) */
    .card-premium-box {
        background: rgba(13, 19, 35, 0.65) !important;
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.05);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        overflow: hidden;
    }
    .card-header-premium {
        padding: 20px 24px;
        background: transparent;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    }
    .card-title-premium {
        font-size: 16px; font-weight: 600; color: #fff; margin: 0;
        display: flex; align-items: center; gap: 8px;
    }
    .card-title-premium .style-icon-lead { color: #0EA5E9; }

    .badge-count-premium {
        background: rgba(14, 165, 233, 0.15); color: #38BDF8;
        font-size: 13px; font-weight: 600; padding: 6px 14px; border-radius: 8px;
        border: 1px solid rgba(14, 165, 233, 0.2);
    }

    /* Campos de Formulario */
    .premium-label {
        font-size: 12px; font-weight: 600; color: #94A3B8;
        letter-spacing: 0.02em; margin-bottom: 8px; text-transform: uppercase; display: block;
    }
    .premium-label .required-dot { color: #EF4444; }
    
    .input-group-text-premium {
        background-color: rgba(10, 15, 30, 0.6) !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        border-right: none !important;
        border-top-left-radius: 10px !important;
        border-bottom-left-radius: 10px !important;
        color: rgba(255, 255, 255, 0.4) !important;
        padding: 0 14px; display: flex; align-items: center;
    }
    .premium-input {
        background-color: rgba(10, 15, 30, 0.6) !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        border-top-right-radius: 10px !important;
        border-bottom-right-radius: 10px !important;
        color: #FFFFFF !important;
        padding: 12px 14px !important;
        font-size: 14px !important;
        transition: all 0.2s ease-in-out !important;
        height: auto !important;
    }
    .premium-input:focus {
        border-color: #0EA5E9 !important;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.15) !important;
    }
    .premium-input::placeholder { color: rgba(255, 255, 255, 0.25); }

    .premium-textarea {
        background-color: rgba(10, 15, 30, 0.6) !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        border-radius: 10px !important;
        color: #FFFFFF !important;
        padding: 12px 14px !important;
        font-size: 14px !important;
        transition: all 0.2s ease-in-out !important;
    }
    .premium-textarea:focus {
        border-color: #0EA5E9 !important;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.15) !important;
    }

    .form-text-hint { color: rgba(255, 255, 255, 0.35); font-size: 11px; margin-top: 6px; }

    /* Botones Formulario */
    .btn-premium-save {
        background: linear-gradient(135deg, #0EA5E9 0%, #2563EB 100%) !important;
        border: none !important; border-radius: 10px !important; color: #fff !important;
        font-weight: 600 !important; font-size: 14px !important; padding: 12px 24px !important;
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        transition: all 0.2s ease !important; cursor: pointer; width: 100%;
    }
    .btn-premium-save:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(14, 165, 233, 0.3) !important; }
    
    .btn-premium-clear {
        background: rgba(255, 255, 255, 0.04) !important; border: 1px solid rgba(255, 255, 255, 0.08) !important;
        border-radius: 10px !important; color: #94A3B8 !important; font-weight: 500 !important;
        font-size: 14px !important; padding: 11px 24px !important; display: inline-flex; align-items: center;
        justify-content: center; gap: 8px; transition: all 0.2s ease !important; width: 100%; margin-top: 10px;
    }
    .btn-premium-clear:hover { background: rgba(255, 255, 255, 0.08) !important; color: #fff !important; }

    /* Estilos de la Tabla */
    .table-premium-mod th {
        background-color: rgba(255, 255, 255, 0.01) !important;
        color: #94A3B8 !important; font-size: 11px !important; font-weight: 600 !important;
        text-transform: uppercase !important; letter-spacing: 0.5px !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06) !important; padding: 16px !important;
        border-top: none !important;
    }
    .table-premium-mod td {
        padding: 16px !important; vertical-align: middle !important;
        color: #E2E8F0 !important; font-size: 14px !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.03) !important;
        border-top: none !important;
    }
    .table-premium-mod tbody tr { transition: background-color 0.2s ease; }
    .table-premium-mod tbody tr:hover { background-color: rgba(255, 255, 255, 0.02) !important; }

    /* Badges de Estado Premium */
    .badge-premium-active {
        background-color: rgba(16, 185, 129, 0.12); color: #34D399;
        border: 1px solid rgba(16, 185, 129, 0.25); font-size: 11px; padding: 5px 12px; border-radius: 30px;
    }
    .badge-premium-inactive {
        background-color: rgba(239, 68, 68, 0.12); color: #F87171;
        border: 1px solid rgba(239, 68, 68, 0.25); font-size: 11px; padding: 5px 12px; border-radius: 30px;
    }

    /* Acciones Tabla */
    .btn-action-edit {
        background: rgba(14, 165, 233, 0.1) !important; border: 1px solid rgba(14, 165, 233, 0.2) !important;
        color: #38BDF8 !important; border-radius: 8px !important; width: 32px; height: 32px;
        display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s; cursor: pointer;
    }
    .btn-action-edit:hover { background: #0EA5E9 !important; color: #fff !important; transform: scale(1.05); }

    .btn-action-delete {
        background: rgba(239, 68, 68, 0.1) !important; border: 1px solid rgba(239, 68, 68, 0.2) !important;
        color: #F87171 !important; border-radius: 8px !important; width: 32px; height: 32px;
        display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s; cursor: pointer;
    }
    .btn-action-delete:hover { background: #EF4444 !important; color: #fff !important; transform: scale(1.05); }

    /* Modales */
    .modal-premium-box { background: #0D1324 !important; border: 1px solid rgba(255, 255, 255, 0.08) !important; border-radius: 16px !important; }
    .modal-header-premium, .modal-footer-premium { background: transparent; }
    .border-bottom-divider { border-bottom: 1px solid rgba(255, 255, 255, 0.06) !important; }
    .border-top-divider { border-top: 1px solid rgba(255, 255, 255, 0.06) !important; }

    .btn-premium-modal-close {
        background: rgba(255, 255, 255, 0.04) !important; border: 1px solid rgba(255, 255, 255, 0.08) !important;
        border-radius: 10px !important; color: #94A3B8 !important; font-weight: 500 !important; font-size: 14px !important; padding: 10px 22px !important; transition: all 0.2s;
    }
    .btn-premium-modal-close:hover { background: rgba(255, 255, 255, 0.08) !important; color: #fff !important; }

    .btn-premium-modal-danger {
        background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%) !important; border: none !important;
        border-radius: 10px !important; color: #fff !important; font-weight: 600 !important; font-size: 14px !important; padding: 10px 22px !important; transition: all 0.2s;
    }
    .btn-premium-modal-danger:hover { box-shadow: 0 6px 15px rgba(239, 68, 68, 0.3); }

    .premium-danger-notice { display: flex; align-items: flex-start; background: rgba(239, 68, 68, 0.08); border-left: 4px solid #EF4444; padding: 12px 16px; border-radius: 8px; color: #FCA5A5; font-size: 0.88rem; }
    
    .alert-premium-success { background: rgba(16, 185, 129, 0.1) !important; border: 1px solid rgba(16, 185, 129, 0.2) !important; border-radius: 12px !important; padding: 16px !important; }
    .alert-premium-danger { background: rgba(239, 68, 68, 0.1) !important; border: 1px solid rgba(239, 68, 68, 0.2) !important; border-radius: 12px !important; padding: 16px !important; }

    /* Paginación */
    .card-footer-premium { background: transparent; }
    .custom-premium-pagination .page-item .page-link { background-color: rgba(255, 255, 255, 0.03) !important; border-color: rgba(255, 255, 255, 0.06) !important; color: rgba(255, 255, 255, 0.6) !important; }
    .custom-premium-pagination .page-item.active .page-link { background: linear-gradient(135deg, #0EA5E9 0%, #2563EB 100%) !important; border-color: transparent !important; color: #fff !important; }
    .custom-premium-pagination .page-item.disabled .page-link { background-color: rgba(255, 255, 255, 0.01) !important; border-color: rgba(255, 255, 255, 0.02) !important; color: rgba(255, 255, 255, 0.2) !important; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    // Filtro nativo: Solo letras y tildes
    document.getElementById('nombre').addEventListener('input', function () {
        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]/g, '');
    });

    // Contador dinámico de caracteres en descripción
    const descInput = document.getElementById('descripcion');
    const countSpan = document.getElementById('desc-count');
    countSpan.textContent = descInput.value.length;
    descInput.addEventListener('input', function () {
        countSpan.textContent = this.value.length;
    });

    // Control unificado del modal eliminar
    let formEliminar = null;
    document.querySelectorAll('.btn-eliminar').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById('nombreEliminar').textContent = this.getAttribute('data-nombre');
            formEliminar = this.closest('form');
            $('#modalEliminar').modal('show');
        });
    });

    document.getElementById('btnConfirmarEliminar').addEventListener('click', function () {
        if (formEliminar) formEliminar.submit();
    });

    /**
     * Pasa el formulario lateral al modo "Edición" reactivamente
     */
    function prepararEdicion(id, nombre, descripcion, estado) {
        document.getElementById('form-action-title').innerHTML = '<i class="fas fa-edit" style="color: #F59E0B;"></i> Editar Tipo de Entrega';
        
        const form = document.getElementById('formTipoEntrega');
        form.action = `/admin/tipo-entrega/${id}`; 
        
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('registroId').value = id;
        document.getElementById('nombre').value = nombre;
        document.getElementById('descripcion').value = descripcion;
        document.getElementById('estado').value = estado;
        
        document.getElementById('desc-count').textContent = descripcion.length;
        
        const btnSave = document.getElementById('btnGuardar');
        btnSave.innerHTML = '<i class="fas fa-sync-alt"></i> Actualizar Registro';
        btnSave.style.background = 'linear-gradient(135deg, #F59E0B 0%, #D97706 100%)';
        
        const btnCancel = document.getElementById('btnLimpiar');
        btnCancel.innerHTML = '<i class="fas fa-times"></i> Cancelar';
        
        document.getElementById('nombre').focus();
    }

    /**
     * Devuelve el formulario a su estado original de "Creación"
     */
    function resetFormulario() {
        document.getElementById('form-action-title').innerHTML = '<i class="fas fa-plus-circle" style="color: #0EA5E9;"></i> Nuevo Tipo de Entrega';
        
        const form = document.getElementById('formTipoEntrega');
        form.action = "<?php echo e(route('admin.tipo-entrega.store')); ?>";
        
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('registroId').value = '';
        document.getElementById('nombre').value = '';
        document.getElementById('descripcion').value = '';
        document.getElementById('estado').value = '';
        document.getElementById('desc-count').textContent = '0';
        
        const btnSave = document.getElementById('btnGuardar');
        btnSave.innerHTML = '<i class="fas fa-save"></i> Guardar Registro';
        btnSave.style.background = 'linear-gradient(135deg, #0EA5E9 0%, #2563EB 100%)';
        
        const btnCancel = document.getElementById('btnLimpiar');
        btnCancel.innerHTML = '<i class="fas fa-eraser"></i> Limpiar Campos';
    }

    // Cierre controlado de alertas
    setTimeout(function () {
        document.querySelectorAll('.alert-premium-success, .alert-premium-danger').forEach(function (alert) {
            $(alert).fadeOut('slow');
        });
    }, 4000);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS\Desktop\logistica\resources\views/admin/tipo_entrega/index.blade.php ENDPATH**/ ?>