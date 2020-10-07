<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogsLogins extends Model
{
    protected $table = 'logs_logins';
    protected $fillable = ['user_id', 'created_at', 'updated_at'];

}
