@extends('adminlte::page')

@section('title', 'Mapa de Incidentes')

@section('content_header')
    <h1>Mapa General de Incidentes</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div id="map" style="width: 100%; height: 700px;"></div>
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
        var map = L.map('map').setView([24.800399, -107.403639], 15);

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={{ config('services.mapbox.public_token') }}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: '{{ config('services.mapbox.public_token') }}',
            preferCanvas: true,
        }).addTo(map);
        var locations = {!! $markers !!};
        var myRenderer = L.canvas({ padding: 0.5 });

        for (var i = 0; i < locations.length; i++) {
            var circleMarker = L.circleMarker([locations[i][0], locations[i][1]], {
                renderer: myRenderer,
                color: locations[i][3],
            }).addTo(map);
            var link = locations[i][2] + '<br><a href="'+ locations[i][4] +'" class="btn btn-sm">Ver</a>';
            circleMarker.bindPopup(link);
        }

    </script>
@stop
