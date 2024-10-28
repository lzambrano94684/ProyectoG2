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
use App\Modelos\CORE\PX_SIS_ENTIDAD;
use App\Modelos\CORE\PX_SIS_PAIS;
use App\Modelos\GestionProducto\PX_GP_Franquicia;
use App\Modelos\GestionProducto\PX_GP_Producto;
use App\Modelos\GestionProducto\PX_GP_ProductoCodigos;
use App\Modelos\SalesExpenses\PX_SEX_EncabezadoDoc;
use App\Modelos\VisitaMedica\MD_EntregaMM;
use App\Modelos\VisitaMedica\MD_Fichero;
use App\Modelos\VisitaMedica\MD_Menciones;
use App\Modelos\VisitaMedica\MD_Planificacion;
use App\Modelos\VisitaMedica\MD_ProductoLinea;
use App\Modelos\VisitaMedica\MD_Productos;
use App\Modelos\VisitaMedica\MD_Promocion;
use App\Modelos\VisitaMedica\MD_TiempoNP;
use App\Modelos\VisitaMedica\MD_Visita;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class VisitaFarmaciaController extends BaseController
{
    var $idUsuarioCreacion;
    var $infoUserLog;
    var $dataTable;
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
        $titleMsg = "Fichero Visita Farmacia";
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
                "f.Frecuencia",
                DB::raw("CONVERT(date, v.FechaCreacion) as FechaVisita")
            )
            ->where("re.IdUsuario", $usuarioLogueado)
            ->where("pl.Fecha", $fecha)
            ->where("f.Tipo", 2)
            ->get();
        $mensajeInfo = $this->tblMsg;
        return view("Sistema.Pointex.Modulo.VisitaFarmacia.index", get_defined_vars());
    }

    public function visita(Request $request)
    {
        $dataPersona = $this->infoUserLog;
        $usuarioLogueado = $this->idUsuarioCreacion;
        $request = $this->UrlToData($request);
        $msg = session()->get("msg");
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true, "DatePicker" => true, "Switch" => true];
        $titleMsg = "Visita Farmacia";
        $request = $this->UrlToData($request);
        $vista = "";
        if ($request->crear) {
            $crudo = explode("|", $request->crear);
            $medico = base64_decode($crudo[0]);
            $idFichero = $crudo[1];
            $vista = $this->frmInsertVisita(0, $dataPersona, $request->crear, $idFichero);

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
            $vista = view("Sistema.Pointex.Modulo.VisitaFarmacia._subVistas._filtroFecha", get_defined_vars())->render();
            $vista .= $this->tblVisita($request, $dataPersona, $titleMsg, $fecha);
        }
        $mensajeInfo = $this->tblMsg;
        return view("Sistema.Pointex.Modulo.VisitaFarmacia.visita", get_defined_vars());
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
            ->where("re.IdUsuario", $dataPersona->Id)
//            ->where(DB::raw("CONVERT(date, v.FechaCreacion)"), $fecha)
            ->where(DB::raw("CONVERT(date, v.FechaVisita)"), $fecha)
            ->where("f.Tipo", 2)
            ->get();
        return view("Sistema.Pointex.Modulo.VisitaFarmacia._subVistas._tblVisita", get_defined_vars());
    }

    public function frmInsertVisita($id, $dataPersona, $medico, $dFichero)
    {
        $dataMenciones = MD_Menciones::from("MD_Menciones as f")
            ->join("MD_Representante as re", "f.IdRepresentante", "=", "re.Id")
            ->where("re.IdUsuario", $dataPersona->Id)
            ->where("f.Id", $dFichero)
            ->get();

        $dataFichero = MD_Fichero::from("MD_Fichero as f")
            ->join("MD_Representante as re", "f.IdRepresentante", "=", "re.Id")
            ->select(
                "f.*", "re.IdLinea"
            )
            ->where("re.IdUsuario", $dataPersona->Id)
            ->where("f.Id", $dFichero)
            ->where("f.Tipo", 2)
            ->first();
        $tipoVisita = $this->TableUniversal("MD_TipoVisita");
        $titleMsg = "Visita a $dataFichero->NombreLargo";
        $modelVisita = $id ? MD_Visita::find($id) : new MD_Visita();

        $arrayAcomp = $this->TableUniversal("MD_Acompania");
        $cmbAcompania = $this->SelectedUniversales(collect(["Acompania" => $arrayAcomp]), $modelVisita->IdAcompa,
            false, [], false, false, false, false, false);
        if ($id) {
            $arrayMM = $this->TableUniversal("MD_Muestras", ["IdLinea" => $dataFichero->IdLinea]);
            $arrayPrpductos = $this->TableUniversal("MD_Productos", ["Id" => $dataMenciones->pluck("IdProducto")->toArray()]);
            $arrayPrpductosLinea = MD_ProductoLinea::from("MD_ProductoLinea as pl")
                ->select("p.Id", "p.Nombre")
                ->join("MD_Productos as p", "pl.IdProducto", "=", "p.Id")
                ->where("pl.IdLinea", $dataFichero->IdLinea)
                ->pluck("Nombre", "Id")
                ->toArray();
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
        return view("Sistema.Pointex.Modulo.VisitaFarmacia._subVistas._frmInsert", get_defined_vars());
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
            "FechaVisita" => $request->input("txtFechaVisita")
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
//        return redirect("/pointex/visita_medica/farmacia");
        return redirect("/pointex/visita_medica/farmacia?" . "crear=0&editar=$id-$medico");
    }

    public function guardaMM(Request $request)
    {
        $arrayInsert = [
            "IdVisita" => $request->input("txtIdVisita"),
            "IdMuestra" => $request->input("cmbMM"),
            "Cantidad" => trim($request->input("txtCantidad")),
            "UsuarioCreacion" => $this->idUsuarioCreacion
        ];
        MD_EntregaMM::insert($arrayInsert);
        $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Datos almacenados correctamente"];
        session()->push('msg', $mensajeReturn);
        return redirect(url()->previous());
    }

    public function guardaPromo(Request $request)
    {
        $arrayInsert = [
            "IdVisita" => $request->input("txtIdVisita"),
//            "IdProducto" => $request->input("cmbPromocion"),
            "IdProducto" => trim($request->input("cmbtxtDescripcion")),
            "UsuarioCreacion" => $this->idUsuarioCreacion
        ];
        MD_Promocion::insert($arrayInsert);

        $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Datos almacenados correctamente"];
        session()->push('msg', $mensajeReturn);
        return redirect(url()->previous());
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
                "pl.Descripcion",
                "np.Nombre as tipo",
                DB::raw("CONCAT(np.Nombre,'-',f.NombreLargo, '-', f.Direccion) as title"),
                "pl.Fecha as start",
                "pl.Fecha as end",
                DB::raw("CASE WHEN pl.Fecha < CONVERT(DATE, GETDATE())  THEN 'gray' END as color"),
                DB::raw("'ft-eye' as icon")

            )
            ->leftjoin("MD_Fichero as f", "pl.IdFichero", "=", "f.Id")
            ->leftjoin("MD_Representante as r", "f.IdRepresentante", "=", "r.Id")
            ->leftjoin("MD_TiempoNP as np", "pl.IdTiempoNP", "=", "np.Id")
            ->leftjoin("MD_Visita as v", "f.Id", "=", "v.IdFichero")
//            ->where("r.IdUsuario", $usuarioLogueado)
            ->where("pl.UsuarioCreacion", $usuarioLogueado)
//            ->where("f.Tipo", 2)
            ->where("pl.Tipo", 2)
            ->get();
        $planificacionBase = base64_encode($planificacion);

        $dataFichero = MD_Fichero::from("MD_Fichero as f")
            ->join("MD_Representante as re", "f.IdRepresentante", "=", "re.Id")
            ->select(
                "f.Id",
                DB::raw("CONCAT(f.NombreLargo, '-', f.Direccion) as NombreLargo")
            )
            ->where("re.IdUsuario", $usuarioLogueado)
            ->where("f.Tipo", 2)
            ->get();
        $ficheroArray = $dataFichero->pluck("NombreLargo", "Id")->toArray();
        $cmbFichero = $this->SelectedUniversales(collect(["Fichero" => $ficheroArray]), null,
            false, [], false, false, false, false, false);

        $tiempoNPArray = MD_TiempoNP::select("Id", "Nombre")->orderBy("Id", "asc")->get()->pluck("Nombre", "Id")->toArray();
        $cmbTiempoNP = $this->SelectedUniversales(collect(["TiempoNP" => $tiempoNPArray]), null,
            false, [], true, false, false, false, false);

        $mensajeInfo = $this->tblMsg;
        return view("Sistema.Pointex.Modulo.VisitaFarmacia.calendario", get_defined_vars());
    }

    public function guardaPlanificacion(Request $request)
    {
        $consulta = MD_Planificacion::where("IdFichero", $request->cmbFichero)->where("Fecha", $request->txtFecha)->where("UsuarioCreacion", $this->idUsuarioCreacion)->first();

        $horaInicio = $request->HoraInicio;
        $horaFin = $request->HoraFin;
        $consultaHorario = MD_Planificacion::where("Fecha", $request->txtFecha)->where("UsuarioCreacion", $this->idUsuarioCreacion)
            ->where(function ($query) use ($horaInicio, $horaFin) {
                if ($horaInicio && $horaFin) {
                    $query->where("HoraInicio", "<=", $horaInicio)->where("HoraFin", ">=", $horaFin)
                        ->orwhere("HoraInicio", "<=", $horaInicio)->where("HoraFin", ">=", $horaInicio)
                        ->orwhere("HoraInicio", "<=", "08:00")->where("HoraFin", ">=", "18:00")
                        ->orwhereBetween("HoraInicio", [$horaInicio, $horaFin]);
                }
            })->first();

        if ($consulta || $consultaHorario) {
            $mensajeReturn = ["Tipo" => "error", "Descripcion" => "visita ya programada"];
        } else {
            $arrayInsert = [
                "IdFichero" => $request->cmbFichero,
                "Fecha" => $request->txtFecha,
                "IdTiempoNP" => $request->cmbTiempoNP,
                "HoraInicio" => $request->HoraInicio,
                "HoraFin" => $request->HoraFin,
                "Descripcion" => $request->desc,
                "Tipo" => 2,
                "UsuarioCreacion" => $this->idUsuarioCreacion
            ];
            MD_Planificacion::insert($arrayInsert);
            $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Datos almacenados correctamente"];
        }

        session()->push('msg', $mensajeReturn);
        return redirect(url()->previous());
    }

    public function UpdatePlanificacion(Request $request)
    {
        try {
            $id = $request->input("id");
            $horaInicio = $request->input("horaInicio");
            $horaFin = $request->input("Horafin");
            $consultaHorario = MD_Planificacion::where("Fecha", date("Y-m-d"))->where("Id","<>",$id)->where("UsuarioCreacion", $this->idUsuarioCreacion)
                ->where(function ($query) use ($horaInicio, $horaFin) {
                    $query->where("HoraInicio", "<=", $horaInicio)->where("HoraFin", ">=", $horaFin)
                        ->orwhere("HoraInicio", "<=", $horaInicio)->where("HoraFin", ">=", $horaInicio)
                        ->orwhereBetween("HoraInicio", [$horaInicio, $horaFin]);
                })->first();
            if ($consultaHorario) {
                return ["Tipo" => "Error","DESCRIPCION" => "Horario incorrecto"];
            }else{
                return MD_Planificacion::where("Id", $id)->update(["HoraInicio" => $horaInicio,"HoraFin" =>$horaFin]) ? "OK" : "Error";
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
