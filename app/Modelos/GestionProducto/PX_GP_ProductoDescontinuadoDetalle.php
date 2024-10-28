<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_ProductoDescontinuadoDetalle extends Model
{
    protected $table='PX_GP_ProductoDescontinuadoDetalle';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'IdDescontinuado',
        "IdProducto",
        "IdEstado",
        "Observaciones",
        "UsuarioCreacion",
        "UsuarioModificacion",
        "FechaCreacion",
        "FechaModificacion",
        "FechaInicio",
        "FechaFinalizacion"
    );
    public $incrementing = true;
    public $timestamps=false;
}

