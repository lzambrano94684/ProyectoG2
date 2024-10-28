<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 24/03/2021
 * Time: 16:48
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
use App\Modelos\BI\PX_BI_FacturaTransito;
use App\Modelos\BI\PX_BI_InputsReporte;
use App\Modelos\BI\PX_BI_Ventas;
use App\Modelos\CORE\PX_SIS_Contacto;
use App\Modelos\CORE\PX_SIS_ENTIDAD;
use App\Modelos\CORE\PX_SIS_PAIS;
use App\Modelos\CORE\PX_SIS_PERSONA;
use App\Modelos\GestionProducto\PX_GP_Franquicia;
use App\Modelos\GestionProducto\PX_GP_Producto;
use App\Modelos\GestionProducto\PX_GP_ProductoCodigos;
use App\Modelos\GestionProducto\PX_GP_TransitosAlert;
use App\Modelos\SalesExpenses\PX_SEX_EncabezadoDoc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use DateTime;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\DocBlock\Description;


class TransitosController extends BaseController
{
    var $idUsuarioCreacion;
    var $infoUserLog;
    var $dataTable;
    var $arrayEstatus;
    var $arrayContacto;
    var $arrayPais;
    var $arrayCliente;

    public function __construct()
    {
        try {
            $this->infoUserLog = $this->getDataUserLogeado();
            $this->idUsuarioCreacion = $this->infoUserLog->Id;
            $this->arrayEstatus = [1 => "Activo", 0 => "Inactivo"];
            $this->arrayContacto = PX_GP_TransitosAlert::from("PX_GP_TransitosAlert as ta")
                ->join("PX_SIS_Persona as pe", "ta.IdPersona", "=", "pe.Id")
                ->select(DB::raw("concat(pe.Nombres,' ',pe.Apellidos) as Nombre"), "pe.Id")
                ->get()->pluck("Nombre", "Id");
            $this->arrayPais = PX_SIS_PAIS::from("PX_SIS_Pais as p")->select("Nombre", "Id")->where("TipoUso", 1)->orderBy("Orden")->get()->pluck("Nombre", "Id");
//            $this->arrayCliente = PX_SIS_Entidad::from("PX_SIS_Entidad as e")->select("Nombre", "Id")->get()->pluck("Nombre", "Id");
            $this->arrayCliente = PX_SIS_Entidad::from("PX_SIS_Entidad as e")->select("Nombre", "Id")->get()->unique("Nombre");
        } catch (\Exception $e) {

        }
    }

    public function index(Request $request)
    {
        $dataPersona = $this->infoUserLog->Persona;
        $usuarioLogueado = $this->idUsuarioCreacion;
        $request = $this->UrlToData($request);
        $msg = session()->get("msg");
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true, "DatePicker" => true, "Switch" => true];
        $titleMsg = "Facturas en transito";
        $vista = "";
        $Cliente = $request->cmbCliente;
        if ($request->crear) {
            $titleMsg .= " - ingresar";
            $vista = $this->frmInsert($request, 0);
        } elseif ($request->editar) {
            $titleMsg .= " - editar";
            $vista = $this->frmInsert($request, $request->editar);
        } else {
            $fecha = $request->input("fechaTxt") ? $request->input("fechaTxt") : date("Y-m");
            $vista = $this->filtro($request, $fecha);
            $vista .= $this->tblIndex($request, $fecha);
        }
        return view("Sistema.Pointex.Modulo.BI.Ventas.Transitos.index", get_defined_vars());
    }

    public function frmInsert($request, $id)
    {
        $modelEncabezado = $id ? PX_BI_FacturaEncabezado::find($id) : new PX_BI_FacturaEncabezado;
        $modelTransito = $modelEncabezado->Id ? PX_BI_FacturaTransito::where("IdFactura", $modelEncabezado->Id)->first() : new PX_BI_FacturaTransito;

        $arrayFactura = PX_BI_FacturaEncabezado::select(DB::raw("CONCAT(Referencia, ' - ', Factura) Nombre"), "Id")
            ->orderBy("FechaFactura", "ASC")
            ->orderBy("Referencia", "ASC")
            ->get()
            ->pluck("Nombre", "Id")
            ->toArray();
        $cmbFac = $this->SelectedUniversales(collect(["Fac" => $arrayFactura]), $modelEncabezado->Id,
            false, [
            ], true, false, false, false, false);
        $arrayPaises = PX_SIS_PAIS::select("Nombre", "Id")->get()->pluck("Nombre", "Id");

        $paisDepach = $modelEncabezado->Referencia ? $GyA = is_int(strpos($modelEncabezado->Referencia, "G")) ? 15 : 1 : $modelTransito->IdPaisDespacho;

        $cmbPaisDespacho = $this->SelectedUniversales(collect(["PaisDespacho" => $arrayPaises->toArray()]), $paisDepach
            , false, [], false, true, false, false, false, false, "Seleccione...");

        $cmbEstatus = $this->SelectedUniversales(collect(["Estatus" => $this->arrayEstatus]), $modelTransito ? $modelTransito->Estatus : null
            , false, [], true,
            true, false, false, false, false, "Seleccione...");
        $fecha = date('Y-m-d', strtotime("+1 month"));
        $arrayPaises = PX_SIS_PAIS::select("Nombre", "Id")->get()->pluck("Nombre", "Id");
        return view("Sistema.Pointex.Modulo.BI.Ventas.Transitos._subVistas._frmInsert", get_defined_vars());
    }

    public function tblIndex($request, $fecha)
    {
        $fechaInicio = date("Y-m-d", strtotime("$fecha-01" . "- 1 month"));
        $fechaFin = date("Y-m-t", strtotime("$fecha-01"));

//        $dataTransitos = PX_BI_FacturaEncabezado::from("PX_BI_FacturaEncabezado as fe")
//            ->select(
//                "fe.Factura", "fe.FechaFactura", "pa.Nombre as Pais", "e.NombreBI as Dist", "fe.Referencia", DB::raw("'' as NPedidoCliente"),
//                "pa.Nombre as ODespacho", DB::raw("'' as FechaIngresoBodega"), DB::raw("'' as FechaIngresoSistema"),
//                DB::raw("''as  FechaDespacho"), DB::raw("'' as Estatus"), DB::raw("'' as Transito"), DB::raw("'' as Fecha"),
//                DB::raw("'' as Comentarios"),
////                DB::raw("0 as Id"),
//                "fe.Id",
//                DB::raw("'si' as Transito"))
//            ->join("PX_SIS_Entidad as e", "fe.IdDistribuidor", "=", "e.Id")
//            ->join("PX_SIS_Pais as pa", "fe.IdPais", "=", "pa.Id")
//            ->whereBetween("fe.Fecha", [$fechaInicio, $fechaFin])
//            ->orderBy("fe.Id", "desc")
//            ->get();

        $dataTransitos = PX_BI_FacturaEncabezado::from("PX_BI_FacturaEncabezado as fe")
            ->leftjoin("PX_BI_FacturaTransito as ft", "fe.Id", "=", "ft.IdFactura")
            ->join("PX_SIS_Pais as pa", "fe.IdPais", "=", "pa.Id")
            ->join("PX_SIS_Entidad as e", "fe.IdDistribuidor", "=", "e.Id")
            ->select("fe.Id", "fe.Factura", "fe.FechaFactura", "pa.Nombre as Pais", "e.NombreBI as Dist", "fe.Referencia", "ft.NPedidoCliente",
                "ft.IdPaisDespacho as  ODespacho", "fe.FechaIngresoBodega", "fe.FechaIngresoSistema", "fe.FechaDespacho", "ft.Estatus",
                DB::raw("'si' as Transito"), "fe.Fecha", "ft.Comentarios")
            ->whereBetween("fe.Fecha", [$fechaInicio, $fechaFin])
            ->where("fe.Transito", 1)->get();

        $data = PX_BI_FacturaEncabezado::from("PX_BI_FacturaEncabezado as fe")
            ->leftjoin("PX_BI_FacturaTransito as ft", "fe.Id", "=", "ft.IdFactura")
            ->join("PX_SIS_Pais as pa", "fe.IdPais", "=", "pa.Id")
            ->join("PX_SIS_Entidad as e", "fe.IdDistribuidor", "=", "e.Id")
            ->select("fe.Id","fe.Factura", "fe.FechaFactura", "pa.Nombre as Pais", "e.NombreBI as Dist", "fe.Referencia", "ft.NPedidoCliente",
                "ft.IdPaisDespacho as  ODespacho", "fe.FechaIngresoBodega", "fe.FechaIngresoSistema", "fe.FechaDespacho", "ft.Estatus",
                DB::raw("'no' as Transito"), "fe.Fecha", "ft.Comentarios")
            ->where(DB::raw("month(fe.Fecha)"), date("m"))
            ->where("fe.Transito", 0)->get();


//        $data = PX_BI_FacturaTransito::from("PX_BI_FacturaTransito as tr")
//            ->select(
//                "pa.Nombre as Pais", "e.NombreBI as Dist", "fe.Referencia", "fe.Factura", "fe.FechaFactura", "tr.NPedidoCliente",
//                "pa1.Nombre as ODespacho", "tr.FechaIngresoBodega",
//                "tr.FechaIngresoSistema", "tr.FechaDespacho", "tr.Estatus"
//                , "tr.Fecha", "tr.Comentarios",
////                "tr.Id",
//                "fe.Id",
//                DB::raw("'no' as Transito"))
//            ->leftJoin("PX_SIS_Pais as pa1", "tr.IdPaisDespacho", "=", "pa1.Id")
//            ->join("PX_BI_FacturaEncabezado as fe", "tr.IdFactura", "=", "fe.Id")
//            ->join("PX_SIS_Pais as pa", "fe.IdPais", "=", "pa.Id")
//            ->join("PX_SIS_Entidad as e", "fe.IdDistribuidor", "=", "e.Id")
//            ->whereBetween("tr.Fecha", ["$fecha-01", date("Y-m-t", strtotime("$fecha-01"))])
//            ->orderBy("tr.Id", "desc")
//            ->get();

        return view("Sistema.Pointex.Modulo.BI.Ventas.Transitos._subVistas._tbl", get_defined_vars());
    }

    public function filtro($request, $fecha)
    {
        return view("Sistema.Pointex.Modulo.BI.Ventas.Transitos._subVistas._filtro", get_defined_vars());
    }

    public function getDataFac($id)
    {
        return PX_BI_FacturaEncabezado::from("PX_BI_FacturaEncabezado as fe")
            ->select(
                "fe.Id",
                "pa.Nombre as Pais",
                "e.NombreBI as Dist",
                "fe.Referencia",
                "fe.Factura",
                "fe.FechaFactura"
            )->join("PX_SIS_Pais as pa", "fe.IdPais", "=", "pa.Id")
            ->join("PX_SIS_Entidad as e", "fe.IdDistribuidor", "=", "e.Id")
            ->where("fe.Id", $id)
            ->first();
    }

    public function guardaTransito(Request $request)
    {
        $almacena = true;
        $this->idUsuarioCreacion = $this->getDataUserLogeado()->Id;
        try {
            $Id = $request->input("Id");
            $IdFactura = $request->input("IdFact");
            $IdPaisDespacho = $request->input("cmbPaisDespacho");
            $NPedidoCliente = $request->input("NPedidoCliente");
            $Fecha = date("Y-m-d");
            $Comentarios = $request->input("Comentarios");
            $UsuarioCreacion = $this->idUsuarioCreacion;

            if (!$Id) {
                $FechaCreacion = date("Y-m-d");
                $array = compact("IdFactura", "IdPaisDespacho", "NPedidoCliente", "Fecha", "Comentarios", "UsuarioCreacion", "FechaCreacion");
                $almacena = PX_BI_FacturaTransito::insert($array);
            } else {
                $consultaEncabezado = PX_BI_FacturaEncabezado::find($Id);
                $consultaTransito = PX_BI_FacturaTransito::where("IdFactura", $consultaEncabezado->Id)->first();
                $FechaModificacion = date("d-m-Y h:i:s");
                if ($consultaTransito) {
                    $array = compact("IdPaisDespacho", "NPedidoCliente","Fecha", "Comentarios", "UsuarioCreacion", "FechaModificacion");
                    $almacena = PX_BI_FacturaTransito::where("IdFactura", $consultaEncabezado->Id)->update($array);
                } else {
                    $IdFactura = $consultaEncabezado->Id;
                    $array = compact("IdFactura", "IdPaisDespacho", "NPedidoCliente","Fecha", "Comentarios", "UsuarioCreacion", "FechaModificacion");
                    $almacena = PX_BI_FacturaTransito::insert($array);
                }

            }
            $mensaje = $almacena ? "Datos almacenados correctamente" : "Hubo un problema al momento de almacenar la información";
        } catch (\Exception $e) {
            $almacena = false;
            $mensaje = "Error de sitaxis '" . $e->getMessage() . "'";
        }
        $tipo = $almacena ? "success" : "error";
        $mensajeReturn = ["Tipo" => $tipo, "Descripcion" => $mensaje];
        session()->push('msg', $mensajeReturn);
        return redirect("/pointex/bi/ventas/transitos");
    }

    public function guardaFactura(Request $request)
    {
        $almacena = true;
        $this->idUsuarioCreacion = $this->getDataUserLogeado()->Id;
        try {
            $Id = $request->input("IdFactura");
            $FechaDespacho = $request->input("FechaDespacho");
            $FechaIngresoBodega = $request->input("FechaIngresoBodega");
            $FechaIngresoSistema = $request->input("FechaIngresoSistema");
            $FechaModificacion = date("d-m-Y h:i:s");

            $array = compact("FechaDespacho", "FechaIngresoBodega", "FechaIngresoSistema", "FechaModificacion");
            $almacena = PX_BI_FacturaEncabezado::where("Id", $Id)->update($array);
            $mensaje = $almacena ? "Datos almacenados correctamente" : "Hubo un problema al momento de almacenar la información";
            $tipo = $almacena ? "success" : "error";
            $mensajeReturn = ["Tipo" => $tipo, "Descripcion" => $mensaje];
            session()->push('msg', $mensajeReturn);
        } catch (\Exception $e) {
            $almacena = false;
            $mensaje = "Error de sitaxis '" . $e->getMessage() . "'";
        }
        return redirect(url()->previous());
    }

    public
    function TransitoEstatusActivo(Request $request, $id)
    {
        $model = new PX_BI_FacturaEncabezado();
        if ($request->ajax()) {
            $transito = $request->input("transito");
            $arraEstado = ['Transito' => $transito];
            $model->where("Id", $id)->update($arraEstado);
        }
        return "OK";
    }

    public
    function destroyFacturaTrancito($Id)
    {
        try {
            if ($Id) {
                $almacena = PX_BI_FacturaTransito::where('IdFactura', $Id)->delete();
            }
            $mensaje = $almacena ? "Datos eliminados correctamente" : "Hubo un problema al momento de eliminar la información";
        } catch (\Exception $e) {
            $almacena = false;
            $mensaje = "Error de sitaxis '" . $e->getMessage() . "'";
        }
        $tipo = $almacena ? "success" : "error";
        $mensajeReturn = ["Tipo" => $tipo, "Descripcion" => $mensaje];
        session()->push('msg', $mensajeReturn);
        return redirect('/pointex/bi/ventas/transitos');
    }

    public
    function documentoFacturacion(Request $request, $data)
    {
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true, "DatePicker" => true, "Switch" => true];
        $titleMsg = "Documento de Facturacion";
        $arraydata = explode("-", $data);
        $fecha = $arraydata[0] ? base64_decode($arraydata[0]) : null;

        $arrayContacto = $this->arrayContacto->toArray();
        $cmbContacto = $this->SelectedUniversales(collect(["Contacto" => $arrayContacto]), null,
            false, [
                "name" => "cmbContacto",
                "id" => "cmbContacto",
                "class" => "select2_single form-control"
            ], true, false, false, false, false, false);

        $fechaInicio = "$fecha-01";
        $fechaFin = date("Y-m-t", strtotime("$fecha-30"));

        $dataTransitos = PX_BI_FacturaEncabezado::from("PX_BI_FacturaEncabezado as fe")
            ->select(
                "fe.Factura", "fe.FechaFactura", "pa.Nombre as Pais", "e.NombreBI as Dist", "fe.Referencia", DB::raw("'' as NPedidoCliente"),
                "pa.Nombre as ODespacho", DB::raw("'' as FechaIngresoBodega"), DB::raw("'' as FechaIngresoSistema"),
                DB::raw("''as  FechaDespacho"), DB::raw("'' as Estatus"), DB::raw("'' as Transito"), DB::raw("'' as Fecha"),
                DB::raw("'' as Comentarios"),
//                DB::raw("0 as Id"),
                "fe.Id",
                DB::raw("'si' as Transito"))
            ->join("PX_SIS_Entidad as e", "fe.IdDistribuidor", "=", "e.Id")
            ->join("PX_SIS_Pais as pa", "fe.IdPais", "=", "pa.Id")
            ->whereBetween("fe.Fecha", [$fechaInicio, $fechaFin])
            ->where(function ($query) use ($fechaInicio, $fechaFin) {
                $cuentaTransito = PX_BI_FacturaTransito::select(DB::raw("COUNT(1) Cuenta"))->whereBetween("Fecha", [$fechaInicio, $fechaFin])->first();
                if ((int)$cuentaTransito->Cuenta > 0) {
                    $query->whereNotIn("fe.Id", function ($query) use ($fechaInicio, $fechaFin) {
                        $query->select("IdFactura")
                            ->from((new PX_BI_FacturaTransito())->getTable())
                            ->whereBetween("Fecha", [$fechaInicio, $fechaFin]);
                    });
                }
            })
            ->orderBy("fe.Id", "desc")
            ->get();

        $getCorreos = PX_GP_TransitosAlert::from("PX_GP_TransitosAlert as ta")
            ->join("PX_SIS_Persona as p", "ta.IdPersona", "p.Id")
            ->join("PX_SIS_CONTACTO as c", "p.Id", "c.IdPersona")
            ->select("c.Correo")
            ->get();

        $arrayPaises = PX_SIS_PAIS::select("Nombre", "Id")->get()->pluck("Nombre", "Id");
        $cmbPais = $this->SelectedUniversales(collect(["Pais" => $arrayPaises->toArray()]), null
            , false, ["id" => 'pais',"name" => 'pais',"class" => 'select2_single form-control'], false, true, false, false, false, false, "Seleccione...");

        $arrayEntidad = PX_SIS_ENTIDAD::select("Nombre", "CodigoCliente")->get()->pluck("Nombre", "CodigoCliente");
        $cmbEntidad = $this->SelectedUniversales(collect(["Entidad" => $arrayEntidad->toArray()]), null
            , false, ["id" => 'cliente',"name" => 'cliente',"class" => 'select2_single form-control'], false, true, false, false, false, false, "Seleccione...");

        if ($dataTransitos->count() > 0) {
            return view("Sistema.Pointex.Modulo.BI.Ventas.Transitos._subVistas._documento", get_defined_vars());
        } else {
            $tipo = "error";
            $mensaje = "no puedes enviar correo por que no cuentas con informacion en transito";
            $mensajeReturn = ["Tipo" => $tipo, "Descripcion" => $mensaje];
            session()->push('msg', $mensajeReturn);
            return redirect('/pointex/bi/ventas/transitos');
        }
    }

    public
    function CorreoTransito(Request $request)
    {
        $correos = $request->input("correos");
        $contacto = explode(";", $correos);
        $descripcion = $request->input("descripcion");
        $fecha = $request->input("fecha");
        $pais = $request->input("pais");
        $cliente = $request->input("cliente");
        $fechaInicio = "$fecha-01";
        $fechaFin = date("Y-m-t", strtotime("$fecha-30"));
        $dataTransitos = PX_BI_FacturaEncabezado::from("PX_BI_FacturaEncabezado as fe")
            ->select(
                "fe.Factura", "fe.FechaFactura", "pa.Nombre as Pais", "e.NombreBI as Dist", "fe.Referencia", DB::raw("'' as NPedidoCliente"),
                "pa.Nombre as ODespacho", DB::raw("'' as FechaIngresoBodega"), DB::raw("'' as FechaIngresoSistema"),
                DB::raw("''as  FechaDespacho"), DB::raw("'' as Estatus"), DB::raw("'' as Transito"), DB::raw("'' as Fecha"),
                DB::raw("'' as Comentarios"),
//                DB::raw("0 as Id"),
                "fe.Id",
                DB::raw("'si' as Transito"))
            ->join("PX_SIS_Entidad as e", "fe.IdDistribuidor", "=", "e.Id")
            ->join("PX_SIS_Pais as pa", "fe.IdPais", "=", "pa.Id")
            ->whereBetween("fe.Fecha", [$fechaInicio, $fechaFin])
            ->where(function ($query) use ($fechaInicio, $fechaFin) {
                $cuentaTransito = PX_BI_FacturaTransito::select(DB::raw("COUNT(1) Cuenta"))->whereBetween("Fecha", [$fechaInicio, $fechaFin])->first();
                if ((int)$cuentaTransito->Cuenta > 0) {
                    $query->whereNotIn("fe.Id", function ($query) use ($fechaInicio, $fechaFin) {
                        $query->select("IdFactura")
                            ->from((new PX_BI_FacturaTransito())->getTable())
                            ->whereBetween("Fecha", [$fechaInicio, $fechaFin]);
                    });
                }
            })
            ->where(function ($query) use ($pais, $cliente) {
                if ($pais) {
                    $query->where("pa.Id", $pais);
                }
                if ($cliente) {
                    $query->where("e.CodigoCliente", $cliente);
                }
            })
            ->orderBy("fe.Id", "desc")
            ->get();

        $arrayMeses = $this->mesesAbreviado();
        $consultaCliente = $cliente ? PX_SIS_Entidad::select("NombreBI")->where("CodigoCliente", $cliente)->first() : false;
        $asunto = $consultaCliente ? $consultaCliente->NombreBI . "-" . $arrayMeses[date("n")] : "Transitos-" . $arrayMeses[date("n")];
        $persona = PX_SIS_Persona::select(DB::raw("CONCAT(Nombres,' ',Apellidos) as persona"))->where("Id", $this->getDataUserLogeado()->IdPersona)->first();
        $persona = $persona->persona;
        $body = array('descripcion' => "$descripcion", 'dataTransitos' => $dataTransitos, 'persona' => "$persona",);
        array_pop($contacto);
        foreach ($contacto as $kc) {
            Mail::send('Correos.Facturacion', $body, function ($message) use ($kc, $asunto) {
                $message->to($kc)
                    //->cc($this->infoUserLog->Persona->PersonaContacto->first()->Correo)
                    ->subject($asunto);
                $message->from('pointex@exeltis.com', 'POINTEX ERP');
            });
        }

        $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Correo enviado correctamente"];
        session()->push('msg', $mensajeReturn);
        return redirect(url()->previous());
    }

    public
    function GetCliente($id)
    {
        return PX_SIS_Entidad::select("NombreBI", "CodigoCliente")->where("IdPais", $id)->where("CodigoCLiente", "<>", "")->whereNotNull("CodigoCLiente")->get()->pluck("NombreBI", "CodigoCliente")->unique();
    }

    public function Confirmar(){
        $fecha = date("d-m-Y");
        $mes = date("m", strtotime("$fecha-01" . "- 1 month"));
        $fechaInicio = date("Y")."-".$mes."-01";
        $fechaFin = date("Y-m-t", strtotime("$fechaInicio"));

        $arrayUpdate["Estatus"] = 1;
        $dataTransitos = PX_BI_FacturaTransito::from("PX_BI_FacturaTransito as ft")
            ->join("PX_BI_FacturaEncabezado as fe","ft.IdFactura","=","fe.Id")
            ->whereBetween("fe.Fecha", [$fechaInicio, $fechaFin])
            ->where("fe.Transito", 0)->update($arrayUpdate);
        $mensajeReturn = ["Tipo" => "success", "Descripcion" => "TransitosConfirmados Correctamente"];
        session()->push('msg', $mensajeReturn);
        return redirect(url()->previous());
    }
}
