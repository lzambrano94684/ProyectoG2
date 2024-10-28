<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_CodigoProducto extends Model
{
    protected $table='PX_GP_CodigoProducto';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'IdPresentacion',
        'Descripcion',
        'Codigo',
        'FechaCreacion',
        'Estado');
    public $incrementing = true;
    public $timestamps=false;

    public function Presentacion()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_PresentacionProducto','IdPresentacion','Id');
    }
}
