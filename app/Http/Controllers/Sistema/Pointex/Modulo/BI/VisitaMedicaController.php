<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 20/07/2020
 * Time: 23:48
 */

namespace App\Http\Controllers\Sistema\Pointex\Modulo\BI;


use App\Http\Controllers\BaseController;
use App\Http\Controllers\Sistema\Pointex\Modulo\Promotion\ReportesController;
use App\Imports\ImportSalesBon;
use App\Modelos\BI\PX_BI_ArchivoSupply;
use App\Modelos\BI\PX_BI_Factura;
use App\Modelos\BI\PX_BI_FacturaDetalle;
use App\Modelos\BI\PX_BI_FacturaDetalleB;
use App\Modelos\BI\PX_BI_FacturaEncabezado;
use App\Modelos\BI\PX_BI_FacturaEncabezadoB;
use App\Modelos\BI\PX_BI_InputsReporte;
use App\Modelos\BI\PX_BI_Ventas;
use App\Modelos\CORE\PX_SIS_Contacto;
use App\Modelos\CORE\PX_SIS_ENTIDAD;
use App\Modelos\CORE\PX_SIS_PAIS;
use App\Modelos\CORE\PX_SIS_PERSONA;
use App\Modelos\GestionProducto\PX_GP_Franquicia;
use App\Modelos\GestionProducto\PX_GP_Producto;
use App\Modelos\GestionProducto\PX_GP_ProductoCodigos;
use App\Modelos\SalesExpenses\PX_SEX_EncabezadoDoc;
use App\Modelos\VisitaMedica\MD_EntregaMM;
use App\Modelos\VisitaMedica\MD_Fichero;
use App\Modelos\VisitaMedica\MD_Menciones;
use App\Modelos\VisitaMedica\MD_Planificacion;
use App\Modelos\VisitaMedica\MD_ProductoLinea;
use App\Modelos\VisitaMedica\MD_ProductoPresentacion;
use App\Modelos\VisitaMedica\MD_Productos;
use App\Modelos\VisitaMedica\MD_Promocion;
use App\Modelos\VisitaMedica\MD_TiempoNP;
use App\Modelos\VisitaMedica\MD_Visita;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use phpDocumentor\Reflection\Types\False_;
use PhpParser\Node\Stmt\DeclareDeclare;


class VisitaMedicaController extends BaseController
{
    var $idUsuarioCreacion;
    var $infoUserLog;
    var $dataTable;
    var $version = 3;
    var $tblMsg = "";

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
        $dataPersona = $this->infoUserLog;
        $usuarioLogueado = $this->idUsuarioCreacion;
        $request = $this->UrlToData($request);
        $msg = session()->get("msg");
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true, "DatePicker" => true, "Switch" => true];
        $request = $this->UrlToData($request);
        $fecha = $request->txtFiltro ? $request->txtFiltro : date("Y-m-d");
        $titleMsg = "Fichero Visita Médica";
        $dataFichero = MD_Fichero::from("MD_Fichero as f")
            ->join("MD_Representante as re", "f.IdRepresentante", "=", "re.Id")
//            ->leftJoin("MD_Visita as v", "f.Id", "=", "v.IdFichero")
            ->join("MD_Planificacion as pl", "f.Id", "=", "pl.IdFichero")
            ->select(
                "f.Id",
                "f.Colegiado",
                "f.NombreLargo as Medico",
                "f.EspPromoRegilla",
                "f.Cat",
                "f.Frecuencia"
//                , DB::raw("CONVERT(date, v.FechaCreacion) as FechaVisita")
            )
            ->where("re.IdUsuario", $usuarioLogueado)
            ->where("pl.Fecha", $fecha)
            ->where("f.Tipo", 1)->groupBy(
                "f.Id",
                "f.Colegiado",
                "f.NombreLargo",
                "f.EspPromoRegilla",
                "f.Cat",
                "f.Frecuencia")
//                , "v.FechaCreacion")
            ->get();
        $mensajeInfo = $this->tblMsg;
        return view("Sistema.Pointex.Modulo.VisitaMedica.index", get_defined_vars());
    }

    public function TNP(Request $request)
    {

        $dataPersona = $this->infoUserLog;
        $usuarioLogueado = $this->idUsuarioCreacion;
        $request = $this->UrlToData($request);
        $msg = session()->get("msg");
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true, "DatePicker" => true, "Switch" => true];
        $request = $this->UrlToData($request);
        $titleMsg = "Tiempo No Promocionado";

        $FechaInicio = $request->txtFechaInicio ? $request->txtFechaInicio : date("Y-m-d");
        $FechaFin = $request->txtFechaFin ? $request->txtFechaFin : date("Y-m-d");

        $ConsultaPais = PX_SIS_Contacto::where("IdPersona", $this->infoUserLog->IdPersona)->first()->IdPais;

        $data = MD_TiempoNP::from("MD_TiempoNP as tnp")
            ->select("pl.Id", "rep.Representante", "tnp.Nombre as Tiempo", "pl.Estado", "pl.Fecha", "HoraInicio", "HoraFin", "Descripcion")
            ->join("MD_Planificacion as pl", "tnp.Id", "=", "pl.IdTiempoNP")
            ->join("PX_SIS_Usuario as us", "pl.UsuarioCreacion", "=", "us.Id")
            ->join("MD_Representante as rep", "us.Id", "=", "rep.IdUsuario")
            ->join("PX_SIS_Contacto as co", "us.IdPersona", "=", "co.IdPersona")
            ->where("tnp.DiaNoTrabajado", "Aplica")
            ->where(function ($query) use ($ConsultaPais) {
                if ($ConsultaPais <> 1) {
                    $query->where("co.IdPais", $ConsultaPais);
                }
            })
            ->whereBetween("pl.Fecha", [$FechaInicio, $FechaFin])
            ->get();

        $dataValidar = $data->whereNotIn("Estado", [1, 2]);
        $dataAprobado = $data->where("Estado", 1);
        $dataRechazado = $data->where("Estado", 2);


        $mensajeInfo = $this->tblMsg;
        return view("Sistema.Pointex.Modulo.VisitaMedica._subVistas._tnp", get_defined_vars());
    }

    function TNPAprobar($id, $status)
    {
        MD_Planificacion::find($id)->update(["Estado" => $status]);
        return redirect(url()->previous());
    }

    public function visita(Request $request)
    {
        $dataPersona = $this->infoUserLog;
        $usuarioLogueado = $this->idUsuarioCreacion;
        $request = $this->UrlToData($request);
        $msg = session()->get("msg");
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true, "DatePicker" => true, "Switch" => true];
        $titleMsg = "Visita Médica";
        $request = $this->UrlToData($request);
        $vista = "";
        if ($request->crear) {
            $crudo = explode("|", $request->crear);
            $medico = base64_decode($crudo[0]);
            $idFichero = $crudo[1];
            $vista = $this->frmInsertVisita(0, $dataPersona, $request->crear, $idFichero);
            if (!$vista) {
                $mensajeReturn = ["Tipo" => "info", "Descripcion" => "Visita ya ingresada"];
                session()->push('msg', $mensajeReturn);
                return redirect("/pointex/visita_medica/visita/fichero");
            }

        } elseif ($request->editar) {
            $crudo = explode("-", $request->editar);
            $id = $crudo[0];
            $medico1 = $crudo[1];
            $crudo2 = explode("|", base64_decode($medico1));
            $medico = base64_decode($crudo2[0]);
            $idFichero = $crudo2[1];
            $vista = $this->frmInsertVisita($id, $dataPersona, $medico, $idFichero);

        } else {
            $fecha = $request->txtFiltro ? $request->txtFiltro : date("Y-m-d");
            $vista = view("Sistema.Pointex.Modulo.VisitaMedica._subVistas._filtroFecha", get_defined_vars())->render();
            $vista .= $this->tblVisita($request, $dataPersona, $titleMsg, $fecha);
        }
        $mensajeInfo = $this->tblMsg;


        return view("Sistema.Pointex.Modulo.VisitaMedica.visita", get_defined_vars());
    }

    public function UpdateStatusVisita(Request $request)
    {
        try {
            $id = $request->input("id");
            $estado = $request->input("estado");
            return MD_Visita::where("Id", $id)->update(["Estado" => $estado]) ? "OK" : "Error";

//            $mensajeReturn = ["Tipo" => $tipo, "Descripcion" => "Datos almacenados correctamente"];
//            return $mensajeReturn;

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function tblVisita($request, $dataPersona, $titleMsg, $fecha)
    {
        $entregaMM = new MD_EntregaMM();
        $promocion = new MD_Promocion();

        $dataVisita = MD_Visita::from("MD_Visita as v")
            ->select("v.*", "f.NombreLargo", "f.Colegiado", "tv.Nombre as TipoVisita")
            ->join("MD_Fichero as f", "v.IdFichero", "=", "f.Id")
            ->leftJoin("MD_TipoVisita as tv", "v.IdTipoVisita", "=", "tv.Id")
            ->join("MD_Representante as re", "f.IdRepresentante", "=", "re.Id")
//            ->where("f.Version", $this->version)
            ->where("re.IdUsuario", $dataPersona->Id)
            ->where(DB::raw("CONVERT(date, v.FechaVisita)"), $fecha)
            ->where("f.Tipo", 1)
            ->get();
        return view("Sistema.Pointex.Modulo.VisitaMedica._subVistas._tblVisita", get_defined_vars());
    }

    public function frmInsertVisita($id, $dataPersona, $medico, $dFichero)
    {

        $dataFicheroHistorial = MD_Fichero::from("MD_Fichero as f")
            ->join("MD_Representante as re", "f.IdRepresentante", "=", "re.Id")
            ->leftJoin("MD_Visita as v", "f.Id", "=", "v.IdFichero")
            ->join("MD_Planificacion as pl", "f.Id", "=", "pl.IdFichero")
            ->select(
                "f.Id",
                "f.Colegiado",
                "f.NombreLargo as Medico",
                "f.EspPromoRegilla",
                "f.Cat",
                "f.Frecuencia"
                , DB::raw("CONVERT(date, v.FechaCreacion) as FechaVisita")
            )
            ->where("re.IdUsuario", $this->idUsuarioCreacion)
            ->where("f.Id", $dFichero)
            ->where("f.Tipo", 1)->groupBy(
                "f.Id",
                "f.Colegiado",
                "f.NombreLargo",
                "f.EspPromoRegilla",
                "f.Cat",
                "f.Frecuencia"
                , "v.FechaCreacion")
            ->orderBy("FechaVisita", "desc")
            ->get();


        $dataFichero = MD_Fichero::from("MD_Fichero as f")
            ->join("MD_Representante as re", "f.IdRepresentante", "=", "re.Id")
            ->select(
                "f.*", "re.IdLinea"
            )
            ->where("re.IdUsuario", $dataPersona->Id)
            ->where("f.Id", $dFichero)
            ->where("f.Tipo", 1)
//            ->where("f.Version", $this->version)
            ->first();
        $dataMenciones = MD_Menciones::from("MD_Menciones as f")
            ->join("MD_Representante as re", "f.IdRepresentante", "=", "re.Id")
            ->where("re.IdUsuario", $dataPersona->Id)
//            ->where("f.NombreLargo", $dataFichero->NombreLargo)
//            ->where("f.Version", $this->version)
            ->get();

        $tipoVisita = $this->TableUniversal("MD_TipoVisita");
        $titleMsg = "Visita a $dataFichero->NombreLargo";
        $modelVisita = $id ? MD_Visita::find($id) : new MD_Visita();

        $arrayAcomp = $this->TableUniversal("MD_Acompania");
        $cmbAcompania = $this->SelectedUniversales(collect(["Acompania" => $arrayAcomp]), $modelVisita->IdAcompa,
            false, [], false, false, false, false, false);
        if ($id) {
//            $arrayMM = $this->TableUniversal("MD_Muestras", ["IdLinea" => $dataFichero->IdLinea]);
//            $arrayMM = $this->TableUniversal("MD_ProductoPresentacion", ["IdEntidad" => $consultaEntidad,"Tipo" => "MM"]);
            $consultaEntidad = PX_SIS_PERSONA::find($this->infoUserLog->IdPersona)->IdEntidad;
            $arrayMM = MD_ProductoPresentacion::where("IdEntidad", $consultaEntidad)->where("Tipo", "MM")->get()->pluck("Presentacion", "Id");

            $arrayPrpductos = $this->TableUniversal("MD_Productos", ["Id" => $dataMenciones->pluck("IdProducto")->toArray()]);
            $arrayPrpductosLinea = MD_ProductoLinea::from("MD_ProductoLinea as pl")
                ->select("p.Id", "p.Nombre")
                ->join("MD_Productos as p", "pl.IdProducto", "=", "p.Id")
                ->where("pl.IdLinea", $dataFichero->IdLinea)
                ->pluck("Nombre", "Id")
                ->toArray();
            $arrayPrpductosLinea = MD_ProductoPresentacion::where("IdEntidad", $consultaEntidad)->where("Tipo", "PV")->get()->pluck("Presentacion", "Id");


            $entregaMM = MD_EntregaMM::where("IdVisita", $id)->get();
            $promocion = MD_Promocion::where("IdVisita", $id)->get();
            $cmbMM = $this->SelectedUniversales(collect(["MM" => $arrayMM]), null,
                false, [], true, false, false, false, false);

            $cmbPromocion = $this->SelectedUniversales(collect(["Promocion" => $arrayPrpductos]), null,
                false, [], false, false, false, false, false);
            $cmbPromocion2 = $this->SelectedUniversales(collect(["txtDescripcion" => $arrayPrpductosLinea]), null,
                false, [], false, false, false, false, false);
        }
        $consultaPlanificacion = MD_Planificacion::where("IdFichero", $dFichero)->where("UsuarioCreacion", $this->idUsuarioCreacion)->where("Fecha", date("Y-m-d"))->get();


        if (!$id) {
//            $sql = "
//select tbl.Id from (
//SELECT F.Id,CONCAT(F.EspPromoRegilla, ': ', F.NombreLargo, ' - ', F.Direccion)AS NombreLargo,F.Frecuencia,
//(select TOP(1) COUNT(MV.IdPais) from VW_MedicoVisitado AS MV where MV.Medico = f.NombreLargo GROUP BY MV.IdPais,MV.IdUsuario,MV.Medico,MV.Especialidad) as Visita
//FROM MD_Fichero AS F
//JOIN MD_Representante AS REP ON F.IdRepresentante = REP.Id
//join PX_SIS_Usuario as US ON REP.IdUsuario = US.Id
//WHERE  F.Activo = 1 AND REP.IdUsuario = $this->idUsuarioCreacion
//)as tbl where (tbl.Visita is null or tbl.Visita < Frecuencia)
//";
//            $valida = collect(DB::select($sql))->pluck('Id')->toArray();
//
//            if (in_array($dFichero, $valida)) {
                return view("Sistema.Pointex.Modulo.VisitaMedica._subVistas._frmInsert", get_defined_vars());
//            } else {
////                $mensajeReturn = ["Tipo" => "info", "Descripcion" => "Visita ya ingresada"];
////                session()->push('msg', $mensajeReturn);
////                return redirect("/pointex/visita_medica/visita/fichero");
//                return false;
//            }
        } else {
            return view("Sistema.Pointex.Modulo.VisitaMedica._subVistas._frmInsert", get_defined_vars());
        }


    }

    public function historialVisita($id)
    {
        $dataFichero = MD_Fichero::from("MD_Fichero as f")
            ->join("MD_Representante as re", "f.IdRepresentante", "=", "re.Id")
            ->leftJoin("MD_Visita as v", "f.Id", "=", "v.IdFichero")
            ->join("MD_Planificacion as pl", "f.Id", "=", "pl.IdFichero")
            ->select(
                "f.Id",
                "f.Colegiado",
                "f.NombreLargo as Medico",
                "f.EspPromoRegilla",
                "f.Cat",
                "f.Frecuencia"
                , DB::raw("CONVERT(date, v.FechaCreacion) as FechaVisita")
            )
            ->where("re.IdUsuario", $this->idUsuarioCreacion)
//            ->where("pl.Fecha", $fecha)
            ->where("f.Id", $id)
            ->where("f.Tipo", 1)->groupBy(
                "f.Id",
                "f.Colegiado",
                "f.NombreLargo",
                "f.EspPromoRegilla",
                "f.Cat",
                "f.Frecuencia"
                , "v.FechaCreacion")
            ->get();
        return view("Sistema.Pointex.Modulo.VisitaMedica._subVistas._historialVisita", get_defined_vars());
    }

    public function guardaVisita(Request $request)
    {
        $id = $request->input("txtIdVisita");
        $usuarioLogueado = $this->idUsuarioCreacion;
        $medico = $request->input("txtMedico");
        $arrayInsert = [
            "IdFichero" => $request->input("txtIdFichero"),
            "IdTipoVisita" => $request->input("tipovisita"),
            "Descripcion" => trim($request->input("txtDesc1")),
            "Descripcion2" => trim($request->input("txtDesc2")),
            "Latitude" => trim($request->input("txtLatitud")),
            "Longitud" => trim($request->input("txtLongitud")),
            "FechaVisita" => $request->input("txtFechaVisita"),
            "HoraInicio" => $request->input("HoraInicio"),
            "HoraFin" => $request->input("HoraFin"),
        ];
        if ($request->input("cmbAcompania")) {
            $arrayInsert["IdAcompa"] = trim($request->input("cmbAcompania"));
        }
        if ($id) {
            $arrayInsert["UsuarioModificacion"] = $usuarioLogueado;
        } else {
            $arrayInsert["UsuarioCreacion"] = $usuarioLogueado;
        }

        $id = $id ? MD_Visita::find($id)->update($arrayInsert) : MD_Visita::create($arrayInsert)->Id;
        return redirect("/pointex/visita_medica/visita?" . "crear=0&editar=$id-$medico");
    }

    public function guardaMM(Request $request)
    {
        try {
            $cantidad = trim($request->input("txtCantidad"));
            $idVisita = $request->input("txtIdVisita");
            $idMuestra = $request->input("cmbMM");
            if ($cantidad > 0) {
                $modelMMentrega = MD_EntregaMM::where("IdVisita", $idVisita)->where("IdMuestra", $idMuestra)->get();
                if ($modelMMentrega->count() > 0) {
                    MD_EntregaMM::where("IdVisita", $idVisita)->where("IdMuestra", $idMuestra)->update(["Cantidad" => $cantidad]);
                } else {
                    $arrayInsert = [
                        "IdVisita" => $idVisita,
                        "IdMuestra" => $idMuestra,
                        "Cantidad" => $cantidad,
                        "UsuarioCreacion" => $this->idUsuarioCreacion
                    ];
                    MD_EntregaMM::insert($arrayInsert);
                }
                $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Datos almacenados correctamente"];
            } else {
                MD_EntregaMM::where("IdVisita", $idVisita)->where("IdMuestra", $idMuestra)->delete();
                $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Datos almacenados correctamente"];
            }
            return $mensajeReturn;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        /* session()->push('msg', $mensajeReturn);
         return redirect(url()->previous());*/
    }

    public function guardaPromo(Request $request)
    {
        $promociono = trim($request->input("txtPromociono"));
        $idVisita = $request->input("txtIdVisita");
        $idProducto = $request->input("cmbtxtDescripcion");

        if ($promociono) {

            $arrayInsert = [
                "IdVisita" => $idVisita,
//            "IdProducto" => $request->input("cmbPromocion"),
                "IdProducto" => $idProducto,
                "Descripcion" => $idProducto,
                "UsuarioCreacion" => $this->idUsuarioCreacion
            ];
            MD_Promocion::insert($arrayInsert);
        } else {
            MD_Promocion::where("IdVisita", $idVisita)
                ->where("IdProducto", $idProducto)
                ->delete();
        }

        $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Datos almacenados correctamente"];
        return $mensajeReturn;
        /*session()->push('msg', $mensajeReturn);
        return redirect(url()->previous());*/
    }

    public function borraVisita($id)
    {
        MD_Visita::find($id)->delete();
        $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Datos eliminados correctamente"];
        session()->push('msg', $mensajeReturn);
        return redirect(url()->previous());
    }

    public function borraPlani($id)
    {
        MD_Planificacion::find($id)->delete();
        $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Datos eliminados correctamente"];
        session()->push('msg', $mensajeReturn);
        return redirect(url()->previous());
    }

    public function borraEmm($id)
    {
        MD_EntregaMM::find($id)->delete();
        $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Datos eliminados correctamente"];
        session()->push('msg', $mensajeReturn);
        return redirect(url()->previous());
    }

    public function borraPromo($id)
    {
        MD_Promocion::find($id)->delete();
        $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Datos eliminados correctamente"];
        session()->push('msg', $mensajeReturn);
        return redirect(url()->previous());
    }

    public function irVisita($idPlanifiacion){
        $consultaPlanificacion = MD_Planificacion::WHERE("Id",$idPlanifiacion)->first();
        $consultaFichero = MD_Fichero::WHERE("Id",$consultaPlanificacion->IdFichero)->first();
        $consulaVisita = MD_Visita::where("IdFichero",$consultaPlanificacion->IdFichero)->where("FechaVisita",$consultaPlanificacion->Fecha)->first();
        if ($consulaVisita){
            $url = "/pointex/visita_medica/visita?crear=0&editar=".$consulaVisita->Id."-".base64_encode($consultaFichero->NombreLargo."|".$consulaVisita->IdFichero);
        } else{
            $url = "/pointex/visita_medica/visita?crear=".base64_encode($consultaFichero->NombreLargo)."|".$consultaPlanificacion->IdFichero;
        }

        return redirect($url);
    }

    public function planificacion(Request $request)
    {
        $dataPersona = $this->infoUserLog;
        $usuarioLogueado = $this->idUsuarioCreacion;
        $request = $this->UrlToData($request);
        $msg = session()->get("msg");
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true, "DatePicker" => true, "Switch" => true];
        $titleMsg = "Planificación de Visitas";
        $request = $this->UrlToData($request);

        $planificacion = MD_Planificacion::from("MD_Planificacion as pl")
            ->select(
                "v.Id as IdVisita",
                "pl.Id",
                "pl.HoraInicio",
                "pl.HoraFin",
                DB::raw("(CASE WHEN pl.Descripcion IS NULL THEN '- - -' ELSE pl.Descripcion END) as Descripcion"),
                "np.Nombre as tipo",
                "np.Icono as Icono",
                DB::raw("(CASE WHEN np.Id = 1 or np.Id = 20 THEN CONCAT(pl.OrdenVisita,'.',pl.Horario,'-', f.NombreLargo) ELSE CONCAT(DATEPART(HOUR, pl.HoraInicio),':',DATEPART(MINUTE, pl.HoraInicio),' a ',DATEPART(HOUR, pl.HoraFin),':',DATEPART(MINUTE, pl.HoraFin),'-', np.Nombre)END)as title"),
                DB::raw("(CASE WHEN np.Id = 1 or np.Id = 20 THEN CONCAT(pl.OrdenVisita,'.',pl.Horario,' ',np.Nombre,'-',f.EspPromoRegilla, ': ', f.NombreLargo, ' - ', f.Direccion)ELSE CONCAT(DATEPART(HOUR, pl.HoraInicio),':',DATEPART(MINUTE, pl.HoraInicio),' a ',DATEPART(HOUR, pl.HoraFin),':',DATEPART(MINUTE, pl.HoraFin),' ',np.Nombre,'-',f.EspPromoRegilla, ': ', f.NombreLargo, ' - ', f.Direccion)END) as titleMSG"),
                DB::raw("(CASE WHEN np.Id = 1 or np.Id = 20 THEN f.NombreLargo ELSE f.NombreLargo END) as Medico"),
                DB::raw("(CASE WHEN np.Id = 1 or np.Id = 20 THEN f.Direccion ELSE f.Direccion END) as Direccion"),
                DB::raw("(CASE WHEN np.Id = 1 or np.Id = 20 THEN f.EspPromoRegilla ELSE f.EspPromoRegilla END) as EspPromoRegilla"),
                DB::raw("(CASE WHEN np.Id = 1 or np.Id = 20 THEN f.EspecialidadPrimaria ELSE f.EspecialidadPrimaria END) as EspecialidadPrimaria"),
                "pl.Fecha as start","pl.Fecha as end",
DB::raw("CASE WHEN pl.Fecha < CONVERT(DATE, GETDATE()) and v.Id is null and np.Nombre = 'Visita Medica/Farmacia' THEN '#C60A0A'
                    WHEN v.Id is not null and v.Estado = 1 THEN '#1AA930'
                    WHEN v.Id is not null and (v.Estado = 0 or v.Estado is null ) THEN '#C60A0A'
                    WHEN np.Nombre <> 'Visita Medica/Farmacia' THEN '#095CA5'
                    else '#E86607' END as color")
            )
            ->leftjoin("MD_Fichero as f", "pl.IdFichero", "=", "f.Id")
            ->leftjoin("MD_Representante as r", "f.IdRepresentante", "=", "r.Id")
            ->leftjoin("MD_TiempoNP as np", "pl.IdTiempoNP", "=", "np.Id")
            ->leftJoin('MD_Visita as v', function ($join) {
                $join->on("pl.IdFichero", "=", "v.IdFichero")->where("pl.Fecha", "=", DB::raw("CONVERT(DATE, v.FechaVisita)"));
            })
            ->where("pl.UsuarioCreacion", $usuarioLogueado)
            ->orderBy("pl.HoraInicio", "asc")
            ->get();


        $planificacionBase = base64_encode($planificacion);

        $dataFichero = MD_Fichero::from("MD_Fichero as f")
            ->join("MD_Representante as re", "f.IdRepresentante", "=", "re.Id")
            ->select(
                "f.Id",
                DB::raw("CONCAT(f.EspPromoRegilla, ': ', f.NombreLargo, ' - ', f.Direccion) as NombreLargo")
            )
            ->where("re.IdUsuario", $usuarioLogueado)
            ->where("f.Tipo", 1)
            ->get();
        $ficheroArray = $dataFichero->pluck("NombreLargo", "Id")->toArray();
        $cmbFichero = $this->SelectedUniversales(collect(["Fichero" => $ficheroArray]), null,
            false, [], false, false, false, false, false);

        $tiempoNPArray = MD_TiempoNP::select("Id", "Nombre")->orderBy("Id", "asc")->get()->pluck("Nombre", "Id")->toArray();
        $cmbTiempoNP = $this->SelectedUniversales(collect(["TiempoNP" => $tiempoNPArray]), null,
            false, [], true, false, false, false, false);
        $mensajeInfo = $this->tblMsg;
        return view("Sistema.Pointex.Modulo.VisitaMedica.calendario", get_defined_vars());
    }

    public function planificacionFichero(Request $request)
    {
        $dataPersona = $this->infoUserLog;
        $usuarioLogueado = $this->idUsuarioCreacion;
        $request = $this->UrlToData($request);
        $msg = session()->get("msg");
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true, "DatePicker" => true, "Switch" => true];
        $titleMsg = "Planificación de Visitas";
        $request = $this->UrlToData($request);

        $sql = "SET NOCOUNT ON; exec [Planificado] '$usuarioLogueado'";
        $dataFichero = collect(DB::select($sql));
        $mensajeInfo = $this->tblMsg;
        return view("Sistema.Pointex.Modulo.VisitaMedica._subVistas._planificacionFichero", get_defined_vars());
    }

    public function PlanificacionAsignacion(Request $request)
    {
        if ($request->ajax()) {
            $varReturn["STATUS"] = "OK";
            try {

                $id = $request->input("Id");
                    $varReturn["DATA"] = MD_Fichero::from("MD_Fichero as f")
                        ->join("MD_Representante as re", "f.IdRepresentante", "=", "re.Id")
                        ->select(
                            "f.Id",
                            "f.NombreLargo",
                            "f.Direccion",
                            "f.Frecuencia",
                            "f.Cat",
                            DB::raw("CONCAT(f.EspPromoRegilla, ' - ', f.EspecialidadPrimaria) as Esp")

                        )->whereIn("f.Id", $id)
                        ->where("f.Activo", 1)
                        ->get();

            } catch (\Exception $e) {
                $varReturn["STATUS"] = "ERROR";
                $varReturn["DATA"] = $e->getMessage();
            }
            return response()->json($varReturn);
        } else {
            abort(404);
        }
    }
    public function PlanificacionAsignacionSave(Request $request)
    {
        if ($request->ajax()) {
            $varReturn["STATUS"] = "OK";
            try {

                $save = MD_Planificacion::insert([
                    "IdFichero" => $request->input("Id"),
                    "IdTiempoNP" => 1,
                    "Tipo" => 1,
                    "Fecha" => $request->input("fecha"),
                    "Horario" =>$request->input("horario"),
                    "OrdenVisita" =>$request->input("orden"),
                    "Descripcion" =>$request->input("comentario"),
                    "UsuarioCreacion" =>$this->idUsuarioCreacion,
                ]);



            } catch (\Exception $e) {
                $varReturn["STATUS"] = "ERROR";
                $varReturn["DATA"] = $e->getMessage();
            }
            return response()->json($varReturn);
        } else {
            abort(404);
        }
    }



    public function GetFichero($id)
    {
        if ($id == 1) {
//            return MD_Fichero::from("MD_Fichero as f")
//                ->join("MD_Representante as re", "f.IdRepresentante", "=", "re.Id")
//                ->select(
//                    "f.Id",
//                    DB::raw("CONCAT(f.EspPromoRegilla, ': ', f.NombreLargo, ' - ', f.Direccion) as NombreLargo")
//                )
//                ->where("re.IdUsuario", $this->idUsuarioCreacion)
//                ->where("f.Tipo", 1)
//                ->where("f.Activo", 1)
//                ->get();

            $sql = "
select tbl.Id,tbl.NombreLargo from (
SELECT F.Id,CONCAT(F.EspPromoRegilla, ': ', F.NombreLargo, ' - ', F.Direccion)AS NombreLargo,F.Frecuencia,
(select top(1) COUNT(MV.IdPais) from VW_MedicoVisitado AS MV where MV.Medico = f.NombreLargo GROUP BY MV.IdPais,MV.IdUsuario,MV.Medico,MV.Especialidad) as Visita
,(
select count(p.NombreLargo)
from VW_PlanificacionSC as p
join MD_Dias as d on p.IdCiclo = d.Id
where d.CicloActual = 'Activo'and p.Usuario = US.Usuario AND F.NombreLargo = P.NombreLargo
group by p.Usuario,p.NombreLargo
)as Planificacion
FROM MD_Fichero AS F
JOIN MD_Representante AS REP ON F.IdRepresentante = REP.Id
join PX_SIS_Usuario as US ON REP.IdUsuario = US.Id
WHERE F.Tipo = 1 AND F.Activo = 1 AND REP.IdUsuario = $this->idUsuarioCreacion
)as tbl where (tbl.Visita is null or tbl.Visita < Frecuencia) AND (tbl.Planificacion is null or tbl.Planificacion< Frecuencia)
";
            return collect(DB::select($sql))->toArray();
            return DB::select($sql);


        } else if ($id == 20) {
//            return MD_Fichero::from("MD_Fichero as f")
//                ->join("MD_Representante as re", "f.IdRepresentante", "=", "re.Id")
//                ->select(
//                    "f.Id",
//                    DB::raw("CONCAT(f.NombreLargo, '-', f.Direccion) as NombreLargo")
//                )
//                ->where("re.IdUsuario", $this->idUsuarioCreacion)
//                ->where("f.Tipo", 2)
//                ->where("f.Activo", 1)
//                ->get();

            $sql = "
select tbl.Id,tbl.NombreLargo from (
SELECT F.Id,CONCAT(F.EspPromoRegilla, ': ', F.NombreLargo, ' - ', F.Direccion)AS NombreLargo,F.Frecuencia,
(select COUNT(MV.IdPais) from VW_MedicoVisitado AS MV where MV.Medico = f.NombreLargo GROUP BY MV.IdPais,MV.IdUsuario,MV.Medico,MV.Especialidad) as Visita
,(
select count(p.NombreLargo)
from VW_PlanificacionSC as p
join MD_Dias as d on p.IdCiclo = d.Id
where d.CicloActual = 'Activo'and p.Usuario = US.Usuario AND F.NombreLargo = P.NombreLargo
group by p.Usuario,p.NombreLargo
)as Planificacion
FROM MD_Fichero AS F
JOIN MD_Representante AS REP ON F.IdRepresentante = REP.Id
join PX_SIS_Usuario as US ON REP.IdUsuario = US.Id
WHERE F.Tipo = 2 AND F.Activo = 1 AND REP.IdUsuario = $this->idUsuarioCreacion
)as tbl where (tbl.Visita is null or tbl.Visita < Frecuencia) AND (tbl.Planificacion is null or tbl.Planificacion< Frecuencia)
";
            return collect(DB::select($sql));
        } else {
            return null;
        }


    }

    public function guardaPlanificacion(Request $request)
    {

        if ($request->cmbTiempoNP == 1 || $request->cmbTiempoNP == 20) {
            $consulta = MD_Planificacion::where("IdFichero", $request->cmbFichero)->where("Fecha", $request->txtFecha)
                ->where("UsuarioCreacion", $this->idUsuarioCreacion)->where("Tipo", "<>", 3)->where("OrdenVisita", $request->Ordenvisita)
                ->where("Horario", $request->cmbHorario)->first();
            $consultaHorario = MD_Planificacion::where("Fecha", $request->txtFecha)
                ->where("UsuarioCreacion", $this->idUsuarioCreacion)->where("Tipo", "<>", 3)->where("OrdenVisita", $request->Ordenvisita)->first();

            if ($consulta || $consultaHorario) {
                $mensajeReturn = ["Tipo" => "error", "Descripcion" => "El horario asignado no esta disponible ya fue asignado en otra planificacion"];
            } else {

                if ($request->cmbTiempoNP == 1) {
                    $tipo = 1;
                } else if ($request->cmbTiempoNP == 20) {
                    $tipo = 2;
                } else {
                    $tipo = 3;
                }

                $arrayInsert = [
                    "IdFichero" => $request->cmbFichero,
                    "Fecha" => $request->txtFecha,
                    "IdTiempoNP" => $request->cmbTiempoNP,
                    "Descripcion" => $request->desc,
                    "Tipo" => $tipo,
                    "Horario" => $request->cmbHorario,
                    "Ordenvisita" => $request->Ordenvisita,
                    "UsuarioCreacion" => $this->idUsuarioCreacion
                ];
                MD_Planificacion::insert($arrayInsert);
                $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Datos almacenados correctamente"];
            }
        } else {
            $consulta = MD_Planificacion::where("IdFichero", $request->cmbFichero)->where("Fecha", $request->txtFecha)->where("UsuarioCreacion", $this->idUsuarioCreacion)->where("Tipo", "<>", 3)->first();
            $horaInicio = $request->HoraInicio;
            $horaFin = $request->HoraFin;

            if (isset($horaInicio)) {
                $consultaHorario = MD_Planificacion::where("Fecha", $request->txtFecha)->where("UsuarioCreacion", $this->idUsuarioCreacion)
                    ->where(function ($query) use ($horaInicio, $horaFin) {
                        $query->where("HoraInicio", "<=", $horaInicio)->where("HoraFin", ">=", $horaFin)
                            ->orwhere("HoraInicio", "<=", $horaInicio)->where("HoraFin", ">=", $horaInicio)
                            ->orwhereBetween("HoraInicio", [$horaInicio, $horaFin]);
                    })->first();
            } else {
                $consultaHorario = false;
            }


            if ($consulta || $consultaHorario) {
                $mensajeReturn = ["Tipo" => "error", "Descripcion" => "El horario asignado no esta disponible ya fue asignado en otra planificacion"];
            } else {
                if ($request->cmbTiempoNP == 1) {
                    $tipo = 1;
                } else if ($request->cmbTiempoNP == 20) {
                    $tipo = 2;
                } else {
                    $tipo = 3;
                }

                $arrayInsert = [
                    "IdFichero" => $request->cmbFichero,
                    "Fecha" => $request->txtFecha,
                    "IdTiempoNP" => $request->cmbTiempoNP,
                    "HoraInicio" => $request->HoraInicio,
                    "HoraFin" => $request->HoraFin,
                    "Descripcion" => $request->desc,
                    "Tipo" => $tipo,
                    "UsuarioCreacion" => $this->idUsuarioCreacion
                ];
                MD_Planificacion::insert($arrayInsert);
                $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Datos almacenados correctamente"];
            }
        }

        session()->push('msg', $mensajeReturn);
        return redirect(url()->previous());
    }
}
