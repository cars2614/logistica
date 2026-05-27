{{-- resources/views/tracking/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">📦 Rastreo de Guía #{{ $guia->id }}</h4>
        </div>
        <div class="card-body p-0">
            <div id="mapa" style="height: 500px; width: 100%;"></div>
        </div>
        <div class="card-footer">
            <span id="estado-texto" class="text-muted">Cargando ubicación...</span>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
const guiaId = {{ $guia->id }};
const mapa   = L.map('mapa').setView([4.711, -74.072], 12);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap'
}).addTo(mapa);

let marcador  = null;
let polyline  = null;

function actualizarMapa() {
    fetch(`/api/tracking/${guiaId}/ubicaciones`)
        .then(r => r.json())
        .then(data => {
            if (!data.length) {
                document.getElementById('estado-texto').textContent = '⏳ Sin ubicación registrada aún.';
                return;
            }

            const coords  = data.map(u => [parseFloat(u.latitud), parseFloat(u.longitud)]);
            const ultima  = coords[coords.length - 1];
            const ultimaInfo = data[data.length - 1];

            // Línea de trayectoria azul
            if (polyline) {
                polyline.setLatLngs(coords);
            } else {
                polyline = L.polyline(coords, { color: '#2563EB', weight: 5, opacity: 0.8 }).addTo(mapa);
            }

            // Marcador del repartidor
            if (marcador) {
                marcador.setLatLng(ultima);
            } else {
                const icono = L.divIcon({
                    html: '🚚',
                    iconSize: [30, 30],
                    className: ''
                });
                marcador = L.marker(ultima, { icon: icono }).addTo(mapa);
            }

            marcador.bindPopup(`<b>${ultimaInfo.descripcion}</b><br><small>${ultimaInfo.created_at}</small>`).openPopup();
            mapa.flyTo(ultima, 14);

            document.getElementById('estado-texto').textContent = '📍 ' + ultimaInfo.descripcion;
        });
}

actualizarMapa();
setInterval(actualizarMapa, 10000); // refresca cada 10 seg
</script>
@endsection