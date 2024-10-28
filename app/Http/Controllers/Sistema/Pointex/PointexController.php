<?php

namespace App\Http\Controllers\Sistema\Pointex;

use App\Http\Controllers\BaseController;
use App\Modelos\CORE\PX_SIS_PAIS;
use App\Modelos\CORE\PX_SIS_PERSONA_CONTACTO;
use App\Modelos\CORE\PX_SIS_USUARIO;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Modelos\Extencion\Tbl_Extenciones;
class PointexController extends BaseController
{
    /**
     * mostrar la pantalla de inicio del sistema
     * @param Request $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showInicio(Request $data)
    {
        $administrador=0;
        $titleMsg = "Ingreso de Códigos";
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true, "DatePicker" => false];
        $msg = (isset($data->mensaje) && $data->mensaje != "") ? ["Tipo" => "error", "Descripcion" => $data->mensaje] : Session::get("msg");
        return view("Sistema.Pointex.inicio", get_defined_vars());

    }
    /**
     * mostrar la pantalla de perfil del usuario
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPerfil()
    {
        $libs2Load = ["Select2" => true, "SweetAlert" => true];
        $msg = Session::get("msg");
        $titleMsg = "Perfil de Usuario";
        $usuario = Session::get("Accesos");

        $paises = json_decode(PX_SIS_PAIS::all());


        //dd($usuario);

        return view("Sistema.Pointex.perfil", get_defined_vars());
    }

    /**
     * modificar clave del usuario desde el perfil de usuario
     * @param Request $data
     * @return array
     */
    public function modClaveUsuario(Request $data)
    {
        $usuario = json_decode(PX_SIS_USUARIO::where("Id", $data->IdUsuario)->where("Clave", md5($data->ClaveVieja))->get());

        if (isset($usuario) && count($usuario) > 0) {
            DB::beginTransaction();

            try {
                $modUsuario = PX_SIS_USUARIO::find($data->IdUsuario);
                $modUsuario->Clave = md5($data->ClaveNueva);
                $modUsuario = $modUsuario->save();
                DB::commit();
            } catch (QueryException $ex) {
                DB::rollback();
                Log::error("Error al modificar la clave del PX_SIS_USUARIO: " . $ex->getMessage());
            }

            if (isset($modUsuario) && $modUsuario) {
                return ["RESPUESTA" => "OK", "DESCRIPCION" => "Clave modificada correctamente"];
            } else {
                return ["RESPUESTA" => "NO", "DESCRIPCION" => "No fue posible modificar la clave de usuario"];
            }
        } else {
            return ["RESPUESTA" => "NO", "DESCRIPCION" => "Clave anterior incorrecta"];
        }

    }

    /**
     * modificación de datos de persona desde el perfil
     * @param Request $data
     * @return array
     */
    public function modPerfilUsuario(Request $data)
    {

        $usuario = PX_SIS_USUARIO::where("Id", $data->IdUsuario)->get();
        $usuario = json_decode($usuario);

        //dd($usuario[0]->IdPersona,$data->all());
        if (isset($usuario) && count($usuario) > 0) {
            DB::beginTransaction();

            try {
                $modPersona = PX_SIS_PERSONA_CONTACTO::where("IdPersona", $usuario[0]->IdPersona)
                    ->update([
                        "Direccion" => $data->Direccion,
                        "Correo" => $data->Correo,
                        "Telefono" => $data->Telefono,
                        "IdPais" => $data->IdPais
                    ]);
                DB::commit();

            } catch (QueryException $ex) {
                DB::rollback();
                Log::error("Error al modificar los datos de contacto de persona: " . $ex->getMessage());
            }

            //dd($modPersona);
            if (isset($modPersona) && $modPersona) {
                return ["RESPUESTA" => "OK", "DESCRIPCION" => "Datos de usuario modificados correctamente"];
            } else {
                return ["RESPUESTA" => "NO", "DESCRIPCION" => "No fue posible modificar los datos de usuario"];
            }
        } else {
            return ["RESPUESTA" => "NO", "DESCRIPCION" => "No fue posible ubicar al usuario que desea modificar"];
        }

    }

    /**
     * mostrar el manual de usuario
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAyuda()
    {
        $msg = Session::get("msg");
        return view("Sistema.Pointex.ayuda", get_defined_vars());
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\Response
     */
    public function GetArchivo(Request $request)
    {
        $ruta = $request->ruta;
        $extension = pathinfo(storage_path($ruta), PATHINFO_EXTENSION);
        try {
            return Response::make(Storage::get($ruta), 200, [
                'Content-Type' => "application/$extension",
                'Pragma' => 'no-cache',
                'Content-Disposition' => 'inline; filename="' . $ruta . '"'
            ]);
        } catch (\Exception $e) {
            return [
                "code" => $e->getCode(),
                "message" => $e->getMessage()
            ];
        }

    }

    /**
     * iniciar para ver el archivo en storage
     * @param Request $request
     * @return false|string
     */
    public function InitVerArchivo(Request $request)
    {
        $nom64 = $request->ruta;
        $nombre = base64_decode($nom64);

        $extensiones = array("pdf");
        $data = $this->ValidaExtension($extensiones, $nombre);

        $fileSize = Storage::size($nombre);

        if ($data['ESTADO'] == 'OK') {

            $variable = '<iframe id="iframepdf" src="' . url("/pointex/getArchivo?ruta=" . $nombre) . '#toolbar=0&navpanes=0&scrollbar=0#view=fit" style="width:100%; height: 500px;" type="application/pdf"></iframe>';
            #$variable = '<iframe id="iframepdf" src="' . url("/directorio/documentos/getArchivo?ruta=" . $nombre) . '" style="width:100%; min-height:500px; pointer-events:none;" type="application/pdf"></iframe>';
            $tipo = 'PDF';
        } else {
            $variable = '<img src="' . url("/pointex/getArchivo?ruta=" . $nombre) . '" id="imgCropp" alt="Papeleria" style="max-width:100%; max-height: 500px; background: white;">';
            $tipo = 'IMG';
        }

        return json_encode(['FRAME' => $variable, 'TIPO' => $tipo, 'SIZE' => $fileSize]);
    }

}
