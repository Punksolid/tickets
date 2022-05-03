@section('plugins.Datatables', true)
@extends('adminlte::page')

@section('title', 'Incidents')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Incidentes</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
{{--                                <th>ID</th>--}}
                                <th>Folio</th>
                                <th>Reporte</th>
                                <th>Domicilio</th>
                                <th>Estatus</th>
                                <th>Tiempo</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($incidents as $incident)
                                    <tr>
{{--                                        <td>{{ $incident->id }}</td>--}}
                                        <td>{{ $incident->folio }}</td>
                                        <td>{{ substr($incident->reporte, 0, 50) }}...</td>
                                        <td>{{ substr($incident->domicilio, 0, 50) }}...</td>
                                        <td><p class="badge {{ $incident->status == 'ATENDIDO' ? 'badge-success': 'badge-info' }}">{{ $incident->status }}</p></td>
                                        <td>{{ $incident->fecha->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('incidents.show', $incident->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No hay registros</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{ $incidents->withQueryString()->links() }}
@stop


@section('js')
    <script> console.log('Hi!'); </script>
    <script>
        $(document).ready( function () {
            $('#incidentsTable').DataTable();
        } );
    </script>
@stop
