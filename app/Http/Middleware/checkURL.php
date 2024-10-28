<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\Auth\LoginController as Validacion;
use Illuminate\Http\RedirectResponse;

class checkURL
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
      $user = new Validacion;
      if($user->checkURL()){
        return $next($request);
      }else{
        return redirect('/pointex/inicio')->with("msg",["Tipo"=>"error","Descripcion"=>"Usted no cuenta con permisos para ingresar a ésta sección"]);;
      }
    }
}
