<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_PresentacionProducto extends Model
{
    protected $table='PX_GP_PresentacionProducto';
    protected $primaryKey = 'Id';
    protected $fillable = array('Nombre','Descripcion','Cantidad','IdTipoPresentacion','IdDistProdReg','VidaUtil','FechaCreacion','Estado');
    public $incrementing = true;
    public $timestamps=false;

    public function ArtesProdPresentacion()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_GP_ArteProdPresentacion','IdPresentacion','Id');
    }

    public function CodigoProducto()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_GP_CodigoProducto','IdPresentacion','Id');
    }

    public function TipoPresentacion()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_TipoPresentacion','IdTipoPresentacion','Id');
    }

    public function DistProdReg()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_DistProdRegulatorio','IdDistProdReg','Id');
    }

    public function Ventas()
    {
        return $this->hasMany('App\Modelos\CIF\PX_CIF_Ventas', 'IdPresentacion', 'Id');
    }
}
