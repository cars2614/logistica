@extends('adminlte::page')

@section('title', 'Editar Ruta')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center header-dashboard-container">
        <h1 class="text-white font-weight-bold dashboard-title-main">
            <i class="fas fa-edit mr-2" style="color: #F59E0B;"></i>Editar Ruta <span style="color: rgba(255,255,255,0.4);">#{{ $ruta->id }}</span>
        </h1>
        <a href="{{ route('admin.ruta.index') }}" class="btn btn-outline-secondary rounded-lg text-white" style="border-color: rgba(255,255,255,0.2);">
            <i class="fas fa-arrow-left mr-1"></i> Volver al listado
        </a>
    </div>
@stop

@section('content')

<div class="card card-custom-premium">
    <div class="card-header-premium">
        <h3 class="card-title-premium">
            <i class="fas fa-map-marked-alt mr-2" style="color: #10B981;"></i>Datos de Cobertura y Georeferenciación
        </h3>
    </div>

    <form action="{{ route('admin.ruta.update', $ruta->id) }}" method="POST" autocomplete="off" id="formEditRuta">
        @csrf
        @method('PUT')

        <div class="card-body-premium">
            <div class="row">
                
                {{-- Formulario Lado Izquierdo --}}
                <div class="col-md-5">
                    <div class="alert premium-alert mb-4">
                        <i class="fas fa-info-circle mr-2" style="color: #0EA5E9;"></i> Arrastra el pin en el mapa para actualizar las coordenadas exactas de la ruta.
                    </div>

                    <div class="form-group">
                        <label class="premium-label">Zona de Cobertura <span class="text-danger">*</span></label>
                        <input type="text" name="zona" id="zona" class="form-control premium-input @error('zona') is-invalid @enderror" value="{{ old('zona', $ruta->zona) }}" required>
                        @error('zona') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="premium-label">Guía Maestra <span class="text-danger">*</span></label>
                        <input type="text" name="guia" id="guia" class="form-control premium-input @error('guia') is-invalid @enderror" value="{{ old('guia', $ruta->guia) }}" required>
                        @error('guia') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="premium-label">Dirección <span class="text-danger">*</span></label>
                        <input type="text" name="direccion" id="direccion" class="form-control premium-input @error('direccion') is-invalid @enderror" value="{{ old('direccion', $ruta->direccion) }}" required>
                        @error('direccion') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="premium-label">Sector <span class="text-danger">*</span></label>
                                <input type="text" name="sector" id="sector" class="form-control premium-input @error('sector') is-invalid @enderror" value="{{ old('sector', $ruta->sector) }}" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="premium-label">Ciudad <span class="text-danger">*</span></label>
                                <input type="text" name="ciudad" id="ciudad" class="form-control premium-input @error('ciudad') is-invalid @enderror" value="{{ old('ciudad', $ruta->ciudad) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="premium-label">Latitud</label>
                                <input type="text" name="latitud" id="latitud_input" class="form-control premium-input" value="{{ old('latitud', $ruta->latitud) }}" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="premium-label">Longitud</label>
                                <input type="text" name="longitud" id="longitud_input" class="form-control premium-input" value="{{ old('longitud', $ruta->longitud) }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Mapa Lado Derecho --}}
                <div class="col-md-7">
                    <div id="edit-map" class="map-container" style="height: 100%; min-height: 450px;"></div>
                </div>

            </div>
        </div>

        <div class="card-footer-premium text-right">
            <button type="submit" class="btn premium-btn-submit" id="btnActualizar">
                <i class="fas fa-sync-alt mr-1"></i> Actualizar Ruta Georeferenciada
            </button>
        </div>

    </form>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        .content-wrapper { background-color: #0A0F1E !important; font-family: 'Inter', sans-serif; }
        .header-dashboard-container { margin-bottom: 20px; padding: 10px 15px; position: relative; z-index: 5; }
        .dashboard-title-main { font-size: 24px; letter-spacing: -0.02em; }

        .card-custom-premium {
            background: rgba(13, 19, 35, 0.65) !important; 
            backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
            border-radius: 16px; border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3); color: #fff;
        }
        .card-header-premium { padding: 20px 24px; border-bottom: 1px solid rgba(255, 255, 255, 0.05); }
        .card-title-premium { font-size: 16px; font-weight: 600; color: #ffffff; margin: 0; display: flex; align-items: center; gap: 8px; }
        .card-body-premium { padding: 24px; }
        .card-footer-premium { padding: 20px 24px; border-top: 1px solid rgba(255, 255, 255, 0.05); background: transparent; }
        
        .map-container {
            width: 100%; border-radius: 12px; border: 1px solid rgba(255,255,255,0.1); background: #1E293B; z-index: 1;
        }

        .premium-alert { background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 8px; color: #E2E8F0; }
        .premium-label { color: #94A3B8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .premium-input {
            background-color: rgba(255, 255, 255, 0.03) !important; border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #fff !important; border-radius: 8px;
        }
        .premium-input:focus { border-color: #0EA5E9 !important; box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.15) !important; }
        
        .premium-btn-submit {
            background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
            border: 1px solid #D97706; color: #fff; border-radius: 8px; font-weight: 600; padding: 10px 24px; transition: all 0.3s;
        }
        .premium-btn-submit:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3); color: #fff; }
        
        .leaflet-layer, .leaflet-control-zoom-in, .leaflet-control-zoom-out, .leaflet-control-attribution { filter: invert(100%) hue-rotate(180deg) brightness(95%) contrast(90%); }
    </style>
@stop

@section('js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            // Si la ruta tiene coordenadas previas las usamos, sino, Ibagué por defecto
            let lat = {{ $ruta->latitud ?? '4.4389' }};
            let lng = {{ $ruta->longitud ?? '-75.2322' }};
            const mapColor = '{{ $ruta->color_hex ?? '#0EA5E9' }}';

            const editMap = L.map('edit-map').setView([lat, lng], 14);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(editMap);

            // Icono Customizado
            const markerHtml = `<div style="background-color: ${mapColor}; width: 24px; height: 24px; border-radius: 50%; border: 3px solid #131A2E; box-shadow: 0 0 15px ${mapColor};"></div>`;
            const customIcon = L.divIcon({
                className: 'custom-div-icon',
                html: markerHtml,
                iconSize: [24, 24],
                iconAnchor: [12, 12]
            });

            // Añadir pin arrastrable
            const marker = L.marker([lat, lng], { icon: customIcon, draggable: true }).addTo(editMap);

            // Actualizar inputs en el arrastre
            marker.on('dragend', function (e) {
                const position = marker.getLatLng();
                $('#latitud_input').val(position.lat.toFixed(8));
                $('#longitud_input').val(position.lng.toFixed(8));
            });

            // Evitar problemas de recuadro gris
            setTimeout(() => {
                editMap.invalidateSize();
            }, 200);

            // Evitar múltiples envíos
            $('#formEditRuta').on('submit', function() {
                $('#btnActualizar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Actualizando...');
            });
        });
    </script>
@stop