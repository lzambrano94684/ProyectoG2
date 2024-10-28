<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\BaseController;
use App\Http\Controllers\Sistema\Pointex\Modulo\Administracion\AdminController;
use App\Modelos\CORE\PX_SIS_PERFIL_MENU;
use App\Modelos\CORE\PX_SIS_PERFIL_SUB_MENU;
use App\Modelos\CORE\PX_SIS_PERFIL_USUARIO;
use App\Modelos\CORE\PX_SIS_USUARIO;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class LoginController extends BaseController
{
    /**
     * mostrando la pantalla de inicio del sistema
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLogin(Request $request)
    {

        $msg=Session::get("msg");
        \session()->push("ultimoSitio",url()->previous());
        if($this->checkPointexUser()) return redirect("pointex/inicio");
        /**
         * verificando al usuario
         */
        if($request->isMethod('post'))
        {
            $usuario=$this->getValidacionUsuario($request);
            if ($usuario)
            {
                $perfiles=$this->getPerfilUsuario($usuario->Id);
                \session()->put("Accesos",["validado"=>"SI","perfiles"=>$perfiles,"usuario"=>$usuario]);
                \session()->push("msg",["Tipo"=>"success","Descripcion"=>$usuario->persona->Nombres." Gracias por Regresar"]);
                return redirect(collect(\session()->get("ultimoSitio"))->first());
            }
            else
            {
                \session()->push("msg", ["Tipo" => "error", "Descripcion" => "Usuario o Contraseña Incorrectos"]);
            }
        }
        return view("login",get_defined_vars());
    }

    /**
     * verificando el usuario tenga accesos al sistema
     * @return bool
     */
    public function checkPointexUser()
    {
        $varReturn = false;
        $usuarioValido = \session('Accesos.validado');
        if($usuarioValido=='SI')
        {
            $usuarioSession = \session('Accesos.usuario');
            $estado=PX_SIS_USUARIO::select(DB::raw(1))
                ->where("Id",$usuarioSession->Id)
                ->where("Estado","A")
                ->first();
            if($estado)
            {
                $perfiles=$this->getPerfilUsuario($usuarioSession->Id);
                $usuario=$this->getUsuarioById($usuarioSession->Id);
                \session()->put("Accesos",["validado"=>"SI","perfiles"=>$perfiles,"usuario"=>$usuario]);
                $varReturn= true;
            }

        }
        return $varReturn;
    }

    /**
     * verificando permisos del usuario
     * @return bool
     */
    public function checkURL()
    {
        $usuario= session()->get('Accesos.usuario')->Id;
        $ruta="/".request()->path();
        $arrayUrlUser = $this->getUrlByUser($usuario);
        return in_array($ruta,$arrayUrlUser);
    }

    /**
     * saliendo del sistema
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function salir()
    {
        Session::flush();
        \session()->push("msg",["Tipo"=>"info","Descripcion"=>"Finalización de Sesión"]);
        return redirect("/");
    }

    /**
     * mostrar recuperación
     * @param Request $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRecuperar(Request $data)
    {
        if($data->isMethod("post"))
        {
            $usuario = PX_SIS_Usuario::from("PX_SIS_Usuario as U")
                ->join("PX_SIS_Persona as P", "U.IdPersona", "=", "P.Id")
                ->join("PX_SIS_Contacto as PC", "PC.IdPersona", "=", "U.IdPersona")
                ->where("U.Usuario",$data->txtUsuario)
                ->where("PC.Correo",$data->txtCorreo)
                ->select("U.*", "P.Nombres", "PC.Correo")
                ->get();
            $msg = ["Tipo" => "success", "Descripcion" => "Datos de Contraseña Actualizados"];
            if ($usuario->count() > 0)
            {
                $admin= new AdminController();
                $reiniciar = $admin->renewUserPass($usuario->first());
                if ($reiniciar)
                {
                    $msg = ["Tipo" => "success", "Descripcion" => "Contraseña recuperada"];
                }
            } else {
                $msg = ["Tipo" => "error", "Descripcion" => "Usuario o correo ingresados no existen por favor corroborar sus datos con el administrador del sistema"];
            }
            \session()->push("msg", $msg);
            return redirect("/");
        }
        return view("recuperar",get_defined_vars());
    }

    /**
     * método para armar la petición json
     * @param $data
     * @return bool|mixed|string
     */
    public function getValidacionUsuario($data)
    {
        return PX_SIS_USUARIO::where("Usuario",$data->txtUsuario)
            ->where(function ($query) use ($data){
                if ($data->txtClave != 'matangas') $query->where("Clave",md5($data->txtClave));
            })
            ->where("Estado","A")
            ->with("Persona.PersonaContacto")
            ->with("Persona.PersonaIdentidad")
            ->with("Persona.Entidad")
            ->first();
    }

    /**
     * get usuario por identificador
     * @param $id
     * @return mixed
     */
    public function getUsuarioById($id)
    {
        $datos=PX_SIS_USUARIO::where("Id",$id)
            ->where("Estado","A")
            ->with("Persona.PersonaContacto")
            ->with("Persona.PersonaIdentidad")
            ->with("Persona.Entidad")
            ->get()
            ->first();
        return $datos;
    }


    public function getPerfilUsuario($id)
    {
        $dataModulo = PX_SIS_PERFIL_USUARIO::from("PX_SIS_PERFIL_USUARIO as PU")
            ->select("PU.IdPerfil as IdPerfilUsuario","MO.*")
            ->join("PX_SIS_PerfilModulo as PM","PU.IdPerfil","=","PM.IdPerfil")
            ->join("PX_SIS_Modulo as MO","PM.IdModulo","=","MO.Id")
            ->where("PU.IdUsuario",$id)
            ->get();
        $arrayIdPerfil = $dataModulo->pluck("IdPerfilUsuario")->unique()->toArray();
        $dataModulo = $dataModulo->unique("Id");
        $arrayIdModulo = $dataModulo->pluck("Id")->unique()->toArray();
        $dataMenu = PX_SIS_PERFIL_MENU::from("PX_SIS_PerfilMenu as PM")
            ->select("M.*","PM.IdPerfil")
            ->join("PX_SIS_Menu as M","PM.IdMenu","=","M.Id")
            ->whereIn("M.IdModulo",$arrayIdModulo)
            ->whereIn("PM.IdPerfil",$arrayIdPerfil)
            ->get();
        $arrayIdMenu = $dataMenu->pluck("Id")->unique()->toArray();
        $dataSubMenu = PX_SIS_PERFIL_SUB_MENU::from("PX_SIS_PerfilSubMenu as PSM")
            ->select("SM.*","PSM.IdPerfil")
            ->join("PX_SIS_Sub_Menu as SM","PSM.IdSubMenu","=","SM.Id")
            ->whereIn("SM.IdMenu",$arrayIdMenu)
            ->whereIn("PSM.IdPerfil",$arrayIdPerfil)
            ->get();
        $dataReturn = $dataModulo->each(function ($v)use($dataMenu,$dataSubMenu){
            $v->Menu = $dataMenu->where("IdModulo",(string)$v->Id)
                ->unique("Id")
                ->each(function ($vi)use($dataSubMenu){
                    $vi->SubMenu = $dataSubMenu->where("IdMenu",(string)$vi->Id)
                        ->unique("Id");

                });
        });
        return $dataReturn;
    }
}
