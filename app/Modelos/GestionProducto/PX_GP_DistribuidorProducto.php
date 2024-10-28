<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_DistribuidorProducto extends Model
{
    protected $table='PX_GP_DistribuidorProducto';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdDisProdReg','IdDistribuidor','FechaCreacion','Estado');
    public $incrementing = true;
    public $timestamps=false;

    public function DistProdRegulatorio()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_DistProdRegulatorio','IdDisProdReg','Id');
    }

    public function Distribuidor()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_ENTIDAD','IdFabricante','Id')->where("fabricante","=","N");
    }

    public function Ventas()
    {
        return $this->hasMany('App\Modelos\CIF\PX_CIF_Ventas', 'IdDistribuidor', 'Id');
    }
}
