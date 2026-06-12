<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-0 font-weight-bold" style="font-size: 1.4rem;">
                    <i class="fas fa-route mr-2" style="color: #4e9af1;"></i>Mis Guías Asignadas
                </h3>
                <p class="mb-0 mt-1" style="font-size: 0.85rem; color: #a0aec0;">
                    <i class="fas fa-calendar-day mr-1"></i>Ruta de hoy: <?php echo e(\Carbon\Carbon::now()->format('d/m/Y')); ?>

                </p>
            </div>
            <div style="background: rgba(78,154,241,0.12); border: 1px solid rgba(78,154,241,0.25); border-radius: 10px; padding: 8px 16px; text-align: center;">
                <div style="font-size: 1.4rem; font-weight: 700; color: #4e9af1;" id="reloj">--:--</div>
                <div style="font-size: 0.7rem; color: #a0aec0; text-transform: uppercase; letter-spacing: 1px;">Hora actual</div>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <style>
        .ruta-body {
            background: #1a1f2e;
            min-height: 100vh;
            padding: 1.5rem;
        }

        .guia-card {
            background: #242b3d;
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 14px;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .guia-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.35);
        }

        .guia-card .card-top {
            background: #2d3550;
            padding: 1rem 1.25rem 0.75rem;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .guia-num {
            font-size: 1.05rem;
            font-weight: 700;
            color: #e2e8f0;
            letter-spacing: 0.3px;
        }

        .guia-num span {
            color: #4e9af1;
        }

        .estado-badge {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }

        .badge-en-ruta    { background: rgba(78,154,241,0.18); color: #4e9af1; border: 1px solid rgba(78,154,241,0.35); }
        .badge-entregado  { background: rgba(72,199,142,0.18); color: #48c78e; border: 1px solid rgba(72,199,142,0.35); }
        .badge-novedad    { background: rgba(241,100,100,0.18); color: #f16464; border: 1px solid rgba(241,100,100,0.35); }
        .badge-bodega     { background: rgba(160,174,192,0.15); color: #a0aec0; border: 1px solid rgba(160,174,192,0.25); }

        .guia-body {
            padding: 1.1rem 1.25rem;
        }

        .info-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 0.85rem;
        }

        .info-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 0.85rem;
        }

        .icon-red    { background: rgba(241,100,100,0.15); color: #f16464; }
        .icon-blue   { background: rgba(78,154,241,0.15);  color: #4e9af1; }
        .icon-green  { background: rgba(72,199,142,0.15);  color: #48c78e; }
        .icon-amber  { background: rgba(245,184,75,0.15);  color: #f5b84b; }

        .info-label {
            font-size: 0.72rem;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .info-value {
            font-size: 0.9rem;
            color: #cbd5e0;
            font-weight: 500;
            line-height: 1.3;
        }

        .btn-maps {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            background: rgba(78,154,241,0.15);
            color: #4e9af1;
            border: 1px solid rgba(78,154,241,0.3);
            text-decoration: none;
            margin-top: 5px;
            transition: background 0.2s;
        }

        .btn-maps:hover {
            background: rgba(78,154,241,0.28);
            color: #4e9af1;
            text-decoration: none;
        }

        .tel-link {
            color: #48c78e;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            letter-spacing: 0.3px;
        }

        .tel-link:hover { color: #3daa77; text-decoration: none; }

        .divider {
            border: none;
            border-top: 1px solid rgba(255,255,255,0.06);
            margin: 0.85rem 0;
        }

        .detalle-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 0.8rem;
            color: #a0aec0;
            margin-right: 6px;
            margin-bottom: 6px;
        }

        .acciones {
            padding: 0.75rem 1.25rem 1.1rem;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-accion {
            flex: 1;
            min-width: 110px;
            padding: 8px 12px;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: opacity 0.2s, transform 0.15s;
        }

        .btn-accion:hover { opacity: 0.88; transform: scale(0.98); }

        .btn-en-ruta  { background: rgba(78,154,241,0.2);  color: #4e9af1;  border: 1px solid rgba(78,154,241,0.35); }
        .btn-entregado{ background: rgba(72,199,142,0.2);  color: #48c78e;  border: 1px solid rgba(72,199,142,0.35); }
        .btn-novedad  { background: rgba(241,100,100,0.2); color: #f16464;  border: 1px solid rgba(241,100,100,0.35); }

        .empty-state {
            text-align: center;
            padding: 4rem 1rem;
            color: #4a5568;
        }

        .empty-state i { font-size: 3rem; margin-bottom: 1rem; display: block; }
        .empty-state h5 { color: #718096; font-weight: 600; }
    </style>

    <div class="ruta-body">

        <?php if(session('success')): ?>
            <div class="alert alert-dismissible fade show mb-4"
                 style="background: rgba(72,199,142,0.15); border: 1px solid rgba(72,199,142,0.3); color: #48c78e; border-radius: 10px;"
                 role="alert">
                <i class="fas fa-check-circle mr-2"></i><?php echo e(session('success')); ?>

                <button type="button" class="close" data-dismiss="alert" style="color: #48c78e;">
                    <span>&times;</span>
                </button>
            </div>
        <?php endif; ?>

        
        <?php
            $total     = $guias->count();
            $enRuta    = $guias->filter(fn($g) => optional($g->estadoActual)->estado === 'En ruta')->count();
            $entregado = $guias->filter(fn($g) => optional($g->estadoActual)->estado === 'Entregado')->count();
            $pendiente = $total - $enRuta - $entregado;
        ?>

        <div class="row mb-4" style="gap: 0;">
            <div class="col-6 col-md-3 mb-3">
                <div style="background:#242b3d; border:1px solid rgba(255,255,255,0.07); border-radius:12px; padding:1rem; text-align:center;">
                    <div style="font-size:1.6rem; font-weight:700; color:#e2e8f0;"><?php echo e($total); ?></div>
                    <div style="font-size:0.72rem; color:#718096; text-transform:uppercase; letter-spacing:0.5px;">Total</div>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-3">
                <div style="background:#242b3d; border:1px solid rgba(78,154,241,0.2); border-radius:12px; padding:1rem; text-align:center;">
                    <div style="font-size:1.6rem; font-weight:700; color:#4e9af1;"><?php echo e($enRuta); ?></div>
                    <div style="font-size:0.72rem; color:#718096; text-transform:uppercase; letter-spacing:0.5px;">En ruta</div>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-3">
                <div style="background:#242b3d; border:1px solid rgba(72,199,142,0.2); border-radius:12px; padding:1rem; text-align:center;">
                    <div style="font-size:1.6rem; font-weight:700; color:#48c78e;"><?php echo e($entregado); ?></div>
                    <div style="font-size:0.72rem; color:#718096; text-transform:uppercase; letter-spacing:0.5px;">Entregados</div>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-3">
                <div style="background:#242b3d; border:1px solid rgba(160,174,192,0.15); border-radius:12px; padding:1rem; text-align:center;">
                    <div style="font-size:1.6rem; font-weight:700; color:#a0aec0;"><?php echo e($pendiente); ?></div>
                    <div style="font-size:0.72rem; color:#718096; text-transform:uppercase; letter-spacing:0.5px;">Pendientes</div>
                </div>
            </div>
        </div>

        <div class="row">
            <?php $__empty_1 = true; $__currentLoopData = $guias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $estadoActual = $guia->estadoActual ? $guia->estadoActual->estado : 'Bodega/Asignado';
                    $badgeClass = match($estadoActual) {
                        'En ruta'           => 'en-ruta',
                        'Entregado'         => 'entregado',
                        'Novedad/Devolución'=> 'novedad',
                        default             => 'bodega'
                    };
                ?>

                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="guia-card">

                        
                        <div class="card-top">
                            <div class="guia-num">
                                <i class="fas fa-file-alt mr-1" style="color:#4e9af1; font-size:0.9rem;"></i>
                                Guía <span>#<?php echo e($guia->num_guias ?? $guia->id); ?></span>
                            </div>
                            <span class="estado-badge badge-<?php echo e($badgeClass); ?>"><?php echo e($estadoActual); ?></span>
                        </div>

                        
                        <div class="guia-body">

                            
                            <div class="info-row">
                                <div class="info-icon icon-red">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <div class="info-label">Dirección</div>
                                    <div class="info-value"><?php echo e($guia->clienteDestino->direccion ?? 'Sin dirección'); ?></div>
                                    <a href="https://www.google.com/maps/search/?api=1&query=<?php echo e(urlencode(($guia->clienteDestino->direccion ?? '') . ', ' . ($guia->clienteDestino->ciudad ?? ''))); ?>"
                                       target="_blank" class="btn-maps">
                                        <i class="fas fa-location-arrow"></i> Ver en Maps
                                    </a>
                                </div>
                            </div>

                            
                            <div class="info-row">
                                <div class="info-icon icon-blue">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div>
                                    <div class="info-label">Destinatario</div>
                                    <div class="info-value"><?php echo e($guia->clienteDestino->nombre ?? 'Desconocido'); ?></div>
                                </div>
                            </div>

                            
                            <div class="info-row">
                                <div class="info-icon icon-green">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div>
                                    <div class="info-label">Teléfono</div>
                                    <a href="tel:<?php echo e($guia->clienteDestino->telefono ?? '#'); ?>" class="tel-link">
                                        <?php echo e($guia->clienteDestino->telefono ?? 'N/A'); ?>

                                    </a>
                                </div>
                            </div>

                            <hr class="divider">

                            
                            <div>
                                <span class="detalle-pill">
                                    <i class="fas fa-cubes" style="color:#f5b84b;"></i>
                                    <?php echo e($guia->unidades); ?> und
                                </span>
                                <span class="detalle-pill">
                                    <i class="fas fa-weight-hanging" style="color:#a78bfa;"></i>
                                    <?php echo e($guia->peso); ?> kg
                                </span>
                            </div>

                        </div>

                        
                        <div class="acciones">
                            <?php if($estadoActual !== 'En ruta' && $estadoActual !== 'Entregado'): ?>
                                <form action="<?php echo e(route('repartidor.estado', $guia->id)); ?>" method="POST" style="flex:1; min-width:110px;">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="estado" value="En ruta">
                                    <button type="submit" class="btn-accion btn-en-ruta w-100">
                                        <i class="fas fa-motorcycle"></i> En ruta
                                    </button>
                                </form>
                            <?php endif; ?>

                            <?php if($estadoActual !== 'Entregado'): ?>
                                <form action="<?php echo e(route('repartidor.estado', $guia->id)); ?>" method="POST" style="flex:1; min-width:110px;">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="estado" value="Entregado">
                                    <button type="submit" class="btn-accion btn-entregado w-100">
                                        <i class="fas fa-check"></i> Entregado
                                    </button>
                                </form>
                            <?php endif; ?>

                            <?php if($estadoActual !== 'Novedad/Devolución' && $estadoActual !== 'Entregado'): ?>
                                <form action="<?php echo e(route('repartidor.estado', $guia->id)); ?>" method="POST" style="flex:1; min-width:110px;">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="estado" value="Novedad/Devolución">
                                    <button type="submit" class="btn-accion btn-novedad w-100">
                                        <i class="fas fa-exclamation-triangle"></i> Novedad
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <div class="empty-state">
                        <i class="fas fa-box-open"></i>
                        <h5>No tienes guías asignadas hoy.</h5>
                        <p style="font-size:0.85rem; color:#4a5568;">Cuando te asignen guías aparecerán aquí.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>

    <script>
        // Reloj en tiempo real
        function actualizarReloj() {
            const ahora = new Date();
            const h = String(ahora.getHours()).padStart(2, '0');
            const m = String(ahora.getMinutes()).padStart(2, '0');
            const el = document.getElementById('reloj');
            if (el) el.textContent = h + ':' + m;
        }
        actualizarReloj();
        setInterval(actualizarReloj, 1000);

        // Auto-cerrar alertas
        setTimeout(function () {
            document.querySelectorAll('.alert-dismissible').forEach(function (a) {
                $(a).fadeOut('slow');
            });
        }, 4000);
    </script>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\ASUS\Desktop\logistica\resources\views/repartidor/dashboard.blade.php ENDPATH**/ ?>