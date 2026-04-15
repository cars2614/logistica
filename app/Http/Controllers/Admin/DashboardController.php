<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // ── KPI Cards ──────────────────────────────────────────────
        $totalGuias     = DB::table('guias')->count();
        $totalClientes  = DB::table('clientes')->count();
        $totalVehiculos = DB::table('vehiculos')->count();
        $totalRutas     = DB::table('rutas')->count();

        // ── Guías por Tipo de Entrega (Dona) ───────────────────────
        $guiasPorEstado = DB::table('guias')
            ->join('tipo_entregas', 'guias.tipo_entrega_id', '=', 'tipo_entregas.id')
            ->select('tipo_entregas.nombre as estado', DB::raw('COUNT(*) as total'))
            ->groupBy('tipo_entregas.nombre')
            ->get();

        // ── Guías por mes — últimos 6 meses (Línea) ───────────────
        $guiasPorMes = DB::table('guias')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as mes"),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(6)->startOfMonth())
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        // ── Top 5 Clientes con más guías (Barras horizontales) ─────
        $ciudadesActivas = DB::table('guias')
            ->join('clientes', 'guias.cliente_id', '=', 'clientes.id')
            ->select('clientes.nombre as ciudad', DB::raw('COUNT(*) as total'))
            ->groupBy('clientes.nombre')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // ── Vehículos por Tipo (Barras) ────────────────────────────
        $vehiculosPorTipo = DB::table('vehiculos')
            ->join('tipo_vehiculo', 'vehiculos.tipo_vehiculo_id', '=', 'tipo_vehiculo.id')
            ->select('tipo_vehiculo.nombre as tipo', DB::raw('COUNT(*) as total'))
            ->groupBy('tipo_vehiculo.nombre')
            ->get();

        // ── Últimas 8 guías registradas ────────────────────────────
        $ultimasGuias = DB::table('guias')
            ->join('clientes', 'guias.cliente_id', '=', 'clientes.id')
            ->join('tipo_entregas', 'guias.tipo_entrega_id', '=', 'tipo_entregas.id')
            ->select(
                'guias.id_guias',
                'guias.num_guias',
                'clientes.nombre as cliente',
                'tipo_entregas.nombre as estado',
                'guias.fecha_admision'
            )
            ->orderByDesc('guias.fecha_admision')
            ->limit(8)
            ->get();

        return view('admin.dashboard', compact(
            'totalGuias',
            'totalClientes',
            'totalVehiculos',
            'totalRutas',
            'guiasPorEstado',
            'guiasPorMes',
            'ciudadesActivas',
            'vehiculosPorTipo',
            'ultimasGuias'
        ));
    }
}