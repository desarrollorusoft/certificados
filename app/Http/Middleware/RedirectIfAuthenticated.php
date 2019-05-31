<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

          $EsOperador = auth()->user()->hasPermissionTo('Navegar operador');
          $View = $EsOperador ? '/area/enod' : '/area/cliente' ;
          return redirect($View);

        }

        return $next($request);
    }
}
