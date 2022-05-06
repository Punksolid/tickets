@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@if($layoutHelper->isLayoutTopnavEnabled())
    @php( $def_container_class = 'container' )
@else
    @php( $def_container_class = 'container-fluid' )
@endif

{{-- Default Content Wrapper --}}
<div class="content-wrapper {{ config('adminlte.classes_content_wrapper', '') }}">

    {{-- Content Header --}}
    @hasSection('content_header')
        <div class="content-header">
            <div class="{{ config('adminlte.classes_content_header') ?: $def_container_class }}">
                <div class="row">
                    <div class="col-md-12">
                        <div id="the_card" class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Información importante</h3>
                                <div class="card-tools">
                                    <button id="minus_button" type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                </div>
                            </div>
{{--                            <div class="collapse">--}}
                                <div class="collapse card-body" style="display: block;">
                                    La información aquí mostrada es de carácter informativo y no debe ser considerada como oficial y mucho menos con fines de lucro.
                                    <br>
                                    Todos los incidentes aquí mostrados son públicos mediante los enlaces de https://apps.culiacan.gob.mx/070/consultar/{incidente} donde {incidente} es el folio de incidente.
                                    <br>
                                    Cualquier duda o sugerencia puedes me puedes contactar por twitter en <a href="https://www.twitter.com/Punksolid">@Punksolid</a>
                                </div>
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
                @yield('content_header')
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <div class="content">
        <div class="{{ config('adminlte.classes_content') ?: $def_container_class }}">
            @yield('content')
        </div>
    </div>

</div>
@section('adminlte_js')
    @parent
    <script>
        $(document).ready(function(){
            // no me salió guardar el collapse
        });
    </script>
@stop


