<?php


namespace App\Modelos\VisitaMedica;


use Illuminate\Database\Eloquent\Model;

class MD_Promocion extends Model
{
    protected $table = 'MD_Promocion';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "IdVisita",
        "IdProducto",
        "Descripcion",
        "UsuarioCreacion",
        "UsuarioModificacion"

    );
    public $incrementing = true;
    public $timestamps = false;
}
