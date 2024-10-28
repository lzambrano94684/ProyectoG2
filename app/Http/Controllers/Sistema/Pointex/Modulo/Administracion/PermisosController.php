<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 12/06/2020
 * Time: 01:56
 */

namespace App\Http\Controllers\Sistema\Pointex\Modulo\Administracion;


use App\Http\Controllers\BaseController;
use App\Modelos\CORE\PX_SIS_PERFIL;
use Illuminate\Http\Request;

class PermisosController extends BaseController
{
    public function index(Request $request)
    {
        $msg = session()->get("msg");
        $titleMsg = "Ingreso de Códigos";
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true, "DatePicker" => false];
        $request = $this->UrlToData($request);
        $vista ="";
        $modelPerfiles = PX_SIS_PERFIL::from("PX_SIS_PERFIL as p")
            ->select(
                "p.Id as PerfilId",
                "p.Nombre as PerfilNombre"
            )
            ->get();
        dd($modelPerfiles);
        return view("Sistema.Pointex.Modulo.Administracion.permisos",get_defined_vars());
    }
}