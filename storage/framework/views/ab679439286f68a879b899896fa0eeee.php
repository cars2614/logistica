<?php $__env->startSection('title', 'Dashboard — Carga y Logística Tolima'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center header-dashboard-container">
        <h1 class="text-white font-weight-bold dashboard-title-main">
            <i class="fas fa-tachometer-alt mr-2"></i>Panel de Control
        </h1>
        <span class="dashboard-date-badge">
            <i class="fa fa-calendar-alt mr-1"></i> Hoy: <?php echo e(\Carbon\Carbon::now()->format('d/m/Y')); ?>

        </span>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    /* ── BARRA DE NAVEGACIÓN SUPERIOR (NAVBAR) TOTALMENTE INTEGRADA ── */
    .main-header.navbar {
        background-color: rgba(10, 15, 30, 0.8) !important; /* Fondo translúcido oscuro */
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06) !important; /* Línea divisoria técnica sutil */
    }

    /* Forzar la desaparición de cualquier fondo residual blanco de AdminLTE */
    .navbar-light, .navbar-white {
        background-color: transparent !important;
    }

    /* Ajuste de todos los iconos y textos de la barra superior a blanco/gris claro */
    .main-header.navbar .nav-link,
    .main-header.navbar .nav-link i,
    .main-header.navbar .navbar-nav .nav-item,
    .main-header.navbar span,
    .main-header.navbar a {
        color: rgba(255, 255, 255, 0.8) !important;
        font-family: 'Inter', sans-serif;
        font-weight: 500;
    }

    /* ¡CORRECCIÓN CRÍTICA! Evita que la fuente Inter destruya los iconos de FontAwesome */
    .main-header.navbar .nav-link i,
    .main-header.navbar i[class*="fa-"] {
        font-family: "Font Awesome 5 Free", "Font Awesome 6 Free", "Font Awesome 5 Brands" !important;
        font-weight: 900 !important;
    }

    /* Efecto Hover en los botones de la barra superior */
    .main-header.navbar .nav-link:hover,
    .main-header.navbar .nav-link:hover i {
        color: #0EA5E9 !important; /* Destello azul de marca */
        background-color: rgba(255, 255, 255, 0.03) !important;
        border-radius: 8px;
    }

    /* Corrección del dropdown del menú de usuario */
    .main-header.navbar .dropdown-menu {
        background-color: #131A2E !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
    }
    .main-header.navbar .dropdown-item {
        color: rgba(255, 255, 255, 0.8) !important;
    }
    .main-header.navbar .dropdown-item:hover {
        background-color: rgba(255, 255, 255, 0.05) !important;
        color: #fff !important;
    }

    /* ── BASE GENERAL Y CONTENEDOR GLOBAL DEL DASHBOARD ── */
    .content-wrapper {
        background-color: #0A0F1E !important; /* Azul oscuro profundo corporativo */
        position: relative;
        overflow-x: hidden;
    }

    /* Cuadrícula sutil técnica de fondo */
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

    /* Brillo ambiental de fondo azul/morado */
    .content-wrapper::after {
        content: "";
        position: absolute;
        width: 700px; height: 700px;
        top: -150px; right: -100px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.07) 0%, transparent 70%);
        pointer-events: none;
        z-index: 1;
    }

    .premium-dashboard {
        font-family: 'Inter', sans-serif;
        position: relative;
        z-index: 2;
        padding: 5px;
    }

    .header-dashboard-container {
        margin-bottom: 20px; 
        padding: 10px 15px; 
        position: relative; 
        z-index: 5;
    }
    .dashboard-title-main {
        font-family: 'Inter', sans-serif; 
        font-size: 24px; 
        letter-spacing: -0.02em;
    }
    .dashboard-title-main i {
        color: #0EA5E9;
    }
    .dashboard-date-badge {
        font-family: 'Inter', sans-serif; 
        font-size: 14px; 
        color: rgba(255,255,255,0.5);
    }
    .dashboard-date-badge i {
        color: #6366F1;
    }
    
    /* ── UNIFICACIÓN DE MENÚ LATERAL (SIDEBAR) ── */
    .main-sidebar {
        background-color: #070B16 !important; 
        border-right: 1px solid rgba(255, 255, 255, 0.04) !important;
    }
    .brand-link {
        background: #070B16 !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
        padding: 14px 12px !important;
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        height: auto !important;
    }
    .brand-link .brand-image-container {
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; background: transparent !important; box-shadow: none !important; padding: 0;
    }
    .brand-link .brand-text-container { display: flex; flex-direction: column; line-height: 1.2; }
    .brand-link .brand-title {
        color: #ffffff !important; font-family: 'Inter', sans-serif !important;
        font-weight: 700 !important; font-size: 13px !important; letter-spacing: 0.3px !important; text-transform: uppercase;
    }
    .brand-link .brand-subtitle {
        color: rgba(255, 255, 255, 0.4) !important; font-family: 'Inter', sans-serif !important;
        font-weight: 500 !important; font-size: 9px !important; letter-spacing: 0.8px !important; text-transform: uppercase; margin-top: 1px;
    }
    .brand-link .brand-text, .brand-link .brand-image { display: none !important; }

    /* ── TARJETAS DE INDICADORES (KPIS) ── */
    .kpi-card-premium {
        border-radius: 16px;
        padding: 24px;
        position: relative;
        overflow: hidden;
        margin-bottom: 24px;
        border: 1px solid rgba(255, 255, 255, 0.04);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
        transition: transform 0.25s ease, border-color 0.25s ease;
    }
    .kpi-card-premium:hover {
        transform: translateY(-4px);
        border-color: rgba(255, 255, 255, 0.1);
    }
    
    .kpi-dark { background: linear-gradient(135deg, #131A2E 0%, #0D1322 100%); }
    .kpi-green { background: linear-gradient(135deg, #063C2E 0%, #03241B 100%); }
    .kpi-purple { background: linear-gradient(135deg, #321663 0%, #1D0B3A 100%); }
    .kpi-orange { background: linear-gradient(135deg, #5C200B 0%, #361103 100%); }
    
    .kpi-orb {
        position: absolute;
        width: 140px; height: 140px;
        border-radius: 50%;
        bottom: -45px; right: -35px;
        pointer-events: none;
    }
    .kpi-dark .kpi-orb { background: radial-gradient(circle, rgba(14, 165, 233, 0.18) 0%, transparent 65%); }
    .kpi-green .kpi-orb { background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 65%); }
    .kpi-purple .kpi-orb { background: radial-gradient(circle, rgba(139, 92, 246, 0.15) 0%, transparent 65%); }
    .kpi-orange .kpi-orb { background: radial-gradient(circle, rgba(245, 158, 11, 0.15) 0%, transparent 65%); }

    .kpi-icon-box {
        width: 44px; height: 44px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.06);
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 16px; color: #fff; font-size: 18px;
    }
    .kpi-val { color: #fff; font-size: 36px; font-weight: 700; letter-spacing: -0.03em; line-height: 1; }
    .kpi-label { color: rgba(255, 255, 255, 0.45); font-size: 11px; font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase; margin-top: 8px; }
    
    .kpi-footer-link {
        display: inline-flex; align-items: center; gap: 5px;
        color: rgba(255, 255, 255, 0.5); font-size: 12px; font-weight: 500;
        margin-top: 18px; transition: color 0.2s ease;
    }
    .kpi-footer-link:hover { color: #38BDF8; text-decoration: none; }

    /* ── TARJETAS CONTENEDORAS DE GRÁFICAS Y TABLAS ── */
    .card-custom-premium {
        background: rgba(13, 19, 35, 0.65) !important; 
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.05);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        margin-bottom: 24px;
        overflow: hidden;
    }
    .card-header-premium {
        padding: 20px 24px;
        background: transparent;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        display: flex; align-items: center; justify-content: space-between;
    }
    .card-title-premium {
        font-size: 15px; font-weight: 600;
        color: #ffffff; margin: 0;
        display: flex; align-items: center; gap: 8px;
    }
    .card-body-premium { padding: 24px; }

    /* ── TABLA DE DATOS MODO OSCURO ── */
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
    }
    .table-premium tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.02);
    }
    .badge-status-premium {
        padding: 5px 12px; border-radius: 6px;
        font-size: 12px; font-weight: 500;
        background: rgba(14, 165, 233, 0.12); color: #38BDF8; border: 1px solid rgba(14, 165, 233, 0.25);
    }

    /* ── RESPONSIVE PARA DISPOSITIVOS MÓVILES (CELULARES) ── */
    @media (max-width: 576px) {
        .header-dashboard-container {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 8px;
            padding: 10px 5px;
        }
        .dashboard-title-main {
            font-size: 20px;
        }
        .kpi-card-premium {
            padding: 16px;
            margin-bottom: 16px;
            border-radius: 12px;
        }
        .kpi-val {
            font-size: 24px;
        }
        .kpi-label {
            font-size: 10px;
            margin-top: 4px;
        }
        .kpi-icon-box {
            width: 36px;
            height: 36px;
            font-size: 14px;
            margin-bottom: 12px;
            border-radius: 8px;
        }
        .kpi-footer-link {
            margin-top: 12px;
            font-size: 11px;
        }
        /* Ajustar espaciado de columnas en móvil para reducir el margen del row */
        .premium-dashboard .row {
            margin-left: -8px;
            margin-right: -8px;
        }
        .premium-dashboard [class*="col-"] {
            padding-left: 8px;
            padding-right: 8px;
        }
    }
</style>

<div class="premium-dashboard">
    
    
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-6">
            <div class="kpi-card-premium kpi-dark">
                <div class="kpi-orb"></div>
                <div class="kpi-icon-box"><i class="fas fa-file-alt" style="color: #0EA5E9;"></i></div>
                <div class="kpi-val"><?php echo e($totalGuias); ?></div>
                <div class="kpi-label">Total de Guías</div>
                <a href="<?php echo e(route('admin.guia.index')); ?>" class="kpi-footer-link">
                    Ver listado <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-6">
            <div class="kpi-card-premium kpi-green">
                <div class="kpi-orb"></div>
                <div class="kpi-icon-box"><i class="fas fa-users" style="color: #10B981;"></i></div>
                <div class="kpi-val"><?php echo e($totalClientes); ?></div>
                <div class="kpi-label">Clientes Registrados</div>
                <a href="<?php echo e(route('admin.cliente.index')); ?>" class="kpi-footer-link">
                    Ver clientes <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-6">
            <div class="kpi-card-premium kpi-purple">
                <div class="kpi-orb"></div>
                <div class="kpi-icon-box"><i class="fas fa-truck" style="color: #A78BFA;"></i></div>
                <div class="kpi-val"><?php echo e($totalVehiculos); ?></div>
                <div class="kpi-label">Vehículos Activos</div>
                <a href="<?php echo e(route('admin.vehiculo.index')); ?>" class="kpi-footer-link">
                    Ver flota <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-6">
            <div class="kpi-card-premium kpi-orange">
                <div class="kpi-orb"></div>
                <div class="kpi-icon-box"><i class="fas fa-route" style="color: #F59E0B;"></i></div>
                <div class="kpi-val"><?php echo e($totalRutas); ?></div>
                <div class="kpi-label">Rutas Configuradas</div>
                <a href="<?php echo e(route('admin.ruta.index')); ?>" class="kpi-footer-link">
                    Ver mapas <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-5 col-12">
            <div class="card-custom-premium">
                <div class="card-header-premium">
                    <h3 class="card-title-premium">
                        <i class="fas fa-chart-pie" style="color: #0EA5E9;"></i>Guías por Estado
                    </h3>
                </div>
                <div class="card-body-premium">
                    <div style="position: relative; height: 230px;">
                        <canvas id="chartEstados"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7 col-12">
            <div class="card-custom-premium">
                <div class="card-header-premium">
                    <h3 class="card-title-premium">
                        <i class="fas fa-chart-line" style="color: #10B981;"></i>Guías — Últimos 6 meses
                    </h3>
                </div>
                <div class="card-body-premium">
                    <div style="position: relative; height: 230px;">
                        <canvas id="chartMeses"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="card-custom-premium">
                <div class="card-header-premium">
                    <h3 class="card-title-premium">
                        <i class="fas fa-city" style="color: #F59E0B;"></i>Top 5 Ciudades más Activas
                    </h3>
                </div>
                <div class="card-body-premium">
                    <div style="position: relative; height: 230px;">
                        <canvas id="chartCiudades"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="card-custom-premium">
                <div class="card-header-premium">
                    <h3 class="card-title-premium">
                        <i class="fas fa-truck-moving" style="color: #EF4444;"></i>Vehículos por Tipo
                    </h3>
                </div>
                <div class="card-body-premium">
                    <div style="position: relative; height: 230px;">
                        <canvas id="chartVehiculos"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-12">
            <div class="card-custom-premium">
                <div class="card-header-premium">
                    <h3 class="card-title-premium">
                        <i class="fas fa-list" style="color: #6366F1;"></i>Últimas Guías Registradas
                    </h3>
                    <a href="<?php echo e(route('admin.guia.index')); ?>" class="btn btn-sm" style="border-radius: 8px; border: 1px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.04); color: #fff; font-weight: 500;">
                        <i class="fas fa-eye mr-1"></i>Ver todas
                    </a>
                </div>
                <div class="table-responsive p-0">
                    <table class="table table-hover table-premium text-nowrap m-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>N° Guía</th>
                                <th>Cliente Origen</th>
                                <th>Estado Actual</th>
                                <th>Fecha Admisión</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $ultimasGuias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><span style="color: rgba(255,255,255,0.3);">#<?php echo e($guia->id); ?></span></td>
                                    <td><strong class="text-white">GUIA-<?php echo e(str_pad($guia->id, 5, '0', STR_PAD_LEFT)); ?></strong></td>
                                    <td><?php echo e($guia->clienteOrigen->nombre ?? 'Sin Cliente'); ?></td>
                                    <td>
                                        <span class="badge-status-premium">
                                            <i class="fas fa-circle mr-1" style="font-size: 7px; vertical-align: middle;"></i> <?php echo e($guia->tipoEntrega->nombre ?? 'Registrada'); ?>

                                        </span>
                                    </td>
                                    <td><?php echo e(\Carbon\Carbon::parse($guia->created_at)->format('d/m/Y')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No hay guías registradas aún en el sistema.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // ── CAMBIAR EL LOGO E IDENTIDAD DEL MENÚ LATERAL CORPORATIVO ──
    const brandLink = document.querySelector('.brand-link');
    if (brandLink) {
        brandLink.innerHTML = `
            <div class="brand-image-container" style="background: transparent; box-shadow: none; padding: 0; display: flex; align-items: center;">
                <img src="<?php echo e(asset('images/logo-carga.png')); ?>" alt="Logo" style="width: 40px; height: auto; object-fit: contain;">
            </div>
            <div class="brand-text-container" style="margin-left: 10px; display: flex; flex-direction: column; line-height: 1.2;">
                <span class="brand-title" style="color: #ffffff; font-family: 'Inter', sans-serif; font-weight: 700; font-size: 13px; letter-spacing: 0.3px; text-transform: uppercase;">Carga y Logística</span>
                <span class="brand-subtitle" style="color: rgba(255, 255, 255, 0.4); font-family: 'Inter', sans-serif; font-weight: 500; font-size: 9px; letter-spacing: 0.8px; text-transform: uppercase;">Tolima</span>
            </div>
        `;
    }
});

// Configuración Global de Ejes y Textos para las Gráficas en Modo Oscuro
Chart.defaults.color = 'rgba(255, 255, 255, 0.55)';
Chart.defaults.font.family = "'Inter', sans-serif";

const palette = ['#0EA5E9', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#6366F1', '#F97316'];

// ── 1. Guías por Estado (Dona) ──
const estadosLabels = <?php echo json_encode($guiasPorEstado->pluck('estado'), 15, 512) ?>;
const estadosData   = <?php echo json_encode($guiasPorEstado->pluck('total'), 15, 512) ?>;

new Chart(document.getElementById('chartEstados'), {
    type: 'doughnut',
    data: {
        labels: estadosLabels,
        datasets: [{
            data: estadosData,
            backgroundColor: palette,
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { position: 'bottom', labels: { boxWidth: 11, color: '#fff' } }
        }
    }
});

// ── 2. Guías por Mes (Línea) ──
const mesesLabels = <?php echo json_encode($guiasPorMes->pluck('mes'), 15, 512) ?>;
const mesesData   = <?php echo json_encode($guiasPorMes->pluck('total'), 15, 512) ?>;

new Chart(document.getElementById('chartMeses'), {
    type: 'line',
    data: {
        labels: mesesLabels,
        datasets: [{
            label: 'Guías',
            data: mesesData,
            borderColor: '#10B981',
            backgroundColor: 'rgba(16,185,129,0.08)',
            tension: 0.4,
            fill: true,
            pointRadius: 4,
            pointBackgroundColor: '#10B981'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: { grid: { display: false }, ticks: { color: 'rgba(255,255,255,0.5)' } },
            y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.04)' }, ticks: { stepSize: 1, color: 'rgba(255,255,255,0.5)' } }
        },
        plugins: { legend: { display: false } }
    }
});

// ── 3. Ciudades más Activas (Barras Horizontales) ──
const ciudadesLabels = <?php echo json_encode($ciudadesActivas->pluck('ciudad'), 15, 512) ?>;
const ciudadesData   = <?php echo json_encode($ciudadesActivas->pluck('total'), 15, 512) ?>;

new Chart(document.getElementById('chartCiudades'), {
    type: 'bar',
    data: {
        labels: ciudadesLabels,
        datasets: [{
            label: 'Guías',
            data: ciudadesData,
            backgroundColor: 'rgba(245, 158, 11, 0.8)',
            borderWidth: 0,
            borderRadius: 5,
            barThickness: 16
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: { grid: { display: false }, ticks: { color: 'rgba(255,255,255,0.5)' } },
            x: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.04)' }, ticks: { stepSize: 1, color: 'rgba(255,255,255,0.5)' } }
        },
        plugins: { legend: { display: false } }
    }
});

// ── 4. Vehículos por Tipo (Barras Verticales) ──
const vehiculosLabels = <?php echo json_encode($vehiculosPorTipo->pluck('tipo'), 15, 512) ?>;
const vehiculosData   = <?php echo json_encode($vehiculosPorTipo->pluck('total'), 15, 512) ?>;

new Chart(document.getElementById('chartVehiculos'), {
    type: 'bar',
    data: {
        labels: vehiculosLabels,
        datasets: [{
            label: 'Vehículos',
            data: vehiculosData,
            backgroundColor: 'rgba(239, 68, 68, 0.8)',
            borderWidth: 0,
            borderRadius: 5,
            barThickness: 20
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: { grid: { display: false }, ticks: { color: 'rgba(255,255,255,0.5)' } },
            y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.04)' }, ticks: { stepSize: 1, color: 'rgba(255,255,255,0.5)' } }
        },
        plugins: { legend: { display: false } }
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS\Desktop\logistica\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>