@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Ver Detalles de Incidente</h1>
@stop

@section('content')
    {{ dd($incident) }}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $incident->dependencia }}</h3>
        </div>
        <div class="card-body">
            <p>{{ $incident->reporte }}</p>
            <div class="row">
                <div class="col-md-6">
                    <p>{{ $incident->fecha }}</p>
                </div>
                <div class="col-md-6">
                    <p>{{ $incident->hora }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('incidents.index') }}" class="btn btn-primary">Regresar</a>
        </div>
    </div>

@stop

@section('css')
    /*
    <link rel="stylesheet" href="/css/admin_custom.css">*/
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
