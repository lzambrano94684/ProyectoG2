<?php

namespace App\Modelos\VisitaMedica;
use Illuminate\Database\Eloquent\Model;

class MD_TiempoNP extends Model
{
    protected $table = 'MD_TiempoNP';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "Nombre",
        "Icono",
        "FechaCreacion",
        "UsuarioCreacion",
        "FechaModificacion",
        "UsuarioModificacion"

    );
    public $incrementing = true;
    public $timestamps = false;
}
