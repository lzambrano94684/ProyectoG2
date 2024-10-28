<?php

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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class BonificacionesController extends BaseController
{
    var $idUsuarioCreacion;
    var $infoUserLog;
    var $dataTable;
    var $codNicaragua = "NI";

    public function __construct()
    {
        try {
            $this->infoUserLog = $this->getDataUserLogeado();
            $this->idUsuarioCreacion = $this->infoUserLog->Id;
        } catch (\Exception $e) {

        }
    }

    public function cargadas(Request $request)
    {
        $IdFranquiciaMA = PX_GP_Franquicia::select("Id")->where("Codigo", "MA")->first()->Id;
        $arrayProductoF = PX_GP_ProductoCodigos::select("IdFranquicia", "CodigoSap")->whereNotNull("IdFranquicia")->get()->pluck("IdFranquicia", "CodigoSap");
        $dataPersona = $this->infoUserLog->Persona;
        $usuarioLogueado = $this->idUsuarioCreacion;
        $request = $this->UrlToData($request);
        $msg = session()->get("msg");
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true, "DatePicker" => true, "Switch" => true];
        $request = $this->UrlToData($request);
        $titleMsg = "Carga de Bonificados";


        $arrayPaises = PX_SIS_PAIS::select("Codigo")->get()->pluck("Codigo", "Codigo");
        $arrayProducto = PX_GP_ProductoCodigos::select("CodigoSap")->get()->pluck("CodigoSap", "CodigoSap");
        $arrayCliente = PX_SIS_Entidad::select("CodigoCliente")->get()->pluck("CodigoCliente", "CodigoCliente");
        $mes = date("m");
        $anio = date("Y");
        if ($request->txtFechaInicio) {
            $expl = explode("-", $request->txtFechaInicio);
            $mes = $expl[1];
            $anio = $expl[0];
        }

        $totalSales = collect(collect(DB::select("select SUM(TOTAL_USD) from [dbo].[Fun_Sales]($anio, $mes, 1) as Total"))->first())->first();

        $codNi = $this->codNicaragua;
        $thisController = $this;

        $subTitle = "A continuación un detalle previo a cargar los bonificados";
        $titulos = $this->cargarVentas()->first();
        $dataTable = $this->cargarVentas()->last();

        $this->dataTable = $dataTable;
        $inputs = collect();
        $dataGetInput = PX_BI_ArchivoSupply::get();

        foreach ($titulos as $vt) {
            $inputs->put($vt, $this->pluckInterno($vt)->toArray());
        }
        $dataTable = $dataTable->whereIn("TPos", "ZPBE")->whereNotIn("Nom_Cl_Final", ["ALTIAN PHARMA GRUPPE DE CENTRO AMER", "ASTA MEDICA CENTROAMERICANA S.A.", "CLIENTES VARIOS NACIONAL"])->values();

        $libre = collect();
        $dataFiltrada = collect();

        return view("Sistema.Pointex.Modulo.BI.Ventas.Bonificaciones.index", get_defined_vars());
    }

    public function cargarVentas()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(5000);
        $file = storage_path("app/Pointex/Ventas/data.xlsx");
        $modelImport = new ImportSalesBon();
        $data = Excel::toCollection($modelImport, $file);
        $tab1 = $data->get(0);
        $titulos = $tab1->get(0);
        $strVta97 = "Venta 97";
        $titulos->push($strVta97)->transform(function ($v) {
            return str_replace(".", "_", $v);
        });

        $t = $titulos->toArray();
        array_unshift($t, "Estatus");
        $titulos = collect($t);
        $dataTableView = collect();
        $tituloIncoterm = "incoterm";
        foreach ($tab1->values()->forget(0) as $kt => $vt) {
            $vt->prepend(0);
            $vt->push(0);
            $posicion97 = $titulos->search($strVta97);
            $posicionVB = $titulos->search("VENTA BRUTA USD");
            $posicionIncoterm = $titulos->search($tituloIncoterm);
            $valorVB = (float)$vt[$posicionVB];
            $valorInco = (float)$vt[$posicionIncoterm];
            $vt[$posicion97] = $valorInco ? $valorVB - $valorInco : $valorVB;
            $arrayInterno = collect();
            foreach ($titulos as $kt => $vtt) {
                $arrayInterno->put(str_replace(".", "_", $vtt), $vt[$kt]);
            }
            $dataTableView->push($arrayInterno);
        }
        return collect([$titulos, $dataTableView]);
    }

    public function pluckInterno($pluck)
    {
        $dataTable = $this->dataTable;
        $varReturn = collect();
        foreach ($dataTable as $value) {
            $varReturn->put($value[$pluck], $value[$pluck]);
        }
        return $varReturn;
    }

    public function saveFiltro(Request $request)
    {
        $ArrayInsert = collect($request->input());
        $ArrayInsert->forget("_token");
        $arrayTipos = collect($ArrayInsert->get("filtro"));
        $ArrayInsert->forget("filtro");
        $isertInputs = [];
        foreach ($ArrayInsert as $k => $v) {
            $inputs = array_filter($v);
            if (count($inputs) > 0) {
                $varReturn = [
                    "Inputs" => base64_encode(collect($inputs)->toJson()),
                    "Nombre" => $k,
                    "Tipo" => isset($arrayTipos[$k]) ? 1 : null
                ];
                $isertInputs[] = $varReturn;
            }
        }
        PX_BI_ArchivoSupply::truncate();
        $model = new PX_BI_ArchivoSupply();
        $model->insert($isertInputs);
        $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Datos almacenados correctamente"];
        session()->push('msg', $mensajeReturn);
        return redirect(url()->previous());
    }

    public function saveBonificados(Request $request)
    {
        $dataMasiva = collect(json_decode(base64_decode($request->input("txtVentaFiltrada"))));

        $tipoZPBE = "ZPBE";
        $UsuarioCreacion = $this->idUsuarioCreacion;
        $txtFecha = explode("-", $request->input("txtFecha"));

        // data encabezado factura
        $kFecha = $request->input("cmbFecha");
        $kPais = $request->input("cmbPais");
        $kDistribuidor = $request->input("cmbDistribuidor");
        $kFactura = $request->input("cmbFactura");
        $kReferencia = $request->input("cmbReferencia");

        $dataMasiva->transform(function ($v, $k) use ($kFecha) {
            $value = collect($v);
            $fecha = date("Y-m-d", $this->fromExcelToLinux(trim($value->get($kFecha))));
            $v->$kFecha = $fecha;
            return collect($v);
        });

        $arrayFechas = $dataMasiva->pluck($kFecha);

        // data detalle factura
        $kProducto = $request->input("cmbProducto");
        $kUnidades = $request->input("cmbUnidades");
        $kFechaVencimiento = $request->input("cmbFechaVencimiento");
        $kPrecio = $request->input("cmbPrecio");
        $kVenta100 = $request->input("cmbVenta100");
        $kIncoterm = $request->input("cmbIncoterm");
        $kVenta97 = $request->input("cmbVenta97");
        $mes = $txtFecha[1];
        $anio = $txtFecha[0];
        $arrayMeses = $arrayFechas->unique()
            ->transform(function ($v) {
                $fecha = date_create_from_format('Y-m-d', $v);
                return [date_format($fecha, 'm'), date_format($fecha, 'Y')];
            })->unique();
        $catProducto = PX_GP_ProductoCodigos::from("PX_GP_ProductoCodigos as pc")
            ->leftJoin("PX_GP_Producto as p", "pc.IdProducto", "=", "p.Id")
            ->select("pc.Id", "pc.CodigoSap", "pc.DescripcionSap", "p.Id as IdPu", "p.Presentacion", "p.TipoPresentacion")
            ->get()
            ->groupBy("CodigoSap");

        DB::beginTransaction();

        $deleteFac = PX_BI_FacturaEncabezadoB::where(DB::raw("MONTH(Fecha)"), (int)$mes)
            ->where(DB::raw("YEAR(Fecha)"), $anio)
            ->delete();

        $arrayEntrs = [];
        foreach ($dataMasiva as $kdm => $value) {
            $IdDistribuidor = PX_SIS_ENTIDAD::from("PX_SIS_ENTIDAD as e")
                ->select("e.Id")
                ->where("e.CodigoCliente", $value->get($kDistribuidor))
                ->first()
                ->Id;
            $IdPais = PX_SIS_PAIS::select("Id")
                ->where("Codigo", $value->get($kPais))
                ->first()
                ->Id;
            $Factura = trim($value->get($kFactura));
            $Referencia = trim($value->get($kReferencia));
            $FechaFactura = $value->get($kFecha);
            $Fecha = $request->input("txtFecha") . "-01";
            $arrayInsertFacturaEncabezado = compact("IdDistribuidor",
                "IdPais", "Factura", "Referencia", "Fecha", "FechaFactura", "UsuarioCreacion");
            $IdFacturaEncabezado = $this->returnIdFactura($arrayInsertFacturaEncabezado, $tipoZPBE);
            $codProducto = $value->get($kProducto);
            $canalVenta = $value->get("ClPed");
            if ($canalVenta == "INST") {
                $arrayEntrs[] = 1;
                $consultaProducto = $catProducto->get($codProducto)
                    ->where("TipoPresentacion", "Venta Inst")
                    ->last();
                if ($consultaProducto) {
                    $IdProducto = $consultaProducto->Id;
                } else {
                    $consultaProducto = $catProducto->get($codProducto)
                        ->whereIn("TipoPresentacion", ["Venta", "Muestra Medica"])
                        ->last();
                    $idProdUnico = $consultaProducto->IdPu;
                    if ($idProdUnico) {
                        $arrayProductoUnico = PX_GP_Producto::select("IdMarca",
                            DB::raw("CONCAT('Inst-', Presentacion) as Presentacion")
                        )
                            ->find($idProdUnico)
                            ->toArray();
                        $arrayProductoUnico["TipoPresentacion"] = "Venta Inst";
                        $idProdUnicoCons = PX_GP_Producto::select("Id")
                            ->where("Presentacion", $arrayProductoUnico["Presentacion"])
                            ->first();
                        $idProdUnico = $idProdUnicoCons ? $idProdUnicoCons->Id : PX_GP_Producto::create($arrayProductoUnico)->Id;
                        $IdProducto = PX_GP_ProductoCodigos::create(
                            [
                                "IdProducto" => $idProdUnico,
                                "DescripcionSap" => $consultaProducto->DescripcionSap,
                                "CodigoSap" => $codProducto
                            ]
                        )->Id;

                    } else {
                        DB::rollBack();
                        $mensajeReturn = ["Tipo" => "error", "Descripcion" => "No existe un producto unico para para el codigo SAP $codProducto"];
                        session()->push('msg', $mensajeReturn);
                        return redirect("/pointex/bi/ventas/cargadas");
                    }
                }
            } else {
                $consultaProducto = $catProducto->get($codProducto)->where("TipoPresentacion", "Venta")->last();

                if ($consultaProducto) {
                    $IdProducto = $consultaProducto->Id;
                } else {
                    $consultaProducto = $catProducto->get($codProducto)
                        ->whereIn("TipoPresentacion", ["Venta Inst", "Muestra Medica"])
                        ->last();
                    $idProdUnico = $consultaProducto->IdPu;

                    if ($idProdUnico) {
                        $arrayProductoUnico = PX_GP_Producto::select("IdMarca",
                            DB::raw("REPLACE(REPLACE(Presentacion, 'Inst-', ''), 'Inst', '') as Presentacion")
                        )
                            ->find($idProdUnico)
                            ->toArray();
                        $arrayProductoUnico["TipoPresentacion"] = "Venta";
                        $idProdUnicoCons = PX_GP_Producto::select("Id")
                            ->where("Presentacion", $arrayProductoUnico["Presentacion"])
                            ->first();
                        $idProdUnico = $idProdUnicoCons ? $idProdUnicoCons->Id : PX_GP_Producto::create($arrayProductoUnico)->Id;
                        $IdProducto = PX_GP_ProductoCodigos::create(
                            [
                                "IdProducto" => $idProdUnico,
                                "DescripcionSap" => $consultaProducto->DescripcionSap,
                                "CodigoSap" => $codProducto
                            ]
                        )->Id;

                    } else {
                        DB::rollBack();
                        $mensajeReturn = ["Tipo" => "error", "Descripcion" => "No existe un producto unico para para el codigo SAP $codProducto"];
                        session()->push('msg', $mensajeReturn);
                        return redirect("/pointex/bi/ventas/cargadas");
                    }
                }
            }
            $Cantidad = $value->get($kUnidades);
            $FechaVencimiento = $value->get($kFechaVencimiento);
            $FechaVencimiento = $FechaVencimiento ? Carbon::createFromFormat("m-Y", $FechaVencimiento)->format("Y-m-d") : null;
            $Precio = $value->get($kPrecio);
            $Venta100 = $value->get($kVenta100);
            $Incoterm = $value->get($kIncoterm);
            $Venta97 = $value->get($kVenta97);
            $arrayInsertDetalleFactura = compact("IdFacturaEncabezado", "IdProducto",
                "Cantidad", "FechaVencimiento", "Precio", "Venta100", "Incoterm", "Venta97", "UsuarioCreacion");
            $almacena = $this->insertDetalleFactura($arrayInsertDetalleFactura, $tipoZPBE);
        }
        DB::commit();

        $tipo = $almacena ? "success" : "error";
        $mensajeReturn = ["Tipo" => $tipo, "Descripcion" => "Datos almacenados correctamente"];
        session()->push('msg', $mensajeReturn);
        return redirect("/pointex/bi/bonificados/cargadas");
    }

    public function returnIdFactura($arrayInsert, $tipoZPBE)
    {
        $modelFacturaEncabezado = strpos($tipoZPBE, "ZPBE") !== false ? new PX_BI_FacturaEncabezadoB() : new PX_BI_FacturaEncabezado();
        $idFactura = $modelFacturaEncabezado
            ->select("Id")
            ->where("Factura", $arrayInsert["Factura"])
            ->take(1)
            ->first();
        if ($idFactura) {
            $idFactura = $idFactura->Id;
        } else {
            $idFactura = $modelFacturaEncabezado->create($arrayInsert)->Id;
        }
        return $idFactura;
    }

    public function insertDetalleFactura($arrayInsert, $tipoZPBE)
    {
        if (strpos($tipoZPBE, "ZPBE") !== false) {
            PX_BI_FacturaDetalleB::insert($arrayInsert);
        } else {
            PX_BI_FacturaDetalle::insert($arrayInsert);
        }
    }

    public function consolidacion(Request $request)
    {
        $mes = $request->mes;
        $tipo = $request->tipo;
        $anio = $request->anio;
        $urlReturn = "/pointex/bi/ventas/cargadas?anio=$anio&mes=$mes";
        if (strpos($tipo, "ZPBE") === false) {
            $sqlUnion = "declare @anio int; set @anio = $anio;
                    declare @mes int; set @mes = $mes;
                    insert into PX_BI_Ventas (IdPais, IdEntidad, IdProducto,
                    Fecha,Unidades, Ventas100, CIF, Venta97, Vencidos, DescBon, VentaNeta)
                    select c.IdPais, c.IdDistribuidor, c.IdProducto,
                    CONVERT(date, CONCAT(@anio,'-',@mes,'-01')) fecha ,c.Unidades,
                    c.ventas100, c.Inc, c.Venta97, c.Vencidos, c.Descu,
                    c.Venta97-(c.Descu+c.Vencidos) VentaNeta
                    from V_VentasConsolidado c
                    where YEAR(c.Fecha) = @anio and MONTH(c.Fecha) = @mes";
            $insertado = DB::insert(DB::raw($sqlUnion));
            $mensajeReturn = ["Tipo" => "error", "Descripcion" => "Lo datos no pudieron almacenarse en el consolidado
            por favor comuníquese con el administrador del sistema"];
            if ($insertado) {
                $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Datos almacenados correctamente"];
                $urlReturn = "/pointex/bi/ventas/cif?anio=$anio&mes=$mes";
            }
            session()->push('msg', $mensajeReturn);
        } else {
            $mensajeReturn = ["Tipo" => "success", "Descripcion" => "ZPBE insertado con exito"];
            $urlReturn = "/pointex/bi/ventas/cif?anio=$anio&mes=$mes";
            session()->push('msg', $mensajeReturn);
        }

        return redirect($urlReturn);
    }

    public function cif(Request $request)
    {
        $dataPersona = $this->infoUserLog->Persona;
        $usuarioLogueado = $this->idUsuarioCreacion;
        $request = $this->UrlToData($request);
        $msg = session()->get("msg");
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true, "DatePicker" => true, "Switch" => true];
        $request = $this->UrlToData($request);

        $anio = $request->txtAnio ? $request->txtAnio : date("Y");
        $mes = $request->mes ? $request->mes : date("m");
        $titleMsg = "Ventas Sell In $mes-$anio";

        $stringSql = "select  * from [VW_VentaNeta2] where YEAR(Fecha) = $anio and  MONTH(Fecha) = $mes";
        $data = collect(DB::select($stringSql));
        $arrayPaises = $data->pluck("CodigoBI", "Codigo")->unique();
        $arrayEntidad = $data->pluck("NombreBI", "NombreBI")->unique();
        //$arrayProducto = $data->pluck("DescripcionSap", "CodigoSap")->unique();
        $arrayProducto = PX_GP_ProductoCodigos::from("PX_GP_ProductoCodigos as pc")
            ->leftJoin("PX_GP_Producto as p", "pc.IdProducto", "=", "p.Id")
            ->select(
                DB::raw("CONCAT(p.TipoPresentacion, pc.CodigoSap) as CodigoSap"),
                DB::raw("isnull(p.Presentacion, pc.DescripcionSap) as DescripcionSap")
            )
            ->get()
            ->pluck("DescripcionSap", "CodigoSap")
            ->unique();

        $cmbPaises = $this->SelectedUniversales(collect(["Paises" => $arrayPaises->toArray()]), $request->cmbPaises, false, [
            "class" => "form-control select2_single cmbPaises",
            "name" => "cmbPaises[]",
            "id" => "cmbPaises"
        ], false,
            true, true, true, false, false, false);

        $cmbEntidad = $this->SelectedUniversales(collect(["Entidad" => $arrayEntidad->toArray()]), $request->cmbEntidad, false, [
            "class" => "form-control select2_single cmbEntidad",
            "name" => "cmbEntidad[]",
            "id" => "cmbEntidad"
        ], false,
            true, true, true, false, false, false);

        $cmbProducto = $this->SelectedUniversales(collect(["Producto" => $arrayProducto->toArray()]), $request->cmbProducto, false, [
            "class" => "form-control select2_single cmbProducto",
            "name" => "cmbProducto[]",
            "id" => "cmbProducto"
        ], false,
            true, true, true, false, false, false);
        $arrayPaisesNombre = PX_SIS_Pais::select("Id", "Codigo")
            ->whereIn("Id", $data->pluck("IdPais")
                ->unique()
                ->toArray())
            ->get()->pluck("Codigo", "Id");
        return view("Sistema.Pointex.Modulo.BI.Ventas.Bonificaciones.index_Sel_In", get_defined_vars());
    }

    /**
     * arma quueries
     * @param $anio
     * @param $funcion
     * @param $columnas
     * @return string
     */
    public function retornaStr($anio, $funcion, $columnas)
    {
        $columnasVal = "
SUM(v.Ene) as [Ene],
SUM(v.Feb) as [Feb],
SUM(v.Mar) as [Mar],
SUM(v.Abr) as [Abr],
SUM(v.May) as [May],
SUM(v.Jun) as [Jun],
SUM(v.Jul) as [Jul],
SUM(v.Ago) as [Ago],
SUM(v.Sep) as [Sep],
SUM(v.Oct) as [Oct],
SUM(v.Nov) as [Nov],
SUM(v.Dic) as [Dic],";
        $columnasVal0 = "
0 as [Ene],
0 as [Feb],
0 as [Mar],
0 as [Abr],
0 as [May],
0 as [Jun],
0 as [Jul],
0 as [Ago],
0 as [Sep],
0 as [Oct],
0 as [Nov],
0 as [Dic],
        ";
        $arrayARecorre = [
            [
                "function" => "GetLEByAnio",
                "Tipo" => "LE",
                "anio" => 2020,
            ]
        ];
        $posiciones = count($arrayARecorre);
        $strConsulta = "";

        $arrayMese = [
            0 => "Ene",
            1 => "Feb",
            2 => "Mar",
            3 => "Abr",
            4 => "May",
            5 => "Jun",
            6 => "Jul",
            7 => "Ago",
            8 => "Sep",
            9 => "Oct",
            10 => "Nov",
            11 => "Dic",
        ];
        $firstCol = "";
        foreach ($arrayARecorre as $v) {
            $anioInt = $v["anio"];
            $anioTipo = $v["Tipo"];
            $anioFor = $v["anio"];
            $tipoFor = $v["Tipo"];
            if ($anioInt == 2017) {
                foreach ($arrayMese as $va) {
                    $firstCol .= "SUM(v.$va) as [$va$anioTipo$anioInt],";
                }
            } else {
                foreach ($arrayMese as $va) {
                    $firstCol .= "0 as [$va$anioTipo$anioInt],";
                }
            }
            $firstCol .= "'' as fin$anioFor$tipoFor, ";
        }
        $groupCol = "";
        foreach ($arrayARecorre as $v) {
            $anioInt = $v["anio"];
            $anioTipo = $v["Tipo"];
            $anioFor = $v["anio"];
            $tipoFor = $v["Tipo"];
            foreach ($arrayMese as $va) {
                $groupCol .= " SUM(pv.$va$anioTipo$anioInt) as $va$anioTipo$anioInt,";
            }
        }
        dump($groupCol);


        foreach ($arrayARecorre as $k => $v) {
            $anio = $v["anio"];
            $columnasValInt = "";

            for ($i = 0; $i < $posiciones; $i++) {
                $anioFor = $arrayARecorre[$i]["anio"];
                $tipoFor = $arrayARecorre[$i]["Tipo"];
                if ($i == $k) {
                    $columnasValInt .= "$columnasVal '' as fin$anioFor$tipoFor, ";
                } else {
                    $columnasValInt .= "$columnasVal0 '' as fin$anioFor$tipoFor, ";
                }
            }
            $arrayCol = array_map(function ($v) {
                return trim(preg_replace('/\s\s+/', ' ', $v));
            }, explode(",", $columnasValInt));
            $stringCol = collect(array_filter($arrayCol))->join(', ');
            $strConsulta .= $this->retornaStr($anio, $v["function"], $stringCol);
        }

        echo $strConsulta;

        return "select
pc.CodigoSap [SKU CODE FROM ENTITY SYSTEM (ORIGINAL)],
pc.CodigoSap [SKU CODE FROM ENTITY SYSTEM (FINAL)],
 pa.[SKU MATERIAL _DESCRIPTION ENTITY SYSTEM]
, pa.[COUNTRY]
, pa.[TYPE ]
, pa.[UoM]
, pa.[GEO_REGION]
, pa.[ENTITY]
, pa.[REGION B]
, pa.[SAP CODE_(from HQ system) supplied by CHEMO Plants]
, pa.[SAP Description - only for CHEMO sourced_(from HQ system) suppli]
, pa.[MATERIAL TYPE Entity System]
, pa.[COMMERCIAL NAME ]
, pa.[MOLECULE (API)]
, pa.[MOLECULE (API)1]
, pa.[MOLECULE API from SAP]
, pa.[TERAPHEUTIC AREA (TA)]
, pa.[ATC CODE]
, pa.[MANUFACTURING_Technology]
, pa.[MANUFACTURING_Standard Units_e#g# Number of Tablets]
, pa.[MARKETING_Conversion Concept to SU]
, pa.[MARKETING_Standard Units (SU)_e#g# Number of Cycles]
, pa.[PRODUCT SOURCE]
, pa.[INVOICER]
, pa.[SUPPLIER],
$columnas
from
[dbo].[$funcion]($anio) as v
left join PX_GP_ProductoCodigos pc on v.IdProducto = pc.Id
left join PX_GP_ProductoAnexo pa on pc.Id = pa.IdProducto
group by pc.CodigoSap,
pc.CodigoSap,
 pa.[SKU MATERIAL _DESCRIPTION ENTITY SYSTEM]
, pa.[COUNTRY]
, pa.[TYPE ]
, pa.[UoM]
, pa.[GEO_REGION]
, pa.[ENTITY]
, pa.[REGION B]
, pa.[SAP CODE_(from HQ system) supplied by CHEMO Plants]
, pa.[SAP Description - only for CHEMO sourced_(from HQ system) suppli]
, pa.[MATERIAL TYPE Entity System]
, pa.[COMMERCIAL NAME ]
, pa.[MOLECULE (API)]
, pa.[MOLECULE (API)1]
, pa.[MOLECULE API from SAP]
, pa.[TERAPHEUTIC AREA (TA)]
, pa.[ATC CODE]
, pa.[MANUFACTURING_Technology]
, pa.[MANUFACTURING_Standard Units_e#g# Number of Tablets]
, pa.[MARKETING_Conversion Concept to SU]
, pa.[MARKETING_Standard Units (SU)_e#g# Number of Cycles]
, pa.[PRODUCT SOURCE]
, pa.[INVOICER]
, pa.[SUPPLIER] UNION all ";
    }
}
