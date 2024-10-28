<?php


namespace App\Modelos\VisitaMedica;


use Illuminate\Database\Eloquent\Model;

class MD_EntregaMM extends Model
{
    protected $table = 'MD_EntregaMM';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "IdVisita",
        "IdMuestra",
        "Cantidad",
        "UsuarioCreacion",
        "UsuarioModificacion"

    );
    public $incrementing = true;
    public $timestamps = false;
}
