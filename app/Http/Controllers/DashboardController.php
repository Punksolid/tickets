<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // index
    public function index()
    {
        // Get all the incidents grouped by day
//        $incidents = Incident::selectRaw("strftime(\"%m-%Y\", reported_at) as date, count(*) as total")
        $incidents = Incident::selectRaw("strftime(\"%m-%Y\", reported_at) as date, count(*) as total")
//            ->whereBetween('reported_at', [
//                '2014-11-01 00:00:00',
//                '2018-10-30 23:59:59',
//            ])
            ->groupBy('date')
            ->orderBy('reported_at', 'asc')
            ->orderBy('date', 'asc')
            ->get();

        /** @var Collection $quantity_of_incidents_by_dependency */
        $quantity_of_incidents_by_dependency = Incident::
//            groupBy('dependencia')
            select('dependencia', DB::raw('count(*) as total'))
            ->groupBy('dependencia')
            ->get();
        // get etiquetas
//        dd($quantity_of_incidents_by_dependency->pluck('dependencia'));
        $total_reports = Incident::count();

        return view('dashboard.index', compact('incidents', 'quantity_of_incidents_by_dependency', 'total_reports'));
    }

    public function map()
    {
        $mapped_incidents = Incident::where('lat', '!=', null)
            ->where('lng', '!=', null)
            ->get();

        $markers = $mapped_incidents->map(function ($item, $key) {
            return [
                (float)$item->lat,
                (float)$item->lng
            ];
        });
//        dd($markers);
        return view('dashboard.map', compact('markers'));
    }


}
