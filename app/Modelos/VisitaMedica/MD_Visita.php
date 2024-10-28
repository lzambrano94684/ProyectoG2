<?php


namespace App\Modelos\VisitaMedica;


use Illuminate\Database\Eloquent\Model;

class MD_Visita extends Model
{
    protected $table = 'MD_Visita';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "IdFichero",
        "IdTipoVisita",
        "Estado",
        "IdAcompa",
        "Descripcion",
        "Descripcion2",
        "Latitude",
        "Longitud",
        "FechaVisita",
        "HoraInicio",
        "HoraFin",
        "UsuarioCreacion",
        "UsuarioModificacion"

    );
    public $incrementing = true;
    public $timestamps = false;
}
