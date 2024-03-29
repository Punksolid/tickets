<?php

namespace App\Http\Controllers;

use App\Models\Concepto;
use App\Models\Incident;
use App\Models\Multa;
use App\Repositories\IncidentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * @var \App\Repositories\IncidentRepository|mixed
     */
    public $incidentsRepository;
    public function __construct()
    {
        $this->incidentsRepository = new IncidentRepository();
    }

    // index
    public function index()
    {

        $incidents = $this->incidentsRepository->getAllByDate();

        /** @var Collection $quantity_of_incidents_by_dependency */
        $quantity_of_incidents_by_dependency = Incident::
            select('dependencia', DB::raw('count(*) as total'))
            ->groupBy('dependencia')
            ->get();

        $total_reports = Incident::count();
        $open_incidents_by_dependency = Incident::
        groupBy('dependencia')
            ->select(DB::raw('count(*) as total, status, dependencia'))
            ->where('status', '=', 'Pendiente')
            ->orWhere('status', '=', 'PENDIENTE')
            ->get();
        // Put dependencia index as key and total as value
        $open_incidents_by_dependency = $open_incidents_by_dependency->groupBy('dependencia');

        $open_incidents_by_dependency = $open_incidents_by_dependency->map(fn($item, $key) => [
            'total' => $item->sum('total'),
            'status' => $item->first()->status,
            'dependencia' => $item->first()->dependencia
        ]);
        $total_incidents = Incident::count();
        $total_incident_by_status = $this->getTotalIncidentsByStatus();
        $total_geocoded_incidents = Incident::where('lat', '!=', null)->orWhere('lat', '!=', 0)->count();
        $total_de_usuarios_que_han_registrado_incidentes = $this->getFuncionarioConMenosIncidentes()->count();

        $aproximado_de_incidentes_con_status_pendiente = Incident::where('status', '=', 'Pendiente')->orWhere('status', 'PENDIENTE')->count();
        $incidents_from_last_24_hours = Incident::where('reported_at', '>=', now()->subDay())->count();
        $last_incident = Incident::orderBy('created_at', 'desc')->first();
        $top_plates = $this->getTopPlates();
        $total_indexed_multas = Multa::count();

        return view('dashboard.index', [
            'last_incident' => $last_incident,
            'incidents_from_last_24_hours' => $incidents_from_last_24_hours,
            'incidents' => $incidents,
            'quantity_of_incidents_by_dependency' => $quantity_of_incidents_by_dependency,
            'total_reports' => $total_reports,
            'open_incidents_by_dependency' => $open_incidents_by_dependency,
            'total_incident_by_status' => $total_incident_by_status,
            'total_incidents' => $total_incidents,
            'total_geocoded_incidents' => $total_geocoded_incidents,
            'total_de_usuarios_que_han_registrado_incidentes' => $total_de_usuarios_que_han_registrado_incidentes,
            'aproximado_de_incidentes_con_status_pendiente' => $aproximado_de_incidentes_con_status_pendiente,
            'top_plates' => $top_plates,
            'top_multas_types' => $this->getTopMultasConceptos(),
            'total_indexed_multas' => $total_indexed_multas
        ]);
    }

    public function map()
    {

        // get $mapped_incidents from cache or fresh
        $mapped_incidents = $this->getMappedIncidents();

        $colors = [
            'Alumbrado Publico' => '#fdfd96',
            'Aseo, Limpia y Lotes Baldios' => '#FFA500',
            // brown color
            'Inspeccion y Vigilancia' => '#FFA500',
            'Dirección de Sistemas de Drenajes Pluviales' => '#008000',
            'Parques y Jardines del Ayuntamiento' => '#0000FF',
            'Obras Publicas' => '#800080',
            // red color
            'Fugas de Agua' => '#FF0000',
            // orange color
            'Lotes Baldios' => '#FFA500',
            // brown color
            'Seguridad Publica' => '#FFA500',
            'Drenajes y Sistemas Pluviales' => '#008000',
            'Dirección de Movilidad' => '#0000FF',
        ];

        $markers = $mapped_incidents->map(fn($item) => [
            $item->lat, // 0
            $item->lng, // 1
            $item->reporte, // 2
            $colors[$item->dependencia] ?? '#000000', // 3
            $item->id // 4
        ]);
        return view('dashboard.map', [
            'markers' => $markers->toJson(),
        ]);
    }

    private function getTotalIncidentsByStatus()
    {
        $total_incident_by_status = Incident::
        groupBy('status')
            ->select(DB::raw('count(*) as total, status'))
            ->get();
        $total_incident_by_status = $total_incident_by_status->groupBy('status');

        return $total_incident_by_status->map(fn($item, $key) => [
            'total' => $item->sum('total'),
            'status' => ucfirst(strtolower((string) $item->first()->status))
        ]);
    }

    private function getFuncionarioConMenosIncidentes()
    {
        $funcionario_con_menos_incidentes = Incident::
        groupBy('usuario')
            ->select(DB::raw('count(*) as total, usuario'))
            ->get();

        $funcionario_con_menos_incidentes = $funcionario_con_menos_incidentes->groupBy('usuario');
        return $funcionario_con_menos_incidentes->map(fn($item) => [
            'total' => $item->sum('total'),
            'usuario' => $item->first()->usuario
        ]);
    }

    private function getMappedIncidents()
    {
        return Cache::remember('mapped_incidents', now()->addMinutes(20), fn() => Incident::where('lat', '!=', null)
            ->where('lat', '!=', 0)
            ->select('id', 'lat', 'lng', 'reporte', 'dependencia')
            ->getQuery()
            ->get());
    }

    private function getTopPlates()
    {
        return  Multa::groupBy('placa')
            ->where('placa', '!=', '')
            ->select(DB::raw('count(*) as total, placa'))
            ->take(10)
            ->orderBy('total', 'desc')
            ->get();

    }

    private function getTopMultasConceptos()
    {
        // Get all Concepto grouped by descripcion
        return Concepto::groupBy('descripcion')
            ->select(DB::raw('count(*) as total, descripcion'))
//            ->take(10)
            ->orderBy('total', 'desc')
            ->get();

    }


}
