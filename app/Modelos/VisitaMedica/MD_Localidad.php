<?php
namespace App\Modelos\VisitaMedica;


use Illuminate\Database\Eloquent\Model;

class MD_Localidad extends Model
{
    protected $table = 'MD_Localidad';
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
