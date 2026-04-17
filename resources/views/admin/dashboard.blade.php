@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</h1>
@stop

@section('content')

{{-- ── KPI Cards ─────────────────────────────────────────────────────── --}}
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalGuias }}</h3>
                <p>Total de Guías</p>
            </div>
            <div class="icon"><i class="fas fa-file-alt"></i></div>
            <a href="{{ route('admin.guia.index') }}" class="small-box-footer">
                Ver más <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalClientes }}</h3>
                <p>Clientes Registrados</p>
            </div>
            <div class="icon"><i class="fas fa-users"></i></div>
            <a href="{{ route('admin.cliente.index') }}" class="small-box-footer">
                Ver más <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalVehiculos }}</h3>
                <p>Vehículos Activos</p>
            </div>
            <div class="icon"><i class="fas fa-truck"></i></div>
            <a href="{{ route('admin.vehiculo.index') }}" class="small-box-footer">
                Ver más <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $totalRutas }}</h3>
                <p>Rutas Configuradas</p>
            </div>
            <div class="icon"><i class="fas fa-route"></i></div>
            <a href="{{ route('admin.ruta.index') }}" class="small-box-footer">
                Ver más <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

{{-- ── Fila de Gráficas 1 ───────────────────────────────────────────── --}}
<div class="row">

    {{-- Guías por Estado (Dona) --}}
    <div class="col-md-5">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i>Guías por Estado</h3>
            </div>
            <div class="card-body">
                <canvas id="chartEstados" height="220"></canvas>
            </div>
        </div>
    </div>

    {{-- Guías por Mes (Línea) --}}
    <div class="col-md-7">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-line mr-1"></i>Guías — Últimos 6 meses</h3>
            </div>
            <div class="card-body">
                <canvas id="chartMeses" height="220"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- ── Fila de Gráficas 2 ───────────────────────────────────────────── --}}
<div class="row">

    {{-- Ciudades más activas (Barras horizontales) --}}
    <div class="col-md-6">
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-city mr-1"></i>Top 5 Ciudades con más Guías</h3>
            </div>
            <div class="card-body">
                <canvas id="chartCiudades" height="220"></canvas>
            </div>
        </div>
    </div>

    {{-- Vehículos por Tipo (Barras) --}}
    <div class="col-md-6">
        <div class="card card-danger card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-truck-moving mr-1"></i>Vehículos por Tipo</h3>
            </div>
            <div class="card-body">
                <canvas id="chartVehiculos" height="220"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- ── Tabla de Últimas Guías ───────────────────────────────────────── --}}
<div class="row">
    <div class="col-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list mr-1"></i>Últimas Guías Registradas</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-striped text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>N° Guía</th>
                            <th>Cliente</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimasGuias as $guia)
                        <tr>
                            <td>{{ $guia->id_guias }}</td>
                            <td><strong>{{ $guia->num_guias }}</strong></td>
                            <td>{{ $guia->cliente }}</td>
                            <td>
                                <span class="badge badge-info">{{ $guia->estado }}</span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($guia->fecha_admision)->format('d/m/Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No hay guías registradas aún.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('admin.guia.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-eye mr-1"></i>Ver todas las guías
                </a>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
// ── Paleta de colores ──────────────────────────────────────────────────
const palette = ['#3B82F6','#10B981','#F59E0B','#EF4444','#8B5CF6','#06B6D4','#F97316'];

// ── 1. Guías por Estado (Dona) ─────────────────────────────────────────
const estadosLabels = @json($guiasPorEstado->pluck('estado'));
const estadosData   = @json($guiasPorEstado->pluck('total'));

new Chart(document.getElementById('chartEstados'), {
    type: 'doughnut',
    data: {
        labels: estadosLabels,
        datasets: [{
            data: estadosData,
            backgroundColor: palette,
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'bottom' }
        }
    }
});

// ── 2. Guías por Mes (Línea) ───────────────────────────────────────────
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
            backgroundColor: 'rgba(16,185,129,0.15)',
            tension: 0.4,
            fill: true,
            pointRadius: 5,
            pointBackgroundColor: '#10B981'
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 } }
        },
        plugins: { legend: { display: false } }
    }
});

// ── 3. Ciudades más activas (Barras horizontales) ─────────────────────
const ciudadesLabels = @json($ciudadesActivas->pluck('ciudad'));
const ciudadesData   = @json($ciudadesActivas->pluck('total'));

new Chart(document.getElementById('chartCiudades'), {
    type: 'bar',
    data: {
        labels: ciudadesLabels,
        datasets: [{
            label: 'Guías',
            data: ciudadesData,
            backgroundColor: palette,
            borderRadius: 6
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true,
        scales: {
            x: { beginAtZero: true, ticks: { stepSize: 1 } }
        },
        plugins: { legend: { display: false } }
    }
});

// ── 4. Vehículos por Tipo (Barras) ────────────────────────────────────
const vehiculosLabels = @json($vehiculosPorTipo->pluck('tipo'));
const vehiculosData   = @json($vehiculosPorTipo->pluck('total'));

new Chart(document.getElementById('chartVehiculos'), {
    type: 'bar',
    data: {
        labels: vehiculosLabels,
        datasets: [{
            label: 'Vehículos',
            data: vehiculosData,
            backgroundColor: '#EF4444',
            borderRadius: 6
        }]
    },
    
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 } }
        },
        plugins: { legend: { display: false } }
    }
});
</script>
@stop