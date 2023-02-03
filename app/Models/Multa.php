<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Multa extends Model
{
    use HasFactory;

    protected $fillable = [
        'folio',
        'placa',
        'importe',
        'redondeo',
        'conceptos',
        'full_html',
    ];

    protected $casts = [
        'conceptos' => 'array',
    ];

    public function conceptos(): BelongsToMany
    {
        return $this->belongsToMany(Concepto::class, 'multas_conceptos', 'multa_id', 'multas_conceptos.concept_id');
    }
}
