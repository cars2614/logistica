@extends('adminlte::page')

@section('title', 'Gestión de Rutas')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center header-dashboard-container">
        <h1 class="text-white font-weight-bold dashboard-title-main">
            <i class="fas fa-route mr-2" style="color: #F59E0B;"></i>Gestión de Cobertura y Rutas
        </h1>
        <button class="btn premium-btn-submit" data-toggle="modal" data-target="#modalCrear">
            <i class="fas fa-plus mr-1"></i> Nueva Ruta
        </button>
    </div>
@stop

@section('content')
<div class="row">
    {{-- Mapa Interactivo Principal (Lado Izquierdo) --}}
    <div class="col-lg-7 col-md-12 mb-4">
        <div class="card card-custom-premium h-100 mb-0">
            <div class="card-header-premium">
                <h3 class="card-title-premium">
                    <i class="fas fa-map-marked-alt mr-2" style="color: #0EA5E9;"></i>Mapa de Zonas de Cobertura
                </h3>
            </div>
            <div class="card-body-premium p-2">
                <div id="main-map" class="map-container"></div>
            </div>
        </div>
    </div>

    {{-- Listado de Rutas (Lado Derecho) --}}
    <div class="col-lg-5 col-md-12 mb-4">
        <div class="card card-custom-premium h-100 mb-0">
            <div class="card-header-premium">
                <h3 class="card-title-premium">
                    <i class="fas fa-list-ul mr-2" style="color: #10B981;"></i>Directorio de Rutas
                </h3>
            </div>
            <div class="card-body-premium p-0" style="max-height: 500px; overflow-y: auto;">
                @forelse($rutas as $ruta)
                    <div class="route-item d-flex align-items-center justify-content-between p-3 border-bottom border-light-alpha">
                        <div class="d-flex align-items-center">
                            <div class="route-color-indicator" style="background-color: {{ $ruta->color_hex ?? '#0EA5E9' }};"></div>
                            <div>
                                <h6 class="mb-0 font-weight-bold text-white">{{ $ruta->zona }} <span class="text-xs text-muted ml-2">Guía: {{ $ruta->guia }}</span></h6>
                                <small class="text-muted d-block"><i class="fas fa-map-marker-alt mr-1"></i>{{ $ruta->direccion }}, {{ $ruta->ciudad }}</small>
                                <div class="mt-1">
                                    <span class="badge-status-premium" style="color: #6366F1; border-color: rgba(99, 102, 241, 0.25); background: rgba(99, 102, 241, 0.12);" title="Planillas Asociadas" data-toggle="tooltip">
                                        <i class="fas fa-clipboard-list mr-1"></i> {{ $ruta->planillas_count ?? 0 }} Planillas
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="btn-group premium-btn-group">
                            <button class="btn btn-sm btn-outline-info btn-center-map" data-lat="{{ $ruta->latitud }}" data-lng="{{ $ruta->longitud }}" title="Ubicar en Mapa" data-toggle="tooltip">
                                <i class="fas fa-crosshairs"></i>
                            </button>
                            <a href="{{ route('admin.ruta.edit', $ruta->id) }}" class="btn btn-sm btn-outline-primary" title="Editar" data-toggle="tooltip">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger btn-eliminar" data-id="{{ $ruta->id }}" data-zona="{{ $ruta->zona }}" data-ciudad="{{ $ruta->ciudad }}" title="Eliminar" data-toggle="tooltip">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form id="formEliminar{{ $ruta->id }}" action="{{ route('admin.ruta.destroy', $ruta->id) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="fas fa-map fa-3x mb-3" style="color: rgba(255,255,255,0.1);"></i>
                        <h5 class="text-muted">No hay rutas registradas</h5>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- Modal Crear --}}
<div class="modal fade dark-modal" id="modalCrear" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-fullscreen-md-down" role="document">
        <div class="modal-content premium-modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title font-weight-bold text-white"><i class="fas fa-plus-circle mr-2" style="color: #10B981;"></i> Registrar Nueva Ruta</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.ruta.store') }}" method="POST" autocomplete="off" id="formCrearRuta">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        {{-- Formulario --}}
                        <div class="col-md-5">
                            <div class="alert premium-alert mb-4">
                                <i class="fas fa-info-circle mr-2" style="color: #0EA5E9;"></i> Arrastra el pin en el mapa para capturar las coordenadas exactas de la ruta.
                            </div>
                            <div class="form-group">
                                <label class="premium-label">Zona de Cobertura <span class="text-danger">*</span></label>
                                <input type="text" name="zona" id="c_zona" class="form-control premium-input @error('zona') is-invalid @enderror" value="{{ old('zona') }}" placeholder="Ej: Norte, Sur, Centro..." required>
                            </div>
                            <div class="form-group">
                                <label class="premium-label">Guía Maestra <span class="text-danger">*</span></label>
                                <input type="text" name="guia" id="c_guia" class="form-control premium-input @error('guia') is-invalid @enderror" value="{{ old('guia') }}" placeholder="Ej: RUTA-01" required>
                            </div>
                            <div class="form-group">
                                <label class="premium-label">Dirección <span class="text-danger">*</span></label>
                                <input type="text" name="direccion" id="c_direccion" class="form-control premium-input @error('direccion') is-invalid @enderror" value="{{ old('direccion') }}" placeholder="Dirección referencial" required>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="premium-label">Sector <span class="text-danger">*</span></label>
                                        <input type="text" name="sector" id="c_sector" class="form-control premium-input @error('sector') is-invalid @enderror" value="{{ old('sector') }}" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="premium-label">Ciudad <span class="text-danger">*</span></label>
                                        <input type="text" name="ciudad" id="c_ciudad" class="form-control premium-input @error('ciudad') is-invalid @enderror" value="{{ old('ciudad') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="premium-label">Latitud</label>
                                        <input type="text" name="latitud" id="latitud_input" class="form-control premium-input" readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="premium-label">Longitud</label>
                                        <input type="text" name="longitud" id="longitud_input" class="form-control premium-input" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Mapa Modal --}}
                        <div class="col-md-7">
                            <div id="modal-map-container" class="map-container" style="height: 100%; min-height: 400px;"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary rounded-lg" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn premium-btn-submit" id="c_btnGuardar"><i class="fas fa-save mr-1"></i> Guardar Ruta Georeferenciada</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Confirmar Eliminar --}}
<div class="modal fade dark-modal" id="modalEliminar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-md-down" role="document">
        <div class="modal-content premium-modal-content" style="border-color: rgba(239, 68, 68, 0.3);">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title font-weight-bold text-white"><i class="fas fa-exclamation-triangle mr-2 text-danger"></i> Confirmar Eliminación</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="alert premium-alert mb-0" style="background: rgba(239, 68, 68, 0.1); border-color: rgba(239, 68, 68, 0.2);">
                    <p class="mb-1 text-white">¿Estás seguro que deseas eliminar la ruta zona:</p>
                    <strong id="elim_zona" class="text-danger d-block text-lg mb-1"></strong>
                    <p class="mb-1 text-white">en <strong id="elim_ciudad"></strong>?</p>
                    <p class="mt-3 mb-0 text-muted small"><i class="fas fa-info-circle"></i> Esta acción no se puede deshacer.</p>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-center">
                <button type="button" class="btn btn-outline-secondary rounded-lg px-4" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger rounded-lg px-4" id="btnConfirmarEliminar" style="background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%); border-color: #DC2626;">
                    <i class="fas fa-trash-alt mr-1"></i> Eliminar Definitivamente
                </button>
            </div>
        </div>
    </div>
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
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }
        @media (max-width: 768px) {
            .card-custom-premium {
                backdrop-filter: blur(4px);
                -webkit-backdrop-filter: blur(4px);
                background: rgba(13, 19, 35, 0.9) !important;
            }
        }
        .card-header-premium {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        .card-title-premium {
            font-size: 16px; font-weight: 600; color: #ffffff; margin: 0;
            display: flex; align-items: center; gap: 8px;
        }
        
        .map-container {
            width: 100%; height: 500px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.1);
            background: #1E293B;
            z-index: 1; /* Fix Leaflet overlap */
        }

        .border-light-alpha { border-color: rgba(255,255,255,0.05) !important; }
        .route-item { transition: all 0.2s ease; }
        .route-item:hover { background-color: rgba(255,255,255,0.02); }
        .route-color-indicator { width: 12px; height: 12px; border-radius: 50%; margin-right: 15px; box-shadow: 0 0 10px rgba(255,255,255,0.2); }

        .premium-btn-group .btn {
            border-radius: 6px !important; margin: 0 3px;
            background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.1); color: #E2E8F0; transition: all 0.2s;
        }
        .premium-btn-group .btn:hover { background: rgba(255,255,255,0.1); color: #fff; transform: translateY(-2px); }
        .premium-btn-group .btn-outline-info:hover { color: #0EA5E9; border-color: #0EA5E9; }
        .premium-btn-group .btn-outline-primary:hover { color: #10B981; border-color: #10B981; }
        .premium-btn-group .btn-outline-danger:hover { color: #EF4444; border-color: #EF4444; }

        .premium-modal-content {
            background: #131A2E !important; border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1); box-shadow: 0 25px 50px rgba(0,0,0,0.5);
        }
        .premium-alert { background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 8px; color: #E2E8F0; }
        .premium-label { color: #94A3B8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .premium-input {
            background-color: rgba(255, 255, 255, 0.03) !important; border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #fff !important; border-radius: 8px;
        }
        .premium-input:focus { border-color: #0EA5E9 !important; box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.15) !important; }
        
        .premium-btn-submit {
            background: linear-gradient(135deg, #0EA5E9 0%, #0284C7 100%);
            border: 1px solid #0284C7; color: #fff; border-radius: 8px; font-weight: 600; padding: 8px 20px; transition: all 0.3s;
        }
        .premium-btn-submit:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(14, 165, 233, 0.3); color: #fff; }
        
        .badge-status-premium { padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 600; border: 1px solid transparent; }
        
        /* Leaflet Dark Mode Tweaks */
        .leaflet-layer, .leaflet-control-zoom-in, .leaflet-control-zoom-out, .leaflet-control-attribution { filter: invert(100%) hue-rotate(180deg) brightness(95%) contrast(90%); }
    </style>
@stop

@section('js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('[data-toggle="tooltip"]').tooltip();

            // ── 1. Mapa Principal (Global) ──
            const mainMap = L.map('main-map').setView([4.4389, -75.2322], 12); // Centro Ibagué
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(mainMap);

            let mainMarkers = [];

            // Cargar datos vía API Asíncrona para no bloquear el render inicial
            fetch("{{ route('admin.ruta.geodata') }}")
                .then(res => res.json())
                .then(data => {
                    const bounds = [];
                    data.forEach(ruta => {
                        const markerHtml = `
                            <div style="background-color: ${ruta.color_hex}; width: 16px; height: 16px; border-radius: 50%; border: 3px solid #131A2E; box-shadow: 0 0 10px ${ruta.color_hex};"></div>
                        `;
                        const customIcon = L.divIcon({
                            className: 'custom-div-icon',
                            html: markerHtml,
                            iconSize: [16, 16],
                            iconAnchor: [8, 8]
                        });

                        const m = L.marker([ruta.latitud, ruta.longitud], { icon: customIcon }).addTo(mainMap);
                        m.bindPopup(`<b>${ruta.nombre}</b><br><a href="#" class="text-info" style="font-size: 12px;">Ver detalles</a>`);
                        mainMarkers[ruta.id] = m;
                        bounds.push([ruta.latitud, ruta.longitud]);
                    });

                    // Auto-encuadrar si hay rutas
                    if(bounds.length > 0) {
                        mainMap.fitBounds(bounds, { padding: [50, 50], maxZoom: 14 });
                    }
                })
                .catch(err => console.error("Error cargando geoData", err));

            // Botón para centrar el mapa en una ruta específica
            $('.btn-center-map').on('click', function() {
                const lat = parseFloat($(this).data('lat'));
                const lng = parseFloat($(this).data('lng'));
                if(lat && lng) {
                    mainMap.setView([lat, lng], 15, { animate: true, duration: 1.5 });
                } else {
                    Swal.fire({ icon: 'info', title: 'Sin Coordenadas', text: 'Esta ruta antigua no tiene geolocalización. Edítala para asignarle un pin en el mapa.', background: '#131A2E', color: '#fff' });
                }
            });

            // ── 2. Mapa en Modal de Crear (Fix invalidateSize) ──
            let mapModal;
            let modalMarker;

            $('#modalCrear').on('shown.bs.modal', function () {
                const latDefault = 4.4389; 
                const lngDefault = -75.2322;

                if (!mapModal) {
                    mapModal = L.map('modal-map-container').setView([latDefault, lngDefault], 13);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(mapModal);

                    modalMarker = L.marker([latDefault, lngDefault], { draggable: true }).addTo(mapModal);

                    // Capturar coordenadas al mover el pin
                    modalMarker.on('dragend', function (e) {
                        const position = modalMarker.getLatLng();
                        $('#latitud_input').val(position.lat.toFixed(8));
                        $('#longitud_input').val(position.lng.toFixed(8));
                    });

                    // Inicializar los inputs por defecto
                    $('#latitud_input').val(latDefault.toFixed(8));
                    $('#longitud_input').val(lngDefault.toFixed(8));
                }
                
                // ¡VITAL! Evita el bug del recuadro gris al abrir modals
                setTimeout(() => {
                    mapModal.invalidateSize();
                }, 100);
            });

            // ── 3. Eliminación ──
            let elimId = null;
            $('.btn-eliminar').on('click', function () {
                elimId = $(this).data('id');
                $('#elim_zona').text($(this).data('zona'));
                $('#elim_ciudad').text($(this).data('ciudad'));
                $('#modalEliminar').modal('show');
            });

            $('#btnConfirmarEliminar').on('click', function () {
                if (elimId) {
                    $(this).html('<i class="fas fa-spinner fa-spin mr-1"></i> Eliminando...');
                    $(this).prop('disabled', true);
                    $('#formEliminar' + elimId).submit();
                }
            });

            // Alertas
            @if(session('success'))
                Swal.fire({ icon: 'success', title: '¡Éxito!', text: '{{ session('success') }}', background: '#131A2E', color: '#fff', confirmButtonColor: '#0EA5E9' });
            @endif
            @if(session('error'))
                Swal.fire({ icon: 'error', title: 'Error', text: '{{ session('error') }}', background: '#131A2E', color: '#fff', confirmButtonColor: '#EF4444' });
            @endif
            @if($errors->any())
                $('#modalCrear').modal('show');
            @endif
        });
    </script>
@stop