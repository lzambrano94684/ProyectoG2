<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_ProductoSAP extends Model
{
    protected $table='PX_GP_ProductoSAP';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdDistProdReg','FechaCreacion','Estado');
    public $incrementing = true;
    public $timestamps=false;

    public function DistProdReg()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_DistProdRegulatorio','IdDistProdReg','Id');
    }

    public function Ventas()
    {
        return $this->hasMany('App\Modelos\CIF\PX_CIF_Ventas', 'IdCodigoSap', 'Id');
    }
}
