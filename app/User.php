<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\LogsLogins;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','tipo_usuario_id','observacao',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    

    public function LogsLogins()
    {
        return $this->hasMany(LogsLogins::class);
    }

    public function registerLogin()
    {
        $user_ip = request()->ip();

        return $this->LogsLogins()->create([
            'ip' => $user_ip,
            'user_email' => $this->email,
            'acao' => 'login'
        ]);
    }

    public function registerLogoff()
    {
        $user_ip = request()->ip();
        

        return $this->LogsLogins()->create([
            'ip' => $user_ip,
            'user_email' => $this->email,
            'acao' => 'logoff',
        ]);
    }
    
}
