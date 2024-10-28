<?php

namespace App\Imports;
use App\Modelos\Finanzas\KSB\KSB;
use App\Modelos\Finanzas\KSB\PX_FIN_KSB;
use App\Modelos\FINANZAS\PX_FIN_CentroCosto;
use App\Modelos\Finanzas\PX_FIN_CuentaBpcSap;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\{Importable,ToModel,WithHeadingRow,FromQuery,WithMapping};



class ImportarKSB implements ToModel,WithHeadingRow
{
    use Importable;

    var $idUsuarioCreacion;
    var $count = 0;
    var $baseController;


    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */


    public function __construct($idUsuarioCreacion = null, $baseController)
    {
        try {
            $this->baseController = $baseController;
            $this->idUsuarioCreacion = $idUsuarioCreacion;
        } catch (\Exception $e) {

        }

    }
    public function model(array $row)
    {

        $CodBPC = $row['cuenta_bpc'];
        $IdCentro = PX_FIN_CentroCosto::where("Cod",$row['centro_coste'])->select("Id")->get()->pluck("Id");
        $IdCuentaContable = PX_FIN_CuentaBpcSap::Select("Id")->Where("CodSap",$row['clcoste'])->Where( function ($query) use ($CodBPC){
          $query->where("CodBPC", '=', $CodBPC)
              ->orWhereNull("CodBPC");
      })->get()->pluck("Id");
        try{
          return new PX_FIN_KSB([

              'IdCentro' => empty($IdCentro[0])? null :$IdCentro[0] ,
              'IdCuenta' => empty($IdCuentaContable[0]) ? null : $IdCuentaContable[0],
              'CodCuentaCompartida' => $row['ctacp'],
              'CuentaCompartida' => $row['denominacion_cuenta_contrapartida'],
              'NoDocumento' => $row['no_doc'],
              'OperarioRef' => $row['operref'],
              'Anio' => (int)$row['ano'],
              'Usuario' => $row['usuario'],
              'CabeceraDocumento' => $row['texto_de_cabecera_de_documento'],
              'TV' => (int)$row['tv'],
              'EjecucionRef' => (int)$row['ejrf'],
              'Per' => $row['per'],
              'DocCompra' => $row['doccompr'],
              'Pos' => $row['pos'],
              'DescripcionPedido' => $row['texto_de_pedido'],
              'DescripcionMaterial' => $row['texto_breve_de_material'],
              'Denominacion' => $row['denominacion'],
              'Ce' => $row['ce'],
              'Material' => $row['material']==""?null:$row['material'],
              'ImputacionAuxiliar1' => $row['imputacion_auxiliar_1'],
              'NumeroDocRef' => $row['nodocref'],
              'SocGLA' => $row['socgla'],
              'ImporteML3' => floatval($row['importe_ml3']),
              'MFrte' => $row['mfrte'],
              'CtdReg' => floatval($row['ctdreg']),
              'UCc' => $row['ucc'],
              'FechaDoc' => date("Ymd", $this->baseController->fromExcelToLinux((int)trim($row['fecha_doc']))),
              'FechaContabilidad' => date("Ymd", $this->baseController->fromExcelToLinux((int)trim($row['fecontab']))),
              'FechaVal' => date("Ymd", $this->baseController->fromExcelToLinux((int)trim($row['feval']))),
              'FechaCreacion',
              'FechaModificacion',
              'UsuarioCreacion'=>$this->idUsuarioCreacion,
              'UsuarioModificacion',
          ]);
      }catch (\Illuminate\Database\QueryException  $e){
          Log::error("Error al insert data: " . $e->getMessage());
      }
    }




}
