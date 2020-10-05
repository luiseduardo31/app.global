<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeusDados extends Model
{
    protected $table = 'users';
    protected $guarded  = ['_token'];
}
