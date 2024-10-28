<?php
namespace App\Modelos\VisitaMedica;


use Illuminate\Database\Eloquent\Model;

class MD_Region extends Model
{
    protected $table = 'MD_Region';
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
