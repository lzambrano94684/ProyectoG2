<?php

namespace App\Http\Controllers\Sistema\Pointex\Modulo\Administracion;

use App\Http\Controllers\BaseController;
use App\Modelos\CORE\PX_SIS_ENTIDAD;
use App\Modelos\CORE\PX_SIS_MENU;
use App\Modelos\CORE\PX_SIS_MODULO;
use App\Modelos\CORE\PX_SIS_PAIS;
use App\Modelos\CORE\PX_SIS_PERSONA;
use App\Modelos\CORE\PX_SIS_PERSONA_CONTACTO;
use App\Modelos\CORE\PX_SIS_PERSONA_IDENTIDAD;
use App\Modelos\CORE\PX_SIS_ROLES_USUARIO;
use App\Modelos\CORE\PX_SIS_SISTEMA;
use App\Modelos\CORE\PX_SIS_SUB_MENU;
use App\Modelos\CORE\PX_SIS_TIPO_USUARIO;
use App\Modelos\CORE\PX_SIS_USUARIO;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class EstructuraController extends BaseController
{

    //Métodos para Sistemas

    /**
     * Mostrando el listado de sistema que existen
     * @param Request $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSistemas(Request $data)
    {
        $msg=Session::get("msg");
        $titleMsg = "Administración de Sistemas";
        $libs2Load=["DataTables"=>true,"Select2"=>true,"SweetAlert"=>true];


        if ($data->isMethod('get')) {
            $sistemas = json_decode(PX_SIS_SISTEMA::all());
        }

        if ($data->isMethod('post')) {
            $sistemas = json_decode(PX_SIS_SISTEMA::where("Id",$data->idSistema)->get());
        }



        return view("Sistema.Pointex.Modulo.Administracion.Estructura.sistemas",get_defined_vars());
    }

    /**
     * modificando el estado del sistema
     * @param $id
     * @return string
     */
    public function estadoSistema($id)
    {
        $sistema=PX_SIS_SISTEMA::find($id);


        $objeto=(json_decode($sistema,1));

        if(count($objeto)>0)
        {
            $sistema->Estado=($sistema->Estado=="A")?"I":"A";
            $sistema->save();
            return "OK";
        }

        return "NO";

    }

    /**
     * verificar nombres de sistemas
     * @param Request $data
     * @return string
     */
    public function validarSistemaById(Request $data)
    {
        $validar=PX_SIS_SISTEMA::where("Nombre",$data->sistema)->where("Id","<>",$data->idSistema)->get();
        if(count($validar)>0)
        {
            return "SI";
        }
        else
        {
            return "NO";
        }
    }

    public function validarSistema(Request $data)
    {
        $validar=PX_SIS_SISTEMA::where("Nombre",$data->Nombre)->get();
        if(count($validar)>0)
        {
            return "SI";
        }
        else
        {
            return "NO";
        }
    }

    /**
     * método para modificar el sistema existente
     * @param Request $data
     * @return array
     */
    public function modificarSistema(Request $data)
    {
        $sistema=false;
        try
        {
            $sistema=PX_SIS_SISTEMA::where("Id",$data->IdSistema)
                ->update([
                    "Nombre"=>$data->Nombre,
                    "Descripcion"=>$data->Descripcion,
                    "Icono"=>$data->Icono,
                    "Imagen"=>$data->Imagen
                ]);
        }
        catch (QueryException $ex)
        {
            Log::error("Error al Modificar la tabla PX_SIS_SISTEMA: ".$ex->getMessage());
        }


        if($sistema)
        {
            return ["ESTADO"=>"OK","RESULTADO"=>"Sistema:".$sistema];

        }
        else
        {
            return ["ESTADO"=>"NO","DESCRIPCION"=>"Se presentó un error al realizar la actualización"];
        }


    }

    /**
     * creando nuevos sistemas
     * @param Request $data
     * @return array
     */
    public function crearSistema(Request $data)
    {
        $sistema=false;
        try
        {
            $sistema=new PX_SIS_SISTEMA();

            $sistema->Nombre=$data->Nombre;
            $sistema->Descripcion=$data->Descripcion;
            $sistema->Icono=$data->Icono;
            $sistema->Imagen=$data->Imagen;
            $sistema->FechaCreacion=date("Y-m-d H:i:s");
            $sistema->Estado="A";
            $sistema->save();
        }
        catch (QueryException $ex)
        {
            Log::error("Error al crear datos en la tabla PX_SIS_SISTEMA: ".$ex->getMessage());
        }


        if(isset($sistema->Id))
        {
            return ["ESTADO"=>"OK","DESCRIPCION"=>"Datos creados correctamente"];

        }
        else
        {
            return ["ESTADO"=>"NO","DESCRIPCION"=>"Se presentó un error al insertar en la tabla"];
        }


    }


    //Métodos para Módulos

    /**
     * Mostrando el listado de módulos que existen
     * @param Request $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showModulo(Request $data)
    {
        $msg=Session::get("msg");
        $titleMsg = "Administración de Módulos";
        $libs2Load=["DataTables"=>true,"Select2"=>true,"SweetAlert"=>true];

        $sistemas=json_decode(PX_SIS_SISTEMA::all());

        if ($data->isMethod('get')) {
            $modulos = json_decode(PX_SIS_MODULO::with("Sistema")->get());
        }


        if ($data->isMethod('post') && isset($data->slcSistemaChange) && $data->slcSistemaChange!="") {
            $modulos = json_decode(PX_SIS_MODULO::where("IdSistema",$data->slcSistemaChange)
                ->where(function ($query) use($data){
                    (isset($data->IdModulo) && $data->IdModulo!="")?$query->where("Id",$data->IdModulo):"";
                })
                ->with("Sistema")->get());
        }
        else
        {
            $modulos = json_decode(PX_SIS_MODULO::with("Sistema")
                ->where(function ($query) use($data){
                    (isset($data->IdModulo) && $data->IdModulo!="")?$query->where("Id",$data->IdModulo):"";
                })->get());
        }
        //dd($modulos);

        return view("Sistema.Pointex.Modulo.Administracion.Estructura.modulos",get_defined_vars());
    }

    /**
     * modificando el estado del modulo
     * @param $id
     * @return string
     */
    public function estadoModulo($id)
    {
        $modulo=PX_SIS_MODULO::find($id);


        $objeto=(json_decode($modulo,1));

        if(count($objeto)>0)
        {
            $modulo->Estado=($modulo->Estado=="A")?"I":"A";
            $modulo->save();
            return "OK";
        }

        return "NO";

    }

    /**
     * verificar nombres de modulo por identificador
     * @param Request $data
     * @return string
     */
    public function validarModuloById(Request $data)
    {
        $validar=PX_SIS_MODULO::where("Nombre",$data->sistema)
            ->where("Id","<>",$data->idSistema)
            ->where("IdSistema","<>",$data->idSistema)
            ->get();
        if(count($validar)>0)
        {
            return "SI";
        }
        else
        {
            return "NO";
        }
    }

    /**
     * validar el módulo
     * @param Request $data
     * @return string
     */
    public function validarModulo(Request $data)
    {
        $validar=PX_SIS_MODULO::where("Nombre",$data->Nombre)->where("IdSistema",$data->IdSistema)->get();
        if(count($validar)>0)
        {
            return "SI";
        }
        else
        {
            return "NO";
        }
    }

    /**
     * método para modificar el módulo existente
     * @param Request $data
     * @return array
     */
    public function modificarModulo(Request $data)
    {
        //dd($data->IdSistema);
        $modulo=false;
        try
        {
            $modulo=PX_SIS_MODULO::where("Id",$data->IdModulo)
                ->update([
                    "Nombre"=>$data->Nombre,
                    "Descripcion"=>$data->Descripcion,
                    "Icono"=>$data->Icono,
                    "Imagen"=>$data->Imagen,
                    "IdSistema"=>$data->IdSistema
                ]);
        }
        catch (QueryException $ex)
        {
            Log::error("Error al Modificar la tabla PX_SIS_MODULO: ".$ex->getMessage());
        }


        if($modulo)
        {
            return ["ESTADO"=>"OK","RESULTADO"=>"PX_SIS_MODULO:".$modulo];

        }
        else
        {
            return ["ESTADO"=>"NO","DESCRIPCION"=>"Se presentó un error al realizar la actualización"];
        }


    }

    /**
     * creando nuevos módulos
     * @param Request $data
     * @return array
     */
    public function crearModulo(Request $data)
    {
        $modulo=false;
        try
        {
            $modulo=new PX_SIS_MODULO();

            $modulo->Nombre=$data->Nombre;
            $modulo->Descripcion=$data->Descripcion;
            $modulo->Icono=$data->Icono;
            $modulo->Imagen=$data->Imagen;
            $modulo->IdSistema=$data->IdSistema;
            $modulo->FechaCreacion=date("Y-m-d H:i:s");
            $modulo->Estado="A";
            $modulo->save();
        }
        catch (QueryException $ex)
        {
            Log::error("Error al crear datos en la tabla PX_SIS_MODULO: ".$ex->getMessage());
        }


        if(isset($modulo->Id))
        {
            return ["ESTADO"=>"OK","DESCRIPCION"=>"Datos creados correctamente"];

        }
        else
        {
            return ["ESTADO"=>"NO","DESCRIPCION"=>"Se presentó un error al insertar en la tabla"];
        }


    }


    //Métodos para Menús

    /**
     * Mostrando el listado de Menús que existen
     * @param Request $data
     * @param $sistema
     * @param $modulo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showMenu(Request $data,$sistema=0,$modulo=0)
    {
        $msg=Session::get("msg");
        $titleMsg = "Administración de Menús";
        $libs2Load=["DataTables"=>true,"Select2"=>true,"SweetAlert"=>true];

        $sistemas=json_decode(PX_SIS_SISTEMA::select("Id","Nombre")->orderBY('Id', 'ASC')->get());
        $modulos=json_decode(PX_SIS_MODULO::select("Id","Nombre","IdSistema")->orderBY('Id', 'ASC')->get());

        //dd($sistema,$modulo);
        if ($data->isMethod('post')) {
            //$menus = json_decode(PX_SIS_MENU::with("Modulo.Sistema")->get());

            $menus=json_decode(
              DB::table("PX_SIS_Menu as M")
              ->join("PX_SIS_Modulo as Md","Md.Id","=","M.IdModulo")
              ->join("PX_SIS_Sistema as S","S.Id","=","Md.IdSistema")
              ->where(function ($query)use($sistema,$modulo,$data){
                  (isset($sistema) && $sistema!=0)?$query->where("S.Id","$sistema"):"";
                  (isset($modulo) && $modulo!=0 && isset($sistema) && $sistema!=0)?$query->where("Md.Id","$modulo"):"";
                  (isset($data->IdMenu) && $data->IdMenu!="")?$query->where("M.Id",$data->IdMenu):"";
              })
              ->select("M.*","S.Nombre as Sistema","S.Id as IdSistema","Md.Nombre as Modulo")->orderBy('Id', 'ASC')
              ->get()
            );

        }

        if ($data->isMethod('get')) {
            $menus=json_decode(
                DB::table("PX_SIS_Menu as M")
                    ->join("PX_SIS_Modulo as Md","Md.Id","=","M.IdModulo")
                    ->join("PX_SIS_Sistema as S","S.Id","=","Md.IdSistema")
                    ->select("M.*","S.Nombre as Sistema","S.Id as IdSistema","Md.Nombre as Modulo")->orderBy('Id', 'ASC')
                    ->get()
            );
        }


       // dd($menus);

        return view("Sistema.Pointex.Modulo.Administracion.Estructura.menus",get_defined_vars());
    }

    /**
     * modificando el estado del Menú
     * @param $id
     * @return string
     */
    public function estadoMenu($id)
    {
        $menu=PX_SIS_MENU::find($id);


        $objeto=(json_decode($menu,1));

        if(count($objeto)>0)
        {
            $menu->Estado=($menu->Estado=="A")?"I":"A";
            $menu->save();
            return "OK";
        }

        return "NO";

    }

    /**
     * verificar nombres de Menú por identificador
     * @param Request $data
     * @return string
     */
    public function validarMenuById(Request $data)
    {
        $validar=PX_SIS_MENU::where("Nombre",$data->menu)
            ->where("Id","<>",$data->idMenu)
            ->where("IdModulo","<>",$data->idModulo)
            ->get();
        if(count($validar)>0)
        {
            return "SI";
        }
        else
        {
            return "NO";
        }
    }

    /**
     * validar el Menús
     * @param Request $data
     * @return string
     */
    public function validarMenu(Request $data)
    {
        $validar=PX_SIS_MENU::where("Nombre",$data->Nombre)->where("IdModulo",$data->IdModulo)->get();
        if(count($validar)>0)
        {
            return "SI";
        }
        else
        {
            return "NO";
        }
    }

    /**
     * método para modificar el Menú existente
     * @param Request $data
     * @return array
     */
    public function modificarMenu(Request $data)
    {
        //dd($data->IdSistema);
        $menu=false;
        try
        {
            $menu=PX_SIS_MENU::where("Id",$data->IdMenu)
                ->update([
                    "Nombre"=>$data->Nombre,
                    "Descripcion"=>$data->Descripcion,
                    "Icono"=>$data->Icono,
                    "URL"=>$data->URL,
                    "IdModulo"=>$data->IdModulo
                ]);
        }
        catch (QueryException $ex)
        {
            Log::error("Error al Modificar la tabla MENÚ: ".$ex->getMessage());
        }


        if($menu)
        {
            return ["ESTADO"=>"OK","RESULTADO"=>"Menú:".$menu];

        }
        else
        {
            return ["ESTADO"=>"NO","DESCRIPCION"=>"Se presentó un error al realizar la actualización"];
        }


    }

    /**
     * creando nuevos Menú
     * @param Request $data
     * @return array
     */
    public function crearMenu(Request $data)
    {
        $menu=false;
        try
        {
            $menu=new PX_SIS_MENU();

            $menu->Nombre=$data->Nombre;
            $menu->Descripcion=$data->Descripcion;
            $menu->Icono=$data->Icono;
            $menu->URL=$data->URL;
            $menu->IdModulo=$data->IdModulo;
            $menu->FechaCreacion=date("Y-m-d H:i:s");
            $menu->Estado="A";
            $menu->save();
        }
        catch (QueryException $ex)
        {
            Log::error("Error al crear datos en la tabla MENÚ: ".$ex->getMessage());
        }


        if(isset($menu->Id))
        {
            return ["ESTADO"=>"OK","DESCRIPCION"=>"Datos creados correctamente"];

        }
        else
        {
            return ["ESTADO"=>"NO","DESCRIPCION"=>"Se presentó un error al insertar en la tabla"];
        }


    }


    //Métodos para SubMenús

    /**
     * Mostrando el listado de SubMenús que existen
     * @param Request $data
     * @param $sistema
     * @param $modulo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSubMenu(Request $data,$sistema=0,$modulo=0,$menu=0)
    {
        $msg=Session::get("msg");
        $titleMsg = "Administración de SubMenús";
        $libs2Load=["DataTables"=>true,"Select2"=>true,"SweetAlert"=>true];

        $sistemas=json_decode(PX_SIS_SISTEMA::select("Id","Nombre")->orderBy('Id', 'asc')->get());
        $modulos=json_decode(PX_SIS_MODULO::select("Id","Nombre","IdSistema")->get());
        $menus=json_decode(PX_SIS_MENU::select("Id","Nombre","IdModulo")->get());

        //dd($sistema,$modulo);
        if ($data->isMethod('post')) {
            //$menus = json_decode(PX_SIS_MENU::with("Modulo.Sistema")->get());

            $subMenus=json_decode(
                DB::table("PX_SIS_Sub_Menu as SM")
                    ->join("PX_SIS_Menu as M","M.Id","=","SM.IdMenu")
                    ->join("PX_SIS_Modulo as Md","Md.Id","=","M.IdModulo")
                    ->join("PX_SIS_Sistema as S","S.Id","=","Md.IdSistema")
                    ->where(function ($query)use($sistema,$modulo,$menu){
                        (isset($sistema) && $sistema!=0)?$query->where("S.Id","$sistema"):"";
                        (isset($modulo) && $modulo!=0 && isset($sistema) && $sistema!=0)?$query->where("Md.Id","$modulo"):"";
                        (isset($menu) && $menu!=0 && isset($modulo) && $modulo!=0 && isset($sistema) && $sistema!=0)?$query->where("M.Id","$menu"):"";
                    })
                    ->select("SM.*","S.Nombre as Sistema","S.Id as IdSistema","Md.Nombre as Modulo","Md.Id as IdModulo","M.Nombre as Menu")
                    ->get()
            );

        }

        if ($data->isMethod('get')) {
            $subMenus=json_decode(
                DB::table("PX_SIS_Sub_Menu as SM")
                    ->join("PX_SIS_Menu as M","M.Id","=","SM.IdMenu")
                    ->join("PX_SIS_Modulo as Md","Md.Id","=","M.IdModulo")
                    ->join("PX_SIS_Sistema as S","S.Id","=","Md.IdSistema")
                    ->select("SM.*","S.Nombre as Sistema","S.Id as IdSistema","Md.Nombre as Modulo","Md.Id as IdModulo","M.Nombre as Menu")
                    ->get()
            );
        }


        // dd($menus);

        return view("Sistema.Pointex.Modulo.Administracion.Estructura.subMenus",get_defined_vars());
    }

    /**
     * modificando el estado del SubMenú
     * @param $id
     * @return string
     */
    public function estadoSubMenu($id)
    {
        $subMenu=PX_SIS_SUB_MENU::find($id);


        $objeto=(json_decode($subMenu,1));

        if(count($objeto)>0)
        {
            $subMenu->Estado=($subMenu->Estado=="A")?"I":"A";
            $subMenu->save();
            return "OK";
        }

        return "NO";

    }

    /**
     * verificar nombres de SubMenú por identificador
     * @param Request $data
     * @return string
     */
    public function validarSubMenuById(Request $data)
    {
        $validar=PX_SIS_SUB_MENU::where("Nombre",$data->menu)
            ->where("Id","<>",$data->idSubMenu)
            ->where("IdMenu","<>",$data->idMenu)
            ->get();
        if(count($validar)>0)
        {
            return "SI";
        }
        else
        {
            return "NO";
        }
    }

    /**
     * validar el SubMenús
     * @param Request $data
     * @return string
     */
    public function validarSubMenu(Request $data)
    {
        $validar=PX_SIS_SUB_MENU::where("Nombre",$data->Nombre)->where("IdMenu",$data->IdMenu)->get();
        if(count($validar)>0)
        {
            return "SI";
        }
        else
        {
            return "NO";
        }
    }

    /**
     * método para modificar el SubMenú existente
     * @param Request $data
     * @return array
     */
    public function modificarSubMenu(Request $data)
    {
        //dd($data->IdSistema);
        $subMenu=false;
        try
        {
            $subMenu=PX_SIS_SUB_MENU::where("Id",$data->IdSubMenu)
                ->update([
                    "Nombre"=>$data->Nombre,
                    "Descripcion"=>$data->Descripcion,
                    "Icono"=>$data->Icono,
                    "URL"=>$data->URL,
                    "IdMenu"=>$data->IdMenu
                ]);
        }
        catch (QueryException $ex)
        {
            Log::error("Error al Modificar la tabla SUBMENÚ: ".$ex->getMessage());
        }


        if($subMenu)
        {
            return ["ESTADO"=>"OK","RESULTADO"=>"SubMenú:".$subMenu];

        }
        else
        {
            return ["ESTADO"=>"NO","DESCRIPCION"=>"Se presentó un error al realizar la actualización"];
        }


    }

    /**
     * creando nuevos SubMenú
     * @param Request $data
     * @return array
     */
    public function crearSubMenu(Request $data)
    {
        $subMenu=false;
        try
        {
            $subMenu=new PX_SIS_SUB_MENU();

            $subMenu->Nombre=$data->Nombre;
            $subMenu->Descripcion=$data->Descripcion;
            $subMenu->Icono=$data->Icono;
            $subMenu->URL=$data->URL;
            $subMenu->IdMenu=$data->IdMenu;
            $subMenu->FechaCreacion=date("Y-m-d H:i:s");
            $subMenu->Estado="A";
            $subMenu->save();
        }
        catch (QueryException $ex)
        {
            Log::error("Error al crear datos en la tabla SUBMENÚ: ".$ex->getMessage());
        }


        if(isset($subMenu->Id))
        {
            return ["ESTADO"=>"OK","DESCRIPCION"=>"Datos creados correctamente"];

        }
        else
        {
            return ["ESTADO"=>"NO","DESCRIPCION"=>"Se presentó un error al insertar en la tabla"];
        }


    }
}
