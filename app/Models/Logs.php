<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $fillable = [
        'acao', 'tabela', 'user_id','updated_at'
    ];
}
