@extends('adminlte::page')

@section('title', 'Dashboard — Carga y Logística Tolima')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center header-dashboard-container flex-wrap">
        <div>
            <h1 class="text-white font-weight-bold dashboard-title-main m-0">
                <i class="fas fa-tachometer-alt mr-2"></i>Panel de Control
            </h1>
            <span class="dashboard-date-badge d-block mt-1">
                <i class="fa fa-calendar-alt mr-1"></i> Hoy: {{ \Carbon\Carbon::now()->format('d/m/Y') }}
            </span>
        </div>
        
        <div class="mt-3 mt-sm-0 text-right">
            <a href="{{ route('admin.guia.index') }}" class="btn btn-info btn-sm mr-2 shadow-sm" style="border-radius: 8px; font-weight: 600; padding: 6px 14px;">
                <i class="fas fa-list mr-1"></i> Ir a Guías
            </a>
            <a href="{{ route('admin.vehiculo.index') }}" class="btn btn-outline-light btn-sm shadow-sm" style="border-radius: 8px; font-weight: 600; padding: 6px 14px;">
                <i class="fas fa-truck mr-1"></i> Flota
            </a>
        </div>
    </div>

    {{-- Filtros de Fecha Rápidos --}}
    <div class="mt-3">
        <form method="GET" action="{{ route('admin.dashboard') }}" class="d-flex gap-2">
            <button type="submit" name="periodo" value="hoy" class="btn btn-sm {{ $filtroActual == 'hoy' ? 'btn-primary' : 'btn-outline-secondary text-white' }}" style="border-radius: 20px;">Hoy</button>
            <button type="submit" name="periodo" value="esta_semana" class="btn btn-sm {{ $filtroActual == 'esta_semana' ? 'btn-primary' : 'btn-outline-secondary text-white' }} ml-2" style="border-radius: 20px;">Esta Semana</button>
            <button type="submit" name="periodo" value="este_mes" class="btn btn-sm {{ $filtroActual == 'este_mes' ? 'btn-primary' : 'btn-outline-secondary text-white' }} ml-2" style="border-radius: 20px;">Este Mes</button>
            <button type="submit" name="periodo" value="ano_actual" class="btn btn-sm {{ $filtroActual == 'ano_actual' ? 'btn-primary' : 'btn-outline-secondary text-white' }} ml-2" style="border-radius: 20px;">Este Año</button>
            <button type="submit" name="periodo" value="todo" class="btn btn-sm {{ $filtroActual == 'todo' ? 'btn-primary' : 'btn-outline-secondary text-white' }} ml-2" style="border-radius: 20px;">Histórico Total</button>
        </form>
    </div>
@endsection

@section('content')
<!-- El CSS fue movido a public/css/responsive.css para mejor rendimiento (Cache Busting) -->
<link rel="stylesheet" href="{{ asset('css/responsive.css') }}?v={{ time() }}">

<div class="premium-dashboard">
    
    {{-- ── FILA 1: KPIs Estilo App Móvil ──────────────────── --}}
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-6">
            <div class="kpi-card-premium kpi-dark">
                <div class="kpi-orb"></div>
                <div class="kpi-icon-box"><i class="fas fa-file-alt" style="color: #0EA5E9;"></i></div>
                <div class="kpi-val">{{ $totalGuias }}</div>
                <div class="kpi-label">Total de Guías</div>
                <a href="{{ route('admin.guia.index') }}" class="kpi-footer-link">
                    Ver listado <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-6">
            <div class="kpi-card-premium kpi-green">
                <div class="kpi-orb"></div>
                <div class="kpi-icon-box"><i class="fas fa-users" style="color: #10B981;"></i></div>
                <div class="kpi-val">{{ $totalClientes }}</div>
                <div class="kpi-label">Clientes Registrados</div>
                <a href="{{ route('admin.cliente.index') }}" class="kpi-footer-link">
                    Ver clientes <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-6">
            <div class="kpi-card-premium kpi-purple">
                <div class="kpi-orb"></div>
                <div class="kpi-icon-box"><i class="fas fa-truck" style="color: #A78BFA;"></i></div>
                <div class="kpi-val">{{ $totalVehiculos }}</div>
                <div class="kpi-label">Vehículos Activos</div>
                <a href="{{ route('admin.vehiculo.index') }}" class="kpi-footer-link">
                    Ver flota <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-6">
            <div class="kpi-card-premium kpi-orange">
                <div class="kpi-orb"></div>
                <div class="kpi-icon-box"><i class="fas fa-route" style="color: #F59E0B;"></i></div>
                <div class="kpi-val">{{ $totalRutas }}</div>
                <div class="kpi-label">Rutas Configuradas</div>
                <a href="{{ route('admin.ruta.index') }}" class="kpi-footer-link">
                    Ver mapas <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- ── FILA 2: Gráficas Superiores (Dona y Línea) ─────────────────── --}}
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

    {{-- ── FILA 3: Ciudades y Vehículos (Barras) ──────────────────────── --}}
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

    {{-- ── FILA 4: Tabla de Últimas Guías Registradas ──────────────────── --}}
    <div class="row">
        <div class="col-12">
            <div class="card-custom-premium">
                <div class="card-header-premium">
                    <h3 class="card-title-premium">
                        <i class="fas fa-list" style="color: #6366F1;"></i>Últimas Guías Registradas
                    </h3>
                    <a href="{{ route('admin.guia.index') }}" class="btn btn-sm" style="border-radius: 8px; border: 1px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.04); color: #fff; font-weight: 500;">
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
                            @forelse($ultimasGuias as $guia)
                                <tr>
                                    <td><span style="color: rgba(255,255,255,0.3);">#{{ $guia->id }}</span></td>
                                    <td><strong class="text-white">GUIA-{{ str_pad($guia->id, 5, '0', STR_PAD_LEFT) }}</strong></td>
                                    <td>{{ $guia->clienteOrigen->nombre ?? 'Sin Cliente' }}</td>
                                    <td>
                                        <span class="badge-status-premium">
                                            <i class="fas fa-circle mr-1" style="font-size: 7px; vertical-align: middle;"></i> {{ $guia->tipoEntrega->nombre ?? 'Registrada' }}
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($guia->created_at)->format('d/m/Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No hay guías registradas aún en el sistema.</td>
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
    // ── CAMBIAR EL LOGO E IDENTIDAD DEL MENÚ LATERAL CORPORATIVO ──
    const brandLink = document.querySelector('.brand-link');
    if (brandLink) {
        brandLink.innerHTML = `
            <div class="brand-image-container" style="background: transparent; box-shadow: none; padding: 0; display: flex; align-items: center;">
                <img src="{{ asset('images/logo-carga.png') }}" alt="Logo" style="width: 40px; height: auto; object-fit: contain;">
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
const estadosLabels = @json($guiasPorEstado->pluck('estado'));
const estadosData   = @json($guiasPorEstado->pluck('total'));

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
const mesesLabels = @json($guiasPorMes->pluck('mes'));
const mesesData   = @json($guiasPorMes->pluck('total'));

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
const ciudadesLabels = @json($ciudadesActivas->pluck('ciudad'));
const ciudadesData   = @json($ciudadesActivas->pluck('total'));

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
const vehiculosLabels = @json($vehiculosPorTipo->pluck('tipo'));
const vehiculosData   = @json($vehiculosPorTipo->pluck('total'));

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
@endsection