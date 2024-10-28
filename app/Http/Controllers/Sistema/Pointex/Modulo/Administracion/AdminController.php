<?php

namespace App\Http\Controllers\Sistema\Pointex\Modulo\Administracion;

use App\Http\Controllers\BaseController;
use App\Modelos\CORE\PX_SIS_Departamento;
use App\Modelos\CORE\PX_SIS_ENTIDAD;
use App\Modelos\CORE\PX_SIS_MENU;
use App\Modelos\CORE\PX_SIS_MODULO;
use App\Modelos\CORE\PX_SIS_PAIS;
use App\Modelos\CORE\PX_SIS_PERFIL;
use App\Modelos\CORE\PX_SIS_PERSONA;
use App\Modelos\CORE\PX_SIS_PERSONA_CONTACTO;
use App\Modelos\CORE\PX_SIS_ROLES_USUARIO;
use App\Modelos\CORE\PX_SIS_SUB_MENU;
use App\Modelos\CORE\PX_SIS_TIPO_USUARIO;
use App\Modelos\CORE\PX_SIS_USUARIO;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AdminController extends BaseController
{
    /**
     * método para mostrar la pantalla de usuarios
     * @param Request $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUsuarios(Request $request)
    {

        $msg = Session::get("msg");
        $titleMsg = "Administración de Usuarios";
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true, "Acordion" => true, "ModalEffects" => true];
        $entidad = PX_SIS_ENTIDAD::where("Tipo", "1")->orderBy("Nombre", "asc")->get();
        //  $paises = json_decode(PX_SIS_PAIS::select("Id","Nombre")->orderBy("Nombre","asc")->get());
        $Personas = json_decode(PX_SIS_PERSONA::where("Estado", "A")->orderBy("Nombres", "asc")->get());
        $Modulos = json_decode(PX_SIS_MODULO::where("Estado", "A")->orderBy("Nombre", "asc")->get());
        $Menus = json_decode(PX_SIS_MENU::where("Estado", "A")->orderBy("Nombre", "asc")->get());
        $SubMenus = json_decode(PX_SIS_SUB_MENU::where("Estado", "A")->orderBy("Nombre", "asc")->get());
        $departamentos = PX_SIS_Departamento::select('Id','Nombre')->orderby("Nombre", "asc")->get();
        $paises = PX_SIS_PAIS::select('Id', "Nombre")->where("TipoUso",1)->orderBy("Nombre", "asc")->get();

        $request = $this->UrlToData($request);
        $vista = "";

      if ($request->crear){
        $vista = $this->formInsertUser(0);
      }elseif ($request->edit){

      }
      //  $menData2 = json_encode($Menus);
       // $SmenData = json_encode($SubMenus);
            $personData = DB::table('PX_SIS_Persona as P')
                ->leftjoin('PX_SIS_Contacto as PC', 'PC.IdPersona', '=', 'P.Id')
                ->leftjoin('PX_SIS_Usuario as U', 'P.Id', '=', 'U.IdPersona')
                ->leftJoin('PX_SIS_Entidad as E', 'E.Id', '=', 'P.IdEntidad')
                ->join('PX_SIS_Puesto as PS',"PS.Id","=","U.IdPuesto")
                ->select("P.Id as idp",
                    "P.Nombres",
                    "P.Apellidos",
                    "P.Estado as estadoP",
                    "U.Id as idu",
                    "U.Estado as estadoU",
                    "U.Usuario",
                    "U.FechaCreacion as fechaU",
                    "PC.Correo",
                    "PC.Telefono",
                    "E.Nombre as Entidad",
                    "PS.Nombre as Puesto")
                ->take(100)
                ->orderBy('P.Id', 'desc')
                ->distinct('P.Id')
                ->get();
/*
        if ($data->isMethod('post')) {

            if ($data->crear){
                dd($data);
            }

            $nombres = $data->txtNom;
            $cui = $data->txtCUI;
            $mail = $data->txtMail;
            $usuario = $data->txtUser;
            $ent = $data->slcEnt;
            $pais = $data->slcPaises;

            $personData = DB::table('PX_SIS_Persona as P')
                ->leftjoin('PX_SIS_Contacto as PC', 'PC.IdPersona', '=', 'P.Id')
                ->leftjoin('PX_SIS_Usuario as U', 'P.Id', '=', 'U.IdPersona')
                ->join('PX_SIS_Entidad as E', 'E.Id', '=', 'P.IdEntidad')
                ->select("P.Id as idp",
                    "P.Nombres",
                    "P.Apellidos",
                    "P.Estado as estadoP",
                    "U.Id as idu",
                    "U.Estado as estadoU",
                    "U.Usuario",
                    "U.FechaCreacion as fechaU",
                    "PC.Correo",
                    "PC.Telefono",

                    "E.Nombre as Entidad")
                ->where(function ($query) use ($nombres, $mail, $usuario, $ent, $pais) {
                    (isset($nombres) && $nombres != '') ? $query->where('P.nombres', 'like', '%' . $nombres . '%') : '';
                    (isset($mail) && $mail != '') ? $query->where('PC.Correo', $mail) : '';
                    (isset($usuario) && $usuario != '') ? $query->where('U.Usuario', '=', $usuario) : '';
                    (isset($ent) && $ent != '') ? $query->where('P.IdEntidad', '=', $ent) : '';
                    (isset($pais) && $pais != '') ? $query->where('PC.IdPais', '=', $pais) : '';
                })
                //->take(100)
                ->orderBy('P.Id', 'desc')
                ->distinct('P.Id')
                ->get();

        }
*/
        //dd($personData);

        return view("Sistema.Pointex.Modulo.Administracion.._vistasUsuario._indexUsuario", get_defined_vars());
    }
    private function FormInsertUser($Id){
        $titleMsg = "Creación de Usuarios";
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true, "Acordion" => true, "ModalEffects" => true];
        $arrayPais = PX_SIS_PAIS::Select("Id","Nombre")->where("TipoUso",1)->get()->pluck("Nombre","Id");

        $paises = PX_SIS_PAIS::select('Id', "Nombre")->where("TipoUso",1)->orderBy("Nombre", "asc")->get();

        $cmbPais = $this->SelectedUniversales(collect(["Pais" =>  $arrayPais]), true,
            false, [], true, true, false, false, false, false, "Seleccione...", null);

        $EntidadDeptoPuesto = $this->getEntidadDeptoPuesto();


        $arrayPersona = PX_SIS_PERSONA::from("PX_SIS_PERSONA as p")->select(DB::raw("concat(Nombres,' ',Apellidos) as Persona"), "Id")->whereNull("FechaRetiro")->get()->pluck("Persona", "Id")->toArray();
        $cmbPersona = $this->SelectedUniversales(collect(["Persona" => $arrayPersona]), null,
            false, ["name" => "cmbPersona","id" => "cmbPersona" ,"class" => "select2_single form-control"], false, true, false, false, false, false);

        return view("Sistema.Pointex.Modulo.Administracion.._vistasUsuario._frmInsert", get_defined_vars());
    }

    /**
     * mostrar pantalla de personas
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRoles(Request $data)
    {

        $libs2Load = ["SweetAlert" => true];

        if ($data->isMethod("POST")) {

            $usuarioMenus = DB::table("PX_SIS_Usuario as U")
                ->join("PX_SIS_Roles_Usuario as RU", "RU.IdUsuario", "=", "U.Id")
                ->join("PX_SIS_Persona as P", "P.Id", "=", "U.IdPersona")
                //->where("U.Id",$idUsuario)
                ->where(function ($query) use ($data) {
                    (isset($data->idUsuario) && $data->idUsuario != "") ? $query->where("U.Id", $data->idUsuario) : "";

                    (isset($data->txtUser) && $data->txtUser != "") ? $query->where("U.Usuario", $data->txtUser) : "";
                })
                ->where("U.Estado", "A")
                ->select("RU.IdMenu", "U.Id as Usuario", "U.Usuario as UsuarioName")
                ->groupBy("RU.IdMenu", "U.Id", "U.Usuario")
                ->get();


            $usuarioSubMenus = DB::table("PX_SIS_Usuario as U")
                ->join("PX_SIS_Roles_Usuario as RU", "RU.IdUsuario", "=", "U.Id")
                ->join("PX_SIS_Persona as P", "P.Id", "=", "U.IdPersona")
                //->where("U.Id",$idUsuario)
                ->where(function ($query) use ($data) {
                    (isset($data->idUsuario) && $data->idUsuario != "") ? $query->where("U.Id", $data->idUsuario) : "";

                    (isset($data->txtUser) && $data->txtUser != "") ? $query->where("U.Usuario", $data->txtUser) : "";
                })
                ->where("U.Estado", "A")
                ->select("RU.IdSubMenu", "RU.IdMenu")
                ->groupBy("RU.IdSubmenu", "RU.IdMenu")
                ->get();

            $roles = ["Menus" => json_decode($usuarioMenus), "SubMenus" => json_decode($usuarioSubMenus)];


            if (isset($roles["Menus"]) && count($roles["Menus"]) > 0) {
                $usuarioShearch = $roles["Menus"][0]->UsuarioName;
                $idUsuario = $roles["Menus"][0]->Usuario;
                $modulos = json_decode(PX_SIS_MODULO::where("Estado", "A")->orderBy("Nombre", "asc")->with("Menu.SubMenu")->get());
            } else {
                $usuario = DB::table("PX_SIS_Usuario as U")
                    ->join("PX_SIS_Persona as P", "P.Id", "=", "U.IdPersona")
                    ->where(function ($query) use ($data) {
                        (isset($data->idUsuario) && $data->idUsuario != "") ? $query->where("U.Id", $data->idUsuario) : "";

                        (isset($data->txtUser) && $data->txtUser != "") ? $query->where("U.Usuario", $data->txtUser) : "";
                    })
                    ->where("U.Estado", "A")
                    ->select("U.Id as Usuario", "U.Usuario as UsuarioName")
                    ->get();

                if (isset($usuario) && count($usuario) > 0) {
                    $usuarioShearch = $usuario[0]->UsuarioName;
                    $idUsuario = $usuario[0]->Usuario;
                    $modulos = json_decode(PX_SIS_MODULO::where("Estado", "A")->orderBy("Nombre", "asc")->with("Menu.SubMenu")->get());
                    $modulos = json_decode(PX_SIS_MODULO::where("Estado", "A")->orderBy("Nombre", "asc")->with("Menu.SubMenu")->get());
                }
            }
        }

        $titleMsg = "Roles de Usuario";
        $msg = Session::get("msg");

        return view("Sistema.Pointex.Modulo.Administracion.roles", get_defined_vars());
    }

    /**
     * mostrar pantalla de módulos
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showModulos()
    {
        $msg = Session::get("msg");
        return view("Sistema.Pointex.Modulo.Administracion.modulos", get_defined_vars());
    }

    /**
     * validar que el usuario existe
     * @param Request $data
     * @return string
     */
    public function val_usuario(Request $data)
    {
        $validar = PX_SIS_USUARIO::where("Usuario", $data->usuario)->get();
        if (count($validar) > 0) {
            return "SI";
        } else {
            return "NO";
        }
    }

    /**
     * buscar usuarios diferentes
     * @param Request $data
     * @param $id
     * @return string
     */
    public function val_usuario_id(Request $data, $id)
    {
        $validar = PX_SIS_USUARIO::where("Usuario", $data->usuario)->where("IdPersona", "<>", $id)->get();
        if (count($validar) > 0) {
            return "SI";
        } else {
            return "NO";
        }
    }

    /**
     * validando el correo
     * @param Request $data
     * @return string
     */
    public function val_correo(Request $data)
    {
        $validar = PX_SIS_PERSONA_CONTACTO::where("Correo", $data->correo)->get();
        if (count($validar) > 0) {
            return "SI";
        } else {
            return "NO";
        }
    }

    /**
     * verificando el estado del usuario
     * @param $id
     * @return string
     */
    public function estadoUser($id)
    {
        $usuario = PX_SIS_USUARIO::find($id);


        $objeto = (json_decode($usuario, 1));

        if (count($objeto) > 0) {
            $usuario->Estado = ($usuario->Estado == "A") ? "I" : "A";
            $usuario->FechaBaja;
            $usuario->save();
            return "OK";
        }

        return "NO";

    }

    /**
     * renovación de claves de usuarios
     * @param $id
     * @return string
     */
    public function renewUserPass($objeto)
    {
        if ($objeto->count()>0) {
            $clave = $this->generarPass();
            $objeto->Clave = md5($clave);
            $objeto->save();
            $to_name = trim($objeto->Nombres);
            $to_email = trim($objeto->Correo);

            $data = [
                'usuario' => $objeto->Usuario,
                "clave" => $clave
            ];
            try{
                Mail::send('Correos.claveUsuario', $data, function ($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                        ->subject('Modificación de Usuarios');
                    $message->from('pointex@exeltis.com', 'POINTEX ERP');
                });

                return "OK";
            }catch (\Exception $e){

            }

        }
        return "NO";
    }

    /**
     * devolviendo los datos del usuario
     * @param $id
     * @return mixed
     */
    public function infoUsuario($id)
    {
        $usuario = json_decode(PX_SIS_USUARIO::where("Id", $id)->with("Persona.PersonaIdentidad")->with("Persona.PersonaContacto")->get());


        if (count($usuario) > 0) {
            return ["ESTADO" => "OK", "DATOS" => $usuario];
        } else {
            return ["ESTADO" => "NO"];
        }
    }

    /**
     * modificar usuarios
     * @param Request $data
     * @return array
     */
    public function modificarUser(Request $data)
    {

        DB::beginTransaction();
        try {
            $persona = PX_SIS_PERSONA::find($data->IdPersona);
            $persona->IdEntidad = $data->IdEntidad;
            $persona->Nombres = $data->Nombres;
            $persona->Apellidos = $data->Apellidos;
            $persona->Genero = $data->Genero;
            $persona = $persona->save();


            $arrayInserContacto = [
                "IdPais" => $data->Pais,
                "Direccion" => $data->Direccion,
                "Correo" => $data->Correo,
                "Telefono" => $data->Telefono
            ];

            $modelContacto = PX_SIS_PERSONA_CONTACTO::where("IdPersona", $data->IdPersona);
            $modelUsuario = PX_SIS_Usuario::where("IdPersona", $data->IdPersona);
            if ($modelContacto->first()) {
                $persona_contacto = $modelContacto->update($arrayInserContacto);
                $modelUsuario->update(["Usuario" => strtok($data->Correo, '@')]);
            } else {
                $arrayInserContacto["IdPersona"] = $data->IdPersona;
                $persona_contacto = $modelContacto->insert($arrayInserContacto);
            }
            DB::commit();
            return ["ESTADO" => "OK", "RESULTADO" => "Persona:" . $persona  . "PersonaContac" . $persona_contacto];

        } catch (\Exception $ex) {
            DB::rollback();
            Log::error("Error al crear datos en la tabla PX_SIS_USUARIO: " . $ex->getMessage());
            return ["ESTADO" => "NO", "RESULTADO" => "Se presentó un problema al tratar de actualizar al usuario"];
        } catch (\Throwable $ex) {
            DB::rollback();
            Log::error("Error al crear datos en la tabla PX_SIS_USUARIO: " . $ex->getMessage());
            return ["ESTADO" => "NO", "RESULTADO" => "Se presentó un problema al tratar de actualizar al usuario"];
        } catch (QueryException $ex) {
            DB::rollback();
            Log::error("Error al crear datos en la tabla PX_SIS_USUARIO: " . $ex->getMessage());
            return ["ESTADO" => "NO", "RESULTADO" => "Se presentó un problema al tratar de actualizar al usuario"];
        }
    }

    /**
     * creación de usuarios
     * @param Request $data
     * @return array
     */
    public function crearUser(Request $data)
    {
        $user = strtok($data->Correo, '@');


        DB::beginTransaction();

        try {

            $idPersona = $data->IdPersona;
            $persona = new PX_SIS_PERSONA();
            $arrayPersona["IdEntidad"] =$data->IdEntidad;
            $arrayPersona["Genero"] =$data->Genero;
            $persona->find($idPersona)->update($arrayPersona);

            if ($idPersona) {
                $persona_contacto = new PX_SIS_PERSONA_CONTACTO();
//                $persona_contacto->IdPersona = $persona->Id;
                $persona_contacto->IdPersona = $idPersona;
                $persona_contacto->IdPais = $data->IdPais;
                $persona_contacto->Direccion = $data->Direccion;
                $persona_contacto->Correo = $data->Correo;
                $persona_contacto->Telefono = $data->Telefono;
                $persona_contacto->save();
            }


            if ($idPersona && isset($persona_contacto->Id)) {
                //$clave=$this->Creapass(rand(5,10));
                $clave = $this->generarPass();
                $usuario = new PX_SIS_USUARIO();
                $usuario->IdPersona = $idPersona;
                $usuario->Usuario = $user;
                $usuario->Clave = md5($clave);
                $usuario->IdPuesto = $data->IdPuesto;
                $usuario->save();

                if (isset($usuario->Id)) {

                    $to_name = $data->Nombres;
                    $to_email = $data->Correo;
                    $body = array('usuario' => $user, "clave" => $clave);
                    Mail::send('Correos.nuevoUsuario', $body, function ($message) use ($to_name, $to_email) {
                        $message->to($to_email, $to_name)
                            ->subject('Creación de Usuarios');
                        $message->from('pointex@exeltis.com', 'POINTEX ERP');
                    });

                    DB::commit();
                    return ["ESTADO" => "OK"];
                }
            }

        } catch (\Exception $ex) {
            DB::rollback();
            Log::error("Error al crear datos en la tabla PX_SIS_USUARIO: " . $ex->getMessage());
            return ["ESTADO" => "NO", "DESCRIPCION" => "SE PRESENTÓ UN ERROR AL TRATAR DE GUARDAR LOS DATOS".$ex->getMessage()];
        } catch (\Throwable $ex) {
            DB::rollback();
            Log::error("Error al crear datos en la tabla PX_SIS_USUARIO: " . $ex->getMessage());
            return ["ESTADO" => "NO", "DESCRIPCION" => "SE PRESENTÓ UN ERROR AL TRATAR DE GUARDAR LOS DATOS".$ex->getMessage()];
        } catch (QueryException $ex) {
            DB::rollback();
            Log::error("Error al crear datos en la tabla PX_SIS_USUARIO: " . $ex->getMessage());
            return ["ESTADO" => "NO", "DESCRIPCION" => "SE PRESENTÓ UN ERROR AL TRATAR DE GUARDAR LOS DATOS".$ex->getMessage()];
        }


    }

    /**
     * activación e inactivación de todos los submenus de un menu
     * @param Request $data
     * @return string
     */
    function activarRoles(Request $data)
    {
        $fechaBaja = ($data->estado == "I") ? date("Y-m-d H:i:s") : null;

        DB::beginTransaction();
        try {
            $roles = PX_SIS_ROLES_USUARIO::where("IdMenu", $data->idMenu)
                ->where("IdUsuario", $data->idUsuario)
                ->update(["Estado" => $data->estado, "FechaMod" => date("Y-m-d H:i:s"), "FechaBaja" => $fechaBaja]);
            DB::commit();
        } catch (QueryException $ex) {
            DB::rollback();
            Log::error("Error al activar reoles PX_SIS_USUARIO: " . $ex->getMessage());
        }

        if ($roles) {
            return "OK";
        }

        return "NO";
    }

    /**
     * crear y modificar los permisos por submenus
     * @param Request $data
     * @return string
     */
    function activarSubMenu(Request $data)
    {
        $buscarRoles = json_decode(PX_SIS_ROLES_USUARIO::where("IdMenu", $data->idMenu)->where("IdUsuario", $data->idUsuario)->where("IdSubMenu", $data->idSubMenu)->get());

        // dd($buscarRoles);

        if (isset($buscarRoles) && count($buscarRoles) > 0) {
            $fechaBaja = ($data->estado == "I") ? date("Y-m-d H:i:s") : null;

            DB::beginTransaction();
            try {
                $modificar = PX_SIS_ROLES_USUARIO::where("IdMenu", $data->idMenu)
                    ->where("IdSubMenu", $data->idSubMenu)
                    ->where("IdUsuario", $data->idUsuario)
                    ->update(["Estado" => $data->estado, "FechaMod" => date("Y-m-d H:i:s"), "FechaBaja" => $fechaBaja]);
                DB::commit();
            } catch (QueryException $ex) {
                DB::rollback();
                Log::error("Error al activar reoles PX_SIS_USUARIO: " . $ex->getMessage());
            }


            if ($modificar) {
                return "OK";
            } else {
                return "NO";
            }

        } else {

            DB::beginTransaction();
            try {
                $crear = new PX_SIS_ROLES_USUARIO();

                $crear->IdUsuario = $data->idUsuario;
                $crear->IdMenu = $data->idMenu;
                $crear->IdSubMenu = $data->idSubMenu;
                $crear->FechaCreacion = date("Y-m-d H:i:s");
                $crear->Estado = $data->estado;

                $crear->save();

                DB::commit();
            } catch (QueryException $ex) {
                DB::rollback();
                Log::error("Error al activar reoles PX_SIS_USUARIO: " . $ex->getMessage());
            }


            if ($crear) {
                return "OK";
            } else {
                return "NO";
            }


        }

        return "NO";
    }

    /**
     * obtiene reporte de roles segun el número de id de usuario
     * 2017-02-22 jarosales
     * @param Request $data
     * @return array|string
     * @throws \Throwable
     */
    public function reporteRoles(Request $data)
    {
        if (isset($data->idUser) && $data->idUser != null && $data->idUser != '' && is_numeric($data->idUser)) {
            $idUser = $data->idUser;
            $sql1 = $this->sqlRoles($idUser);
            //dd($sql1);
            if ($sql1['ESTATUS'] == 'OK') {
                $info = $sql1['DATA'];

                $array = [];
                $num = 1;
                foreach ($info as $i) {

                    $array[$num]['MÓDULO'] = $i->modulo;
                    $array[$num]['MENÚ'] = $i->menu;
                    $array[$num]['SUB MENÚ'] = $i->sub_menu;
                    $num++;
                }
                $persona = $this->getPersona($idUser);
                $response = $this->pdfRoles(['ESTATUS' => 'OK', 'DATA' => $array, 'PX_SIS_PERSONA' => $persona]);
                // return response()->json(array('success' => true, 'html'=>$response));

                return response()->json(['ESTATUS' => 'OK', 'DATA' => $response], 200);
            } else {

                //return response()->json(array('success' => false, 'html'=>$sql1));
                return response()->json($sql1, 200);
            }
        }
    }

    /**
     * obtener reporte en pdf de los roles del usuario
     * @param $array
     * @return string
     * @throws \Throwable
     */
    public function pdfRoles($array)
    {
        if (isset($array['ESTATUS']) && $array['ESTATUS'] == 'OK') {
            $info = $array['DATA'];
            $persona = $array['PX_SIS_PERSONA'];
            $view = view('Sistema.Pointex.Modulo.Administracion.pdfReporteRoles', get_defined_vars())->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            $base64 = base64_encode($pdf->stream('Reporte de roles.pdf'));
            if ($base64) {
                return $base64;
            } else {
                return '';
            }
        }
    }

    /**
     * obtener datos de persona en base al id de usuario
     * @param $idUser
     * @return mixed|string
     */
    public function getPersona($idUser)
    {
        $sql = DB::table('PX_SIS_Usuario as U')
            ->join('PX_SIS_Persona as P', 'P.Id', '=', 'U.IdPersona')
            ->leftJoin('PX_SIS_Persona_Contacto as PC', 'PC.IdPersona', '=', 'U.IdPersona')
            ->where('U.Id', $idUser)
            ->select(
                'P.Nombres',
                'P.Apellidos',
                'PC.Correo'
            )
            ->get();

        if ($sql && is_object($sql) && count($sql) > 0) {
            return $sql[0];
        } else {
            return '';
        }
    }

    /**
     * obtener los roles del usuario por id
     * @param $idUser
     * @return array
     */
    public function sqlRoles($idUser)
    {
        $sql = DB::table('PX_SIS_Roles_Usuario as RU')
            ->join('PX_SIS_Menu as M', 'M.Id', '=', 'RU.IdMenu')
            ->join('PX_SIS_Modulo as Md', 'Md.Id', '=', 'M.IdModulo')
            ->leftJoin('PX_SIS_Sub_Menu as SM', 'SM.Id', '=', 'RU.IdSubMenu')
            ->where('RU.IdUsuario', $idUser)
            ->where('RU.Estado', 'A')
            ->select(
                'RU.Id as rol_id',
                'RU.Estado as rol_estado',
                'M.Id as id_menu',
                'M.Nombre as menu',
                'SM.Nombre as sub_menu',
                'Md.Nombre as modulo'
            )
            ->orderBy('Md.Nombre')
            ->orderBy('M.Nombre')
            ->get();

        return $response = $this->validateResponse($sql);
    }

    /**
     * validar la consulta sql
     * @param $sql
     * @return array
     */
    public function validateResponse($sql)
    {
        if (isset($sql) && count($sql) > 0) {
            return $response = ['ESTATUS' => 'OK', 'DATA' => $sql];
        } elseif (isset($sql) && count($sql) > []) {
            return $response = ['ESTATUS' => 'ERROR', 'DATA' => 'SIN DATOS'];
        } else {
            return $response = ['ESTATUS' => 'ERROR', 'DATA' => 'ERROR AL REALIZAR CONSULTA'];
        }
    }

    private function getEntidadDeptoPuesto()
    {
        return PX_SIS_Departamento::from("PX_SIS_Departamento as d")
            ->rightjoin("PX_SIS_Entidad as e","d.IdEntidad","=","e.Id")
            ->leftjoin("PX_SIS_Puesto as p","p.IdDepartamento","=","d.Id")
            ->where("e.Tipo",1)
            ->select("e.Id",
                "e.Nombre as Entidad",
                "e.IdPais",
                "d.Id as IdDepto",
                "d.Nombre as Departamento",
                "d.IdEntidad",
                "p.Id as IdPuesto",
                "p.Nombre as Puesto",
                "p.IdDepartamento"
                )
            ->get();
    }
}
