<?php

namespace App\Http\Controllers\Sistema\Pointex\Modulo\Administracion;


use App\Mail\creacionUsuario;
use App\Modelos\CORE\PX_SIS_ENTIDAD;
use App\Modelos\CORE\PX_SIS_MENU;
use App\Modelos\CORE\PX_SIS_MODULO;
use App\Modelos\CORE\PX_SIS_PAIS;
use App\Modelos\CORE\PX_SIS_PERFIL;
use App\Modelos\CORE\PX_SIS_PERFIL_MENU;
use App\Modelos\CORE\PX_SIS_PERFIL_MODULO;
use App\Modelos\CORE\PX_SIS_PERFIL_SUB_MENU;
use App\Modelos\CORE\PX_SIS_PERFIL_USUARIO;
use App\Modelos\CORE\PX_SIS_Puesto;
use App\Modelos\CORE\PX_SIS_SUB_MENU;
use App\Modelos\CORE\PX_SIS_TIPO_USUARIO;
use App\Modelos\CORE\PX_SIS_USUARIO;
use http\Exception\BadQueryStringException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use PhpParser\JsonDecoder;


class CatalogosController extends Controller
{
    /**
     * método para mostrar paises
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPaises()
    {
        $msg = Session::get("msg");
        $titleMsg = "Administración de Países";
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true];
        // se obtienen todos los paises en orden ascendente.
        $paises = json_decode(PX_SIS_PAIS::orderBy('Nombre', 'asc')->get());
        return view("Sistema.Pointex.Modulo.Administracion.Catalogos.paises", get_defined_vars());
    }

    /**
     *  validar que el país existe
     * @param Request $data
     * @return string
     */
    public function val_pais(Request $data)
    {
        $validar = PX_SIS_PAIS::where("Nombre", $data->Nombre)->get();
        return (count($validar) > 0) ? "SI" : "NO";
    }

    /**
     * buscar país diferentes
     * @param Request $data
     * @param $id
     * @return string
     */
    public function val_pais_id(Request $data, $id)
    {
        $validar = PX_SIS_PAIS::where("Nombre", $data->Nombre)->where("Id", "<>", $id)->get();
        return (count($validar) > 0) ? "SI" : "NO";

    }

    /**
     * verificando el estado del Pais
     * @param $id
     * @return string
     */
    public function estadoPais($id)
    {
        $country = PX_SIS_PAIS::find($id);
        $objeto = (json_decode($country, 1));
        if (count($objeto) > 0) {
            $country->Estado = ($country->Estado == "A") ? "I" : "A";
            $country->save();
            return "OK";
        }
        return "NO";
    }

    /**
     * método para modificar el sistema existente
     * @param Request $data
     * @return array
     */
    public function modificarPais(Request $data)
    {
        $pais = false;
        try {
            $pais = PX_SIS_PAIS::where("Id", $data->id)
                ->update([
                    "Nombre" => $data->Nombre,
                    "Codigo" => $data->Codigo
                ]);
        } catch (QueryException $ex) {
            Log::error("Error al Modificar la tabla PX_SIS_PAIS: " . $ex->getMessage());
        }

        if ($pais) {
            return ["ESTADO" => "OK", "RESULTADO" => "PX_SIS_PAIS:" . $pais];

        } else {
            return ["ESTADO" => "NO", "DESCRIPCION" => "Se presentó un error al realizar la actualización"];
        }


    }

    /**
     * creando nuevos sistemas
     * @param Request $data
     * @return array
     */
    public function crearPais(Request $data)
    {
        $pais = false;
        try {
            $pais = new PX_SIS_PAIS();

            $pais->Nombre = $data->Nombre;
            $pais->Codigo = $data->Codigo;

            $pais->save();
        } catch (QueryException $ex) {
            Log::error("Error al crear datos en la tabla PX_SIS_PAIS: " . $ex->getMessage());
        }


        if (isset($pais->Id)) {
            return ["ESTADO" => "OK", "DESCRIPCION" => "Datos creados correctamente"];

        } else {
            return ["ESTADO" => "NO", "DESCRIPCION" => "Se presentó un error al insertar en la tabla"];
        }


    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showTipoUsers()
    {
        ini_set('memory_limit','1G');
        $msg = Session::get("msg");
        $titleMsg = "Administración de Permisos";
        $libs2Load = ["DataTables" => false, "SweetAlert" => true, "Select2" => true];

        $modulos = PX_SIS_MODULO::select("Id", "Nombre")
            ->with("Menu.SubMenu")
            ->orderBy('Nombre', 'asc')
            ->get();
        $permisos = collect([]);
        $perfiles = PX_SIS_PERFIL::with("PerfilModulo", "PerfilMenu", "PerfilSubMenu")->get();
        if ($perfiles->count() > 0) {
            foreach ($perfiles as $kp => $vp) {
                $arrayInterno = collect([]);
                $countModulos = $vp->PerfilModulo->count();
                $modelMenu = PX_SIS_MENU::from("PX_SIS_MENU as ME")
                    ->join("PX_SIS_PerfilMenu as PME", "ME.Id","=","PME.IdMenu")
                    ->select("ME.Id", "ME.Nombre", "ME.IdModulo","PME.IdPerfil as IdPME")
                    ->get();
                $modelSubMenu = PX_SIS_SUB_MENU::from("PX_SIS_SUB_MENU as SM")
                    ->join("PX_SIS_PerfilSubMenu as PSM", "SM.Id","=", "PSM.IdSubMenu")
                    ->select("SM.Id", "SM.Nombre", "SM.IdMenu", "PSM.IdPerfil as IdPSM")
                    ->get();
                if ($countModulos > 0) {
                    $perfilMenu = $vp->PerfilMenu;
                    $perfilSubMenu = $vp->PerfilSubMenu;
                    $idModeulos = $vp->PerfilModuloId()->pluck("IdModulo");
                    $arrayInterno["PerfilId"] = $vp->Id;
                    $arrayInterno["PerfilNombre"] = $vp->Nombre;
                    $arrayInterno["Modulo"] = PX_SIS_MODULO::from("PX_SIS_MODULO as M")
                        ->join("PX_SIS_PerfilModulo as PM","M.Id","=","PM.IdModulo")
                        ->select("M.Id","M.Nombre","PM.IdPerfil", "PM.Id as IdPM")
                        ->whereIn("M.Id", $idModeulos)
                        ->get()
                        ->each(function ($v, $k) use ($perfilMenu, $perfilSubMenu,$modelMenu, $modelSubMenu) {
                            $v->Menus = null;
                            if ($perfilMenu->count() > 0) {
                                $arrayMenus = $perfilMenu->pluck("IdMenu");
                                $v->Menus = $modelMenu->whereIn("Id",$arrayMenus)
                                    ->values()
                                    ->each(function ($vi, $ki) use ($perfilSubMenu,$modelSubMenu) {
                                        $vi->SubMenus = null;
                                        $arrayMenus = $perfilSubMenu->pluck("IdSubMenu");
                                        if ($perfilSubMenu->count() > 0) {
                                            $vi->SubMenus = $modelSubMenu->whereIn("Id", $arrayMenus);
                                        }
                                        return $vi;
                                    });
                            }
                            return $v;
                        });
                    $permisos->add($arrayInterno);
                }
            }

        }

        return view("Sistema.Pointex.Modulo.Administracion.Catalogos.permisos", get_defined_vars());
    }

    /**
     * @param Request $data
     * @return array
     */
    public function updateTipoUser(Request $request)
    {
        $idPerfil = trim($request->input("IdPerfil"));
        $arrayIdModulos = is_array($request->input("IdModulo")) && count($request->input("IdModulo"))>0 ? $request->input("IdModulo") : false;
        $arrayIdMenu = is_array($request->input("IdMenu")) && count($request->input("IdMenu"))>0 ? $request->input("IdMenu") : false;
        $arrayIdSubMenu = is_array($request->input("IdSubMenu")) && count($request->input("IdSubMenu"))>0 ? $request->input("IdSubMenu") : false;

        $modelPModulo = PX_SIS_PERFIL_MODULO::where('IdPerfil',$idPerfil);
        $modelPMmenu = PX_SIS_PERFIL_MENU::where('IdPerfil',$idPerfil);
        $modelPSMmenu = PX_SIS_PERFIL_SUB_MENU::where('IdPerfil',$idPerfil);

        if ($arrayIdModulos){
            $modelPModulo->delete();
            foreach ($arrayIdModulos as $kam => $var){
                $modelPModulo->insert([
                    "IdPerfil" => $idPerfil,
                    "IdModulo" => $var,
                ]);
            }
        }
        if ($arrayIdMenu){
            $modelPMmenu->delete();
            foreach ($arrayIdMenu as $kam => $var){
                $modelPMmenu->insert([
                    "IdPerfil" => $idPerfil,
                    "IdMenu" => $var,
                ]);
            }
        }

        if ($arrayIdSubMenu){
            $modelPSMmenu->delete();
            foreach ($arrayIdSubMenu as $kam => $var){
                $modelPSMmenu->insert([
                    "IdPerfil" => $idPerfil,
                    "IdSubMenu" => $var,
                ]);
            }
        }
        return ["ESTADO" => "OK", "RESULTADO" => "Datos guardados con exito"];
    }

    /**
     * @param Request $data
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deletePermisos(Request $data){

        $deletPM = (json_decode($data->id));

        DB::table('PX_SIS_PerfilModulo')->where('IdPerfil', '=', $deletPM->PerfilId)->delete();
        DB::table('PX_SIS_PerfilMenu')->where('IdPerfil', '=', $deletPM->PerfilId)->delete();
        DB::table('PX_SIS_PerfilSubMenu')->where('IdPerfil', '=', $deletPM->PerfilId)->delete();

        return redirect('pointex/administracion/accesos/asignar_permisos');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAsignarPerfil(){


        $msg = Session::get("msg");
        $titleMsg = "Asignación de Perfiles";
        $titleMsg2 = "Asignación de Perfiles";
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true,];

        $users = PX_SIS_USUARIO::with("Persona")->where('Estado', '=', 'A')->get();

        $perfiles = PX_SIS_PERFIL::select('Id', 'Nombre')->get();

        $roles = PX_SIS_PERFIL_USUARIO::with("Usuario.Persona", "Perfil")->get();

        $puesto = PX_SIS_Puesto::get()->pluck("Nombre", "Id");

        return view("Sistema.Pointex.Modulo.Administracion.Catalogos.perfil.listarperfil", get_defined_vars());
    }

    /**
     * @param Request $data
     * @return array
     */
    public function crearUsuarioPerfil(Request $data){


        try {

            $validar = PX_SIS_PERFIL_USUARIO::where("IdUsuario", $data->IdUsuario)->get();


            $regInsert = false;
            if (count($validar) > 0) {
                //update

                foreach ($data->IdPerfil as $perfil) {
                    $regInsert = DB::table('PX_SIS_Perfil_Usuario')->updateOrInsert(
                        ['IdUsuario' => $data->IdUsuario, 'IdPerfil' => $perfil]
                    );

                }

            } else {
                //insert
                foreach ($data->IdPerfil as $perfil) {
                    $regInsert = DB::table('PX_SIS_Perfil_Usuario')->insert(
                        ['IdUsuario' => $data->IdUsuario, 'IdPerfil' => $perfil]
                    );
                }

            }

            if ($regInsert == true) {
                return ["ESTADO" => "OK", "DESCRIPCION" => "Datos creados correctamente"];
            } else {
                return ["ESTADO" => "NO", "DESCRIPCION" => "Datos creados correctamente"];
            }


        } catch (QueryException $ex) {
            Log::error("Error al crear datos en la tabla Perfil_Usuario: " . $ex->getMessage());


        }

    }



    /**
     * @param Request $data
     * @return string
     */
    public function valUsuarioPerfil(Request $data)
    {
        $validar = PX_SIS_PERFIL_USUARIO::select(DB::raw(1))
            ->from('PX_SIS_Perfil_Usuario')->where("IdUsuario",  $data->IdUsuario)->where("IdPerfil",$data->IdPerfil)->get();

        return (count($validar) > 0) ? "SI" : "NO";
    }

    /**
     * @param Request $data
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteUsuarioPerfil(Request $data){

        DB::table('PX_SIS_Perfil_Usuario')->where('IdUsuario', $data->id)->delete();

        return redirect('pointex/administracion/accesos/asignar_perfil');
    }

    /**
     * @param Request $data
     * @return array
     */
    public function EliminarPerfil(Request $data){

        $regDelete = false;

        $validar = PX_SIS_PERFIL_USUARIO::where("IdUsuario", $data->IdUsuario)->select("IdUsuario","IdPerfil")->get();

        $compara = $validar->toArray();
        $compara1= array_column($compara, 'IdPerfil');
        $input = $data->IdPerfil;
        $delete= array_diff($compara1,$input);


        foreach ($delete as $k => $perfil) {
            //IdUsuario
            //IdPerfil
            $regDelete =  DB::table('PX_SIS_Perfil_Usuario')->where("IdUsuario",$data->IdUsuario)->where('IdPerfil',$perfil)->delete();

        }
        if ($regDelete == true) {
            return ["ESTADO" => "OK", "DESCRIPCION" => "Datos eliminados correctamente"];
        } else {
            return ["ESTADO" => "NO", "DESCRIPCION" => "Datos no se pueden eliminar"];
        }

    }

    /**retorna a la vista la data de la tabla entidad
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showEntidad()
    {
        $msg = Session::get("msg");
        $titleMsg = "Administración de Entidades";
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true,];
        // se obtienen todos los tipos de usuarios en orden ascendente.
        $paises = json_decode(PX_SIS_PAIS::all());
        $entidades = json_decode(PX_SIS_ENTIDAD::with("Pais")->orderBy('Nombre', 'asc')->get());

        return view("Sistema.Pointex.Modulo.Administracion.Catalogos.entidad", get_defined_vars());
    }

    /**
     * @param $id
     * @return string
     */
    public function estadoEntidad($id)
    {
        $entidad = PX_SIS_ENTIDAD::find($id);


        $objeto = (json_decode($entidad, 1));

        if (count($objeto) > 0) {
            $entidad->Estado = ($entidad->Estado == "A") ? "I" : "A";
            $entidad->save();
            return "OK";
        }

        return "NO";
    }

    /**funcion para crear realizar update a la tabla entidad
     * @param Request $data
     * @return array
     */
    public function updateEntidad(Request $data)
    {
        $entidad = false;
        try {
            $entidad = PX_SIS_ENTIDAD::where("Id", $data->id)
                ->update([
                    "Nombre" => $data->Nombre,
                    "Descripcion" => $data->Descripcion,
                    "RazonSocial" => $data->RazonSocial,
                    "Representante" => $data->Representante,
                    "IdPais" => $data->IdPais,
                    "Direccion" => $data->Direccion,
                    "Telefono" => $data->Telefono,
                    "Correo" => $data->Correo,
                    "Relacion" => $data->Relacion,
                    "Fabricante" => $data->Fabricante,
                ]);
        } catch (QueryException $ex) {
            Log::error("Error al Modificar la tabla entidad: " . $ex->getMessage());
        }


        if ($entidad) {
            return ["ESTADO" => "OK", "RESULTADO" => "PX_SIS_ENTIDAD:" . $entidad];

        } else {
            return ["ESTADO" => "NO", "DESCRIPCION" => "Se presentó un error al realizar la actualización en tabla entidad"];
        }


    }

    /**funcion para realizar un registro de una nueva entidad
     * @param Request $data
     * @return array
     */
    public function crearEntidad(Request $data)
    {
        $entidad = false;
        try {
            $entidad = new PX_SIS_ENTIDAD();

            $entidad->Nombre = $data->Nombre;
            $entidad->Descripcion = $data->Descripcion;
            $entidad->RazonSocial = $data->RazonSocial;
            $entidad->Representante = $data->Representante;
            $entidad->IdPais = $data->IdPais;
            $entidad->Direccion = $data->Direccion;
            $entidad->Telefono = $data->Telefono;
            $entidad->Correo = $data->Correo;
            $entidad->Relacion = $data->Relacion;
            $entidad->Fabricante = $data->Fabricante;


            $entidad->save();
        } catch (QueryException $ex) {
            Log::error("Error al crear datos en la tabla Entidad: " . $ex->getMessage());
        }


        if (isset($entidad->Id)) {
            return ["ESTADO" => "OK", "DESCRIPCION" => "Datos creados correctamente"];

        } else {
            return ["ESTADO" => "NO", "DESCRIPCION" => "Se presentó un error al insertar datos en la tabla Entidad"];
        }


    }


    /**validar entidad
     * @param Request $data
     * @return string
     */
    public function valEntidad(Request $data)
    {
        $validar = PX_SIS_ENTIDAD::where("Nombre", $data->Nombre)->get();
        if (count($validar) > 0) {
            return "SI";
        } else {
            return "NO";
        }
    }

    /**
     * @param Request $data
     * @param $id
     * @return string
     */
    public function valEntidadId(Request $data, $id)
    {                                                               //id se obtiene de la funcion js
        $validar = PX_SIS_ENTIDAD::where("Nombre", $data->Nombre)->where("Id", "<>", $id)->get();
        if (count($validar) > 0) {
            return "SI";
        } else {
            return "NO";
        }

    }

    //funciones para perfiles

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPerfil()
    {


        $msg = Session::get("msg");
        $titleMsg = "Administración de Perfiles";
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true, "Switch" => true, "ModalEffects" => true];
        // se obtienen todos los tipos de usuarios en orden ascendente.

        $perfiles = PX_SIS_PERFIL::orderBy('Nombre', 'asc')->get();

        return view("Sistema.Pointex.Modulo.Administracion.Catalogos.perfil", get_defined_vars());
    }

    /**altas y bajas sobre un perfil
     * @param $id
     * @return string
     */
    public function estadoPerfil($id)
    {
        $perfil = PX_SIS_PERFIL::find($id);


        $objeto = (json_decode($perfil, 1));

        if (count($objeto) > 0) {
            $perfil->Estado = ($perfil->Estado == "A") ? "I" : "A";
            $perfil->save();
            return "OK";
        }

        return "NO";
    }

    /**
     * @param Request $data
     * @return string
     */
    public function valPerfil(Request $data)
    {
        $validar = PX_SIS_PERFIL::where("Nombre", $data->Nombre)->get();
        if (count($validar) > 0) {
            return "SI";
        } else {
            return "NO";
        }
    }

    /**
     * @param Request $data
     * @param $id
     *
     * @return string
     */
    public function valPerfilId(Request $data, $id)
    {                                                               //id se obtiene de la funcion js
        $validar = PX_SIS_PERFIL::where("Nombre", $data->Nombre)->where("Id", "<>", $id)->get();
        if (count($validar) > 0) {
            return "SI";
        } else {
            return "NO";
        }

    }

    /**
     * @param Request $data
     * @return array
     */
    public function updatePerfil(Request $data)
    {

        $perfil = false;
        try {
            $perfil = PX_SIS_PERFIL::where("Id", $data->id)
                ->update([
                    "Nombre" => $data->Nombre,
                ]);
        } catch (QueryException $ex) {
            Log::error("Error al Modificar la tabla perfil: " . $ex->getMessage());
        }


        if ($perfil) {
            return ["ESTADO" => "OK", "RESULTADO" => "PX_SIS_PERFIL    :" . $perfil];

        } else {
            return ["ESTADO" => "NO", "DESCRIPCION" => "Se presentó un error al realizar la actualización en tabla Perfil".$perfil];
        }


    }

    /**
     * @param Request $data
     * @return array
     */
    public function crearPerfil(Request $data)
    {
        $perfil = false;
        try {
            $perfil = new PX_SIS_PERFIL();

            $perfil->Nombre = $data->Nombre;

            $perfil->save();
        } catch (QueryException $ex) {
            Log::error("Error al crear datos en la tabla Perfil: " . $ex->getMessage());
        }


        if (isset($perfil->Id)) {
            return ["ESTADO" => "OK", "DESCRIPCION" => "Datos creados correctamente"];

        } else {
            return ["ESTADO" => "NO", "DESCRIPCION" => "Se presentó un error al insertar datos en la tabla Perfil"];
        }


    }

    public function deletePerfil(Request $data)
    {
        $perfil = false;
        try{

            $datos = PX_SIS_PERFIL::find($data->id);
            $datos->delete();
            return redirect('pointex/administracion/catalogos/perfil');
        }catch (QueryException $e){
            Log::error("Error al crear datos en la tabla PX_SIS_Perfil: " . $e->getMessage());
            return '<script type="text/javascript">alert("hello!");</script>';
        }
        if ($perfil) {
            return ["ESTADO" => "OK", "RESULTADO" => "PX_SIS_PERFIL:" ];

        } else {
            return ["ESTADO" => "NO", "DESCRIPCION" => "Se presentó un error al eliminar el registro"];
        }

    }
}


