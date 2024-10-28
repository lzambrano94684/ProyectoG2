<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_ProductoMarketAccessDetalle extends Model
{
    protected $table='PX_GP_ProductoMarketAccessDetalle';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'IdMarketAccess',
        "IdProducto",
        "IdEstado",
        "Observaciones",
        "UsuarioCreacion",
        "UsuarioModificacion",
        "FechaCreacion",
        "FechaModificacion",
        "FechaFinalizacion",
        "FechaInicio"
    );
    public $incrementing = true;
    public $timestamps=false;
}
