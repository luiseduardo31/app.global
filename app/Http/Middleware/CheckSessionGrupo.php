<?php

namespace App\Http\Middleware;

use Closure;

class CheckSessionGrupo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        #$session_grupo_id = session()->get('session_grupo_id');

        if (session()->has('session_grupo_id')) {
            return $next($request);
        }
        return redirect()->route('escolher-grupo.index');
    }
}
