<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campeonato extends Model
{
    use HasFactory;

    protected $fillable = ['campeao', 'classificacao', 'clubes'];

    public function flamengos()
    {
        return $this->hasMany(Flamengo::class);
    }

    public function florminencs()
    {
        return $this->hasMany(Florminenc::class);
    }
}
