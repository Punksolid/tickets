<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

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
    ];

    // Dates
    protected $dates = [
        'created_at',
        'updated_at',
        'fecha',
        'reported_at',
    ];

}
