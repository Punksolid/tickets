<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Concepto extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'concepto_id',
        'descripcion',
        'importe'
    ];

    public function multas(): BelongsToMany
    {
        return $this->belongsToMany(Multa::class, 'multas_conceptos', 'multas.concept_id', 'multa_id');
    }
}
