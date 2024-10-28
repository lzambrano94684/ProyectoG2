<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_FormaTipoPresentacion extends Model
{
    protected $table='PX_GP_FormaFarmaceuticaTipo';
    protected $primaryKey = 'Id';
    protected $fillable = array('Nombre','Descripcion','FechaCreacion','FechaModificacion','UsuarioCreacion','UsuarioModificacion');
    public $incrementing = true;
    public $timestamps=false;

    public function FormaFarmaceutica()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_FormaFarmaceutica','IdForma','Id');
    }

    public function TipoPresentacion()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_TipoPresentacion','IdTipoPresentacion','Id');
    }
}
