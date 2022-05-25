<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Versionable\VersionableTrait;

class Incident extends Model
{
    use HasFactory;
    use VersionableTrait;

    protected $keepOldVersions = 15;

    public $fillable = [
        'folio',
        'dependencia',
        'id_asignacion',
        'reporte',
        'ciudadano',
        'domicilio',
        'servicio',
        'fecha',
        'usuario',
        'asignacion',
        'status',
        'priority',
        'reported_at',
    ];

    // Dates
    protected $dates = [
        'created_at',
        'updated_at',
        'fecha',
        'reported_at',
    ];

}
