<?php


namespace App\Modelos\VisitaMedica;


use Illuminate\Database\Eloquent\Model;

class MD_Productos extends Model
{
    protected $table = 'MD_Productos';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "Nombre",
        "UsuarioCreacion",
        "UsuarioModificacion"

    );
    public $incrementing = true;
    public $timestamps = false;
}
