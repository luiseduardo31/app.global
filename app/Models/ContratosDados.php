<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContratosDados extends Model
{
    protected $table = 'contratos_dados';
    protected $fillable = [];
    protected $guarded  = ['_token'];
}
