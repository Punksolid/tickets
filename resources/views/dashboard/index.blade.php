@section('plugins.Chartjs', true)
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-lg-6">
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
                        <canvas id="reportsTimeline" style="display: block; width: 677px; height: 200px;" class="chartjs-render-monitor" width="677" height="200"></canvas>
                    </div>
                    <div class="d-flex flex-row justify-content-end">
<span class="mr-2">
<i class="fas fa-square text-primary"></i> This Week
</span>
                        <span>
<i class="fas fa-square text-gray"></i> Last Week
</span>
                    </div>
                </div>
            </div>


        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Sales</h3>
                        <a href="{{ route('incidents.index') }}">View Report</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">$18,230.00</span>
                            <span>Sales Over Time</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
<span class="text-success">
<i class="fas fa-arrow-up"></i> 33.1%
</span>
                            <span class="text-muted">Since last month</span>
                        </p>
                    </div>

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
                // plugins: {
                //     tooltip: {
                //         enabled: false
                //     },
                //     labels: {
                //         // render 'label', 'value', 'percentage', 'image' or custom function, default is 'percentage'
                //         // render: 'label',
                //     }
                // }
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
@stop
