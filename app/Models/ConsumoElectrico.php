<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsumoElectrico extends Model
{
    protected $table = 'estadisticas_electricas';
    protected $fillable = ['id'];

    public $timestamps = false;
}
