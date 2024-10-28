<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_ProductoTercerizadoDetalle extends Model
{
    protected $table='PX_GP_ProductoTercerizadoDetalle';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'IdTercerizados',
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
