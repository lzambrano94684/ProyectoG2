<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_ProductoMarketAccess extends Model
{
    protected $table='PX_GP_ProductoMarketAccess';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'IdPais',
        "IdDistribuidor",
        "Fecha",
        "UsuarioCreacion",
        "UsuarioModificacion",
        "FechaCreacion",
        "FechaModificacion"
    );
    public $incrementing = true;
    public $timestamps=false;
}
