<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Florminenc extends Model
{
    use HasFactory;

    protected $fillable = ['campeonato_id', 'tecnico', 'titulos', 'jogabonito'];

    public function campeonato()
    {
        return $this->belongsTo(Campeonato::class);
    }
}
