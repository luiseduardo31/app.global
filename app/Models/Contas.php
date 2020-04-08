<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Contas extends Model
{
    protected $fillable = [];
    protected $guarded  = ['_token'];
}
