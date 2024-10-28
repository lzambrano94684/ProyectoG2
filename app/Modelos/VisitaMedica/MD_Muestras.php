<?php


namespace App\Modelos\VisitaMedica;


use Illuminate\Database\Eloquent\Model;

class MD_Muestras extends Model
{
    protected $table = 'MD_Muestras';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "IdLinea",
        "Nombre",
        "UsuarioCreacion",
        "UsuarioModificacion",

    );
    public $incrementing = true;
    public $timestamps = false;
}
