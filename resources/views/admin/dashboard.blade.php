@extends('adminlte::page')

@section('title', 'Dashboard — Carga y Logística Tolima')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="dashboard-title">
            <i class="fas fa-tachometer-alt mr-2"></i>Panel de Control
        </h1>
        <span class="dashboard-date">
            <i class="fa fa-calendar-alt mr-1"></i> Hoy: {{ \Carbon\Carbon::now()->format('d/m/Y') }}
        </span>
    </div>
@endsection

@section('css')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    /* ── VARIABLES ── */
    :root {
        --dark:    #080C14;
        --dark2:   #0D1220;
        --card:    #0F1628;
        --border:  rgba(59,130,246,0.12);
        --blue:    #3B82F6;
        --indigo:  #6366F1;
        --cream:   #F0F4FF;
        --muted:   rgba(240,244,255,0.5);
    }

    body, h1, h2, h3, h4, h5, h6, p, a, span, div, td, th, label, input, select, textarea, button, .nav-link, .brand-text {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }
    i[class*="fa-"], i[class*="fas"], i[class*="far"], i[class*="fab"] {
        font-family: "Font Awesome 5 Free", "Font Awesome 6 Free" !important;
        font-weight: 900 !important;
    }

    /* ── NAVBAR ── */
    .main-header.navbar {
        background: var(--dark2) !important;
        border-bottom: 1px solid var(--border) !important;
        backdrop-filter: blur(12px) !important;
    }
    .navbar-light, .navbar-white { background: transparent !important; }
    .main-header.navbar .nav-link,
    .main-header.navbar span,
    .main-header.navbar a { color: rgba(240,244,255,0.8) !important; }
    .main-header.navbar .nav-link i,
    .main-header.navbar i[class*="fa-"] {
        font-family: "Font Awesome 5 Free","Font Awesome 6 Free" !important;
        font-weight: 900 !important;
    }
    .main-header.navbar .nav-link:hover { color: var(--blue) !important; }
    .main-header.navbar .dropdown-menu {
        background: #131A2E !important;
        border: 1px solid var(--border) !important;
    }
    .main-header.navbar .dropdown-item { color: rgba(240,244,255,0.8) !important; }
    .main-header.navbar .dropdown-item:hover { background: rgba(59,130,246,0.08) !important; color: #fff !important; }

    /* ── SIDEBAR ── */
    .main-sidebar {
        background: var(--dark) !important;
        border-right: 1px solid var(--border) !important;
    }
    .brand-link {
        background: var(--dark) !important;
        border-bottom: 1px solid var(--border) !important;
        padding: 14px 16px !important;
    }
    .brand-text { color: #fff !important; font-weight: 700 !important; font-size: 14px !important; }
    .nav-sidebar .nav-header {
        color: rgba(99,130,200,0.6) !important;
        font-size: 10px !important; font-weight: 700 !important;
        letter-spacing: 0.12em !important;
    }
    .nav-sidebar .nav-link {
        color: rgba(200,215,255,0.7) !important;
        border-radius: 8px !important;
        margin: 2px 8px !important;
        font-size: 13px !important; font-weight: 500 !important;
        transition: all 0.2s !important;
    }
    .nav-sidebar .nav-link:hover { background: rgba(59,130,246,0.1) !important; color: #fff !important; }
    .nav-sidebar .nav-link.active {
        background: linear-gradient(135deg, rgba(59,130,246,0.2), rgba(99,102,241,0.15)) !important;
        color: #fff !important;
        border-left: 3px solid var(--blue) !important;
        font-weight: 600 !important;
    }
    .nav-sidebar .nav-link i { font-family: "Font Awesome 5 Free","Font Awesome 6 Free" !important; font-weight: 900 !important; }

    /* ── CONTENT WRAPPER ── */
    .content-wrapper {
        background: var(--dark) !important;
        position: relative; overflow-x: hidden;
    }
    .content-wrapper::before {
        content: "";
        position: absolute; inset: 0;
        background-image:
            linear-gradient(rgba(255,255,255,0.015) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.015) 1px, transparent 1px);
        background-size: 40px 40px;
        pointer-events: none; z-index: 0;
    }
    .content-wrapper::after {
        content: "";
        position: absolute;
        width: 600px; height: 600px;
        top: -100px; right: -100px;
        background: radial-gradient(circle, rgba(99,102,241,0.07) 0%, transparent 70%);
        pointer-events: none; z-index: 0;
    }
    .content-header, .content { position: relative; z-index: 2; }

    /* ── HEADER TÍTULOS ── */
    .dashboard-title {
        color: #fff !important; font-size: 22px !important;
        font-weight: 700 !important; letter-spacing: -0.3px;
    }
    .dashboard-title i { color: var(--blue); }
    .dashboard-date { color: var(--muted); font-size: 13px; }
    .dashboard-date i { color: var(--indigo); }

    /* ── KPI CARDS ── */
    .kpi-card {
        border-radius: 16px; padding: 24px;
        position: relative; overflow: hidden;
        margin-bottom: 24px;
        border: 1px solid rgba(255,255,255,0.05);
        box-shadow: 0 12px 30px rgba(0,0,0,0.3);
        transition: transform 0.25s, border-color 0.25s;
        cursor: pointer;
    }
    .kpi-card:hover { transform: translateY(-4px); border-color: rgba(255,255,255,0.1); }

    .kpi-blue   { background: linear-gradient(135deg, #0F1E3A 0%, #091224 100%); }
    .kpi-green  { background: linear-gradient(135deg, #063C2E 0%, #03241B 100%); }
    .kpi-purple { background: linear-gradient(135deg, #1E1063 0%, #120A3A 100%); }
    .kpi-orange { background: linear-gradient(135deg, #3A1E06 0%, #1E0E03 100%); }

    .kpi-orb {
        position: absolute; width: 130px; height: 130px;
        border-radius: 50%; bottom: -40px; right: -30px;
        pointer-events: none;
    }
    .kpi-blue   .kpi-orb { background: radial-gradient(circle, rgba(59,130,246,0.2) 0%, transparent 65%); }
    .kpi-green  .kpi-orb { background: radial-gradient(circle, rgba(16,185,129,0.18) 0%, transparent 65%); }
    .kpi-purple .kpi-orb { background: radial-gradient(circle, rgba(99,102,241,0.2) 0%, transparent 65%); }
    .kpi-orange .kpi-orb { background: radial-gradient(circle, rgba(245,158,11,0.18) 0%, transparent 65%); }

    .kpi-icon {
        width: 42px; height: 42px; border-radius: 12px;
        background: rgba(255,255,255,0.06);
        display: flex; align-items: center; justify-content: center;
        font-size: 17px; margin-bottom: 16px;
    }
    .kpi-number {
        color: #fff; font-size: 38px; font-weight: 800;
        letter-spacing: -0.04em; line-height: 1;
    }
    .kpi-label {
        color: var(--muted); font-size: 10.5px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.08em; margin-top: 8px;
    }
    .kpi-link {
        display: inline-flex; align-items: center; gap: 5px;
        color: rgba(255,255,255,0.4); font-size: 12px; font-weight: 500;
        margin-top: 16px; text-decoration: none;
        transition: color 0.2s;
    }
    .kpi-link:hover { color: var(--blue); text-decoration: none; }

    /* ── CHART CARDS ── */
    .chart-card {
        background: rgba(13,19,35,0.7) !important;
        backdrop-filter: blur(16px);
        border-radius: 16px;
        border: 1px solid rgba(255,255,255,0.05);
        box-shadow: 0 12px 30px rgba(0,0,0,0.25);
        margin-bottom: 24px; overflow: hidden;
    }
    .chart-card-header {
        padding: 18px 22px;
        border-bottom: 1px solid rgba(255,255,255,0.05);
        display: flex; align-items: center; gap: 8px;
    }
    .chart-card-title {
        font-size: 14px; font-weight: 600;
        color: #fff; margin: 0;
    }
    .chart-card-body { padding: 22px; }

    /* ── TABLA ── */
    .table-dark-custom th {
        background: rgba(255,255,255,0.02) !important;
        color: rgba(200,215,255,0.6) !important;
        font-size: 11px !important; font-weight: 600 !important;
        text-transform: uppercase !important; letter-spacing: 0.06em !important;
        border-bottom: 1px solid rgba(255,255,255,0.06) !important;
        padding: 14px 16px !important;
    }
    .table-dark-custom td {
        color: #C8D7FF !important;
        font-size: 13.5px !important;
        padding: 14px 16px !important;
        vertical-align: middle !important;
        border-bottom: 1px solid rgba(255,255,255,0.03) !important;
    }
    .table-dark-custom tbody tr:hover { background: rgba(59,130,246,0.04) !important; }

    .badge-guia {
        padding: 4px 12px; border-radius: 6px; font-size: 11.5px; font-weight: 500;
        background: rgba(59,130,246,0.12); color: #60A5FA;
        border: 1px solid rgba(59,130,246,0.2);
    }

    /* ── DROPDOWN USUARIO / CERRAR SESIÓN ── */
    .main-header .dropdown-menu {
        background: #0F1628 !important;
        border: 1px solid rgba(59,130,246,0.15) !important;
        border-radius: 10px !important;
        box-shadow: 0 8px 24px rgba(0,0,0,0.4) !important;
        padding: 6px !important;
        min-width: 180px !important;
    }
    .main-header .dropdown-item {
        color: rgba(200,215,255,0.85) !important;
        border-radius: 7px !important;
        padding: 9px 14px !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        transition: background 0.2s !important;
    }
    .main-header .dropdown-item:hover {
        background: rgba(59,130,246,0.1) !important;
        color: #fff !important;
    }
    .main-header .dropdown-item i {
        font-family: "Font Awesome 5 Free","Font Awesome 6 Free" !important;
        font-weight: 900 !important;
        color: rgba(200,215,255,0.5) !important;
        margin-right: 8px !important;
    }
    .main-header .dropdown-divider {
        border-color: rgba(59,130,246,0.1) !important;
    }

    /* ── FOOTER ── */
    .main-footer {
        background: var(--dark2) !important;
        border-top: 1px solid var(--border) !important;
        color: var(--muted) !important;
    }
</style>
@endsection

@section('content')
<div style="position: relative; z-index: 2;">

    {{-- KPI CARDS --}}
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="kpi-card kpi-blue">
                <div class="kpi-orb"></div>
                <div class="kpi-icon"><i class="fas fa-file-alt" style="color:#3B82F6;"></i></div>
                <div class="kpi-number">{{ $totalGuias }}</div>
                <div class="kpi-label">Total de Guías</div>
                <a href="{{ route('admin.guia.index') }}" class="kpi-link">Ver listado <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="kpi-card kpi-green">
                <div class="kpi-orb"></div>
                <div class="kpi-icon"><i class="fas fa-users" style="color:#10B981;"></i></div>
                <div class="kpi-number">{{ $totalClientes }}</div>
                <div class="kpi-label">Clientes Registrados</div>
                <a href="{{ route('admin.cliente.index') }}" class="kpi-link">Ver clientes <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="kpi-card kpi-purple">
                <div class="kpi-orb"></div>
                <div class="kpi-icon"><i class="fas fa-truck" style="color:#A78BFA;"></i></div>
                <div class="kpi-number">{{ $totalVehiculos }}</div>
                <div class="kpi-label">Vehículos Activos</div>
                <a href="{{ route('admin.vehiculo.index') }}" class="kpi-link">Ver flota <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="kpi-card kpi-orange">
                <div class="kpi-orb"></div>
                <div class="kpi-icon"><i class="fas fa-route" style="color:#F59E0B;"></i></div>
                <div class="kpi-number">{{ $totalRutas }}</div>
                <div class="kpi-label">Rutas Configuradas</div>
                <a href="{{ route('admin.ruta.index') }}" class="kpi-link">Ver mapas <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>

    {{-- GRÁFICAS FILA 1 --}}
    <div class="row">
        <div class="col-md-5">
            <div class="chart-card">
                <div class="chart-card-header">
                    <i class="fas fa-chart-pie" style="color:#3B82F6;"></i>
                    <h3 class="chart-card-title">Guías por Estado</h3>
                </div>
                <div class="chart-card-body">
                    <div style="height:220px;"><canvas id="chartEstados"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="chart-card">
                <div class="chart-card-header">
                    <i class="fas fa-chart-line" style="color:#10B981;"></i>
                    <h3 class="chart-card-title">Guías — Últimos 6 meses</h3>
                </div>
                <div class="chart-card-body">
                    <div style="height:220px;"><canvas id="chartMeses"></canvas></div>
                </div>
            </div>
        </div>
    </div>

    {{-- GRÁFICAS FILA 2 --}}
    <div class="row">
        <div class="col-md-6">
            <div class="chart-card">
                <div class="chart-card-header">
                    <i class="fas fa-city" style="color:#F59E0B;"></i>
                    <h3 class="chart-card-title">Top 5 Ciudades más Activas</h3>
                </div>
                <div class="chart-card-body">
                    <div style="height:220px;"><canvas id="chartCiudades"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="chart-card">
                <div class="chart-card-header">
                    <i class="fas fa-truck-moving" style="color:#EF4444;"></i>
                    <h3 class="chart-card-title">Vehículos por Tipo</h3>
                </div>
                <div class="chart-card-body">
                    <div style="height:220px;"><canvas id="chartVehiculos"></canvas></div>
                </div>
            </div>
        </div>
    </div>

    {{-- TABLA ÚLTIMAS GUÍAS --}}
    <div class="row">
        <div class="col-12">
            <div class="chart-card">
                <div class="chart-card-header" style="justify-content:space-between;">
                    <div style="display:flex;align-items:center;gap:8px;">
                        <i class="fas fa-list" style="color:#6366F1;"></i>
                        <h3 class="chart-card-title">Últimas Guías Registradas</h3>
                    </div>
                    <a href="{{ route('admin.guia.index') }}" style="border-radius:8px;border:1px solid rgba(255,255,255,0.08);background:rgba(255,255,255,0.04);color:#fff;font-size:12px;font-weight:500;padding:6px 14px;text-decoration:none;">
                        <i class="fas fa-eye mr-1"></i>Ver todas
                    </a>
                </div>
                <div class="table-responsive p-0">
                    <table class="table table-hover table-dark-custom text-nowrap m-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>N° Guía</th>
                                <th>Cliente</th>
                                <th>Estado</th>
                                <th>Fecha Admisión</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ultimasGuias as $guia)
                                <tr>
                                    <td><span style="color:rgba(255,255,255,0.3);">#{{ $guia->id }}</span></td>
                                    <td><strong style="color:#fff;">{{ $guia->num_guias }}</strong></td>
                                    <td>{{ $guia->cliente ?? 'Sin Cliente' }}</td>
                                    <td><span class="badge-guia">{{ $guia->estado ?? 'Registrada' }}</span></td>
                                    <td>{{ \Carbon\Carbon::parse($guia->fecha_admision)->format('d/m/Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4" style="color:rgba(255,255,255,0.3);">
                                        No hay guías registradas aún.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const brandLink = document.querySelector('.brand-link');
    if (brandLink) {
        brandLink.innerHTML = `
            <div style="display:flex;align-items:center;gap:10px;">
                <img src="{{ asset('images/logo-carga.png') }}" alt="Logo" style="width:38px;height:auto;object-fit:contain;">
                <div style="display:flex;flex-direction:column;line-height:1.2;">
                    <span style="color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:13px;letter-spacing:0.3px;text-transform:uppercase;">Carga y Logística</span>
                    <span style="color:rgba(255,255,255,0.4);font-family:'Plus Jakarta Sans',sans-serif;font-weight:500;font-size:9px;letter-spacing:0.8px;text-transform:uppercase;">Tolima</span>
                </div>
            </div>
        `;
    }
});


Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";

const palette = ['#3B82F6','#10B981','#F59E0B','#EF4444','#8B5CF6','#6366F1','#F97316'];

new Chart(document.getElementById('chartEstados'), {
    type: 'doughnut',
    data: {
        labels: @json($guiasPorEstado->pluck('estado')),
        datasets: [{ data: @json($guiasPorEstado->pluck('total')), backgroundColor: palette, borderWidth: 0 }]
    },
    options: { responsive:true, maintainAspectRatio:false, plugins:{ legend:{ position:'bottom', labels:{ boxWidth:10, color:'rgba(200,215,255,0.7)', padding:16 } } } }
});

new Chart(document.getElementById('chartMeses'), {
    type: 'line',
    data: {
        labels: @json($guiasPorMes->pluck('mes')),
        datasets: [{ label:'Guías', data: @json($guiasPorMes->pluck('total')), borderColor:'#10B981', backgroundColor:'rgba(16,185,129,0.07)', tension:0.4, fill:true, pointRadius:4, pointBackgroundColor:'#10B981' }]
    },
    options: { responsive:true, maintainAspectRatio:false, scales:{ x:{ grid:{display:false} }, y:{ beginAtZero:true, grid:{ color:'rgba(255,255,255,0.04)' }, ticks:{ stepSize:1 } } }, plugins:{ legend:{display:false} } }
});

new Chart(document.getElementById('chartCiudades'), {
    type: 'bar',
    data: {
        labels: @json($ciudadesActivas->pluck('ciudad')),
        datasets: [{ label:'Guías', data: @json($ciudadesActivas->pluck('total')), backgroundColor:'rgba(245,158,11,0.75)', borderWidth:0, borderRadius:5, barThickness:14 }]
    },
    options: { indexAxis:'y', responsive:true, maintainAspectRatio:false, scales:{ y:{ grid:{display:false} }, x:{ beginAtZero:true, grid:{ color:'rgba(255,255,255,0.04)' }, ticks:{ stepSize:1 } } }, plugins:{ legend:{display:false} } }
});

new Chart(document.getElementById('chartVehiculos'), {
    type: 'bar',
    data: {
        labels: @json($vehiculosPorTipo->pluck('tipo')),
        datasets: [{ label:'Vehículos', data: @json($vehiculosPorTipo->pluck('total')), backgroundColor:'rgba(239,68,68,0.75)', borderWidth:0, borderRadius:5, barThickness:18 }]
    },
    options: { responsive:true, maintainAspectRatio:false, scales:{ x:{ grid:{display:false} }, y:{ beginAtZero:true, grid:{ color:'rgba(255,255,255,0.04)' }, ticks:{ stepSize:1 } } }, plugins:{ legend:{display:false} } }
});
</script>
@endsection
