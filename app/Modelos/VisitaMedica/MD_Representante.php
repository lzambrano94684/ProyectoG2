<?php


namespace App\Modelos\VisitaMedica;


use Illuminate\Database\Eloquent\Model;

class MD_Representante extends Model
{
    protected $table = 'MD_Representante';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "IdLinea",
        "IdUsuario",
        "Representante",
        "UsuarioCreacion",
        "UsuarioModificacion",

    );
    public $incrementing = true;
    public $timestamps = false;
}
