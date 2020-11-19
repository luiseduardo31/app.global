<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contratos extends Model
{
    protected $table = 'contratos';
    protected $fillable = [];
    protected $guarded  = ['_token'];
}
