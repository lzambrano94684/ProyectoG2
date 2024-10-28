<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_TipoPresentacion extends Model
{
    protected $table='PX_GP_TipoPresentacion';
    protected $primaryKey = 'Id';
    protected $fillable = array('Nombre','Descripcion', 'FechaCreacion','Estado');
    public $incrementing = true;
    public $timestamps=false;

    public function PresentacionProducto()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_GP_PresentacionProducto','IdTipoPresentacion','Id');
    }

}
