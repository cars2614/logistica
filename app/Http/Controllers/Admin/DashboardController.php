<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Determinar el rango de fechas según el filtro (UX interactiva)
        $filtro = $request->input('periodo', 'todo');
        $fechas = $this->calcularRangoFechas($filtro);

        // 2. Clave de caché única por filtro para evitar cruce de datos (v2 para limpiar caché corrupto)
        $cacheKey = "dashboard_stats_v2_{$filtro}";

        // 3. Ejecutar consultas (sin caché de serialización para evitar problemas en Windows/XAMPP)
        // Construir condición de fechas de forma dinámica
        $filtrarPorFecha = function($query, $column = 'created_at') use ($fechas, $filtro) {
            if ($filtro !== 'todo') {
                $query->whereBetween($column, [$fechas['inicio'], $fechas['fin']]);
            }
        };

        // ── KPI Cards ──────────────────────────────────────────────
        $qGuias = DB::table('guias');
        $filtrarPorFecha($qGuias);
        $totalGuias = $qGuias->count();

        $qClientes = DB::table('clientes');
        $filtrarPorFecha($qClientes);
        $totalClientes = $qClientes->count();

        $totalVehiculos = DB::table('vehiculos')->count(); // Flota estática
        $totalRutas = DB::table('rutas')->count();

        // ── Guías por Tipo de Entrega (Dona) ───────────────────────
        $qGuiasPorEstado = DB::table('guias')
            ->join('tipo_entregas', 'guias.id_tipo_entrega', '=', 'tipo_entregas.id')
            ->select('tipo_entregas.nombre as estado', DB::raw('COUNT(guias.id) as total'))
            ->groupBy('tipo_entregas.nombre');
        $filtrarPorFecha($qGuiasPorEstado, 'guias.created_at');
        $guiasPorEstado = $qGuiasPorEstado->get();

        // ── Guías por mes — últimos 6 meses (Línea) ───────────────
        // Este gráfico siempre muestra 6 meses hacia atrás independientemente del filtro rápido.
        $guiasPorMes = DB::table('guias')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as mes"),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(6)->startOfMonth())
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        // ── Top 5 Ciudades Activas (Barras horizontales) ─────
        // CORRECCIÓN SQL: Une con clientes y luego con ciudades reales
        $qCiudades = DB::table('guias')
            ->join('clientes', 'guias.id_cliente_destino', '=', 'clientes.id')
            ->join('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
            ->select('ciudades.nombre as ciudad', DB::raw('COUNT(guias.id) as total'))
            ->groupBy('ciudades.nombre')
            ->orderByDesc('total')
            ->limit(5);
        $filtrarPorFecha($qCiudades, 'guias.created_at');
        $ciudadesActivas = $qCiudades->get();

        // ── Vehículos por Tipo (Barras) ────────────────────────────
        // CORRECCIÓN SQL: id_tipo_vehiculo = tipo_vehiculo.id
        $vehiculosPorTipo = DB::table('vehiculos')
            ->join('tipo_vehiculo', 'vehiculos.id_tipo_vehiculo', '=', 'tipo_vehiculo.id')
            ->select('tipo_vehiculo.nombre as tipo', DB::raw('COUNT(vehiculos.id) as total'))
            ->groupBy('tipo_vehiculo.nombre')
            ->get();

        $data = compact(
            'totalGuias', 'totalClientes', 'totalVehiculos', 'totalRutas',
            'guiasPorEstado', 'guiasPorMes', 'ciudadesActivas', 'vehiculosPorTipo'
        );

        // ── Últimas 8 guías registradas (Eloquent con relaciones - Fuera de caché por dinamismo) ──
        $ultimasGuias = Guia::with(['clienteOrigen', 'tipoEntrega'])
            ->orderByDesc('created_at')
            ->limit(8)
            ->get();

        return view('admin.dashboard', array_merge($data, [
            'ultimasGuias' => $ultimasGuias,
            'filtroActual' => $filtro
        ]));
    }

    private function calcularRangoFechas(string $filtro): array
    {
        $inicio = now()->startOfMonth();
        $fin = now()->endOfMonth();

        switch ($filtro) {
            case 'hoy':
                $inicio = now()->startOfDay();
                $fin = now()->endOfDay();
                break;
            case 'esta_semana':
                $inicio = now()->startOfWeek();
                $fin = now()->endOfWeek();
                break;
            case 'este_mes':
                $inicio = now()->startOfMonth();
                $fin = now()->endOfMonth();
                break;
            case 'ano_actual':
                $inicio = now()->startOfYear();
                $fin = now()->endOfYear();
                break;
        }

        return ['inicio' => $inicio, 'fin' => $fin];
    }
}
