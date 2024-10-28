<?php

namespace App\Imports;

use App\Modelos\GestionProducto\PX_GP_ProductoCodigos;
use App\Modelos\SalesExpenses\PX_SEX_EncabezadoDoc;
use App\Modelos\SalesExpenses\PX_SEX_TipoGasto;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportSalesCI implements ToModel
{
    var $idUsuarioCreacion;
    var $count = 0;
    public $repetidos=0;
    public $guardados=0;
    public $dataExcel = [];
    public $dataExcelRepetidos = [];
    public $idEstatus;
    public function __construct($idUsuarioCreacion = null, $idEstatus)
    {
        try {
            $this->idEstatus = $idEstatus;
            $this->idUsuarioCreacion = $idUsuarioCreacion;
        } catch (\Exception $e) {

        }

    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $arrayMesExcel = ['NOV´19' => '2019-11-1',
            'NOV' => '2019-11-1',
            'ENE' => '2019-1-1',
            'FEB' => '2019-2-1',
            'MAR' => '2019-3-1',
            'ABR' => '2019-4-1',
            'SEP' => '2019-9-1',
            'MAY' => '2019-5-1',
            'JUN' => '2019-6-1',
            'JUL' => '2019-7-1',
            'AGO' => '2019-8-1',
            'OCT' => '2019-10-1',
            'DIC' => '2019-12-1',
            'DIC´19' => '2019-12-1',
            'NOV´19' => '2019-11-1',
            'OCT´19' => '2019-10-1',
        ];
        $tipoDoc = trim($row[21]);
        $this->count++;
        $valorEncabezado = trim($row[3]);
        $modelEncabezado = null;
        $modelDetalleDoc = null;
        try {
            $fechaIngreso = $arrayMesExcel[strtoupper(trim($row[4]))];
            $fechaReconocimiento = $arrayMesExcel[strtoupper(trim($row[5]))];
            $tipoGasto = trim($row[16]);
            $tipoGastoFinanciero = trim($row[18]);
            $descuentosVencidos = trim($row[19]);
            $tablaEncabezado = "PX_SEX_EncabezadoDoc";
            $nombreEncabezado = "Referencia";
            $idTipoGasto = $this->verifyInTableTipoGasto($tipoGasto, $tipoGastoFinanciero, $descuentosVencidos);
            $idTipoDocumento = $this->getIdFK("PX_SEX_TipoDocumento", "Codigo", $tipoDoc);
            $idPais = $this->getIdFK("PX_SIS_Pais", "Codigo", $row[0]);
            $modelEncabezado = $this->verifyInTableEncabezado($idTipoDocumento, $idTipoGasto, $valorEncabezado,$idPais,$fechaReconocimiento);
            if (!$modelEncabezado) {
                $var = trim($row[3]);
                $date = str_replace('.', '-', $var);
                $FechaDoc = date('Y-d-m', strtotime($date));
                $arrayInsertEncabezado = [
                    'IdTipoDoc' => $idTipoDocumento,
                    'IdTipoGasto' => $idTipoGasto,
                    'IdPais' => $idPais,
                    'IdDistribuidor' => $this->getIdFK("PX_SIS_Entidad", "Nombre", $row[1]),
                    'IdTipoMoneda' => $this->getIdFK("PX_SEX_Moneda", "Nombre", "USD"),
                    'IdEstatus' => trim($row[15]) == "TRASLADOS" ?
                        $this->getIdFK("PX_SEX_EncabezadoEstatus", "Nombre", "Reconocimiento") :
                        $this->getIdFK("PX_SEX_EncabezadoEstatus", "Nombre", "Documento en Finanzas"),
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
            } else {
                $arrayInsertEncabezado = [];
                if (isset($fechaIngreso)){
                    $arrayInsertEncabezado = [
                        'FechaCreacion' => DB::raw("convert(datetime, '$fechaIngreso', 101)"),
                    ];
                }
                if (count($arrayInsertEncabezado)>0){

                    DB::update("update PX_SEX_EncabezadoDoc
                    set FechaCreacion = ".$arrayInsertEncabezado['FechaCreacion']."
                    where Id = ?", [$modelEncabezado->Id]);
                }

            }

            $tablaDetalleDoc = "PX_SEX_DetalleDoc";
            $nombreDetalleDoc = "IdEncabezado";
            $codigoSap = trim($row[7]);
            $descSap = trim($row[9]);
            $idProducto = $this->getIdFKProducto($codigoSap, $descSap, $row);
            if ($idProducto) {
                $importeMl = (float)trim(str_replace(["$",","],"",$row[13]));
                $precioML = (float)trim(str_replace(["$",","],"",$row[11]));
                $arrayInsertDetalle = [
                    'IdEncabezado' => $modelEncabezado->Id,
                    'IdProducto' => $idProducto,
                    'PrecioML' => $precioML,
                    'ImporteML' => $importeMl

                ];
                $this->insertIntTable($tablaDetalleDoc, $nombreDetalleDoc, $modelEncabezado->Id, $arrayInsertDetalle);
                $this->guardados++;
            }

        } catch (\Exception $e) {
            dump($e->getMessage(), $row, $this->count);
        }
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

    private function verifyInTableEncabezado($idTipoDoc, $idTipoGasto, $referencia,$idPais,$mes)
    {
        $mes = explode("-",$mes)[1];
        return PX_SEX_EncabezadoDoc::select(DB::raw("Id"))
            ->where( 'Referencia', $referencia)
            ->where( 'IdTipoDoc', $idTipoDoc)
            ->where( 'IdTipoGasto', $idTipoGasto)
            ->where( 'IdPais', $idPais)
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
        if (count($arrayInsert) > 0) {
            DB::table(trim($tabla))->insert($arrayInsert);
        } else {
            DB::table(trim($tabla))->insert([
                trim($nombre) => trim($valor),
                "UsuarioCreacion" => $this->idUsuarioCreacion
            ]);
        }
        DB::commit();
        return $this->verifyNameInTable($tabla, $nombre, $valor);
    }

    private function convertString($value)
    {
        return abs(trim($value));
    }
}
