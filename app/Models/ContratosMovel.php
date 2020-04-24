<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContratosMovel extends Model
{
    protected $table = 'contratos_moveis';
    protected $fillable = [];
    protected $guarded  = ['_token'];
}
