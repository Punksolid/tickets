<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Addendum extends Model
{
    use HasFactory;

    protected $fillable = ['description'];
    // put table name
    protected $table = 'addendums';

    public function incident(): BelongsTo
    {
        return $this->belongsTo(Incident::class);
    }
}
