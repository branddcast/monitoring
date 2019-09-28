<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hash extends Model
{
    protected $table = 'hashes';
    protected $fillable = [
        'hash'
    ];
}
