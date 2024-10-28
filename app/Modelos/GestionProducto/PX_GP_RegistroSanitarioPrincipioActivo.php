<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_RegistroSanitarioPrincipioActivo extends Model
{
    protected $table = 'PX_GP_RegistroSanitarioPrincipioActivo';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "IdRegistroSanitario",
        "IdPrincipioActivo",
        "UsuarioCreacion",
        "UsuarioModificacion"
    );
    public $incrementing = true;
    public $timestamps = false;

}
