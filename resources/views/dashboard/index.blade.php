@section('plugins.Chartjs', true)
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Ultimas 24 horas</span>
                    <span class="info-box-number">{{ $incidents_from_last_24_hours }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-sync-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Ultima sincronización</span>
                    @if($last_incident)
                        <span class="info-box-number">{{ $last_incident->created_at->diffForHumans() }}</span>
                    @else
                        <span class="info-box-number">No hay incidentes</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $total_incidents }}</h3>
                    <p>Incidentes Registrados</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('incidents.index') }}" class="small-box-footer">Ver<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $total_geocoded_incidents }}<sup style="font-size: 20px"></sup></h3>
                    <p>Incidentes con Geolocalización</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('incidents.index',['geocoded' => true ]) }}" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $total_de_usuarios_que_han_registrado_incidentes }}</h3>
                    <p>Total de Usuarios que Han Registrado Incidentes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer"> - <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $aproximado_de_incidentes_con_status_pendiente }}</h3>
                    <p>Aproximado de Incidentes con Status Pendiente</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">-</a>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Reportes Pendientes Por Dependencia</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas class="chartjs-render-monitor"
                            height="250"
                            id="openIncidentsByDependencyDonutChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 394px;"
                            width="394"></canvas>
                </div>

            </div>
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Reportes Por Estatus</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas class="chartjs-render-monitor"
                            height="250"
                            id="totalIncidentsByStatus"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 394px;"
                            width="394"></canvas>
                </div>

            </div>
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Reportes por mes</h3>
                        <a href="{{ route('incidents.index') }}">View Report</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">{{ $total_reports }}</span>
                            <span>Total de Reportes</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
<span class="text-success">
</span>
                            <span class="text-muted">All Time</span>
                        </p>
                    </div>

                    <div class="position-relative mb-4">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                        </div>
                        {{--                        <canvas id="reportsTimeline" class="chartjs-render-monitor" style="display: block;"></canvas>--}}
                        <canvas id="reportsTimeline" style="display: block; width: 677px; height: 200px;"
                                class="chartjs-render-monitor" width="677" height="200"></canvas>
                    </div>
                </div>
            </div>


        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Incidentes Totales Por Dependencia</h3>
                        <a href="{{ route('incidents.index') }}">Ver Incidentes</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="position-relative mb-4">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="dependencias" style="display: block;"></canvas>
                    </div>
                    <div class="d-flex flex-row justify-content-end">
<span class="mr-2">
<i class="fas fa-square text-primary"></i> This year
</span>
                        <span>
<i class="fas fa-square text-gray"></i> Last year
</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    {{--
        /*<link rel="stylesheet" href="/css/admin_custom.css">*/
    --}}
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
    <script>
        const lineChartCanvas = document.getElementById('reportsTimeline').getContext('2d');
        const dependenciasCanvas = document.getElementById('dependencias').getContext('2d');
        const dependencias = new Chart(dependenciasCanvas, {
            type: 'pie',
            options: {
                responsive: true
            },
            data: {
                labels: {!! $quantity_of_incidents_by_dependency->pluck('dependencia') !!},
                datasets: [{
                    label: 'Dependencia',
                    data: {!! $quantity_of_incidents_by_dependency->pluck('total') !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderWidth: 1
                }]
            },
        });

        const reportsTimeline = new Chart(lineChartCanvas, {
            type: 'line',

            data: {
                labels: {!! $incidents->pluck('date') !!},
                datasets: [{
                    label: 'Total del Mes',
                    data: {!! $incidents->pluck('total') !!},
                    backgroundColor:
                        'rgba(255, 99, 132, 0.2)'
                    ,
                    borderColor: 'rgba(255, 99, 132, 1)'
                    ,
                    fillColor: 'rgba(255, 99, 132, 0.2)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
    <script>
        const donutChartCanvas = document.getElementById('openIncidentsByDependencyDonutChart').getContext('2d');

        const donutChart = new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: {
                labels: {!! $open_incidents_by_dependency->pluck('dependencia') !!},
                datasets: [{
                    label: 'Dependencia',
                    data: {!! $open_incidents_by_dependency->pluck('total') !!},
                    backgroundColor: ['#f56954',
                        '#00a65a',
                        '#f39c12',
                        '#00c0ef',
                        '#3c8dbc',
                        '#d2d6de',
                        '#932ab6',
                        '#d73925',
                        '#3498db',
                        '#9b59b6',
                        '#8abb6f',
                        '#0014c7',
                        '#9b59b6',
                        '#8abb6f',
                        '#0014c7',
                        '#bfd3b7',
                        '#3d2800',
                        '#00c0ef',
                        '#ec00ff',
                        '#d2d6de'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    display: false
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                maintainAspectRatio: false,
                responsive: true,

            }
        });
    </script>
    <script>
        const totalIncidentsByStatus = document.getElementById('totalIncidentsByStatus').getContext('2d');

        const totalIncidentsByStatusChart = new Chart(totalIncidentsByStatus, {
            type: 'doughnut',
            data: {
                labels: {!! $total_incident_by_status->pluck('status') !!},
                datasets: [{
                    label: 'Dependencia',
                    data: {!! $total_incident_by_status->pluck('total') !!},
                    backgroundColor: ['#f56954',
                        '#00a65a',
                        '#f39c12',
                        '#00c0ef',
                        '#3c8dbc',
                        '#d2d6de',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    display: false
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                maintainAspectRatio: false,
                responsive: true,

            }
        });
    </script>
@stop
