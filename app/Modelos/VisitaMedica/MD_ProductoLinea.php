<?php


namespace App\Modelos\VisitaMedica;


use Illuminate\Database\Eloquent\Model;

class MD_ProductoLinea extends Model
{
    protected $table = 'MD_ProductoLinea';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "IdLinea",
        "IdProducto",
        "Version",
        "UsuarioCreacion",
        "UsuarioModificacion"

    );
    public $incrementing = true;
    public $timestamps = false;
}
