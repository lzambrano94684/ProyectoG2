<?php

namespace App\Imports;

use App\Modelos\GestionProducto\PX_GP_ProductoCodigos;
use App\Modelos\SalesExpenses\PX_SEX_EncabezadoDoc;
use App\Modelos\SalesExpenses\PX_SEX_TipoGasto;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpParser\Node\Stmt\DeclareDeclare;

class ImportHistorico implements ToModel
{
    var $idUsuarioCreacion;
    var $count = 0;
    public $repetidos = 0;
    public $guardados = 0;
    public $dataExcel = [];
    public $dataExcelRepetidos = [];
    public $idEstatus;
    public $tipoDoc;


    public function __construct($idUsuarioCreacion = null, $idEstatus)
    {
        try {
            $this->idEstatus = $idEstatus;
            $this->idUsuarioCreacion = $idUsuarioCreacion;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $tipoDoc = 1009;
        $this->count++;
        $valorEncabezado = trim($row["NO_NOTA"]);
        $FechaDoc = trim($row["FECHA_EMISION"]);
        $fechaIngreso = trim($row["FECHA_INGRESO"]);
        $fechaReconocimiento = trim($row["MES"]);
        $nombreEncabezado = "Referencia";
        $idProducto = $row["IdProducto"];

        $idTipoGasto = trim($row["IdTipoGasto"]);
        $idTipoDocumento = 1009;
        $idPais = trim($row["IdPais"]);
        $anio = 2020;
        $idDistribuidor = $row["IdDistribuidor"];
        $ValorTipoMoneda = $row["Tipo_Cambio"];
        $modelEncabezado = $this->verifyInTableEncabezadoId( $idTipoGasto, $valorEncabezado,$idPais,$fechaReconocimiento,$anio,$idDistribuidor);
        //dd($modelEncabezado);
        if (!$modelEncabezado) {

            $tablaEncabezado = "PX_SEX_EncabezadoDoc";
            //dd($FechaDoc, $fechaIngreso, $fechaReconocimiento);
            $arrayInsertEncabezado = [
                'IdTipoDoc' => (int)$idTipoDocumento,
                'Anio' => (int)$anio,
                'IdTipoGasto' => $idTipoGasto,
                'IdPais' => (int)$idPais,
                'IdDistribuidor' => (int)$idDistribuidor,
                'IdTipoMoneda' => 22,
                'Referencia' => (string)$valorEncabezado,
                'ValorTipoMoneda' => $ValorTipoMoneda,
                'FechaDoc' => (string)$FechaDoc,
                'FechaIngreso' => (string)$fechaIngreso,
                'FechaReconocimeinto' => (string)$fechaReconocimiento,
                'FechaCreacion' => str_replace("-","",$fechaIngreso),
            ];
            $modelEncabezado = $this->insertIntTable($tablaEncabezado, $nombreEncabezado, $valorEncabezado, $arrayInsertEncabezado);
            //dd($modelEncabezado);

            $this->dataExcel[] = [
                "Referencia" => $valorEncabezado,
                "tipoDoc" => $tipoDoc,
            ];
        }

        $tablaDetalleDoc = "PX_SEX_DetalleDoc";
        $nombreDetalleDoc = "IdEncabezado";
        if ($idProducto) {
            $totalMonedaLocal = $row["TOTAL_M_L"];
            $totalUSD = $row["TOTAL_USD"];
            $cantidad = $row["UNIDADES"];
            $estatus = $row["STATUS"];
            $arrayInsertDetalle = [
                'IdEncabezado' => $modelEncabezado->Id,
                'IdProducto' => $idProducto,
                'PrecioML' => $totalMonedaLocal,
                'IdEstatus' => $estatus,
                'ImporteML' => $totalUSD,
                'Cantidad' => $cantidad

            ];
            $this->insertIntTable($tablaDetalleDoc, $nombreDetalleDoc, $modelEncabezado->Id, $arrayInsertDetalle);
            $this->guardados++;
        }else{
            dd($idProducto, $row, $this->guardados);
        }
    }

    public function model_(array $row)
    {
        /* $arrayMesExcel = ['NOV´19' => '20191101',
             'NOV' => '20191101',
             'ENE' => '20190101',
             'FEB' => '20190201',
             'MAR' => '20190301',
             'ABR' => '20190401',
             'SEP' => '20190901',
             'MAY' => '20190501',
             'JUN' => '20190601',
             'JUL' => '20190701',
             'AGO' => '20190801',
             'OCT' => '20191001',
             'DIC' => '20191201',
             'DIC´19' => '20191201',
             'NOV´19' => '20191101',
             'OCT´19' => '20191001',
             'may-19' => '20190501',
             'jun-19' => '20190601',
             'jul-19' => '20190701',
             'ago-19' => '20190801',
             'dic-18' => '20181201',
             'mar-19' => '20190301',
             'abr-19' => '20190401',
             'sep-19' => '20190901',
             'oct-19' => '20191001',
             'nov-19' => '20191101',
             'dic-19' => '20191201',
             '12-2019' => '20191201',
             '01-2020' => '20200101',
             '11-2019' => '20191101',
             '08-2019' => '20190801',
             'JUN' => '20190601',
             'JUL' => '20190701',
             'AGO' => '20190801',
             'SEP' => '20190901',
             "OCT'19" => '20191001',
             'NOV´19' => '20191101',
             'DIC´19' => '20191201',
             1 => '20200101',
             'OCT' => '20191001',
             'NOV' => '20191101',
             'DIC' => '20191201',

         ];*/
        $tipoDoc = trim($row[21]);
        $this->count++;
        $valorEncabezado = trim($row[6]);
        $modelEncabezado = null;
        $modelDetalleDoc = null;
        //try {
        //dd($row[3]);
        #$FechaDoc = str_replace('2020', '2019', $arrayMesExcel[trim($row[3])]);
        #$fechaIngreso = str_replace("2020", "2019",$arrayMesExcel[strtoupper(trim($row[4]))]);
        #$FechaDoc = date("Y-m-d", strtotime(implode("-", array_reverse(explode("/", trim($row[3]))))));
        #$fechaIngreso = $arrayMesExcel[trim($row[4])];
        #$fechaReconocimiento = $arrayMesExcel[strtoupper(trim($row[5]))];
        $FechaDoc = trim($row[3]);
        $fechaIngreso = trim($row[4]);
        $fechaReconocimiento = trim($row[5]);
        //$fechaIngreso = $fechaIngreso > $fechaReconocimiento ? str_replace("2020", "2019", $fechaIngreso) : $fechaIngreso;
        $tipoGasto = trim($row[16]);
        $tipoGastoFinanciero = trim($row[18]);
        $descuentosVencidos = trim($row[19]);
        $tablaEncabezado = "PX_SEX_EncabezadoDoc";
        $nombreEncabezado = "Referencia";
        $idTipoGasto = $this->verifyInTableTipoGasto($tipoGasto, $tipoGastoFinanciero, $descuentosVencidos);
        $idTipoDocumento = $this->getIdFK("PX_SEX_TipoDocumento", "Codigo", $tipoDoc);
        $idPais = $this->getIdFK("PX_SIS_Pais", "Codigo", $row[0]);
        $anio = date("Y");
        $idDistribuidor = $this->getIdFK("PX_SIS_Entidad", "Nombre", $row[1]);
        $modelEncabezado = $this->verifyInTableEncabezado($idTipoDocumento, $idTipoGasto, $valorEncabezado,$idPais,$fechaReconocimiento,$anio,$idDistribuidor);
        if (!$modelEncabezado) {
            $arrayInsertEncabezado = [
                'IdTipoDoc' => $idTipoDocumento,
                'Anio' => $anio,
                'IdTipoGasto' => $idTipoGasto,
                'IdPais' => $idPais,
                'IdDistribuidor' => $idDistribuidor,
                'IdTipoMoneda' => $this->getIdFK("PX_SEX_Moneda", "Nombre", "USD"),
                'Referencia' => $valorEncabezado,
                'Compania' => trim($row[14]),
                'ValorTipoMoneda' => trim($row[12]),
                'FechaDoc' => $FechaDoc,
                'FechaIngreso' => $fechaIngreso,
                'FechaReconocimeinto' => $fechaReconocimiento,
            ];
            //dd($arrayInsertEncabezado,$fechaIngreso,$fechaReconocimiento,strtoupper(trim($row[4])),strtoupper(trim($row[5])));
            $modelEncabezado = $this->insertIntTable($tablaEncabezado, $nombreEncabezado, $valorEncabezado, $arrayInsertEncabezado);

            $this->dataExcel[] = [
                "Referencia" => $valorEncabezado,
                "tipoDoc" => $tipoDoc,
            ];
        }
        $tablaDetalleDoc = "PX_SEX_DetalleDoc";
        $nombreDetalleDoc = "IdEncabezado";
        $codigoSap = trim($row[7]);
        $descSap = trim($row[9]);
        $idProducto = $this->getIdFKProducto($codigoSap, $descSap, $row);
        if ($idProducto) {
            $importeMl = (float)trim(str_replace(["$",","],"",$row[13]));
            $precioML = (float)trim(str_replace(["$",","],"",$row[11]));
            $cantidad = (float)trim(str_replace(["$",","],"",$row[10]));
            $arrayInsertDetalle = [
                'IdEncabezado' => $modelEncabezado->Id,
                'IdProducto' => $idProducto,
                'PrecioML' => $precioML,
                'IdEstatus' => trim($row[15]) == "TRASLADOS" ? 1002 : 2,
                'ImporteML' => $importeMl,
                'Cantidad' => $cantidad

            ];
            /*if (is_numeric($row[10])){
                $arrayInsertDetalle["Cantidad"] = $row[10];
            }*/

            $insertDetalle = $this->insertIntTable($tablaDetalleDoc, $nombreDetalleDoc, $modelEncabezado->Id, $arrayInsertDetalle);

            $this->guardados++;
        }

        /*} catch (\Exception $e) {
            dump($e->getMessage(), $row, $this->count);
        }*/
    }

    public function getIdFK($tabla, $nombre = "Nombre", $valor)
    {
        $selectTable = $this->verifyNameInTable($tabla, $nombre, $valor);
        $arrayInsert = [];
        if ($tabla == "PX_SIS_Pais") {
            $arrayInsert = [
                "Nombre" => trim($valor),
                "Codigo" => trim($valor),
                "UsuarioCreacion" => $this->idUsuarioCreacion
            ];
        }
        return !$selectTable ? $this->insertIntTable($tabla, $nombre, $valor, $arrayInsert)->Id : $selectTable->Id;
    }

    public function getIdFKProducto($codSap, $descSap, $row)
    {
        $nombreCodigos = "CodigoSap";
        $valorCodigos = trim($codSap);
        $idProducto = PX_GP_ProductoCodigos::select("IdProducto")->where($nombreCodigos, $valorCodigos)->first();
        if (isset($idProducto->IdProducto)) {
            $idProducto = $idProducto->IdProducto;
        } else {
            $idProducto = PX_GP_ProductoCodigos::select("IdProducto")->where("CodigoBarras", $valorCodigos)->first();
            $idProducto = $idProducto->IdProducto;
            //dump($nombreCodigos, $valorCodigos, $row);
        }
        return $idProducto;
    }

    private function verifyNameInTable($tabla, $nombre, $valor, $inicio = 0)
    {
        $campo = "RTRIM(LTRIM(UPPER(" . trim($nombre) . "))) COLLATE Latin1_General_CI_AI";
        $operador = "=";
        if ($tabla == "PX_GP_Marca" && $inicio) {
            $campo = "RTRIM(LTRIM(UPPER(" . trim($nombre) . "))) COLLATE Latin1_General_CI_AI";
            $operador = "like";
            $valor = strtoupper(trim("%$valor%"));
        }
        return DB::table(trim($tabla))
            ->select(DB::raw("Id"))
            ->where(DB::raw($campo), $operador, $valor)
            ->orderBy("Id", "desc")
            ->first();
    }

    private function verifyInTableEncabezadoId($idTipoGasto, $referencia,$idPais,$mes, $anio, $idDistribuidor)
    {
        //$mes = substr($mes, 4, 2);
        return PX_SEX_EncabezadoDoc::select(DB::raw("Id"))
            ->where( 'Referencia', $referencia)
            //->where( 'IdTipoDoc', $idTipoDoc)
            ->where( 'IdTipoGasto', $idTipoGasto)
            ->where( 'IdPais', $idPais)
            ->where( 'IdDistribuidor', $idDistribuidor)
            ->where( 'Anio', $anio)
            ->where( DB::raw("month(FechaReconocimeinto)"), DB::raw("month('$mes')"))
            ->orderBy("Id", "desc")
            ->first();
    }

    private function verifyInTableEncabezado($idTipoDoc, $idTipoGasto, $referencia,$idPais,$mes, $anio, $idDistribuidor)
    {
        $mes = substr($mes, 4, 2);
        return PX_SEX_EncabezadoDoc::select(DB::raw("Id"))
            ->where( 'Referencia', $referencia)
            //->where( 'IdTipoDoc', $idTipoDoc)
            ->where( 'IdTipoGasto', $idTipoGasto)
            ->where( 'IdPais', $idPais)
            ->where( 'IdDistribuidor', $idDistribuidor)
            ->where( 'Anio', $anio)
            ->where( DB::raw("month(FechaReconocimeinto)"), $mes)
            ->orderBy("Id", "desc")
            ->first();
    }

    private function verifyInTableTipoGasto($tipoGasto, $tipoGastoFinanciero, $descuentosVencidos)
    {
        $query =PX_SEX_TipoGasto::select(DB::raw("Id"))
            ->where( 'Gasto', $tipoGasto)
            ->where( 'GastoFinanciero', $tipoGastoFinanciero)
            ->where( 'DescuentoVencido', $descuentosVencidos)
            ->orderBy("Id", "desc")
            ->first();
        return isset($query->Id) ? $query->Id : null;
    }

    public function insertIntTable($tabla, $nombre, $valor, $arrayInsert = [])
    {
        if ($tabla == "PX_SEX_EncabezadoDoc" || $tabla == "PX_SEX_DetalleDoc" ){
            if (count($arrayInsert) > 0) {
                DB::table(trim($tabla))->insert($arrayInsert);
            } else {
                DB::table(trim($tabla))->insert([
                    trim($nombre) => trim($valor),
                    "UsuarioCreacion" => $this->idUsuarioCreacion
                ]);
            }
            DB::commit();
        }else{
            dd($tabla, $nombre, $valor, $arrayInsert);
        }

        return $this->verifyNameInTable($tabla, $nombre, $valor);
    }

    private function convertString($value)
    {
        return abs(trim($value));
    }
}
