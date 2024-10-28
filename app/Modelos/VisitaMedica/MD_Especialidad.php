<?php
namespace App\Modelos\VisitaMedica;


use Illuminate\Database\Eloquent\Model;

class MD_Especialidad extends Model
{
    protected $table = 'MD_Especialidad';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "Nombre",
        "FechaCreacion",
        "FechaModificacion",
        "UsuarioCreacion",
        "UsuarioModificacion"
    );
    public $incrementing = true;
    public $timestamps = false;
}
