@extends('adminlte::page')

@section('title', 'Ver Detalles de Incidente')

@section('content_header')
    <h1>Ver Detalles de Incidente</h1>
    {{-- create a div that pushes to right --}}
    <div class="pull-right">
        <a href="{{ route('incidents.index') }}" class="btn btn-primary">
            <i class="fa fa-arrow-left"></i>
            Volver al listado
        </a>
        {{-- open link in new tab --}}
        <a href="https://apps.culiacan.gob.mx/070/consultar/{{ $incident->folio }}" class="btn btn-primary"
           target="_blank">
            <i class="fa fa-address-book"></i>
            Ver Plataforma Anterior
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Resumen</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Folio</label>
                            <p>{{ $incident->folio }}</p>
                        </div>
                        <div class="col-md-6">
                            <label>Estatus</label>
                            <p class="badge {{ $incident->status == 'ATENDIDO' ? 'badge-success': 'badge-info' }}">{{ $incident->status }}</p>
                        </div>
                        <div class="col-md-12">
                            <label for="">Tipo de Servicio</label>
                            <p>{{ $incident->servicio }}</p>
                        </div>
                        <div class="col-md-12">
                            <label for="">Nombre del Servicio (Departamento/Dependencia)</label>
                            <p>{{ $incident->dependencia }} </p>
                        </div>
                        <div class="col-md-12">
                            <label>Domicilio</label>
                            <p>{{ $incident->domicilio }}</p>
                        </div>
                        <div class="col-md-12">
                            <label>Creado hace <i class="fa fa-times-circle-o"></i> </label>
                            <p>{{ $incident->fecha->diffForHumans() }} | {{ $incident->fecha }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user"></i>
                        Ciudadano
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">
                            <i class="fa fa-user"></i>
                            Nombre del Ciudadano
                        </label>
                        <p>{{ ucwords($incident->ciudadano) }}</p>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Correo Electrónico</label>
                            <p>{{ $incident->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Reporte</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <p>{{ ucfirst($incident->reporte) }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Linea de Tiempo</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Main node for this component -->
                            <div class="timeline">
                                <!-- Timeline time label -->
                                <div class="time-label">
                                    <span class="bg-green">{{ now()->toDateString() }}</span>
                                </div>
                                <div>
                                    <!-- Before each timeline item corresponds to one icon on the left scale -->
                                    @forelse($incident->versions as $version)
                                    <i class="fas fa-check bg-yellow"></i>
                                    <!-- Timeline item -->
                                        <div class="timeline-item">
                                            <!-- Time -->
                                            <span class="time"><i class="fas fa-clock"></i>{{ $version->created_at->toDateString() }}</span>
                                            <!-- Header. Optional -->
                                            <h3 class="timeline-header"><a href="#">Actualización</a></h3>
                                            <!-- Body -->
                                            <div class="timeline-body">

                                            </div>
                                        </div>
                                    @empty
                                        <div class="timeline-item">
                                            <!-- Time -->
                                            <span class="time"><i class="fas fa-clock"></i>No hay más actualizaciones</span>
                                        </div>
                                    @endforelse

                                </div>
                                <div>
                                     <i class="fas fa-clock bg-gray"></i>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Mapa @if($incident->lat)<span>{{ $incident->lat }},{{ $incident->lng }}@endif</span></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="map" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>
@stop

@section('js')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>
    <script>
        var map = L.map('map').setView([24.8611545, -107.3906211], 13);

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={{ config('services.mapbox.public_token') }}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 19,
            center: [{{ $incident->lng }},{{ $incident->lat }}],
            id: 'mapbox/streets-v11',
            setZoom: 16,
            tileSize: 512,
            zoomOffset: -1,
            accessToken: '{{ config('services.mapbox.public_token') }}'
        }).addTo(map);
        map.setZoom(16);
        map.center = [{{ $incident->lng }},{{ $incident->lat }}];
        var marker = L.marker([{{$incident->lat}}, {{$incident->lng}}]).addTo(map);


    </script>
@stop
