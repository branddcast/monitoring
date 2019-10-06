<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table = 'bitacora';
    protected $fillable = ['id', 'usuario', 'name'];

    public function usuario()
    {
        return $this->belongsTo('App\User','id');
    }
    
}
