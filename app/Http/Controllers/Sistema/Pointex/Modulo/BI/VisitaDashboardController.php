<?php

namespace App\Http\Controllers\Sistema\Pointex\Modulo\BI;

use App\Http\Controllers\BaseController;
use App\Modelos\CORE\PX_SIS_Contacto;
use App\Modelos\CORE\PX_SIS_PAIS;
use App\Modelos\Finanzas\PX_SIS_Usuario;
use App\Modelos\HTML\PX_HTML_Color;
use App\Modelos\VisitaMedica\MD_Dias;
use App\Modelos\VisitaMedica\MD_ReportePowerBI;
use App\Modelos\VisitaMedica\MD_Representante;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class VisitaDashboardController extends BaseController
{
    var $idUsuarioCreacion;
    var $infoUserLog;

    public function __construct()
    {
        try {
            $this->infoUserLog = $this->getDataUserLogeado();
            $this->idUsuarioCreacion = $this->infoUserLog->Id;
            $this->tblMsg = $this->tblMsg();
        } catch (\Exception $e) {

        }
    }

    public function index(Request $request)
    {
        $msg = Session::get("msg");
        $request = $this->UrlToData($request);
        $titleMsg = "Asignación del Panel Médico";
        $vista = "";
        $libs2Load = ["DataTables" => true, "SweetAlert" => true, "Select2" => true];

        $consultaPuesto = PX_SIS_Usuario::where("Id",$this->idUsuarioCreacion)->first()->IdPuesto;
        $consultaRep ="";
        $IdUs =0;
        $consultaIdPais = PX_SIS_Contacto::select("IdPais")->where("IdPersona",$this->getDataUserLogeado()->IdPersona)->first()->IdPais;
        $consultaNombrePais = PX_SIS_PAIS::select("Nombre")->where("Id",$consultaIdPais)->first()->Nombre;
        if ($consultaPuesto == 2){
            $consultaRep = MD_Representante::where("IdUsuario",$this->idUsuarioCreacion)->first()->Representante;
            $IdUs = $this->idUsuarioCreacion;

            $TotalMedicos = MD_Representante::from("MD_Representante as rep")
                ->join("MD_Fichero as f", "rep.Id", "=", "f.IdRepresentante")
                ->where("f.Activo", 1)
                ->where("rep.IdUsuario", $this->idUsuarioCreacion)
                ->count();

            $fichero = MD_Representante::from("MD_Representante as rep")
                ->join("MD_Fichero as f", "rep.Id", "=", "f.IdRepresentante")
                ->select("f.NombreLargo as Medico","f.EspecialidadPrimaria as Especialidad","f.Direccion")
                ->where("f.Activo", 1)
                ->where("rep.IdUsuario", $this->idUsuarioCreacion)
                ->count();

            $sql = "select COUNT(f.EspecialidadPrimaria) as Cant,f.EspecialidadPrimaria as Especialidad
                from MD_Representante as rep
                left join MD_Fichero as f on rep.Id = f.IdRepresentante
                where f.Activo = 1 and rep.IdUsuario = $this->idUsuarioCreacion
                group by f.EspecialidadPrimaria";

            $chartEspecialidad = collect(DB::select($sql));

            $colorPie = PX_HTML_Color::select("Codigo")
                ->take($chartEspecialidad->count())
                ->get();

            $datoCiclo = MD_Dias::where("IdPais",$consultaIdPais)->where("CicloActual","Activo")->first();
            $sqlCobertura = "select * from [dbo].[Fun_Cobertura]($consultaIdPais,$this->idUsuarioCreacion,$datoCiclo->Id)";
            $coberturaCiclo = collect(DB::select($sqlCobertura));

            $params = ['ds0.prm_id_usuario' => 8];
            $paramsAsString = json_encode($params);
            $encode = urlencode($paramsAsString);
            //dd($encode);

        }

        return view("Sistema.Pointex.Modulo.VisitaDashboard.index", get_defined_vars());
    }
    public function indexPowerBI(Request $request)
    {

        $msg = Session::get("msg");
        $request = $this->UrlToData($request);
        $titleMsg = "Asignación del Panel Médico";
        $vista = "";
        $libs2Load = ["DataTables" => true, "SweetAlert" => true, "Select2" => true];

        $sql = "select Descripcion,Descripcion2,FechaVisita,HoraInicio,HoraFin,Estado from MD_Visita";
        $data = DB::select($sql);

        return view("Sistema.Pointex.Modulo.VisitaDashboard.PowerBi.index", get_defined_vars());
    }

}
