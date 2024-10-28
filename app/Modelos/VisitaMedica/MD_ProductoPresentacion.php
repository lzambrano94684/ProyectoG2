<?php

namespace App\Modelos\VisitaMedica;

use Illuminate\Database\Eloquent\Model;

class MD_ProductoPresentacion extends Model
{
    protected $table = 'MD_ProductoPresentacion';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "IdEntidad",
        "Distribuidor",
        "IdProducto",
        "SAP",
        "Presentacion",
        "Tipo",
        "FechaCreacion",
        "FechaModificacion",
        "UsuarioCreacion",
        "UsuarioModificacion"

    );
    public $incrementing = true;
    public $timestamps = false;
}
