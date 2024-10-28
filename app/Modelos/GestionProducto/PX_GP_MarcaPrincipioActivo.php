<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_MarcaPrincipioActivo extends Model
{
    protected $table = 'PX_GP_MarcaPrincipioActivo';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "IdMarca",
        "IdPrincipioActivo",
        "UsuarioCreacion",
    );
    public $incrementing = true;
    public $timestamps=false;

    public function PrincipioActivo()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_PrincipioActivo', 'IdPrincipioActivo', 'Id');
    }

}
