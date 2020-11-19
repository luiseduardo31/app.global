<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ContratosFixo extends Model
{
    protected $table = 'contratos_fixos';
    protected $fillable = [];
    protected $guarded  = ['_token'];

}