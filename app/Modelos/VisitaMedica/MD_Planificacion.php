<?php


namespace App\Modelos\VisitaMedica;


use Illuminate\Database\Eloquent\Model;

class MD_Planificacion extends Model
{
    protected $table = 'MD_Planificacion';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "IdFichero",
        "Fecha",
        "Estado",
        "HoraInicio",
        "HoraFin",
        "Tipo",
        "Descripcion",
        "Horario",
        "OrdenVisita",
        "UsuarioCreacion",
        "UsuarioModificacion",

    );
    public $incrementing = true;
    public $timestamps = false;
}
