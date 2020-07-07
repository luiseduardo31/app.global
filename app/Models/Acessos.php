<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acessos extends Model
{
    protected $table = 'grupos_users';
    protected $fillable = [];
    protected $guarded  = ['_token'];
}
