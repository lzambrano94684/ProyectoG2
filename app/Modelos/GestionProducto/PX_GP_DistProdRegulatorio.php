<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_DistProdRegulatorio extends Model
{
    protected $table='PX_GP_DistProdRegulatorio';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'IdProducto',
        'IdForma',
        'IdPais',
        'IdRegistro',
        'IdEstadoDist',
        'IdFabricante',
        'IdClasFranq',
        'IdProyecto',
        'IdFranquicia',
        'IdRepLegal',
        'FechaProduccion',
        'IdPropietario',
        'IdTitutar',
        'FechaCreacion',
        'Estado');
    public $incrementing = true;
    public $timestamps=false;

    public function ComposicionProducto()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_GP_ComposicionProducto','IdDisProdReg','Id');
    }

    public function PresentacionProducto()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_GP_PresentacionProducto','IdDistProdReg','Id');
    }

    public function ProductoSAP()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_GP_ProductoSAP','IdDistProdReg','Id');
    }

    public function Producto()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_Producto','IdProducto','Id');
    }

    public function FormaFarmaceutica()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_FormaFarmaceutica','IdForma','Id');
    }

    public function Pais()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_PAIS','IdPais','Id');
    }

    public function RegistroSanitario()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_RegistroSanitario','IdRegistro','Id');
    }

    public function EstadoDistReg()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\GP_EstadoDistReg','IdEstadoDist','Id');
    }

    public function Fabricante()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_ENTIDAD','IdFabricante','Id')->where("fabricante","=","S");
    }

    public function Franquicia()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_Franquicia','IdFranquicia','Id');
    }

    public function FiguraLegal()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_ENTIDAD','IdFiguraLegal','Id')->where("relacion","=","I");
    }

    public function Proyecto()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_Proyecto','IdProyecto','Id');
    }

    public function ClasFranq(){
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_ClasFranq','IdClasFranq','Id');
    }
}
