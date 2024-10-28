<?php


namespace App\Modelos\VisitaMedica;


use Illuminate\Database\Eloquent\Model;

class MD_Menciones extends Model
{
    protected $table = 'MD_Menciones';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "IdRepresentante",
        "IdProducto",
        "NombreLargo",
        "CDGMedico",
        "CUP",
        "EspPromoRegilla",
        "Cat",
        "Frecuencia",
        "Recetas",
        "Posicion",
        "Version",
        "UsuarioCreacion",
        "UsuarioModificacion"

    );
    public $incrementing = true;
    public $timestamps = false;
}
