@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')
@inject('preloaderHelper', 'JeroenNoten\LaravelAdminLte\Helpers\PreloaderHelper')

@section('adminlte_css')
    {{-- Custom Global Dark Theme CSS (loads AFTER adminlte.min.css) --}}
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}?v={{ time() }}">
    <style>
        /* Ocultar botón de 3 barras (PushMenu) de AdminLTE solo en PC */
        @media (min-width: 992px) {
            [data-widget="pushmenu"] { display: none !important; }
        }
    </style>
    @stack('css')
    @yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">

        {{-- Preloader Animation (fullscreen mode) --}}
        @if($preloaderHelper->isPreloaderEnabled())
            @include('adminlte::partials.common.preloader')
        @endif

        {{-- Top Navbar --}}
        @if($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        @if(!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif

        {{-- Content Wrapper --}}
        @empty($iFrameEnabled)
            @include('adminlte::partials.cwrapper.cwrapper-default')
        @else
            @include('adminlte::partials.cwrapper.cwrapper-iframe')
        @endempty

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif

        {{-- Right Control Sidebar --}}
        @if($layoutHelper->isRightSidebarEnabled())
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')

    {{-- Validador centralizado de inputs --}}
    <script src="{{ asset('js/app-logistica.js') }}?v={{ time() }}"></script>
    <script>
        $(function () {
            // ── Nombres, ciudades, zonas, sectores ──
            LogisticaValidator.initNameInput(
                'input[name="nombre"], input[name="nombreRol"], ' +
                'input[name="zona"], input[name="sector"], ' +
                'input[name="ciudad"], input[name="name"]'
            );

            // ── Solo dígitos: cédulas, teléfonos, códigos postales, cantidades ──
            LogisticaValidator.initIntegerInput(
                'input[name="cedula"], input[name="telefono"], input[name="numero_telefonico"], ' +
                'input[name="codigo_postal"], input[name="cantidad"]'
            );

            // ── Flotantes: pesos, kilos ──
            LogisticaValidator.initFloatInput(
                'input[name="kilos"], input[name="peso"], ' +
                'input[name="capacidad"], input[name="peso_total"]'
            );

            // ── Placas vehiculares ──
            LogisticaValidator.initPlateInput('input[name="placa"]');

            // ── Marcas, modelos, tipos de vehículo ──
            LogisticaValidator.initAlphanumericInput(
                'input[name="marca"], input[name="modelo"], ' +
                'input[name="descripcion"], input[name="licencia"]'
            );

            // ── Direcciones ──
            LogisticaValidator.initAddressInput('input[name="direccion"]');

            // ── Códigos de guía en rutas ──
            LogisticaValidator.initCodeInput('input[name="guia"]');
        });
    </script>

    @if ($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Asumiendo que tus modales tienen una clase común o identificas cuál falló
            // Si el error contiene campos de la planilla, abrimos el modal de planillas
            @if ($errors->has('ruta_id') || $errors->has('vehiculo_id') || $errors->has('kilos'))
                $('#modal-crear-planilla').modal('show');
            @endif

            @if ($errors->has('id_tipo_entrega') || $errors->has('id_cliente_origen') || $errors->has('id_cliente_destino'))
                $('#modal-crear-guia').modal('show');
            @endif
        });
    </script>
    @endif
@stop
