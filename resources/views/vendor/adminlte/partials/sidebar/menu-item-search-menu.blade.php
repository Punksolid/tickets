<li>

    <div class="form-inline my-2">
{{--        <div class="input-group" data-widget="sidebar-search" data-arrow-sign="&raquo;">--}}
            <form action="{{ route('incidents.index') }}" method="get" class="form-check-inline">

            {{-- Search input --}}
            <input class="form-control form-control-sidebar"
                   type="search"
                   name="reporte"
{{--                @isset($item['id']) id="{{ $item['id'] }}" @endisset--}}
                placeholder="{{ $item['text'] }}"
                aria-label="{{ $item['text'] }}">

            {{-- Search button --}}
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-fw fa-search"></i>
                </button>
            </div>
            </form>
{{--        </div>--}}
    </div>

</li>
