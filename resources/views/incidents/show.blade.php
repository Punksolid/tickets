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
        <a href="https://apps.culiacan.gob.mx/ciudadano/consultar/{{ $incident->folio }}" class="btn btn-primary"
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
                            <p>{{ optional($incident->fecha)->diffForHumans() }} | {{ $incident->fecha }}</p>
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><span>Información adicional</span></h3>
                    <div class="card-tools">
                    </div>
                </div>
                <div class="card-body">
                    <div style="width: 100%; height: 500px;">
                        <div class="timeline">

                        @foreach($incident->addendums as $additional)
                                <div>
                                    <i class="fas fa-envelope bg-blue"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> {{ $additional->created_at->format('d/m/Y H:i') }}</span>
                                        <h3 class="timeline-header"><a href="#">Usuario Anonimo</a> agrego información adicional</h3>
                                        <div class="timeline-body">
                                            {{ $additional->description }}
                                            @if($additional->evidence_path)
                                                <img
                                                    style="vertical-align: middle; max-width: 100%; max-height: 100%;"
                                                    src="{{ asset($additional->evidence_path )}}"/>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                        </div>

                        <form method="post" action="{{  route('incidents.addendums.store', ['incident' => 0])   }}" enctype="multipart/form-data">
                            @csrf
                            <label for="description">Información Adicional</label>
                            <textarea class="form-control" name="description"></textarea>
                            <input type="file" name="evidence" />
                            <input type="hidden" name="recaptcha" id="recaptcha">
                            @if($errors->has('description'))
                                    @foreach($errors->get('description') as $error)
                                        <strong>{{ $error }}</strong>
                                    @endforeach

                            @endif
                            <button type="submit" class="btn btn-success">Guardar Registro</button>
                      </form>
                    </div>
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
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {action: 'contact'}).then(function(token) {
                if (token) {
                    document.getElementById('recaptcha').value = token;
                }
            });
        });
    </script>
@stop
