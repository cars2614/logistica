@extends('adminlte::page')

@section('title', 'Seguimiento - Guía #' . $guia->id)

@section('content_header')
<div class="d-flex align-items-center justify-content-between flex-wrap premium-container">
    <h1 class="text-white"><i class="fas fa-satellite-dish text-info mr-2"></i>Seguimiento en Tiempo Real — Guía #{{ $guia->id }}</h1>
    <div>
        <a href="/admin/guia" class="btn btn-sm mr-2 text-white" style="background: rgba(255,255,255,0.1); border: none;">
    <i class="fas fa-arrow-left mr-1"></i> Volver al Listado
</a>
        @if($ultimoEstado)
            @php
                $color = match($ultimoEstado->estado) {
                    'En Bodega'  => 'warning',
                    'En Ruta'    => 'info',
                    'Entregado'  => 'success',
                    'Devolución' => 'danger',
                    default      => 'secondary',
                };
            @endphp
            <span class="badge badge-{{ $color }}" style="font-size:.95rem;padding:8px 16px;">
                {{ $ultimoEstado->estado }} &mdash; {{ $ultimoEstado->descripcion }}
            </span>
        @else
            <span class="badge badge-secondary" style="font-size:.95rem;padding:8px 16px;">Sin estados aún</span>
        @endif
    </div>
</div>
@stop

@section('content')
<div class="row premium-container">

    {{-- Columna izquierda --}}
    <div class="col-md-4">

        {{-- Datos del paquete --}}
        <div class="card card-custom-premium">
            <div class="card-header card-header-premium">
                <h3 class="card-title-premium"><i class="fas fa-box text-info mr-1"></i> Datos del Paquete</h3>
            </div>
            <div class="card-body pb-2">
                <table class="table table-premium table-borderless mb-0">
                    <tr><th style="width:45%">Observación</th><td>{{ $guia->observacion ?? 'Ninguna' }}</td></tr>
                    <tr><th>Peso</th><td>{{ $guia->peso }} Kg</td></tr>
                    <tr><th>Volumen</th><td>{{ $guia->volumen }} m³</td></tr>
                    <tr><th>Unidades</th><td>{{ $guia->unidades }}</td></tr>
                    <tr><th>Remitente</th><td>{{ $guia->clienteOrigen->nombre ?? '—' }}</td></tr>
                    <tr><th>Destinatario</th><td>{{ $guia->clienteDestino->nombre ?? '—' }}</td></tr>
                    <tr><th>Tipo de Entrega</th><td>{{ $guia->tipoEntrega->nombre ?? '—' }}</td></tr>
                </table>
            </div>
        </div>

        {{-- Panel de control GPS visible para interactividad directa --}}
        <div class="card card-custom-premium">
            <div class="card-header card-header-premium">
                <h3 class="card-title-premium"><i class="fas fa-map-marker-alt text-success mr-1"></i> Control de Ubicación</h3>
            </div>
            <div class="card-body">

                <div id="alerta-gps" class="alert alert-success alert-dismissible d-none" style="background: rgba(16, 185, 129, 0.12); border: 1px solid rgba(16, 185, 129, 0.2); color: #10B981;">
                    <i class="fas fa-check-circle mr-1"></i>
                    <span id="alerta-mensaje"></span>
                    <button type="button" class="close text-white" data-dismiss="alert"><span>&times;</span></button>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-tag text-info mr-1"></i> Estado del Paquete</label>
                    <select id="select-estado" class="form-control form-control-premium" required>
                        <option value="">— Seleccione un estado —</option>
                        @foreach($estadosDelSistema as $estadoPrincipal => $subtipos)
                            <option value="{{ $estadoPrincipal }}">{{ $estadoPrincipal }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-list text-info mr-1"></i> Detalle del Estado</label>
                    <select id="select-descripcion" class="form-control form-control-premium" disabled required>
                        <option value="">— Seleccione primero un estado —</option>
                    </select>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-crosshairs text-info mr-1"></i> Coordenadas del Punto</label>
                    <div class="row">
                        <div class="col-6">
                            <input type="text" id="input-latitud"  class="form-control form-control-premium form-control-sm" placeholder="Latitud" readonly>
                        </div>
                        <div class="col-6">
                            <input type="text" id="input-longitud" class="form-control form-control-premium form-control-sm" placeholder="Longitud" readonly>
                        </div>
                    </div>
                    <span class="badge badge-warning mt-2 d-block text-left" style="white-space: normal; font-size: 11px;">
                        <i class="fas fa-mouse-pointer mr-1"></i> <b>Modo interactivo:</b> Haz clic en el mapa de la derecha para fijar las coordenadas automáticamente.
                    </span>
                </div>

                <button id="btn-manual" class="btn btn-success btn-block btn-lg mt-2">
                    <i class="fas fa-save mr-1"></i> Registrar Ubicación Seleccionada
                </button>

                <hr class="my-2">
                <button id="btn-transmitir" class="btn btn-info btn-block btn-sm">
                    <i class="fas fa-satellite-dish mr-1"></i> Iniciar Transmisión GPS Móvil
                </button>

            </div>
        </div>

        {{-- Historial de estados --}}
        <div class="card card-custom-premium">
            <div class="card-header card-header-premium">
                <h3 class="card-title-premium"><i class="fas fa-history text-info mr-1"></i> Historial de Estados</h3>
            </div>
            <div class="card-body p-0">
                <div id="timeline-estados" style="max-height:280px;overflow-y:auto;padding:15px;">
                    <p class="text-muted text-center mb-0">Cargando historial...</p>
                </div>
            </div>
        </div>

    </div>

    {{-- Columna derecha: Mapa --}}
    <div class="col-md-8">
        <div class="card card-custom-premium">
            <div class="card-header card-header-premium">
                <h3 class="card-title-premium"><i class="fas fa-map text-info mr-1"></i> Mapa de Recorrido</h3>
                <div class="card-tools">
                    <span id="badge-vivo" class="badge badge-danger d-none">
                        <i class="fas fa-circle"></i> TRANSMITIENDO
                    </span>
                </div>
            </div>
            <div class="card-body p-0">
                <div id="map" style="height:620px;width:100%;cursor:crosshair;"></div>
            </div>
        </div>
    </div>

</div>
@stop

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    .content-wrapper { background-color: #0A0F1E !important; position: relative; font-family: 'Inter', sans-serif; overflow-x: hidden; }
    .content-wrapper::before { content: ""; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-image: linear-gradient(rgba(255, 255, 255, 0.015) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.015) 1px, transparent 1px); background-size: 35px 35px; pointer-events: none; z-index: 1; }
    .premium-container { position: relative; z-index: 2; }
    .card-custom-premium { background: rgba(13, 19, 35, 0.65) !important; backdrop-filter: blur(16px); border-radius: 16px !important; border: 1px solid rgba(255, 255, 255, 0.05) !important; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3) !important; margin-top: 15px; }
    .card-header-premium { padding: 20px 24px !important; background: transparent !important; border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important; }
    .card-title-premium { font-size: 16px; font-weight: 600; color: #ffffff; margin: 0; }
    .table-premium th { background-color: rgba(255, 255, 255, 0.01) !important; color: #94A3B8 !important; font-size: 12px !important; font-weight: 600 !important; text-transform: uppercase !important; border-bottom: 1px solid rgba(255, 255, 255, 0.06) !important; padding: 12px 15px !important; }
    .table-premium td { padding: 12px 15px !important; color: #E2E8F0 !important; border-bottom: 1px solid rgba(255, 255, 255, 0.03) !important; font-size: 13px !important; }
    .form-control-premium { background-color: rgba(255, 255, 255, 0.03) !important; border: 1px solid rgba(255, 255, 255, 0.08) !important; color: #fff !important; border-radius: 8px !important; }
    .form-control-premium option { background-color: #131A2E !important; color: #fff !important; }
    .form-control-premium:focus { border-color: #0EA5E9 !important; box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.15) !important; }
    label { color: #94A3B8; font-weight: 500; }
.estado-item { display:flex; gap:10px; align-items:flex-start; margin-bottom:14px; border-left: 2px solid #e9ecef; padding-left: 10px; }
.estado-punto { width:12px; height:12px; border-radius:50%; flex-shrink:0; margin-top:4px; border:2px solid #fff; box-shadow: 0 0 4px rgba(0,0,0,0.3); }
.estado-punto.bodega    { background:#ffc107; }
.estado-punto.ruta      { background:#17a2b8; }
.estado-punto.entregado { background:#28a745; }
.estado-punto.devolucion{ background:#dc3545; }
.estado-punto.otro      { background:#6c757d; }
.estado-texto strong { font-size:13px; display:block; color:#212529; }
.estado-texto span   { font-size:12px; color:#6c757d; display:block; }
.estado-texto small  { font-size:11px; color:#adb5bd; display:block; }
</style>
@stop

@section('js')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
const estadosMatriz  = @json($estadosDelSistema);
const urlActualizar  = "{{ route('tracking.actualizar',  $guia->id) }}";
const urlUbicaciones = "{{ route('tracking.ubicaciones', $guia->id) }}";
const tokenSeguridad = "{{ csrf_token() }}";

const mapa = L.map('map').setView([4.438, -75.212], 13);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap'
}).addTo(mapa);

let marcadorManual   = null;
let marcadorVivo     = null;
let lineaRuta        = L.polyline([], { color: '#007bff', weight: 5, opacity: 0.85 }).addTo(mapa);
let grupoPuntos      = L.layerGroup().addTo(mapa);
let idGps            = null;

document.getElementById('select-estado').addEventListener('change', function () {
    const sel = document.getElementById('select-descripcion');
    sel.innerHTML = '<option value="">— Seleccione el detalle —</option>';
    if (this.value && estadosMatriz[this.value]) {
        sel.disabled = false;
        estadosMatriz[this.value].forEach(sub => {
            const op = document.createElement('option');
            op.value = sub; op.textContent = sub;
            sel.appendChild(op);
        });
    } else { sel.disabled = true; }
});

mapa.on('click', function(e) {
    const lat = e.latlng.lat;
    const lng = e.latlng.lng;
    
    document.getElementById('input-latitud').value  = lat.toFixed(6);
    document.getElementById('input-longitud').value = lng.toFixed(6);

    if (marcadorManual) {
        marcadorManual.setLatLng([lat, lng]);
    } else {
        marcadorManual = L.marker([lat, lng], { draggable: true }).addTo(mapa)
            .bindPopup("<b>Ubicación Capturada</b><br>Pulsa el botón verde para guardar.").openPopup();
    }
});

function colorSegunEstado(estado) {
    const e = (estado || '').toLowerCase();
    if (e.includes('bodega'))    return '#ffc107';
    if (e.includes('ruta'))      return '#17a2b8';
    if (e.includes('entregado')) return '#28a745';
    if (e.includes('devoluc'))   return '#dc3545';
    return '#6c757d';
}

function claseSegunEstado(estado) {
    const e = (estado || '').toLowerCase();
    if (e.includes('bodega'))    return 'bodega';
    if (e.includes('ruta'))      return 'ruta';
    if (e.includes('entregado')) return 'entregado';
    if (e.includes('devoluc'))   return 'devolucion';
    return 'otro';
}

function mostrarHistorial(puntos) {
    const cont = document.getElementById('timeline-estados');
    if (!puntos || puntos.length === 0) {
        cont.innerHTML = '<p class="text-muted text-center mb-0">No hay estados registrados aún.</p>';
        return;
    }
    cont.innerHTML = [...puntos].reverse().map(p => `
        <div class="estado-item">
            <div class="estado-punto ${claseSegunEstado(p.estado)}"></div>
            <div class="estado-texto">
                <strong>${p.estado} — ${p.descripcion}</strong>
                <span><i class="fas fa-compass mr-1"></i> Lat: ${parseFloat(p.latitud).toFixed(4)}, Lng: ${parseFloat(p.longitud).toFixed(4)}</span>
                <small><i class="far fa-clock mr-1"></i> ${p.created_at ?? ''}</small>
            </div>
        </div>`).join('');
}

function cargarMapa() {
    fetch(urlUbicaciones)
        .then(r => r.json())
        .then(data => {
            if (!data.puntos || data.puntos.length === 0) {
                document.getElementById('timeline-estados').innerHTML = '<p class="text-muted text-center mb-0">Sin historial en la base de datos.</p>';
                return;
            }
            const coords = [];
            grupoPuntos.clearLayers();
            
            data.puntos.forEach((p, i) => {
                const lat = parseFloat(p.latitud);
                const lng = parseFloat(p.longitud);
                if (!lat || !lng) return;
                
                coords.push([lat, lng]);
                
                const circularIcon = L.divIcon({
                    html: `<div style="background:${colorSegunEstado(p.estado)};width:12px;height:12px;border-radius:50%;border:2px solid #fff;box-shadow:0 0 5px rgba(0,0,0,0.4)"></div>`,
                    className: '', iconSize: [12,12], iconAnchor: [6,6]
                });
                
                L.marker([lat, lng], { icon: circularIcon }).addTo(grupoPuntos)
                  .bindPopup(`<b>Parada #${i+1}: ${p.estado}</b><br>${p.descripcion}`);
            });
            
            lineaRuta.setLatLngs(coords);
            if (coords.length > 0 && idGps === null) {
                mapa.panTo(coords[coords.length - 1]);
            }
            mostrarHistorial(data.puntos);
        })
        .catch(e => console.error(e));
}

function enviarUbicacion(lat, lng) {
    const estado = document.getElementById('select-estado').value;
    const desc   = document.getElementById('select-descripcion').value;
    
    if (!estado || !desc) { alert('Debe seleccionar un estado y detalle.'); return; }

    const datos = new FormData();
    datos.append('estado', estado);
    datos.append('descripcion', desc);
    datos.append('latitud', lat);
    datos.append('longitud', lng);
    datos.append('_token', tokenSeguridad);

    fetch(urlActualizar, { method: 'POST', body: datos })
        .then(r => r.json())
        .then(json => {
            if (json.status === 'success') {
                const alerta = document.getElementById('alerta-gps');
                document.getElementById('alerta-mensaje').textContent = `¡Ubicación registrada con éxito!`;
                alerta.classList.remove('d-none');
                
                if (marcadorManual) { mapa.removeLayer(marcadorManual); marcadorManual = null; }
                document.getElementById('input-latitud').value = '';
                document.getElementById('input-longitud').value = '';
                
                cargarMapa();
            } else {
                alert("Error: " + json.mensaje);
            }
        })
        .catch(e => console.error(e));
}

document.getElementById('btn-manual').addEventListener('click', function () {
    const lat = document.getElementById('input-latitud').value;
    const lng = document.getElementById('input-longitud').value;
    if (!lat || !lng) { alert('Por favor haz clic en el mapa para marcar el punto.'); return; }
    enviarUbicacion(lat, lng);
});

document.getElementById('btn-transmitir').addEventListener('click', function () {
    if (!navigator.geolocation) { alert('Su navegador no soporta GPS.'); return; }

    if (idGps === null) {
        idGps = navigator.geolocation.watchPosition(pos => {
            const lat = pos.coords.latitude;
            const lng = pos.coords.longitude;
            document.getElementById('input-latitud').value = lat.toFixed(6);
            document.getElementById('input-longitud').value = lng.toFixed(6);
            
            if (!marcadorVivo) {
                marcadorVivo = L.marker([lat, lng]).addTo(mapa).bindPopup('<b>Dispositivo Móvil</b>').openPopup();
            } else {
                marcadorVivo.setLatLng([lat, lng]);
            }
            mapa.panTo([lat, lng]);
            enviarUbicacion(lat, lng);
        }, err => console.warn(err.message), { enableHighAccuracy: true });

        this.classList.replace('btn-info', 'btn-danger');
        this.innerHTML = '<i class="fas fa-stop mr-1"></i> Detener Transmisión';
        document.getElementById('badge-vivo').classList.remove('d-none');
    } else {
        navigator.geolocation.clearWatch(idGps); idGps = null;
        this.classList.replace('btn-danger', 'btn-info');
        this.innerHTML = '<i class="fas fa-satellite-dish mr-1"></i> Iniciar Transmisión GPS Móvil';
        document.getElementById('badge-vivo').classList.add('d-none');
    }
});

document.addEventListener('DOMContentLoaded', function () {
    cargarMapa();
    setInterval(cargarMapa, 8000); 
});
</script>
@stop