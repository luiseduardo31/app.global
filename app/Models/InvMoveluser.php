<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvMoveluser extends Model
{
    protected $table = 'inventario_movel_temporario';
    protected $fillable = [];
    protected $guarded  = ['_token'];
}
