<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\Auth\LoginController as Validacion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class Pointex
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
      if($user->checkPointexUser()){
        return $next($request);
      }else{
          Session::flush();
        return redirect('/')->with("msg",["Tipo"=>"error","Descripcion"=>"Usted no cuenta con permisos para ingresar a este sistema."]);;
      }
    }
}
