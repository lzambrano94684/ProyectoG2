<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_RegistroSanitario extends Model
{
    protected $table = 'PX_GP_RegistroSanitario';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'IdEstatus',
        'IdTitular',
        'IdRepresentante',
        'IdPais',
        'IdModalidadVenta',
        'IdNotificacion',
        'IdFormaFarmaceuticaTipo',
        'IdFormaFarmaceutica',
        'IdPaisTitular',
        'IdFabricante',
        'IdPaisFabricante',
        'IdAcondicionador',
        'IdPaisAcondicionador',
        'IdGrupoTerapeutico',
        'IdViaAdministracion',
        'Nombre',
        'NoRegistroSanitario',
        'FechaVencimiento',
        'TramiteControlEstatal',
        'FechaControlEstatal',
        'PermisoComercializacion',
        'PermisoComercializacionJust',
        'EstimadoObtencion',
        'Descripcion',
        'VidaUtil',
        'URLRegistro',
        'UsuarioCreacion',
        'UsuarioModificacion'
    );
    public $incrementing = true;
    public $timestamps = false;

    public function TagTramiteControlEstatal()
    {
        if ($this->TramiteControlEstatal ==="0"){
            return '<p class="text-danger">No</p>';
        }elseif ($this->TramiteControlEstatal ==="1"){
            return '<p class="text-success">Si</p>';
        }else{
            return 'N/A';
        }
    }

    public function TagPermisoComercializacion()
    {
        if ($this->PermisoComercializacion ==="0"){
            return '<p class="text-danger">No</p>';
        }elseif ($this->PermisoComercializacion ==="1"){
            return '<p class="text-success">Si</p>';
        }else{
            return 'N/A';
        }
    }

    public function VidaUtilTbl()
    {
        return $this->VidaUtil !== null ?  $this->singleOrPlural((int)$this->VidaUtil, "Mes", "Meses") : "N/A";
    }

    public function IdEstatusName($arrayEstatus)
    {
        return isset($arrayEstatus[$this->IdEstatus]) ? trim($arrayEstatus[$this->IdEstatus]) : "N/A";
    }

    public function singleOrPlural($amount, $singular, $plural)
    {
        return (abs($amount)>=2 || $amount === 0
            ? $amount.' '.$plural
            : $amount.' '.$singular
        );
    }

    public function fechaVencimientoCorrect()
    {
        $fechaDecode = null;
        if ($this->FechaVencimiento){
            $fecha = explode("-",$this->FechaVencimiento);
            $fechaDecode = "$fecha[2]/$fecha[1]/$fecha[0]";
        }
        return $fechaDecode;
    }
}
