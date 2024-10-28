<?php

namespace App\Http\Controllers\Sistema\Pointex;

use App\Http\Controllers\BaseController;
use App\Modelos\CORE\PX_SIS_PAIS;
use App\Modelos\CORE\PX_SIS_PERSONA_CONTACTO;
use App\Modelos\CORE\PX_SIS_USUARIO;
use App\Modelos\VisitaMedica\MD_Fichero;
use App\Modelos\VisitaMedica\MD_Planificacion;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Modelos\Extencion\Tbl_Extenciones;
class TestController extends BaseController
{

    var $tipoCuenta;
    var $idUsuarioCreacion;
    var $infoTabla;

    public function __construct()
    {
        try {
            $this->infoTabla = [
                "cuentas" => [
                    "Titulo" => "Asignación de Cuentas Contables",
                    "tabla" => "PX_FIN_AsignacionCuenta",
                    "campo" => "IdCuenta"
                ]
            ];

            $this->idUsuarioCreacion = $this->getDataUserLogeado()->Id;
            $this->tipoCuenta = $this->TableUniversal("PX_FIN_TipoCuenta");
        } catch (\Exception $e) {

        }
    }

    public function index()
    {
        $titleMsg = "Inicio";
        return view("Sistema.Pointex.Modulo.Test.index", get_defined_vars());
    }

    public function citas(Request $request)
    {
        $conn = self::setConnection("Agenda");
        $usuarioLogueado = $this->idUsuarioCreacion;
        $request = $this->UrlToData($request);
        $msg = session()->get("msg");
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true, "DatePicker" => true, "Switch" => true];
        $titleMsg = "Planificación de Visitas";
        $request = $this->UrlToData($request);

        $planificacion = $conn->table("MD_Planificacion")->from("MD_Planificacion as pl")
            ->select(
                "pl.Id",
                DB::raw("CONCAT(f.NombreLargo, '-', f.Direccion) as title"),
                "pl.Fecha as start",
                "pl.Fecha as end",
                DB::raw("CASE WHEN pl.Fecha < CONVERT(DATE, GETDATE())  THEN 'gray' END as color"))
            ->join("MD_Fichero as f", "pl.IdFichero", "=", "f.Id")
            ->join("MD_Representante as r", "f.IdRepresentante", "=", "r.Id")
            ->where("f.Tipo", 1)
            ->take(100)
            ->get();
        $planificacionBase = base64_encode($planificacion);
        $dataFichero = $conn->table("MD_Fichero")->from("MD_Fichero as f")
            ->join("MD_Representante as re", "f.IdRepresentante", "=", "re.Id")
            ->select(
                "f.Id",
                DB::raw("CONCAT(f.NombreLargo, '-', f.Direccion) as NombreLargo")
            )
            ->take(100)
            ->where("f.Tipo", 1)
            ->get();
        $ficheroArray = $dataFichero->pluck("NombreLargo", "Id")->toArray();
        $cmbFichero = $this->SelectedUniversales(collect(["Fichero" => $ficheroArray]), null,
            false, [], true, false, false, false, false);
        $mensajeInfo = "";
        return view("Sistema.Pointex.Modulo.Test.citas", get_defined_vars());
    }

    public function guarda(Request $request)
    {
        $conn = self::setConnection("Agenda");
        $conn->insert("insert into MD_Planificacion (IdFichero,Fecha, Status) values ($request->cmbFichero, '$request->txtFecha', 1)");
        $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Datos almacenados correctamente"];
        session()->push('msg', $mensajeReturn);
        return redirect(url()->previous());
    }

    public function borrar($id)
    {
        $conn = self::setConnection("Agenda");
        $conn->delete("delete from MD_Planificacion where Id = $id");
        $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Datos eliminados correctamente"];
        session()->push('msg', $mensajeReturn);
        return redirect(url()->previous());
    }

    public function update($id, $status)
    {
        $conn = self::setConnection("Agenda");
        $conn->delete("update MD_Planificacion set Status = $status where Id = $id");
        $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Datos actualizados correctamente"];
        session()->push('msg', $mensajeReturn);
        return redirect(url()->previous());
    }
    public function despacho(Request $request)
    {
        $conn = self::setConnection("Agenda");
        $usuarioLogueado = $this->idUsuarioCreacion;
        $request = $this->UrlToData($request);
        $msg = session()->get("msg");
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true, "DatePicker" => true, "Switch" => true];
        $titleMsg = "Planificación de Visitas";
        $request = $this->UrlToData($request);

        $planificacion = $conn->table("MD_Planificacion")->from("MD_Planificacion as pl")
            ->select(
                "pl.Id",
                DB::raw("CONCAT(f.NombreLargo, '-', f.Direccion) as title"),
                "pl.Fecha as start",
                "pl.Status",
                DB::raw("CASE WHEN pl.Fecha < CONVERT(DATE, GETDATE())  THEN 'gray' END as color"))
            ->join("MD_Fichero as f", "pl.IdFichero", "=", "f.Id")
            ->join("MD_Representante as r", "f.IdRepresentante", "=", "r.Id")
            ->where("f.Tipo", 1)
            ->take(100)
            ->get();
        return view("Sistema.Pointex.Modulo.Test.despacho", get_defined_vars());
    }

    public static function setConnection($params)
    {
        config(['database.connections.onthefly' => [

            'driver' => 'sqlsrv',
            'host' => "SRVSQL",
            'port' => env('DB_PORT', '1433'),
            'database' => "Agenda",
            'username' => 'sa',
            'password' => '3xelt1$C@rd',
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ]]);

        return DB::connection('onthefly');
    }

}
